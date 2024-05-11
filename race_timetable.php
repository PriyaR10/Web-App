<?php
 include("session-timeout.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta name="keywords" content="Swimming,Swimmers,Club,Teams,Training,Gala,Competition,SwimmingClub">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="common-style.css" rel="stylesheet">

</head>
<body>
<?php


  $stmt = $connect->prepare("SELECT * FROM intra_race_timetable ORDER BY race_date ASC");
 

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h2>UPCOMING INTERNAL RACES:</h2>";
    echo "<table>";
    echo "<tr><th>Race Date</th><th>Stroke Type</th><th>Distance</th></tr>";
    while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["race_date"] . "</td>";
    echo "<td>" . $row["stroke_type"] . "</td>";
    echo "<td>" . $row["distance"] . "</td>";
    echo "</tr>";
}
echo "</table>";
}else {
    echo "0 results";
  }
  // Close the statement and connection
  $stmt->close();
  $connect->close();

?>


</body>
</html>
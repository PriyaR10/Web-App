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

$stroke_type = "freeStyle";
$distance1 = "500m";

  $stmt = $connect->prepare("SELECT * FROM race_performance WHERE stroke_type = ? AND distance = ? ORDER BY position ASC");
  // Bind the parameter
$stmt->bind_param("ss", $stroke_type , $distance1);
$stmt->execute();
$result = $stmt->get_result();
 
  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h3>FREESTYLE 500M PERFORMANCE:</h3>";
    echo "<table>";
    echo "<tr><th>Swimmer Name</th><th>Duration</th><th>Position</th><th>Coach name</th></tr>";
    while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["duration"] . "</td>";
    echo "<td>" . $row["position"] . "</td>";
    $stmt1 = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
  // Bind the parameter
    $stmt1->bind_param("s", $row["username"]);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if ($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()){
    echo "<td>" . $row1["coach_name"] . "</td>";
    echo "</tr>";
  }
}
}
echo "</table>";
}else {
    echo "0 results";
  }
$distance2="1200m";
    $stmt = $connect->prepare("SELECT * FROM race_performance WHERE stroke_type = ? AND distance = ? ORDER BY position ASC ");
  // Bind the parameter
$stmt->bind_param("ss", $stroke_type , $distance2);
$stmt->execute();
$result = $stmt->get_result();
 
  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h3>FREESTYLE 1200M PERFORMANCE:</h3>";
    echo "<table>";
    echo "<tr><th>Swimmer Name</th><th>Duration</th><th>Position</th><th>Coach name</th></tr>";
    while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["duration"] . "</td>";
    echo "<td>" . $row["position"] . "</td>";
    $stmt1 = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
  // Bind the parameter
    $stmt1->bind_param("s", $row["username"]);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if ($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()){
    echo "<td>" . $row1["coach_name"] . "</td>";
    echo "</tr>";
  }
}
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
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
</head>
<body>
<style type="text/css">
/* Table styles */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

th, td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

tr:hover {
  background-color: #f5f5f5;
}

/* Button styles */
#book {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

/* Media queries */
@media (max-width: 768px) {
  table {
    font-size: 14px;
  }

  #book {
    font-size: 14px;
    padding: 10px 20px;
  }
}

@media (max-width: 576px) {
  table {
    font-size: 12px;
  }

  #book {
    font-size: 12px;
    padding: 8px 16px;
  }
}

</style>
<?php

  $stmt = $connect->prepare("SELECT * FROM workshop_show ORDER BY workshop_date ASC");
 

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h2>UPCOMING WORKSHOPS:</h2>";
    echo "<table>";
    echo "<tr><th>Workshop Date</th><th>Timings</th><th>Venue</th></tr>";
    while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row["workshop_date"] . "</td>";
    echo "<td>" . $row["timings"] . "</td>";
    echo "<td>" . $row["venue"] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
echo '<button id="book"><a href="book_workshop.php"  style="color: white; text-decoration: none;">ENROLL</a></button>';

}else {
    echo "0 results";
  }
  // Close the statement and connection
  $stmt->close();
  $connect->close();

?>


</body>
</html>
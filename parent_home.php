<?php
 include("session-timeout.php"); 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Parent.php</title>
    <meta name="keywords" content="Swimming,Swimmers,Club,Teams,Training,Gala,Competition,SwimmingClub">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="common-style.css" rel="stylesheet">

</head>
<body>

<?php

// Define the role you want to fetch data for
$role_parent = "parent";
$role_swimmer = "swimmer";

// Check if the user is logged in and has a session variable set
if (isset($_SESSION['user_name'])) {
  // Define the email submitted by the user
  $user_name = $_SESSION['user_name'];

  // Prepare a SQL query to fetch data from the "users_data" table based on the role and email
  $stmt_parent = $connect->prepare("SELECT * FROM users_data WHERE role = ? AND username = ?");
  $stmt_parent->bind_param("ss", $role_parent, $user_name);

  // Execute the parent query
  $stmt_parent->execute();

  // Get the result set for parent details
  $result_parent = $stmt_parent->get_result();

  // Check if there are any rows returned for parent details
  if ($result_parent->num_rows > 0) {
    // Output parent data of each row
    while ($row_parent = $result_parent->fetch_assoc()) {
      echo "<h3>PARENT DETAILS:</h3>";
      echo "<table>";
      echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Parent_Of</th><th>Action</th></tr>";
      echo "<tr>";
      echo "<td>" . $row_parent["username"] . "</td>";
      echo "<td>" . $row_parent["surname"] . "</td>";
      echo "<td>" . $row_parent["date_of_birth"] . "</td>";
      echo "<td>" . $row_parent["email"] . "</td>";
      echo "<td>" . $row_parent["telephone_number"] . "</td>";
      echo "<td>" . $row_parent["address"] . "</td>";
      echo "<td>" . $row_parent["parent_of"] . "</td>";
      echo "<td><a href='edit.php?id=" . $row_parent["id"] . "'>Edit</a></td>"; // Edit button/link
      echo "</tr>";
      echo "</table>";

  // Fetch swimmer data associated with the parent
$stmt_swimmer = $connect->prepare("SELECT * FROM users_data WHERE role = ? AND username = ?");
$stmt_swimmer->bind_param("ss", $role_swimmer, $row_parent["parent_of"]);

// Execute the swimmer query
$stmt_swimmer->execute();

// Get the result set for swimmer details
$result_swimmer = $stmt_swimmer->get_result();

// Check if there are any rows returned for swimmer details
if ($result_swimmer->num_rows > 0) {
  // Output swimmer data of each row
  echo "<h3>SWIMMER DETAILS:</h3>";
  echo "<table>";
  echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Postcode</th><th>Action</th></tr>";
  while ($row_swimmer = $result_swimmer->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row_swimmer["username"] . "</td>";
    echo "<td>" . $row_swimmer["surname"] . "</td>";
    echo "<td>" . $row_swimmer["date_of_birth"] . "</td>";
    echo "<td>" . $row_swimmer["email"] . "</td>";
    echo "<td>" . $row_swimmer["telephone_number"] . "</td>";
    echo "<td>" . $row_swimmer["address"] . "</td>";
    echo "<td>" . $row_swimmer["postcode"] . "</td>";
    echo "<td><a href='edit.php?id=" . $row_swimmer["id"] . "'>Edit</a></td>"; // Edit button/link
    echo "</tr>";
    echo "</table>";
     // Fetch training performance data for this swimmer
    $perf_stmt = $connect->prepare("SELECT * FROM training_performance WHERE id = ?");
    $perf_stmt->bind_param("s", $row_swimmer["id"]);

    // Execute the query
    $perf_stmt->execute();

    // Get the result set
    $result_perf = $perf_stmt->get_result();

    // Check if there are any rows returned for performance details
    if ($result_perf->num_rows > 0) {
      // Output performance data of each row
      echo "<h3>TRAINING DETAILS:</h3>";
      echo "<table>";
      echo "<tr><th>User_Name</th><th>Coach_Name</th><th>Week_1</th><th>Week_2</th><th>Week_3</th><th>Week_4</th></tr>";
      while ($row_perf = $result_perf->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_perf["username"] . "</td>";
        echo "<td>" . $row_perf["coach_name"] . "</td>";
        echo "<td>" . $row_perf["Week_1"] . "</td>";
        echo "<td>" . $row_perf["Week_2"] . "</td>";
        echo "<td>" . $row_perf["Week_3"] . "</td>";
        echo "<td>" . $row_perf["Week_4"] . "</td>";
        echo "</tr>";
      }
    echo "</table>";
    } else {
      echo "<tr><th colspan='8'>No training performance data found for this swimmer.</th></tr>";
    }
         // Fetch training performance data for this swimmer
    $race_stmt = $connect->prepare("SELECT * FROM race_performance WHERE id = ?");
    $race_stmt->bind_param("s", $row_swimmer["id"]);

    // Execute the query
    $race_stmt->execute();

    // Get the result set
    $result_race = $race_stmt->get_result();

    // Check if there are any rows returned for performance details
    if ($result_race->num_rows > 0) {
      // Output performance data of each row
      echo "<h3>RACE PERFORMANCE DETAILS:</h3>";
      echo "<table>";
     echo "<table>";
    echo "<tr><th>User_Name</th><th>Race_date</th><th>Stroke_Type</th><th>Distance</th><th>Duration</th><th>Position</th></tr>";
    $row_race = $result_race->fetch_assoc();
    echo "<tr>";
    echo "<td>" . $row_race["username"] . "</td>";
    echo "<td>" . $row_race["race_date"] . "</td>";
    echo "<td>" . $row_race["stroke_type"] . "</td>";
    echo "<td>" . $row_race["distance"] . "</td>";
    echo "<td>" . $row_race["duration"] . "</td>";
    echo "<td>" . $row_race["position"] . "</td>";
   
      echo "</tr>"; 
    echo "</table>";
    } else {
      echo "<tr><th colspan='8'>No race performance data found for this swimmer.</th></tr>";
    }
} }else {
  echo "<p>No associated swimmers found.</p>";
}
  } }else {
    echo "<p>No associated swimmers found.</p>";
  }
} else {
echo "<p>No parent details found.</p>";
}

?>

</body>
</html>
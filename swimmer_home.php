<?php
 include("session-timeout.php"); 
 ?>
  <?php

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5)) {
    // last request was more than 30 seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    echo "<script>alert('Session timeout. Please login again.')</script>";
    // echo "<script>window.location.href='login.php'</script>";
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>swimmer.php</title>
    <meta name="keywords" content="Swimming,Swimmers,Club,Teams,Training,Gala,Competition,SwimmingClub">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="common-style.css" rel="stylesheet">

</head>
<body>

<?php



// Check if the user is logged in and has a session variable set
if (isset($_SESSION['user_name'])) {
  // Define the username submitted by the user
  $user_name = $_SESSION['user_name'];

  // Prepare a SQL query to fetch data from the "users_data" table based on the user's username
  $stmt = $connect->prepare("SELECT * FROM users_data WHERE username = ?");
  $stmt->bind_param("s", $user_name);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h2>PERSONAL DETAILS:</h2>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Postcode</th><th>Action</th></tr>";
    $row = $result->fetch_assoc();
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["surname"] . "</td>";
    echo "<td>" . $row["date_of_birth"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["telephone_number"] . "</td>";
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["postcode"] . "</td>";
    // Calculate the age based on the date of birth
    $dob = new DateTime($row["date_of_birth"]);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
      
    // Only show the Edit option if the age is greater than 18
    if ($age >= 18) {
      echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>"; // Edit button/link
    } else {
      echo "<td></td>"; // Leave a blank column if the age is not greater than 18
    }
      
    echo "</tr>"; 
    echo "</table>";
  } else {
    
  }
   // Prepare a SQL query to fetch data from the "users_data" table based on the user's username
  $perf_stmt = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
  $perf_stmt->bind_param("s", $user_name);

  // Execute the query
  $perf_stmt->execute();

  // Get the result set
  $result1 = $perf_stmt->get_result();

  // Check if there are any rows returned
  if ($result1->num_rows > 0) {
    // Output data of the row
    echo "<h2>TRAINING DETAILS:</h2>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Coach_Name</th><th>Week_1</th><th>Week_2</th><th>Week_3</th><th>Week_4</th></tr>";
    $row1 = $result1->fetch_assoc();
    echo "<tr>";
    echo "<td>" . $row1["username"] . "</td>";
    echo "<td>" . $row1["coach_name"] . "</td>";
    echo "<td>" . $row1["Week_1"] . "</td>";
    echo "<td>" . $row1["Week_2"] . "</td>";
    echo "<td>" . $row1["Week_3"] . "</td>";
    echo "<td>" . $row1["Week_4"] . "</td>";
   
      echo "</tr>"; 
    echo "</table>";
  } else {
    
  }

    // Prepare a SQL query to fetch data from the "users_data" table based on the user's username
  $race_stmt = $connect->prepare("SELECT * FROM race_performance WHERE username = ?");
  $race_stmt->bind_param("s", $user_name);

  // Execute the query
  $race_stmt->execute();

  // Get the result set
  $race_result = $race_stmt->get_result();

  // Check if there are any rows returned
  if ($race_result->num_rows > 0) {
    // Output data of the row
    echo "<h2>PARTICIPATION IN RACE DETAILS:</h2>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Race_date</th><th>Stroke_Type</th><th>Distance</th><th>Duration</th><th>Position</th></tr>";
    $row_race = $race_result->fetch_assoc();
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
    
  }
  // Close the statement and connection
  $stmt->close();
  $connect->close();
} else {
 
  exit();
}
?>


</body>
</html>



  <?php
include("db_connect.php");
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30)) {
    // last request was more than 30 seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    echo "<script>alert('Session timeout. Please login again.')</script>";
     echo "<script>window.location.href='login.php'</script>";
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<?php
// Define database connection variables
// include("db_connect.php");

if(isset($_POST["submit"])) {
  // Retrieve the user's input from the sign-up form
  $User_name = $_POST["username"];
  $Email = $_POST["email_address"];
  $Clubname = $_POST["club_name"];
  $RaceDate = $_POST["race_date"];
  $StrokeType = $_POST["stroke_type"];
  $Distance = $_POST["distance"];
  
  // Check if the user already exists in the race_timetable table
  $stmt_check_user = $connect->prepare("SELECT * FROM gala_tournament WHERE username = ?");
  $stmt_check_user->bind_param("s", $User_name);
  $stmt_check_user->execute();
  $result_check_user = $stmt_check_user->get_result();

  if($result_check_user->num_rows > 0) {
    // Show error message and ask user to change username
    echo "<script>alert('Sorry! Username already exists. Please choose a different username.');</script>";
  } else {
    // Prepare the SQL statement to insert the user's data into the database
    $stmt = $connect->prepare("INSERT INTO gala_tournament(username, email_address, club_name, race_date, stroke_type, distance) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $User_name, $Email, $Clubname, $RaceDate, $StrokeType, $Distance);

    // Check if the SQL statement was executed successfully
    if ($stmt->execute()) {
      echo "User added successfully!";
    } else {
      echo "Error: " . $stmt->error;
    }
  }

  // Close the database connection
  mysqli_close($connect);
}
?>
 <!--    //   $stmt = $connect->prepare("INSERT INTO gala_tournament(username, email_address, club_name, race_date, stroke_type, distance) VALUES (?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("ssssss", $User_name, $Email, $Clubname, $RaceDate, $StrokeType, $Distance);

    // // Check if the SQL statement was executed successfully
    // if ($stmt->execute()) {
    //   echo "User added successfully!";
    // } else {
    //   // Display error message and error code
    //   echo "Error: " . $stmt->errno . " - " . $stmt->error;
    // }
    // Close the database connection -->

 

  



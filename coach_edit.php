<?php
 include("session-timeout.php"); 
 ?>
<?php
// include("db_connect.php");

// Get the email of the row to be edited from the URL parameter
$id = $_GET["id"];

// Fetch the data of the row to be edited from the database
$stmt = $connect->prepare("SELECT * FROM training_performance WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $username = $row["username"];
  $coach_name = $row["coach_name"];
  $Week_1= $row["Week_1"];
  $Week_2 = $row["Week_2"];
  $Week_3 = $row["Week_3"];
  $Week_4 = $row["Week_4"];
 
  // Check if user is over 18 years old and allow editing if true


  // Only allow coach users to edit training performance
  // if ($is_coach) {
  //   $training_performance = $row["training_performance"];
  // } else {
  //   $training_performance = null;
  // }

  // // Only allow club_admin users to edit race performance
  // if ($is_club_admin) {
  //   $race_performance = $row["race_performance"];
  // } else {
  //   $race_performance = null;
  // }

  // Check if the form has been submitted and editing is allowed
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the new data submitted by the user
    $username = $_POST["username"];
    $coach_name = $_POST["coach_name"];
    $Week_1 = $_POST["Week_1"];
    $Week_2 = $_POST["Week_2"];
    $Week_3 = $_POST["Week_3"];
    $Week_4 = $_POST["Week_4"];
   
    // if ($is_coach) {
    //   $training_performance = $_POST["training_performance"];
    // }

    // if ($is_club_admin) {
    //   $race_performance = $_POST["race_performance"];
    // }

    // Create a SQL query to update the row in the database
    // if ($is_coach && !is_null($training_performance)) {
       $sql = "UPDATE training_performance SET username = ?, coach_name = ?, Week_1 = ? , Week_2 = ?, Week_3 = ?, Week_4 = ? WHERE id = ?";
       // Prepare the statement
       $stmt = $connect->prepare($sql);
       // Bind the parameters to the statement
      $stmt->bind_param("sssssss", $username, $coach_name, $Week_1 , $Week_2, $Week_3 , $Week_4 , $id);
    // } elseif ($is_club_admin && !is_null($race_performance)) {
    //   $sql = "UPDATE users_data SET username = ?, surname = ?, date_of_birth = ?, telephone_number = ?, address = ?, race_performance = ? WHERE id = ?";
    //   // Prepare the statement
    //   $stmt = $connect->prepare($sql);
    //   // Bind the parameters to the statement
    //   $stmt->bind_param("sssssss", $username, $surname, $date_of_birth, $telephone_number, $address, $race_performance, $id);
    //   else {
    //   // Redirect the user without updating the row in the database
      
    //   exit();
    // }

    // Execute the statement
if ($stmt->execute()) {
  echo "<script>alert('User Details has been Updated Successfully');</script>";
  // header("Location: testing.php");
} else {
// Handle error
echo "Error updating row: " . $stmt->error;
}
}

// Close the statement and database connection
$stmt->close();
$connect->close();

} else {
// If the row to be edited is not found in the database, redirect the user


exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="common-editstyle.css" rel="stylesheet">
</head>
<body>

</body>
</html>
<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo $username; ?>">
  <a href="#" class="edit" data-field="username"><i class="fas fa-pencil-alt"></i></a>
  <br>
  
  <label for="coach_name">Coach Name:</label>
  <input type="text" id="coach_name" name="coach_name" value="<?php echo $coach_name; ?>">
  <a href="#" class="edit" data-field="coach_name"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="Week_1">Week_1:</label>
  <input type="text" id="Week_1" name="Week_1" value="<?php echo $Week_1; ?>">
  <a href="#" class="edit" data-field="Week_1"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="Week_2">Week_2:</label>
  <input type="text" id="Week_2" name="Week_2" value="<?php echo $Week_2; ?>">
  <a href="#" class="edit" data-field="Week_2"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="Week_3">Week_3:</label>
  <input type="text" id="Week_3" name="Week_3" value="<?php echo $Week_3; ?>">
  <a href="#" class="edit" data-field="Week_3"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="Week_4">Week_4:</label>
  <input type="text" id="Week_4" name="Week_4" value="<?php echo $Week_4; ?>">
  <a href="#" class="edit" data-field="Week_4"><i class="fas fa-pencil-alt"></i></a>
  <br>

 

 
<!-- <?php if ($is_coach): ?>
  <label for="training_performance">Training Performance:</label>

  <input type="text" id="training_performance" name="training_performance" value="<?php echo $training_performance; ?>">
  <?php endif; ?>

<?php if ($is_club_admin): ?>
<label for="race_performance">Race Performance:</label>
  <input type="text" id="race_performance" name="race_performance" value="<?php echo $race_performance; ?>">
 <?php endif; ?> -->
 <br>
 <br> 

 
  <button type="submit" name="save">Save</button>
 </form>

  <?php
include("session-timeout.php");

// Get the email of the row to be edited from the URL parameter
$id = $_GET["race_date"];

// Fetch the data of the row to be edited from the database
$stmt = $connect->prepare("SELECT * FROM intra_race_timetable WHERE race_date = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $Race_date = $row["race_date"];
  $Stroke_type = $row["stroke_type"];
  $Distance= $row["distance"];

 
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
    $Race_date = $_POST["race_date"];
    $Stroke_type = $_POST["stroke_type"];
    $Distance = $_POST["distance"];
   
   
    // if ($is_coach) {
    //   $training_performance = $_POST["training_performance"];
    // }

    // if ($is_club_admin) {
    //   $race_performance = $_POST["race_performance"];
    // }

    // Create a SQL query to update the row in the database
    // if ($is_coach && !is_null($training_performance)) {
       $sql = "UPDATE intra_race_timetable SET race_date = ?, stroke_type = ?, distance = ? WHERE race_date = ?";
       // Prepare the statement
       $stmt = $connect->prepare($sql);
       // Bind the parameters to the statement
      $stmt->bind_param("ssss", $Race_date, $Stroke_type, $Distance , $id);
          // Execute the statement
if ($stmt->execute()) {
 echo "<script>alert('Race Details have been updated Successfully  .'); window.location='club_admin_home.php';</script>";
  // header("Location: testing.php");
} else {
// Handle error
echo "Error updating row: " . $stmt->error;
}
}
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
</head>
<link href="common-editstyle.css" rel="stylesheet">
<body>

<form method="post">
  <label for="race_date">Race Date:</label>
  <input type="text" id="race_date" name="race_date" value="<?php echo $Race_date; ?>">
  <a href="#" class="edit" data-field="race_date"><i class="fas fa-pencil-alt"></i></a>
  <br>
  
  <label for="stroke_type">Stroke Type:</label>
  <input type="text" id="stroke_type" name="stroke_type" value="<?php echo $Stroke_type; ?>">
  <a href="#" class="edit" data-field="stroke_typetr"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="distance">Distance</label>
  <input type="text" id="distance" name="distance" value="<?php echo $Distance; ?>">
  <a href="#" class="edit" data-field="distance"><i class="fas fa-pencil-alt"></i></a>
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
</body>
</html>
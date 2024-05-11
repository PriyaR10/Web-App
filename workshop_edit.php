<?php
 include("session-timeout.php"); 
 ?>
<?php


// Get the email of the row to be edited from the URL parameter
$id = $_GET["workshop_date"];

// Fetch the data of the row to be edited from the database
$stmt = $connect->prepare("SELECT * FROM workshop_show WHERE workshop_date = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $workshop_date = $row["workshop_date"];
  $timings = $row["timings"];
  $venue= $row["venue"];

 
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
    $workshop_date = $_POST["workshop_date"];
    $timings = $_POST["timings"];
    $venue = $_POST["venue"];
   
   
    // if ($is_coach) {
    //   $training_performance = $_POST["training_performance"];
    // }

    // if ($is_club_admin) {
    //   $race_performance = $_POST["race_performance"];
    // }

    // Create a SQL query to update the row in the database
    // if ($is_coach && !is_null($training_performance)) {
       $sql = "UPDATE workshop_show SET workshop_date = ?, timings = ?, venue = ? WHERE workshop_date = ?";
       // Prepare the statement
       $stmt = $connect->prepare($sql);
       // Bind the parameters to the statement
      $stmt->bind_param("ssss", $workshop_date, $timings, $venue , $id);
          // Execute the statement
if ($stmt->execute()) {
 echo "<script>alert('Workshop Details have been updated Successfully  .'); window.location='club_admin_home.php';</script>";
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
  <link href="common-editstyle.css" rel="stylesheet">

</head>
<body>


<form method="post">
  <label for="workshop_date">Workshop Date:</label>
  <input type="text" id="workshop_date" name="workshop_date" value="<?php echo $workshop_date; ?>">
  <a href="#" class="edit" data-field="workshop_date"><i class="fas fa-pencil-alt"></i></a>
  <br>
  
  <label for="timings">Timings:</label>
  <input type="text" id="timings" name="timings" value="<?php echo $timings; ?>">
  <a href="#" class="edit" data-field="timings"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="venue">Venue:</label>
  <input type="text" id="venue" name="venue" value="<?php echo $venue; ?>">
  <a href="#" class="edit" data-field="venue"><i class="fas fa-pencil-alt"></i></a>
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
<?php
 include("session-timeout.php"); 
 ?>

<?php


// Get the email of the row to be edited from the URL parameter
$id = $_GET["username"];

// Fetch the data of the row to be edited from the database
$stmt = $connect->prepare("SELECT * FROM gala_tournament WHERE username = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $username = $row["username"];
  $Email = $row["email_address"];
  $clubname = $row["club_name"];
  $race_date = $row["race_date"];
  $stroke_type = $row["stroke_type"];
  $distance = $row["distance"];
  $duration = $row["duration"];
  
 
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
    $Email = $_POST["email_address"];
    $clubname = $_POST["club_name"];
    $race_date = $_POST["race_date"];
    $stroke_type = $_POST["stroke_type"];
    $distance = $_POST["distance"];
    $duration = $_POST["duration"];
    
   
    // if ($is_coach) {
    //   $training_performance = $_POST["training_performance"];
    // }

    // if ($is_club_admin) {
    //   $race_performance = $_POST["race_performance"];
    // }

    // Create a SQL query to update the row in the database
    // if ($is_coach && !is_null($training_performance)) {
       $sql = "UPDATE gala_tournament SET username = ?, email_address = ?, club_name = ?, race_date = ?, stroke_type = ? , distance = ?, duration = ? WHERE username = ?";
       // Prepare the statement
       $stmt = $connect->prepare($sql);
       // Bind the parameters to the statement
      $stmt->bind_param("ssssssss", $username, $Email, $clubname, $race_date, $stroke_type , $distance, $duration  , $id);
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
      echo "<script>alert('Details have been updated Successfully  .'); window.location='club_admin_home.php';</script>";
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


<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo $username; ?>">
  <a href="#" class="edit" data-field="username"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="email_address">Email:</label>
  <input type="text" id="email_address" name="email_address" value="<?php echo $Email; ?>">
  <a href="#" class="edit" data-field="email_address"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="club_name">Club name:</label>
  <input type="text" id="club_name" name="club_name" value="<?php echo $clubname; ?>">
  <a href="#" class="edit" data-field="club_name"><i class="fas fa-pencil-alt"></i></a>
  <br>
  
  <label for="race_date">Race_Date:</label>
  <input type="date" id="race_date" name="race_date" value="<?php echo $race_date; ?>">
  <a href="#" class="edit" data-field="race_date"><i class="fas fa-pencil-alt"></i></a>
  <br>

 <label for="stroke_type">Stroke_Type:</label>
<select id="stroke_type" name="stroke_type">
  <option value="FreeStyle" <?php if ($stroke_type == "FreeStyle") echo "selected"; ?>>FreeStyle</option>
  <option value="BreastStroke" <?php if ($stroke_type == "BreastStroke") echo "selected"; ?>>BreastStroke</option>
  <option value="Butterfly" <?php if ($stroke_type == "Butterfly") echo "selected"; ?>>Butterfly</option>
  <option value="BackStroke" <?php if ($stroke_type == "BackStroke") echo "selected"; ?>>BackStroke</option>
</select>
<a href="#" class="edit" data-field="stroke_type"><i class="fas fa-pencil-alt"></i></a>
<br>

  <label for="distance">Distance:</label>
  <input type="text" id="distance" name="distance" value="<?php echo $distance; ?>">
  <a href="#" class="edit" data-field="Week_2"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="duration">Duration:</label>
  <input type="text" id="duration" name="duration" value="<?php echo $duration; ?>">
  <a href="#" class="edit" data-field="duration"><i class="fas fa-pencil-alt"></i></a>
  <br>
  <br>
 

 

 
<!-- <?php if ($is_coach): ?>
  <label for="training_performance">Training Performance:</label>

  <input type="text" id="training_performance" name="training_performance" value="<?php echo $training_performance; ?>">
  <?php endif; ?>

<?php if ($is_club_admin): ?>
<label for="race_performance">Race Performance:</label>
  <input type="text" id="race_performance" name="race_performance" value="<?php echo $race_performance; ?>">
 <?php endif; ?> -->
 

 
  <button type="submit" name="save">Save</button>
</form>
</body>
</html>
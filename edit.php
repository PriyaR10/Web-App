<?php
 include("session-timeout.php"); 
 ?>

<?php


// Get the email of the row to be edited from the URL parameter
$id = $_GET["id"];

// Fetch the data of the row to be edited from the database
$stmt = $connect->prepare("SELECT * FROM users_data WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $role = $row["role"];
  $is_coach = ($role == "coach");
  $is_club_admin = ($role == "club_admin");
  $username = $row["username"];
  $surname = $row["surname"];
  $password= $row["password"];
  $date_of_birth = $row["date_of_birth"];
  $email = $row["email"];
  $telephone_number = $row["telephone_number"];
  $address = $row["address"];
  $postcode = $row["postcode"];

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
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $date_of_birth = $_POST["date_of_birth"];
    $email = $_POST["email"];
    $telephone_number = $_POST["telephone_number"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];
    // if ($is_coach) {
    //   $training_performance = $_POST["training_performance"];
    // }

    // if ($is_club_admin) {
    //   $race_performance = $_POST["race_performance"];
    // }

    // Create a SQL query to update the row in the database
    // if ($is_coach && !is_null($training_performance)) {
       $sql = "UPDATE users_data SET username = ?, surname = ?, password = ? , date_of_birth = ?, email = ? , telephone_number = ?, address = ? , postcode = ? WHERE id = ?";
       // Prepare the statement
       $stmt = $connect->prepare($sql);
       // Bind the parameters to the statement
      $stmt->bind_param("sssssssss", $username, $surname, $password , $date_of_birth, $email , $telephone_number, $address, $postcode , $id);
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
  
  <label for="surname">Surname:</label>
  <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>">
  <a href="#" class="edit" data-field="surname"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="<?php echo $password; ?>">
  <a href="#" class="edit" data-field="password"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="date_of_birth">Date of Birth:</label>
  <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
  <a href="#" class="edit" data-field="date_of_birth"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="<?php echo $email; ?>">
  <a href="#" class="edit" data-field="email"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="telephone_number">Telephone Number:</label>
  <input type="tel" id="telephone_number" name="telephone_number" value="<?php echo $telephone_number; ?>">
  <a href="#" class="edit" data-field="telephone_number"><i class="fas fa-pencil-alt"></i></a>
  <br>

   <label for="address">Address:</label>
  <input type="text" id="address" name="address" value="<?php echo $address; ?>">
  <a href="#" class="edit" data-field="address"><i class="fas fa-pencil-alt"></i></a>
  <br>

  <label for="postcode">Post code:</label>
  <input type="text" id="postcode" name="postcode" value="<?php echo $postcode; ?>">
  <a href="#" class="edit" data-field="postcode"><i class="fas fa-pencil-alt"></i></a>
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
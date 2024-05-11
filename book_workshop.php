<?php
 include("session-timeout.php"); 
 ?>
<html>
<head>
  <title></title>
  <link href="booking-style.css" rel="stylesheet">
</head>
<body>
  <?php
  

if(isset($_POST["submit"])) {
  // Retrieve the user's input from the sign-up form
  $User_name = $_POST["username"];
  $Email = $_POST["email_address"];
  $WorkshopDate = $_POST["workshop_date"];
  $Timings = $_POST["timings"];
  $Venue = $_POST["venue"];

  
  // Check if the user already exists in the race_timetable table
  $stmt_check_user = $connect->prepare("SELECT * FROM workshop WHERE username = ?");
  $stmt_check_user->bind_param("s", $User_name);
  $stmt_check_user->execute();
  $result_check_user = $stmt_check_user->get_result();

  if($result_check_user->num_rows > 0) {
    // Show error message and ask user to change username
    echo "<script>alert('Sorry! Username already exists. Please choose a different username.'); window.location='book_gala.php';</script>";
  } else {
    // Prepare the SQL statement to insert the user's data into the database
    $stmt = $connect->prepare("INSERT INTO workshop(username, email_address, workshop_date, timings, venue) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $User_name, $Email, $WorkshopDate, $Timings, $Venue);

    // Check if the SQL statement was executed successfully
    if ($stmt->execute()) {
      echo "<script>alert('You have Successfully Enrolled for WorkShop .'); window.location='home.php';</script>";
    } else {
      echo "Error: " . $stmt->error;
    }
  }

  // Close the database connection
  mysqli_close($connect);
}
?>
<form method="POST">
 <bold><h3>WORKSHOP ENROLL</h3></bold>
  <label for="username">USER NAME:</label>
  <input type="text" id="username" name="username" required>

  <label for="email_address">EMAIL:</label>
  <input type="text" id="email_address" name="email_address" required>



<label for="workshop_date">WORKSHOP DATE:</label>
<select id="workshop_date" name="workshop_date" required>
  <option disabled selected value=""></option>
  <?php
  // Retrieve the race dates from the database
  $query = $connect->prepare("SELECT DISTINCT workshop_date FROM workshop_show");
  $query->execute();
  $result = $query->get_result();
  while($row = $result->fetch_assoc()) {
    echo "<option value='" . $row["workshop_date"] . "'>" . $row["workshop_date"] . "</option>";
  }
  ?>
</select>

<label for="timings">TIMINGS:</label>
<select id="timings" name="timings" required>
  <option disabled selected value=""></option>
  <?php
    // Retrieve the stroke types for the selected race date from the database
    $stmt = $connect->prepare("SELECT DISTINCT timings FROM workshop_show");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row["timings"] . "'>" . $row["timings"] . "</option>";
    } 
  
  ?>
</select>

  <label for="venue">VENUE:</label>
  <select id="venue" name="venue" required>
  <option disabled selected value=""></option>
  <?php
    // Retrieve the stroke types for the selected race date from the database
    $stmt = $connect->prepare("SELECT DISTINCT venue FROM workshop_show");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row["venue"] . "'>" . $row["venue"] . "</option>";
    } 
  
  ?>
</select>
  <button type="submit" name="submit">SUBMIT</button>
</form>

</body>
</html>
  <!-- // Retrieve the last ID used from the database
    $query = "SELECT id FROM gala_tournament ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $last_id = $row["id"];

    // Increment the last ID to generate the new ID for the user
    $new_id =  strval(intval(substr($last_id, 2)) + 1); -->
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
    echo "<script>alert('Sorry! Username already exists. Please choose a different username.'); window.location='book_gala.php';</script>";
  } else {
    // Prepare the SQL statement to insert the user's data into the database
    $stmt = $connect->prepare("INSERT INTO gala_tournament(username, email_address, club_name, race_date, stroke_type, distance) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $User_name, $Email, $Clubname, $RaceDate, $StrokeType, $Distance);

    // Check if the SQL statement was executed successfully
    if ($stmt->execute()) {
      echo "<script>alert('You have Successfully Enrolled for GALA .'); window.location='home.php';</script>";
    } else {
      echo "Error: " . $stmt->error;
    }
  }

  // Close the database connection
  mysqli_close($connect);
}
?>
<form method="POST">
 <bold><h3>GALA ENROLL</h3></bold>
  <label for="username">USER NAME:</label>
  <input type="text" id="username" name="username" required>

  <label for="email_address">EMAIL:</label>
  <input type="text" id="email_address" name="email_address" required>

  <label for="club_name">CLUB NAME:</label>
  <input type="text" id="club_name" name="club_name" required>

<label for="race_date">RACE DATE:</label>
<select id="race_date" name="race_date" required>
  <option disabled selected value=""></option>
  <?php
  // Retrieve the race dates from the database
  $query = $connect->prepare("SELECT DISTINCT race_date FROM race_timetable");
  $query->execute();
  $result = $query->get_result();
  while($row = $result->fetch_assoc()) {
    echo "<option value='" . $row["race_date"] . "'>" . $row["race_date"] . "</option>";
  }
  ?>
</select>

<label for="stroke_type">STROKE TYPE:</label>
<select id="stroke_type" name="stroke_type" required>
  <option disabled selected value=""></option>
  <?php
    // Retrieve the stroke types for the selected race date from the database
    $stmt = $connect->prepare("SELECT DISTINCT stroke_type FROM race_timetable");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row["stroke_type"] . "'>" . $row["stroke_type"] . "</option>";
    } 
  
  ?>
</select>

  <label for="distance">DISTANCE:</label>
  <select id="distance" name="distance" required>
  <option disabled selected value=""></option>
  <?php
    // Retrieve the stroke types for the selected race date from the database
    $stmt = $connect->prepare("SELECT DISTINCT distance FROM race_timetable");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row["distance"] . "'>" . $row["distance"] . "</option>";
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
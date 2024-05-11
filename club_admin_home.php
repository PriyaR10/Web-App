<?php
 include("session-timeout.php"); 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>club_Admin.php</title>
    <meta name="keywords" content="Swimming,Swimmers,Club,Teams,Training,Gala,Competition,SwimmingClub">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="common-style.css" rel="stylesheet">

</head>
<body>

<?php


$role = "club_admin";
$user_role = "swimmer";
$role_coach = "coach";

// Check if the user is logged in and has a session variable set
if (isset($_SESSION['user_name'])) {
  // Define the email submitted by the user
  $user_name = $_SESSION['user_name'];

  // Prepare a SQL query to fetch data from the "users_data" table based on the role and email
  
  // Prepare the statement and bind the parameters
 $stmt = $connect->prepare("SELECT * FROM users_data WHERE role = ? AND username = ?");
$stmt->bind_param("ss", $role, $user_name);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h3>ADMIN PERSONAL DETAILS:</h3>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>postcode</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["username"] . "</td>";
      echo "<td>" . $row["surname"] . "</td>";
      echo "<td>" . $row["date_of_birth"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      echo "<td>" . $row["telephone_number"] . "</td>";
      echo "<td>" . $row["address"] . "</td>";
      echo "<td>" . $row["postcode"] . "</td>";
       echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>"; // Edit button/link
      echo "</tr>";
    }
    echo "</table>";

    
    $stmt1 = $connect->prepare("SELECT * FROM race_performance");

  // Execute the query
  $stmt1->execute();

  // Get the result set
  $result1 = $stmt1->get_result();

  // Check if there are any rows returned
  if ($result1->num_rows >= 0) {
    // Output data of each row
    echo "<h3>SWIMMER RACE DETAILS:</h3>";
    echo "<table>";
    echo "<tr><th>ID</th><th>User_Name</th><th>Race_Date</th><th>Stroke_Type</th><th>Distance</th><th>Duration (In_seconds)</th><th>Action</th></tr>";
    while ($row1 = $result1->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row1["id"] . "</td>";
      echo "<td>" . $row1["username"] . "</td>";
      echo "<td>" . $row1["race_date"] . "</td>";
      echo "<td>" . $row1["stroke_type"] . "</td>";
      echo "<td>" . $row1["distance"] . "</td>";
      echo "<td>" . $row1["duration"] . "</td>";
      echo "<td><a href='race_edit.php?id=" . $row1["id"] . "'>Edit</a></td>"; // Edit button/link
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
if (isset($_POST["add_user"])) {
  $username = $_POST["username"];

  // Check if the user already exists in the users_data table
  $stmt_user = $connect->prepare("SELECT * FROM users_data WHERE username = ?");
  $stmt_user->bind_param("s", $username);
  $stmt_user->execute();
  $result_user = $stmt_user->get_result();

  if ($result_user->num_rows > 0) {
    // Get the id and role of the user from the users_data table
    $user_data = $result_user->fetch_assoc();
    $id = $user_data["id"]; 
    $role = $user_data["role"];

    if ($role == "swimmer") {
      // Check if the user already exists in the race_performance table
      $stmt_check_user = $connect->prepare("SELECT * FROM race_performance WHERE username = ?");
      $stmt_check_user->bind_param("s", $username);
      $stmt_check_user->execute();
      $result_check_user = $stmt_check_user->get_result();

      if ($result_check_user->num_rows >= 1) {
        // User already exists in the race_performance table
      } else {
        // Add the user to the race_performance table
        $stmt_add_user = $connect->prepare("INSERT INTO race_performance (id, username, race_date, stroke_type, distance, duration, position) VALUES (?, ?, '', '', '', 0, '')");
        $stmt_add_user->bind_param("ss", $id, $username);
        $stmt_add_user->execute();
      }
    } else {
      // User is not a swimmer
      echo "Only swimmers can participate in the race";
    }}else {
    echo "<h3>User $username not found in the squad</h3>";
  } 

  } else {
    
  }
    // Add a button to add a new user to the squad
echo "<br><button onclick='showForm()'>Add User</button>";
echo "<div id='addUserForm' style='display:none;'>";
echo "<form method='post'>";
echo "<label for='username'>Enter username of swimmer:</label>";
echo "<input type='text' name='username' required>";
echo "<input type='submit' name='add_user' value='Add User'>";
echo "</form>";
echo "</div>";

    
    $stmt1 = $connect->prepare("SELECT * FROM gala_tournament");

  // Execute the query
  $stmt1->execute();

  // Get the result set
  $result1 = $stmt1->get_result();

  // Check if there are any rows returned
  if ($result1->num_rows >= 0) {
    // Output data of each row
    echo "<h3>GALA RACE DETAILS:</h3>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Email</th><th>Club Name</th><th>Race_Date</th><th>Stroke_Type</th><th>Distance</th><th>Duration (In_seconds)</th><th>Action</th></tr>";
    while ($row1 = $result1->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row1["username"] . "</td>";
      echo "<td>" . $row1["email_address"] . "</td>";
      echo "<td>" . $row1["club_name"] . "</td>";
      echo "<td>" . $row1["race_date"] . "</td>";
      echo "<td>" . $row1["stroke_type"] . "</td>";
      echo "<td>" . $row1["distance"] . "</td>";
      echo "<td>" . $row1["duration"] . "</td>";
      echo "<td><a href='gala_race_edit.php?username=" . $row1["username"] . "'>Edit</a></td>"; // Edit button/link
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }




$stmt2 = $connect->prepare("SELECT * FROM race_timetable ORDER BY race_date ASC");
$stmt2->execute();

// Get the result set
$result2 = $stmt2->get_result();

// Check if there are any rows returned
if ($result2->num_rows > 0) {
  // Output data of each row
  echo "<h3>UPCOMING GALA RACE DETAILS:</h3>";
  echo "<table>";
  echo "<tr><th>race_date</th><th>stroke_type</th><th>distance</th><th>Action</th></tr>";
  while ($row2 = $result2->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row2["race_date"] . "</td>";
    echo "<td>" . $row2["stroke_type"] . "</td>";
    echo "<td>" . $row2["distance"] . "</td>";
    echo "<td><a href='race_timetable_edit.php?race_date=" . $row2["race_date"] . "'>Edit</a></td>"; // Edit button/link
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No upcoming races found.";
}

if (isset($_POST["add_race"])) {
  $race_date = $_POST["race_date"];
  // Add the user to the race_timetable table
  $stmt_add_race = $connect->prepare("INSERT INTO race_timetable(race_date,stroke_type,distance) VALUES (?,'','')");
  $stmt_add_race->bind_param("s", $race_date);
  if ($stmt_add_race->execute()) {
    echo "<script> window.location='club_admin_home.php';</script>";
      } else {
    echo "Error adding race.";
  }
}else{
  
}
echo "<br><button onclick='showRaceForm()'>Add new races</button>";
echo "<div id='addRaceForm' style='display:none;'>";
echo "<form method='post'>";
echo "<label for='race_date'>Enter race_date:</label>";
echo "<input type='text' name='race_date' required>";
echo "<input type='submit' name='add_race' value='Add Race'>";
echo "</form>";
echo "</div>";


$stmt3 = $connect->prepare("SELECT * FROM intra_race_timetable ORDER BY race_date ASC");
$stmt3->execute();

// Get the result set
$result3 = $stmt3->get_result();

// Check if there are any rows returned
if ($result3->num_rows > 0) {
  // Output data of each row
  echo "<h3>UPCOMING INTRA RACE DETAILS:</h3>";
  echo "<table>";
  echo "<tr><th>race_date</th><th>stroke_type</th><th>distance</th><th>Action</th></tr>";
  while ($row3 = $result3->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row3["race_date"] . "</td>";
    echo "<td>" . $row3["stroke_type"] . "</td>";
    echo "<td>" . $row3["distance"] . "</td>";
    echo "<td><a href='intra_race_timetable_edit.php?race_date=" . $row3["race_date"] . "'>Edit</a></td>"; // Edit button/link
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No upcoming races found.";
}

if (isset($_POST["add_intra_race"])) {
  $race_date1 = $_POST["race_date"];
  // Add the user to the race_timetable table
  $stmt_add_race = $connect->prepare("INSERT INTO intra_race_timetable(race_date,stroke_type,distance) VALUES (?,'','')");
  $stmt_add_race->bind_param("s", $race_date1);
  if ($stmt_add_race->execute()) {
    echo "<script> window.location='club_admin_home.php';</script>";
      } else {
    echo "Error adding race.";
  }
}else{
  
}
echo "<br><button onclick='showIntraRaceForm()'>Add new races</button>";
echo "<div id='addIntraRaceForm' style='display:none;'>";
echo "<form method='post'>";
echo "<label for='race_date'>Enter race_date:</label>";
echo "<input type='text' name='race_date' required>";
echo "<input type='submit' name='add_intra_race' value='Add Intra Race'>";
echo "</form>";
echo "</div>";


$stmt4 = $connect->prepare("SELECT * FROM workshop_show ORDER BY workshop_date ASC");
$stmt4->execute();

// Get the result set
$result4 = $stmt4->get_result();

// Check if there are any rows returned
if ($result4->num_rows > 0) {
  // Output data of each row
  echo "<h3>UPCOMING WORKSHOP DETAILS:</h3>";
  echo "<table>";
  echo "<tr><th>WorkShop Date</th><th>Timings</th><th>Venue</th><th>Action</th></tr>";
  while ($row4 = $result4->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row4["workshop_date"] . "</td>";
    echo "<td>" . $row4["timings"] . "</td>";
    echo "<td>" . $row4["venue"] . "</td>";
    echo "<td><a href='workshop_edit.php?workshop_date=" . $row4["workshop_date"] . "'>Edit</a></td>"; // Edit button/link
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No upcoming races found.";
}

if (isset($_POST["add_workshop"])) {
  $workshop_date = $_POST["workshop_date"];
  // Add the user to the race_timetable table
  $stmt_add_race = $connect->prepare("INSERT INTO workshop_show(workshop_date,timings,venue) VALUES (?,'','')");
  $stmt_add_race->bind_param("s", $workshop_date);
  if ($stmt_add_race->execute()) {
    echo "<script> window.location='club_admin_home.php';</script>";
      } else {
    echo "Error adding race.";
  }
}else{
  
}
echo "<br><button onclick='showworkshopForm()'>Add new workshop dates</button>";
echo "<div id='addworkshopForm' style='display:none;'>";
echo "<form method='post'>";
echo "<label for='workshop_date'>Enter Workshop_date:</label>";
echo "<input type='text' name='workshop_date' required>";
echo "<input type='submit' name='add_workshop' value='Add Workshop'>";
echo "</form>";
echo "</div>";
     // Prepare a SQL query to fetch data from the "users_data" table based on the user's username
  $stmt = $connect->prepare("SELECT * FROM users_data WHERE role = ?");
  $stmt->bind_param("s", $user_role);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h3>SWIMMER PERSONAL DETAILS:</h3>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Postcode</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc())
    {
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["surname"] . "</td>";
    echo "<td>" . $row["date_of_birth"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["telephone_number"] . "</td>";
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["postcode"] . "</td>";
    echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>"; 
     echo "</tr>";
    }
    echo "</table>";
}

 $stmt = $connect->prepare("SELECT * FROM users_data WHERE role = ?");
  $stmt->bind_param("s", $role_coach);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();
     // Check if there are any rows returned
  if ($result->num_rows > 0) {
    // Output data of the row
    echo "<h3>COACH PERSONAL DETAILS:</h3>";
    echo "<table>";
    echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Postcode</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc())
    {
    echo "<tr>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["surname"] . "</td>";
    echo "<td>" . $row["date_of_birth"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["telephone_number"] . "</td>";
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["postcode"] . "</td>";
    echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>"; 
     echo "</tr>";
    }
    echo "</table>";
}

   

 
  
  // Close the statement and connection
  $stmt->close();
  $connect->close();

} else {
  // User is not logged in, so redirect to the login page
  header('Location: login.php');
  exit();
}

}
 else{
  
}

?>
<script type="text/javascript">
  function showForm() {
  var form = document.getElementById("addUserForm");
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}
  function showRaceForm() {
  var form = document.getElementById("addRaceForm");
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}
  function showIntraRaceForm() {
  var form = document.getElementById("addIntraRaceForm");
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}
  function showworkshopForm() {
  var form = document.getElementById("addworkshopForm");
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}
</script>
<br>
<br>
<br>
</body>
</html>



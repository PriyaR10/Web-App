<?php
 include("session-timeout.php"); 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>coach.php</title>
    <meta name="keywords" content="Swimming,Swimmers,Club,Teams,Training,Gala,Competition,SwimmingClub">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="common-style.css" rel="stylesheet">
</head>
<body>

<?php

// Define the role you want to fetch data for
$role_coach = "coach";
$role_swimmer = "swimmer";

// Check if the user is logged in and has a session variable set
if (isset($_SESSION['user_name'])) {
  // Define the email submitted by the user
  $user_name = $_SESSION['user_name'];

  // Prepare a SQL query to fetch data from the "users_data" table based on the role and email
  $stmt_coach = $connect->prepare("SELECT * FROM users_data WHERE role = ? AND username = ?");
  $stmt_coach->bind_param("ss", $role_coach, $user_name);

  // Execute the parent query
  if ($stmt_coach->execute()) {
    // Get the result set for parent details
    $result_coach = $stmt_coach->get_result();

    // Check if there are any rows returned for parent details
    if ($result_coach->num_rows > 0) {
      // Output parent data of each row
      while ($row_coach = $result_coach->fetch_assoc()) {
        echo "<h3>COACH DETAILS:</h3>";
        echo "<table>";
        echo "<tr><th>User_Name</th><th>Sur_Name</th><th>Date_Of_Birth</th><th>Email</th><th>Telephone_Number</th><th>Address</th><th>Action</th></tr>";
        echo "<tr>";
        echo "<td>" . $row_coach["username"] . "</td>";
        echo "<td>" . $row_coach["surname"] . "</td>";
        echo "<td>" . $row_coach["date_of_birth"] . "</td>";
        echo "<td>" . $row_coach["email"] . "</td>";
        echo "<td>" . $row_coach["telephone_number"] . "</td>";
        echo "<td>" . $row_coach["address"] . "</td>";
        echo "<td><a href='edit.php?id=" . $row_coach["id"] . "'>Edit</a></td>"; // Edit button/link
        echo "</tr>";
        echo "</table>";

 // Fetch the username of swimmers under the coach's squad
$stmt_swimmers = $connect->prepare("SELECT * FROM users_data WHERE role = ? AND squad = ?");
$stmt_swimmers->bind_param("ss", $role_swimmer, $_SESSION["user_name"]);

// Execute the swimmer query
if ($stmt_swimmers->execute()) {
    // Get the result set for swimmers under the coach's squad
    $result_swimmers = $stmt_swimmers->get_result();

    // Check if there are any rows returned for swimmers under the coach's squad
    if ($result_swimmers->num_rows >= 0) {
        echo "<h3>SWIMMERS UNDER YOUR SQUAD:</h3>";
        echo "<table>";
        echo "<tr><th>User_Name</th><th>Week 1</th><th>Week 2</th><th>Week 3</th><th>Week 4</th><th>Action</th></tr>";

        // Output swimmer data along with their training performance details
        while ($row_swimmer = $result_swimmers->fetch_assoc()) {
            // Fetch the training performance details of the swimmer
            $stmt_training = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
            $stmt_training->bind_param("s", $row_swimmer["username"]);
            $stmt_training->execute();
            $result_training = $stmt_training->get_result();

            // Output swimmer data of each row along with their training performance details
            if ($result_training->num_rows > 0) {
                while ($row_training = $result_training->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_swimmer["username"] . "</td>";
                    echo "<td>" . $row_training["Week_1"] . "</td>";
                    echo "<td>" . $row_training["Week_2"] . "</td>";
                    echo "<td>" . $row_training["Week_3"] . "</td>";
                    echo "<td>" . $row_training["Week_4"] . "</td>";
                    echo "<td><a href='coach_edit.php?id=" . $row_swimmer["id"] . "'>Edit</a></td>"; // Edit button/link
                    
                    echo "</tr>";
                }
                
          } else {
            
          }
        }
  echo "</table>";
  if (isset($_POST["add_user"])) {
  $username = $_POST["username"];

  // Check if the user already exists in the users_data table
  $stmt_user = $connect->prepare("SELECT * FROM users_data WHERE username = ?");
  $stmt_user->bind_param("s", $username);
  $stmt_user->execute();
  $result_user = $stmt_user->get_result();

  if ($result_user->num_rows > 0) {
    // Get the id of the user from the users_data table
    $user_data = $result_user->fetch_assoc();
    $id = $user_data["id"];
    $role = $user_data["role"];

    if ($role == "swimmer") {
    // Update the squad field in users_data table
    $stmt_update_squad = $connect->prepare("UPDATE users_data SET squad = ? WHERE username = ?");
    $stmt_update_squad->bind_param("ss", $_SESSION["user_name"], $username);
    $stmt_update_squad->execute(); 

    $stmt_squad = $connect->prepare("SELECT squad FROM users_data WHERE username = ?");
    $stmt_squad->bind_param("s", $username);
    $stmt_squad->execute();
    $result_squad = $stmt_squad->get_result();

  if ($result_squad->num_rows > 0) {
    $squad_data = $result_squad->fetch_assoc();
    $squad = $squad_data["squad"];
}
    // Check if the user already exists in the training_performance table
    $stmt_check_user = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
    $stmt_check_user->bind_param("s", $username);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();
    


    if ($result_check_user->num_rows >= 1) {
      // User already exists in the training_performance table
    } else {
      // Add the user to the training_performance table
      $stmt_add_user = $connect->prepare("INSERT INTO training_performance (id, username, coach_name, Week_1, Week_2, Week_3, Week_4) VALUES (?, ?, ?, '', '', '', '')");
      $stmt_add_user->bind_param("sss", $id, $username, $squad);
      $stmt_add_user->execute();
    }

  }

   else {
     echo "only swimmers can be added in the squad";
    
  }
 }else{
    echo "<h3>User $username not found in the squad</h3>";
}


    
      


  
        }
      }
     }
    }}}}
       else {
        echo "<h2>No swimmers under your squad.</h2>";
      }
   
    echo "</tr>";
    echo "</table>";
        // Add a button to add a new user to the squad
echo "<br><button onclick='showForm()'>Add User</button>";
echo "<div id='addUserForm' style='display:none;'>";
echo "<form method='post'>";
echo "<label for='username'>Enter username of swimmer:</label>";
echo "<input type='text' name='username' required>";
echo "<input type='submit' name='add_user' value='Add User'>";
echo "</form>";
echo "</div>";


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
</script>
</body>
</html>


 <!--  // Fetch the training performance details of the swimmer
    $stmt_training = $connect->prepare("SELECT * FROM training_performance WHERE username = ?");
    $stmt_training->bind_param("s", $username);
    $stmt_training->execute();
    $result_training = $stmt_training->get_result();

    if ($result_training->num_rows > 0) {
      $row_training = $result_training->fetch_assoc();
      
      echo "<table>";
      echo "<tr><th>Username</th><th>Coach Name</th><th>Week 1</th><th>Week 2</th><th>Week 3</th><th>Week 4</th></tr>";
      echo "<tr>";
      echo "<td>" . $row_swimmer["username"] . "</td>";
      echo "<td>" . $row_training["coach_name"] . "</td>";
      echo "<td>" . $row_training["Week 1"] . "</td>";
      echo "<td>" . $row_training["Week 2"] . "</td>";
      echo "<td>" . $row_training["Week 3"] . "</td>";
       echo "<td>" . $row_training["Week 4"] . "</td>";
      echo "</tr>";
      echo "</table>"; -->
      <!--    } else {
        
        }  -->
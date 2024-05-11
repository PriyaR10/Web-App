<?php
 include("session-timeout.php"); 
 ?>

<!DOCTYPE html>
<html>
<head>

  <title>My Website</title>
  <style>
body {
  background-color: #2596be;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 20px;
  box-sizing: border-box;
  width: 100%;
}

.box {
  margin-top: 10px;
  flex-basis: calc(25% - 20px);
  background-color: white;
  margin-bottom: 20px;
  padding: 20px;
  box-sizing: border-box;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.box:hover {
  transform: translateY(-5px);
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.4);
}

.box h2 {
  font-size: 20px;
  margin-top: 0;
  margin-bottom: 10px;
}

.box ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.box li {
  margin-bottom: 5px;
  padding: 3px 0;
}

.menu {
  background-color: #2596be;
  padding: 20px;
  box-sizing: border-box;
}

#web_name {
  float: left;
  font-size: 24px;
  color: black;
  margin: 0;
  padding: 0;
}

#menuss {
  float: right;
  color: black;
  font-weight: bold;
  font-size: 18px;
  margin: 0;
  padding: 0;
}

#menuss h3 {
  display: inline-block;
  margin: 0;
  padding: 0 10px;
}

#menuss h3 a {
  color: black;
  text-decoration: none;
  transition: color 0.2s;
}

#menuss h3 a:hover {
  color: white;
}

form {
  display: inline-block;
  margin: 0;
  padding: 0;
  vertical-align: middle;
}

form input[type="submit"] {
  background-color: #2596be;
  color: black;
  font-weight: bold;
  font-size: 20px;
  border: none;
  padding: 10px 10px;
  margin-left: 10px;
  cursor: pointer;
  margin-top: -5px;
  transition: background-color 0.2s;
}

form input[type="submit"]:hover {
  background-color: #fff;
  color: #2596be;
}

.box a {
  color: #2596be;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.2s;
}

.box a:hover {
  color: black;
}
@media screen and (max-width: 1024px) {
.container {
flex-direction: column;
align-items: center;
}
.box {
flex-basis: calc(50% - 20px);
}
}

@media screen and (max-width: 768px) {
.box {
flex-basis: calc(100% - 20px);
}
}
</style>

</head>
<body>
  <section>
  <div class="menu">
    <h2 id="web_name"> SWIMMING WEBSITE </h2>
    <div id="menuss">
    <!-- <h3><a href="login.php">LOGIN</a></h3> -->
        <?php
        // include("db_connect.php");
        // session_start();
        if(isset($_SESSION['user_name'])) {
            $stmt_user = $connect->prepare("SELECT * FROM users_data WHERE username = ?");
            $stmt_user->bind_param("s", $_SESSION['user_name']);
            $stmt_user->execute();
           $result_user = $stmt_user->get_result();

          if ($result_user->num_rows > 0) {
    // Get the id of the user from the users_data table
           $user_data = $result_user->fetch_assoc();
           $role = $user_data["role"];
            if ($role == 'swimmer') {
            echo "<h3><a href='swimmer_home.php'>USER DETAILS</a></h3>";
        } else if ($role == 'coach') {
            echo "<h3><a href='coach_home.php'>USER DETAILS</a></h3>";
        } else if ($role == 'parent') {
            echo "<h3><a href='parent_home.php'>USER DETAILS</a></h3>";
        }
          else if ($role == 'club_admin') {
            echo "<h3><a href='club_admin_home.php'>USER DETAILS</a></h3>";
        }
      }
          echo "<form action='logout.php' method='post'>";
          echo "<input type='submit' value='LOGOUT'>";
          echo "</form>";
        } else {
          echo "<h3><a href='login.php'>LOGIN</a></h3>";
        }
      ?>
    <h3><a href="signup.php">SIGNUP</a></h3>
    </div>
  </div>
  <div class="container">
    <div class="box">
      <h2>Events</h2>
      <ul>
        <li><a href="race_timetable.php">Race</a></li>
        <li><a href="gala_race_timetable.php">Gala</a></li>
        <li><a href="workshop.php">Workshop</a></li>
      </ul>
    </div>
    <div class="box">
      <h2>Champions</h2>
      <ul>
        <li><a href="race_data.php">Monthly Race Champions</a></li>
        <li><a href="gala_data.php">Gala-Tournament Champions</a></li>
      </ul>
    </div>
    <div class="box">
      <h2>Bookings</h2>
      <ul>
        <li><a href="book_training.php">Training</a></li>
        <li><a href="book_workshop.php">Workshop</a></li>
        <li><a href="book_gala.php">Gala</a></li>
      </ul>
    </div>
    <div class="box">
      <h2>Stroke Style</h2>
      <ul>
        <li><a href="freestyle.php">Free Style</a></li>
        <li><a href="breaststroke.php">Breast Stroke</a></li>
        <li><a href="#">Butterfly</a></li>
        <li><a href="#">Backstroke</a></li>
      </ul>
    </div>
  </div>
</body>
</html>
</section>


<section>
  <div class="contactsforms">
<?php include('contact.php'); ?>
</div>
</section>
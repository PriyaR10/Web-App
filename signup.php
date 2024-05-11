<!--Reference - Signup page using glass morphism -  codepen.io - Glass morphism login form tutorial using HTML and CSS - https://codepen.io/fghty/pen/PojKNEG-->
<!DOCTYPE html>
<html>
  <head>
    <title>User Enroll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="signup-style.css"> 
      </head>


  <body>
<?php
// Define database connection variables
include("db_connect.php");

if(isset($_POST["submit"])) {
  // Retrieve the user's input from the sign-up form
  $User_name = $_POST["user_name"];
  $Forename = $_POST["forename"];
  $Surname = $_POST["surname"];
  $Password = $_POST["password"];
  $Date = $_POST["date_of_birth"];
  $Email = $_POST["email_address"];
  $country_code= $_POST["country_code"];
  $safety_message = $_POST["safety_message"];
  $Telephone_number = $_POST["telephone_number"];
  $Address = $_POST["address"];
  $Post_code = $_POST["post_code"];
  $Role = $_POST["role"];
  $Parent_of = $_POST["parent_of"];

  // Check if username already exists in the database
  $query = "SELECT * FROM users_data WHERE username = '$User_name';";
  $result = mysqli_query($connect,$query);

  if(mysqli_num_rows($result) > 0) {
    // Show error message and ask user to change username
    echo "<script>alert('Sorry! Username already exists. Kindly choose a different username');</script>";
  } else {
    // Retrieve the last ID used from the database
    $query = "SELECT id FROM users_data WHERE id REGEXP '^sw[0-9]+$' ORDER BY CAST(SUBSTR(id, 3) AS UNSIGNED) DESC LIMIT 1;";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $last_id = $row["id"];

    // Increment the last ID to generate the new ID for the user
    $new_id = "sw" . strval(intval(substr($last_id, 2)) + 1);
    
    // Hash the password
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO users_data(id, username, forename, surname, password, date_of_birth, email,country_code,safety_message, telephone_number, address, postcode, role, parent_of) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($connect, $sql);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $new_id, $User_name, $Forename, $Surname, $hashed_password, $Date, $Email, $country_code, $safety_message, $Telephone_number, $Address, $Post_code, $Role, $Parent_of);

    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
      echo "<script> window.location='home.php';</script>";
    } else {
      echo "Error: " . mysqli_error($connect);
    }

    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
  }
}
?>


    <section class="back1">
  <div class="wave wave1"> </div>
  <div class="wave wave2"> </div>
  <div class="wave wave3"> </div>
  <div class="wave wave4"> </div>
    <div class="container">
      <div class="form-container">
        <form id="form1" name="form1"  onsubmit="return validate()" method="Post" autocomplete="off">
        <h3>ENROLL HERE</h3>

          <label id="new1"  for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username"  id="user_name" name="user_name">
          <span id="username_error"><?php if (isset($username_error)) { echo $username_error; } ?></span>
                    
          <label id="new1"  for="forename"><b>Forename</b></label>
          <input type="text" placeholder="Enter Forename" id="forename" name="forename">

          <label id="new1"  for="surname"><b>Surname</b></label>
          <input type="text" placeholder="Enter Surname" id="surname" name="surname">

          <label id="new1"  for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" id="password" name="password">
          
          <label id="new1"  for="date_of_birth"><b>Date of Birth</b></label>
          <input type="date" placeholder="Enter Date of Birth" id="date_of_birth" name="date_of_birth">

          <label id="new1"  for="email_address"><b>Email Address</b></label>
          <input type="email" placeholder="Enter Email" id="email_address" name="email_address">

          <label id="new1" for="country_code">Country Code:</label>
<select id="country_code" name="country_code" >
  <option value="">Select a country code</option>
  <option value="+1">+1 (USA)</option>
  <option value="+44">+44 (UK)</option>
  <option value="+91">+91 (India)</option>
  <!-- Add more options as needed -->
</select>
          <label id="new1"  for="safety_message"><b>Favourite Sports Person</b></label>
          <input type="text" placeholder="Enter your Favourite Sports person Name:" id="safety_message" name="safety_message">

          <label id="new1"  for="telephone_number"><b>Telephone Number</b></label>
          <input type="tel" placeholder="Enter Telephone number" id="telephone_number" name="telephone_number">

        <label id="new1"  for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" id="address" name="address">

        <label id="new1"  for="post_code"><b>Post Code</b></label>
        <input type="text" placeholder="Enter Post Code" id="post_code" name="post_code">

         <label id="new1"  for="role"><b>Role</b></label>
      <select id="role" name="role" onchange="toggleParentOfField()">
        <option value="parent">Parent</option>
        <option value="swimmer" selected>Swimmer</option>

      </select><br>
      
<div id="parent-of-field" style="display: none;">
  <label id="new1" for="parent_of"><b>Parent of</b></label>
  <input type="text" name="parent_of" id="parent_of">
</div>
      <input type="submit" value="ENROLL" name="submit">
      <div></div>
      <br>
    <div class="navigate">Already a Registered user?  <a href="login.php">Login</a></div>

  
    </form>
<script type="text/javascript">
  function validate() {
  let User_Name = document.forms["form1"]["user_name"].value;
  if (User_Name.length<2) {
    alert("Enter Your Full User_Name")
    return false;
  }
   let Fore_Name = document.forms["form1"]["forename"].value;
  if (Fore_Name=="") {
    alert("Enter Your Forename")
    return false;
  }
  let Sur_Name = document.forms["form1"]["surname"].value;
  if (Sur_Name=="") {
    alert("Enter Your Surname")
    return false;
  }

  let Password= document.forms["form1"]["password"].value;
  if(Password.length<7){
    alert("Enter a Valid Password")
    return false;
  }
  let Date_of_birth= document.forms["form1"]["date_of_birth"].value;
  if(Date_of_birth==""){
    alert("Enter a Date_of_birth")
    return false;
  }
  let Email= document.forms["form1"]["email_address"].value;
  if(Email=="") {
    alert("Enter a Valid Email Address")
    return false;
  }

   let Telephone_number=document.forms["form1"]["telephone_number"].value;
   if(Telephone_number.length!=10){
     alert(" Please Enter a Valid Telephone Number")
     return false;
   }
  let Address=document.forms["form1"]["address"].value;
  if(Address==""){
    alert("please Enter Your Address")
    return false;
  }
  let Post_code=document.forms["form1"]["post_code"].value;
  if(Post_code.length!=6){
    alert(" Please Enter a Valid Post Code")
    return false;
  }
  
  return true;
  }
 
  function toggleParentOfField() {
  var roleSelect = document.getElementById("role");
  var parentOfField = document.getElementById("parent-of-field");
  if (roleSelect.value === "parent") {
    parentOfField.style.display = "block";
  } else {
    parentOfField.style.display = "none";
  }
}
</script>

</div>
</div>

</section>

</body>
</html>

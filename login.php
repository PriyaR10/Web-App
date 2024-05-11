<!--Reference - glassmorphism login page codepen.io - Glass morphism login form tutorial using HTML and CSS - https://codepen.io/fghty/pen/PojKNEG -->
<?php include "login_conn.php" ?>
<html>
<head>
    <title>User Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Login-style.css"> 
</head>
<body>
<section class="back1">
	<div class="wave wave1"> </div>
	<div class="wave wave2"> </div>
	<div class="wave wave3"> </div>
	<div class="wave wave4"> </div>
	<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
  </div>
  <form id="form1" method="post" autocomplete="off">
        <h3>Login Here</h3>
        
        <label id="new1"for="username">Email</label>
        <input type="text" placeholder="Username" id="username" name="username" required>

        <label id="new1" for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <button id="button1">Log In</button>
        <br>
     <?php if (isset($error))
      { 
        echo $error; } ?>
        <div class="social">
        <div>New User?    <a href="Signup.php">Register</a></div>
        <div> <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
 </section> 
</body>
</html>






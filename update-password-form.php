<?php
session_start(); // Start session

include("db_connect.php");

if (!isset($_GET["username"])) {
    // Redirect to index.php if username parameter not provided
    header("Location: forgot_password.php");
    exit();
}

$user = $_GET["username"];

// Check if form submitted to update password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"])) {
    // Retrieve form data
    $new_password = $_POST["new_password"];

    // Hash new password
    $hashed_pass = password_hash($new_password, PASSWORD_DEFAULT);

    // Prepare SQL statement to update password
    $sql = "UPDATE users_data SET password = '$hashed_pass' WHERE username = '$user'";

    // Execute SQL statement
    mysqli_query($connect, $sql);

    echo "<script>alert('your password has been changed Successfully.'); window.location='login.php';</script>";
    exit();
}

mysqli_close($connect);
?>
<html>
<head>
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        form {
            width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
        }
        input[type=password], input[type=submit] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #3e8e41;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Update Password</h1>
    <form method="post" action="" autocomplete="off">
        Enter new password: <input type="password" name="new_password" required><br>
        <input type="submit" name="submit" value="Update Password">
    </form>
</body>
</html>

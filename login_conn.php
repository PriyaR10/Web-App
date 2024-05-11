
<!-- Reference -Switch statements -  W3schools - https://www.w3schools.com/php/php_switch.asp
               -Connection login page to database using php - simplilearn - https://www.simplilearn.com/tutorials/php-tutorial/php-login-form
 -->

<?php
session_start(); // Start session

include("db_connect.php");

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "SELECT * FROM users_data WHERE username = '$user'";

    // Execute SQL statement
    $result = mysqli_query($connect, $sql);

    // Check if query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // User exists, check password
        $row = mysqli_fetch_assoc($result); 
        $stored_pass = $row["password"];

        if (password_verify($pass, $stored_pass)) {
            // Password is correct, store user data in session
            $_SESSION["user_name"] = $row["username"];
            $_SESSION["user_role"] = $row["role"];
            $_SESSION["surname"] = $row["surname"];
            header("Location: home.php");
            exit();
        } else {
            
        }
    } else {
        // Invalid username
        $error = "Enter correct username and password";
    }
}

mysqli_close($connect);
?>


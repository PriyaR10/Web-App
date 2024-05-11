<?php
session_start(); // Start session

include("db_connect.php");

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user = $_POST["username"];
    $safety_message = $_POST["safety_message"];

    // Prepare SQL statement to check if username exists
    $sql = "SELECT * FROM users_data WHERE username = '$user'";

    // Execute SQL statement
    $result = mysqli_query($connect, $sql);

    // Check if query returned any rows
    if (mysqli_num_rows($result) == 1) {
        // User exists, check favorite sports person
        $row = mysqli_fetch_assoc($result); 
        $stored_safety_message = $row["safety_message"];

        if ($safety_message == $stored_safety_message) {
            // Favorite sports person is correct, redirect to update password form with username as parameter
            header("Location: update-password-form.php?username=$user");
            exit();
        } else {
            // Invalid favorite sports person
            $error = "Enter correct favorite sports person";
        }
    } else {
        // Invalid username
        $error = "Enter correct username";
    }
}

mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <form method="post" action="" autocomplete="off">
        <label>Enter username:</label>
        <input type="text" name="username" required>
        <label>Enter favorite sports person:</label>
        <input type="text" name="safety_message" required>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

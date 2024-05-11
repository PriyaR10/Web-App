<!-- Reference -signup page connection to db -  Hostinger.in - https://www.hostinger.in/tutorials/how-to-use-php-to-insert-data-into-mysql-database -->
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
    echo "<script>alert('Sorry! Username already exists. Please go back and choose a different username');</script>";
  } else {
    // Retrieve the last ID used from the database
    $query = "SELECT id FROM users_data ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $last_id = $row["id"];

    // Increment the last ID to generate the new ID for the user
    $new_id = "sw" . strval(intval(substr($last_id, 2)) + 1);

    // Prepare the SQL statement to insert the user's data into the database
    $sql = "INSERT INTO users_data(id, username, forename, surname, password, date_of_birth, email, telephone_number, address, postcode, role, parent_of) VALUES ('$new_id', '$User_name', '$Forename', '$Surname', '$Password', '$Date', '$Email', '$Telephone_number', '$Address', '$Post_code', '$Role', '$Parent_of');";

    // Check if the SQL statement was executed successfully
    if(mysqli_query($connect,$sql)) {
      echo "User added successfully!";
    } else {
      echo "Error: " . mysqli_error($connect);
    }
  }

  // Close the database connection
  mysqli_close($connect);
}
?>

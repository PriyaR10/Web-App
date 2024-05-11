<?php

include("db_connect.php");

$sql = "SELECT * FROM users_data WHERE role = 'swimmer'";
$result = mysqli_query($connect, $sql);
$swimmers = array();
while ($row = mysqli_fetch_assoc($result)) {
  $swimmers[] = array(
    'username' => $row['username']
    
  );
}

header('Content-Type: application/json');
echo json_encode($swimmers);

mysqli_close($connect);
?>
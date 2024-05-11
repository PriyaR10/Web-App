<?php
include("db_connect.php");
$query = "SELECT id FROM users_data WHERE id REGEXP '^sw[0-9]+$' ORDER BY CAST(SUBSTR(id, 3) AS UNSIGNED) DESC LIMIT 1;";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $last_id = $row["id"];
    echo ($last_id);

    // Increment the last ID to generate the new ID for the user
    $new_id = "sw" . strval(intval(substr($last_id, 2)) + 1);
   echo($new_id);
 ?>
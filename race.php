<?php
 include("session-timeout.php"); 
 ?>
<?php

// Prepare a SQL query to fetch unique race_date and stroke_type values from the race_performance table
$stmt = $connect->prepare("SELECT DISTINCT race_date, stroke_type FROM race_performance ORDER BY race_date ASC");

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if the form has been submitted
if (isset($_POST['submit'])) {

  // Get the selected race date and stroke type values
  $race_date = $_POST['race_date'];
  $stroke_type = $_POST['stroke_type'];

  // Prepare a SQL query to fetch the usernames and durations that match the selected race date and stroke type
  $stmt = $connect->prepare("SELECT username, duration FROM race_performance WHERE race_date = ? AND stroke_type = ? ORDER BY duration ASC");

  // Bind the parameters to the query
  $stmt->bind_param("ss", $race_date, $stroke_type);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();

  // Loop through the result set and update the position field based on the duration value
$position = 1;
while ($row = $result->fetch_assoc()) {
  $username = $row['username'];
  $duration = $row['duration'];

  // Prepare a SQL query to update the position field in the race_performance table
  $stmt = $connect->prepare("UPDATE race_performance SET position = ? WHERE race_date = ? AND stroke_type = ? AND username = ?");

  // Bind the parameters to the query
  $stmt->bind_param("isss", $position, $race_date, $stroke_type, $username);

  // Execute the query
  $stmt->execute();

  $position++;
}
  // Prepare a SQL query to fetch the usernames and positions that match the selected race date and stroke type
  $stmt = $connect->prepare("SELECT * FROM race_performance WHERE race_date = ? AND stroke_type = ? ORDER BY position");

  // Bind the parameters to the query
  $stmt->bind_param("ss", $race_date, $stroke_type);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="common-style.css" rel="stylesheet">

</head>
<body>

<table>
  <thead>
    <tr>
      <th>Race Date</th>
      <th>Stroke Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Loop through the result set and output each unique race_date and stroke_type combination as a row in the table
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['race_date'] . "</td>";
      echo "<td>" . $row['stroke_type'] . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<!-- Display the form with select boxes and submit button -->
<form method="POST">
  <label for="race_date">Race Date:</label>
  <select id="race_date" name="race_date">
    <?php
    // Reset the result set pointer back to the beginning
    $result->data_seek(0);

    // Loop through the result set again and output each race_date value as an option in the select list
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['race_date'] . "'>" . $row['race_date'] . "</option>";
    }
    ?>
  </select>

  <label for="stroke_type">Stroke Type:</label>
  <select id="stroke_type" name="stroke_type">
    <?php
    // Reset the result set pointer back to the beginning
    $result->data_seek(0);

    // Loop through the result set again and output each unique stroke_type value for the selected race_date
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['stroke_type'] . "'>" . $row['stroke_type'] . "</option>";
    }
    ?>
  
  </select>
  <input type="submit" name="submit" value="Update Positions">
</form>
<?php
// Check if the result set is not empty
if ($result->num_rows > 0) {
  // Display the table of usernames and positions
  echo "<table>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Username</th>";
  echo "<th>Duration (In_Seconds) </th>";
  echo "<th>Position</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  // Loop through the result set and output each username and position as a row in the table
    // Prepare a SQL query to fetch the usernames and positions that match the selected race date and stroke type
  $stmt = $connect->prepare("SELECT * FROM race_performance WHERE race_date = ? AND stroke_type = ? ORDER BY position");

  // Bind the parameters to the query
  $stmt->bind_param("ss", $race_date, $stroke_type);

  // Execute the query
  $stmt->execute();

  // Get the result set
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['duration'] . "</td>";
    echo "<td>" . $row['position'] . "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}
?>
</body>
</html>

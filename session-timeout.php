  <?php
include("db_connect.php");
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30)) {
    // last request was more than 30 seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    echo "<script>alert('Session timeout. Please login again.')</script>";
      echo "<script>window.location.href='login.php'</script>";
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
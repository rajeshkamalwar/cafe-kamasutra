<?php
/* Displays user information and some useful messages */

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Check if user is logged in using the session variable
if (isset($_COOKIE["name"])) {
      $name = $_COOKIE["name"];
      $_SESSION['name'] = $name;
}
else {
	header("location: index.php"); 
	exit;

    // Makes it easier to read
}
?>

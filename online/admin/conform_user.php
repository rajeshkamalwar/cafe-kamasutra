<?php
/* Displays user information and some useful messages */

// Check if user is logged in using the session variable
if (isset($_COOKIE["name"])) {
      $name = $_COOKIE["name"];
}
else {
	header("location: index.php"); 

    // Makes it easier to read
}
?>
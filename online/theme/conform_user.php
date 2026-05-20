<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( !isset($_SESSION['username']) ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $name = $_SESSION['username'];
}
?>
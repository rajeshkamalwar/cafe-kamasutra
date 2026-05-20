<?php
/* Log out process, unsets and destroys session variables */

require 'db.php';
include 'config.php';
$cookie_name = $_COOKIE["name"];
	setcookie("name", $name, time()-2*24*60*60); 


header("location:index.php");
?>

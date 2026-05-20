<?php
include 'admin/db.php';
session_start();
$npassword = md5($_POST['npassword']);
$queryget = $mysqli->query("update registeruser set password = '$npassword',confirmpassword='".$_POST['npassword']."' where email = '".$_SESSION['username']."' ");
header("location:logout.php");
?>
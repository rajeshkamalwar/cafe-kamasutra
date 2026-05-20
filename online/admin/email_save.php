
<?php
include 'db.php';
$email=$_POST['email'];
$sql="INSERT INTO `email_data` (`email`) VALUES ('$email')";
if ($mysqli->query($sql) === TRUE) {
    echo "data inserted";
}
else 
{
    echo "failed";
}
?>
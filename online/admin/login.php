<?php
/* User login process, checks if user exists and password is correct */

$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM users WHERE name='$username' and status = 'active' ");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['login_message'] = "User with that username doesn't exist!";
   // header("location: index.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( $_POST['password']=== $user['password'] ) {
         $login_time="UPDATE `users` SET `last_login`= NOW(),`login_status`='active' WHERE name='".$user['name']."'";
        $mysqli->query($login_time);
		 $name = $_POST['username'];
	$passowrd = $_POST['password'];
		echo $user_type = $user['user_type'];
   
	setcookie("name", $name, time()+12*60*60); 
	setcookie("passowrd", $passowrd, time()+12*60*60); 
	setcookie("user_type", $user_type, time()+12*60*60); 
	echo $_COOKIE["name"];
	echo $_COOKIE["passowrd"];
	echo $_COOKIE["user_type"];


        header("location: profile.php");
    }
    else {
        $_SESSION['login_message'] = "You have entered wrong password, try again!";
       
    }
}


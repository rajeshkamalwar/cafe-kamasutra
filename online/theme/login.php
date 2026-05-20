<?php
/* User login process, checks if user exists and password is correct */

$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM themelogin WHERE username='$username'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['login_message'] = "User with that username doesn't exist!";
   // header("location: index.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( $_POST['password']=== $user['password'] ) {
        $_SESSION['username'] = $user['username'];
        
        header("location: dashboard.php");
	    //echo "DONE";
    }
    else {
        $_SESSION['login_message'] = "You have entered wrong password, try again!";
        //header("location: index.php");
	    // echo "FAIL";
    }
}


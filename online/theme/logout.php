<?php
/* Log out process, unsets and destroys session variables */
ob_start();
session_start();
require 'db.php';
include 'config.php';
if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
    $logout_query = "UPDATE `users` SET `last_logout`= NOW(),`status`='inactive' WHERE name='" . $_SESSION['name'] . "'";
    $mysqli->query($logout_query);
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Logout</title>
        <?php include 'header.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    </head>

    <body class="hold-transition login-page" style="overflow-y: hidden;">
        <div class="login-box">
            <div class="login-logo">
                <a href="index.php"><b>Logo</b>here</a>
            </div>
            <div class="login-box-body">
                <div class="" style="text-align:center;">

                    <h3><i class="fa fa-check text-blue"></i> You have been logged out!</h3>
                    <h3>Thanks for visit!</h3>
                    <br/><a href="index.php"><button type="button" class="btn btn-primary">Go back to login</button></a>
                    <br/><br/>
                    <p>You will be redirected in for login in <span id="pageInfo">10</span> second(s).</p>
                    <script language="JavaScript" type="text/javascript">
                        var seconds = 10;
                        var url = "index.php";

                        function redirect() {
                            if (seconds <= 0) {
                                // redirect to new url after counter  down.
                                location.href = url;
                            } else {
                                seconds--;
                                document.getElementById("pageInfo").innerHTML = seconds;
                                setTimeout("redirect()", 1000);
                            }
                        }
                        redirect();
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
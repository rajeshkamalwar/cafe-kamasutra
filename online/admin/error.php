<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Error</title>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="error-page">
                    <div class="">
                        <h2>Oops!</h2>
                    </div>
                    <div class="">
                        <h3><i class="fa fa-warning text-yellow"></i> Something Went Wrong.</h3>
                    </div>
                    <p>
                        <?php
                        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
                            echo $_SESSION['message'];
                        else:
                            header("location: index.php");
                        endif;
                        ?>
                    </p>   
                    <br/>
                    <a href="index.php"><button type="button" class="btn btn-warning">Go Back To Home</button></a>
                </div>
            </div>
        </div>
    </body>
</html>

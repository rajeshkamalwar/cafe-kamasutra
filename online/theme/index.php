<?php 
ob_start();
session_start();
require 'db.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <?php include 'header.php';?>
  
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    
}

if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in']))
{
    header("location: dashboard.php");
}
?>
<body class="hold-transition login-page" style="overflow-y: hidden;">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>Logo</b>here</a>
        </div>
        
        <!-- /.login-logo -->
  <div class="login-box-body">
     
         
          <?php 
          if(isset($_SESSION['login_message']) && !empty($_SESSION['login_message']))
              {
                echo '<div id="session_msg" class="callout callout-danger">'.$_SESSION['login_message'].' </div>';
                $_SESSION['login_message']='';
              }
          ?>
        
      

    <form action="index.php" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input name="username" placeholder="Enter user name" required autocomplete="off" type="text" class="form-control" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label><input type="checkbox"> Remember Me</label>
                 
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="login"  type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->

    <!--<a href="#">I forgot my password</a><br>-->
    <!--<a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
        
    </div>
  <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

    <script src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="theme_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="theme_assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script type="text/javascript">
    $(function() {
    setTimeout(function() {
        $('#session_msg').delay(3000).fadeOut('1000')
    }, 5000);
});
</script>
</body>
</html>

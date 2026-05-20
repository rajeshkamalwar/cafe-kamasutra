<?php 
include 'admin/db.php';
session_start();
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
$errormsg = '';
if(isset($_POST['submit'])){
$newpassword = $_POST['newpassword'];
$newcpassword = $_POST['newcpassword'];
	if($newpassword==$newcpassword){
			$query = $mysqli->query("update registeruser set password = '".md5($newpassword)."',confirmpassword='".$newpassword."' where id = '".$_GET['token']."' ");
if ($current_lang == 'en') {
			$errormsg="Password change successfully";
			} else { 
			$errormsg="Wachtwoord succesvol gewijzigd.";	
			}
	} else { 
		if ($current_lang == 'en') {
			$errormsg="Password and confirm password not match.";
			} else { 
			$errormsg="Wachtwoord en bevestig wachtwoord komen niet overeen.";	
			}
	}

}
?>
<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	    <meta http-equiv="refresh" content="1200;url=fresh1.php" />
		<title> Online Order </title>
		<script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="jquery.redirect.js"></script>
		
		<style>
             .form-group {
             margin-bottom: 10px !important;
               }
         </style>
		
    </head>
    <body class="checkout_page2">
    <?php include 'public_header.php'; 
		if($current_lang=='dutch'){
			$forgetbutton = 'Wachtwoord opnieuw instellen';
		} else { 
			$forgetbutton = 'Reset Password';
		}
		
		?> 
        <div class="container checkoutpage rkgfi5 resetpass1">
            <?php

include 'css_file.php'; ?>

            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                currency = '<?php echo currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
                cop_cart_details_js = '';
            </script>
                   <div class="row">
					  
                        <div class="col-md-12">
							
							<h2><?php echo $forgetbutton;?></h2>
							
                          <form method="POST">
							  <p style="color:green;font-size: 22px;"><?php echo $errormsg; ?></p>
							  <label><?php echo $l_password?></label>
							  <input type="password" name="newpassword" id="newpassword" required>
							  <label><?php echo $cl_password?></label>
							  <input type="password" name="newcpassword" id="newcpassword" required>
							  <input type="submit" name="submit" value="<?php echo $forgetbutton;?>">
							</form>
					   </div>
					  
    </div>
  </div>
	</body>
	
<?php include 'public_footer.php'; ?>
</html>
		  
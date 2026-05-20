<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:online-order.php");
} else {
include 'admin/db.php';

if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
            $current_lang = $_SESSION['current_lang'];
if(isset($_POST['submit'])){
	$fname = $_POST['fname'];
				$lastname = $_POST['lastname'];
				$companyname = $_POST['companyname'];
				$housenumber = $_POST['housenumber'];
				$apartmentsuite = $_POST['apartmentsuite'];
				 $postcode = $_POST['postcodeedit'];
	
				$twolettersofyourPostcode = $_POST['twolettersofyourPostcode'];
				$townCity = $_POST['townCity'];
				$phonenumber = $_POST['phonenumber'];
				$emailaddress = $_POST['emailaddress'];
				$query = $mysqli->query("update tbl_user set usr_first_name = '$fname', usr_last_name = '$lastname', usr_company = '$companyname', usr_streetaddress1 = '$housenumber', usr_streetaddress2 = '$apartmentsuite', usr_zipcode = '$postcode', usr_zipcode2letter = '$twolettersofyourPostcode', usr_order_city = '$townCity', usr_order_phone = '$phonenumber', usr_emailid = '$emailaddress' where usr_id = '".$_POST['userid']."' ");
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
			$editbtn = 'Bijwerken';
			$dltbtn = 'Verwijderen';
			$editaddres = "verander adres";

		} else { 
			$editbtn = 'Edit';
			$dltbtn = 'Delete';
			$editaddres = "Edit Address";
		}
		
		?> 
        <div class="container checkoutpage rkgfi5">
            <?php

include 'css_file.php'; ?>

            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                currency = '€ ';
                current_lang = '<?php echo $current_lang; ?>';
                cop_cart_details_js = '';
            </script>
			<h2><?php echo $profile;?></h2>
                   <div class="row">
					   <?php $queryadd = $mysqli->query("select * from tbl_user where regisid = '".$_SESSION['username']."' ");
					         while($row_user = $queryadd->fetch_array()){
					   ?>
                        <div class="col-md-4">
							<div class="fffffer">
							 <div class="info-box-content box-profile44">
              <span class="info-box-text"><?php echo $row_user['usr_first_name']; ?></span><br/>
              <span class="info-box-text"><?php echo $row_user['usr_streetaddress1']; ?> <br/> <?php echo $row_user['usr_zipcode']; ?> <?php echo $row_user['usr_zipcode2letter'];?> <?php echo $row_user['usr_order_city']; ?></span>	<br/>
								 <span ><?php echo $row_user['usr_order_phone'];?></span><br><span><?php echo $row_user['usr_emailid'];?></span></div>
							<button type="button" class="btn btn-danger btn-sm delete" data-id="<?php echo $row_user['usr_id']; ?>"><?php echo $dltbtn; ?></button>
							<button type="button" class="btn btn-primary new-address" data-toggle="modal" data-target="#myModaladdress<?php echo $row_user['usr_id']; ?>"><?php echo $editbtn; ?></button></div>
    </div>
					   <div class="modal fade" id="myModaladdress<?php echo $row_user['usr_id']; ?>" role="dialog">
    <div class="modal-dialog">
					   <div class="modal-content profile-page33">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $editaddres; ?></h4>
        </div>
		  <form method="POST">
			  <input type="hidden" name="userid" id="userid" value="<?php echo $row_user['usr_id']; ?>" >
        <div class="modal-body">
          <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label ><?php echo $L_Firstname; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row_user['usr_first_name']; ?>" required>
                                        </div>
                                        
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Companyname; ?></label>
                                            <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $row_user['usr_company']; ?>" required>
                                        </div>
                                    </div>
                                </div>
								  <?php if ($_SESSION['current_pick'] != "pickup")  { ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Streetaddress; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="housenumber" name="housenumber" value="<?php echo $row_user['usr_streetaddress1']; ?>" placeholder="<?=$L_Streetaddress_placeholder ?>" required></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Postcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="postcodeedit" name="postcodeedit" value="<?php echo $row_user['usr_zipcode']; ?>" readonly  >
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_TwolettersofyourPostcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="twolettersofyourPostcode" name="twolettersofyourPostcode" maxlength="2"  minlength="2" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row_user['usr_zipcode2letter']; ?>"  required>&nbsp;<span id="chk_postcode_editmsg"></span>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_TownCity; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="townCity" name="townCity" value="<?php echo $row_user['usr_order_city']; ?>" required>
                                        </div>
                                    </div>
                                </div>
								<?php  } ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Phone; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $row_user['usr_order_phone']; ?>" maxlength="10" required>&nbsp;<span id="CoC_Phone_edimsg" required></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Emailaddress; ?><span class="required">*</span></label>
                                            <input type="email" class="form-control" id="emailaddress" name="emailaddress" value="<?php echo $row_user['usr_emailid']; ?>" required><span id="CoC_Emailaddress_errmsg" required></span>
                                        </div>
                                    </div>
                                </div> 
        </div>
        <div class="modal-footer">
			<button type="submit" name="submit" class="btn btn-primary" ><?php echo $editbtn;?></button>
        </div>
		  </form>
      </div>
						   </div></div>
					   <?php } ?>
  </div>
		</div>
		
      

	</body>
	
<?php include 'public_footer.php'; ?>
	<script type="text/javascript">
                        
                        $(document).ready(function () {
  $("#twolettersofyourPostcode").keypress(function (e) {
     if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
        $("#chk_postcode_editmsg").html("Alphabates Only").show().fadeOut("slow");
        return false;
    }
   });
   $("#phonenumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#CoC_Phone_edimsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });
							 
});
		</script>
	 <script type="text/javascript">
				$(document).ready(function() {
				$(document).on("click", ".delete", function() { 
		var $ele = $(this).parent().parent();
					//alert($(this).attr("data-id"));
		$.ajax({
			url: "delete_ajax.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).attr("data-id")
			},
			success: function(dataResult){
				location.reload();
				
			}
		});
	});
});
	</script>
</html>
	<?php	  }?>
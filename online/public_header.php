
<?php
session_start();
ob_start();
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
include 'admin/db.php';
require_once 'admin/config.php';
if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="en";}
            $current_lang = $_SESSION['current_lang'];
			 if ($current_lang == "dutch") {
                $home = 'HOME';$home_url="https://restaurantkamasutra.nl/nl";
				 $overons = 'OVER ONS';$overons_url="https://restaurantkamasutra.nl/nl/over-ons"; 
				 $menu = 'MENU';$menu_url="https://restaurantkamasutra.nl/nl/menu"; 
				 $reservation = 'RESERVEREN';$reservation_url="https://restaurantkamasutra.nl/nl/reservering"; 
				$online = 'BESTEL ONLINE';$online_url="https://restaurantkamasutra.nl/online/online-order.php";
				$information = 'INFORMATIE';$information_url="https://restaurantkamasutra.nl/nl/informatie/";
				//$review = 'BEOORDELING';$review_url="https://restaurantkamasutra.nl/online/feedback.php";
				 $gallery = 'GALERIJ';$gallery_url="https://restaurantkamasutra.nl/nl/galerij/"; 
				 $catering = 'CATERING';$catering_url="https://restaurantkamasutra.nl/nl/catering/";
				$contact = 'CONTACT';$contact_url="https://restaurantkamasutra.nl/nl/contact/";
				$bookatable='KORTING';$bookatable_url='https://restaurantkamasutra.nl/online/online-order.php';
				$infobtn='INFORMATIE';$infobtn_url='https://restaurantkamasutra.nl/nl/informatie/';
				$L_Firstname = "Uw Naam ";
    			$L_Lastname = "Achternaam";
    			$L_Companyname = "Bedrijfsnaam (optioneel)";
    			$L_Streetaddress = "Straatnaam";
    			$L_Postcode = "Postcode";
    			$L_TwolettersofyourPostcode = "2 letters";
   				$L_TownCity = "Plaats";
   				$L_Phone = "Telefoon";
    			 $L_Emailaddress = "E-mailadres";
				 $l_password = "wachtwoord";
				 $cl_password = "bevestig je wachtwoord";
				 $signin = "Inloggen";
				 $register = "Registreren";
				 $createaccount = "Account aanmaken";
				 $chnagepassword = "Wachtwoord wijzigen";
				 $logout = "Uitloggen";
				 $orders = "Bestellingen";
				 $profile = "Profiel";
				 $forgetpassword = "Wachtwoord vergeten ?";

            } else {
				$home = 'HOME';$home_url=site_base_url;
				 $overons = 'ABOUT US';$overons_url=site_base_url . 'about-us/'; 
				 $menu = 'MENU';$menu_url=site_base_url . 'menu/'; 
				$online = 'Order Online';$online_url=online_base_url . 'online-order.php';
				$information = 'INFORMATION';$information_url=site_base_url . 'information/';
				 $reservation = 'RESERVATION';$reservation_url=site_base_url . 'reservation/';
				//$review = 'REVIEW';$review_url=online_base_url . 'feedback.php';
				 $catering = 'CATERING';$catering_url=site_base_url . 'catering/';
				 $gallery = 'GALLERY';$gallery_url=site_base_url . 'gallery/'; 
				$contact = 'CONTACT';$contact_url=site_base_url . 'contact/';
				$bookatable='Discount';$bookatable_url=online_base_url . 'online-order.php';
				$infobtn='INFORMATION';$infobtn_url=site_base_url . 'information/';
				$L_Firstname = "Your name";
   				$L_Lastname = "Last name";
    $L_Companyname = "Company name (optional)";
    $L_Streetaddress = "Street address";
    $L_Postcode = "Postcode / ZIP";
    $L_TwolettersofyourPostcode = "2 letters";
    $L_TownCity = "Town / City";
    $L_Phone = "Phone";
    $L_Emailaddress = "Email address";
				 $l_password = "Password";
				 $cl_password = "Confirm Password";
				 $signin = "Login";
	$register = "Register";
				 $createaccount = "Create account";
				 $chnagepassword = "Change Password";
				 $logout = "Logout";
				 $orders = "Orders";
				 $profile = "Profile";
				 $forgetpassword = "Forget Password ?";
            }


 $query = "Select * From `adm_set`";
        $result_query = $mysqli->query($query);
//        $row = $result_query->fetch_assoc();
        $data1=array();
        while ($row = $result_query->fetch_assoc()) {
          $data1[$row['adm_set_name']] = $row['adm_set_vlu'];		
        }
	 $rest_rest_title = $data1['rest_title'];
     $rest_addrss_main = $data1['rest_addrss'];
	 $rest_postcode_main = $data1['rest_postcode'];
	 $res_rest_city = $data1['rest_city'];
	 
	 $res_email_main = $data1['rest_email'];
	 $rest_weblink_main = $data1['rest_weblink'];
	 $res_rest_contact2 = $data1['rest_contact2'];
	 $rest_info = $data1['rest_email'];



	$data2=array();
	$query = "Select * From `head_settings`";
		$result_query = $mysqli->query($query);									
			while ($row = $result_query->fetch_assoc()) {							 
			$data2[$row['settings_name']] = $row['sett_data'];
		}		
 
?>
	<div class="top_box">
    <div class="top_strip">
        <div class="left_div"><a href="<?php echo $infobtn_url;?>"><?php echo $infobtn;?></a>&nbsp;
			<?php 
			$disrow2 = array( 'active' => 0, 'title1' => 'Discount', 'title_nl' => 'Korting' );
			$disrow  = array();
			$discount_result = $mysqli->query( 'SELECT * FROM discount LIMIT 1' );
			if ( $discount_result ) {
				$row = $discount_result->fetch_assoc();
				if ( is_array( $row ) ) {
					$disrow2 = $row;
				}
			}
			$discount_result = $mysqli->query( 'SELECT * FROM discount_description LIMIT 1' );
			if ( $discount_result ) {
				$row = $discount_result->fetch_assoc();
				if ( is_array( $row ) ) {
					$disrow = $row;
				}
			}
		if ( ! empty( $disrow2['active'] ) && (int) $disrow2['active'] === 1 ) {
		?>
			<a href="#"  id="show-msgpop"><?php  if ($current_lang == "dutch") { echo $disrow2['title_nl'];} else { echo $disrow2['title1']; }?>	</a>
			<?php } ?>
			&nbsp;
			<?php if(!isset($_SESSION['username'])){?>
        <button class="loginpopup"><?php echo $signin;?>/<?php echo $register;?></button>
			<?php } else { 
			$squery = $mysqli->query("select * from registeruser where email = '".$_SESSION['username']."' ");
			$srow = $squery->fetch_array();
			?>
			<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $srow['name'];?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="orders.php"><?php echo $orders;?></a></li>
	   <li><a href="profile.php"><?php echo $profile;?></a></li>
	   <li><a class="btn btn-info btn-lg" data-toggle="modal" data-target="#mychangepasswordModal"><?php echo $chnagepassword;?></a></li>
    <li><a href="logout.php"><?php echo $logout;?></a></li>
  </ul>
			</div>
			
			<?php } ?>
		</div>
	
  

        <div class="right_div">
            <div id="loksoc" class="icon-45">
               <ul class="social">
                   <li class="facebook"><a href="https://www.facebook.com/Indian-Restaurant-Kamasutra-147277418692561/" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                     <li class="instagram"><a href="https://www.instagram.com/restaurantkamasutra/" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				    <li class="twitter"><a href="https://twitter.com/RestaurantKama1" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li class="custom"><a href="https://api.whatsapp.com/send?phone=+31650683989&amp;text=" target="_blank"><i class="fa fa-whatsapp"></i></a></li>	
                </ul>
             <ul class="lang_flag">
					<li class="nl">
                        <a href="<?php echo online_base_url; ?>setlang.php?action=en&cpage=<?php echo $curPageName; ?>" class="wpml-ls-link" ><img src="<?php echo online_base_url; ?>en.png"></a>
                    </li>
                    <li class="en">
                        <a href="<?php echo online_base_url; ?>setlang.php?action=dutch&cpage=<?php echo $curPageName; ?>" class="wpml-ls-link" ><img src="<?php echo online_base_url; ?>nl.png"></a>
                    </li>   
				 
                </ul>  
            </div>
        </div>
    </div>
    <div class="logo_strip">
        <a id="logo" href="<?php echo site_base_url; ?>">
			<img src="<?php echo $data2['logo'];?>" class="logo_cls" ></a>
    </div>
    <div class="menu_strip">
        <div class="main_menu">
            <div class="topnav" id="myTopnav">
                <a href="<?php echo $home_url;?>">
                    <?php echo $home;?>
                </a>
				 <a href="<?php  echo $overons_url;?>">
                    <?php  echo $overons;?>
                </a> 
				<a href="<?php echo $menu_url;?>">
                    <?php echo $menu;?>
                </a>
				<a href="<?php echo $online_url;?>">
                    <?php echo $online;?>
                </a>
				<a href="<?php echo $reservation_url;?>">
                    <?php echo $reservation;?>
                </a>
				<a href="<?php echo $catering_url;?>">
                    <?php echo $catering;?>
                </a>
				<a href="<?php echo $gallery_url;?>">
                    <?php echo $gallery;?>
                </a>
                 
				 
                <a href="<?php echo $contact_url;?>">
                    <?php echo $contact;?>
                </a>
                <a href="javascript:void(0);" class="icon menu22 " onclick="myFunction()"><i class="fa fa-bars"></i></a>
            </div>
    
    <?php 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $key = 'online-order.php'; 
  
if (strpos($actual_link, $key) == true) { 
	
	
?>
    	<a href="javascript:void(0);" class="icon dish_cat_icon  fix_menu_mob" ><i class="fa fa-cutlery"></i></a>
        <div id="aadd" class="footer-cart"  style="display:none;"><a href="javascript:void(0);" class="icon cart_icon fix_menu_mob2 "  ><i class="fa fa-shopping-cart"><span class="toprodqty"></span></i><p class="Prise" id="jghjkhg"> Total: <span class="total_price"></span></p></a>
			</div>
<?php } ?>
        <button onclick="topFunction()" id="myBtntopbtn" title="Top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
		<div class="modal fade" id="mychangepasswordModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content changepass" style="width: 523px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $chnagepassword; ?></h4>
        </div>
		  <form method="POST" >
			  <div class="col-md-12" id="return_string12"></div>
        <div class="modal-body">
			<label><?php echo $l_password;?></label>
			  <input type="password" name="npassword" id="npassword" class="form-control">
			<span id="npasserror"></span>
			<label><?php echo $cl_password;?></label>
			<input type="password" name="ncpassword" id="ncpassword" class="form-control">
			<span id="ncpasserror"></span>
        </div>
        <div class="modal-footer">
			<input type="submit" id="changepass" value="<?php echo $chnagepassword; ?>">
        </div>
		  </form>
      </div>
      
    </div>
  </div>
<div class="main-popup" style="height: auto;">
  <div class="popup-header">
    <div id="popup-close-button"><a href="#"></a></div>
    <ul>
      <li><a href="#" id="sign-in"><?php echo $signin; ?></a></li>
      <li><a href="#" id="register"><?php echo $register;?></a></li>
    </ul>
  </div><!--.popup-header-->
  <div class="popup-content" >
    <form method="POST" class="sign-in">
		  <p id="loginnotification"></p>
		<div class="col-md-12" id="error_loginpanel"></div>
      <label for="email"><?php echo $L_Emailaddress;?>:</label>
      <input type="email" id="username" name="username" >
      <label for="password"><?php echo $l_password;?>:</label>
      <input type="password" id="userpassword" name="userpassword" >
      <p >
		  <a href="forgetpassword.php"> <?php echo $forgetpassword; ?> </a>
      </p>
      <input type="submit" id="login" value="<?php echo $signin;?>">
    </form>
  
     <form method="post" class="register">
	  <p id="return_string1"></p>
		   <div class="col-md-12" id="error_regpanel"></div>
		 <div class="row">
			 <div class="col-sm-6">
		  <label for="name-register"><?php echo $L_Firstname;?>:</label>
      <input type="text" id="name" name="name" >
			 </div>
			 <div class="col-sm-6">
      <label for="email-register"><?php echo $L_Emailaddress;?>:</label>
				  <input type="text" id="email" name="email" >
			 </div></div>
			  <div class="row">
			 <div class="col-sm-6">
     
      <label for="password-register"><?php echo $l_password;?>:</label>
				 <input type="password" id="password" name="password" >
				 </div><div class="col-sm-6">
      
      <label for="password-confirmation"><?php echo $cl_password;?>:</label>
      <input type="password" id="cpassword" name="cpassword" >
				  </div></div>
				  <div class="row">
			 <div class="col-sm-6">
		 <label for="name-register"><?php echo $L_Companyname;?>:</label>
      <input type="text" id="cname" name="cname" required>
					  </div><div class="col-sm-3">
		 <label for="name-register"><?php echo $L_Postcode;?>:</label>
      <input type="text" id="postcode" name="postcode" pattern="\d{4}" maxlength="4">
					  <span id="postcode_regerrmsg"></span>
					  <span id="postcode_response"></span>
				  </div>
		 <div class="col-sm-3">
		 <label for="name-register"><?php echo $L_TwolettersofyourPostcode;?>:</label>
      <input type="text" id="2letter" name="2letter"  maxlength="2" oninput="this.value = this.value.toUpperCase()">
				 <span id="chk_postcode_regmsg"></span>
				  </div>
		 </div>
				  <div class="row">
			 <div class="col-sm-6">
		 <label for="name-register"><?php echo $L_Streetaddress;?>:</label>
      <input type="text" id="streetaddress" name="streetaddress" >
				 </div>
		  <div class="col-sm-6">
		 <label for="name-register"><?php echo $L_TownCity;?>:</label>
      <input type="text" id="city" name="city" required>
					 </div></div>
				 <div class="row">
			 <div class="col-sm-6">
		 <label for="name-register"><?php echo $L_Phone;?>:</label>
      <input type="text" id="phone" name="phone"  maxlength="10"><span id="CoC_Phone_regmsg"></span>
					 </div></div>
      <input type="submit" id="regiteruser" value="<?php echo $createaccount; ?>">
				 
				 
    </form>
  </div><!--.popup-content-->
</div><!--.main-popup-->


</div>
            </div>
	</div>		
	
	
	<br/><br/>
	
	
		
<div class="top_header">
	
</div>

<style>
 
    
</style>
<script type="text/javascript">

                        $(document).ready(function () {
  $("#2letter").keypress(function (e) {
     if ((e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)) {
        $("#chk_postcode_regmsg").html("Alphabates Only").show().fadeOut("slow");
        return false;
    }
   });
   $("#phone").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#CoC_Phone_regmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });
							 
});
             $("#postcode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        if(current_lang=='dutch')
        {$("#postcode_regerrmsg").html("alleen cijfer").show().fadeOut("slow");}else{$("#postcode_regerrmsg").html("Digits Only").show().fadeOut("slow");}
               return false;
    }
   });
	$(document).ready(function(){

   $("#postcode").keyup(function(){

      var postcode = $(this).val().trim();
      if(postcode != ''){

         $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {postcode: postcode},
            success: function(response){
      
                $('#postcode_response').html(response);

             }
         });
      }else{
         $("#postcode_response").html("");
      }

    });

 });
	$(document).on('click', '#regiteruser', function (e) {
		e.preventDefault();
		var error_msg = "";
                            $("#error_regpanel").hide();
                            if ($("#name").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<b>Billing address First name</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<b>Factuuradres Voornaam</b> is een verplicht veld.";
                                }
                                $("#name").addClass('error_control');
                            } else {
                                $("#name").removeClass('error_control');
                            }
if ($("#password").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<b>Password</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<b>wachtwoord</b> is een verplicht veld.";
                                }
                                $("#password").addClass('error_control');
                            } else {
                                $("#password").removeClass('error_control');
                            }
		if ($("#cpassword").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<b>Confirm password</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<b>Bevestig wachtwoord </b> is een verplicht veld.";
                                }
                                $("#cpassword").addClass('error_control');
                            } else {
                                $("#cpassword").removeClass('error_control');
                            }

                            if ($("#streetaddress").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Street address</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Straat en huisnummer</b> is een verplicht veld.";
                                }
                                $("#streetaddress").addClass('error_control');
                            } else {
                                $("#streetaddress").removeClass('error_control');
                            }

                    if ($("#postcode").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Postcode / ZIP</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Postcode</b> is een verplicht veld.";
                                }
                                $("#postcode").addClass('error_control');
                            } else {
                                $("#postcode").removeClass('error_control');
                            }

                            if ($("#2letter").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Two letters of your Postcode</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Twee letters van uw Postcode</b> is een verplicht veld.";
                                }
                                $("#2letter").addClass('error_control');
                            } else {
                                $("#2letter").removeClass('error_control');
                            }

                            if ($("#city").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Town / City</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Plaats</b> is een verplicht veld.";
                                }
                                $("#city").addClass('error_control');
                            } else {
                                $("#city").removeClass('error_control');
                            }

                            if ($("#phone").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Phone</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Telefoon</b> is een verplicht veld.";
                                }
                                $("#phone").addClass('error_control');
                            } else {
                                $("#phone").removeClass('error_control');
                            }
 
						var x = $('#email').val();
	var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
							if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Email address</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres E-mailadres</b> is een verplicht veld.";
                                }
                                $("#email").addClass('error_control');
                            } else {
                                $("#email").removeClass('error_control');
                            }




                            //console.log(error_msg);
                            if (error_msg != '') {
                                $("#error_regpanel").html('');
                                $("#error_regpanel").show();
                                $("#error_regpanel").html(error_msg);
                                //$('html, body').animate({scrollTop: $("#error_regpanel").offset().top}, 500);
                                return false;
                            }

		              var name = $("#name").val();
                      var email = $("#email").val();  //console.log(id);
                      var password = $("#password").val();
		              var cpassword = $("#cpassword").val();
		var cname = $("#cname").val();
		var postcode = $("#postcode").val();
		var twoletter = $("#2letter").val();
		var streetaddress = $("#streetaddress").val();
		var city = $("#city").val();
		var phone = $("#phone").val();
		if(password!=cpassword){
			if (current_lang == 'en') {
			 $('#return_string1').html("Password and confirm password not match.");
			} else { 
			$('#return_string1').html("Wachtwoord en bevestig wachtwoord komen niet overeen.");	
			}
			return false;
			
		}
		var poid = $("input[name=poid]").val();
if (poid == "notavailable") {
	if (current_lang == 'en') {
      alert("We do not deliver to this zip code area");
	} else { 
		alert("Wij bezorgen niet in deze postcodegebied");
	}
      $("input[name=poid]").focus();
      return false;
    }
		            url = b_url1 + 'registeruser.php';  
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {name:name,email: email, password: password, cpassword:cpassword,cname:cname,postcode:postcode,twoletter:twoletter,streetaddress:streetaddress,city:city,phone:phone},
                        dataType: "html",
                        success: function (data)
                        {
							console.log(data);
							var successmg = 1;
							if(data!=successmg){
								$('#return_string1').html(data);
							} else { 
                            //$('#return_string1').html(data);
							location.reload();
							}
                        }
                    });
                });
	$(document).on('click', '#login', function (e) {
		e.preventDefault();
		var error_msg1 = "";
	$("#error_loginpanel").hide();
	var x = $('#username').val();
	var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf(".");  
							if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                                if (current_lang == 'en') {
                                    error_msg1 = error_msg1 + "<br/><b>Email address</b> is a required field.";
                                } else {
                                    error_msg1 = error_msg1 + "<br/><b>E-mailadres</b> is een verplicht veld.";
                                }
                                $("#username").addClass('error_control');
                            } else {
                                $("#username").removeClass('error_control');
                            }
                           if ($("#userpassword").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg1 = error_msg1 + "<b>Password</b> is a required field.";
                                } else {
                                    error_msg1 = error_msg1 + "<b>Wachtwoord</b> is een verplicht veld.";
                                }
                                $("#userpassword").addClass('error_control');
                            } else {
                                $("#userpassword").removeClass('error_control');
                            }
		//console.log(error_msg);
                            if (error_msg1 != '') {
                                $("#error_loginpanel").html('');
                                $("#error_loginpanel").show();
                                $("#error_loginpanel").html(error_msg1);
                                //$('html, body').animate({scrollTop: $("#error_regpanel").offset().top}, 500);
                                return false;
                            }
                      var username = $("#username").val();  //console.log(id);
                      var userpassword = $("#userpassword").val();
		
		
			  
		 
		            url = b_url1 + 'loginuser.php';  
		
                  $.ajax({
                        type: "POST",
                        url: url,
                        data: {username: username, userpassword: userpassword},
                        dataType: "html",
                        success: function (data){
							
							var matchdata = 1;
							if(data!=matchdata){
                            $('#loginnotification').html(data);
							} else { 
							location.reload();
							}
                        }
                    }); 
                });
	$(document).on('click', '#changepass', function (event) {
		event.preventDefault();
		
                            
                           if ($("#npassword").val() == "") {
                                if (current_lang == 'en') {
                                    $('#npasserror').html("<b>Password</b> is a required field.");
                                } else {
									$('#npasserror').html("<b>wachtwoord</b> is een verplicht veld.");
                                }
                               
                            } 
		if ($("#ncpassword").val() == "") {
                                if (current_lang == 'en') {
									 $('#ncpasserror').html("<b>Confirm Password</b> is a required field.");
                                } else {
									$('#ncpasserror').html("<b>bevestig wachtwoord</b> is een verplicht veld.");
                                }
                                
                            } 
		
                      var ncpassword = $("#ncpassword").val();  //console.log(id);
                      var npassword = $("#npassword").val();
		if(ncpassword!=npassword){
			if (current_lang == 'en') {
			 $('#return_string12').html("Password and confirm password not match.");
			} else { 
			$('#return_string12').html("Wachtwoord en bevestig wachtwoord komen niet overeen.");	
			}
			return false;
			
		}
		            url = b_url1 + 'changepassword.php';  
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {npassword: npassword},
                        dataType: "html",
                        success: function (data)
                        {
							
							var matchdata = 1;
							if(data!=matchdata){
                            location.reload();
							} else { 
							location.reload();
							}
                        }
                    });
                });
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
	/*Title: Cool Modal Popup Sign In/Out Form*/

$(function() {
  //defining all needed variables
  var $overlay = $('.overlay');
  var $mainPopUp = $('.main-popup')
  var $signIn = $('#sign-in');
  var $register = $('#register');
  var $formSignIn = $('form.sign-in');
  var $formRegister = $('form.register');
  
  var $firstChild = $('nav ul li:first-child');
  var $secondChild = $('nav ul li:nth-child(2)');
  var $thirdChild = $('nav ul li:nth-child(3)');
  
  //defining function to create underline initial state on document load
/* function initialState() {
    $('.underline').css({
      "width": $firstChild.width(),
      "left": $firstChild.position().left,
      "top": $firstChild.position().top + $firstChild.outerHeight(true) + 'px'
    });
  }*/
  //initialState(); //() used after calling function to call function immediately on doc load
  
  //defining function to change underline depending on which li is active
  function changeUnderline(el) {
    $('.underline').css({
      "width": el.width(),
      "left": el.position().left,
      "top": el.position().top + el.outerHeight(true) + 'px'
    });
  } //note: have not called the function...don't want it called immediately
  
  $firstChild.on('click', function(){
    var el = $firstChild;
    changeUnderline(el); //call the changeUnderline function with el as the perameter within the called function
    $secondChild.removeClass('active');
    $thirdChild.removeClass('active');
    $(this).addClass('active');
  });
  
  $secondChild.on('click', function(){
    var el = $secondChild;
    changeUnderline(el); //call the changeUnderline function with el as the perameter within the called function
    $firstChild.removeClass('active');
    $thirdChild.removeClass('active');
    $(this).addClass('active');
  });
  
  $thirdChild.on('click', function(){
    var el = $thirdChild;
    changeUnderline(el); //call the changeUnderline function with el as the perameter within the called function
    $firstChild.removeClass('active');
    $secondChild.removeClass('active');
    $(this).addClass('active');
  });
  
  
  $('.loginpopup').on('click', function(){
    $overlay.addClass('visible');
    $mainPopUp.addClass('visible');
    $signIn.addClass('active');
    $register.removeClass('active');
    $formRegister.removeClass('move-left');
    $formSignIn.removeClass('move-left');
  });
  $overlay.on('click', function(){
    $(this).removeClass('visible');
    $mainPopUp.removeClass('visible');
  });
  $('#popup-close-button a').on('click', function(e){
    e.preventDefault();
    $overlay.removeClass('visible');
    $mainPopUp.removeClass('visible');
  });
  
  $signIn.on('click', function(){
    $signIn.addClass('active');
    $register.removeClass('active');
    $formSignIn.removeClass('move-left');
    $formRegister.removeClass('move-left');
  });
  
  $register.on('click', function(){
    $signIn.removeClass('active');
    $register.addClass('active');
    $formSignIn.addClass('move-left');
    $formRegister.addClass('move-left');
  });
	  $('#show-msgpop').on('click', function(e){
   	 e.preventDefault();
        $('#my-welcome-message').fadeIn(100);
	    $('#fvpp-close').fadeIn(100);
  });
	
 
  
  $('input').on('submit', function(e){
    e.preventDefault(); //used to prevent submission of form...remove for real use
  });
});
</script>




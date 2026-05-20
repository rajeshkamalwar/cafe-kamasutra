<?php
include 'admin/db.php';
if(isset($_POST['submit'])){
$name = $_POST['name'];	
$email = $_POST['email'];	
$quality_rating = $_POST['quality_rating'];	
$delivery_rating = $_POST['delivery_rating'];	
$comment = $_POST['comment'];
$recaptcha = $_POST['g-recaptcha-response'];
$secret_key = '6LeXi1woAAAAAJUZBFqIwNGAA_zpoHo_U5zer4wU';
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $recaptcha;	
$response = file_get_contents($url);
$response = json_decode($response);	
if ($response->success == true) {
        
	 $add_attrrib_query = $mysqli->query("INSERT INTO `review`(`name`, `quality_rating`, `delivery_rating`,`comment`,`email`) VALUES ('$name','$quality_rating','$delivery_rating','$comment','$email')");
	$message222 ="Bedankt voor uw feedback.";
	$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
$rest_title= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_title'")->fetch_object()->adm_set_vlu;
$rest_addrss= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_addrss'")->fetch_object()->adm_set_vlu;
$rest_postcode= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode'")->fetch_object()->adm_set_vlu;
$rest_postcode_two= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode_two'")->fetch_object()->adm_set_vlu;
$rest_city= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_city'")->fetch_object()->adm_set_vlu;
$rest_cont= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_cont'")->fetch_object()->adm_set_vlu;

$subject = 'Restaurant Kamasutra ';
$message = ' 
<h3>Dear '.$name.' </h3>
<p>Thank You for feedback </p>

<br/><br/>
'.$rest_title.'<br/>
'.$rest_addrss.',<br/>
'.$rest_postcode.' '.$rest_postcode_two.'  '.$rest_city.'<br/>
Telephone: '.$rest_cont.'<br/>
'.$From_Email_Address.'<br/>
www.restaurantkamasutra.nl
';
$to_id=$email;
//$to_id='jyoti@digipanda.co.in';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
	
echo "<script>alert('$message222');
window.location.href='https://restaurantkamasutra.nl/online/online-order.php';

</script>";
}
	else {
        echo '<script>alert("Error in Google reCAPTACHA")</script>';
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
        <link rel="stylesheet"   href="custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="jquery.redirect.js"></script>
		<script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
    </head>
    <body class="checkout_page2 reviewpage33">
    <?php include 'public_header.php'; 
		if($current_lang=='dutch'){
			$review = 'Beoordelingen';
			$qualityrating = 'Kwaliteit';
			$deliveryrating = 'Bezorging';
			$comment = 'Commentaar';
			$submit = 'Verzenden';
		} else { 
			$review = 'Reviews';
			$qualityrating = 'Quality Rating';
			$deliveryrating = 'Delivery Rating';
			
			$comment = 'Comment';
			$submit = 'submit';
		}
		
		?> 
        <div class="container checkoutpage rkgfi5 forgetpass reviews-page">
            <?php include 'css_file.php'; ?>

           <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                /*currency = '<?php ///echo currency . ' '; ?>';*/
                current_lang = '<?php echo $current_lang; ?>';
                cop_cart_details_js = '';
            </script>
                   <div class="row">
					   <h2 class="headrrr"><?php echo $review; ?></h2>   
					   
					   <div class="form-999">
						  <form method="POST" class="form888">
							  <div class="reviw-row">
							  <input type="text" name="name" placeholder = "<?php echo $L_Firstname; ?>" required >
								  </div>
							   <div class="reviw-row">
							  <input type="email" name="email" placeholder = "<?php echo $L_Emailaddress;?>" required >
								   </div>
							 <div class="rr"> <p><?php echo $qualityrating; ?></p><div class="rating">
            <input id="star5" name="quality_rating" type="radio" value="5" class="radio-btn hide" />
            <label for="star5" >☆</label>
            <input id="star4" name="quality_rating" type="radio" value="4" class="radio-btn hide" />
            <label for="star4" >☆</label>
            <input id="star3" name="quality_rating" type="radio" value="3" class="radio-btn hide" />
            <label for="star3" >☆</label>
            <input id="star2" name="quality_rating" type="radio" value="2" class="radio-btn hide" />
            <label for="star2" >☆</label>
            <input id="star1" name="quality_rating" type="radio" value="1" class="radio-btn hide" />
            <label for="star1" >☆</label>
            <div class="clear"></div>
        </div> </div>
								 <div class="rr">
							  <p class="review11"><?php echo $deliveryrating; ?></p>
							  <div class="delrating">
            <input id="delstar5" name="delivery_rating" type="radio" value="5" class="radio-btndel hide" />
            <label for="delstar5" >☆</label>
            <input id="delstar4" name="delivery_rating" type="radio" value="4" class="radio-btndel hide" />
            <label for="delstar4" >☆</label>
            <input id="delstar3" name="delivery_rating" type="radio" value="3" class="radio-btndel hide" />
            <label for="delstar3" >☆</label>
            <input id="delstar2" name="delivery_rating" type="radio" value="2" class="radio-btndel hide" />
            <label for="delstar2" >☆</label>
            <input id="delstar1" name="delivery_rating" type="radio" value="1" class="radio-btndel hide" />
            <label for="delstar1" >☆</label>
            <div class="clear"></div>
        </div></div>
							  
						 <div class="reviw-row textar">  <textarea name="comment" id="comment" placeholder="<?php echo $comment;?>" required></textarea> </div>
							  
							  <div class="g-recaptcha" data-sitekey="6LeXi1woAAAAAO16o0U3O7b95nXjzf1C0oayVhtD" style="margin-top:10px">
            </div>
							<div class="reviw-row submit-row">  <input type="submit" name="submit" value="<?php echo $submit;?>"> </div>
						   </form>
					   </div>
					   
    </div>
			
			
	<div class="row reviews555">
					   <h2>Recent Review From Restaurant Kamasutra </h2>   
					   <?php 
					         $query = $mysqli->query("select * from review where status = '1' order by id desc"); 
					         while($row = $query->fetch_array()){
								 $datetime = $row['ddate'];
								 $dt = strtotime($datetime); //make timestamp with datetime string
								 $mdate = date("d-m-Y", $dt);
					   ?>
					   <div class="reviews-box">
						   <?php echo $row['name'];?>  <?php echo $mdate;?><br/>
						   Kwaliteit: <img src="staricon/<?php echo $row['quality_rating'];?>star.png" style="width:100px"><br/>
						   Bezorging: <img src="staricon/<?php echo $row['delivery_rating'];?>star.png" style="width:100px"><br/>
						   <?php echo $row['comment'];?>
					   </div>
					   <?php } ?>
    </div>		
			
  </div>
	</body>
	<style>
		.txt-center {
  text-align: center;
}
.hide {
  display: none;
}

.clear {
  float: none;
  clear: both;
}

.rating {
    width: 100px;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}

.rating > label {
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
}

.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: transparent;
}

.rating > label:hover:before,
.rating > label:hover ~ label:before,
.rating > input.radio-btn:checked ~ label:before,
.rating > input.radio-btn:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
}
.delrating {
    width: 100px;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}

.delrating > label {
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
}

.delrating > label:hover,
.delrating > label:hover ~ label,
.delrating > input.radio-btndel:checked ~ label {
    color: transparent;
}

.delrating > label:hover:before,
.delrating > label:hover ~ label:before,
.delrating > input.radio-btndel:checked ~ label:before,
.delrating > input.radio-btndel:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
}

 
		</style>
<?php include 'public_footer.php'; ?>
</html>
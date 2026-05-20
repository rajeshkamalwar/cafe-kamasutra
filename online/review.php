<?php
include 'admin/db.php';
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
    </head>
    <body class="checkout_page2">
    <?php include 'public_header.php'; 
		if($current_lang=='dutch'){
			$forgetbutton = 'Wachtwoord opnieuw instellen';
		} else { 
			$forgetbutton = 'reset Password';
		}
		
		?> 
        <div class="container checkoutpage rkgfi5 forgetpass">
            <?php include 'css_file.php'; ?>

            <script>
                b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';
                currency = '<?php echo currency . ' '; ?>';
                current_lang = '<?php echo $current_lang; ?>';
                cop_cart_details_js = '';
            </script>
                   <div class="row reviews555">
					   <h2>Recent Reviews of Pakwaan</h2>   
					   <?php 
					         $query = $mysqli->query("select * from review where status = '1' order by id desc"); 
					         while($row = $query->fetch_array()){
								 $datetime = $row['ddate'];
								 $dt = strtotime($datetime); //make timestamp with datetime string
								 $mdate = date("d-m-Y", $dt);
					   ?>
					   <div>
						   <?php echo $row['name'];?>  <?php echo $mdate;?><br/>
						   <img src="staricon/<?php echo $row['quality_rating'];?>star.png" style="width:100px"><br/>
						   <img src="staricon/<?php echo $row['delivery_rating'];?>star.png" style="width:100px"><br/>
						   <?php echo $row['comment'];?>
					   </div>
					   <?php } ?>
    </div>
  </div>
	</body>
	
<?php include 'public_footer.php'; ?>
</html>
		  
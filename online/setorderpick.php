
<?php
            session_start();
            ob_start();
            include 'admin/db.php';
            include 'admin/config.php';
if(isset($_GET['action'])){
if($_GET['action']=='pickup'){
	
    $_SESSION['current_pick']=2;
	$query = $mysqli->query("SELECT * FROM `minorder` where id=1 ");
		$row = $query->fetch_array();
		 $_SESSION['min_amt']=$row['min_amt'];
         $_SESSION['deli_chrg']=$row['deli_chrg'];
         $_SESSION['free_from']=$row['free_from'];
	$_SESSION['current_pick']=1;
} else { 
    $_SESSION['current_pick']=1;
$query1 = $mysqli->query("SELECT * FROM `postcode` where postcode='". $_SESSION['curntpostcode']."' ");
            $row = $query1->fetch_assoc();
             $_SESSION['ispostcodeset']='yes';
             $_SESSION['curntpostcode_id']=$row['postcode_id'];
             $_SESSION['curntpostcode']=$row['postcode'];
             $_SESSION['postcode_min_amt']=$row['postcode_min_amt'];
             $_SESSION['postcode_deli_chrg']=$row['postcode_deli_chrg'];
             $_SESSION['postcode_free_from']=$row['postcode_free_from'];
             
             $echostr= "pass";
	 
             
}
	

		//unset($_SESSION["shopping_cart"]);
		//unset($_SESSION['curntpostcode_id']);
        //unset($_SESSION['postcode_min_amt']);
        //unset($_SESSION['postcode_deli_chrg']);
        //unset($_SESSION['postcode_free_from']);
	$otid = $_GET['otid'];
  header("location:reorder.php?otid=$otid"); 
}
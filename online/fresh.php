<?php
if (!isset($_SESSION))
  {
    session_start();
	if(isset($_SESSION["shopping_cart"])){
  unset($_SESSION["shopping_cart"]);
		unset($_SESSION["shopping_cart"]);
		unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
		unset($_SESSION['current_pick']);
		unset($_SESSION['min_amt']);
		
	}
//header('Location: online-order.php' );
}else { 
unset($_SESSION["shopping_cart"]);
	unset($_SESSION["shopping_cart"]);
		unset($_SESSION['curntpostcode_id']);
        unset($_SESSION['postcode_min_amt']);
        unset($_SESSION['postcode_deli_chrg']);
        unset($_SESSION['postcode_free_from']);
	unset($_SESSION['current_pick']);
	unset($_SESSION['min_amt']);
}?>
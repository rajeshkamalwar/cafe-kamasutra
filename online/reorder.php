<?php
include 'admin/db.php';
session_start();
$otid = $_GET['otid'];
$query = $mysqli->query("select * from order_product_details where ot_id = '".$otid."' ");
while($row = $query->fetch_array()){
$custmdataid=rand(1, 9999).date("hmi");
	
	$updatd_price = $mysqli->query("SELECT `dish_price` FROM dish  where `dish_id` = '".$row["product_id"]."' ");
	 $row_postdel = $updatd_price->fetch_array(); 
	
if(isset($_SESSION["shopping_cart"])){
   $is_available = 0;
   foreach($_SESSION["shopping_cart"] as $keys => $values)
   {
      if($_SESSION["shopping_cart"][$keys]['product_id'] == $row["product_id"] && $_SESSION["shopping_cart"][$keys]['product_name'] == $row["product_name"])
    {
     $is_available++;
     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $row["product_quantity"];
    }
   }
   if($is_available == 0)
   {
    $item_array = array(
    'product_id'               =>     $row["product_id"],  
    'product_name'             =>     $row["product_name"],  
    'product_price'            =>    $row['product_price'], 
    'product_quantity'         =>     $row["product_quantity"],
    'custkey'                  =>      $custmdataid
   );
    $_SESSION["shopping_cart"][] = $item_array;
   }
  }
  else {
$item_array = array(
    'product_id'               =>     $row["product_id"],  
    'product_name'             =>     $row["product_name"],  
     'product_price'            =>    $row['product_price'], 
    'product_quantity'         =>     $row["product_quantity"],
    'custkey'                  =>      $custmdataid
   );
$_SESSION["shopping_cart"][] = $item_array;
  }
}
header("location:online-order.php");
?>
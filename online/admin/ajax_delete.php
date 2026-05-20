<?php
include 'db.php';
if($_POST['id'])
{
$id=$_POST['id'];
// $delete = "DELETE FROM promotion_tbl WHERE id='".$id."';";
// $delete .= "DELETE FROM promotion_discount_code_tbl WHERE user_id='".$id."'";
// $delete .= "DELETE FROM promation_coupon_data_maintain WHERE user_id='".$id."'";
$delete = "
delete from promotion_tbl where id='".$id."' ;
delete from promotion_discount_code_tbl where user_id ='".$id."';
delete from promation_coupon_data_maintain where user_id ='".$id."'";

mysqli_multi_query($mysqli,$delete);

}
?>
<?php
//fetch.php;
$connect = mysqli_connect("localhost", "root", "", "gur_tandoor_fo");
$query = "SELECT * FROM tbl_orders WHERE comment_status = 0 and ot_trx_status='Success' order by ot_id limit 2";
$result = mysqli_query($connect, $query);
$output = '';
while($row = mysqli_fetch_array($result))
{
 $output .= '
 <div class="alert alert_default">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <table>
 <tr><th>Order ID</th><th>Amount</th><th>Payment Option</th></tr>
 <tr><td>'.$row["ot_id"].'</td><td>'.$row["ot_subTotal"].'</td><td>'.$row["ot_paymentoption"].'</td></tr>
 </table>
 
 </div>
 ';
}

echo $output;

?>
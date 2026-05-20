<?php
$logo_url="https://restaurantkamasutra.nl/online/mythos-black-logo.png";
?>
 <div class="col-md-12 col-sm-12 table-responsive ">
     <div><?= $or_orderno; ?><br/><p class="orderno_cls"><?= $order_no; ?></p></div>
     <div><?= $or_date; ?><br/><p class="date_cls"><?= date_format($date, "M d, Y"); ?></p></div>
     <div><?= $or_total; ?><br/><p class="total_cls"><?= currency . " " . $totalamt; ?></p></div>
     <div><?= $or_paymethod; ?><br/><p class="paymethod_cls"><?= $payment_method; ?></p></div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12">
                            <?= $_SESSION["cop_cart_details"] ?>
                        </div> 
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><?php echo $cust_dtls_title; ?></p>
                            <p>
                            <table>
                                <tr><td><b><?= $or_email ?>: </b> <?php echo $email; ?></td></tr>
                                <tr><td><b><?= $or_tele ?>: </b> <?php echo $telephone ?></td></tr>
                                <?php if (isset($_POST['free_item']) && !empty($_POST['free_item'])) { ?>    <tr><td><b><?= $or_free_item ?>: </b> <?php echo $_POST['free_item'] ?></td></tr><?php } ?>
                                <tr><td><b><?= $or_Pickup_Delivery ?>: </b> <?php echo $pickdel; ?></td></tr>
                            </table>
                            </p>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <p class="cust_dtls_title"><?php echo $bill_addr; ?></p>
                            <p>
                                <?php
//                        echo $_POST['first_name']." ".$_POST['last_name']."<br/>".$_POST['companyname']."<br/>".$_POST['address1']."<br/>".$_POST['address2']."<br/>".$_POST['postcode']." ".$_POST['postcode2let']."<br/>".$_POST['city'];
                                echo $OR_first_name . " " . $OR_last_name . "<br/>" . $OR_companyname . "<br/>" . $OR_address1 . "<br/>" . $OR_address2 . "<br/>" . $OR_postcode . " " . $OR_postcode2let . "<br/>" . $OR_city;
                                ?>
                            </p>
                        </div>

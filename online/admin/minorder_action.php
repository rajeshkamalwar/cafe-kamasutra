<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
		$min_amt='';
		$deli_chrg='';
		$free_from='';
        if(empty($mysqli->escape_string($_POST['min_amt']))){
            $min_amt=0;
			$free_from=$mysqli->escape_string($_POST['free_from']);
			$deli_chrg=$mysqli->escape_string($_POST['deli_chrg']);
        }else
        {
			$min_amt=$mysqli->escape_string($_POST['min_amt']);
			$free_from=$mysqli->escape_string($_POST['free_from']);
			$deli_chrg=$mysqli->escape_string($_POST['deli_chrg']);
		}
        if ($mysqli->query("UPDATE `minorder` SET `min_amt`='".$min_amt."',`deli_chrg`='".$deli_chrg."',`free_from`='".$free_from."'")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `minorder` where `id` ='1'");
        $output='';
        while ($row = $result_query->fetch_assoc()) 
        {
                $output.='<div class="row">
                            <div class="col-md-12 col-sm-12">                                       
                            <div class="form-group">
                            <label for="attributes price">Minimum Amount</label>
                            <input id="min_amt" name="min_amt" value="'.$row['min_amt'].'" /> 
                            </div>
							<div class="form-group">
                            <label for="attributes price">Delivery Charge</label>
                            <input id="deli_chrg" name="deli_chrg" value="'.$row['deli_chrg'].'" /> 
                            </div>
							<div class="form-group">
                            <label for="attributes price">Free from</label>
                            <input id="free_from" name="free_from" value="'.$row['free_from'].'" /> 
                            </div>
                            </div>
                            </div>
                            <div class="pull-right">
                            <button type="button" class="btn btn-primary" id="set_minorder_update"><i  class="fa fa-save"></i> Update</button>
                                            </div>
                                            <br/><br/>';
        }
echo $output;
    }
}
?>


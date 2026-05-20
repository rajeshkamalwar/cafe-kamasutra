<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
		
			$pickup=$mysqli->escape_string($_POST['pickup']);
        
        if ($mysqli->query("UPDATE `deliveryinfo` SET `pickup`='".$pickup."' ")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `deliveryinfo` where `id` ='1'");
        $output='';
        while ($row = $result_query->fetch_assoc()) 
        {
			$pickup='';if($row['pickup']=='pickup')$pickup = 'checked';
			$delivery='';if($row['pickup']=='delivery')$delivery = 'checked';
			$both='';if($row['pickup']=='both')$both = 'checked';

                $output.='<div class="row">
                            <div class="col-md-12 col-sm-12">                                       
                            <div class="form-group">
                            <label for="attributes price">Pick Up</label>
                            <input id="pickup" name="pickup" value="pickup" '.$pickup .' type="radio"/> 
                            </div>
							<div class="form-group">
                            <label for="attributes price">Delivery</label>
                            <input id="pickup" name="pickup" value="delivery"  '.$delivery.' type="radio"/> 
                            </div>
							<div class="form-group">
                            <label for="attributes price">Both </label>
                            <input id="pickup" name="pickup" value="both" '.$both.'  type="radio" /> 
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


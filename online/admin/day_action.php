<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
		 $todaysDate = date('Y-m-d');
        if ($mysqli->query("UPDATE `daystatus` SET `status`='" . $_POST['status'] . "',`cdate`='".$todaysDate."',`rh_msg_en`='" . $mysqli->escape_string($_POST['restra_holi_en']) . "',`rh_msg_nl`='" . $mysqli->escape_string($_POST['restra_holi_nl']) . "' WHERE  `id` = '1'")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `daystatus` where `id` ='1'");
        $row = $result_query->fetch_assoc(); 
		$todaysDate = date('Y-m-d');
		$status = "";
		$status12 = "";
        if($row['status'] == "Close" && $todaysDate == $row['cdate']){
			$status12 = "selected";
		} else { 
			$status = "selected";
		}
		
		
                $output='<div class="row">
				 <p id="del_notimsg"></p>
                                                  <div class="col-md-12 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">Status</label>
                                                        
                  <select class="form-control" name="status" id="status">
					  <option '.$status.' >Open</option>
					   <option '.$status12.' >Close</option>
															</select>
                
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1; ?>">'.$row['rh_msg_en'].'</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_nl" name="restra_holi_nl"  placeholder="Message in <?= lang2; ?>" >'.$row['rh_msg_nl'].'</textarea>
                                                </div>
                                            </div>
                                        </div><div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_time_update"><i  class="fa fa-save"></i> Update</button>
                                            </div>
                                            <br/><br/>';

echo $output;
    }
}
?>


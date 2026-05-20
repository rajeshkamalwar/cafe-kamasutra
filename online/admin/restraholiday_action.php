<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
        if ($mysqli->query("UPDATE `restraholidays` SET `rh_start_date`='" . $mysqli->escape_string($_POST['start_date']) . "',`rh_end_date`='" . $mysqli->escape_string($_POST['end_date']) . "',`rh_msg_en`='" . $mysqli->escape_string($_POST['restra_holi_en']) . "',`rh_msg_nl`='" . $mysqli->escape_string($_POST['restra_holi_nl']) . "' WHERE  `rh_id` = '1'")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `restraholidays` where `rh_id` ='1'");
        $row = $result_query->fetch_assoc(); 
		if($row['rh_start_date']!='NaN-NaN-NaN'){
			$startdate = date('Y-m-d', strtotime($row['rh_start_date']));
		}
		else { 
			 $startdate = date('Y-m-d');
		}
		if($row['rh_end_date']!='NaN-NaN-NaN'){
			$enddate = date('Y-m-d', strtotime($row['rh_end_date']));
		}
		else { 
			 $enddate = '';
		}
		
               $output='<div class="row">
                                                <div class="col-md-6 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">Start off Date</label>
                                                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker1" value="'.$startdate.'">
                </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="attributes price">End off Date</label>

                                                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker2" value="'.$enddate.'">
                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1; ?>">'.$row['rh_msg_en'].'</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_nl" name="restra_holi_nl"  placeholder="Message in <?= lang2; ?>" >'.$row['rh_msg_en'].'</textarea>
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


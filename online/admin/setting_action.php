<?php

include 'db.php';
include 'config.php';

if (isset($_POST['setting_action'])) {
    $setting_action= $_POST['setting_action'];


    if ($setting_action == "load") {
        $query = "Select * From `adm_set`";
        $result_query = $mysqli->query($query);
//        $row = $result_query->fetch_assoc();
        $data1=array();
        while ($row = $result_query->fetch_assoc()) {
            $data1[$row['adm_set_name']] = $row['adm_set_vlu'];
        }
        
        $queryp = "Select * From `printsetting` where id='1'";
        $result_queryp = $mysqli->query($queryp);
        $rowp = $result_queryp->fetch_assoc();
		$data1[$rowp['print_type']] = $rowp['print_type'];
//        echo $row['welcm_en'];
//        die();
        echo json_encode($data1);
    }
if ($setting_action == "testbk") {
       $edit_query="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['tstbk']) . "' WHERE `adm_set_name`='testbk'";
      //echo $edit_query;die();
            $edit_query_result = $mysqli->query($edit_query);
            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Online payment mode is updated.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Online payment mode is not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
   if ($setting_action == "print_setting") {
	   if($_POST['print_type']=='Custom'){
       $edit_query="UPDATE `printsetting` SET `print_type`='" . $mysqli->escape_string($_POST['print_type']) . "',`width`='" . $mysqli->escape_string($_POST['width']) . "',`height`='" . $mysqli->escape_string($_POST['height']) . "' WHERE `id`='1'";
	   } else {
 $edit_query="UPDATE `printsetting` SET `print_type`='" . $mysqli->escape_string($_POST['print_type']) . "',`width`='',`height`='' WHERE `id`='1'";
			   
	   }
      //echo $edit_query;die();
            $edit_query_result = $mysqli->query($edit_query);
            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Print type is updated.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Print type is not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    } 
	
	if ($setting_action == "updatcode") {
	   
       $edit_query="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['delcheck']) . "' WHERE `adm_set_name`='delcheck'";
            $edit_query_result = $mysqli->query($edit_query);
		 $edit_query2="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['delcode']) . "' WHERE `adm_set_name`='delcode'";
            $edit_query_result2 = $mysqli->query($edit_query2);
            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Delete code updated.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Delete code is not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    } 
	if ($setting_action == "updatqrcode") {
	   
       $edit_query="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['qrcheck']) . "' WHERE `adm_set_name`='qrcheck'";
            $edit_query_result = $mysqli->query($edit_query);
		
            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Delete code updated.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Delete code is not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    } 
	
	
   if ($setting_action == "colscm") {
	   $tempalte_type = $mysqli->escape_string($_POST['tempalte_type']);
       $edit_query="UPDATE `adm_set` SET `adm_set_vlu`='green' WHERE `adm_set_name`='colschm'";
        $edit_query11="UPDATE `adm_set` SET adm_set_vlu='".$tempalte_type."' WHERE `adm_set_name`='tempalte_type'";
       $edit_query_result11 = $mysqli->query($edit_query11);
       //echo $edit_query;die();
       
            $edit_query_result = $mysqli->query($edit_query);

            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Color theme updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Color theme not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }

   if ($setting_action == "edit_logo") {
       $edit_query="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['logo_url']) . "' WHERE `adm_set_name`='print_url'";
       
            $edit_query_result = $mysqli->query($edit_query);

            $notification_message = '';
            if ($edit_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Print bill logo updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Print bill logo not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
   if ($setting_action == "edit_smtp") {
       if($_POST['additional_email2']==''){
		   $newemail = $_POST['additional_email'];
	   } else { 
		    $newemail = $_POST['additional_email']. "," . $_POST['additional_email2'];
	   }
	   
       $edit_query1="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['email_address']) . "' WHERE `adm_set_name`='email_from_smtp'";
       $edit_query2="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['additional_email']) . "' WHERE `adm_set_name`='email_from_smtp_pwd'";
       $edit_query3="UPDATE `adm_set` SET `adm_set_vlu`='" . $newemail . "' WHERE `adm_set_name`='newmail'";
	   
              $edit_query12="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['additional_email2']) . "' WHERE `adm_set_name`='additional_email2'";
       
       
       
            $edit_query1_result = $mysqli->query($edit_query1);
            $edit_query2_result = $mysqli->query($edit_query2);
            $edit_query12_result = $mysqli->query($edit_query12);
            $edit_query13_result = $mysqli->query($edit_query3);
	   
            $notification_message = '';
            if ($edit_query1_result && $edit_query2_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Email details updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Email details not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }

    if ($setting_action == "merchant_setting") {
       
       $edit_query1="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['Merchant_Key']) . "' WHERE `adm_set_name`='Merchant_Key'";
       $edit_query2="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['Merchant_ID']) . "' WHERE `adm_set_name`='Merchant_ID'";
       
       
       
       
       
            $edit_query1_result = $mysqli->query($edit_query1);
            $edit_query2_result = $mysqli->query($edit_query2);
            

            $notification_message = '';
            if ($edit_query1_result && $edit_query2_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Merchant details updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Merchant details not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
	 if ($setting_action == "gps_type") {
       $edit_query1="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['gps_type']) . "' WHERE `adm_set_name`='gps_type'";
            $edit_query1_result = $mysqli->query($edit_query1);
            $notification_message = '';
            if ($edit_query1_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">GPS details updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! GPS details not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
	
	 if ($setting_action == "paymentop") {
       $edit_query1="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['ideal']) . "' WHERE `adm_set_name`='ideal'";
            $edit_query1_result = $mysqli->query($edit_query1);
		 $edit_query2="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['mastercard']) . "' WHERE `adm_set_name`='mastercard'";
            $edit_query2_result = $mysqli->query($edit_query2);
		 $edit_query3="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['paypal']) . "' WHERE `adm_set_name`='paypal'";
            $edit_query3_result = $mysqli->query($edit_query3);
		 
		 $edit_query4="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['cash']) . "' WHERE `adm_set_name`='cash'";
            $edit_query4_result = $mysqli->query($edit_query4);
		 
		 $edit_query44="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['pin']) . "' WHERE `adm_set_name`='pin'";
            $edit_query44_result = $mysqli->query($edit_query44);
		 
            $notification_message = '';
            if ($edit_query1_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Payment details updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Payment details not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
    if ($setting_action == "update_rest") {
       $edit_query1="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_title']) . "' WHERE `adm_set_name`='rest_title'";
       $edit_query2="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_addrss']) . "' WHERE `adm_set_name`='rest_addrss'";
       $edit_query3="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_postcode']) . "' WHERE `adm_set_name`='rest_postcode'";
       $edit_query4="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_postcode_two']) . "' WHERE `adm_set_name`='rest_postcode_two'";
       $edit_query5="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_city']) . "' WHERE `adm_set_name`='rest_city'";
       $edit_query6="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_cont']) . "' WHERE `adm_set_name`='rest_cont'";
		
		
		  $edit_query7="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_email']) . "' WHERE `adm_set_name`='rest_email'";
		  $edit_query8="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_weblink']) . "' WHERE `adm_set_name`='rest_weblink'";
		  $edit_query9="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_contact2']) . "' WHERE `adm_set_name`='rest_contact2'";
		  $edit_query10="UPDATE `adm_set` SET `adm_set_vlu`='" . $mysqli->escape_string($_POST['rest_info']) . "' WHERE `adm_set_name`='rest_info'";
       
            $edit_query1_result = $mysqli->query($edit_query1);
            $edit_query2_result = $mysqli->query($edit_query2);
            $edit_query3_result = $mysqli->query($edit_query3);
            $edit_query4_result = $mysqli->query($edit_query4);
            $edit_query5_result = $mysqli->query($edit_query5);
            $edit_query6_result = $mysqli->query($edit_query6);
		
		 	$edit_query7_result = $mysqli->query($edit_query7);
		 	$edit_query8_result = $mysqli->query($edit_query8);
		 	$edit_query9_result = $mysqli->query($edit_query9);
            $edit_query10_result = $mysqli->query($edit_query10);  

            $notification_message = '';
            if ($edit_query1_result && $edit_query2_result && $edit_query3_result && $edit_query4_result && $edit_query5_result && $edit_query6_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Restaurant details updated successfully.</div></div></div>';
            } else {
                $edit_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Restaurant details not updated. Please try again little later.</div></div></div>';            }       
        echo $notification_message;
    }
}
?>


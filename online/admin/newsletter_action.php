
<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
  if ($action == "load") {
        $list_postcode_query        = "Select * From `newsletter` ORDER BY id DESC";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode              = '<tbody><tr>
                                                <th>S.No.</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                              
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode .= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
            
            while ($row = $result_list_postcode_query->fetch_assoc()) {
                $activ_class = "";
				 
                $list_postcode .= '<tr class="' . $activ_class . '">
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['subject'] . '</td>
                                    <td>' . $row['message'] . '</td>
                                    <td> <a title="Delete" class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        echo $list_postcode;
    }
    if ($action == "update") {
        $notification_message = '';
		$query = $mysqli->query("select DISTINCT email from registeruser");
		while($row = $query->fetch_array()){
			$allEmails=$row['email'];
		
		$From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
	
		$rest_title= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_title'")->fetch_object()->adm_set_vlu;
		$rest_addrss= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_addrss'")->fetch_object()->adm_set_vlu;
		$rest_postcode= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode'")->fetch_object()->adm_set_vlu;
		$rest_postcode_two= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_postcode_two'")->fetch_object()->adm_set_vlu;
		$rest_city= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_city'")->fetch_object()->adm_set_vlu;
		$rest_cont= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='rest_cont'")->fetch_object()->adm_set_vlu;
				
$subject = $_POST['subject'];
			
if(!empty($rest_contact2)){ $newcontact =  'Tel: '.$rest_contact2; } else { $newcontact=''; }
if(!empty($rest_info)){ $newrssinfo = $rest_info; }	else { $newrssinfo=''; }
			
$message = '
'.$_POST['newslettertext'].'
<br/><br/>
'.$rest_rest_title.'<br/>
'.$rest_addrss_main.'<br/>
'.$rest_postcode_main.' '.$rest_postcode_two.'  '.$res_rest_city.'<br/>
Telephone: '.$res_rest_cont.'<br/>
'.$From_Email_Address.'<br/>
'.$rest_weblink_main.' <br/>
'.$newcontact.'<br/>
'.$newrssinfo.'
';
			
$to_id=$allEmails;
//$to_id='jyoti@digipanda.co.in';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From: $From_Email_Address";
mail($to_id, $subject, $message, $headers);
		}
		$notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Mail Send successfully.</div></div></div>';
		$edit_query_updte_postcode = "INSERT INTO `newsletter` SET `subject`='" . $_POST['subject'] . "', `message`='" . $_POST['newslettertext'] . "' ";
        
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);
        echo $notification_message;
    }

 if ($action == "delete") {
        $id          = $_POST['id'];
		$emailid = $getdata['email'];
        $result               = $mysqli->query("DELETE  FROM `newsletter` WHERE `id`='" . $id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">data deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Newsletter not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
	
	
 if ($action == "saveinadata") {
  
	 
		$edit_query_updte_postcode = "INSERT INTO `newsletter` SET `subject`='" . $_POST['subject_m'] . "', `message`='" . $_POST['message_m'] . "' ";
        
            $edit_postcode_result = $mysqli->query($edit_query_updte_postcode);
      
    }
	
	
	
	
	

}
?>

<?php

include 'db.php';
include 'config.php';

if (isset($_POST['gift_action'])) {
    $gift_action = $_POST['gift_action'];

    if ($gift_action == "view") {

        $result = $mysqli->query("SELECT * FROM `giftitem` WHERE `gt_id`='" . $_POST['gift_id'] . "'");
        $row = $result->fetch_assoc();
        echo '<input type="hidden" id="gift_id" value="' . $_POST['gift_id'] . '">
<div class="form-group">
 <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="strat_date">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start date" value="'. $row['start_date'] .'">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" value="'. $row['end_date'] .'">
                                                </div>
                                            </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        <label for="min_odr_amunt">Minimum Order Amount</label>
        <input type="text" class="form-control" placeholder="Minimum Order Amount" id="edit_min_odr_amunt" value="' . $row['gt_min_odr_amt'] . '" required>
    </div>
    <div class="col-md-6 col-sm-12">
    <label for="max_odr_amunt">Maximum Order Amount</label>
        <input type="text" class="form-control" placeholder="Minimum Order Amount" id="edit_max_odr_amunt" value="' . $row['gt_max_odr_amt'] . '" required>
    </div>
</div>
<div class="form-group">
    <label for="attributes price">Message</label>
    <input type="text" class="form-control" id="edit_msg" placeholder="" value="' . $row['gt_msg'] . '" required>
</div>
<div class="form-group">
                                            <label for="">Gift Item Name</label>
											
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift1" name="edit_gift1" placeholder="Gift Item" value="' . $row['gt_1'] . '">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift2" name="edit_gift2" placeholder="Gift Item" value="' . $row['gt_2'] . '">
                                                </div></div>
                                                 <div class="row">
                                                     <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift3" name="edit_gift3" placeholder="Gift Item" value="' . $row['gt_3'] . '">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift4" name="edit_gift4" placeholder="Gift Item" value="' . $row['gt_4'] . '">
                                                </div></div>
                                            <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift5" name="edit_gift5" placeholder="Gift Item" value="' . $row['gt_5'] . '">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift6" name="edit_gift6" placeholder="Gift Item" value="' . $row['gt_6'] . '">
                                                </div>
                                            </div>
                                        </div>';
    }

    if ($gift_action == "load") {
        $list_gift_query = "Select * From `giftitem`";
        $result_list_gift_query = $mysqli->query($list_gift_query);
        $list_gift = '<tbody><tr>
                                                <th>Min. Price</th>
                                                <th>Max. Price</th>
                                                <th>Message</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_gift_query->num_rows == 0) {
            $list_gift.= '<tr><td colspan=4><center>No record found.</center></td></tr>';
        } else {
            while ($row = $result_list_gift_query->fetch_assoc()) {
                $list_gift .= '<tr>
                                    <td>' . $row['gt_min_odr_amt'] . '</td>
                                    <td>' . $row['gt_max_odr_amt'] . '</td>
                                    <td>' . $row['gt_msg']. '</td>
                                    <td>
                                        <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#modal-view" id="view_record" dataid="' . $row['gt_id'] . '"><i class="fa fa-eye"></i></a>  
                                        <a class="btn btn-social-icon btn-success" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="' . $row['gt_id'] . '"><i class="fa fa-pencil"></i></a>  
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['gt_id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        echo $list_gift . "</tbody>";
    }

    if ($gift_action == "add") {

        $add_min_odr_amunt = $mysqli->escape_string($_POST['add_min_odr_amunt']);
        $add_max_odr_amunt = $mysqli->escape_string($_POST['add_max_odr_amunt']);
        $add_msg = $mysqli->escape_string($_POST['add_msg']);
        $add_gift1 = $mysqli->escape_string($_POST['add_gift1']);
        $add_gift2 = $mysqli->escape_string($_POST['add_gift2']);
        $add_gift3 = $mysqli->escape_string($_POST['add_gift3']);
        $add_gift4 = $mysqli->escape_string($_POST['add_gift4']);
        $add_gift5 = $mysqli->escape_string($_POST['add_gift5']);
        $add_gift6 = $mysqli->escape_string($_POST['add_gift6']);
        

        $add_gift_query = "INSERT INTO `giftitem`(`start_date`,`end_date`,`gt_min_odr_amt`,`gt_max_odr_amt`,`gt_msg`,`gt_1`,`gt_2`,`gt_3`,`gt_4`,`gt_5`,`gt_6`) VALUES ('" . $_POST['start_date'] . "','" . $_POST['end_date'] . "','" . $add_min_odr_amunt . "','" . $add_max_odr_amunt . "','" . $add_msg . "','" . $add_gift1 . "','" . $add_gift2 . "','" . $add_gift3 . "','" . $add_gift4 . "','" . $add_gift5 . "','" . $add_gift6 . "')";
		
            $add_gift_query_result = $mysqli->query($add_gift_query);
            if ($add_gift_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Gift item added successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Gift item not added. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }

    if ($gift_action == "edit_load_record") {
        $result = $mysqli->query("SELECT * FROM `giftitem` WHERE `gt_id`='" . $_POST['gift_id'] . "'");
        $row = $result->fetch_assoc();
        echo '<input type="hidden" id="gift_id" value="' . $_POST['gift_id'] . '">
   <div class="form-group">
                                          <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="strat_date">Start Date</label>
                                                    <input type="date" class="form-control" id="end_start_date" name="end_start_date" placeholder="Start date" value="'. $row['start_date'] .'">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control" id="edit_end_date" name="edit_end_date" placeholder="End Date" value="'. $row['end_date'] .'">
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="min_odr_amunt">Minimum Order Amount</label>
                                                    <input type="text" class="form-control" id="edit_min_odr_amunt" name="edit_min_odr_amunt" placeholder="Minimum Amount" value="'.$row['gt_min_odr_amt'].'" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="max_odr_amunt">Maximum Order Amount</label>
                                                    <input type="text" class="form-control" id="edit_max_odr_amunt" name="edit_max_odr_amunt" placeholder="Maximum Amount" value="'.$row['gt_max_odr_amt'].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <input type="text" class="form-control" id="edit_msg" name="edit_msg" placeholder="Cart Message" value="'.$row['gt_msg'].'" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gift Item Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift1" name="edit_gift1" placeholder="Gift Item" value="'.$row['gt_1'].'">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift2" name="edit_gift2" placeholder="Gift Item" value="'.$row['gt_2'].'">
                                                </div></div>
                                                 <div class="row">
                                                     <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift3" name="edit_gift3" placeholder="Gift Item" value="'.$row['gt_3'].'">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift4" name="edit_gift4" placeholder="Gift Item" value="'.$row['gt_4'].'">
                                                </div></div>
                                            <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift5" name="edit_gift5" placeholder="Gift Item" value="'.$row['gt_5'].'">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="edit_gift6" name="edit_gift6" placeholder="Gift Item" value="'.$row['gt_6'].'">
                                                </div>
                                            </div>
                                        </div>';
    }

    if ($gift_action == "edit") {
        $gift_id = $_POST['gift_id'];
        $edit_min_odr_amunt = $_POST['edit_min_odr_amunt'];
        $edit_max_odr_amunt = $_POST['edit_max_odr_amunt'];
        $edit_msg = $_POST['edit_msg'];
        $edit_gift1 = $_POST['edit_gift1'];
        $edit_gift2 = $_POST['edit_gift2'];
        $edit_gift3 = $_POST['edit_gift3'];
        $edit_gift4 = $_POST['edit_gift4'];
        $edit_gift5 = $_POST['edit_gift5'];
        $edit_gift6 = $_POST['edit_gift6'];
       

        $edit_gift_query = "UPDATE `giftitem` SET `start_date`='" . $_POST['end_start_date'] . "',`end_date`='" . $_POST['edit_end_date'] . "',`gt_min_odr_amt`='" . $edit_min_odr_amunt . "',`gt_max_odr_amt`='" . $edit_max_odr_amunt . "', `gt_msg`='" . $edit_msg . "',`gt_1`='" . $edit_gift1 . "',`gt_2`='" . $edit_gift2 . "',`gt_3`='" . $edit_gift3 . "',`gt_4`='" . $edit_gift4 . "',`gt_5`='" . $edit_gift5 . "',`gt_6`='" . $edit_gift6 . "' WHERE `gt_id`='" . $gift_id . "'";

        
       // echo $edit_gift_query;die();
        
            $edit_gift_query_result = $mysqli->query($edit_gift_query);

            $notification_message = '';
            if ($edit_gift_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Gift item updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Gift item not updated. Please try again little later.</div></div></div>';
            }
        
        echo $notification_message;
    }

    if ($gift_action == 'delete') {
        $gift_id = $_POST['gift_id'];
        $notification_message = '';
        $query = "DELETE  FROM `giftitem` WHERE `gt_id`='" . $gift_id . "'";

        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Gift item deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Gift item not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
}
?>


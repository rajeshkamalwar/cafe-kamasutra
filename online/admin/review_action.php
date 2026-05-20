<?php
include 'db.php';
include 'config.php';

if (isset($_POST['postcode_action'])) {
    
    $postcode_action = $_POST['postcode_action'];
    
    if ($postcode_action == "load") {
        $list_postcode_query        = "Select * From `review` ORDER BY id DESC";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode              = '<tbody><tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
												<th>Email Id</th>
                                                <th>Quality Rating </th>
                                                <th>Delivery Rating</th>
                                                <th>Comment</th>
												 <th>Status</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode .= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'function.php';
            
            while ($row = $result_list_postcode_query->fetch_assoc()) {
                $activ_class = "";
               if($row['status']=='1'){
					$faclass = "fa-rotate-180 inactive";
				   $status = 'Approve';
				} else{
					$faclass = "";
				   $status = 'Dis-approve';
				}
                $list_postcode .= '<tr class="' . $activ_class . '"  id="'.$row['id'].'">
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['name'] . '</td>
									<td>' . $row['email'] . '</td>
                                    <td>' . $row['quality_rating'] . '</td>
                                    <td>' . $row['delivery_rating'] . '</td>
                                    <td>' . $row['comment'] . '</td>
									<td>'.$status.'</td>
                                    <td>
                                    <a class="approve btn btn-social-icon btn-warning"   dataid="' . $row['id'] . '"><i class="fa fa-toggle-on '.$faclass.'"></i></a>    
                                    <a title="Delete" class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        echo $list_postcode;
    }
   
    if ($postcode_action == "delete") {
        $postcode_id          = $_POST['postcode_id'];
        $result               = $mysqli->query("DELETE  FROM `review` WHERE `id`='" . $postcode_id . "'");
        $notification_message = '';
        if ($result) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Review deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Review not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
	 if ($postcode_action == 'change_status') {
        $id = $_POST['id'];
        
		$query = "select `status` from `review` where id=" . $id;
        $res_data = $mysqli->query($query);
        $row = $res_data->fetch_assoc();
		if($row['status']=='1'){
			$status = '0';
		}else { 
			$status = '1';
		}
        $change_status_query = "UPDATE `review` SET `status`='" . $status . "' WHERE `id`='" . $id . "'";

        $change_status_result = $mysqli->query($change_status_query);
        $notification_message = '';
        if ($change_status_result) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Review Status updated successfully.</div></div></div>';
        } else {
            $edit_attrrib_query_result = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! something went wrong. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }
}
?>
<script>
	$(".approve").click(function(){
        var id = $(this).parents("tr").attr("id");
        var postcode_action = 'change_status';
            $.ajax({
               url: 'review_action.php',
               type: 'POST',
               data: {
				       postcode_action: postcode_action,
                       id: id
                      },
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
				    load();
               }
            });
        
    });
</script>
<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';$dis_val='';$delivery_discount_val='';
        if(empty($mysqli->escape_string($_POST['discount']))){
            $dis_val=0;
        }else
        {$dis_val=$mysqli->escape_string($_POST['discount']);}
        
		if(empty($mysqli->escape_string($_POST['delivery_discount']))){
            $delivery_discount_val=0;
        }else
        {$delivery_discount_val=$mysqli->escape_string($_POST['delivery_discount']);}
        
		  if($_POST['popupsttus']=='Active'){
			  $pop_status = 1;
		  }
		else{
			 $pop_status = 2;
		}
		
        if ($mysqli->query("UPDATE `discount` SET `discount_percentage`='".$dis_val."',`delivery_discount`='".$delivery_discount_val."',`start_date`='".$_POST['start_date']."',`end_date`='".$_POST['end_date']."',`title1`='".$_POST['korting_title']."',`title2`='".$_POST['popup_title']."',`title_nl`='".$_POST['korting_title2']."',`title_nl2`='".$_POST['popup_title4']."',`active`='".$pop_status."'")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
	 
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `discount` where `discount_id` ='1'");
        $output='';
        while ($row = $result_query->fetch_assoc()) 
        {
                $output.='<div class="row">
				<div class="col-md-6 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price"> Start date</label>
                                                       <input type="date" name="start_date" id="start_date" value="'.$row['start_date'].'" /> 
                                                    </div>
                                                </div>
												<div class="col-md-6 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">End Date</label>
                                                       <input type="date" name="end_date" id="end_date" value="'.$row['end_date'].'"/>
                                                    </div>
                                                </div>
                            <div class="col-md-6 col-sm-12">                                       
                            <div class="form-group">
                            <label for="attributes price">Discount Percentage for pickup</label>
                            <input id="discount" name="discount" value="'.$row['discount_percentage'].'" /> 
                            </div>
                            </div>
							 <div class="col-md-6 col-sm-12">                                       
                            <div class="form-group">
                            <label for="attributes price">Discount Percentage for Delivery</label>
                            <input id="delivery_discount" name="delivery_discount" value="'.$row['delivery_discount'].'" /> 
                            </div>
                            </div>
							<div class="col-md-2 col-sm-12">
							   <label  >Status</label>
													 
                                                    <select class="form-control" name="status_popup" id="status_popup">
														<option selected="">Active</option>
														<option>Inactive</option>
													</select>
                                                 
                            </div>
							 <div class="col-md-4 col-sm-12">                                       
                            <div class="form-group">
                            <label >Title</label><br>
                            <input id="korting_title" name="korting_title" value="'.$row['title1'].'" /> 					 
                            </div>
                            </div>
							 <div class="col-md-4 col-sm-12">                                       
                            <div class="form-group">
                            <label >Title nl</label><br>
                            <input id="korting_title2" name="korting_title" value="'.$row['title_nl'].'" /> 					 
                            </div>
                            </div>
						   <div class="col-md-5 col-sm-12">                                       
                            <div class="form-group">
                            <label >Popup Title</label>
                            <input id="popup_title" name="popup_title" value="'.$row['title2'].'" /> <br>
							 
                            </div>
                            </div>
							    <div class="col-md-5 col-sm-12">                                       
                            <div class="form-group">
                            <label >Popup Title nl</label>
                     
							 <input id="popup_title4" name="popup_title" value="'.$row['title_nl2'].'" /> 
                            </div>
                            </div>
                            <div class="pull-right col-sm-12">
                            <button type="button" class="btn btn-primary" id="set_discount_update"><i  class="fa fa-save"></i> Update</button>
                                            
											<br/></div>
                                            <br/><br/>';
        }
echo $output;
    }
}
?>


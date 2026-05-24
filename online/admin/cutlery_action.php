
<script type="text/javascript">
  $(function(){
    $(".chargeoptionnew").click(function(){
      if($(this).val() === "charge")
        $("#extra").show();
      else
        $("#extra").hide();
    });
  });
</script>	
<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
		$charge='';
		$status='';
        if(empty($mysqli->escape_string($_POST['charge']))){
            $charge=0;
			$status=$mysqli->escape_string($_POST['status']);
        }else
        {
			$charge=$mysqli->escape_string($_POST['charge']);
			$status=$mysqli->escape_string($_POST['status']);
		}
		$chargeoption = $mysqli->escape_string($_POST['chargeoption']);
        if ($mysqli->query("UPDATE `cutlerysetting` SET `charge`='".$charge."',`status`='".$status."',`chargeoption`='".$chargeoption."' ")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `cutlerysetting` where `id` ='1'");
        $output='';
        while ($row = $result_query->fetch_assoc()) 
        {
			$select = "";
			$select12 = "";
			$selectop = "";
			$selectop12 = "";
			$style = "display:none";
			if($row['status']=='Active'){
				$select = "selected";
			}
			if($row['status']=='Inactive'){
				$select12 = "selected";
			}
			if($row['chargeoption']=='free'){
				$selectop = "checked";
				$style = "display:none";
			}
			if($row['chargeoption']=='charge'){
				$selectop12 = "checked";
				$style = "";
			}
			
                $output.='
				 <div class="row">
                                                <div class="col-md-6 col-sm-12">  
											<div class="form-group">
                                            <label for="attributes price">Cutlery Charge Option</label>
                                            <input type="radio" id="chargeoption" name="chargeoption" value="free" class="chargeoptionnew"  '.$selectop.'>Free
											<input type="radio" id="chargeoption" name="chargeoption" class="chargeoptionnew"   value="charge" '.$selectop12.'>Charge
                                        </div>
												  </div></div>
				<div  class="row">
                            <div  class="col-md-12 col-sm-12">                                       
                            <div  class="form-group " id="extra" style="'.$style.'">
                            <label for="attributes price">Cutlery Charge</label>
                            <input id="charge" name="charge" value="'.$row['charge'].'" /> 
                            </div>
							
							<div class="form-group">
                            <label for="attributes price">Status</label>
                            <select id="status" name="status" > 
							<option '.$select.' >Active</option>
							<option '.$select12.'>Inactive</option>
							</select>
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

<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        $notification_message = '';
		
			$themecolor=$mysqli->escape_string($_POST['themecolor']);
			$h1color=$mysqli->escape_string($_POST['h1color']);
			$pcolor=$mysqli->escape_string($_POST['pcolor']);
			$menucolor=$mysqli->escape_string($_POST['menucolor']);
			$buttoncolor=$mysqli->escape_string($_POST['buttoncolor']);
		
        if ($mysqli->query("UPDATE `themecolor` SET `themecolor`='".$themecolor."',`h1color`='".$h1color."',`pcolor`='".$pcolor."',`menucolor`='".$menucolor."',`buttoncolor`='".$buttoncolor."'")) {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        } else {
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
        }
        echo $notification_message;
    }


    if ($action == "load") {
        $result_query = $mysqli->query("select * from `themecolor` where `id` ='1'");
        $output='';
        while ($row = $result_query->fetch_assoc()) 
        {
                $output.='<div class="row">
                            <div class="col-md-12 col-sm-12">                                       
                           <div class="form-group">
                                            <label for="themecolor">Theme Color </label>
                                            <input type="text" class="form-control" id="themecolor" name="themecolor" placeholder="" value="'.$row['themecolor'].'" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes h1color">heading color</label>
                                            <input type="text" class="form-control" id="h1color" name="h1color" placeholder="" value="'.$row['h1color'].'" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pcolor">Paragraph color</label>
                                            <input type="text" class="form-control" id="pcolor" name="pcolor" placeholder="" value="'.$row['pcolor'].'" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="menucolor">Menu Color</label>
                                            <input type="text" class="form-control" id="menucolor" name="menucolor" value="'.$row['menucolor'].'" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="buttoncolor">Button Color</label>
                                            <input type="text" class="form-control" id="buttoncolor" name="buttoncolor" value="'.$row['buttoncolor'].'" placeholder="" required>
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


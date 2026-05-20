<?php

include 'db.php';
include 'config.php';

if (isset($_POST['dishbycat_action'])) {
    $welcmtxt_action= $_POST['dishbycat_action'];


    if ($welcmtxt_action == "load") {
        $output='<div class="container"><div class="row"><div class="col-md-12"><div class="vertical-tab" role="tabpanel"><ul class="nav nav-tabs" role="tablist">';
        $output1='<div class="tab-content tabs">';
        $output2='';
        $result_query= $mysqli->query("SELECT `cat_id`,`cat_name_en` FROM `categories`");
        $i=0;
         while ($row = $result_query->fetch_assoc()) 
         {
        //echo json_encode($row);
        $i++;
        $active="";if($i==1){$active="active";}else{$active='';}
        
            
        $result_query2= $mysqli->query("SELECT * FROM `dish` where `categry_id` in (".$row['cat_id'].")");
        
       
        $output3='';$count=0;
                 while($row1=$result_query2->fetch_assoc()){
                 $output3.='<li>'.$row1['dish_name_en'].'</li>';$count++;}
                 $output.='<li id="tabid_"'.$row['cat_id'].' role="presentation" class="'.$active.'"><a href="#'.$row['cat_id'].'" aria-controls="home" role="tab" data-toggle="tab">'.$row['cat_name_en'].' ('.$count.')</a></li>';
                  $output2.='<div role="tabpanel" class="tab-pane fade in '.$active.'" id="'.$row['cat_id'].'"><h3>'.$row['cat_name_en'].'</h3><ul>';
               $output2.=$output3.'</ul></div>';
         }
         
         
         $output.='</ul>'.$output1.$output2.'</div></div></div></div></div>';
         
         echo $output;
    }

   

   if ($welcmtxt_action == "edit") {
            $edit_welcmtxt_query_result = $mysqli->query("UPDATE `welcome` SET `welcm_en`='" . $mysqli->escape_string($_POST['welcm_txt_en']) . "',`welcm_nl`='" . $mysqli->escape_string($_POST['welcm_txt_nl']) . "',`lastupdate`='" . date("Y-m-d H:i:s") . "'");

            $notification_message = '';
            if ($edit_welcmtxt_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Welcome text updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Welcome text not updated. Please try again little later.</div></div></div>';
            }       
        echo $notification_message;
    }

}
?>


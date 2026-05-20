<?php

include 'db.php';
include 'config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "update") {
        
        $mon_open1  = $mysqli->escape_string($_POST['mon_open1']);              $tue_open1  = $mysqli->escape_string($_POST['tue_open1']);
        $mon_close1 = $mysqli->escape_string($_POST['mon_close1']);             $tue_close1 = $mysqli->escape_string($_POST['tue_close1']);
        $mon_open2  = $mysqli->escape_string($_POST['mon_open2']);              $tue_open2  = $mysqli->escape_string($_POST['tue_open2']);
        $mon_close2 = $mysqli->escape_string($_POST['mon_close2']);             $tue_close2 = $mysqli->escape_string($_POST['tue_close2']);
        
        $wed_open1  = $mysqli->escape_string($_POST['wed_open1']);              $thu_open1  = $mysqli->escape_string($_POST['thu_open1']);
        $wed_close1 = $mysqli->escape_string($_POST['wed_close1']);             $thu_close1 = $mysqli->escape_string($_POST['thu_close1']);
        $wed_open2  = $mysqli->escape_string($_POST['wed_open2']);              $thu_open2  = $mysqli->escape_string($_POST['thu_open2']);
        $wed_close2 = $mysqli->escape_string($_POST['wed_close2']);             $thu_close2 = $mysqli->escape_string($_POST['thu_close2']);
        
        $fri_open1  = $mysqli->escape_string($_POST['fri_open1']);              $sat_open1  = $mysqli->escape_string($_POST['sat_open1']);
        $fri_close1 = $mysqli->escape_string($_POST['fri_close1']);             $sat_close1 = $mysqli->escape_string($_POST['sat_close1']);
        $fri_open2  = $mysqli->escape_string($_POST['fri_open2']);              $sat_open2  = $mysqli->escape_string($_POST['sat_open2']);
        $fri_close2 = $mysqli->escape_string($_POST['fri_close2']);             $sat_close2 = $mysqli->escape_string($_POST['sat_close2']);
        
        $sun_open1  = $mysqli->escape_string($_POST['sun_open1']);
        $sun_close1 = $mysqli->escape_string($_POST['sun_close1']);
        $sun_open2  = $mysqli->escape_string($_POST['sun_open2']);
        $sun_close2 = $mysqli->escape_string($_POST['sun_close2']);
        
        $mon_shift1close = $mysqli->escape_string($_POST['mon_shift1close']);   $mon_shift2close = $mysqli->escape_string($_POST['mon_shift2close']);
        $tue_shift1close = $mysqli->escape_string($_POST['tue_shift1close']);   $tue_shift2close = $mysqli->escape_string($_POST['tue_shift2close']);
        $wed_shift1close = $mysqli->escape_string($_POST['wed_shift1close']);   $wed_shift2close = $mysqli->escape_string($_POST['wed_shift2close']);
        $thu_shift1close = $mysqli->escape_string($_POST['thu_shift1close']);   $thu_shift2close = $mysqli->escape_string($_POST['thu_shift2close']);
        $fri_shift1close = $mysqli->escape_string($_POST['fri_shift1close']);   $fri_shift2close = $mysqli->escape_string($_POST['fri_shift2close']);
        $sat_shift1close = $mysqli->escape_string($_POST['sat_shift1close']);   $sat_shift2close = $mysqli->escape_string($_POST['sat_shift2close']);
        $sun_shift1close = $mysqli->escape_string($_POST['sun_shift1close']);   $sun_shift2close = $mysqli->escape_string($_POST['sun_shift2close']);
        
        $mon_query="UPDATE `worktime` SET `wt_opentime1`='".$mon_open1."',`wt_closetime1`='".$mon_close1."',`wt_SHIFT1openORclose`='".$mon_shift1close."',`wt_opentime2`='".$mon_open2."',`wt_closetime2`='".$mon_close2."',`wt_SHIFT2openORclose`='".$mon_shift2close."' WHERE `wt_day` = 'Monday'";
        $tue_query="UPDATE `worktime` SET `wt_opentime1`='".$tue_open1."',`wt_closetime1`='".$tue_close1."',`wt_SHIFT1openORclose`='".$tue_shift1close."',`wt_opentime2`='".$tue_open2."',`wt_closetime2`='".$tue_close2."',`wt_SHIFT2openORclose`='".$tue_shift2close."' WHERE `wt_day` = 'Tuesday'";
        $wed_query="UPDATE `worktime` SET `wt_opentime1`='".$wed_open1."',`wt_closetime1`='".$wed_close1."',`wt_SHIFT1openORclose`='".$wed_shift1close."',`wt_opentime2`='".$wed_open2."',`wt_closetime2`='".$wed_close2."',`wt_SHIFT2openORclose`='".$wed_shift2close."' WHERE `wt_day` = 'Wednesday'";
        $thu_query="UPDATE `worktime` SET `wt_opentime1`='".$thu_open1."',`wt_closetime1`='".$thu_close1."',`wt_SHIFT1openORclose`='".$thu_shift1close."',`wt_opentime2`='".$thu_open2."',`wt_closetime2`='".$thu_close2."',`wt_SHIFT2openORclose`='".$thu_shift2close."' WHERE `wt_day` = 'Thursday'";
        $fri_query="UPDATE `worktime` SET `wt_opentime1`='".$fri_open1."',`wt_closetime1`='".$fri_close1."',`wt_SHIFT1openORclose`='".$fri_shift1close."',`wt_opentime2`='".$fri_open2."',`wt_closetime2`='".$fri_close2."',`wt_SHIFT2openORclose`='".$fri_shift2close."' WHERE `wt_day` = 'Friday'";
        $sat_query="UPDATE `worktime` SET `wt_opentime1`='".$sat_open1."',`wt_closetime1`='".$sat_close1."',`wt_SHIFT1openORclose`='".$sat_shift1close."',`wt_opentime2`='".$sat_open2."',`wt_closetime2`='".$sat_close2."',`wt_SHIFT2openORclose`='".$sat_shift2close."' WHERE `wt_day` = 'Saturday'";
        $sun_query="UPDATE `worktime` SET `wt_opentime1`='".$sun_open1."',`wt_closetime1`='".$sun_close1."',`wt_SHIFT1openORclose`='".$sun_shift1close."',`wt_opentime2`='".$sun_open2."',`wt_closetime2`='".$sun_close2."',`wt_SHIFT2openORclose`='".$sun_shift2close."' WHERE `wt_day` = 'Sunday'";
        
//        echo $mon_query."<br/>".$tue_query."<br/>".$wed_query."<br/>".$thu_query."<br/>".$fri_query."<br/>".$sat_query."<br/>".$sun_query."<br/>";
//        die();
        $mon_query_result = $mysqli->query($mon_query);       $tue_query_result = $mysqli->query($tue_query);
        $wed_query_result = $mysqli->query($wed_query);       $thu_query_result = $mysqli->query($thu_query);
        $fri_query_result = $mysqli->query($fri_query);       $sat_query_result = $mysqli->query($sat_query);
        $sun_query_result = $mysqli->query($sun_query);       
        
        $notification_message = '';
        if($mon_query_result && $tue_query_result && $wed_query_result 
        && $thu_query_result && $fri_query_result && $sat_query_result && $sun_query_result){
            $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Changes saved successfully.</div></div></div>';
        }else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! changes not saved. Please try again little later.</div></div></div>';
            }
    echo $notification_message;
        
        }
        
        
        if($action=="load")
        {
            $mon_query="select * from worktime where  `wt_day` ='Monday'";
            $tue_query="select * from worktime where  `wt_day` ='Tuesday'";
            $wed_query="select * from worktime where  `wt_day` ='Wednesday'";
            $thu_query="select * from worktime where  `wt_day` ='Thursday'";
            $fri_query="select * from worktime where  `wt_day` ='Friday'";
            $sat_query="select * from worktime where  `wt_day` ='Saturday'";
            $sun_query="select * from worktime where  `wt_day` ='Sunday'";
            
            $result_mon_query = $mysqli->query($mon_query);          $result_tue_query = $mysqli->query($tue_query);
            $result_wed_query = $mysqli->query($wed_query);          $result_thu_query = $mysqli->query($thu_query);
            $result_fri_query = $mysqli->query($fri_query);          $result_sat_query = $mysqli->query($sat_query);
            $result_sun_query = $mysqli->query($sun_query);
            $output_str='';
            
            function timedropdwn($time){
                $option = '';for ($hours = 0; $hours <= 24; $hours++) {for ($mins = 0; $mins < 60; $mins += timeinterval) {
                    $loop_time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                    if ($loop_time == $time) { if($loop_time != '24:30') { $option .= '<option value="' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . '" selected="selected">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . '</option>'; } } else { if($loop_time != '24:30') { $option .= '<option value="' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . '">' . str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . '</option>';} }
                }}return $option;}

                while ($row = $result_mon_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr style="background-color: #3c8dbc14;"><td>'.$row['wt_day'].'</td><td><select id="mon_open1" name="mon_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="mon_close1" id="mon_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="mon_shift1close" name="mon_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="mon_open2" id="mon_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="mon_close2" id="mon_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                        
<div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="mon_shift2close" name="mon_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_tue_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr><td>'.$row['wt_day'].'</td><td><select id="tue_open1" name="tue_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="tue_close1" id="tue_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="tue_shift1close" name="tue_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="tue_open2" id="tue_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="tue_close2" id="tue_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="tue_shift2close" name="tue_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_wed_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr style="background-color: #3c8dbc14;"><td>'.$row['wt_day'].'</td><td><select id="wed_open1" name="wed_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="wed_close1" id="wed_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="wed_shift1close" name="wed_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="wed_open2" id="wed_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="wed_close2" id="wed_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="wed_shift2close" name="wed_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_thu_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr><td>'.$row['wt_day'].'</td><td><select id="thu_open1" name="thu_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="thu_close1" id="thu_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="thu_shift1close" name="thu_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="thu_open2" id="thu_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="thu_close2" id="thu_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="thu_shift2close" name="thu_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_fri_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr style="background-color: #3c8dbc14;"><td>'.$row['wt_day'].'</td><td><select id="fri_open1" name="fri_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="fri_close1" id="fri_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="fri_shift1close" name="fri_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="fri_open2" id="fri_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="fri_close2" id="fri_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="fri_shift2close" name="fri_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_sat_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr><td>'.$row['wt_day'].'</td><td><select id="sat_open1" name="sat_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="sat_close1" id="sat_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="sat_shift1close" name="sat_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="sat_open2" id="sat_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="sat_close2" id="sat_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="sat_shift2close" name="sat_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            while ($row = $result_sun_query->fetch_assoc()) {
                $shift1openornot='';if($row['wt_SHIFT1openORclose']=='close')$shift1openornot = 'checked';
                $shift2openornot='';if($row['wt_SHIFT2openORclose']=='close')$shift2openornot = 'checked';
                $output_str.='<tr style="background-color: #3c8dbc14;"><td>'.$row['wt_day'].'</td><td><select id="sun_open1" name="sun_open1">'.timedropdwn($row['wt_opentime1']).'</select> - <select name="sun_close1" id="sun_close1">'.timedropdwn($row['wt_closetime1']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="sun_shift1close" name="sun_shift1close" '.$shift1openornot.'> Close</label></div>
                        </td><td><select name="sun_open2" id="sun_open2">'.timedropdwn($row['wt_opentime2']).'</select> - <select name="sun_close2" id="sun_close2">'.timedropdwn($row['wt_closetime2']).'</select></td><td>
                    <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;"><label><input type="checkbox" id="sun_shift2close" name="sun_shift2close" '.$shift2openornot.'> Close</label></div>
                        </td></tr>';
            }
            
            echo  $output_str;
            
        }
}
?>


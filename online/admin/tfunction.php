<?php
function short_desc($long_desc,$length)
{
    $matches=mb_substr($long_desc,0,$length);
  return $matches;
}


function add_currency_sing($amount)
{
$return='';

if($amount=='–'){$return='-';}
else if($amount==''){$return='-';}
else{$return=currency.' '. $amount;}
return $return;
}

function get_cat_name_by_id($cat_id,$mysqli)
{
    $return='';
    $result=$mysqli->query("Select `cat_name_en` From `tcategories` WHERE `cat_id`='$cat_id'");
    $row = $result->fetch_assoc();
    $return = $row['cat_name_en'];
    echo $return;
}
function get_cat_id_by_name($cat_name,$mysqli)
{
    $return='';
    $result=$mysqli->query("Select `cat_id` From `tcategories` WHERE `cat_name_en`='$cat_name'");
    $row = $result->fetch_assoc();
    $return = $row['cat_id'];
    return $return;
}

function get_all_category_chkbox($mysqli,$checkbox_name)
{
    $return='';
    $result=$mysqli->query("Select `cat_id`,`cat_name_en` From `tcategories` Where `cat_status`='Active'");
    
    $cat_chkbox_list='';
    while ($row = $result->fetch_assoc()) {
       $cat_chkbox_list.='<div class = "checkbox">
                             <label>
                                    <input type = "checkbox" name = "'.$checkbox_name.'" value = "'.$row['cat_id'].'">'.$row['cat_name_en'].'
                             </label>
                             </div>';
    }
    echo $cat_chkbox_list;
    
}function get_all_category_chkbox_action($mysqli,$checkbox_name,$cheked_list4cat)
{
    $return='';
    $result=$mysqli->query("Select `cat_id`,`cat_name_en` From `tcategories` Where `cat_status`='Active'");
    
    $cat_chkbox_list='';
    while ($row = $result->fetch_assoc()) {
        $checkedornot = '';
                            if (in_array($row['cat_id'], $cheked_list4cat)) {
                                $checkedornot = 'checked';
                            }
       $cat_chkbox_list.='<div class = "checkbox">
                             <label>
                                    <input type = "checkbox" name = "'.$checkbox_name.'" value = "'.$row['cat_id'].'" '.$checkedornot.'>'.$row['cat_name_en'].'
                             </label>
                             </div>';
    }
    return $cat_chkbox_list;
    
}
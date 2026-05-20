<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
include 'tfunction.php';

function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = time().$_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}

 
   
//echo "<img src='$path' />";
//echo $_POST['dish_name_new_en'];
//echo "jyoti";

    $dish_id = $_POST['dish_id'];
        $dish_name_edit_en = $mysqli->escape_string($_POST['dish_name_edit_en']);
        $dish_name_edit_nl = $mysqli->escape_string($_POST['dish_name_edit_nl']);
     ///   $dish_price_edit = $mysqli->escape_string($_POST['dish_price_edit']);
        $dish_price_edit = str_replace(',', '.', $_POST['dish_price_edit']);
        $dish_type = $mysqli->escape_string($_POST['dish_type_edit']);
        $dish_description_edit_en = $mysqli->escape_string($_POST['dish_description_edit_en']);
        $dish_description_edit_nl = $mysqli->escape_string($_POST['dish_description_edit_nl']);
        $tax_percent_edit = $mysqli->escape_string($_POST['tax_percent_edit']);
        $dish_cat_list_edit = implode(",", $_POST['cat_list_chk_edit']); 
        $opt_var_list_edit = implode(",", $_POST['varib_list_chk_edit']);
        $icon = implode(",", $_POST['iconnew']);
		$video = $_POST['video'];
		$image = $_FILES['image']['name'];
		if($image!=''){
        $img11 = time().$image;
    //call thumbnail creation function and store thumbnail name
        $upload_img = cwUpload('image','../upload/','',TRUE,'../thumbnail/','140','140');
        $uploadimg = "upload/".$img11;
        $thumbimg = "thumbnail/".$img11;
        $edit_dish_query = "UPDATE `tdish` SET `dish_name_en`='" . $dish_name_edit_en . "',`dish_name_nl`='" . $dish_name_edit_nl . "',`dish_desc_en`='" . $dish_description_edit_en . "',`dish_desc_nl`='" . $dish_description_edit_nl . "',`dish_price`='" . $dish_price_edit . "',`categry_id`='" . $dish_cat_list_edit . "',`dish_type`='" . $dish_type . "',`dish_attrib`='" . $opt_var_list_edit . "',`dish_tax_rate`='" . $tax_percent_edit . "',`icon`='".$icon."',`product_image`='".$uploadimg."',`thumbnail`='".$thumbimg."',`video`='".$video."' WHERE `dish_id`='" . $dish_id . "'";
		} else { 
		     $edit_dish_query = "UPDATE `tdish` SET `dish_name_en`='" . $dish_name_edit_en . "',`dish_name_nl`='" . $dish_name_edit_nl . "',`dish_desc_en`='" . $dish_description_edit_en . "',`dish_desc_nl`='" . $dish_description_edit_nl . "',`dish_price`='" . $dish_price_edit . "',`categry_id`='" . $dish_cat_list_edit . "',`dish_type`='" . $dish_type . "',`dish_attrib`='" . $opt_var_list_edit . "',`dish_tax_rate`='" . $tax_percent_edit . "',`icon`='".$icon."',`video`='".$video."' WHERE `dish_id`='" . $dish_id . "'";
		}
        
      
	 $edit_dish_query_result = $mysqli->query($edit_dish_query);
	 echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish updated successfully.</div></div></div>';
		
//echo $add_dish_query?'ok':'err';



?>
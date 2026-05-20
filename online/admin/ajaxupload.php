<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
include 'function.php';

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
 		$dish_name_new_en = $mysqli->escape_string($_POST['dish_name_new_en']);
        $dish_name_new_nl = $mysqli->escape_string($_POST['dish_name_new_nl']);

        ///$dish_price_new = $mysqli->escape_string($_POST['dish_price_new']);

 		$dish_price_new = str_replace(',', '.', $_POST['dish_price_new']);
        $dish_type = $mysqli->escape_string($_POST['dish_type_new']);
        $dish_description_add_en = $mysqli->escape_string($_POST['dish_description_add_en']);
        $dish_description_add_nl = $mysqli->escape_string($_POST['dish_description_add_nl']);
        $tax_percent_new = $mysqli->escape_string($_POST['tax_percent_new']);
        $video = $_POST['video'];
		$dish_cat_list_new = implode(",", $_POST['cat_list_chk_new']);
	
			
	  
		 if($_POST['icon']==''){
			 $icon = null;
		 }
		 else{			
				$icon = implode(",", $_POST['icon']);
		 }
		if($dish_type=='1'){
			$opt_var_list_new = 0;
			}
		else{
			  $opt_var_list_new = implode(",", $_POST['var_list_chk']);
		}

 		$plcharge =  $_POST['plastic_charg1'];			
        $image = $_FILES['image']['name'];
        if($image!=''){
        $img11 = time().$image;
        //call thumbnail creation function and store thumbnail name
       $upload_img = cwUpload('image','../upload/','',TRUE,'../thumbnail/','140','140');
       $uploadimg = "upload/".$img11;
       $thumbimg = "thumbnail/".$img11;
			
		
			
        $add_dish_query = "INSERT INTO `dish`(`dish_name_en`,`dish_name_nl`,`dish_desc_en`,`dish_desc_nl`,`dish_price`,`categry_id`,`dish_type`,`dish_attrib`,`dish_tax_rate`,`icon`,`product_image`,`thumbnail`,`video`,`bag_charge`) VALUES ('" . $dish_name_new_en . "','" . $dish_name_new_nl . "','" . $dish_description_add_en . "','" . $dish_description_add_nl . "','" . $dish_price_new . "','" . $dish_cat_list_new . "','" . $dish_type . "','" . $opt_var_list_new . "','" . $tax_percent_new . "','".$icon."','".$uploadimg."','".$thumbimg."','".$video."','".$plcharge."')";
   }
   else { 
   $add_dish_query = "INSERT INTO `dish`(`dish_name_en`,`dish_name_nl`,`dish_desc_en`,`dish_desc_nl`,`dish_price`,`categry_id`,`dish_type`,`dish_attrib`,`dish_tax_rate`,`icon`,`bag_charge`) VALUES ('" . $dish_name_new_en . "','" . $dish_name_new_nl . "','" . $dish_description_add_en . "','" . $dish_description_add_nl . "','" . $dish_price_new . "','" . $dish_cat_list_new . "','" . $dish_type . "','" . $opt_var_list_new . "','" . $tax_percent_new . "','".$icon."','".$plcharge."')";
   }


 echo $plcharge; 
 

$dupesql = "SELECT * FROM `dish` where `dish_name_en` = '$dish_name_new_en'";
        $duperaw = $mysqli->query($dupesql);       //echo "<pre>";print_r($duperaw);echo "</pre>";die();
        $duperaw_row = $duperaw->fetch_assoc();
		



        $notification_message = '';
        if ($duperaw_row['dish_name_en'] == $dish_name_new_en || $duperaw->num_rows > 0) {
            echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-warning " style="margin-bottom: 0!important;">' . $dish_name_new_en . ' already exists.</div></div></div>';
        } else {
			
			
 $add_dish_query_result = $mysqli->query($add_dish_query);
			
		   $dish_id = $mysqli->insert_id;



		
		$dish_discount = $_POST['dish_discount']; 
		if($_POST['weekdays']==''){
			$weekdays = 0;
		}
		else{
			 $weekdays = implode(",", $_POST['weekdays']);	
		}
		if($_POST['weekdays']!='' || $weekdays==0){			 
		  $insert ="INSERT INTO  dish_discount (dish_id,discount,discountdays) VALUES ('".$dish_id."','".$dish_discount."','".$weekdays."')";
		   $edit_dish_query_result = $mysqli->query($insert);			 
		}
	
			
			
			
	/// echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish added successfully.</div></div></div>';
}
?>
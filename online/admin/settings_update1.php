<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
include 'function.php';
if($_FILES['image']['name']!=''){
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
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image)) {
        //thumbnail creation
        if($thumb == TRUE){
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
}
 	 
	 
   
        $image = $_FILES['image']['name'];
        if($image!=''){
        $img11 = time().$image;
        //call thumbnail creation function and store thumbnail name
       $upload_img = cwUpload('image','../upload2/','',TRUE,'../thumbnail/','140','140');
       $uploadimg = "upload2/".$img11;
       $thumbimg = "thumbnail/".$img11;
		
            $edit_query="UPDATE `head_settings` SET `sett_data`='" .$uploadimg . "' WHERE `settings_name`='fav-icon'";	
			 $add_dish_query_result = $mysqli->query($edit_query);
		}


	 echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Dish added successfully.</div></div></div>';
 ///print_r($add_dish_query_result);
?>
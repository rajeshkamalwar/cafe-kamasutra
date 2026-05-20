<?php

include 'db.php';
include 'config.php';
include 'function.php';
session_start();

if(isset($_POST['name'])){
	if(isset($_POST['video_id'])){
		echo $_FILES['video']['size'];
		
		$id = $_POST['video_id'];
		$video = $_FILES['video']['name'];
        $videoname = $_POST['name'];	
		if($video!=''){
	    $maxsize = 5242880; // 5MB
       $name = $_FILES['video']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["video"]["name"];

       // Select file type
       echo $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg","m4v");

       // Check extension
       if( in_array($videoFileType,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
            echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">File too large. File must be less than 5MB.</div></div></div>';
          }else{
            // Upload
            if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
				
 $add_dish_query = "update `video` set `name`='$videoname',`video`='$name' where id = $id ";
$add_dish_query_result = $mysqli->query($add_dish_query);
	 echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Video added successfully.</div></div></div>';
			}
		  }
	   } 
	else{
          echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Invalid file extensionedit.</div></div></div>';
       }
		}	else { 
		 $add_dish_query = "update `video` set `name`='$videoname' where id = $id ";
$add_dish_query_result = $mysqli->query($add_dish_query);
	 echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Video added successfully12.</div></div></div>';
	}
	} else { 
$video = $_POST['video'];	
$videoname = $_POST['name'];	
	 echo $maxsize = 5242880; // 5MB
 echo $_FILES['video']['size'];
       $name = $_FILES['video']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["video"]["name"];

       // Select file type
       echo $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg","m4v");

       // Check extension
       if( in_array($videoFileType,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
			  
            echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">File too large. File must be less than 5MB.</div></div></div>';
          }else{
            // Upload
            if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
				
 $add_dish_query = "INSERT INTO `video`(`name`,`video`) VALUES ('" . $videoname . "','" . $name . "')";
$add_dish_query_result = $mysqli->query($add_dish_query);
	 echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Video added successfully.</div></div></div>';
			}
		  }
	   } 
	else{
          echo $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Invalid file extension.</div></div></div>';
       }
}
}
if (isset($_POST['video_action'])) {
     $video_action = $_POST['video_action'];
	 if ($video_action == "load") {
        $list_dish_query = "Select * From `video`";
        $result_dish_query = $mysqli->query($list_dish_query);
        $list_dish = '<tbody><tr>
                                                <th>Video</th>
                                                <th>Action</th>
                                            </tr>';
        if ($result_dish_query->num_rows == 0) {
            $list_dish .= '<tr><td colspan=5><center>No record found.</center></td></tr>';
        } else {
            while ($row = $result_dish_query->fetch_assoc()) {
				if($row['dish_status']=='Active'){
					$faclass = "fa-rotate-180 inactive";
				} else{
					$faclass = "";
				}
				
                $list_dish .= '
				<input type="hidden" name="id" id="id" value="' . $row['id'] . '">
				<tr id="'.$row['id'].'">
                                    <td>' . $row['video'] . '</td>
                                   
                                    <td>
                                        <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#modal-viewvideo" id="view_video" dataid="' . $row['id'] . '"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-social-icon btn-danger" data-toggle="modal" data-target="#modal-delete" id="delete_record" dataid="' . $row['id'] . '"><i class="fa fa-trash"></i> </a>  
                                    </td>
                                  </tr>';
				
				

            }
        }
        echo $list_dish . "</tbody>";
    }
	if ($video_action == "edit_load_record") {
        $result = $mysqli->query("SELECT * FROM `video` WHERE `id`='" . $_POST['video_id'] . "'");
        $row = $result->fetch_assoc();
		  echo $variable_list = '
		  <input type="hidden" name="video_id" id="video_id" value="'.$row['id'].' ">
		  <div class="col-md-6 col-sm-6">
               <label>
                  <input type = "file"  class="form-control" name = "video" id="video" />
               </label>
          </div>
		  <div class="col-md-6 col-sm-6">
            <label>
             <input type = "text" class="form-control" name = "name" id="name" value = "' . $row['name'] . '"  />
            </label>
         </div>	';
	}
	
	 if ($video_action == "delete") {
         $video_id = $_POST['video_id'];
        $notification_message = '';
        $query = "DELETE  FROM `video` WHERE `id`='" . $video_id . "'";
        if ($mysqli->query($query)) {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Video deleted successfully.</div></div></div><!-- //.Note section -->';
        } else {
            $notification_message = '<!-- //Note section --><div class="col-xs-12" id="session_msg"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Video not deleted. Please try again little later.</div></div></div><!-- //.Note section -->';
        }
        echo $notification_message;
    }
	if($video_action == 'viewvideo') {
		
			$result11 = $mysqli->query("SELECT * FROM `video` WHERE `id`='" . $_POST['video_id'] . "'");
        $row11 = $result11->fetch_assoc();
			$videourl = $row11['video'];
	echo $variable_list .= '
	<video autoplay controls style="max-width: 500px;">
  <source src="uploads/'.$videourl.'" type="video/mp4" >
</video>
	';
	}
	
}
    
   

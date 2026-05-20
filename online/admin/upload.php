
    <?php
include 'db.php';
include 'config.php';
ob_start();
	if(is_array($_FILES)) {
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $path = 'iconimages/'; // upload directory
    
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
    $path = $path.strtolower($final_image); 
    if(move_uploaded_file($tmp,$path)) 
    {
    $query12233 = "INSERT INTO `media` SET `icon`='".$path."'";
	$query12345s_result = $mysqli->query($query12233);
		echo 'Uploaded sucessfully';
		echo "</br>";
		 
    }
    } 
    else 
    {
    echo 'invalid';
    }
    }
    ?>
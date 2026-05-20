<?php
include('db.php');
//$mysqli = getdb();


   if(isset($_POST["Import"])){		
		echo $filename=$_FILES["file"]["tmp_name"];	

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	           $sql = "INSERT IGNORE into email_import (email,name) values ('".$getData[0]."','".$getData[1]."')";
	           $result = mysqli_query($mysqli, $sql);
			    // var_dump(mysqli_error_list($con));
			    // exit();
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"https://restaurantkamasutra.nl/online/admin/email_import.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
	




?>
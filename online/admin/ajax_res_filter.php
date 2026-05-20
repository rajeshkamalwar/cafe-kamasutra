<?php 
//Database connection
require_once 'db.php';
//insert into database

//code fetch//

if(!empty($_POST['id']) && isset($_POST['id'])) {

 $id = $_POST['id'];
 
 	if($id=='2'){

 		$output='';
		$check_user_id_exist=mysqli_query($mysqli,"SELECT * FROM reservation_tbl WHERE DATE(date) >= DATE(NOW()) ORDER BY date ASC");
		if(mysqli_num_rows($check_user_id_exist) > 0){
			$ttoals = mysqli_num_rows($check_user_id_exist);
			 while($array=mysqli_fetch_assoc($check_user_id_exist)){
			 	$i++; 
			                               

                            $output .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$array['name'].'</td>
                                        <td>'.$array['email'].'</td>
                                        <td>'.$array['phone'].'</td>
                                        <td>'.$array['person'].'</td>
                                        <td>'.date('d-m-Y',strtotime($array['date'])).'</td>
                                        <td>'.date('H:i',strtotime($array['time'])).'</td>
                                       
                                        <td>'.$array['msg'].'</td>
                                        <td>'.$array['res_status'].'</td>';
                                      
                                        if($array['res_status']=='complete'){
                                            $text='approved';
                                            $disabled='disabled';
                                            $class='btn-primary';
                                        }else{
                                              $text='pending';
                                              $class='btn-danger';
                                              $disabled='';
                                        }

                           


                            $output .='<td colspan="2" ><button type="button" '.$disabled.' onclick="approve(this,'.$array['res_id'].')" class="btn '.$class.'">'.$text.'</button> <button type="button" onclick="cancel(this,'.$array['res_id'].')" '.$disabled.' class="btn btn-success">Cancel</button><button type="button" onclick="deleter(this,'.$array['res_id'].')"  class="btn btn-primary">Delete</button></td>';
						
                       $output .='</tr>';
                   }
				 echo '<div class="ttaol_rres">Total reservations: '.$ttoals.'</div>';
	 	echo $output;

		}else{
			$output='';
	  echo $output;

		}
		
 

	}else if($id=='1'){

 		$output='';
		$check_user_id_exist=mysqli_query($mysqli,"SELECT * FROM reservation_tbl ORDER BY date ASC");
		if(mysqli_num_rows($check_user_id_exist) > 0){
	$ttoals = mysqli_num_rows($check_user_id_exist);
			 while($array=mysqli_fetch_assoc($check_user_id_exist)){
			 	$i++; 
			                               

                            $output .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$array['name'].'</td>
                                        <td>'.$array['email'].'</td>
                                        <td>'.$array['phone'].'</td>
                                        <td>'.$array['person'].'</td>
                                        <td>'.date('d-m-Y',strtotime($array['date'])).'</td>
                                        <td>'.date('H:i',strtotime($array['time'])).'</td>
                                       
                                        <td>'.$array['msg'].'</td>
                                        <td>'.$array['res_status'].'</td>';
                                      
                                        if($array['res_status']=='complete'){
                                            $text='approved';
                                            $disabled='disabled';
                                            $class='btn-primary';
                                        }else{
                                              $text='pending';
                                              $class='btn-danger';
                                              $disabled='';
                                        }

                           


                            $output .='<td colspan="2" ><button type="button" '.$disabled.' onclick="approve(this,'.$array['res_id'].')" class="btn '.$class.'">'.$text.'</button> <button type="button" onclick="cancel(this,'.$array['res_id'].')" '.$disabled.' class="btn btn-success">Cancel</button><button type="button" onclick="deleter(this,'.$array['res_id'].')"  class="btn btn-primary">Delete</button></td>';
						
                       $output .='</tr>';
                   }
				 echo '<div class="ttaol_rres">Total reservations: '.$ttoals.'</div>';
	 echo $output;

		}else{
			$output='';
	    echo $output;

		}
		
 
		
	}
	
	
	else if($id=='4'){

 		$output='';
		$check_user_id_exist=mysqli_query($mysqli,"SELECT * FROM reservation_tbl WHERE DATE(date) < DATE(NOW()) ORDER BY res_id DESC");
		if(mysqli_num_rows($check_user_id_exist) > 0){
			$ttoals = mysqli_num_rows($check_user_id_exist);
			 while($array=mysqli_fetch_assoc($check_user_id_exist)){
			 	$i++; 
			                               

                            $output .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$array['name'].'</td>
                                        <td>'.$array['email'].'</td>
                                        <td>'.$array['phone'].'</td>
                                        <td>'.$array['person'].'</td>
                                        <td>'.date('d-m-Y',strtotime($array['date'])).'</td>
                                        <td>'.date('H:i',strtotime($array['time'])).'</td>
                                       
                                        <td>'.$array['msg'].'</td>
                                        <td>'.$array['res_status'].'</td>';
                                      
                                        if($array['res_status']=='complete'){
                                            $text='approved';
                                            $disabled='disabled';
                                            $class='btn-primary';
                                        }else{
                                              $text='pending';
                                              $class='btn-danger';
                                              $disabled='';
                                        }

                           


                            $output .='<td colspan="2" ><button type="button" '.$disabled.' onclick="approve(this,'.$array['res_id'].')" class="btn '.$class.'">'.$text.'</button> <button type="button" onclick="cancel(this,'.$array['res_id'].')" '.$disabled.' class="btn btn-success">Cancel</button><button type="button" onclick="deleter(this,'.$array['res_id'].')"  class="btn btn-primary">Delete</button></td>';
						
                       $output .='</tr>';
                   }
				 echo '<div class="ttaol_rres">Total reservations: '.$ttoals.'</div>';
			echo $output;

		}else{
			$output='';
		    echo $output;

		}
	}
	
	
	
	else{
	
		 
		
    $output='';
    $check_user_id_exist=mysqli_query($mysqli,"SELECT * FROM reservation_tbl WHERE DATE(date) = DATE(NOW()) ORDER BY date ASC");
    if(mysqli_num_rows($check_user_id_exist) > 0){
	$ttoals = mysqli_num_rows($check_user_id_exist);
       while($array=mysqli_fetch_assoc($check_user_id_exist)){
        $i++; 
                                     

                            $output .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$array['name'].'</td>
                                        <td>'.$array['email'].'</td>
                                        <td>'.$array['phone'].'</td>
                                        <td>'.$array['person'].'</td>
                                        <td>'.date('d-m-Y',strtotime($array['date'])).'</td>
                                        <td>'.date('H:i',strtotime($array['time'])).'</td>
                                       
                                        <td>'.$array['msg'].'</td>
                                        <td>'.$array['res_status'].'</td>';
                                      
                                        if($array['res_status']=='complete'){
                                            $text='approved';
                                            $disabled='disabled';
                                            $class='btn-primary';
                                        }else{
                                              $text='pending';
                                              $class='btn-danger';
                                              $disabled='';
                                        }

                           


                            $output .='<td colspan="2" ><button type="button" '.$disabled.' onclick="approve(this,'.$array['res_id'].')" class="btn '.$class.'">'.$text.'</button> <button type="button" onclick="cancel(this,'.$array['res_id'].')" '.$disabled.' class="btn btn-success">Cancel</button><button type="button" onclick="deleter(this,'.$array['res_id'].')"  class="btn btn-primary">Delete</button></td>';
            
                       $output .='</tr>';
                   }
		
		 echo '<div class="ttaol_rres">Total reservations: '.$ttoals.'</div>';
		
     echo $output;

    }else{
      $output='';
     echo $output;

    }
  }
	
	 	
}
?>
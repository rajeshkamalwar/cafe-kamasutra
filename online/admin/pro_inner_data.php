<?php
require_once 'db.php';

if(isset($_POST['id']))
{

     $id = $_POST['id'];

$check_user_id_exist=mysqli_query($mysqli,"select *,promation_coupon_data_maintain.expire,promotion_discount_code_tbl.coupon_code,promation_coupon_data_maintain.type,promation_coupon_data_maintain.created from promotion_tbl inner join promation_coupon_data_maintain on promotion_tbl.id=promation_coupon_data_maintain.user_id inner join promotion_discount_code_tbl on promotion_discount_code_tbl.user_id=promation_coupon_data_maintain.user_id where promotion_tbl.id='".$id."' order by promotion_tbl.id desc");
?>

		<table class="table table-striped" style="border: 5px solid #ddd;">
            
              <thead>
                <tr>
                  <th scope="col">S.no</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Expiry Date</th>
                  <th scope="col">Discount/Free Dish</th>
					<th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>

         <?php            
              if(mysqli_num_rows($check_user_id_exist) > 0){      
		    $is=0;
            while($arrays=mysqli_fetch_assoc($check_user_id_exist)){ 
               $is++;   

            if(!empty($arrays['type'])){
                         if(is_numeric($arrays['type'])){

                          $type= $arrays['type'].'%';
                     }else{
                        $type= $arrays['type'];
                     }
                   }

                    if(empty($arrays['expire'])){
                         $expire_date='';
                       
                        }else{
                         $expire_date= date('d-m-Y',strtotime($arrays['expire']));

                        }

                        if(empty($arrays['created'])){
                         $created_date='';
                       
                        }else{
                           $created_date= date('d-m-Y',strtotime($arrays['created']));

                        }
                  
                        
                  ?>
	<tr>
		 <td><?php echo $is;?> </td>
		  <td><?php echo $arrays['name'];?></td>
		  <td><?php echo $arrays['email'];?></td>
		   <td><?php echo $created_date;?></td>
		   <td><?php echo $expire_date; ?></td>
		   <td><?php echo $type; ?></td>
		<td><?php if(!is_null($array['coupon_code'])){

                  if(empty($array['coupon_code'])){

                    echo "Yes";
                  }

                  else{
                    echo "No";
                  }
                
              }else{
                echo "";
              } ?></td>
		
		    </tr>
<?php 
	}

  	}else{
       ?>
    <tr>
             <td colspan="6" rowspan="1" align="center">No Data Found</td>
                 </tr>
 <?php  } ?>
	 </tbody>
            </table>


       
<?php 
}
?>
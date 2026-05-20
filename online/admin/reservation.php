<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
     <link rel="stylesheet" href="theme_assets/jquery.cleditor.css" />
    <script src="theme_assets/jquery.min.js"></script>
    <script src="theme_assets/jquery.cleditor.min.js"></script>
  <style>
      input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

.auto-approve-checkbox {
    margin-left: 22px;
    color: red;
    font-size: 15px;
}

.auto-approve-checkbox #auto-approve {
position:absolute;
left:15px;
   
}
	  .ttaol_rres {
    position: absolute;
    right: 20px;
    top: 0;
    font-weight: 600;
    font-size: 15px;
}
  </style>
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
        


        <div class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Coupon Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Reservation Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send Reservation Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Reservation Module</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
<?php 
                            $sqls = "select * from auto_approve_tbl where auto_status='1'";
                            $results = mysqli_query($mysqli,$sqls);
                            $data_check=mysqli_fetch_assoc($results);

                           ?>

    <div class="box-body table-responsive no-padding">

<div class="container">
	<div class="filter-section">
			
		<div class="form-group">
			<label>Reservation Filter</label>
			<select name="filter" onchange="filter(this)" id="filter" class="form-control" style="width:16%;">
				
				
        <option value="1">All</option>
        <option value="3" selected>Today</option>
				<option value="2">Upcoming</option>
	<option value="4">Old</option>
			</select>

		</div>
		
	    

	</div>
	
</div>
<div class="container">
<div class="auto-approve-checkbox"><input type="checkbox" <?php  echo  ($data_check['auto_status']=='1') ? 'checked':'';?> onclick="auto_approve(this)" id="auto-approve" name="auto-approve"> <label>Auto Approve </label> </div>
	<?php
	  $person_data2=mysqli_query($mysqli,"select * from date_tbl where id='12'");
          $person_data_22=mysqli_fetch_assoc($person_data2);   
		  $start_timeee =$person_data_22['week']; 
	?>
<div class="persone-limit"><input type="number"  id="limitapprove" name="limitapprove"  value="<?php if($start_timeee!=55){echo $start_timeee; }?>">    
	<button type="button" onclick="peron_limit(this)"     class="btn btn-primary">ADD person limit</button></div>		
		
		</div>
	 
                                    <div class="col-sm-12" style="margin-top:20px">
                                             <div class="msg" style="display:none;"></div>
                    <table class="table table-striped" id="refresh">
                        
                          <thead>
                            <tr>
                                  <th scope="col">Serial No</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Phone</th>
                                  <th scope="col">Person</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Time</th>
                                 
                                  <th scope="col">Message</th>
                                   <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                                  
                                  
                            </tr>
                          </thead>
                          <tbody id="table_data">
                            <?php

                            $sql = "SELECT * FROM reservation_tbl WHERE DATE(date) = DATE(NOW()) ORDER BY res_id DESC";
                          //  $sql = "SELECT * FROM reservation_tbl WHERE date  > DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY res_id DESC";
                            $result = mysqli_query($mysqli,$sql);
                            
                           ?>
                        <div class="ttaol_rres ttaol_rres1">Total reservations: <?php echo $result->num_rows; ?></div>
                            <?php if ($result->num_rows > 0): ?>

                            <?php 
                            $i=0;
                            while($array=mysqli_fetch_assoc($result)): 

                                $i++; 
                                ?>
                         
                                <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $array['name'];?></td>
                                        <td><?php echo $array['email'];?></td>
                                        <td><?php echo $array['phone'];?></td>
                                        <td><?php echo $array['person'];?></td>
                                        <td><?php echo date('d-m-Y',strtotime($array['date']));?></td>
                                        <td><?php echo date('H:i',strtotime($array['time']));?></td>
                                       
                                        <td><?php echo $array['msg'];?></td>
                                        <td><?php echo $array['res_status'];?></td>
                                        <?php 
                                        if($array['res_status']=='complete'){
                                            $text='approved';
                                            $disabled='disabled';
                                            $class='btn-primary';
                                        }else{
                                              $text='Approve';
                                              $class='btn-danger';
                                              $disabled='';
                                        }

                                        
                                      ?>


                                      <td colspan="2" ><button type="button" <?php echo $disabled; ?> onclick="approve(this,<?php echo $array['res_id'];?>)" class="btn <?php echo $class; ?>"><?php echo $text?></button> <button type="button" onclick="cancel(this,<?php echo $array['res_id'];?>)"   class="btn btn-success">Cancel</button><button type="button" onclick="deleter(this,<?php echo $array['res_id'];?>)"   class="btn btn-primary">Delete</button></td>

                                    

                                 </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                        <td colspan="3" rowspan="1" headers="">No Data Found</td>
                        </tr>
                        <?php endif; ?>
                        <?php mysqli_free_result($result); ?>
                        </tbody>

                         
                    </table>
               </div>
                              

            </div>

             </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->
 

<!--<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>
-->
     <?php include 'footer.php'; ?>					

<script>


$(document).ready(function(){

 setInterval(function(){
  $('.msg').hide();


 }, 8000);

});
  
//approve js//

  function approve(t,id) {  
   if(id){
        //if(confirm("Are you sure you want to approve this?"))
        {
      $.ajax({  
        type: "POST",  
        url: "ajax_approve_reject.php",  
        data: { "id": id },
        success: function(data) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Booking approve successfully</div>');
              $("#refresh").load(location.href + " #refresh"); 
              $("#badge").load(location.href + " #badge"); 
        }
    });


        }
   }

  }

  //cancel

  function cancel(ts,id) {  
   if(id){
        if(confirm("Are you sure you want to cancel this?"))
        {
      $.ajax({  
        type: "POST",  
        url: "ajax_cancel_req.php",  
        data: { "id": id },
        success: function(data) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-danger" role="alert">Booking cancel successfully</div>');
              $("#refresh").load(location.href + " #refresh"); 
              $("#badge").load(location.href + " #badge"); 
        }
    });


        }
   }

  }


   //auto_approve

  function auto_approve(v) {     
          if(v.checked==true){
            check='1';
              $text='Are you sure you want enable auto approve feature?';
          } else{
            check='2';
            $text='Are you sure you want disabled auto approve feature?';
          }       

        if(confirm($text)){

      $.ajax({  
        type: "POST",  
        url: "ajax_autoapprove.php",  
        data: {"check":check},
        success: function(response) {    
            $(".msg").hide();
            if(response==2){           
                $(".msg").show().html('<div class="alert alert-success" role="alert">Auto approve disabled successfully</div>');
         }else{
               $(".msg").show().html('<div class="alert alert-success" role="alert">Auto approve enabled successfully</div>');
         }
       
        }
    });


        }
   }

 
	
		  function deleter(ts,id) {
  
   if(id){
        if(confirm("Are you sure you want to delete this?"))
        {
      $.ajax({  
        type: "POST",  
        url: "ajax_delete_req.php",  
        data: { "id": id },
        success: function(data) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-danger" role="alert">Booking deleted</div>');
              $("#refresh").load(location.href + " #refresh"); 
              $("#badge").load(location.href + " #badge"); 
        }
    });


        }
   }

  }	

  
</script>

 
<script>  
	
	function filter(fitr){
  $('.ttaol_rres1').fadeOut();
		var id=$(fitr).val();

		if(id){
 
		    $.ajax({  
		        type: "POST",  
		        url: "ajax_res_filter.php",  
				///   dataType: "json",
		        data: { "id": id },
		        success: function(data) { 
		    
					 
					
		           $("#table_data").empty();
		           $("#table_data").html(data);
					///$('.ttoalres').empty();
				///   $(".ttoalres").html(data.total_res);
		             
		        }
      });
		


		}

	}
	
	
	  function peron_limit(v) {     
     
   var perlimt=$('#limitapprove').val();
		 
   if(perlimt==''){ perlimt = 55; }
     $.ajax({  
        type: "POST",  
        url: "ajax_person_limit.php",  
        data: {"perlimt":perlimt},
        success: function(response) {    
                      
                $(".msg").show().html('<div class="alert alert-success" role="alert">Person successfully</div>');
         
       
		}
   });


       
   }

	
</script>
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
        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent !important;
            }
            .btn-social-icon > :first-child {
                font-size: 14px !important;
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
                        Tip Setting
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Tip Setting</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

               
				  <div class="box-body pad">
					  
							  <?php 
								        $query = "Select * From `tipamounts`";
								$result_query = $mysqli->query($query);
								//	$row = $result_query->fetch_assoc();
    '<select name="tipamt"  id="tipamt"> <option value="">Choose</option>    ';
		$status = '';			  
	 while (
		 
		 $row = $result_query->fetch_assoc()) {
		 $tip1=$row['tipval1'];
		 $tip2=$row['tipval2'];
		 $tip3=$row['tipval3'];
		 $tip4=$row['tipval4'];
		  $tip5=$row['tipval5'];
		  $tip6=$row['tipval6'];
		 $tip7=$row['tipval7'];
		 $tip8=$row['tipval8'];
		  $tip9=$row['tipval9'];
		  $tip10=$row['tipval10'];
		 
		$status=   $row['status'];
		 
		 '<option  value="'.$row['tipval1'].'" />'.$row['tipval1'].'</option> ';
		 '<option  value="'.$row['tipval2'].'" />'.$row['tipval2'].'</option> ';
		 '<option  value="'.$row['tipval3'].'" />'.$row['tipval3'].'</option> ';
		 '<option  value="'.$row['tipval4'].'" />'.$row['tipval4'].'</option> ';
		 '<option  value="'.$row['tipval5'].'" />'.$row['tipval5'].'</option> ';
		 '<option  value="'.$row['tipval6'].'" />'.$row['tipval6'].'</option> ';
		 '<option  value="'.$row['tipval7'].'" />'.$row['tipval7'].'</option> ';
		 '<option  value="'.$row['tipval8'].'" />'.$row['tipval8'].'</option> ';
		 '<option  value="'.$row['tipval9'].'" />'.$row['tipval9'].'</option> ';
		 '<option  value="'.$row['tipval10'].'" />'.$row['tipval10'].'</option> ';
		 
		 
	 }
	 '</select>';
								?>		  
              <form>
                  <div class="form-group">
                            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                  <label for="attributes name">Options 1</label>
                <input type="text" id="tipamt1" name="tipamt1" value="<?php echo $tip1;?>" class="form-control"></div>
                                                <div class="col-md-6 col-sm-12">
					  <label for="attributes name">Options 2</label>
													
                          <input  type="text" id="tipamt2" name="tipamt2" value="<?php echo $tip2;?>" class="form-control"></div>
					  
					  </div>
					  
				   <div class="row">
                                                <div class="col-md-6 col-sm-12">
                   <label for="attributes name">Options 3</label>
                  <input type="text" id="tipamt3" name="tipamt3" value="<?php echo $tip3;?>" class="form-control"></div> 
                                                <div class="col-md-6 col-sm-12">
					  <label for="attributes name">Options 4</label>
													
                            <input type="text" id="tipamt4" name="tipamt4" value="<?php echo $tip4;?>" class="form-control"></div>
					  
					  </div>
					  
					  <div class="row">
                                                <div class="col-md-6 col-sm-12">
                   <label for="attributes name">Options 5</label>
                  <input type="text" id="tipamt5" name="tipamt5" value="<?php echo $tip5;?>" class="form-control"></div> 
                                                <div class="col-md-6 col-sm-12">
					  <label for="attributes name">Options 6</label>
													
                            <input type="text" id="tipamt6" name="tipamt6" value="<?php echo $tip6;?>" class="form-control"></div>
					  
					  </div>
					  <div class="row">
                                                <div class="col-md-6 col-sm-12">
                   <label for="attributes name">Options 7</label>
                  <input type="text" id="tipamt7" name="tipamt7" value="<?php echo $tip7;?>" class="form-control"></div> 
                                                <div class="col-md-6 col-sm-12">
					  <label for="attributes name">Options 8</label>
													
                            <input type="text" id="tipamt8" name="tipamt8" value="<?php echo $tip8;?>" class="form-control"></div>
					  
					  </div>
					  <div class="row">
                                                <div class="col-md-6 col-sm-12">
                   <label for="attributes name">Options 9</label>
                  <input type="text" id="tipamt9" name="tipamt9" value="<?php echo $tip9;?>" class="form-control"></div> 
                                                <div class="col-md-6 col-sm-12">
					  <label for="attributes name">Options 10</label>
													
                            <input type="text" id="tipamt10" name="tipamt10" value="<?php echo $tip10;?>" class="form-control"></div>
					  
					  </div>
					  
				  </div>											 
				  <select class="form-control" rows="2" id="tipstatus" name="tipstatus">
												<option value="Active" <?php if($status=='Active'){echo 'selected'; } ?>>Active</option>
					                             <option value="Inactive"   <?php if($status=='Inactive'){echo 'selected'; } ?>>Inactive</option>

											</select>
				      <input type="hidden" value="<?php if($status=='Active'){ echo 'Active'; }else { echo 'Inactive'; } ?>" name="status" id="status" >
                          <input type="button" name="submit" id="update_tipamt"  class="btn btn-primary" value="Submit" />
				  
				   
                          
              </form>
					  
					  
					  
            </div>	
					
					
                  

                </section>
                <!-- /.Inner content -->


            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
           <script>
			        url = b_url + 'tipupdate_action.php';
			     $(document).on('click', '#update_tipamt', function () {
		var welcmtxt_action = 'edit';
               
                    var tipamt1 = $('#tipamt1').val();
                    var tipamt2 = $('#tipamt2').val();
					var tipamt3 = $('#tipamt3').val();
					var tipamt4 = $('#tipamt4').val();
					var tipamt5 = $('#tipamt5').val();
					var tipamt6 = $('#tipamt6').val();
					var tipamt7 = $('#tipamt7').val();
					var tipamt8 = $('#tipamt8').val();
					var tipamt9 = $('#tipamt9').val();
					var tipamt10 = $('#tipamt10').val(); 
					 var status = $('#status').val();
			 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: 'update_tip',
                            'tipamt1': tipamt1,
                            'tipamt2': tipamt2,
							'tipamt3': tipamt3,
                            'tipamt4': tipamt4,
							'tipamt5': tipamt5,
							'tipamt6': tipamt6,
							'tipamt7': tipamt7,
                            'tipamt8': tipamt8,
							'tipamt9': tipamt9,
							'tipamt10': tipamt10,
								'status': status
			                        },
                        dataType: "html",
                        success: function (data)
                        {
                           
console.log(data);

                        }
                    });
                });
			   
		jQuery(document).ready(function($) { 
			 
		     $('#tipstatus').on('change', function (e) {
		   var optionSelected = $("option:selected", this);
            var selectamt = optionSelected.val() ;
			$('#status').val(selectamt);	 
		
				
        }); 	
}); 
    		 
			   
			</script>
    </body>
</html>

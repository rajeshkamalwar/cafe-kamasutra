<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
date_default_timezone_set('Asia/Kolkata');

$before_time_slot=[
					'15 mintue'=>'15 mintue',
					'30 mintue'=>'30 mintue',
					'45 mintue'=>'45 mintue',
					'1 hour'=>'1 hour',
	                '2 hour'=>'2 hour',
					 '3 hour'=>'3 hour',
					 '4 hour'=>'4 hour',
					 '5 hour'=>'5 hour',
	 				 '0 mintue'=>'Till last moment',
	                 
				];
 $time_slot=[
             '1'=>'00.00', 
             '2'=>'00.30', 
             '3'=>'01.00', 
             '4'=>'01.30', 
             '5'=>'02.00', 
             '6'=>'02.30', 
             '7'=>'03.00', 
             '8'=>'03.30', 
             '9'=>'04.00', 
             '10'=>'04.30', 
             '11'=>'05.00', 
             '12'=>'05.30', 
             '13'=>'06.00', 
             '14'=>'06.30', 
             '15'=>'07.00', 
             '16'=>'07.30', 
             '17'=>'08.00', 
             '18'=>'08.30', 
             '19'=>'09.00', 
             '20'=>'09.30', 
             '21'=>'10.00', 
             '22'=>'10.30', 
             '23'=>'11.00', 
             '24'=>'11.30', 
             '25'=>'12.00', 
             '26'=>'12.30', 
             '27'=>'13.00', 
             '28'=>'13.30', 
             '29'=>'14.00', 
             '30'=>'14.30', 
             '31'=>'15.00', 
             '32'=>'15.30', 
             '33'=>'16.00', 
             '34'=>'16.30', 
             '35'=>'17.00', 
             '36'=>'17.30', 
             '37'=>'18.00', 
             '38'=>'18.30', 
             '39'=>'19.00', 
             '40'=>'19.30', 
             '41'=>'20.00', 
             '42'=>'20.30', 
             '43'=>'21.00', 
             '44'=>'21.30', 
             '45'=>'22.00', 
             '46'=>'22.30', 

      ];

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
left:5px;
   
}

.form-row {
    float: left;
    width: 100%;
    padding: 20px;
    margin: 5px 0;
    border-radius: 3px;
}

.form-row:nth-child(odd) {
    background: #e9e9e9;
}
.chooseopt label {
    margin-left: 10px;
}
.chooseopt {
    width: 49%;
    display: inline-block;
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
                      Date Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Date Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send date Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about date Module</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>


    <div class="box-body table-responsive no-padding">
                          <div class="msg" style="display:none;"></div>              
            
                                    <form method="POST"  >
                                   
                                    <!-- //fetch date// -->
                                    <?php 
                                      $get_date=mysqli_query($mysqli,"select * from date_tbl where id='1'");
                                      if(mysqli_num_rows($get_date) > 0){

                                        $get_date=mysqli_fetch_assoc($get_date);
                                        $sdate=date('d/m/Y',strtotime($get_date['sdate']));
                                        $edate=date('d/m/Y',strtotime($get_date['edate']));
                                      }

                                      ?>
                                        <div class="col-sm-12" style="margin-top: 15px;"  >
                                        <div class="col-sm-3">
                                                <h4>Restaurant Close</h4>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 15px;">
                                        <div class="form-row" style="display:none;">    
                                            <div class="col-sm-4">
                                                <label>Start Date</label> 
                                      <input type="text" class="form-control" autocomplete="off" id="sdate" name="sdate" value="<?php echo ($sdate!='30/11/-0001') ? $sdate:'';?>" >
                                     </div>
                                             <div class="col-sm-4">
                                                 <label>End Date</label>
                                      <input type="text" class="form-control" autocomplete="off" id="edate" name="edate" value="<?php echo ($edate!='30/11/-0001') ? $edate:'';?>" >
                                     </div>
									
                                            <div class="col-sm-4" style="margin-top: 20px;">
                                            <button type="button" onclick="set_date(this)" name="submitdate" class="btn btn-primary">Set date</button>
                                     </div>
                                        </div>
										
									 <div class="form-row">   	
                                     <form method="post" name="week_form" id="week_form">
									
                                             <div class="col-sm-12">
                                                <h4>Close Working day</h4>

                                                <div class="week-wrapper">
                                                  <?php 
                                       $get_week=mysqli_query($mysqli,"select * from date_tbl where id='2'");
                                    

                                        $get_week=mysqli_fetch_assoc($get_week);
                                      
                                        $week_check=explode(',',$get_week['week']);

                                    
                                                     $week = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wendnesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday','0'=>'Sunday');
                                                       $i=0;
                                              foreach ($week as $key=>$dayName) { 
                                                 
                                                      $i++;
                                                     if($i==7){
                                                        $i=0;
                                                     }
                                                   
                                                
                                                      
                                                            ?>
															<div class="chooseopt">
                                                   <input type="checkbox" value="<?php echo $i;?>" class="weeks" name="week_days[]" <?php if($week_check[0]!=''){ if(in_array($i,$week_check)){ echo 'checked';}else{echo '';} }?>> <label><?php echo $dayName;?></label></div>
																					
                                             <?php  }?>

                                            
                                                </div>
                                                 <button type="button" onclick="set_days(this)" name="set_day" class="btn btn-primary">Set day</button>
                                            </div>
										
                                        </form>
									</div>
						
                                   <?php 
                                      $get_t=mysqli_query($mysqli,"select * from date_tbl where id='5'");
                                      if(mysqli_num_rows($get_t) > 0){
                                        $get_t=mysqli_fetch_assoc($get_t);
                                        $stt=$get_t['st'];
                                        $ett=$get_t['et'];
                                      }		 
		    						  $get_t_1=mysqli_query($mysqli,"select * from date_tbl where id='13'");
                                      if(mysqli_num_rows($get_t_1) > 0){
                                        $get_t_1=mysqli_fetch_assoc($get_t_1);
                                        $stt_1=$get_t_1['st'];
                                       $ett_1=$get_t_1['et'];
										 
                                      }
                  					$get_t_2=mysqli_query($mysqli,"select * from date_tbl where id='14'");
                                      if(mysqli_num_rows($get_t_2) > 0){
                                        $get_t_2=mysqli_fetch_assoc($get_t_2);
                                        $stt_2=$get_t_2['st'];
                                       $ett_2=$get_t_2['et'];
                                      }	
									 $get_t_3=mysqli_query($mysqli,"select * from date_tbl where id='15'");
                                      if(mysqli_num_rows($get_t_3) > 0){
                                        $get_t_3=mysqli_fetch_assoc($get_t_3);
                                        $stt_3=$get_t_3['st'];
                                      $ett_3=$get_t_3['et'];
                                      }	
									 $get_t_4=mysqli_query($mysqli,"select * from date_tbl where id='16'");
                                      if(mysqli_num_rows($get_t_4) > 0){
                                        $get_t_4=mysqli_fetch_assoc($get_t_4);
                                        $stt_4=$get_t_4['st'];
                                       $ett_4=$get_t_4['et'];
                                      }		
									 $get_t_5=mysqli_query($mysqli,"select * from date_tbl where id='17'");
                                      if(mysqli_num_rows($get_t_5) > 0){
                                        $get_t_5=mysqli_fetch_assoc($get_t_5);
                                        $stt_5=$get_t_5['st'];
                                        $ett_5=$get_t_5['et'];
                                      }	
                 			         $get_t_6=mysqli_query($mysqli,"select * from date_tbl where id='18'");
                                      if(mysqli_num_rows($get_t_6) > 0){
                                        $get_t_6=mysqli_fetch_assoc($get_t_6);
                                        $stt_6=$get_t_6['st'];
                                       $ett_6=$get_t_6['et'];
                                      }	
                                      ?>
						     <div class="form-row  chooseday-timerow" style="background: #e9e9e9;">  
                                  <label>Timy by day</label> 								 
								   <input type="hidden"  name="todays_day" id="todays_day" value="Monday">  										  
                                      <form method="post" name="" id=""  class=""> 
										  
									<table class="table table-hover" id="list_data">
                                                <thead>
                                                <tr><th>Day</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
												<tbody id="time_tbl">	  
										   <tr>
										   <td>Monday</td>
										   <td><select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_1">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
										   <td> <select id="t_end" name="t_end" class="form-control t_start alltime_hide t_end_d_1">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
										   </tr>
									  <tr>
									  <td>Tuesday</td>
									  <td>  <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_2" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_1==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select></td>
									  <td>    <select id="t_start" name="t_start" class="form-control t_start alltime_hide  t_end_d_2">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_1==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select></td>
									  </tr>
									  
									  <tr>
									  <td>Wendnesday</td>
									  <td>   <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_3" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_2==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>  </td>
									  <td>   <select id="t_start" name="t_start" class="form-control t_start alltime_hide  t_end_d_3">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_2==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>  </td>
									  </tr>

									  <tr>
									  <td>Thursday</td>
									  <td> <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_4" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_3==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>   </td>
									  <td> <select id="t_start" name="t_start" class="form-control t_start alltime_hide  t_end_d_4" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_3==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
									  </tr>

									  <tr>
									  <td>Friday</td>
									  <td> <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_5">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_4==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>  </td>
									  <td>            
										   <select id="t_start" name="t_start" class="form-control t_start alltime_hide  t_end_d_5" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_4==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>  </td>
									  </tr>
									  
									  <tr>
									  <td>Saturday</td>
									  <td>  <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_6" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_5==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
									  <td> <select id="t_start" name="t_start" class="form-control t_start alltime_hide  t_end_d_6">
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_5==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
									  </tr>
									  <tr>
									  <td>Sunday</td>
									  <td> 	
                                       <select id="t_start" name="t_start" class="form-control t_start alltime_hide time_d_7" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($stt_6==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select> </td>
									  <td> <select id="t_start" name="t_start" class="form-control t_start alltime_hide t_end_d_7" >
                                          <option value="">Select start time</option>                                         
                                          <?php									
										 foreach($time_slot as $k=>$val){$select='';if($ett_6==$val){$select='selected';} ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>
                                        <?php } ?>                              
                                    </select>		  
										  </td>
									  </tr>
									 </tbody>
					</table>									 
									  							  
                                   
										           
										             
										            
										
                                     
                                               
                             									  
								
                                 
										           
										             
										  	
                                      
										  
                                      
                                            <div class="col-md-4" style="margin-top: 20px;">
                                            <button type="button" onclick="create_timee(this)" name="" class="btn btn-primary">Set time slot</button>
                                       </div>
									   
                                        </form>
                                  
								   </div>					
											
											

                                          <!--time-->

										 <div class="form-row">  
                                           <form method="post" name="time_form" id="time_form">										   
                                             <div class="col-sm-12">
                                                <h4>Time Interval</h4>

                                                <div class="time-wrapper">
                                               
                                                  <?php 
                                                   $get_time=mysqli_query($mysqli,"select * from date_tbl where id='3'");
                                                

                                                    $get_time=mysqli_fetch_assoc($get_time);
                                                 ?>
                                                    <label>Time(in minutes only)</label><input type="text" value="<?php echo $get_time['json_date'] ? $get_time['json_date']:'';?>" class="time-set" name="time">

                                 
<button type="button" onclick="set_times(this)" name="set_time" class="btn btn-primary">Set Time</button>
                                            
                                                </div>
                                 
                                            </div>
										
                                        </form>
									</div>



                                        <!--person set-->

                                         <!--time-->

										  <div class="form-row">  
                                           <form method="post" name="person_form" id="person_form">										  
                                             <div class="col-sm-12">
                                                <h4>Person </h4>

                                                <div class="person-wrapper">
                                               
                                                  <?php 
                                                   $get_person=mysqli_query($mysqli,"select * from date_tbl where id='4'");
                                                

                                                    $get_person=mysqli_fetch_assoc($get_person);
                                                 ?>
                                                    <label>Person value</label><input type="text" value="<?php echo $get_person['json_date'] ? $get_person['json_date']:'';?>" class="person_set" name="person">

                                 

                                             <button type="button" onclick="set_persons(this)" name="set_person" class="btn btn-primary">Set Person</button>
                                                </div>
                                         
                                            </div>
										
                                        </form>
										</div>

                                        </div>





                                    </form><br>
                                 

                                      <?php 
                                      $get_bt=mysqli_query($mysqli,"select * from date_tbl where id='9'");
                                      if(mysqli_num_rows($get_bt) > 0){
                                        $get_bt=mysqli_fetch_assoc($get_bt);
                                        $bts=$get_bt['before_time'];                               
                                      }         ?>

								<div class="form-row">                                  
                                      <form method="post" name="" id="">  
                                       <div class="col-md-4">
                                      <label>Before Time</label> 
                                     <select id="before_time" name="before_time" class="form-control">
                                          <option value="">Select time</option>
                                         
                                          <?php foreach($before_time_slot as $k=>$val){ 
                                                   $select='';

                                                  if($bts==$k){

                                                    $select='selected';

                                                  }
                                            ?>
                                          <option value="<?php echo $k;?>" <?php echo $select;?>><?php echo $val;?></option>

                                        <?php } ?>
                              
                                    </select>
										   	<?php 
							
								echo 'Current time : ' .$bts;
								?>
                                     </div>
                                          
                                            <div class="col-md-4" style="margin-top: 20px;">
                                            <button type="button" onclick="before_timesss(this)" name="" class="btn btn-primary">Set time</button>
                                       </div>
										  
                                        </form>
								
							
                                  
								</div>
                                  <?php/// }?>
		
		<div class="form-row">
                                  <?php
				 							 $chk_in_odrdis_tab = "SELECT * FROM `res_days_settings`";      
											 $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
										     $email_result1=mysqli_fetch_assoc($chk_in_odrdis_tab_result);
									?>
                                  <form method="post" name="" id="">  
                                       <div class="col-md-4">
                                      <label>Today Off</label> 
                                    		 <input type="checkbox" value="<?php echo $i;?>" class="today_off" name="today_off" <?php if($email_result1['is_off']==1){  echo 'checked'; } ?>>
										     <br><?php
										  
										    if($email_result1['is_off']==1){
												echo 'Today booking is on';
											}
										  else {
											  echo 'Today booking is off';
										  }
										     
										  ?>
                                     </div>
                                          
                                            <div class="col-md-4" style="margin-top: 20px;">
                                            <button type="button" onclick="today_off_fun(this)" name="" class="btn btn-primary">save</button>
                                       </div>
										
										  
                                        </form>
                                  
								</div>
		
		
		<div class="form-row">   
			<?php
			 $earl_reservations=mysqli_query($mysqli,"select * from date_tbl where id='10'");   
			$earl_reservations2=mysqli_fetch_assoc($earl_reservations);
	 	    $earfinal=$earl_reservations2['week'];
		 
			?>
                            <form method="post" name="" id="">  
                                       <div class="col-md-4">
                                      <label>Early reservations</label> 
                                     <select id="advance_res" name="advance_res" class="form-control">
                                        <option value="0" <?php if($earfinal==0){echo 'selected';} ?>>Always</option>
										<option value="1" <?php if($earfinal==1){echo 'selected';} ?>>From 1 day in advance</option>
										<option value="7" <?php if($earfinal==7){echo 'selected';} ?>>From 1 week in advance</option>
										<option value="14" <?php if($earfinal==14){echo 'selected';} ?>>From 2 weeks in advance</option>
										<option value="30" <?php if($earfinal==30){echo 'selected';} ?>>From 30 days in advance</option>
										<option value="60" <?php if($earfinal==60){echo 'selected';} ?>>From 60 days in advance</option>
										<option value="90" <?php if($earfinal==90){echo 'selected';} ?>>From 90 days in advance</option>                            
                                    </select>
										   	<?php 
							
							///	echo 'Current days : ' .$bts;
								?>
                                     </div>                                          
                                            <div class="col-md-4" style="margin-top: 20px;">
                                            <button type="button" onclick="advance_res1(this)" name="" class="btn btn-primary">Set days</button>
                                       </div>										  
                                        </form>						
							
                                  
								</div>
		<div class="form-row"> 
			<?php
			
 $advance_booking2=mysqli_query($mysqli,"select * from date_tbl where id='11'");   
	$advance_booking_fetch2=mysqli_fetch_assoc($advance_booking2);
	 $datesfordsiable=$advance_booking_fetch2['json_date'];
			
           $array = explode(",", $datesfordsiable);	
		if($array[0]!=''){
	 
		 }

		if($array[1]!=''){ 
				$date2 = date('d-m-Y',strtotime($array[1]));
			$dsidartes ="'$date1'".','."'$date2'";}
		if($array[2]!=''){ 
				$date3 = date('d-m-Y',strtotime($array[2]));
			$dsidartes ="'$date1'".','."'$date2'".','."'$date3'"; 

}
			if($datesfordsiable=="10-10-1070"){ $datesfordsiable = ''; }
			?>
			
			
			<label>Days off</label>
			<br>
 <div class="col-sm-4">
	
 <button type="button"   name="appendmore" class="btn btn-primary appendmore">+</button>	 
 <input type="text"  id="d_off1"  class="datsofff d_off1 form-control"  value="<?php echo $datesfordsiable; ?>"  style="display:none;">	 
 <button type="button" onclick="date_off1(this)" name="submitdateclose" class="btn btn-primary submitdateclose"  style="display:none;">Remove dates</button>
 
 <div class="col-sm-4" style="margin-top: 20px;">
 <button type="button" onclick="date_off(this)" name="submitdate" class="btn btn-primary">Set date</button>
                                     </div>
                                        </div>
		
                                </div>

             </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->
 

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>



<!-- Bootstrap 3.3.7 -->
<script src="theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="theme_assets/bower_components/raphael/raphael.min.js"></script>
<script src="theme_assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="theme_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="theme_assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="theme_assets/bower_components/moment/min/moment.min.js"></script>
<!-- <script src="theme_assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<!-- <script src="theme_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="theme_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
 
<!-- FastClick -->
 
<!-- AdminLTE App -->
<script src="theme_assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme_assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme_assets/dist/js/demo.js"></script>
<script src="theme_assets/plugins/iCheck/icheck.min.js"></script>
<script>

  //set today off codes//



      $('#sdate').datepicker({
            format: 'dd/mm/yyyy',
            startDate: new Date(),
            autoclose: true,
		
            orientation: "bottom"
        });

        $('#edate').datepicker({
            format: 'dd/mm/yyyy',
            startDate: new Date(),
            autoclose: true,
            orientation: "bottom"
        });
        $('.datsofff').datepicker({
            format: 'dd-mm-yyyy',
            startDate: new Date(),
            autoclose: false,
            multidate: true,
        });
 function advance_res1(aaa) {
   var at_1=$('#advance_res option:selected').val();  
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: { "at_1": at_1},
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Advance booking successfully</div>');
              
        }
    }); 
  }
	

 function set_date(a) {
  var sdate=$('#sdate').val();
  var edate=$('#edate').val();
  // if(sdate!='' && edate!=''){
      
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: { "sdate": sdate,"edate":edate },
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Date range set successfully</div>');
              
        }
    });


       // }
   

  }

 function before_timesss(aaa) {
  var bt=$('#before_time').val();     
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: { "bt": bt},
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Before Time set successfully</div>');
              
        }
    }); 
  }
	

		
	
 function date_off(aaa) {
  	  var d_off1=$('#d_off1').val();    
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: { "d_off1": d_off1},
        success: function(response) { 
     	console.log(response);
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Before Time set successfully</div>');
              
        }
    }); 
  }
	
 function date_off1(aaa) {
  	  var d_off2=1;    
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: { "d_off2": d_off2},
        success: function(response) { 
     	console.log(response);
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">successfully</div>');
              
        }
    }); 
  }
	
	

 function create_timee(aa) {
	var st=0;
	var et=0;
    
	 
	  var st_1=$('.time_d_1 option:selected').text();
		  var et_1=$('.t_end_d_1 option:selected').text(); 	 
	  
 	   var st_2=$('.time_d_2 option:selected').text();
	 	  var et_2=$('.t_end_d_2 option:selected').text(); 	 
	 
	    var st_3=$('.time_d_3 option:selected').text();
		   var et_3=$('.t_end_d_3 option:selected').text(); 	 
	 
	 	   var st_4=$('.time_d_4 option:selected').text();
			   var et_4=$('.t_end_d_4 option:selected').text(); 	 
	 
	    var st_5=$('.time_d_5 option:selected').text();
			  var et_5=$('.t_end_d_5 option:selected').text(); 	 
	  
	   var st_6=$('.time_d_6 option:selected').text();
			  var et_6=$('.t_end_d_6 option:selected').text(); 	 
	 
	   var st_7=$('.time_d_7 option:selected').text();
			  var et_7=$('.t_end_d_7 option:selected').text(); 	 
	  
	 
	 
	  
      $.ajax({  
        type: "POST",  
        url: "ajax_date_control.php",  
        data: {"st_1": st_1,"et_1":et_1,"st_2": st_2,"et_2":et_2,"st_3": st_3,"et_3":et_3,"st_4": st_4,"et_4":et_4,"st_5": st_5,"et_5":et_5,"st_6": st_6,"et_6":et_6,"st_7": st_7,"et_7":et_7,},
        success: function(response) { 
     console.log(response);
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Time slot set successfully</div>');
              
        }
    });

   

  }
  
//days codes//
 function set_days(as) {

var week = new Array();
$("input:checked").each(function() {
   week.push($(this).val());
});


      $.ajax({  
        type: "POST",  
        url: "ajax_week.php",  
        data: { "week":week },
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Day set successfully</div>');
              
        }
    });


    
   

  }


//time codes//
 function set_times(s) {

var time =$('.time-set').val();

 $.ajax({  
        type: "POST",  
        url: "ajax_week.php",  
        data: { "time":time,'time_set':'time_set' },
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Time set successfully</div>');
              
        }
    });

  

  }

  //person codes//
 function set_persons(st) {

var person =$('.person_set').val();

 $.ajax({  
        type: "POST",  
        url: "ajax_week.php",  
        data: { "person":person,'person_set':'person_set' },
        success: function(response) { 
     
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Person value set successfully</div>');
              
        }
    });

  

  }
	
 function today_off_fun(aaaa) {
	var  today_off1 = 2;
	if($('input.today_off').prop('checked')==true){ 
		var  today_off1 = 1;
	} 	 
  $.ajax({  
        type: "POST",  
        url: "ajax_date_control2.php",  
        data: { "tf":today_off1 },			   
        success: function(response) { 
     	console.log(response);
            $(".msg").hide();
             $(".msg").show().html('<div class="alert alert-success" role="alert">Person value set successfully</div>');
              
        }
    });

  }	

	
	
  $(document).on("click", ".appendmore ", function (e) {	 	  
		 $(this).closest("div").find('.datsofff').fadeIn();
	   $(this).closest("div").find('.submitdateclose').fadeIn();
	  
	
	});	
	
  $(document).on("click", ".submitdateclose ", function (e) {	 	  
		$('.datsofff').val('')
	 
	  
	
	});		
	
 /*
	 $(document).on("click", ".chooseopt input", function (event) {
		 
  $(this).parent('.chooseopt').parent('.week-wrapper').find('.weeks').not(this).prop('checked', false);
		 var thisval = $(this).val();
		 $('.alltime_hide').fadeOut(100);
	 if(thisval==1){ 	 $('.time_d_1,.t_end_d_1').fadeIn(100);$('#todays_day').val('Monday'); }
	  if(thisval==2){ 	 $('.time_d_2,.t_end_d_2').fadeIn(100);$('#todays_day').val('Tuesday'); }
		  if(thisval==3){ 	 $('.time_d_3,.t_end_d_3').fadeIn(100); $('#todays_day').val('Wednesday');}
		  if(thisval==4){ 	 $('.time_d_4,.t_end_d_4').fadeIn(100); $('#todays_day').val('Thursday');}
		  if(thisval==5){ 	 $('.time_d_5,.t_end_d_5').fadeIn(100);$('#todays_day').val('Friday'); }
		  if(thisval==6){ 	 $('.time_d_6,.t_end_d_6').fadeIn(100);$('#todays_day').val('Saturday'); }
		  if(thisval==0){ 	 $('.time_d_7,.t_end_d_7').fadeIn(100);$('#todays_day').val('Sunday'); }
	});	
	
	*/
	
	
</script>

    </body>
</html>
<?php

session_start();
 
require_once 'admin/db.php';
require_once 'common_mail.php';

 //set timezone//
///date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'nl_NL');
error_reporting(0);

//language start//

 if(!isset($_SESSION['current_lang'])){$_SESSION['current_lang']="dutch";}
           $current_lang = $_SESSION['current_lang'];
     //time slot set//

if ($current_lang == "en") {
                $date="Date";
                $time_text="Time";
                $person="Person";
                $name = "Name";
                $email="E-mail";
                $phone="Telephone";
                $lmsg="Message";
                $book_now="Book Now";
                $select_time="Select Time";
                $select_person="Select Person";
                $heading="Reservation form";
                  
            } else {

                $date="Datum";
                $time_text="Tijd";
                $person="Persoon";
                $name = "Naam";
                $email="E-mail";
                $phone="Telefoon";
                $lmsg="Bericht";
                $book_now="Boek nu";
                $select_time="Selecteer Tijd";
                $select_person="Selecteer persoon";
                $heading="Reserverings formulier";


            }  

//language end//



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
    
      
        $time = date('G:i');
        $start =$time_slot['1'];
        $end = $time_slot['46'];
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;

 

		$chk_in_odrdis_tab = "SELECT * FROM `res_custom_field` where `status` ='1'";
      
	     $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
       /// $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
	   $email_result1=mysqli_fetch_assoc($chk_in_odrdis_tab_result);

	   $fieldname = $email_result1['field_name'];
 	   $status_send_field = $email_result1['status'];
	   $fieldname_2 = str_replace(' ', '',$fieldname);			 
        $entryfoundornot=$chk_in_odrdis_tab_result->num_rows;




        //insert form data in database name reservation_tbl//

$check_data1=mysqli_query($mysqli,"select * from date_tbl where id='9'");
			  $email_result1=mysqli_fetch_assoc($check_data1);


 							$get_bt=mysqli_query($mysqli,"select * from date_tbl where id='9'");
                                     

                                        $get_bt=mysqli_fetch_assoc($get_bt);
                                        $bts=$get_bt['before_time'];

///echo $bts;
$string = explode(" ",$bts); 
        if(isset($_POST['book_now']) && !empty($_POST['name'])){			
			$get_bt=mysqli_query($mysqli,"select * from date_tbl where id='9'");
                            $get_bt=mysqli_fetch_assoc($get_bt);
                            $bts=$get_bt['before_time'];
///echo $bts;
$string = explode(" ",$bts); 
			///print_r($string);
             $name=$_POST['name'];
             $email=$_POST['email'];
             $person=$_POST['person'];
             $time=$_POST['time'];
             $date_change = explode("/", $_POST['date']);
             $date=$date_change[2].'-'.$date_change[1].'-'.$date_change[0];
             $phone=$_POST['phone'];
             $msg=$_POST['msg'];
             $reservation_status='pending';
             $notification_status='1';
             $lang=$_SESSION['current_lang'];

			if($status_send_field==1) {
				   $custom_field_opt=$_POST['custom_field_opt'];
			}
			 

	
		//........check for auto approve functionality//			
			$check_auto_code=mysqli_query($mysqli,"select * from auto_approve_tbl where id='1' AND auto_status='1'");
             if(mysqli_num_rows($check_auto_code) > 0){

              $reservation_status='complete';


             $sql = "INSERT INTO reservation_tbl (name, email, person, phone, date, time, msg, res_status) VALUES ('".$name."', '".$email."', '".$person."','".$phone."','".$date."','".$time."','".$msg."', '".$reservation_status."')";


          }else{

                $sql = "INSERT INTO reservation_tbl (name, email, person, phone, date, time, msg, res_status,notification_status,lang) VALUES ('".$name."', '".$email."', '".$person."','".$phone."','".$date."','".$time."','".$msg."', '".$reservation_status."', '".$notification_status."','".$lang."')";
			 }
		
			
            if (mysqli_query($mysqli, $sql)) {  
				
				///	echo $mysqli->insert_id;
		
			 
				
				
                if($_SESSION['current_lang']=='en'){                  
                   $email_query = "select * from email_templete where type='3'";
              }else{
                  $email_query = "select * from email_templete where type='8'";
				} 	
			
				
				
               $email_results= mysqli_query($mysqli,$email_query);
               $email_result=mysqli_fetch_assoc($email_results);
                //booking mail to user at time of booking form//
                $datez=date('d F Y',strtotime($date)).' '.$time;       
			 
	 $person_data2=mysqli_query($mysqli,"select * from date_tbl where id='12'");
          $person_data_22=mysqli_fetch_assoc($person_data2);   
		  $start_timeee =$person_data_22['week']; 			
				
  $check_data=mysqli_query($mysqli,"select * from auto_approve_tbl where id='1'");
  if($person<=$start_timeee && mysqli_num_rows($check_data) > 0){
		  ///sendapprovalMAilToUser($name,$email,$email_result['form'],$email_result['subject'],$email_result['content'],$email_result['footer'],$person,$date,$time,$phone,$lang,$msg);
			}else{
	  

   
	  
	  
	  if($person<=$start_timeee){
			 if($_SESSION['current_lang']=='en'){                  
                   $email_query = "select * from email_templete where type='3'";
              }else{
                  $email_query = "select * from email_templete where type='8'";
				}  ///sendapprovalMAilToUser($name,$email,$email_result['form'],$email_result['subject'],$email_result['content'],$email_result['footer'],$person,$date,$time,$phone,$lang,$msg);
	  }
	  
	  else{
	      
	   if($_SESSION['current_lang']=='en'){                  
                   $email_query = "select * from email_templete where type='1'";
              }else{
                  $email_query = "select * from email_templete where type='6'";
              }
	            $email_results= mysqli_query($mysqli,$email_query);
               $email_result=mysqli_fetch_assoc($email_results);
	 
		 ///sendMAilToUser($name,$email,$email_result['form'],$email_result['subject'],$email_result['content'],$email_result['footer'],$fieldname,$custom_field_opt,$person,$datez,$phone,$msg);
		 
 
		  
			}	
  }
				
				
				
                 
				
				
				
			 if($_SESSION['current_lang']=='en'){                  
             	$email_query1 = "select * from email_templete where type='2'";
              }else{
 					 $email_query1 = "select * from email_templete where type='7'";
  			}

                $email_results1= mysqli_query($mysqli,$email_query1);
                $email_result1=mysqli_fetch_assoc($email_results1);

                 //send mail to admin for approval//
                 //// sendMAilToAdmin($email_result1['form'],$email_result1['subject'],$email_result1['content'],$email_result1['admin_to'],$email_result1['footer'],$name,$person,$datez,$phone,$email,$msg);

              

            ////  header('Location: https://natrajrestaurant.nl/online/thankyou.php');
              } else {
                      $msg= "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                }  

			 
      }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reservation form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 <style>
          
 
   option[disabled]{
    color: #ddd;
  /*display:none;  */
  }

 /* ul.lang_flag li {
    display: inline-block;
    padding: 3px;
    float: right;
}*/
	 .container.reservation-box {
    padding-top: 80px;    clear: both;    padding-bottom: 60px;
}
	 
	 .container.reservation-box h2.text-center {
    margin-bottom: 30px;
}
	 .form-horizontal .form-group {
	margin-right: 0;
    width: 32%;
    display: flex;
    flex-direction: column;
    margin-left: 0;
}
	 .form-group.md-textarea {
    width: 100%;
}
	 .form-horizontal .control-label {  width: auto;
    text-align: left;}
	 .form-horizontal .form-group .col-sm-10 {
    width: 100%;
}
	 form.form-horizontal {
    display: flex;
    flex-wrap: wrap;    justify-content: space-between;
}
	 .form-group.md-submit .col-sm-offset-2 {
    margin-left: 0;
}
	 .datepicker table tr td.today.day { pointer-events:none;opacity:0.7 }	
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 400px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}.container {width:100%;
    max-width: 1170px;margin:auto;
}	
	 
	.datepicker td, .datepicker th {
    text-align: center;
    width: 40px;
    height: 40px;
	 }
	td.disabled.disabled-date.day {
    background: #ddd;
}
	 

	 @media screen and (max-width:991px){
		 .container.reservation-box { padding-left:15px;padding-right:15px; }
	 }
	 
	 @media screen and (max-width:767px){
		 .form-horizontal .form-group{     width: 100%; }
	 }	 
	
	 
 </style>
</head>
<body>
<?php include 'public_header.php'; ?> 
<?php	include 'css_file.php'; ?>

<div class="container  reservation-box">
   <div class="right_div reservation-form">
      <?php  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
              <!--  <ul class="lang_flag">
          <li class="nl">
                        <a href="https://restaurantkamasutra.nl/online/setlang.php?action=en&cpage=<?php echo $curPageName; ?>" class="wpml-ls-link" ><img src="https://restaurantkamasutra.nl/online/en.png"></a>
                    </li>
                    <li class="en">
                        <a href="https://restaurantkamasutra.nl/online/setlang.php?action=dutch&cpage=<?php echo $curPageName; ?>" class="wpml-ls-link" ><img src="https://restaurantkamasutra.nl/online/nl.png"></a>
                    </li>                    
                </ul>-->
    
        </div>
  <h2 class="text-center"><?php echo $heading; ?></h2>

  <form method="POST" class="form-horizontal reservation-form" action="">
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="email"><?php echo $date; ?>*:</label>
      <div class="col-sm-10">

          <input type="text" name="date" value="" class="datepicker form-control" autocomplete="off" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><?php echo $time_text; ?>:</label>
      <div class="col-sm-10">  
    <?php
  //time data fetch//
 
     

		 /// print_r($lat_time2);
		  
      $get_time_data1=mysqli_query($mysqli,"select * from date_tbl where id='5'");
      $get_time1=mysqli_fetch_assoc($get_time_data1);
      $explode = explode(',',$get_time1['json_date']);
 
 ///  print_r($explode);
	$lasttime= end($explode); 
	  $tEnd2 = strtotime($lasttime);
		  
  ?>

<?php   
	    
			if($string[1]=="mintue"){			
				if($string[0]==15){
						$tNow23 =  date('G:i', strtotime('+15 minutes'));
					  $new = date('G:i',strtotime('+15 minutes'));
					  $skiptime  = date('H:i', strtotime('+15 minutes')) ; 
				}
				if($string[0]==30){
						$tNow23 =  date('G:i', strtotime('+30 minutes'));
					  $new = date('G:i',strtotime('+30 minutes'));
					  $skiptime  = date('H:i', strtotime('+30 minutes')) ; 
					 
				}
				if($string[0]==45){
					$tNow23 =  date('G:i', strtotime('+45 minutes'));
					  $new = date('G:i',strtotime('+45 minutes'));
					  $skiptime  = date('H:i', strtotime('+45 minutes')) ; 
				}	
		
			}
			
				if($string[1]=='hour'){
				if($string[0]==1){
						$tNow23 =  date('H:i', strtotime('+1 hour'));
					  $skiptime  = date('H:i', strtotime('+1 hour')) ; 
				}
				if($string[0]==2){
						$tNow23 =  date('H:i', strtotime('+2 hour'));
					  $skiptime  = date('H:i', strtotime('+2 hour')) ; 
				}
					if($string[0]==3){
						  $skiptime  = date('H:i', strtotime('+3 hour')) ; 
				}
					if($string[0]==4){
					  $skiptime  = date('H:i', strtotime('+4 hour')) ; 
				}
					if($string[0]==5){
					  $skiptime  = date('H:i', strtotime('+5 hour')) ; 
				}
						 
				if($string[0]==24){
						$tNow23 =  date('H:i', strtotime('+24 hour'));
				}
					
			}	  
		  
		 
		  
		  
		  
	  $new2 = strtotime($new);
					 
		   $tNow234 = strtotime($tNow23);
 
		  if(!empty($get_time1['hide']) && !empty($get_time1['st'])){ ?>
		
   <select id="t_end" name="t_end" class="form-control">
          <?php       foreach($time_slot as $k=>$val){               

                if(in_array($val, $explode)){

                $disabled='';

                }else{
                   $disabled='disabled';
                }?>
                 <option class="aa" value="<?php echo $k;?>" <?php echo $disabled;?>><?php echo $val;?></option>
            <?php }?>
               </select>   
          <?php }else{

			  
			  
		///$tNow23 =  date('Y-m-d H:i:s', strtotime('+15 minutes'));
		 

    $get_time_data=mysqli_query($mysqli,"select * from date_tbl where id='3'");
    if(mysqli_num_rows($get_time_data) > 0){
    $get_time=mysqli_fetch_assoc($get_time_data);
 
     $json_time=$get_time['json_date'] ? $get_time['json_date']:'';
		 $interval=$get_time['json_date'];
    }
			  
	
$today_day = date('l');
	if($today_day=="Monday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='5'");
	}
  if($today_day=="Tuesday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='13'");
	}
  if($today_day=="Wednesday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='14'");
	}
  if($today_day=="Thursday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='15'");
	}
  if($today_day=="Friday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='16'");
	}
  if($today_day=="Saturday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='17'");
	}
  if($today_day=="Sunday"){		  
    	$person_data2=mysqli_query($mysqli,"select * from date_tbl where id='18'");
	}
    if(mysqli_num_rows($person_data2) > 0){

    $person_data_22=mysqli_fetch_assoc($person_data2);   
		   $start_timeee = strtotime($person_data_22['st']); 
    $end_timeee = strtotime($person_data_22['et']);
    $timenow =  strtotime(date('H:i'));	  
 
			  
 		 echo '<select class="form-control checktime" name="time" required>';
          echo '<option value="">'.$select_time.'</option>';
		
	  if($start_timeee>$timenow){
		   for ($i=$start_timeee;$i<=$end_timeee;$i = $i + $interval*60){
		  $currnt_time = strtotime(date('H:i',$i));
		  $looptime  = strtotime($start_timeee,$i);
		  $looptime2  = date('H:i',$looptime);
          if($currnt_time==$timenow){
              echo '<option>'.date('H:i A',$i).'</option>';
          }        
          else{
    ///  echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i A',$i).'</option>';
			  
		  $skiptime_check  = strtotime($skiptime);
			if($skiptime_check>$currnt_time) {
				  ///   echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.$skiptime.'</option>';
			}
		 else{  
	 	  echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i',$i).'</option>';
				}
      }
	}
		}
	 
 else{
    for ($i=$start_timeee;$i<=$end_timeee;$i = $i + $interval*60){
          $currnt_time = strtotime(date('H:i',$i));
		  $looptime  = strtotime($start_timeee,$i);
		  $looptime2  = date('H:i',$looptime);
          if($currnt_time<$timenow){
            /// echo '<option>'.date('H:i A',$i).'</option>';
          }        
          else{
			///    echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i A',$i).'</option>';
	
	   $skiptime_check  = strtotime($skiptime);
		if($skiptime_check>$currnt_time) {
			  ///   echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.$skiptime.'</option>';
		}
			else{  
      echo '<option value="'.date('H:i',$i).'" '.$prop.'>'.date('H:i',$i).'</option>';
			}
      }
	}
		}
          echo '</select>';    

  }  
	  
			  
			    }
    ?>
		  <select class="form-control checktime2" name="time" required  style="display:none;"> 
			 <select> 
      </div>
    </div>


     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><?php echo $person; ?>*:</label>
      <div class="col-sm-10">
<?php 
//person data fetch//
 

    $person_data=mysqli_query($mysqli,"select * from date_tbl where id='4'");
    if(mysqli_num_rows($person_data) > 0){
    $person_data=mysqli_fetch_assoc($person_data);
     $person_data=$person_data['json_date'] ? $person_data['json_date']:'';
    }
?>


       <select class="form-control" name="person" required>

            <option value=""><?php echo $select_person; ?></option>';
            
            <?php for($i=1;$i<=$person_data;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
              <?php }?>
       </select>
      </div>
    </div>


     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><?php echo $name; ?>*:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="name" placeholder="" name="name" required>
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><?php echo $email; ?>*:</label>
      <div class="col-sm-10">          
        <input type="email" class="form-control" id="email" placeholder="" name="email" required>
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd"><?php echo $phone; ?>:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="phone" placeholder="" name="phone" required>
      </div>
    </div>

       <div class="form-group md-textarea">
      <label class="control-label col-sm-2" for="pwd"><?php echo $lmsg; ?>:</label>
      <div class="col-sm-10">          
     <textarea id="form7" class="md-textarea form-control" name="msg" rows="3"></textarea>
      </div>
    </div>
	  
	  
	  <?php
	
	   if($entryfoundornot > 0){
	  ?>
	    <div class="form-group md-textarea">
      <label class="control-label col-sm-2" for="pwd"><?php echo $fieldname; ?>:</label>
      <div class="col-sm-10">          
     <input type="text" id="custom_field_opt" class="form-control" name="custom_field_opt">
      </div>
    </div>
     <?php } ?>
	  
	  
    <div class="form-group md-submit">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="book_now" class="btn btn-danger"><?php echo $book_now; ?></button>
      </div>
    </div>
	
	  <input type="hidden"  value="<?php echo date('d/m/Y') ; ?>" class="today_date">
	  
  </form>
</div>
	<?php include 'public_footer.php'; ?>
</body>
</html>
 
<!-- //date data fetch//
 -->
  <?php 

    $get_date_data=mysqli_query($mysqli,"select * from date_tbl where id='1'");
    if(mysqli_num_rows($get_date_data) > 0){

    $get_date=mysqli_fetch_assoc($get_date_data);

     $json_dates=$get_date['json_date'] ? $get_date['json_date']:'';
	 
    }
?>
<!-- weeks code -->
  <?php 

    $get_week_data=mysqli_query($mysqli,"select * from date_tbl where id='2'");
    if(mysqli_num_rows($get_week_data) > 0){

    $get_week=mysqli_fetch_assoc($get_week_data);

     $json_week=$get_week['json_date'] ? $get_week['json_date']:'';
    }


if($json_dates!='' || $json_week!=''){
  $json_date=$json_dates.','.$json_week;
}else{
   $json_date='';	
}

								   $chk_in_odrdis_tab = "SELECT * FROM `res_days_settings` where `is_off` ='1'";      
								   $chk_in_odrdis_tab_result = $mysqli->query($chk_in_odrdis_tab);
								   $email_result1=mysqli_fetch_assoc($chk_in_odrdis_tab_result);
								   $fieldstatus = $email_result1['is_off'];
								 
 

$advance_booking=mysqli_query($mysqli,"select * from date_tbl where id='10'");   
	$advance_booking_fetch=mysqli_fetch_assoc($advance_booking);
	 $weekchos=$advance_booking_fetch['week'];

 $advance_booking2=mysqli_query($mysqli,"select * from date_tbl where id='11'");   
	$advance_booking_fetch2=mysqli_fetch_assoc($advance_booking2);
	 $datesfordsiable=$advance_booking_fetch2['json_date'];


            $array = explode(",", $datesfordsiable);
$dsidartes ='';
foreach($array as $array1){
	$dsidartes .="'$array1'".',';
}

    $onedayoff=mysqli_query($mysqli,"select * from date_tbl where id='2'");
    
    $onedayoff2=mysqli_fetch_assoc($onedayoff);
     $onedayoff2_day=$onedayoff2['week'];;
    
 
?>
  <script type="text/javascript">
 
 
	  
        $('.datepicker').datepicker({
		 
            format: 'dd/mm/yyyy',
			lang : 'en',
			daysOfWeekDisabled:'<?php echo $onedayoff2_day; ?>',
			startDate: '+0d',
			 endDate: '+<?php echo $weekchos;?>d',
		   <?php if($fieldstatus==1){ ?>	
	 		 todayHighlight: true,
			<?php } ?>
            autoclose: true,
		  datesDisabled : [<?php echo $dsidartes; ?>],		 
			 beforeShowDay:function(date){
				 return [false, ''];
			  }
					});


   <?php if($fieldstatus==1){ ?>
	   /* $(document).on("change", ".datepicker ", function (event) {
			console.log($(this).val());
				var today_date=   $('.today_date').val();
			var today2 = $(this).val();
			 
			///if(Date.parse($(this).val())>=Date.parse(today_date)){
			
			if(today2 == today_date){
				alert("Please select a different End Date.");
					 $(this).val(''); 
			}
			else{
				///alert('1');
			}
		}); */
      <?php } ?>
/*	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();  
   var advance_entry=   '15';
	   $(document).on("change", ".checktime ", function (event) {
			console.log($(this).val());
		 
			var today2 = $(this).val();
			 
			///if(Date.parse($(this).val())>=Date.parse(today_date)){
			
			if(today2 == today_date){
				alert("Please select a different End Date.");
					 $(this).val(''); 
			}
			else{
				///alert('1');
			}
		});  
     */
	  
	 
	 $(document).on("change", ".datepicker ", function (event) {
			console.log($(this).val());
		  var today_date=   $('.today_date').val();
			var choose_date = $(this).val();
			 
			///if(Date.parse($(this).val())>=Date.parse(today_date)){
			
			if(choose_date == today_date){
							$('.checktime').fadeIn(0);
							  $('.checktime2').fadeOut(0);
						    $('.checktime2').removeAttr('required');
							 $('.checktime').attr('required','required');
			}
			else{
				
				 var action = 'showby_days';
                         $.ajax({
                            url: "postcodecheck.php",
                            method: "POST",							 
                            data: {
								choose_date: choose_date, 
								action: action
							},
							   dataType: "html",
                             success: function (response){
                               
								  $('.checktime').fadeOut(0);
								 $('.checktime2').fadeIn(0);
								  $('.checktime2').empty();
								 $('.checktime2').append(response);
								 $('.checktime').removeAttr('required');
								 $('.checktime2').attr('required','required');
                            }
                        });	
				
				
				
			}
		 
		 
		 
		 
		 
		});
	  
	  
		$(document).on('change, keyup',  "input#phone", function (event) {
		  
			var currentInput = $(this).val();
			var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
			$(this).val(fixedInput);
			
		});		
			

		///var a = new Date('08/11/2015');
		///alert(weekday[a.getDay()]); 

    </script>



<?php 
session_start();
 $page_type = $_POST['page_type'];
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8">
  <meta name="description" content="Thankyou page">
  <meta name="keywords" content="Thankyou, Resrvation booked, booked">
	
	<title>Thank you</title>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
	</style>
	
	 <style>
	<?php 	if($page_type==1){?>	
	<?php } ?>
 	</style>
	 <link rel="stylesheet" href="custom.css">
<script>
		!function (w, d, t) {
		  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++
)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js
";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script");n.type="text/javascript",n.async=!0,n.src=i+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
		
		  ttq.load('CLMV5A3C77UEE5O8AQB0');
		  ttq.page();
		}(window, document, 'ttq');
	</script>
</head>
<body>
	 
	 <?php
	
	 $current_lang = $_SESSION['current_lang'];  
		 	require_once 'admin/db.php'; 
			include 'public_header.php'; 	
			include 'css_file.php'; 
			require_once 'common_mail.php';
   $current_lang = $_POST['c_lang'];		
        if(isset($_POST['book_now']) && !empty($_POST['name']) && $_SESSION['reserbook']==0){				
				 $current_lang = $_POST['c_lang'];			   
			
			$get_bt=mysqli_query($mysqli,"select * from date_tbl where id='9'");
                            $get_bt=mysqli_fetch_assoc($get_bt);
                            $bts=$get_bt['before_time'];

	
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
			
		 $person_data2=mysqli_query($mysqli,"select * from date_tbl where id='12'");
          $person_data_22=mysqli_fetch_assoc($person_data2);   
		  $start_timeee =$person_data_22['week']; 	
			
			$check_auto_code=mysqli_query($mysqli,"select * from auto_approve_tbl where id='1' AND auto_status='1'");
             if(mysqli_num_rows($check_auto_code) > 0 && $start_timeee!=55 && $person<=$start_timeee){			 
            	  $reservation_status='complete';
				   $sql = "INSERT INTO reservation_tbl (name, email, person, phone, date, time, msg, res_status) VALUES ('".$name."', '".$email."', '".$person."','".$phone."','".$date."','".$time."','".$msg."', '".$reservation_status."')";
			 
          }else{	 
                 $sql = "INSERT INTO reservation_tbl (name, email, person, phone, date, time, msg, res_status,lang,notification_status) VALUES ('".$name."', '".$email."', '".$person."','".$phone."','".$date."','".$time."','".$msg."', '".$reservation_status."','".$_SESSION['current_lang']."', '".$notification_status."')";
			 }
			
		    if (mysqli_query($mysqli, $sql)) { 
				
				
				 $lastproid = $mysqli->insert_id; 
				
                if($_SESSION['current_lang']=='en' || isset($_GET['langca']) && $_GET['langca']==1){                  
                   $email_query = "select * from email_templete where type='3'";
              }else{
                  $email_query = "select * from email_templete where type='8'";
				} 	
               $email_results= mysqli_query($mysqli,$email_query);
               $email_result=mysqli_fetch_assoc($email_results);
				
				
 $From_Email_Address = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;
 $Additional_Email = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp_pwd'")->fetch_object()->adm_set_vlu;	
				
$Additional_Email2 = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='additional_email2'")
    ->fetch_object()->adm_set_vlu;	
				
				
                //booking mail to user at time of booking form//
                $datez=date('d F Y',strtotime($date)).' '.$time;   				
				
			  $check_data=mysqli_query($mysqli,"select * from auto_approve_tbl where id='1' AND auto_status='1' ");
  if($start_timeee!=55 && $person<=$start_timeee && mysqli_num_rows($check_data) > 0){
	 sendapprovalMAilToUser($name,$email,$From_Email_Address,$email_result['subject'],$email_result['content'],$email_result['footer'],$person,$date,$time,$phone,$lang,$msg,$fieldname,$custom_field_opt);
			}
				else{ 
	  		 if($_SESSION['current_lang']=='en'  || isset($_GET['langca']) && $_GET['langca']==1){                  
                   $email_query = "select * from email_templete where type='1'";
              }else{
                  $email_query = "select * from email_templete where type='6'";
              }
	     $email_results= mysqli_query($mysqli,$email_query);
               $email_result=mysqli_fetch_assoc($email_results);
		 sendMAilToUser($name,$email,$From_Email_Address,$email_result['subject'],$email_result['content'],$email_result['footer'],$fieldname,$custom_field_opt,$person,$datez,$phone,$msg);
		 
			}
			 	
				
			 if($_SESSION['current_lang']=='en'  || isset($_GET['langca']) && $_GET['langca']==1){                  
             	$email_query1 = "select * from email_templete where type='2'";
              }else{
 					 $email_query1 = "select * from email_templete where type='7'";
  			}

                $email_results1= mysqli_query($mysqli,$email_query1);
                $email_result1=mysqli_fetch_assoc($email_results1);

 		 		
				
				
 ///echo $email_result1['admin_to'];
 if($start_timeee!=55 && $person<=$start_timeee && mysqli_num_rows($check_data) > 0){	 
	 	$lastproid = 9999;		sendMAilToAdmin($From_Email_Address,$email_result1['subject'],$email_result1['content'],$Additional_Email,$email_result1['footer'],$name,$person,$datez,$phone,$email,$msg,$fieldname,$custom_field_opt,$lastproid);
	
 if($Additional_Email2!=''){	sendMAilToAdmin($From_Email_Address,$email_result1['subject'],$email_result1['content'],$Additional_Email2,$email_result1['footer'],$name,$person,$datez,$phone,$email,$msg,$fieldname,$custom_field_opt,$lastproid); 
						   }
	 
 }
				else{							sendMAilToAdmin($From_Email_Address,$email_result1['subject'],$email_result1['content'],$Additional_Email,$email_result1['footer'],$name,$person,$datez,$phone,$email,$msg,$fieldname,$custom_field_opt,$lastproid);
 if($Additional_Email2!=''){		
sendMAilToAdmin($From_Email_Address,$email_result1['subject'],$email_result1['content'],$Additional_Email2,$email_result1['footer'],$name,$person,$datez,$phone,$email,$msg,$fieldname,$custom_field_opt,$lastproid);					 
 }				 
				}
			 
	?>
			 
	 <section class="reserve-thank">
				<div class="site-header-res" id="header-reservation">	
		<?php		
  			if($current_lang=='en'){ ?>
					<section class="reserve-thank">
					<div class="site-header-res" id="header-reservation">			

								 <h1 class="site-header__title" data-lead-id="site-header-title"   style="color:#08454d ;">THANK YOU!</h1>
							   <p>Thank you for your booking request. Updates will be sent to the email address you provided.</p> 
						</div>
					</section>
			<?php }
	 
			else{ ?>
	      		
 				 <h1 class="site-header__title" data-lead-id="site-header-title"   style="color:#08454d ;">BEDANKT</h1>
				  <p>Hartelijk dank voor uw boekingsaanvraag. Updates zullen worden verzonden naar het door je opgegeven e-mailadres.</p> 
						
	 
		 <?php 
			} 
            
              }
			else {
                      $msg= "Error: " . $sql . "<br>" . mysqli_error($mysqli);
               }  			  ?>
			
		 <div class="thankyou-btn">
			<a href="https://restaurantkamasutra.nl/"> <?php if ($current_lang == "en"){ echo 'Back To Home'; } else { echo 'Terug naar huis!'; }?> </a>  </div>
					
					</div>
					</section>
			<?php  
			$_SESSION['reserbook'] = 1;	
      }
	
   ?>
	
 
 <?php  include 'public_footer.php';   ?>
	
</body>
</html>
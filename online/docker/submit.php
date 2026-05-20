<?php
$messagesucess="";
if(isset($_POST['submit'])){

	$roof_type = $_POST['roof_type'];
	$property_type = $_POST['property_type'];
	$finance = $_POST['finance'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$bill = $_POST['bill'];
	 $to = "jyoti9901@gmail.com";
         $subject = "Contact Form";
         
         $message = '
		 <b>Name :</b> '.$fname.' '.$lname.'<br />
		 <b>Email:</b> '.$email.'<br />
		 <b>Phone :</b> '.$phone.'<br />
		 <b>Address :</b> '.$address.'<br />
		 <b>Average Monthly bill :</b> '.$bill.'<br />
		 <b>Roof Type :</b> '.$roof_type.' <br />
		 <b>Meter Type :</b> '.$property_type.' <br />
		 <b>Interested in Finance :</b> '.$roof_type.' <br />
		 ';
         
            require 'vendor/autoload.php'; // If you're using Composer (recommended)

$API_key = "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";
$email = new \SendGrid\Mail\Mail();
$email->setFrom("info@sailaxgroup.com", "Sailax AI");
$email->setSubject("Contact");
$email->addTo("info@sailaxgroup.com");
//$email->addCc("jyoti9901@gmail.com");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", $message
);
$sendgrid = new \SendGrid($API_key);
if($sendgrid->send($email));
{
	setcookie("name", $fname, time()+2*24*60*60); 
            $messagesucess = "Message sent successfully...";
			echo "<script type='text/javascript'>alert('Thanks for contacting us we will be in touch with you shortly');
window.location='index.php';
</script>";
			
} 
}

?>
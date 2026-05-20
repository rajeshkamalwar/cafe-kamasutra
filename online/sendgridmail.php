<?php

require 'vendor/autoload.php'; // If you're using Composer (recommended)
$message = '<p>Dear Participant, <br />Congratulations. Your entry has been accepted under the guidelines of the ICCR Competition &ldquo;United Against Corona- Express Through Art&rdquo;. <br />Your artwork will be judged by a prominent jury. Shortlisted entries will be intimated by email about next steps to be taken.<br />We wish you best of luck. <br />Stay healthy.</p>
<p>Dinesh Patnaik<br />DG, ICCR</p>
';
$API_key = "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";
$nemail = new \SendGrid\Mail\Mail();
$nemail->setFrom("bestelling@indianhut.nl", "indianhut");
$nemail->setSubject("ART IN THE TIME OF CORONA");
$nemail->addTo("jyotidigipanda@hotmail.com");
//$nemail->addTo("jyoti@digipanda.co.in");
$nemail->addCc("jyoti9901@gmail.com");
$nemail->addContent("text/plain", "and easy to do anywhere, even with PHP");
$nemail->addContent(
    "text/html", $message
);
$sendgrid = new \SendGrid($API_key);
if($sendgrid->send($nemail));
{
	echo "Sucess";
	
} 

		?>
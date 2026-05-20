<?php
date_default_timezone_set('Etc/UTC');

use PHPMailerPHPMailerPHPMailer;
use PHPMailerPHPMailerException;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "mail.authsmtp.com";
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = false;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->AuthType = "CRAM-MD5";
$mail->Username = "info@mirchirestaurant.nl";
$mail->Password = "aarti2@1183HG";
  
$mail->setFrom('info@mirchirestaurant.nl', 'Pakwaan');
$mail->addReplyTo('info@mirchirestaurant.nl', 'Pakwaan');
$mail->addAddress('kulwant@printbazar.nl', 'Test John'); //(Send the test to yourself)
$mail->Subject = 'PHPMailer SMTP test';
$mail->isHTML(true);
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>

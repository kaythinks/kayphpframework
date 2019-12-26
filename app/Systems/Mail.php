<?php

namespace App\SyStems;

use PHPMailer\PHPMailer\PHPMailer;
use App\Config\Env;

class Mail{

	public static function sendEmail(string $toRecipientEmail, string $toRecipientFullName, string $subject, string $body)
	{
		//PHPMailer Object
		$mail = new PHPMailer();

		//Enable SMTP debugging. 
		$mail->SMTPDebug = 0;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();            
		//Set SMTP host name                          
		$mail->Host = Env::MAIL_HOST; 
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;                          
		//Provide username and password     
		$mail->Username = Env::MAIL_HOST_USERNAME;             
		$mail->Password = Env::MAIL_HOST_PASSWORD;                           
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = Env::MAIL_ENCRYPTION;                           
		//Set TCP port to connect to 
		$mail->Port = Env::MAIL_PORT;                                   

		$mail->From = Env::MAIL_FROM_ADDRESS;
		$mail->FromName = Env::MAIL_FROM_NAME;

		$mail->addAddress($toRecipientEmail, $toRecipientFullName);

		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $body;
		//$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()) 
		{
		    debug("Mailer Error: " . $mail->ErrorInfo);
		} 
		else 
		{
		    return true;
		}
	}

}
<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath 
 * @version			$Id: cron_reminder.php  Thursday, August 5, 2010, 11:01:25 AM $
 *		
 */
include("includes/initialize.php");  
require(DIR_CLASSES . "class.phpmailer.php");
include(DIR_FUNCTIONS . "mail.php");
$mail = prepare_new_mail();
	  
					$tomail = 'syamnath.v@experionglobal.com';
					$toname = 'syam';
					$message = " Dear <b>Sir</b>,<br><br>";
					$message .= "test<br>"; 
 					$message .=	 "Thanks<br>";
					$message .=	SITE_NAME;
					// $mail->addContent("text/html",$message);
					// $mail->addTo($tomail,$toname);	
				
				$mail_subject =  "Order reminder notification" ;
				if(prepare_new_mail_send($mail_subject, $tomail, $message, $toname)	){
					echo "Mail Sent successfully.";
				}else{
					echo "No mail sent.";
				}
		
?>
 
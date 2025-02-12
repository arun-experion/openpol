<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
	
// require __DIR__.'/../smtp/vendor/autoload.php';
// require __DIR__.'/../smtp/src/Exception.php';
// require __DIR__.'/../smtp/src/PHPMailer.php';
// require __DIR__.'/../smtp/src/SMTP.php';

require __DIR__.'/../smtp/vendor-sendgrid/autoload.php';
require __DIR__.'/../smtp/vendor-sendgrid/sendgrid/sendgrid/sendgrid-php.php';


// function prepare_mail($fromname='',$from_email='') {

// 	$mail = new PHPMailer();
				
// 	if (IS_SMTP) {
// 		$mail->IsSMTP();
// 	}
// 	$mail->SMTPAuth   = SMTP_AUTH;                  // enable SMTP authentication
// 	$mail->SMTPSecure = SMTP_SECURE;                 // sets the prefix to the servier
// 	$mail->Host       = MAIL_HOST;      // sets GMAIL as the SMTP server
// 	$mail->Port       = SMTP_PORT;                   // set the SMTP port for the GMAIL server

// 	$mail->Username   = SITE_EMAIL;                 // GMAIL username
// 	$mail->Password   = EMAIL_PASSWORD;            // GMAIL password

// 	$mail->AddReplyTo(SITE_EMAIL, SITE_NAME);
// 	$mail->From       = FROM_EMAIL;
// 	$mail->FromName   = SITE_NAME;
//     if(strlen($fromname)>1){
// 	$mail->From       = $from_email;
// 	}
// 	if(strlen($from_email)>1){
// 	$mail->FromName   = $fromname;
// 	}
// 	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
// 	$mail->WordWrap   = 50; // set word wrap

// 	//$mail->AddAttachment("images/phpmailer.gif");             // attachment

// 	$mail->IsHTML(true); // send as HTML
	
// 	return $mail;
// }

function prepare_new_mail_old($fromname='',$from_email=''){

	// Instantiation and passing `true` enables exceptions
// 	$mail = new PHPMailer(true);

// 	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->SMTPDebug = 1;
//     $mail->Host       = 'smtp.emailidea.biz';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'terumopenpol2019@gmail.com';                     // SMTP username
//     $mail->Password   = 'debfe9ab70b448a0b17c1638f506ad1b';                               // SMTP password
//    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       =  587;         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//     $mail->SMTPOptions = array(
// 		'ssl' => array(
// 		'verify_peer' => false,
// 		'verify_peer_name' => false,
// 		'allow_self_signed' => true
// 		)
// 	);
//     //Recipients
//     $mail->addCustomHeader('Organization', "Terumo Penpol\r\n");
//     $mail->addCustomHeader('MIME-version', "1.0\r\n");
// 	//$mail->addCustomHeader('Content-type', "text/html;\r\n");
// 	$mail->addCustomHeader('Reply-To', 'terumopenpol2019@gmail.com');
// 	$mail->addCustomHeader('X-Priority', "3\r\n");
// 	$mail->addCustomHeader('X-Mailer', "PHP". phpversion()."\r\n");
// 	$mail->addCustomHeader('X-GreenArrow-MailClass', "transactional");

//     $mail->setFrom('terumopenpol2019@gmail.com', 'Terumo Penpol');   
//                  // Name is optional
//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
    
//     return $mail;

}


function prepare_new_mail($fromname='',$from_email='')
{
	$email = new \SendGrid\Mail\Mail(); 
	$email->setFrom("terumopenpol2021@gmail.com", "Terumo Penpol");
	
    return $email;
}

function prepare_new_mail_send($subject, $to, $message, $toname)
{   
    if($toname == ""){
            $toname ='Terumo user';
    }

	$email = new \SendGrid\Mail\Mail(); 
	$email->setFrom("terumopenpol2021@gmail.com", "Terumo Penpol");
	$email->setSubject($subject);
	$email->addTo($to, $toname);
	$email->addContent("text/html", $message);

	$sendgrid = new \SendGrid('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');


	try {
		$response = $sendgrid->send($email);
		if($response->statusCode() == 202 ){
            return true;
        }
	

	
// 		print $response->statusCode() . "\n</br>";
// 		print_r($response->headers()). "\n</br>";;
// 		print $response->body() . "\n</br>";
// exit;
	} catch (Exception $e) {
		echo 'Caught exception: '. $e->getMessage() . "\n</br>";
	}
}

?>
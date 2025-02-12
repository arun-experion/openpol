<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    
	
	include_once("mail.php");
	
	// $mail_cancelreq = prepare_new_mail();
	// $mail_cancelreq->MsgHTML('shinging in the sea at ocean ');
	// $mail_cancelreq->AddAddress('shanitp008@gmail.com','Sanjeev Murukan');
	// $mail_cancelreq->Subject = " Order cancellation request - test 2021 ";
	// if (!$mail_cancelreq->Send())
    // {
    //     echo "Mailer Error: " . $mail_cancelreq->ErrorInfo;
    // }
    // else
    // {
    //     echo 'sent';
    // }

    $email = new \SendGrid\Mail\Mail(); 
	$email->setFrom("terumopenpol2021@gmail.com", "Example User");
	$email->setSubject("Sending with SendGrid is Fun");
	$email->addTo("shanitp008@gmail.com", "Example User");
	$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
	$email->addContent(
		"text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
	);
	$sendgrid = new \SendGrid('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');

	try {
		$response = $sendgrid->send($email);
       
		print $response->statusCode() . "\n</br>";
		print_r($response->headers()). "\n</br>";;
		print $response->body() . "\n</br>";
	} catch (Exception $e) {
		echo 'Caught exception: '. $e->getMessage() . "\n</br>";
	}

    /*$encoding   = "utf-8";

    $subject_preferences = array(
        "input-charset" => $encoding,
        "output-charset" => $encoding,
        "line-length" => 76,
        "line-break-chars" => "\r\n"
    );

    $from_name = "Terumo Penpol";
    $from_mail = "terumopenpol2021@gmail.com";

    $mail_to    = "sm1590@gmail.com";
    $mail_subject = "test mail terumo penpol";
    $mail_message = "test mail terumo penpol message";


    // Mail header
    
    $header     = "Content-type: text/html; charset=".$encoding." \r\n";
    $header     .= "From: ".$from_name." <".$from_mail."> \r\n";
    $header     .= "MIME-Version: 1.0 \r\n";
    $header     .= "Content-Transfer-Encoding: 8bit \r\n";
    $header     .= "Date: ".date("r (T)")." \r\n";
    //$header     .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

    // Send mail
    mail($mail_to, $mail_subject, $mail_message, $header);*/

?>
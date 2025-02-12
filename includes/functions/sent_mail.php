<?php

 	//require_once(DIR_CLASSES . "class.phpmailer.php");
	include_once(DIR_FUNCTIONS . "mail.php");
	require_once __DIR__.'/mail.php';

	function sentreq_cancel($ord_madeby,$uids,$oid,$order_no){ 
		$mail_cancelreq = prepare_new_mail();
		$mail_subject = "Order cancellation request";
		$mail_subject = $order_no." Order cancellation request";

		foreach($uids as $maildetails){				 
			$tomail = $maildetails;
			$toname = '';
			$message = " Dear <b>Sir</b>,<br><br>";
			$message .= $ord_madeby ." has requested to cancel the order. <br>"; 
			$message .= "Order No:".$order_no."<br> <br>"; 
			$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$_GET['id']."'>here</a> to view.<br><br>";
			$message .=	 "Thanks<br>";
			$message .=	SITE_NAME;
//  			$mail_cancelreq->addContent("text/html",$message);
// 			$mail_cancelreq->addTo($tomail,$toname);	
			prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

		}
		
		// $mail_cancelreq->Send();
	}
	
	function sentcancellation_notification($uids,$oid,$order_no){ 
		$mail = prepare_new_mail();
		$mail_subject =  $order_no." Order cancellation notification" ;

		foreach($uids as $maildetails){				 
			$tomail = $maildetails;
			$toname = '';
			$message = " Dear <b>Sir</b>,<br><br>";
 			$message .= "Order No:".$order_no." has been cancelled.<br> <br>"; 
			$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$oid."'>here</a> to view.<br><br>";
			$message .=	 "Thanks<br>";
			$message .=	SITE_NAME;
 			$mail->addContent("text/html",$message);
			$mail->addTo($tomail,$toname);	
			prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

		}
	
		// $mail->Send();
		// prepare_new_mail_send($mail);

	}
	
	function sentrecommendation_notification($ed,$oid,$order_no,$status){ 
		$mail_recommend = prepare_new_mail();
		$tomail = $ed;
		$toname = '';
		$message = " Dear <b>Sir</b>,<br><br>";
		if($status==1){
			$message .= "Order No:".$order_no." has been recommended to cancel.<br> <br>"; 
			$mail_subject =  $order_no." Order recommended for cancellation";
		}else{
			$message .= "Order No:".$order_no." has been not recommended to cancel.<br> <br>"; 	
			$mail_subject =  $order_no." Order not recommended for cancellation";
		}	
		$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$oid."'>here</a> to view.<br><br>";
		$message .=	 "Thanks<br>";
		$message .=	SITE_NAME;
		// $mail_recommend->addContent("text/html",$message);
		// $mail_recommend->addTo($tomail,$toname);		
		// $mail_recommend->Send();
		prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

	}
	
	function orderrejection($baid,$ordid,$ordno){
		$mail_reject = prepare_new_mail();
		$tomail = $baid;
		$toname = "";
 		$message = " Dear <b>Sir</b>,<br><br>";
		$message .= "Your order has been rejected.<br>"; 				 
		$message .= "Order No:".$ordno."<br> <br>"; 
		$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$ordid."'>here</a> to view.<br><br>";
		$message .=	 "Thanks<br>";
		$message .=	SITE_NAME;
		$mail_reject->addContent("text/html",$message);
		$mail_reject->addTo($tomail,$toname);	
		$mail_subject = "Your order rejected";
		// $mail_reject->Send();
		// prepare_new_mail_send($mail_reject);
		prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

	}
	
	function orderstatusnotification($notify,$ordid,$order_no,$status){
		$mail_ordstatus = prepare_new_mail();
		$mail_subject =  "Order status notification";

		foreach($notify as $maildetails){				 
			$tomail = $maildetails['email'];
			$toname = $maildetails['first_name'];
			$message = " Dear <b>Sir</b>,<br><br>";
			$message .= ORDER_NOTIFICATION_BODY. "<br>"; 
			$message .= "Order No:".$order_no."<br>"; 
			$message .= "Current status:".$status."<br> <br>"; 
			$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$ordid."'>here</a> to view.<br><br>";
			$message .=	 "Thanks<br>";
			$message .=	SITE_NAME;
			$mail_ordstatus->addContent("text/html",$message);
			$mail_ordstatus->addTo($tomail,$toname);	
			prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

		}		
		// $mail_ordstatus->Send();
		// prepare_new_mail_send($mail_ordstatus);
	}
	
?>
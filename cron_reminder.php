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
	  
require(DIR_CLASSES . "order.php");
$order = new Order();
 
$query = Query("Select order_id,MAX(current_status) as status,DATE_FORMAT(`updated_date` , '%d-%m-%Y' ) as updated_date from order_status group by order_id");

$twodaysback = mktime(0, 0, 0, date("m"), date("d")-2, date("Y"));
 
while($result = FetchAssoc($query)){
 	if(strtotime($result['updated_date']) <= $twodaysback){
		$oid= $result['order_id'];
		$result_areazone= FetchAssoc(Query("SELECT o.order_no,u.area_id,u.zone_id FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by"));	 	
		$order_no = $result_areazone['order_no'];
		$notify = $order->notifymail($result['status'],$result_areazone['area_id'],$result_areazone['zone_id']);
			if(count($notify)>0 && in_array($result['status'],$status_mail)){
				$flag = 1;
				$mail_subject = "Order reminder notification";

				foreach($notify as $maildetails){				 
					$tomail = $maildetails['email'];
					$toname = $maildetails['first_name'];
					$message = " Dear <b>Sir</b>,<br><br>";
					$message .= ORDER_REMINDER_BODY. "<br>"; 
					$message .= "Order No:".$order_no."<br> <br>"; 
					$message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$oid."'>here</a> to view.<br><br>";
					$message .=	 "Thanks<br>";
					$message .=	SITE_NAME;
					$mail->addContent("text/html",$message);
					$mail->addTo($tomail,$toname);	
					$flag = prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

				}
				if($flag = 1){
					echo "Mail Sent successfully.";
				}else{
					echo "No mail sent.";
				}
			}
	}
}
?>
 
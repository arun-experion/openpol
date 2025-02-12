<?php  

	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
 	$perm = array('add_order');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "cancelorder.tpl");
	
	require(DIR_CLASSES . "order.php");
	$order = new Order();
	 
	include(DIR_FUNCTIONS . "sent_mail.php");
	
	$tpl -> AssignValue("id", $_GET['id']);	
	$tpl -> AssignValue("cancelordertext", CANCEL_ORDER_TEXT);	
	$oid = $_GET['id'];
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
	 $required = array ("cancelreason" => '<LI>'.CANCEL_REASON_EMPTY.'</LI>');
		 
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
	
		if(isset($error)) {			
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
		} else {
			 
			Update("order", array("request_to_cancel" => 1,
								  "reason_cancel" => $_POST['cancelreason'],
								  "request_canceldate" => date('Y-m-d H:i:s')
								 ), "id=".$_GET['id']);
			 
			$order_no = $_POST['ord_no'];
			$ord_madeby = $_POST['ord_madeby'];
			$ord_zoneid = $_POST['zoneid'];
			//sent mail req
 			sentreq_cancel($ord_madeby,$order->getcancelreq_notification($ord_zoneid,ZH),$_GET['id'],$order_no); 
			messages(ORDER_CANCEL_SUCCESS);
			reload('vieworder.php?id='.$_GET['id']);
		}
	}
 	
	$result_zone=FetchAssoc(Query("SELECT u.area_id,u.zone_id,o.order_no,u.first_name FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by"));	 
	$order_no = $result_zone['order_no'];	
	$tpl -> AssignValue("zoneid", $result_zone['zone_id']);	
    $tpl -> AssignValue("onumber", $order_no);	
	$tpl -> AssignValue("ord_firstname", $result_zone['first_name']);	  
				
 	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
 
<?php

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: vieworder.php  wednessday, June 16, 2010, 1:00:41 PM $
 *		
 */
 	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	 
 	$perm = array('view_my_order','update_order_status');
	checkpermission($perm);
  
	include(DIR_FUNCTIONS . "sent_mail.php");
  
	$tpl = new template();
	if(isset($_GET['print'])){
		$tpl -> Load(TEMPLATE_PATH . "print_order.tpl");	
	}else{
		$tpl -> Load(TEMPLATE_PATH . "vieworder.tpl");
	}
	require(DIR_CLASSES . "order.php");
	$order = new Order();	
	
	$myACL = new ACL();
        
	if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            if(isset($_POST['mode']) AND $_POST['mode'] == '_get_timeLeft')
            {
                header('Content-type: application/json');
                
                list($access, $confirm) = $order->checkTimeLeft($_POST['orderid'], 0);
                
                if($access == 'yes' AND $confirm == 'yes')
                {
                    $data = 'failure'; // The order is in edit mode. 
                }
                else
                {
                    $data = 'success'; // The order is confirmed
                }

                echo (json_encode($data));
                exit();                
            }

		 //if($order->getcurrentorderstatus($_GET['id']) !=7){ 
		 if($order->getcurrentorderstatus($_POST['orderid']) !=7){
		 
			if(isset($_POST['status']) && $_POST['status'] == ""){
				$error['error.status'] = '<LI>'.EMPTY_STATUS.'</LI>' ;
			}
		 }
 		if(isset($error)) {			
			$tpl -> AssignArray($error);
			//$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
		} else {
			if(isset($_POST['statusaction']) && $_POST['statusaction']!=''){
				$statusaction = $_POST['statusaction'];
			 	switch($statusaction){
					case 'zhrecommend':
      				  Update("order", array("recommend_to_cancel" => $_POST['status'],
									  "recommend_by" => $_SESSION['id'],
									  "recommend_comment" => $_POST['comments'],
									  "recommend_date" => date('Y-m-d H:i:s')
									 ), "id=".$_POST['orderid']);
					  $query_edmail=Query("SELECT u.email, u.first_name FROM `user` u, user_roles ur  WHERE ur.userID = u.id and ur.roleID = ".ED);			 
					  $edmail = FetchAssoc($query_edmail);
					  $mailid = $edmail['email']; 
					  // mail notification
					  sentrecommendation_notification($mailid,$_POST['orderid'],$_POST['orderno'],$_POST['status']); 
       				break;
					
					case 'cancelaction':
      				 Insert("order_status", array("order_id" => $_POST['orderid'], 
											"current_status" => 11,
											"comment" => $_POST['comments'], 
											"updated_by" => $_SESSION['id'], 
											"updated_date" => date('Y-m-d H:i:s')
										));
					  // mail notification
					sentcancellation_notification($order->cancellation_notification_mailid($_POST['orderid']),$_POST['orderid'],$_POST['orderno']); 
       				break;
				}
				 
				 		
			}else{
				// inserting delivery date for acknowledge orders
				$ord_id = $_POST['orderid'];
				if(isset($_POST['prod_id']) && count($_POST['prod_id'])>=1){
					foreach($_POST['prod_id'] as $key=>$pid){
						if($_POST['deliverydate'][$key] !=""){
						 Update("product_order", array("delivery_date" => date('Y-m-d H:i:s', strtotime($_POST['deliverydate'][$key]))), "order_id=".$ord_id." and product_id=".$pid." and quantity=".$_POST['qty'][$key]);
						 }
					}
					messages('Delivery date added successfully.');
				}
				 
				// changing order status
				if(!dupData("order_status", "current_status", $_POST['status'], "AND order_id={$_POST['orderid']} AND current_status <> 9")) {
				 
				$aid = $_POST['aid'];
				$zid = $_POST['zid'];
				$order_no = $_POST['ordernum'];				
				
				Insert("order_status", array("order_id" => $_POST['orderid'], 
											"current_status" => $_POST['status'],
											"comment" => $_POST['comments'], 
											"updated_by" => $_SESSION['id'], 
											"updated_date" => date('Y-m-d H:i:s')
										)); 
				$ststus_name = $order->getstatusname($_POST['status']);
				 
					messages('The order has been '.$ststus_name['action']);
					if($_POST['status']==6){
						$oid =$_POST['orderid'];						
						$result_ba= FetchAssoc(Query("SELECT o.order_no,u.email,u.first_name FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by"));	
 						orderrejection($result_ba['email'],$oid,$order_no);
					}
					
                                        /*$sql_customer = FetchAssoc(Query("SELECT created_by FROM `order` WHERE id = '".$_POST['orderid']."'"));
                                        $createduser = $sql_customer['created_by'];
					$notify = $order->notifymail($_POST['status'], $aid, $zid, $createduser);*/
					$oid =$_POST['orderid'];			
					$created_ba= FetchAssoc(Query("SELECT u.id FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by"));	
 					$notify = $order->notifymail($_POST['status'], $aid, $zid, $created_ba['id']);
					if(count($notify)>0){				 
						orderstatusnotification($notify,$_POST['orderid'],$order_no,$ststus_name['action']);
					}
				}
			}
		}
	
	}
           $_GET['a'] = 1; 
           if(isset($_GET['a']) AND $_GET['a'] != '')
           {
               $_GET['a'] = $_GET['a'];
           }
           
           if(empty($_GET['id']))
           {
               $_GET['id'] = $_POST['orderid'];
           }
       
	  $orderid = $_GET['id'];
	  $order_placed_ba= FetchAssoc(Query("SELECT u.id FROM `user` u, `order` o WHERE o.id ={$orderid} AND u.id = o.created_by"));
	  if($order_placed_ba['id'] != $_SESSION['id'] && $_SESSION['utype']=="BA")
	  {
	  	reload('access_denied.php'); 
	  }	
    
 	   $getdetail = $order->getOrderDetails($_GET['id'], $_GET['a']);
		if ($myACL->hasPermission('add_order') && $order->getcurrentorderstatus($_GET['id']) != 11 && !empty($getdetail) && isset($getdetail['request_to_cancel']) && $getdetail['request_to_cancel'] != 1) {
			if($order->getcurrentorderstatus($_GET['id']) >=8){				
				$tpl -> Zone("cancelbutton", "disabled");
			}else{
				$tpl -> Zone("cancelbutton", "enabled");
			}
 		}
	 	
   		if(isset($getdetail['tax_status']) && $getdetail['tax_status'] == 1) {
			$getdetail['salestax'] = 'Inclusive';
		} else {
			$getdetail['salestax'] = 'Exclusive';
		}
		if (!empty($getdetail) && array_key_exists('credit', $getdetail)) {
			if ($getdetail['credit'] == 0) {
				$getdetail['order_credit'] = "Zone";
			} else {
				$credit_user = getUserData($getdetail['credit']) ?? [];
				$getdetail['order_credit'] = $credit_user['first_name'] ?? '';
			}
		}
		
		if(isset($getdetail['payment_term']) && $getdetail['payment_term'] == 1){
		   
			$getdetail['payment_term_type'] = BLOOD_BAG_TERMS;
		}else if(isset($getdetail['payment_term']) && $getdetail['payment_term'] == 0){ 
			$getdetail['payment_term_type'] = "" ;
		}else{
			$getdetail['payment_term_type'] = EQUIPMENTS_TERMS ;
		}
		if(isset($getdetail['tax_type']) && $getdetail['tax_type'] == 1) {
			$getdetail['form'] = 'C Form';
		} else {
			$getdetail['form'] = 'D Form';
		}
 		if(isset($getdetail['request_to_cancel']) && $getdetail['request_to_cancel'] && $_SESSION['rid'] == 8) {
			$tpl -> Zone("success", "disabled");
 			$tpl -> AssignValue("baname", $order->getordermadeby($_GET['id']));
  		}
		$tpl -> AssignArray($getdetail); 
		$products = $order->getorderproducts($_GET['id']);
		$tpl -> AssignValue("total", $products['total']);
		$tpl -> Loop("products", $products);
 		$tpl -> Loop("deliverydate_products", $products); 
		
		if($myACL->hasPermission('update_delivery_date') && $order->getcurrentorderstatus($_GET['id']) <=7){
			$tpl -> Zone("deliverydateentrysection", "enabled");
		}
		
		if(isset($getdetail['request_to_cancel']) && $getdetail['request_to_cancel']) {		
			$tpl -> AssignValue("cancel_comment", $getdetail['reason_cancel']);
			$tpl -> AssignValue("reqcancelmadeby", $order->getordermadeby($_GET['id']));
			$tpl -> AssignValue("reqcanceldate", $getdetail['request_canceldate']);
			$tpl -> Zone("reqcancel", "enabled");
			if($getdetail['recommend_to_cancel'] !=0) {
				$tpl -> Zone("cancelreqrecommend", "enabled");
				if($getdetail['recommend_to_cancel'] == 1){
					$tpl -> AssignValue("recommend_action", 'Recommended to cancel');	
				}else{
					$tpl -> AssignValue("recommend_action", 'Not recommended to cancel');	
				}			 	
				$tpl -> AssignValue("recommendby", $order->getuserfirstname($getdetail['recommend_by']));	
			}		
		}
  		$allvissiblestatus = $order->getallstatus($_GET['id']);	 
  		$tpl -> Loop("orderstatus", $allvissiblestatus); 
 		if ($myACL->hasPermission('update_order_status') != true) {
			$tpl -> Zone("orderupdateform", "disabled");
			$tpl -> Zone("updateorderstatus", "disabled");			 
		}else{ 
  			$options[0] = 'Select Status';
			$workflow = new Workflow();
			$status = $workflow->getoptionlist($order->getcurrentorderstatus($_GET['id']), $_SESSION['rid']);
			$status = $status ?? [];
    		if(count($status) >0) {
				foreach($status as $val) {
					$options[$val['id']] = $val['option'];			
				}
				$tpl -> AssignValue("select_status", createSelect("status", $options));	
				$oid = $_GET['id'];
				$result=FetchAssoc(Query("SELECT u.area_id,u.zone_id,o.order_no FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by"));	 	
 				$tpl -> AssignValue("area_id", $result['area_id']);
				$tpl -> AssignValue("zone_id", $result['zone_id']);
				$tpl -> AssignValue("order_no", $result['order_no']);
				
 				$tpl -> Zone("orderupdateform", "enabled");
				$tpl -> Zone("recommendcancellation", "disabled");
			}else if(isset($getdetail['request_to_cancel']) && $getdetail['request_to_cancel'] && $myACL->hasPermission('recommend_order_cancellation') && $getdetail['recommend_to_cancel'] ==0){
				$tpl -> Zone("recommendcancellation", "enabled");
				$tpl -> Zone("orderupdateform", "enabled"); 				
			}else if(isset($getdetail['request_to_cancel']) && $getdetail['request_to_cancel'] ==1 && $getdetail['recommend_to_cancel'] ==1 && $order->getcurrentorderstatus($_GET['id']) !=11 && $myACL->hasPermission('cancel_order')){
				$tpl -> Zone("cancelaction", "enabled");
				$tpl -> Zone("orderupdateform", "enabled"); 				
			}else{
				$tpl -> Zone("updateorderstatus", "disabled");
				$tpl -> Zone("orderupdateform", "disabled");
			} 			
		}

        list($access, $confirm) = $order->checkTimeLeft($_GET['id'], 0);

        if($access == 'yes' AND $confirm == 'yes')
        {
            $notice = '<span></span>This Order is in edit mode.'; // The order is in edit mode. 
            $tpl -> Zone("noticemsg", "disabled");
        }
        else
        {
            $notice = ''; // The order is confirmed
        }                
        $tpl -> AssignValue("notice", $notice);
        
	//success message
	if(isset($_SESSION['message'])) {
 		$tpl -> AssignValue("message", $_SESSION['message']);
		$tpl -> Zone("success", "enabled");
	}
 	$tpl -> CleanTags();
	$tpl -> CleanZones();
	
	if(isset($_GET['print'])){
    	 echo $tpl -> Flush(1);
		 
	}else{
		LoadFrame($tpl -> Flush(1));
    } 
?>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/order.js"></script> 
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<?php 
if(isset($_GET['print'])){
echo '<script>$(document).ready(function (){window.print(); window.close();})</script>';
}
?>

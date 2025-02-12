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
	 
 	$perm = array('confirm_order'); 
	checkpermission($perm);
  
	//include(DIR_FUNCTIONS . "sent_mail.php");

        require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_new_mail();
        
	$tpl = new template();
	
	$tpl -> Load(TEMPLATE_PATH . "confirmorder.tpl");
	
	require(DIR_CLASSES . "order.php");
	$order = new Order();	
	
	$myACL = new ACL();

       $sql = Query("SELECT status FROM `order` WHERE id = '".$_GET['id']."'");
       $row_sql = FetchAssoc($sql);
       $statsFlag = $row_sql['status'];

       $tpl -> AssignValue("statusglag",$statsFlag); 
       
	if(isset($_GET['do']) AND $_GET['do'] == 'confirm') {
            //$update_flag = array('confirm_order' => '1');
            
            //Update("order",$update_flag,"id = ".$_GET['id']);
            
            if($statsFlag == 1)
            {
                list($access, $confirm) = $order->checkTimeLeft($_GET['id'], 2);
                if($access != 'yes' OR $confirm != 'yes')
                {
                    echo '<script>alert("Your time for editting the order has been expired.");</script>';
                    reload('list_orders.php');
                    exit();
                }            
            }
            $update_flag = array('status' => '1');            
            Update("order",$update_flag,"id = ".$_GET['id']);
            
            $sql_mail = Query("SELECT mail_sent FROM `order` WHERE id = '".$_GET['id']."'");
            $mailsent = FetchAssoc($sql_mail);
            
            $msgbody = ORDER_NOTIFICATION_BODY;
			$mail_subject= "Order placed notification";
            if($mailsent['mail_sent'] == 1)
            {
                $msgbody = ORDER_NOTIFICATION__UPDATED_BODY;
				$mail_subject= "Order updated notification";
            }
            
            $order_no = FetchAssoc(Query("SELECT order_no FROM `order` WHERE id = '".$_GET['id']."'"));
            $order_no = $order_no['order_no'];
           
            $notify = $order->notifymail(1, $_SESSION['areaid'], $_SESSION['zoneid'], $_SESSION['id']);	
			
            foreach($notify as $maildetails){				 
                    $tomail = $maildetails['email'];
                    $toname = $maildetails['first_name'];
                    $message = " Dear <b>Sir</b>,<br><br>";
                    $message .= $msgbody. "<br>"; 
                    $message .= "Order No:".$order_no."<br> <br>"; 
                    $message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$_GET['id']."'>here</a> to view.<br><br>";
                    $message .=	 "Thanks<br>";
                    $message .=	SITE_NAME;
                    // $mail->addContent("text/html",$message);
                    // $mail->addTo($tomail,$toname);
					prepare_new_mail_send($mail_subject, $tomail, $message, $toname);	
            }

            $update_mail = array('mail_sent' => '1'); 
            Update("order",$update_mail,"id = ".$_GET['id']);
           
            messages(ORDER_ADDED);
            reload('list_orders.php');
	}
	
        // Cancel this order
        if(isset($_GET['do']) AND $_GET['do'] == 'cancel')
        {
            Query("DELETE FROM `order` WHERE id = '".$_GET['id']."'");
            Query("DELETE FROM order_status WHERE order_id = '".$_GET['id']."'");
            Query("DELETE FROM product_order WHERE order_id = '".$_GET['id']."'");
            messages(ORDER_DELETE_SUCCESS);
            reload('list_orders.php');
        }

           
 	   $getdetail = $order->getOrderDetails($_GET['id'], $statsFlag);
           
  	   if($myACL->hasPermission('add_order') && $order->getcurrentorderstatus($_GET['id']) !=11 && $getdetail['request_to_cancel'] !=1){ 
			if($order->getcurrentorderstatus($_GET['id']) >=8){				
				$tpl -> Zone("cancelbutton", "disabled");
			}else{
				$tpl -> Zone("cancelbutton", "enabled");
			}
 		}
	 	
   		if($getdetail['tax_status'] == 1) {
			$getdetail['salestax'] = 'Inclusive';
		} else {
			$getdetail['salestax'] = 'Exclusive';

		}
		if($getdetail['credit'] == 0){
			$getdetail['order_credit'] = "Zone"  ;
		}else{
			$credit_user =  getUserData($getdetail['credit']);
			$getdetail['order_credit'] = $credit_user['first_name'];
		}
		if($getdetail['payment_term'] == 1){
		   
			$getdetail['payment_term_type'] = BLOOD_BAG_TERMS;
		}else if($getdetail['payment_term'] == 0){ 
			$getdetail['payment_term_type'] = "" ;
		}else{
			$getdetail['payment_term_type'] = EQUIPMENTS_TERMS ;
		}
                
		if($getdetail['tax_type'] == 1) {
			$getdetail['form'] = 'C Form';

		} else {
			$getdetail['form'] = 'D Form';

		}
 		if($getdetail['request_to_cancel'] && $_SESSION['rid'] == 8) {
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
		
		if($getdetail['request_to_cancel']) {		
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
			}else if($getdetail['request_to_cancel'] && $myACL->hasPermission('recommend_order_cancellation') && $getdetail['recommend_to_cancel'] ==0){
				$tpl -> Zone("recommendcancellation", "enabled");
				$tpl -> Zone("orderupdateform", "enabled"); 				
			}else if($getdetail['request_to_cancel'] ==1 && $getdetail['recommend_to_cancel'] ==1 && $order->getcurrentorderstatus($_GET['id']) !=11 && $myACL->hasPermission('cancel_order')){
				$tpl -> Zone("cancelaction", "enabled");
				$tpl -> Zone("orderupdateform", "enabled"); 				
			}else{
				$tpl -> Zone("updateorderstatus", "disabled");
				$tpl -> Zone("orderupdateform", "disabled");
			} 			
		}
                
                
	$credit ='';
	$options[0]	='---Select---';
	$q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
	$select_product_type=createSelect("product_type", $options,'',"class='ptype'");
	$tpl -> AssignValue("product_type", $select_product_type);
        
        $q_ctype = Query("SELECT user.id, user.first_name, user.last_name, user_roles.roleID
						FROM user, user_roles
						WHERE user_roles.userID = user.id
						AND user_roles.roleID !=2 AND user.status=1");	
					
	$credit .= '<select name="credit"    id="credit"   class="creditlist">';
	$credit .= "<option value='null'>---Select---</option>";
	$credit .= "<option value='0'>Zone</option>";
 	while($userlists = FetchAssoc($q_ctype)) {
		$credit .= '<option value="'.$userlists["id"].'">'.$userlists["first_name"].' '.$userlists["last_name"].'</option>';
	}
	$credit .= '</select>';
	
	$tpl -> AssignValue("select_user", $credit);
        
        $sql_status = FetchAssoc(Query("SELECT status FROM `order` WHERE id = '".$_GET['id']."'"));
    
        if($sql_status['status'] == 0)
        {
            $tpl -> Zone("deletebutton", "enabled");
        }else{
            $tpl -> Zone("deletebutton", "disabled");            
        }
                
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

<script type="text/javascript">
    $(function()
    {
        $(window).scroll(function()
        {
           $('.preview').css({'top':'120px'});
        });
    });
</script>
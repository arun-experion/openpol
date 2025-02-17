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
	
        /*require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_mail();*/	 
        
 	$perm = array('edit_order'); 
	checkpermission($perm);
  
	//include(DIR_FUNCTIONS . "sent_mail.php");
  
	$tpl = new template();
	
	$tpl -> Load(TEMPLATE_PATH . "editorder.tpl");
	
	require(DIR_CLASSES . "order.php");
	$order = new Order();	
	
	$myACL = new ACL();
 		
	if($_SERVER['REQUEST_METHOD'] == "POST") {
            //$update_flag = array('confirm_order' => '1');
            
            //Update("order",$update_flag,"id = ".$_GET['id']);
            
            $count= sizeof($_POST['product_id']);
            $empty_flag=1;
            for($j=0;$j<$count;$j++){
                    if($_POST['product_id'][$j] == '' || $_POST['quantity'][$j] == '' || $_POST['rate'][$j] == ''){
                            $empty_flag=0;
                    }
            }

            if($empty_flag)
            {	
                    $update_customer=array("name"        => $_POST['name'],
                                                               "address"     => $_POST['address']
                                                               );
                    
                    Update("customer", $update_customer,"order_no=".$_POST['order_no']);
                    $customer_id = Query("SELECT id FROM customer WHERE order_no='".$_POST['order_no']."'");
                    $row_customer_id = FetchAssoc($customer_id);
                    $customer_id = $row_customer_id['id']; 
                    // $prefered_date = date('Y-m-d H:i:s', strtotime($_POST['prefered_date']));
                    // $payment_date = date('Y-m-d H:i:s', strtotime($_POST['payment_date'])); 
                    
                    $status_set = 1;
                    if(ORDER_ACCESS == 'OFF')
                    {
                        $status_set = 0;
                    }                    
                    $update_order=array(  
                                        "dl_20b"               => $_POST['dl_20b'],
                                        "dl_21b"               => $_POST['dl_21b'],
                                        "cst"                  => $_POST['cst'],
                                        "tin"                  => $_POST['tin'],
                                        "bbl"                  => $_POST['bbl'],
                                        "credit"               => $_POST['credit'],
                                        "payment_term"         => !empty($_POST['payment_term'])?$_POST['payment_term']:0,
                                        "tax_status"			 => $_POST['tax_status'],	
                                        "tax_type"             => $_POST['tax_type'],
                                        "tax_rate"             => $_POST['tax_rate'],
                                        "customer_id"          => $customer_id,
                                        // "prefered_date"        => $prefered_date,
                                        "payment_terms"        => $_POST['payment_terms'],
                                        "payment_type"         => $_POST['payment_type'],
                                        "payment_no"           => $_POST['payment_no'],
                                        // "payment_date"         => $payment_date,
                                        "payment_amount"       => $_POST['payment_amount'],
                                        "instructions"         => $_POST['instructions'],
                                        "created_by"           => $_SESSION['id'], 
                                        "created_date"         => date('Y-m-d H:i:s'),
                                        "status"               => $status_set   
                                    );

                    if (!is_null(trim($_POST['payment_date'])) && strtotime($_POST['payment_date']) > 0)
                    {
                        $payment_date = date('Y-m-d H:i:s', strtotime($_POST['payment_date']));
                        $update_order["payment_date"] = $payment_date;
                    }
                    if (!is_null(trim($_POST['prefered_date'])) && strtotime($_POST['prefered_date']) > 0)
                    { 
                        $prefered_date = date('Y-m-d H:i:s', strtotime($_POST['prefered_date']));
                        $update_order["prefered_date"] = $prefered_date;
                    }
                   
                    Update("order", $update_order,"order_no=".$_POST['order_no']);
                    $insert_orderid = $_POST['order_id']; 
                    $order_no = $_POST['order_no'];
                    /*$order_no = $order->generateOrderNo($insert_orderid);
                $data1=array("order_no" =>  $order_no
                                            ); 
                    Update("order",$data1,"id=$insert_orderid");
                    $data2=array("order_no" =>  $order_no
                                            ); 
                    Update("customer",$data2,"id=$customer_id");*/
                    
                    // Delete all the products from product Order table and re insert the products
                    Query("DELETE FROM product_order WHERE order_id = '".$_POST['order_id']."'");
                    
                    for($i=0;$i<$count;$i++)
                    { 
                        $value = ($_POST['quantity'][$i]) * ($_POST['rate'][$i]);
                        $value  = round($value,2);
                        $insert_product=array("order_id"          => $insert_orderid,
                                              "product_id"        => $_POST['product_id'][$i],
                                              "carton_no"         => $_POST['carton_no'][$i],
                                              "quantity"          => $_POST['quantity'][$i],
                                              "rate"              => $_POST['rate'][$i],
                                              "value"             => $value
                                     );                        
                        Insert("product_order", $insert_product);	
                    }  

                    $current_status =1;
                    $comment = "Placed Order";
                    $update_status=array( "current_status"  => $current_status,
                                          "comment"         => $comment,
                                          "updated_by"      => $_SESSION['id'],
                                          "updated_date"    => date('Y-m-d H:i:s')
                                         ); 
                                         
                    Update("order_status", $update_status, "order_id = ".$_POST['order_id']);
                    
                   /* $notify = $order->notifymail(1, $_SESSION['areaid'], $_SESSION['zoneid']);			  
                    foreach($notify as $maildetails){				 
                            $tomail = $maildetails['email'];
                            $toname = $maildetails['first_name'];
                            $message = " Dear <b>Sir</b>,<br><br>";
                            $message .= ORDER_NOTIFICATION_BODY. "<br>"; 
                            $message .= "Order No:".$order_no."<br> <br>"; 
                            $message .=	"Click <a href='".HTTP_SERVER."vieworder.php?id=".$insert_orderid."'>here</a> to view.<br><br>";
                            $message .=	 "Thanks<br>";
                            $message .=	SITE_NAME;
                            $mail->MsgHTML($message);
                            $mail->AddAddress($tomail,$toname);	
                    }
                    $mail->Subject = "Order placed notification";				 
                    $mail->Send();*/ 
                    messages(ORDER_UPDATED);
                    
                    list($access, $confirm) = $order->checkTimeLeft($insert_orderid, 2);                   
                    if($access == 'yes' AND $confirm == 'yes')
                    {
                        reload('confirm_order.php?id='.$insert_orderid);
                        exit();
                    }
                    
                    reload('list_orders.php');


            }
            else
            {		
                $tpl -> AssignValue("message",REQUIRED_FIELD_MISSING);
            }
            
	}
        /*if(isset($_GET['do']) AND $_GET['do'] == 'cancel')
        {
           $insert_orderid = $_GET['id'];
           if(!empty($_SESSION['user']['product']) AND is_array($_SESSION['user']['product']))
           {
               foreach($_SESSION['user']['product'] as $inputs)
               {
                     $insert_product=array("order_id"          => $insert_orderid,
                                          "product_id"        => $inputs['product_id'],
                                          "carton_no"         => $inputs['carton_no'],
                                          "quantity"          => $inputs['quantity'],
                                          "rate"              => $inputs['rate'],
                                          "value"             => $inputs['value'],
                                          "delivery_date"     => $inputs['delivery_date'],
                                         );
                    $query = Query("SELECT product_id FROM product_order WHERE order_id = '".$insert_orderid."' AND product_id = '".$inputs['product_id']."'");
                    if(Num($query) == 0)
                    {   
                        Insert("product_order", $insert_product);
                    }                                           
               } 
               unset($_SESSION['user']['product']);
               }
        }*/
            
        $redirect = 'list_orders.php';
        /*if(isset($_GET['do']) AND $_GET['do'] == 'reset')
        {
            $redirect = 'edit_order.php?do=cancel&id='.$_GET['id'];

            unset($_SESSION['user']['product']);
            $sql_products = Query("SELECT * FROM product_order WHERE order_id = '".$_GET['id']."' ORDER BY id ASC");
            while($row_products = Fetch($sql_products))
            {
                $_SESSION['user']['product'][] = array(
                                                    'product_id' => $row_products['product_id'],
                                                    'carton_no' => $row_products['carton_no'],
                                                    'quantity' => $row_products['quantity'],
                                                    'rate' => $row_products['rate'],
                                                    'value' => $row_products['value'],
                                                    'delivery_date' => $row_products['delivery_date']
                                                    );

            }
            Query("DELETE FROM product_order WHERE order_id = '".$_GET['id']."'");
        }*/
        $tpl -> AssignValue("redirect", $redirect);
        $tpl -> AssignValue("time_left", TIME_LEFT);
        // Check current status.
        if($order->getcurrentorderstatus($_GET['id']) != 1)
        { 
            reload('list_orders.php');
            exit();            
        }        
        
        if($_GET['a'] == 1)
        {
            list($access, $confirm) = $order->checkTimeLeft($_GET['id'], 2);                   
            if($access != 'yes' OR $confirm != 'yes')
            {
                echo '<script>alert("Your time for editting the order has been expired.");</script>';
                reload('list_orders.php');
                exit();
            }
        }
        
        $timer = $order->checkTimeLeft($_GET['id'], 2, true);
        $tpl -> AssignValue("timer", $timer);
        
        $products = $order->getorderproducts_new($_GET['id']);

        $products_count = 0;
        if(!empty($products)) 
        {
            $tpl -> AssignValue("total", $products['total']);
            $tpl -> Loop("products", $products);
            $tpl -> Loop("deliverydate_products", $products);
            $tpl -> Zone("loopProducts", "enabled");
            $products_count = count($products)-1;
        }            
        $tpl -> AssignValue("totalProducts", $products_count);

       
        if($_GET['a'] == 0)
        {
            $tpl -> Zone("timeremain", "disabled");
            $tpl -> Zone("notconfirmed", "enabled");
        }
        else
        {
            $tpl -> Zone("timeremain", "enabled");
            $tpl -> Zone("notconfirmed", "disabled");             
        }
        
        $getdetail = $order->getOrderDetails($_GET['id'], $_GET['a']);
          
        if($myACL->hasPermission('add_order') && $order->getcurrentorderstatus($_GET['id']) !=11 && $getdetail['request_to_cancel'] !=1){ 
                    if($order->getcurrentorderstatus($_GET['id']) >=8){				
                            $tpl -> Zone("cancelbutton", "disabled");
                    }else{
                            $tpl -> Zone("cancelbutton", "enabled");
                    }
        }
	 	
        if($getdetail['tax_status'] == 1) {
                $getdetail['salestax'] = 'Inclusive';
                $getdetail['salestax1'] = 'Exclusive';
                $getdetail['value1'] = '1';
                $getdetail['value2'] = '2';
        } else {
                $getdetail['salestax'] = 'Exclusive';
                $getdetail['salestax1'] = 'Inclusive';
                $getdetail['value1'] = '2';
                $getdetail['value2'] = '1';
        }
        $credit = '';
        if($getdetail['credit'] == 0){ 
                $getdetail['order_credit'] = "Zone"  ;

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
        }else{ 
              $credit_user =  getUserData($getdetail['credit']);                        
              $getdetail['order_credit'] = $credit_user['first_name'];
              $q_ctype = Query("(SELECT user.id, user.first_name, user.last_name, user_roles.roleID
                                                    FROM user, user_roles
                                                    WHERE user_roles.userID = user.id
                                                    AND user_roles.roleID !=2 AND user.status=1 AND id='".$credit_user['id']."')
                                   UNION
                                   (SELECT user.id, user.first_name, user.last_name, user_roles.roleID
                                                    FROM user, user_roles
                                                    WHERE user_roles.userID = user.id
                                                    AND user_roles.roleID !=2 AND user.status=1 AND id!='".$credit_user['id']."')");
           $credit .= '<select name="credit"    id="credit"   class="creditlist">';
           while($userlists = FetchAssoc($q_ctype)) {
                    $credit .= '<option value="'.$userlists["id"].'">'.$userlists["first_name"].' '.$userlists["last_name"].'</option>';
            }
            $credit .= '</select>';                                                
        }

        $tpl -> AssignValue("select_user", $credit);
                
        $getdetail['payment1_checked'] = '';
        $getdetail['payment2_checked'] = '';
        $getdetail['payment_term_type_blood'] = BLOOD_BAG_TERMS;
        $getdetail['payment_term_type_eqp'] = EQUIPMENTS_TERMS ;
        
        $style1 = 'display:none';
        $style2 = 'display:none';
        if($getdetail['payment_term'] == 1){

                //$getdetail['payment_term_type_blood'] = BLOOD_BAG_TERMS;
                $getdetail['payment1_checked'] = 'checked';
                $style1 = 'display:block';
        }else if($getdetail['payment_term'] == 0){ 
                $getdetail['payment_term_type'] = "" ;
        }else{
                //$getdetail['payment_term_type_eqp'] = EQUIPMENTS_TERMS ;
                $getdetail['payment2_checked'] = 'checked';
                $style2 = 'display:block';
        }

        $tpl -> AssignValue("payment1_checked", $getdetail['payment1_checked']);
        $tpl -> AssignValue("payment2_checked", $getdetail['payment2_checked']);
        $tpl -> AssignValue("style1", $style1);
        $tpl -> AssignValue("style2", $style2);
        
        if($getdetail['tax_type'] == 1) {
                $getdetail['form'] = 'C Form';
                $getdetail['cformChecked'] = 'checked';
                $getdetail['dformChecked'] = '';
        } else {
                $getdetail['form'] = 'D Form';
                $getdetail['dformChecked'] = 'checked';
                $getdetail['cformChecked'] = '';
        }
        if($getdetail['request_to_cancel'] && $_SESSION['rid'] == 8) {
                $tpl -> Zone("success", "disabled");
                $tpl -> AssignValue("baname", $order->getordermadeby($_GET['id']));
        }
        $getdetail['typedd'] = '';
        $getdetail['typecheque'] = '';
        if($getdetail['payment_type'] == 1)
        {
            $getdetail['typecheque'] = 'checked';
        }
        else if($getdetail['payment_type'] == 2)
        {
            $getdetail['typedd'] = 'checked';
        }

        $tpl -> AssignArray($getdetail); 
        
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
        if(is_array($status) && count($status) > 0) {
                        foreach($status as $val) {
                                $options[$val['id']] = $val['option'];			
                        }
                        $tpl -> AssignValue("select_status", createSelect("status", $options));	
                        $oid = $_GET['id'];
                        $result=FetchAssoc(Query("SELECT u.area_id,u.zone_id,o.order_no FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by AND and o.status = 1"));	 	
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

        if(!empty($products))
        {
            $product_type_id_sql = Query("SELECT product_type_id FROM product WHERE name='".$products[0]['productname']."'");
            $row_product_type_id = FetchAssoc($product_type_id_sql);
            $tpl -> AssignValue("product_type_id", $row_product_type_id['product_type_id']);        
            $cat_type = Query("(SELECT * FROM product_type WHERE id = '".$row_product_type_id['product_type_id']."') union (select * from product_type WHERE id != '".$row_product_type_id['product_type_id']."')");
            while($row_ptype = FetchAssoc($cat_type)) 
            { 
                $select[$row_ptype["id"]] = $row_ptype["name"];
            }
        }
        else
        {
            $select[0]	='---Select---';
            $q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$select[$r_ptype["id"]] = $r_ptype["name"];
			} 
        }
        
        $select_product_type=createSelect("product_type", $select,'',"class='ptype'");
        $tpl -> AssignValue("product_type", $select_product_type);      
               
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
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/order.js"></script> 
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js"></script> 
<?php 
if(isset($_GET['print'])){
echo '<script>$(document).ready(function (){window.print(); window.close();})</script>';
}
?>

<script>
    
    var matched, browser;
 
    jQuery.uaMatch = function (ua) {
        ua = ua.toLowerCase();
 
        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
            [];
 
        return {
            browser: match[1] || "",
            version: match[2] || "0"
        };
    };
 
    matched = jQuery.uaMatch(navigator.userAgent);
    browser = {};
 
    if (matched.browser) {
        browser[matched.browser] = true;
        browser.version = matched.version;
    }
 
    // Chrome is Webkit, but Webkit is also Safari.
    if (browser.chrome) {
        browser.webkit = true;
    } else if (browser.webkit) {
        browser.safari = true;
    }
 
    jQuery.browser = browser;
    
 
    $(function () {
        $("#datepicker-13").datepicker();
        $("#datepicker-13").datepicker("show");
    });
</script>

<script type="text/javascript">
    
	var $j=1;
	$('.productslno').each(function (){ 
		var sl_id=$(this).attr('id');
		var getno = sl_id.split('_');
		var sl_no = getno[1];
		$("#productslno_"+sl_no).text($j);						 
		$j=$j+1;
	});

	$('.rates').keyup(function() {
		var rateid=$(this).attr('id');
		var rate=$(this).val();
		calculate_rate(rateid,rate);			
	});
	$('.rates').blur(function() {
		var rateid=$(this).attr('id');
		var rate=$(this).val();
		calculate_rate(rateid,rate);			
	});


   function calculate_rate(rateid,rate) { 
		var getno = rateid.split('_');
		var qty = $("#qty_"+getno[1]).val();
		
		if (isNaN(rate) || parseFloat(rate) <=0 ) {
			alert("Please enter a valid number");
			$("#"+rateid).val('');
			$("#"+rateid).attr('class', 'rateerror');			
		}else{
			$("#"+rateid).attr('class', 'rates');	
			$("#addorder").show();	 
		}
		
		if(parseInt(qty)>0 && parseInt(rate)>0)	{		
			var total = parseFloat(qty)*parseFloat(rate);
			if (!isNaN(total)) {
				$("#total_"+getno[1]).text(total.toFixed(2));
			} else {
				$("#total_"+getno[1]).text('');
			}
			var total_value = parseFloat($("#total_value").text());
			total_value = total_value + parseFloat(total.toFixed(2));
			if (!isNaN(total_value)){
				$("#total_value").text(total_value.toFixed(2));
			}		
		} else {
			$("#total_"+getno[1]).text('');			
		}
		
		var total= 0;
		 $('.total').each(function () {
			  if(parseFloat($(this).text())>0 && !isNaN(rate)) {
				 total =  parseFloat(total) + parseFloat($(this).text());
			   }	
		 });
		  
		 if (!isNaN(total)){
			$("#total_value").text(total.toFixed(2));
		 }
	} 
	 
	/*$('.qty').keyup(function() {
		var qtyid=$(this).attr('id');	
		var qty=$(this).val();
		calculate_quantity(qtyid,qty);	
	}); */
	

	
		$('.qty').blur(function() {
		var qtyid=$(this).attr('id');	
		var qty=$(this).val();
		calculate_quantity(qtyid,qty);	
	});

	function calculate_quantity(qtyid,qty) {

	    var getno = qtyid.split('_');
	    var productid = $("#productid_"+getno[1]).val();
		var carton = $("#carton_"+getno[1]).text();
		var product_type = $("#product_category").val();	
		if (productid==0) {
		        $("#qty_"+getno[1]).val('');
				$("#total_"+getno[1]).text('');
				$("#total_value").text('');
				alert ("please select a product");
				
		}else{
			var rate = $("#price_"+getno[1]).val();
			if (isNaN(qty) || parseFloat(qty) == 0) {
				alert("Please enter a valid number");
				$("#"+qtyid).val('');
				$("#"+qtyid).attr('class', 'qtyerror');				
			}else{
			    $("#"+qtyid).val(parseFloat(qty)); 
				var remdr =parseFloat(qty)%parseInt(carton); 
		   if(remdr==0 || product_type!=1||carton==0){
					$("#"+qtyid).attr('class', 'qty');
					$("#addorder").show();
						
				if(parseFloat(qty)>0 && parseFloat(rate)>0)	{
					var total = parseFloat(qty)*parseFloat(rate);
					if (!isNaN(total)){
					$("#total_"+getno[1]).text(total.toFixed(2));
					}else{
					$("#total_"+getno[1]).text('');			
					}				
				}else{
					$("#total_"+getno[1]).text('');
				}
				
				var total= 0;
				$('.total').each(function () {
				  if(parseFloat($(this).text())>0 && !isNaN(rate)) {
					 total =  parseFloat(total) + parseFloat($(this).text());
				  }	
				});
				  
				if (!isNaN(total)){
					$("#total_value").text(total.toFixed(2));
				}
		}else{
					alert ("Please enter Quantity as any multiple of Carton");
					$("#"+qtyid).val('');
					$("#total_"+getno[1]).text('');
					$("#total_value").text('');		
					$("#"+qtyid).attr('class', 'qtyerror');
		}
				
						 
	  }
				
			
		}
	} 

	$("#payment_no").blur(function() {
		var paymentno = $(this).val();	
		if (paymentno=='') {
			   $(this).attr('class', 'noerror');
				
		}else{
			  $(this).attr('class', 'no');	
			  $("#addorder").show(); 
		}						   
	});
	
	$("#payment_amount").blur(function() {
		var payment_amount =$(this).val();	
		if (isNaN(payment_amount)) {
		    alert("Please enter a valid number");
			$(this).attr('class', 'amounterror');	
			$(this).val('');	   
		}else{
			 $(this).attr('class', 'amount');
			 $("#addorder").show();
		}						   
	} );

	$('.date-pick').change(function() {
		var paymentdate =$(this).val();	
		if (paymentdate) {
			  $(this).attr('style', '');
		}else{
			  $(this).attr('style', 'border:1px solid #FF0000');			  
		}						   
	});

	$('.remove').click(function(){
		var row_id = $(this).attr('id');
		var max_div_id = $("#product_count").val();
		if (row_id == max_div_id){
			max_div_id = max_div_id -1;
			$("#product_count").val(max_div_id);
		}
		
		$("#productadd_"+row_id).remove();
		$i=1;
		$('.whitecolumnrowone').each(function (){ 
			if($i%2 ==0){
				$(this).attr('style', 'background-color: #FFFFFF;');
			}else{
				$(this).attr('style', '');
			}
			$i=$i+1;
		});
			 
		var $j=1;
		$('.productslno').each(function (){ 
			var sl_id=$(this).attr('id');
			var getno = sl_id.split('_');
			var sl_no = getno[1];
			$("#productslno_"+sl_no).text($j);						 
			$j=$j+1;
		});
		
	 
		var total= 0;
		$('.total').each(function () {
		  if(parseInt($(this).text())>0){
			 total =  parseFloat(total) + parseFloat($(this).text());
			}	
		});
		$("#total_value").text(total.toFixed(2));			
		
	});

    $('.plist_sp').click(function () {
		
        product_id = {id:$(this).val()}
        var code_list_id=$(this).attr('id');
        var getno = code_list_id.split('_');
        var list_id = getno[1];
        var pid=$(this).val();
        if(pid>0){
        $("#product_list_"+list_id).attr('style', 'border:0px solid red');}
        $("#productid_"+list_id).val($(this).val());
        $.get('getproductcode.php', product_id, function(data) {
        $("#productcode_"+list_id).html(data.code);	
		$("#price_"+list_id).val(data.rate);
		$("#carton_"+list_id).html(data.carton);
		$("#cartonvalue_"+list_id).val(data.carton);
		if(data.rate){
		$("#price_"+list_id).attr('class', 'rates');
		}
		var carton = $("#carton_"+list_id).text();
		var qty    =  $("#qty_"+list_id).val();
		$("#"+list_id).val(parseFloat(qty));
		if(!isNaN(qty)&&qty>0 ){
		var remdr =parseFloat(qty)%parseInt(carton);
		var product_type = $("#product_category").val(); 
		if (carton!=0){ 
			if(remdr!=0 && product_type==1){
				alert ("Please enter Quantity as any multiple of Carton");
				$("#qty_"+list_id).val('');
				$("#total_"+getno[1]).text('');
				$("#total_value").text('');		
				$("#qty_"+list_id).attr('class', 'qtyerror');
			}
		}
	    }
		newtotal=parseFloat($("#price_"+list_id).val()) * parseFloat($("#qty_"+list_id).val()) ;
		if(!isNaN(newtotal)){
			$("#total_"+list_id).text(newtotal);
		}else{
			$("#total_"+list_id).text('');
		}
		var total= 0;
		 $('.total').each(function () {
		  if(parseInt($(this).text())>0){
			 total =  parseFloat(total) + parseFloat($(this).text());
			}	
		 });
		 $("#total_value").text(total.toFixed(2));
		
		$("#addorder").show();					
		},'json');
	 });
	 
	 
	$("#bloodbagterms").click(function(){
		 if($("#bloodbagterms").attr("checked")){
		 	$("#bloodbagtermserror").text("");
			$("#addorder").show();
		 }
	
	});
	$("#eqpterms").click(function(){
		 if($("#eqpterms").attr("checked")){
		 	$("#eqptermserror").text("");
			$("#addorder").show();
		 }
	
	});
        
    $(function () 
    {
        if($('#timer').val() > 0)
        {
            $('#defaultCountdown').countdown({until: $('#timer').val(), 
            onTick: highlightLast5, format:'HMS'}); 
        }
        
        function highlightLast5(periods) 
        { 
            if ($.countdown.periodsToSeconds(periods) == 5) { 
            $(this).addClass('highlight'); 
            } 
            if ($.countdown.periodsToSeconds(periods) == 0) { 
                alert("Your time for editting the order has been expired.");
                window.location.href="list_orders.php";
            } 
        }
       
    });
    
</script>

<style type="text/css">
@import "templates/default/css/jquery.countdown.css";

#defaultCountdown { width: 240px; height: 45px; }
.highlight{color:#FF0000}
</style>
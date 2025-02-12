<?php 
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: order.php  Wednesday, June 16, 2010, 10:00:00 AM $
 *		
 */
  
    include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	require(DIR_CLASSES . "order.php");
	
	/*require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_mail();*/
    error_reporting(0);
	$perm = array('add_order');
	checkpermission($perm);
	$tpl = new template();
	$order = new Order();
	$tpl -> Load(TEMPLATE_PATH . "order.tpl");
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
	$terms1=BLOOD_BAG_TERMS;
	$terms2=EQUIPMENTS_TERMS;
	$tpl -> AssignValue("terms1", $terms1);
	$tpl -> AssignValue("terms2", $terms2);
	
    if($_SERVER['REQUEST_METHOD'] == "POST") 
	{
	    
		$count= sizeof($_POST['product_id']);
		$empty_flag=1;
		for($j=0;$j<$count;$j++){
			if($_POST['product_id'][$j] == '' || $_POST['quantity'][$j] == '' || $_POST['rate'][$j] == ''){
				$empty_flag=0;
			}
		}
		
		if($empty_flag)
		{	
			
			
			
		
			$insert_customer=array("name"        => $_POST['name'],
								   "address"     => $_POST['address']
								   ); 
			
			Insert("customer", $insert_customer);
			$customer_id =mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
			// $prefered_date = date('Y-m-d H:i:s', strtotime($_POST['prefered_date']));
			// $payment_date = date('Y-m-d H:i:s', strtotime($_POST['payment_date']));
                        
                        $status_set = 1;
                        if(ORDER_ACCESS == 'OFF')
                        {
                            $status_set = 0;
                        }
			$insert_order=array(  
								"order_no"			   	=> "",
								"carrer_information"	=> "",
								"transportation_mode"	=> "",
								"reason_cancel"			=> "",
								"recommend_comment"		=> "",
								"order_status"		   => 0,
								"invoice_no"		   => 0,
								"request_to_cancel"	=> 0,
								"recommend_to_cancel"	=> 0,
								"recommend_by"	=> 0,
								"dl_20b"               => !empty($_POST['dl_20b'])?$_POST['dl_20b']:0,
								"dl_21b"               => !empty($_POST['dl_21b'])?$_POST['dl_21b']:0,
								"cst"                  => !empty($_POST['cst'])?$_POST['cst']:0,
								"tin"                  => !empty($_POST['tin'])?$_POST['tin']:0,
								"bbl"                  => !empty($_POST['bbl'])?$_POST['bbl']:0,
								"credit"               => !empty($_POST['credit'])?$_POST['credit']:0,
								"payment_term"         => !empty($_POST['payment_term'])?$_POST['payment_term']:0,
								"tax_status"			=> !empty($_POST['tax_status'])?$_POST['tax_status']:0,	
								"tax_type"             => !empty($_POST['tax_type'])?$_POST['tax_type']:0,
								"tax_rate"             => !empty($_POST['tax_rate'])?$_POST['tax_rate']:0,
								"customer_id"          => $customer_id,
								// "prefered_date"        => $prefered_date,
								"payment_terms"        => !empty($_POST['payment_terms'])?$_POST['payment_terms']:0,
								"payment_type"         => !empty($_POST['payment_type'])?$_POST['payment_type']:0,
								"payment_no"           => !empty($_POST['payment_no'])?$_POST['payment_no']:0,
								// "payment_date"         => $payment_date,
								"payment_amount"       => !empty($_POST['payment_amount'])?$_POST['payment_amount']:0,
								"instructions"         => !empty($_POST['instructions'])?$_POST['instructions']:0,
								"created_by"           => $_SESSION['id'], 
								"created_date"         => date('Y-m-d H:i:s'),
                                                                "status"               => $status_set,
                                                                "mail_sent"            => '0'
						       );
		
			if (!is_null(trim($_POST['payment_date'])) && strtotime($_POST['payment_date']) > 0)
			{
				$payment_date = date('Y-m-d H:i:s', strtotime($_POST['payment_date']));
				$insert_order["payment_date"] = $payment_date;
			}
			if (!is_null(trim($_POST['prefered_date'])) && strtotime($_POST['prefered_date']) > 0)
			{ 
				$prefered_date = date('Y-m-d H:i:s', strtotime($_POST['prefered_date']));
				$insert_order["prefered_date"] = $prefered_date;
			}	
		
			Insert("order", $insert_order);
			$insert_orderid=mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
			$order_no = $order->generateOrderNo($insert_orderid);
		    $data1=array("order_no" =>  $order_no
						); 
			Update("order",$data1,"id=$insert_orderid");
			$data2=array("order_no" =>  $order_no
						); 
			Update("customer",$data2,"id=$customer_id");
		    for($i=0;$i<$count;$i++){ 
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
		    $insert_status=array( "order_id"        => $insert_orderid,
								  "current_status"  => $current_status,
								  "comment"         => $comment,
								  "updated_by"      => $_SESSION['id'],
								  "updated_date"    => date('Y-m-d H:i:s')
								   ); 
			
			Insert("order_status", $insert_status);		 
 			/*$notify = $order->notifymail(1, $_SESSION['areaid'], $_SESSION['zoneid']);			  
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
                        if(ORDER_ACCESS == 'OFF'){
                            messages(ORDER_DRAFTED);
                        }
                        else{
                            messages(ORDER_CREATED);
                        }
			reload('confirm_order.php?id='.$insert_orderid);
                        //reload('list_orders.php');
			
		 
		}else{
		
			$tpl -> AssignValue("message",REQUIRED_FIELD_MISSING);
				
	   }
		
	
	}
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));

?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/order.js"></script> 
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>

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

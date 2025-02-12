<?php
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: order.php  Wednessday, June 16, 2010, 03:18:41 PM $
 *		
 */
 
class Order
{
	function getOrderDetails($oid, $status = 1) {  	
	
	$q= Query("SELECT o.id, o.order_no, o.dl_20b, o.dl_21b, o.cst, o.tin, o.bbl,o.credit,o.payment_term,o.tax_status, o.tax_type, o.customer_id,  DATE_FORMAT(o.prefered_date , ".SHORT_DATE." ) as prefered_date, o.recommend_to_cancel,o.recommend_by,o.recommend_comment, DATE_FORMAT(o.recommend_date, ".SHORT_DATE_WITHTIME." ) as recommend_date , o.payment_terms, o.payment_type, o.payment_no, DATE_FORMAT(o.payment_date , ".SHORT_DATE." ) as payment_date, o.payment_amount, o.instructions, o.order_status, o.invoice_no, DATE_FORMAT(o.delivered_date , ".SHORT_DATE_WITHTIME." ) as delivered_date, o.carrer_information, o.transportation_mode, DATE_FORMAT(o.received_date , ".SHORT_DATE_WITHTIME." ) as received_date,o.created_by, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as created_date, o.tax_rate, o.request_to_cancel, o.reason_cancel, DATE_FORMAT(o.request_canceldate , ".SHORT_DATE_WITHTIME." ) as request_canceldate, c.address, c.name FROM `[x]order` o, `[x]customer` c WHERE o.id='{$oid}' and o.customer_id=c.id and o.status = $status");	 
	
	
		 if(Num($q))
		 {
		  $r = FetchAssoc($q);	
		  //print_r($r); 	 
		  return $r;
		 }
	}
	
	function getorderproducts($oid) { 
		$order= Query("SELECT po.carton_no, po.quantity, po.rate, po.value, p.name as productname, p.code, p.id as prod_id, DATE_FORMAT(po.delivery_date, ".SHORT_DATE.") as delivery_date from `[x]product_order` po, `[x]product` p where po.order_id={$oid} and po.product_id=p.id");
		$i=1;
		$total=0;
		 if(Num($order))
		 {
		  	while($r = FetchAssoc($order)) {
				$r['slno'] = $i;
				$total +=$r['value'];
				$r['rate']	= number_format($r['rate'],2);
				$r['value']	= number_format($r['value'],2);
				if($i%2 ==0) {
					$r['class'] = 'one';
				}else { 
					$r['class'] = 'two';
				}				
				$result[] =$r;
				$i++;
			}	
			$result['total'] = number_format($total,2);	 
		  return $result;
		 }
	}
	
	function getorderproducts_new($oid) 
        { 
		$order= Query("SELECT po.carton_no, po.quantity, po.rate, po.value, p.name as productname, p.code, p.id as prod_id, p.product_type_id, DATE_FORMAT(po.delivery_date, ".SHORT_DATE.") as delivery_date from `[x]product_order` po, `[x]product` p where po.order_id={$oid} and po.product_id=p.id order by po.id ASC");
		$i=1;
		$total=0;
		 if(Num($order))
		 {
		  	while($r = FetchAssoc($order)) {
				$r['slno'] = $i;
				$total +=$r['value'];
				$r['rate']	= $r['rate']; //number_format($r['rate'],2);
				$r['value']	= $r['value'];//number_format($r['value'],2);
				if($i%2 ==0) {
					$r['class'] = 'one';
				}else { 
					$r['class'] = 'two';
				}
                                $output = '';
                                $next_divid =  $i;
								$qq = "(SELECT name, id FROM `[x]product` where product_type_id =".$r['product_type_id']." AND status=1 AND name='".$r['productname']."') UNION (SELECT name, id FROM `[x]product` where product_type_id =".$r['product_type_id']." AND status=1 AND name !='".$r['productname']."')";
                                $productquery = Query("(SELECT name, id FROM `[x]product` where product_type_id =".$r['product_type_id']." AND status=1 AND name='".$r['productname']."') UNION (SELECT name, id FROM `[x]product` where product_type_id =".$r['product_type_id']." AND status=1 AND name !='".$r['productname']."')");                                
                                while($productresults = FetchAssoc($productquery)) 
                                {   
									$product_name_code = $r['productname']." (".$r['code'].")";
                                    // $output .= '<option value="'.$productresults["id"].'">'.$productresults["name"].'</option>';
									$output = "<div class='searchcontainer'><input value='".$product_name_code."' type='text' name='live_searchproduct' id='live_searchproduct".$next_divid."' class='live_searchproduct' data-next='".$next_divid."' autocomplete='off' />
									<div class='search_result' id='search_result".$next_divid."'></div></div>";
                                }

                                $r['drop'] = $output;

                                $productid_sql = Query("SELECT id FROM `[x]product` where product_type_id =".$r['product_type_id']." AND status=1 AND name='".$r['productname']."'");
                                $row_productid = FetchAssoc($productid_sql);
                                $r['productid'] = $row_productid['id'];

                                $result[] =$r;
                                
				$i++;
			}	
			$result['total'] = number_format($total,2);
		  return $result;
		 }
	}                   
	
        function generateOrderNo($order_id)
        {

                $today = date('dmY');
                if ($order_id < 10){                // If the value is under 10 then 2 zeros are needed to make a 3 digit value.
                $order_no = "000" . $order_id;
                }
                else if ($order_id < 100){      // If the value is under 100 then 1 zero is needed to make a 3 digit value.
                $order_no = "00" . $order_id;
                }
                else if ($order_id < 1000){  
                $order_no = "0" . $order_id;
                }
                else{                               // If the value is not less the 10 or 100 then is is already a 3 digit value.
                $order_no = $order_id;
                }
                return $today.$order_no;
        }
	
	 	 
	function getcurrentorderstatus($oid) { 
 		$orderstatus= Query("SELECT os.current_status,s.ba_visibility FROM `[x]order_status` os, `[x]status` s  where os.order_id={$oid} and os.current_status=s.id order by os.id desc limit 0,1");
		if(Num($orderstatus)) {
		  	 $r = FetchAssoc($orderstatus);	
			 if($r['ba_visibility'] == 0 && $_SESSION['utype'] == 'BA'){
 			 	$bastatus= FetchAssoc(Query("SELECT os.current_status,s.ba_visibility FROM `[x]order_status` os, `[x]status` s  where os.order_id={$oid} and os.current_status=s.id and s.ba_visibility=1 order by os.id desc limit 0,1"));
				 return $bastatus['current_status'];;
			 }else{
   		  		return $r['current_status'];
			}
		 }
	}
	
	function getallstatus($oid) { 
	
		$extra = '';
		if($_SESSION['utype'] == 'BA') {
			$extra = ' and s.ba_visibility = 1';
		}
	 
		
 		$orderstatus= Query("SELECT o.comment, o.updated_by, o.current_status, DATE_FORMAT(o.updated_date , ".SHORT_DATE_WITHTIME." ) as updated_date, u.first_name, u.last_name, s.ba_visibility FROM `[x]order_status` o, `[x]user` u, `[x]status` s where order_id={$oid} and u.id=o.updated_by and s.id = o.current_status" . $extra." order by o.updated_date");
 		$i=0;
		if(Num($orderstatus)) {
		  	while($r = FetchAssoc($orderstatus)) {
				$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] = 'one';
				}else { 
					$r['class'] = 'two';
				}
				$orderremarks = $this->getstatusname($r['current_status']);
				$r['status'] = $orderremarks['status'];
				$r['action'] = $orderremarks['action'];
 				$r['doneby'] = $this->getdoenby($r['updated_by']);
 				$result[] =$r;
				$i++;
			}	
			
 	 	 	return $result;
		}
	}
	
	function getstatusname($sid) {
		
			$orderstatus= Query("SELECT * FROM `[x]status` where id={$sid}");
			if(Num($orderstatus)) {
				$r = FetchAssoc($orderstatus);
				return $r;
			 }	
	}
	
	function getworkflows() {
		$workflowquery = Query("SELECT * FROM workflow where complaint=0 order by user_role");
			if(Num($workflowquery)) {
			$i=0;
				while($workflowresult = FetchAssoc($workflowquery)) {
					if($i%2 ==0) {
						$workflowresult['class'] = "two";
					}else {
						$workflowresult['class'] = "one";
					}		
					$workflowresult['role'] =$this->getrolename($workflowresult['user_role']);
					$getstatus =$this->getstatusname($workflowresult['status']);
					$workflowresult['statusname'] = $getstatus['status'];
					$getnextstatus =$this->getstatusname($workflowresult['next']);
					$workflowresult['nextstatus'] = $getnextstatus['status'];
					$workflows[] = $workflowresult;
					$i++;
				}
				
				return $workflows;
			}
	}
	
	function getrolename($rid) {	
	$query= Query("SELECT roleName FROM `[x]roles` WHERE ID='{$rid}'");		
		 if(Num($query))
		 {
		  $result = FetchAssoc($query);		 	 
		  return $result['roleName'];
		 }
	}
	
	function getdoenby($utid) {
 	$q= Query("SELECT r.roleName FROM `roles` r, `user_roles` ur WHERE ur.userID ={$utid} AND r.ID = ur.roleId");	 
 
		 if(Num($q))
		 {
			 while($r = FetchAssoc($q)){
				$utype  = $r;
				}
			  return $utype['roleName'];
		 }
	}
	
	function getordermadeby($oid,$format = '') {
		$result= FetchAssoc(Query("SELECT u.first_name,u.id FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by and o.status = 1"));	 	
		$id=$result['id'];
                if(!empty($id))
                {
                    $role_result= FetchAssoc(Query("SELECT r.roleName FROM `roles` r, `user_roles` ur WHERE ur.userID ={$id} AND r.ID = ur.roleId"));	 
                    if($format == 'name_role') {
                             return $result['first_name'].' ('.$role_result['roleName'].') ';		
                    }else{
                             return $result['first_name'];
                    }
                }
	}
	 
	function dasboardallorder($from,$to,$status,$zone_id,$product_type_id) {	
 		$extra = '';
		
 		if($_SESSION['utype'] == 'BA') {			
			 $extra =" AND o.created_by = {$_SESSION['id']}";		
 		}else if($_SESSION['utype'] == 'AM'){
			$extra =" AND u.area_id = {$_SESSION['areaid']}";
 		}
		 if($_SESSION['utype'] == 'ZH'){
			$extra =" AND u.zone_id = {$_SESSION['zoneid']}";		
 		}
		if($zone_id > 0){
			$extra =" AND u.zone_id = {$zone_id}";
		}
		if($product_type_id>0){
			$extra .=" AND pt.id = {$product_type_id}";
		}
		
 		if($status == 8) {
			$extracondition ="and os.status !=11 and os.status <=10 and os.status >=".$status.$extra;	
		}else if($status == 11) {
			$extracondition ="and os.status =11".$extra;	
		}else{
			$extracondition = "and os.status !=11".$extra;
		}
		
 $query = "Select Distinct o.id, u.zone_id  From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `product_order` po ON po.order_id = o.id  INNER JOIN product p ON p.id = po.product_id  INNER JOIN product_type pt ON pt.id = p.product_type_id  INNER JOIN `user` u ON u.id=o.created_by and DATE_FORMAT(o.created_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(o.created_date, '%Y-%m-%d') <=  '".$to."' ".$extracondition." where o.status = 1 ORDER BY o.id desc";

	
		$q = Query($query);
                if(!empty($q))
                {
                    $values['number'] = Num($q);
                    $total=0;
                            while($r = FetchAssoc($q)) {				
                                    $sumquery= FetchAssoc(Query("SELECT SUM(`value`) as total FROM  `product_order` WHERE order_id=".$r['id']));
                                    $total +=$sumquery['total'];
                            }
                    $values['total'] =	$total;
                    return $values;
                }
	}
	
	
	function gettotal($orderid){
	
	 $query ="SELECT SUM( `value` ) AS total FROM `product_order` WHERE order_id =".$orderid;
	 $query= Query($query);
	 $total = " ";
	 if(Num($query))
		 {
			 while($r = FetchAssoc($query)){
				$result  = $r;
				}
			  $total =$result['total'];
		 }
	
	return $total;
	
	}
	
	function getproducts($orderid){
	
			$query ="SELECT product.name , product_order.carton_no,product_order.quantity,product_order.rate,product_order.value
					 FROM product_order , product WHERE product_order.product_id = product.id 
					 AND product_order.order_id =".$orderid;
			$query= Query($query);
			$products = " ";
	        $products .=  "<table  border = \"0\"  cellspacing= \"0\" cellpadding = \"0\">";
			$i=1;
			 while($product = FetchAssoc($query)){
			 $products  .= "<tr>";
			 $product_rate = $product['rate'];
			 $product_value = $product['value'];
			 $products .= "<td align=\"left\" valign=\"top\" >".$product['name']."</td>
			               <td align=\"center\" valign=\"top\" >".$product['carton_no']."</td>
						   <td valign=\"top\" align=\"center\">".$product['quantity']."</td>
						   <td align=\"right\" valign=\"top\">".number_format($product_rate,2)."&nbsp;</td>
						   <td align=\"right\" valign=\"top\" >".number_format($product_value,2);
			  $products  .= "&nbsp;</td></tr>";
			  $i++;
			}
				
			$products .=  "</table>";	
			   //	$products	=	substr_replace($products,"",-5);
	
	
		return $products;
	
	}
	
	function getproductsreport($orderid){
	
		$query ="SELECT product.name , product.code, product_order.carton_no,product_order.quantity,product_order.rate,product_order.value
				 FROM product_order , product WHERE product_order.product_id = product.id 
				 AND product_order.order_id =".$orderid;
		$query= Query($query);
		
			 while($product = FetchAssoc($query)){
				$products[] = $product;
			 }
		// $products['count'] = Num($query);
		return $products;
	
	}
	
	function notifymail($current_status,$areaid,$zoneid,$createduser){
  		$query = Query("SELECT next FROM `[x]workflow` WHERE status={$current_status} and complaint=0");
 		$extra ="";
		$userchk = "0";
		if(Num($query)) {
			while($result = FetchAssoc($query)) {
  				$nextrole =	Query("SELECT distinct user_role FROM `[x]workflow` WHERE next=".$result['next']." and complaint=0");
				$nextroles = FetchAssoc($nextrole);
 				if($userchk != $nextroles['user_role'])
				{
					$userchk = $nextroles['user_role'];	
 					$utype = $this->getrolename($nextroles['user_role']);
					if($utype == "Area Manager") {
						$extra = " and u.area_id=".$areaid;
					}else if($utype == "Zonal Head") {
						$extra = " and u.zone_id=".$zoneid;
					}	
					
					if($utype == "Business Associate") {
					$querygetdetails = "SELECT id, first_name, last_name, email FROM `[x]user`  WHERE id= ". $createduser;
					}else{			
					$querygetdetails = "SELECT ur.userID, u.id, u.first_name, u.last_name, u.email FROM `[x]user_roles` ur, `[x]user` u  WHERE u.status = 1 and u.id=ur.userID and ur.roleID = ". $nextroles['user_role'] .$extra;
					}
 					$query_role = Query($querygetdetails);
 					if(Num($query_role)){
						while($result_role = FetchAssoc($query_role)) {
							$options[] = $result_role;
						}	
					}	
				}
						
 			}
			return $options;
		}
		
	}
	
	function getuserfirstname($uid){
		$q= Query("SELECT first_name, last_name FROM `[x]user` WHERE id='{$uid}'");	
		 $r = FetchAssoc($q);
		 return $r['first_name'].' '.$r['last_name']; 	 
	}
	
	function cancellation_notification_mailid($oid){
 		
		//notify the BA who placed the order			 
		$result_ba= FetchAssoc(Query("SELECT o.order_no,u.email,u.first_name,u.zone_id FROM `user` u, `order` o WHERE o.id ={$oid} AND u.id = o.created_by and o.status = 1"));	
		$mailid[] = $result_ba['email'];
		
                if(!empty($result_ba))
                {
		//notify the corresponding ZH	
		$userquery= Query("SELECT u.email FROM `user` u, `user_roles` ur WHERE u.zone_id =". $result_ba['zone_id']." AND u.id=ur.userID AND ur.roleID=".ZH);	
		while($result_zone = FetchAssoc($userquery)){
			$mailid[] = $result_zone['email'];
		}
		
		//notify the Logistics
		$userlogisticsquery= Query("SELECT u.email FROM `user` u, `user_roles` ur WHERE u.id=ur.userID AND ur.roleID=".LOGISTICS);	
		while($result_logi = FetchAssoc($userlogisticsquery)){
			$mailid[] = $result_logi['email'];
		}
					
 		return $mailid;
                }
	 }
	 
	 function getcancelreq_notification($ord_zoneid,$rid){
	 	// get ZH
	 	$query_zoneemail=Query("SELECT u.email, u.first_name FROM `user` u, user_roles ur  WHERE u.status = 1 and u.zone_id = ". $ord_zoneid. " and ur.userID = u.id and ur.roleID = ".$rid);			 
		while($tomails = FetchAssoc($query_zoneemail)){
			$mailid []= $tomails['email'];
		}		
		// to group users
		$grpid = getGroupId(ORDER_CANCEL_REQUEST_GROUP);
		if($grpid) {
			$mails = getEmailGroup($grpid);
			foreach($mails as $groupuser){
				$mailid []= $groupuser['email'];					 
			}				 
		}	
	
		return $mailid;	 
	 }
         
         function checkTimeLeft($order_id, $type = 0, $counter = FALSE)
         { 
            $sql_users = Query("SELECT * FROM roles WHERE ID NOT IN ('2')");
             
            while($row_sql_users = FetchAssoc($sql_users))
            {
                $_users[] =  $row_sql_users['ID'];
            }
            if($type == 2) // Check whether BA
            {
                $_users[] = $_SESSION['rid'];
            }
            
            $access = $confirm = 'no';
            
            if(array_search($_SESSION['rid'], $_users))
            { 
                $access = "yes";
                $query = Query("SELECT TIMEDIFF('".date('Y-m-d H:i:s')."', created_date) AS time FROM `order` WHERE id = '".$order_id."'");
                $diff = FetchAssoc($query);
                $time = $diff['time'];
                
                if (strstr($time, ':'))
                {
                    # Split hours and minutes.
                    $separatedData = explode(':', $time); 

                    $minutesInHours    = $separatedData[0] * 60;
                    $minutesInDecimals = $separatedData[1];

                    $totalMinutes = $minutesInHours + $minutesInDecimals;                
                }
                else
                {
                    $totalMinutes = $time * 60;
                }

                $alertmsg = '';
                
                if($counter)
                {
                    $timer = 0;
                    if($totalMinutes <= TIME_LEFT)
                    {
                        $timer = TIME_LEFT - $totalMinutes;
                    }
                    
                    $timer = $timer * 60;
                    return $timer;
                    exit;
                }
                
                if($totalMinutes < TIME_LEFT) 
                {
                    $confirm = 'yes';
                    $result = array($access, $confirm);
                   //$alertmsg = 'This Order is in edit mode. Press OK to continue..';
                }
                else
                {                    
                    $result = array($access, $confirm);
                }
                
                return $result;
            }
        }
	 
    /* Add By Abilash ON FEB22 2022 */

	function getCustomerDetails($cid) {  	
	
		$q= Query("SELECT address as customer_address, name as customer_name FROM customer WHERE id='{$cid}'");	 
		
		if(Num($q)){
			$r = FetchAssoc($q);	
			//print_r($r); 	 
			return $r;
		}
	}

	function getProductCategory($cid) {  	
	
		$q	= Query("SELECT DISTINCT(po.order_id),pt.name from product_type pt JOIN product p 
			ON pt.id = p.product_type_id JOIN product_order po ON p.id = po.product_id 
			where po.order_id = '{$cid}'");	 
		
		if(Num($q)){
			$r = FetchAssoc($q);
			return $r['name'];
		}
	}
	
	function get_orderstatus($oid){
		$orderstatus= Query("SELECT current_status FROM `[x]order_status` where order_id={$oid}  order by id desc limit 1");
		if(Num($orderstatus)) {
		  	$r = FetchAssoc($orderstatus);	
   		  	return $r['current_status'];
		}
	}
	 
}

?>
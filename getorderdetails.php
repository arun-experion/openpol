<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: getorderdetails.php  Saturday, June 25, 2010, 11:00:00 PM $
 *		
 */
    include("includes/initialize.php");
	include(DIR_CLASSES .'order.php'); 
	$order=new Order();
	$output = '';
	$result['no_equipments_status']=0;
	$result['processing_status'] =0;
	$result['no_equipments']="";
	 $result['processing_stage']="";
	$order_no=$_GET['id'];
	$selectedpid = $_GET['selected'];
 	$orderquery = Query("SELECT name,address,id  FROM `[x]customer` WHERE order_no =".$order_no);	
 	$orderresult = Fetch($orderquery);
	if(Num($orderquery) !== 0)
	{
		$result['name'] = $orderresult['name'];
		$result['address'] = $orderresult['address'];
	
	$today = date('Y-m-d H:i:s');
	$getquery = Query("SELECT DATE_FORMAT(`created_date` , '%d-%m-%Y' ) AS created_date ,id FROM `[x]order` WHERE order_no =". $order_no." AND status = 1" );
	$getresult = Fetch($getquery);
	$order_auto_id = $getresult['id'];
	$order_status  = $order->getcurrentorderstatus($order_auto_id);
	if($order_status==8||$order_status==9||$order_status==10){
	
	if( Num($getquery) !== 0)
	{
    $result['order_date'] = $getresult['created_date'];
	}
	$output .= '<select name="eqpmnt_id" class="eqpmnt"  id="eqpmnt_id"  style="width:180px;"   value="">';
	$output .= "<option value='0'>---Select---</option>";
	if($order_auto_id){	
		$getproduclist =Query("SELECT p.name, p.id FROM product AS p, `product_order` AS o WHERE o.`product_id` = p.id AND                     p.product_type_id !=1 AND o.`order_id` =".$order_auto_id);
		
		if( Num($getproduclist) == 0)
		{
		$result['no_equipments'] = "No equipments available in this order";
		$result['no_equipments_status'] =1;
		}
    }else{
	$getproduclist =Query("SELECT name,id FROM product WHERE product_type_id !=1 ");
	    }
	$select = '';
 	while($productresults = FetchAssoc($getproduclist)) {
		$productoptions[$productresults["id"]] = $productresults["name"];
 		
		$output .= '<option value="'.$productresults["id"].'" ';
		if($selectedpid == $productresults["id"]) {
			$output .=  "selected='selected'";
		}
		
		$output .= '>'.$productresults["name"].'</option>';
	}
	$output .= '</select>';
	
	$result['eqpmnt_list'] = $output; 
	 $result['processing_stage'] = ""; 
   	}else{
   		
		$result['processing_status'] =1;
		if($order_status==11){
	    $result['processing_stage'] = "Order has been cancelled."; 
		}else{
		$result['processing_stage'] = "Order is in processing stage."; 
		}
	}
	}else{
	
	$getproduclist =Query("SELECT name,id FROM product WHERE product_type_id !=1 ");
	$output .= '<select name="eqpmnt_id" class="eqpmnt"  id="eqpmnt_id"  style="width:180px;"   value="">';
	$output .= "<option value='0'>---Select---</option>";
 	while($productresults = FetchAssoc($getproduclist)) {
		$productoptions[$productresults["id"]] = $productresults["name"];
 		$output .= '<option value="'.$productresults["id"].'" ';
		if($selectedpid == $productresults["id"]) {
			$output .=  "selected='selected'";
		}
			$output .= '>'.$productresults["name"].'</option>';
	}
	$output .= '</select>';
	
	$result['eqpmnt_list'] = $output; 
	$result['processing_stage'] = ""; 
	
	}
	echo json_encode($result);
	
  
?>
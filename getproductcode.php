<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: getproductcode.php  Saturday, June 19, 2010, 11:00:00 PM $
 *		
 */
    include("includes/initialize.php");
	$output = '';
	$product_id=$_GET['id'];
	$productquery = Query("SELECT code  FROM `[x]product` WHERE id =". $product_id);	
	$productresult = Fetch($productquery);
    $result['code'] = $productresult['code'];
	$today = date('Y-m-d H:i:s');
	$getquarterquery = Query("SELECT id FROM `quarter` WHERE DATE_FORMAT( from_date, '%Y-%m-%d' ) <= '$today' AND 
	DATE_FORMAT( to_date, '%Y-%m-%d' ) >= '$today'");
	$quarterresult = Fetch($getquarterquery);
    $quarterid = $quarterresult['id']; 
	if($quarterid){
		$productratequery = Query("SELECT rate FROM `[x]quarter_price` WHERE quarter_id=$quarterid 
		                            AND product_id=$product_id" );
		$ratereult = Fetch($productratequery);
		$product_rate = $ratereult['rate'];
		if ($product_rate){
			$result['rate'] = $product_rate ;
		}else{
			$result['rate'] = '' ;
	    }
	}
	
	$productcartonquery = Query("SELECT carton FROM `[x]product` WHERE id=$product_id");
	$cartonresult = Fetch($productcartonquery);
	$result['carton'] = $cartonresult['carton'];
	
	echo json_encode($result);
	
  
?>
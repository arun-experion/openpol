<?php 
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: price.php  Monday, June 9, 2010, 10:47:41 AM $
 *		
 */
    include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_CLASSES .	'quarter.php'); 
	$perm = array('access_admin');
	checkpermission($perm);
	
	$tpl = new template();
	$quarter = new Quarter();
	// error_reporting(0);
	$quarters[]='';
	 if(($_GET['action'] == 'edit')||($_GET['action'] == 'add')){
        	$tpl -> Load(TEMPLATE_PATH . "price.tpl");
	 }
	 else{
	 	 	$tpl -> Load(TEMPLATE_PATH . "view_ price.tpl");
	 }
	 
	if(isset($_GET['quarter_id'])) {
    	$quarter_id =$_GET['quarter_id'] ; 
	}
	if(isset($_GET['product_type_id'])) {
    	$product_type_id =$_GET['product_type_id'] ; 
	}
	else
	{
	    $product_type_id = 1;  
	}	
	$tpl -> AssignValue("ptype",$product_type_id); 
	if(isset($_GET['zone_id'])) {
    	$zone_id =$_GET['zone_id'] ; 
	}
	else
	{
	    $zone_id = 1; 
	}
	
	if(isset($_GET['success'])) {
	   $status =$_GET['success'] ;
		   if($status == '1') {
			  $message=PRICE_LIST_STATUS_SUCCESS;
			  $tpl -> Zone("list", "disabled");
		   }else{
		    $tpl -> Zone("list", "enabled");
		   
		   }
	  $tpl -> AssignValue("success",$message);  
	}else{
	
	 $tpl -> Zone("list", "enabled");
	}
	$tax_details=$quarter->getTaxForProductType($quarter_id,$product_type_id);
	$ed=$tax_details['ed'];
	$cst=$tax_details['cst'];	
	$tpl -> AssignValue("ed_percent",$ed);
	$tpl -> AssignValue("cst_percent",$cst);
	$result=$quarter->getQuarterFromId($quarter_id);
	$tpl->AssignValue("quarter_id", isset($result['id']) ? $result['id'] : null);
	$tpl -> AssignValue("quarter_name",$result['name']);
	$tpl -> AssignValue("from",$result['from_date']);
	$tpl -> AssignValue("to",$result['to_date']);
    $price_exists=$quarter->checkPriceExists($quarter_id,$product_type_id);

    if(($_GET['action'] == 'edit') ||($_GET['action']=='view'))
	{
		   $q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
			$tpl -> AssignValue("action",$_GET['action']);
			$tpl -> AssignValue("select_producttype", createSelect("product_type", $options,$product_type_id));
	
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				$count =  sizeof($_POST['product_id']);
				$empty_flag=1;
				for($j=0;$j<$count;$j++){
					if($_POST['rate'][$j] == '' || $_POST['hospital_price'][$j] == '' || $_POST['mrp'][$j] == ''){
					$empty_flag=0;
					}
			    }
				if($empty_flag){
				for($i=0;$i<$count;$i++){
					 
							  
					$product_id =$_POST['product_id'][$i];
					$product_exists =0;
					$product_exists=$quarter->checkProductPriceExists($product_id,$_GET['quarter_id']);
					if($product_exists){
					$data=array("rate"            => $_POST['rate'][$i],
								 "hospital_price" => $_POST['hospital_price'][$i],
								 "mrp"            => $_POST['mrp'][$i],
								 "created_by"     => $_SESSION['id'], 
								 "created_date"   => date('Y-m-d H:i:s')
								 ); 
				   Update("quarter_price", $data, "product_id=$product_id AND quarter_id=$quarter_id");
					}else{
					
					
					    $insert=array("quarter_id"     => $quarter_id,
									  "product_id"     => $_POST['product_id'][$i],
									  "rate"           => $_POST['rate'][$i],
									  "hospital_price" => $_POST['hospital_price'][$i],
									  "mrp"            => $_POST['mrp'][$i],
									  "zone_id"        => $zone_id,
									  "created_by"     => $_SESSION['id'], 
									  "created_date"   => date('Y-m-d H:i:s')
									 ); 
					  Insert("quarter_price", $insert);	
				  }
			   }
			   
			reload("price.php?quarter_id=$quarter_id&zone_id=$zone_id&action=edit&product_type_id=$product_type_id&success=1");	
		   }else{
		   
		   
		   $quarters[]='';
			  $message = 'Please fill  all required fields';
			  $tpl -> AssignValue("message",$message); 	   
			  $count =  sizeof($_POST['product_id']);
			  for($i=0;$i<$count;$i++){ 
			   $r['name'] = $_POST['name'][$i];
			   $r['slno'] = $_POST['slno'][$i];
			   $r['ed'] = $_POST['ed'][$i];
			   $r['cst'] = $_POST['cst'][$i];
			   $r['product_id'] = $_POST['product_id'][$i];
			   $r['code'] = $_POST['code'][$i];
			   $r['rate'] = $_POST['rate'][$i];
			   $r['hospital_price'] = $_POST['hospital_price'][$i];
			   $r['mrp']  =  $_POST['mrp'][$i];
			   if($i%2 ==0) {
						$r['class'] ="two";
					  }else {
						$r['class'] ="one";
					  }
			   $quarters[] = $r;
			  }
		   
		   }
		   	}else{
			
			if($price_exists){
			$query = Query("SELECT p.name, p.code, p.id AS product_id, q.mrp, q.rate, q.hospital_price
                  FROM product p LEFT JOIN quarter_price q ON p.id = q.product_id
                  AND q.quarter_id =$quarter_id AND q.zone_id =$zone_id WHERE p.product_type_id =$product_type_id");
		    $tpl -> Zone("showpricelist", "enabled");
	        $tpl -> Zone("showmessage", "disabled");
			}else{
			
				if($_GET['action']=='view'){
				
				$tpl -> Zone("showmessage", "enabled");
				$tpl -> Zone("showpricelist", "disabled");
				
				
				}else{
				
				reload("price.php?quarter_id=$quarter_id&zone_id=$zone_id&action=add&product_type_id=$product_type_id&success=0");
				}
				
			}
			$rate=array();
			$i=1;
			while($r = FetchAssoc($query)){
			$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] ="two";
				}else {
					$r['class'] ="one";
				}
			$ed_value = $quarter->calculateTax($r['rate'],$ed);
		    $r['ed']  = $ed_value;
			$r['cst'] = $quarter->calculateTax($ed_value,$cst);
			$quarters[] = $r;
			$i++;
			}
			if(Num($query)>0 && ($_GET['action']=='view')){
			$tpl -> Zone("export", "enabled");
			}else{
			$tpl -> Zone("export", "disabled");
			}
		
			}
			
	}else if($_GET['action'] == 'add'){
	
		   $q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
			$tpl -> AssignValue("action",$_GET['action']);
			$tpl -> AssignValue("select_producttype", createSelect("product_type", $options,$product_type_id));
			
		   if($_SERVER['REQUEST_METHOD'] == "POST") {		
				$count =  sizeof($_POST['product_id']);
				$empty_flag=1;
				for($j=0;$j<$count;$j++){
					if($_POST['rate'][$j] == '' || $_POST['hospital_price'][$j] == '' || $_POST['mrp'][$j] == ''){
					$empty_flag=0;
					}
			    }
			if($empty_flag){
					for($i=0;$i<$count;$i++){ 
					$product_id =$_POST['product_id'][$i];
					$product_exists=$quarter->checkProductPriceExists($product_id,$quarter_id);
					if($product_exists){
					$data=array("rate"            => $_POST['rate'][$i],
								 "hospital_price" => $_POST['hospital_price'][$i],
								 "mrp"            => $_POST['mrp'][$i],
								 "created_by"     => $_SESSION['id'], 
								 "created_date"   => date('Y-m-d H:i:s')
								 ); 
					
					
					Update("quarter_price", $data, "product_id=$product_id AND quarter_id=$quarter_id");
					}else{
					
					
					    $insert=array("quarter_id"     => $quarter_id,
									  "product_id"     => $_POST['product_id'][$i],
									  "rate"           => $_POST['rate'][$i],
									  "hospital_price" => $_POST['hospital_price'][$i],
									  "mrp"            => $_POST['mrp'][$i],
									  "zone_id"        => $zone_id,
									  "created_by"     => $_SESSION['id'], 
									  "created_date"   => date('Y-m-d H:i:s')
									 ); 
					
					     Insert("quarter_price", $insert);	
				  }
						 
						 
						 
						 
						 
			        }
			   reload("price.php?quarter_id=$quarter_id&$zone_id=$zone_id&action=edit&product_type_id=$product_type_id&success=1");
			  }else{
			  $quarters[]='';
			  $message = 'Please fill  all required fields';
			  $tpl -> AssignValue("message",$message); 	   
			  $count =  sizeof($_POST['product_id']);
			  for($i=0;$i<$count;$i++){ 
			   $r['name'] = $_POST['name'][$i];
			   $r['slno'] = $_POST['slno'][$i];
			   $r['ed'] = $_POST['ed'][$i];
			   $r['cst'] = $_POST['cst'][$i];
			   $r['product_id'] = $_POST['product_id'][$i];
			   $r['code'] = $_POST['code'][$i];
			   $r['rate'] = $_POST['rate'][$i];
			   $r['hospital_price'] = $_POST['hospital_price'][$i];
			   $r['mrp']  =  $_POST['mrp'][$i];
			   if($i%2 ==0) {
						$r['class'] ="two";
					  }else {
						$r['class'] ="one";
					  }
			   $quarters[] = $r;
			  }
				  
			  }
		  
		  
	 }else{
	 
	 	
			$previous_quarter = $quarter_id -1 ;
			$price_exists=$quarter->checkPriceExists($previous_quarter,$product_type_id);
			$price_exists_type=$quarter->checkPriceExists($quarter_id,$product_type_id);
				
			
			if($previous_quarter >0&$price_exists){
				 $query = Query("SELECT p.name, p.code, p.id AS product_id, q.mrp, q.rate, q.hospital_price
                               FROM product p LEFT JOIN quarter_price q ON p.id = q.product_id
                                AND q.quarter_id =$previous_quarter AND q.zone_id =$zone_id 
								WHERE p.product_type_id =$product_type_id");
			   				
				$message = PRICE_LIST_STATUS ;				
				$tpl -> AssignValue("message",$message); 				
			}else{
			
					if($price_exists_type){
					
						  reload("price.php?quarter_id=$quarter_id&$zone_id=$zone_id&action=edit&product_type_id=$product_type_id");
					
					}else{
					
						 $query = Query("SELECT id as product_id,name,code FROM product WHERE product_type_id=$product_type_id");	
					}
				
			}
			
 			$i=1;
				while($r = FetchAssoc($query)){
   					 $r['slno'] = $i;
					  if($i%2 ==0) {
						$r['class'] ="two";
					  }else {
						$r['class'] ="one";
					  }
			if($previous_quarter >0&$price_exists){		  
			$ed_value = $quarter->calculateTax($r['rate'],$ed);
		    $r['ed']  = $ed_value;
			$r['cst'] = $quarter->calculateTax($ed_value,$cst);
			}
			
			
				 $quarters[] = $r;
				 $i++;
				}
	 
	  
	 }
	 $tpl -> Zone("showpricelist", "enabled");
	 $tpl -> Zone("showmessage", "disabled");
	}
	if(isset($_SESSION['message'])) {
	$tpl -> AssignValue("message", $_SESSION['message']);	
	}
	if($product_type_id=='3')	
	{
	$tpl -> Zone("showtax", "disabled");
	}else{
	$tpl -> Zone("showtax", "enabled");
    } 
	$tpl -> AssignValue("ptype",$product_type_id);
    $tpl -> Loop("quarters", $quarters);
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/price.js"></script>
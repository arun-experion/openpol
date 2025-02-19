<?php  

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: login.php  Monday, July 7, 2010, 10:00:00 AM $
 *		
 */

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	
	$perm = array('access_admin');
	checkpermission($perm);
	
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "product.tpl");
	 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		 $required = array ("product_name" => '<LI>'.EMPTY_PRODUCT_NAME.'</LI>',
							"product_code" => '<li>'.EMPTY_PRODUCT_CODE.'</li>'		
						 );
					 	
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
 		if(isset($_POST['action']) && $_POST['action'] == 'add') {	
			if(dupData("product", "code", $_POST['product_code'])) {
					$error['error.duplicateproduct'] = '<li>'.DUPICATE_PRODUCT.'</li>';
			}
		}else{  
 			if(isset($_POST['product_code']) && dupData("product", "code", $_POST['product_code'], "AND id<>{$_GET['pid']}")) {
					$error['error.duplicateproduct'] = '<li>'.DUPICATE_PRODUCT.'</li>';
			}
		}		 
	
		  if(isset($_POST['product_type']) && $_POST['product_type'] ==1){
		  
			 if($_POST['weight'] == ""){
				 $error['error.weight'] = '<li>'.EMPTY_WEIGHT.'</li>';
			 }
			 if($_POST['carton'] ==""){ 
					$error['error.carton'] = '<li>'.EMPTY_CARTON.'</li>';
			 }
			
		 
		}	
	    if(isset($_POST['weight']) && ($_POST['weight'] != "") && (!is_numeric($_POST['weight']))){
			 	$error['error.weight'] =  '<li>'.NUMERIC_WEIGHT.'</li>';
			 }	
		if(isset($_POST['carton']) && ($_POST['carton'] !="") && (!is_numeric($_POST['carton']))) {
				$error['error.carton'] = '<li>'.NUMERIC_CARTON.'</li>';
		 }					  
		
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else {			
 
				if($_POST['product_type'] == 1) {
					$category = $_POST['product_cat'];
				}else{
					$category = 0;
				}
				 if($_POST['action'] == 'add') {						  
					Insert("product", array("product_type_id" => $_POST['product_type'], 
											"product_category_id" => $category,
											"name" => $_POST['product_name'], 
											"code" => $_POST['product_code'], 
											"weight" => $_POST['weight'], 
											"carton" => $_POST['carton'], 
											"status" => 1, 
											"created_by" => $_SESSION['id'], 
											"created_date" => date('Y-m-d H:i:s')
										));
					 messages(PRODUCT_ADDED);
					 reload('product.php');
				 
				 } else {
					 Update("product", array("product_type_id" => $_POST['product_type'], 
					 						 "product_category_id" => $category,
											 "name" => $_POST['product_name'], 
											 "code" => $_POST['product_code'],
											 "weight" => $_POST['weight'],
											 "carton" => $_POST['carton'],
											 "status" => $_POST['status']), "id=".$_GET['pid']);
					  messages(PRODUCT_UPDATED);
					  reload("product.php");
				 }
			 }
			 
	 }
	 
	 if(isset($_GET['action'])) {
	 	$tpl -> Zone("product_entry", "enabled");
		$tpl -> Zone("listproduct", "disabled");
 		if(isset($_GET['pid'])) {		
			$product = FetchAssoc(Query("SELECT * FROM product where id=" . $_GET['pid']));		
			$tpl -> AssignArray($product);
			$tpl -> AssignValue("product_name", $product['name']);
			$tpl -> AssignValue("product_code", $product['code']);
 				 
			//Get Product type
			$q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
			$tpl -> AssignValue("select_producttype", createSelect("product_type", $options, $product['product_type_id']));
			
			//Get Category
			$q_cat = Query("SELECT * FROM product_category");		
			while($r_cat = FetchAssoc($q_cat)) {
				$options_cat[$r_cat["id"]] = $r_cat["name"];
			}
			$tpl -> AssignValue("select_cattype", createSelect("product_cat", $options_cat, $product['product_category_id']));	
			
			$tpl -> Zone("status", "enabled");	
			$statusoption[0]	='Inactive';	
			$statusoption[1]	='Active';				 
			$tpl -> AssignValue("select_status", createSelect("status", $statusoption, $product['status']));	
			
		} else{
		 
			//Get Product type
			$q_ptype = Query("SELECT * FROM product_type");		
			while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
			if(isset($_POST['product_type'])) {
				$tpl -> AssignValue("select_producttype", createSelect("product_type", $options, $_POST['product_type']));
			}else{
				$tpl -> AssignValue("select_producttype", createSelect("product_type", $options, '', "class='select_ptype'"));
			}
			
			//Get Category
			$q_cat = Query("SELECT * FROM product_category");		
			while($r_cat = FetchAssoc($q_cat)) {
				$options_cat[$r_cat["id"]] = $r_cat["name"];
			}
			$tpl -> AssignValue("select_cattype", createSelect("product_cat", $options_cat));	
		
		}
		$tpl -> AssignValue("action", $_GET['action']);		
	 }else{
	 	if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
		}

	 	$q_ptype = Query("SELECT * FROM product_type");		
		$options[0] = '--- Select ---';
		while($r_ptype = FetchAssoc($q_ptype)) {
			$options[$r_ptype["id"]] = $r_ptype["name"];
		}
		if(isset($_POST['ptype'])) {		
			$tpl -> AssignValue("select_producttype", createSelect("ptype", $options, $_POST['ptype']));
		}else{
			$tpl -> AssignValue("select_producttype", createSelect("ptype", $options, '',  "class='select_ptype'"));
		}
		$where ='';
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			
			if($_POST['pname'] !='' && $_POST['ptype'] ==0) {
				$where .= " where name like '".$_POST['pname']."%'";
			}
			if($_POST['ptype'] !=0 && $_POST['pname'] == '') {
				$where .= " where product_type_id = ".$_POST['ptype'];
			}
			if($_POST['pname'] !='' && $_POST['ptype'] !=0) {
				$where .= " where name like '".$_POST['pname']."%' and product_type_id = ".$_POST['ptype'];
			}
			$tpl -> AssignValue("pname", $_POST['pname']);		
		}
	 	if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
	 	  $q_products = "SELECT * FROM product". $where;
		$q = new splitResults($q_products);		
		if(Num($q->out)) {
			while($r_product = FetchAssoc($q->out)) {
				if($i%2 ==0) {
					$r_product['class'] = "two";
				}else {
					$r_product['class'] = "one";
				}			
				$r_product['prtype'] = getProductType($r_product['product_type_id']);
				$r_product['pcat'] = getProductCategory($r_product['product_category_id']);
				if($r_product['status']==1) {
					$r_product['status'] = 'Active';
				} else {
					$r_product['status'] = 'Inactive';
				}
				$products[] = $r_product;
				$i++;
			}
			$tpl -> Loop("products", $products);
			
			$tpl -> Zone("product_entry", "disabled");
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());
			$tpl -> Zone("productsvail", "enabled");
			
		} else {
				$tpl -> Zone("noproducts", "enabled");
				$tpl -> AssignValue("total", 0);	
		}
		
		
	 }
 
	$tpl -> Zone("listproduct", "enabled");
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/product.js"></script>
<?php  
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: quarter.php  Monday, June 7, 2010, 12:47:41 AM $
 *		
 */
	include("includes/initialize.php");
	include("includes/functions/formvalidation.php");
	include(DIR_CLASSES .	'quarter.php'); 
	$perm = array('access_admin');
	checkpermission($perm);
	
	$tpl     = new template();
	$quarter = new Quarter();
	$tpl -> Load(TEMPLATE_PATH . "quarter.tpl");
    if(isset($_GET['qid'])) {
							$qid= $_GET['qid'];
							$tpl -> AssignValue("quarter","Edit Quarter");
							$result=$quarter->getQuarterFromId($qid);
							$tpl -> AssignValue("quarter_id",$result['id']);
							$tpl -> AssignValue("quarter_name",$result['name']);
							$tpl -> AssignValue("from",$result['from_date']);
							$tpl -> AssignValue("to",$result['to_date']);
							
							$tax=$quarter->getQuarterTaxFromId($qid);
							$tpl -> AssignValue("ed_tax_equipment",$tax['ed_tax_equipment']);
							$tpl -> AssignValue("cst_tax_equipment",$tax['cst_tax_equipment']);
							$tpl -> AssignValue("ed_tax_blood_bag",$tax['ed_tax_blood_bag']);
							$tpl -> AssignValue("cst_tax_blood_bag",$tax['cst_tax_blood_bag']);
						
	}else{
	
	$tpl -> AssignValue("quarter","Add Quarter");
	}
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		 $required = array (    "quarter_name"      => '<li>'.EMPTY_QUARTER_NAME.'</li>',
								"start-date"        => '<li>'.EMPTY_START_DATE.'</li>',
								"end-date"          => '<li>'.EMPTY_END_DATE.'</li>',
								"ed_tax_equipment"  => '<li>'.EMPTY_ED_EQP_TAX.'</li>' ,
								"cst_tax_equipment" => '<li>'.EMPTY_CST_EQP_TAX.'</li>',
								"ed_tax_blood_bag"  => '<li>'.EMPTY_ED_B_TAX.'</li>',
								"cst_tax_blood_bag" => '<li>'.EMPTY_CST_B_TAX.'</li>'
							  );
	    //  while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
				                       $error['error.' . $key ] = $val ;
			    }
		 	}
		 
		 if($quarter->numericCheck($_POST['ed_tax_equipment']) && $_POST['ed_tax_equipment'] != '' ){
			$error['error.ed_tax_equipment'] = '<li>'.NOT_NUMERIC.'</li>';
		}
		if($quarter->numericCheck($_POST['ed_tax_blood_bag']) && $_POST['ed_tax_blood_bag'] != '' ){
			$error['error.ed_tax_blood_bag'] = '<li>'.NOT_NUMERIC.'</li>';
		}
		if($quarter->numericCheck($_POST['cst_tax_equipment']) && $_POST['cst_tax_equipment'] != '' ){
			$error['error.cst_tax_equipment'] = '<li>'.NOT_NUMERIC.'</li>';
		}
		if($quarter->numericCheck($_POST['cst_tax_blood_bag']) && $_POST['cst_tax_blood_bag'] != '' ){
			$error['error.cst_tax_blood_bag'] = '<li>'.NOT_NUMERIC.'</li>';
		}
		
		
		$from_date = date('Y-m-d H:i:s', strtotime($_POST['start-date']));
		$to_date   = date('Y-m-d H:i:s', strtotime($_POST['end-date']));	
		if(isset($_GET['qid'])) {
			$id=$_GET['qid'];
			$condition="AND id NOT IN ($id)";
			if(dupData("quarter", "name", $_POST['quarter_name'],$condition)){
				$error['error.quarter_name'] = '<li>'.DUPICATE_QUARTER_NAME.'</li>';
			}
			if($quarter->dupDataCheckExists($from_date,$id)){
				$error['error.start-date'] = '<li>'.DUPICATE_QUATER_START_DATE.'</li>';
			}
			if($quarter->dupDataCheckExists($to_date,$id)){
				$error['error.end-date'] = '<li>'.DUPICATE_QUATER_END_DATE.'</li>';
			}
			
			
			
		
		}else{
		
			if(dupData("quarter", "name", $_POST['quarter_name'])){
				$error['error.quarter_name'] = '<li>'.DUPICATE_QUARTER_NAME.'</li>';
			}
			if($quarter->dupDataCheck($from_date)){
				$error['error.start-date'] = '<li>'.DUPICATE_QUATER_START_DATE.'</li>';
			}
			if($quarter->dupDataCheck($to_date)){
				$error['error.end-date'] = '<li>'.DUPICATE_QUATER_END_DATE.'</li>';
			}
		
	   }
	   if(isset($error)) {
	                    $tpl -> Zone("error", "enabled");
			            $tpl -> AssignArray($error);
						if(isset($_GET['quarter_id'])){
						$tpl -> AssignValue("quarter_id",$_POST['quarter_id']); 
						}
						$tpl -> AssignValue("quarter_name",$_POST['quarter_name']);
						$tpl -> AssignValue("from",$_POST['start-date']);
						$tpl -> AssignValue("to",$_POST['end-date']);		  
						$tpl -> AssignValue("ed_tax_equipment",$_POST['ed_tax_equipment']);
						$tpl -> AssignValue("cst_tax_equipment",$_POST['cst_tax_equipment']);
						$tpl -> AssignValue("ed_tax_blood_bag",$_POST['ed_tax_blood_bag']);
						$tpl -> AssignValue("cst_tax_blood_bag",$_POST['cst_tax_blood_bag']);
						  
						  
		}else {
		      $tpl -> Zone("error", "disabled");
			  $data = array("name"	                => 	$_POST['quarter_name'],
							"from_date"	            => 	$from_date,
							"to_date"	            => 	$to_date,
												
							 );
							
				 if($_GET['qid']) {
									$qid= $_GET['qid'];
								
									Update("quarter", $data, "id=$qid");
									$data1=array(  
												 "quarter_id"             =>  $qid,
												 "ed_tax_equipment"       =>  $_POST['ed_tax_equipment'],
												 "cst_tax_equipment"      =>  $_POST['cst_tax_equipment'],
												 "ed_tax_blood_bag"       =>  $_POST['ed_tax_blood_bag'],
												 "cst_tax_blood_bag"      =>  $_POST['cst_tax_blood_bag'],
												 "created_by"             =>  $_SESSION['id'], 
											     "created_date"           => date('Y-m-d H:i:s')
											   ); 
									Update("quarter_tax",$data1,"quarter_id=$qid");
									//reload("price.php?quarter_id=$qid&action=edit");	
									messages(QUARTER_UPDATED);
									reload("list_quarters.php");
				 }else{
						 Insert("quarter", $data);
						 $quarter_id = mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
						 $data1=array(  
									 "quarter_id"            =>  $quarter_id,
									 "ed_tax_equipment"      =>  $_POST['ed_tax_equipment'],
									 "cst_tax_equipment"     =>  $_POST['cst_tax_equipment'],
									 "ed_tax_blood_bag"      =>  $_POST['ed_tax_blood_bag'],
									 "cst_tax_blood_bag"     =>  $_POST['cst_tax_blood_bag'],
									 "created_by"            =>  $_SESSION['id'], 
									 "created_date"          => date('Y-m-d H:i:s')
								   );
						 Insert("quarter_tax", $data1);
						 $quarter_id = mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
						 messages(QUARTER_ADDED);
						 reload("price.php?quarter_id=$quarter_id&action=add");	  
			     }
			
		} 
	}

    $tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<!-- page specific scripts -->
<script type="text/javascript" charset="utf-8" src="js/quarter.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>

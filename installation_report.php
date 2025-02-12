<?php 
 /**
 * TPL :: Order Management Software
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: installation_report.php  Wednesday, June 23, 2010, 10:00:00 AM $
 */
    include("includes/initialize.php");
    include(DIR_FUNCTIONS . "formvalidation.php");
	$perm = array('add_order');
	checkpermission($perm);
    $tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "installation_report.tpl");
	$checked ="checked=checked";
    if($_SERVER['REQUEST_METHOD'] == "POST") {
	
       $required = array ( "order_no"         => '<li>'.EMPTY_ORDER_NO.'</li>'	,
                            "start_date"      => '<li>'.EMPTY_START_DATE.'</li>'	,
	                         "end_date"       =>  '<li>'.EMPTY_END_DATE.'</li>'	,
							 "name"           =>  '<li>'.EMPTY_CUST_NAME.'</li>',    
							 "address"        =>  '<li>'.EMPTY_CUST_ADDRESS.'</li>',                             
							 "tel_no"         =>  '<li>'.EMPTY_TELE_NO.'</li>',
							 "contact_person" =>  '<li>'.EMPTY_CONTACT_PERSON.'</li>'                      
							 );
 		 if($_POST['email'] !="" && !email($_POST['email'])) {
			$error['error.notvalidemail'] = '<li>'.EMAIL_NOTVALID.'</li>';
		 }
		 		 
    //    while (list($key, $val) = each($required)) {
		foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.'.$key] = $val ;
				}
	  }

	 if($_POST['eqpmnt_id']==0){
     	$error['error.equipment_name'] ='<li>'.EMPTY_EQUIPMENT_NAME.'</li>'	;
     }
	 if($_POST['start_date']!=""&& $_POST['end_date']!=""){
	 $st_date_arry =explode("-",$_POST['start_date'] );
	 $starttime = mktime($_POST['start_hr'],$_POST['start_mint'],$_POST['start_sec'],$st_date_arry[1],$st_date_arry[0],$st_date_arry[2]);
	 $end_date_arry =explode("-",$_POST['end_date'] );	
	 $endtime = mktime($_POST['end_hr'],$_POST['end_mint'],$_POST['end_sec'],$end_date_arry[1],$end_date_arry[0],$end_date_arry[2]);
	 
	 if($starttime>$endtime){
		$error['error.date_range'] ='<li>'.INVALID_START_TIME.'</li>'	;
     } 
	  
	 }
	if(isset($error)) {
			$tpl -> Zone("error", "enabled");
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			for($i=1;$i<=4;$i++){ 
					   if(isset($_POST['trained_on_'.$i])){
							if(strlen($_POST['trained_on_'.$i])>0){
								$tpl -> AssignValue("checked".$i,$checked);
							}
					   }
			}
		   if(isset($_POST['service_remark'])){
		   		$tpl -> AssignValue("satisfaction".$_POST['service_remark'],$checked);
		   }
		   if(isset($_POST['properly_installed'])){
		   		$tpl -> AssignValue("remark".$_POST['properly_installed'],$checked);
		   }
		   if(isset($_POST['trained_to'])){
				$tpl -> AssignValue("trainee".$_POST['trained_to'],$checked);
		   }		
 	}else {                                      
           $tpl -> Zone("error", "disabled");
	       $order_date    = date('Y-m-d H:i:s', strtotime($_POST['order_date']));
	       $invoice_date  = date('Y-m-d H:i:s', strtotime($_POST['invoice_date']));
           $start_date = date('Y-m-d',strtotime($_POST['start_date']))." ".$_POST['start_hr'].":".$_POST['start_mint'].":".$_POST['start_sec'];
			  
		  $end_date = date('Y-m-d',strtotime($_POST['end_date']))." ".$_POST['end_hr'].":".$_POST['end_mint'].":".$_POST['end_sec'];
		  
		   $warranty_date = date('Y-m-d H:i:s', strtotime($_POST['warranty_date']));
		   $trained   = '';
		   for($i=1;$i<=4;$i++){ 
			   if(isset($_POST['trained_on_'.$i])){
				$trained   .= $_POST['trained_on_'.$i].",";
			   }
		   }
		   $trained=substr_replace($trained,"",-1);
           $order_no     =  $_POST['order_no']; 
		   $insert_data=array("order_no"              =>  $_POST['order_no'], 
							  "invoice_no"            =>  $_POST['invoice_no'],
							  "order_date"            =>  $order_date,
							  "invoice_date"          =>  $invoice_date,
							  "start_date"            =>  $start_date,
							  "end_date"              =>  $end_date,
							  "warranty_no"           =>  $_POST['warranty_no'],	
							  "warranty_date"         =>  $warranty_date,
							  "product_id"			  =>  $_POST['eqpmnt_id'],	
							  "serial_no"             =>  $_POST['serial_no'],
							  "model_no"              =>  $_POST['model_no'],
							  "summary"               =>  $_POST['summary'],
							  "trained_on"            =>  $trained,
							  "trained_to"            =>  $_POST['trained_to'],
							  "trained_name"          =>  $_POST['trained_name'],
							  "service_remark"        =>  $_POST['service_remark'],
							  "properly_installed"    =>  $_POST['properly_installed'],
							  "suggestion"            =>  $_POST['suggestion'],
							  "created_by"            =>  $_SESSION['id'], 
							  "created_date"          =>  date('Y-m-d H:i:s')
							 );
										
	     Insert("product_installation", $insert_data);
		 
		
		$update_customer=array("name"                 =>    $_POST['name'],
								"address"             =>    $_POST['address'],
								"contact_person"      =>    $_POST['contact_person'],
								"email"               =>    $_POST['email'],
								"tel_no"              =>    $_POST['tel_no'],
								"fax"                 =>    $_POST['fax'],
								"order_no"            =>    $_POST['order_no'], 
								); 
		
		$orderquery = Query("SELECT id FROM `[x]customer` WHERE order_no =".$order_no);	
	    $orderresult = Fetch($orderquery);
		$id= $orderresult['id'];
		if($id)
		{
			Update("customer",$update_customer,"order_no=$order_no");
	    }else{
	    	Insert("customer",$update_customer);
		}
	    messages(INSTALLATION_REPORT_ADDED);
	   reload('list_installation_report.php');
}
 }else{
  
    $tpl -> AssignValue("satisfaction1",$checked);
	$tpl -> AssignValue("remark1",$checked);
	$tpl -> AssignValue("trainee1",$checked);
 }
 
     for($i=0;$i<=59;$i++){
		if($i<10){                // If the value is under 10 then 2 zeros are needed to make a 3 digit value.
			 $value["0".$i] = "0".$i;
		}else{
			$value[$i]= $i;
		}
     }
	 
	for($i=0;$i<=23;$i++){
		if($i<10){                // If the value is under 10 then 2 zeros are needed to make a 3 digit value.
			 $hr["0".$i] = "0".$i;
		}else{
			$hr[$i] = $i;
		}
	}
	$sel_st_hr ='';
	$sel_st_min = '';
	$sel_st_sec = '';
	$sel_end_hr ='';
	$sel_end_min='';
	$sel_end_sec='';
	if(isset($_POST['start_hr'])) {
		$sel_st_hr = $_POST['start_hr'];
	} 
	if(isset($_POST['start_mint'])) {
		$sel_st_min = $_POST['start_mint'];
	}
	if(isset($_POST['start_sec'])) {
		$sel_st_sec = $_POST['start_sec'];
	}
	if(isset($_POST['end_hr'])) {
		$sel_end_hr = $_POST['end_hr'];
	} 
	if(isset($_POST['end_mint'])) {
		$sel_end_min = $_POST['end_mint'];
	}
	if(isset($_POST['end_sec'])) {
		$sel_end_sec = $_POST['end_sec'];
	}
	
	
	$tpl -> AssignValue("start_hour",createSelect("start_hr", $hr, $sel_st_hr));
	$tpl -> AssignValue("start_minute",createSelect("start_mint",$value, $sel_st_min));
	$tpl -> AssignValue("start_secs", createSelect("start_sec", $value,$sel_st_sec));
	$tpl -> AssignValue("end_hour", createSelect("end_hr", $hr,$sel_end_hr));
	$tpl -> AssignValue("end_minute",createSelect("end_mint",$value, $sel_end_min));
	$tpl -> AssignValue("end_secs",createSelect("end_sec", $value,$sel_end_sec));
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/installation_report.js"></script>





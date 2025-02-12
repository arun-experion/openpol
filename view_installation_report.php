<?php

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas
 * @version			$Id: view_installation_report.php  wednessday, June 25, 2010, 3:00:41 PM $
 *		
 */
 

	include("includes/initialize.php");
	$perm = array('add_order');
	checkpermission($perm);
 	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "view_installation_report.tpl");
    $install_id=$_GET['id'];
		   
			   
  $q= Query("SELECT i.order_no,i.invoice_no,DATE_FORMAT(i.order_date, ".SHORT_DATE." ) as order_date ,
	           DATE_FORMAT(i.invoice_date, ".SHORT_DATE." ) as invoice_date,
               DATE_FORMAT(i.start_date, '%Y-%m-%d %H:%i:%s' ) as start_date ,
			   DATE_FORMAT(i.end_date, '%Y-%m-%d %H:%i:%s') as end_date,
               i.serial_no,i.model_no,i.warranty_no,
               DATE_FORMAT(i.warranty_date, ".SHORT_DATE.") as warranty_date,
               i.summary,i.trained_on,i.trained_to,i.trained_name,i.properly_installed,i.service_remark,i.suggestion,
			   p.name as eqpmnt_name
			   FROM product_installation as i ,product as p
			   WHERE i.id=$install_id AND i.product_id=p.id ");			   
 if(Num($q)){
    	$getdata = FetchAssoc($q);	
			 
		if($getdata['properly_installed'] == 1) {
			$getdata['properly_installed'] = 'Yes';
		}else{
			$getdata['properly_installed'] = 'No';
		}
		
		if($getdata['service_remark'] == 1) {
			$getdata['service_remark'] = 'Satisfactory';
		}else{
			$getdata['service_remark'] = 'Not Satisfactory';
		}
		if($getdata['trained_to'] == 1) {
			$getdata['trained_to'] = 'Doctor';
		}else{
			$getdata['trained_to'] = 'Bio Medical Dept/Technician';
		}
		
	    $order_no=$getdata['order_no'];
        $orderquery = Query("SELECT * FROM `[x]customer` WHERE order_no=".$order_no);	
	    $orderresult = Fetch($orderquery);
		$id= $orderresult['id'];
		if($id)
		{
		$getdata['name'] =$orderresult['name'] ;
		$getdata['address']=$orderresult['address'];
		$getdata['email'] =$orderresult['email'] ;
		$getdata['fax'] =  $orderresult['fax'] ;
		$getdata['tel_no'] =$orderresult['tel_no'] ;
		$getdata['contact_person'] =$orderresult['contact_person'] ;
		
		
		
		}
}
    $tpl -> AssignArray($getdata); 
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));

?>

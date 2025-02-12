<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya H
 * @version			$Id: contact.php  Friday, July 02, 2010, 02:55:00 PM $
 *		
 */

	include("includes/initialize.php");
    include(DIR_FUNCTIONS . "formvalidation.php");
	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "request_replacement.tpl");
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		Insert("complaint_status", array("complaint_id" => $_POST['cmpid'], 
											"current_status" => 17,
											"comment" => 'click <a href="request_replacement.php?id='.$_POST["cmpid"].'">here</a> to view the replacement request', 
											"updated_by" => $_SESSION['id'], 
											"updated_date" => date('Y-m-d H:i:s')
										));
	}
	$tpl -> AssignValue("id", $_GET['id']);
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>

<?php

	session_start();

	//INCLUDE CONFIG FILE ///////////////////////////////////////
	include("includes/config.inc.php");

	//INCLUDE DATABASE FUNCTIONS ////////////////////////////////
	require(DIR_FUNCTIONS . "database.php");
		 
	//INCLUDE TEMPLATE CLASS ////////////////////////////////////
	 require(DIR_CLASSES . "template.php");
 	 

	//INCLUDE GENERAL FUNCTIONS /////////////////////////////////////
	require(DIR_FUNCTIONS . "general.php");
	
	//INCLUDE AND INTIALIZE access control list //
	include(DIR_CLASSES .	'acl.php'); 
	
	//INCLUDE AND INTIALIZE WORKFLOW //
	include(DIR_CLASSES . 'workflow.php'); 	
	
	//INCLUDE LANGUAGE FILE /////////////////////////////////////
	include(DIR_LANGUAGES . LANGUAGE . "/".LANGUAGE.".php");
	 
	//TRIM POST VARIABLES ///////////////////////////////////////
	if (isset($_POST)) {
		foreach($_POST as $var => $val) {
			if (!is_array($val)) {
				$_POST[$var] = trim($val);
			}
		}
	}
 	
	
	//INCLUDE AND INTIALIZE NAVIGATION //
	 include(DIR_CLASSES .	'navigation.php'); 
	
	//INCLUDE LOAD FRAME ////////////////////////////////////////////////
	require(DIR_FUNCTIONS . "frame.php");
	
	// PAGE SELECT ARRAY	
	  $selected_array = array(
							"dashboard" => array("dashboard"),
							"orders" => array("order", "vieworder", "list_orders", "edit_order", "confirm_order"),
							"export" => array("list_erp_orders"),
							"complaints" => array("complaints","add_complaint"), 
							"installation" => array("list_installation_report", "view_installation_report", "installation_report"),
							"brochures" => array("brochure"),
							"reports" => array("reports"),
							"setup" => array("setup","zone", "area","list_permissions", "permission", "list_roles", "role" ,"manage_permissions","list_users","user","product","list_quarters","quarter","group","price")
	 					 );
	  
	  $_SESSION['topmenus']=$selected_array;
	  
	 // enable reminder mail to status
	 $status_mail = array(1,2,3,4,5,6,7,8);
	 
	 ini_set('open_basedir', Null);	
	 ini_set("session.save_path", "/webspace/hc8resadmin/terumopenpolcom/terumopenpol.com/www/tmp");
 		  
?>
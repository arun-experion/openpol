<?php  

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c). All rights reserved.
 * @author			Vidhya haridas
 * @version			$Id: add_role.php  Thurstday, June 3, 2010, 12:410:41 PM $
 *		
 */
 
	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "role.tpl");
	$myACL = new ACL();
							
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		$required = array ("role_name" => '<li>'.EMPTY_ROLENAME.'</li>');
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
			
		if(dupData("roles", "roleName", $_POST['role_name'])) {
 			  $error['error.duplicaterole'] = '<li>'.DUPICATE_ROLE.'</li>';
		 }		 
		 
		if(isset($error)) {
			 
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
 		} else {
		
		  $data = array(	"roleName"	  => 	$_POST['role_name']);
		  	  	
		  if($_GET['rid']) {
				$rid= $_GET['rid'];
				$tpl -> AssignValue("role_id",$rid);				
				$tpl -> AssignValue("rolename",  $myACL->getRoleNameFromID($rid));
				Update("roles", $data, "ID=$rid");
				messages(UPDATED_ROLES);
				reload("list_roles.php");			
			} else {			
				  Insert("roles", $data);
				  messages(ADDED_ROLES);
				  reload("list_roles.php");	  
			 }
			
		} 
	}
	else{
	
	if(isset($_GET['rid'])) {
						$tpl -> AssignValue("role_id", $_GET['rid']);				
						$tpl -> AssignValue("role_name",  $myACL->getRoleNameFromID($_GET['rid']));
			         }
	
	
	}
    $tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>


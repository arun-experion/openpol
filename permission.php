<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: price.php  Monday, June 6, 2007, 10:47:41 PM $
 *		
 */
 
	include("includes/initialize.php");
	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "permission.tpl");
	$myACL = new ACL();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		 {
			if($_POST['permission_name']=='')
			{
					$tpl -> AssignValue("error", "<li>".EMPTY_PERMISSIONS."</li>");
					$tpl -> Zone("permissionerror", "enabled");
				
			}
			else
			{  
			  $data = array(	
								   "permName"	  => 	$_POST['permission_name'],
								   "permKey"	  => 	formatKeywords($_POST['permission_name'])
							 );
							 
				  if(isset($_GET['pid']))
				   {
					 $pid=$_GET['pid'];
					 Update("permissions", $data, "ID=$pid");
					 messages(UPDATED_PERMISSIONS);
					 reload("list_permissions.php");
				   }
				 else
				  {
					$tpl -> Zone("permissionerror", "disabled");
					Insert("permissions", $data);
					messages(ADDED_PERMISSIONS);
					reload("list_permissions.php");
				  }
			 
		   }
	
		 } 
		else
		 {
		 	if(isset($_GET['pid'])) {
 				$tpl -> AssignValue("permission_id", $_GET['pid']);	
				$tpl -> AssignValue("permission_name",$myACL->getPermNameFromID($_GET['pid']));			
				$tpl -> AssignValue("permission_key",$myACL->getPermKeyFromID($_GET['pid']));
			}
				 
		 }
	 
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>


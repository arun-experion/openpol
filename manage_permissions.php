<?php  

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	$perm = array('access_admin');
	checkpermission($perm);
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$strSQL = sprintf("REPLACE INTO `roles` SET `ID` = %u, `roleName` = '%s'",$_POST['roleID'],$_POST['roleName']);
		Query($strSQL);
		$roleID = $_POST['roleID'];
		
		foreach ($_POST as $k => $v)
		{
			if (substr($k,0,5) == "perm_")
			{
				$permID = str_replace("perm_","",$k);
				if ($v == 'X')
				{
					$strSQL = sprintf("DELETE FROM `role_perms` WHERE `roleID` = %u AND `permID` = %u",$roleID,$permID);
					Query($strSQL);
					continue;
				}
				$strSQL = sprintf("REPLACE INTO `role_perms` SET `roleID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$roleID,$permID,$v,date ("Y-m-d H:i:s"));
				Query($strSQL);
			}
		}
		messages(PERMISSIONS_ASSIGNED);
		reload("list_roles.php");
	}
	$myACL = new ACL();
	
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "manage_permissions.tpl");
	$tpl -> AssignValue("rid", $_GET['rid']);	
	include(DIR_FUNCTIONS . "func_manageperm.php");		 
	$tpl -> AssignValue("perms", perms());	
 
	$tpl -> AssignValue("rolename", $myACL->getRoleNameFromID($_GET['rid']));
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
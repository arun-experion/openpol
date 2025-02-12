<?php  

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	
	$perm = array('access_admin');
	checkpermission($perm);
	$myACL = new ACL();
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "user_permission.tpl");
	
	if(isset($_POST['userID']))
	{
   
			foreach ($_POST as $k => $v)
			{
				if (substr($k,0,5) == "perm_")
				{  
					$permID = str_replace("perm_","",$k);
					if ($v == 'x')
					{
						$strSQL = sprintf("DELETE FROM `user_perms` WHERE `userID` = %u AND `permID` = %u",$_POST['userID'],$permID);
					} else {
						$strSQL = sprintf("REPLACE INTO `user_perms` SET `userID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$_POST['userID'],$permID,$v,date ("Y-m-d H:i:s"));
					}
				
					Query($strSQL);
				}
			}
			reload("list_users.php?uid=". $_POST['userID']);
	}		
 	
	 
  		$tpl -> Zone("showuserlist", "disabled");
		$tpl -> Zone("listrole", "enabled");
		include(DIR_FUNCTIONS . "func_user.php");
		 
		$tpl -> AssignValue("roles", roles());	
		$tpl -> AssignValue("id", $_GET['uid']);			
				
		$tpl -> AssignValue("rolename",  $myACL->getUsername($_GET['uid']));
	 
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
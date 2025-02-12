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
	include(DIR_FUNCTIONS . "formvalidation.php");
	require(DIR_CLASSES . "splitresults.php");


 	$perm = array('access_admin');
	checkpermission($perm);
	
	$tpl     = new template();
 	$tpl -> Load(TEMPLATE_PATH . "group.tpl"); 
	
	if(isset($_GET['delete'])) {
  		Query("DELETE FROM email_group WHERE id={$_GET['delete']}");
		messages('Group deleted successfully');
		reload("group.php");
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		 if($_POST['action'] == 'Add') {	
			Insert("email_group", array("name" => $_POST['name'], 
										"user_id"  => substr_replace($_POST['useridval'],"",-1)
										));
			 
			messages(GROUP_ADDED);
			reload('group.php');
		}else{
			Update("email_group", array("name" => $_POST['name'], 
					 					"user_id"  => substr_replace($_POST['useridval'],"",-1)
										), "id=".$_GET['id']);
			messages(GROUP_UPDATED);
			reload("group.php");
		}
 	}
	if(isset($_GET['action'])) {	
		if(isset($_GET['id'])) {
			$tpl -> AssignValue("action", 'Edit');	
			$groupname=FetchAssoc(Query("SELECT * FROM `[x]email_group` WHERE id=".$_GET['id']));
			$tpl -> AssignValue("name", $groupname['name']);	
			$groupusers='';
			foreach(getEmailGroup($_GET['id']) as $val){
				$groupusers .= "<option value=".$val["id"].">".$val["first_name"].' '.$val["last_name"]."</option>";
			}
			$tpl -> AssignValue("usernames", $groupusers);	
		} 
		$tpl -> AssignValue("action", 'Add');	
		$userquery = Query("SELECT * FROM `[x]user` where id <>1 and status = 1");	
		$options = '';
		while($userresults = FetchAssoc($userquery)) {
		  $options .= "<option value=".$userresults["id"].">".$userresults["first_name"].' '.$userresults["last_name"].' ('.$userresults["email"].')'."</option>";
		}
		$tpl -> AssignValue("options", $options);	
		$tpl -> Zone("groupentry", "enabled");
	}else{	
		if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
		}
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		$groupquery = "SELECT id, name, user_id FROM `[x]email_group` order by id desc";	
		$q = new splitResults($groupquery);
		$groups[] ='';
		if(Num($q->out)>0) {
			$tpl -> Zone("groupavilable", "enabled");
			$tpl -> Zone("nogroups", "disabled");
			while($groupresults = FetchAssoc($q->out)) {
			$groupresults['slno'] = $i;
			if($i%2 ==0) {
				$groupresults['class'] ="two";
			}else {
				$groupresults['class'] ="one";
			}
			$groups[] = $groupresults;	
			$i++;		
			}
			
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());	
		}else{
			$tpl -> Zone("nogroups", "enabled");
			$tpl -> Zone("groupavilable", "disabled");
			$tpl -> AssignValue("total", 0);	
		}
		$tpl -> Loop("groups", $groups);	
		$tpl -> Zone("grouplist", "enabled");
	}	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
 <script type="text/javascript" src="js/group.js"></script>
 <script type="text/javascript" src="js/delete.js"></script>

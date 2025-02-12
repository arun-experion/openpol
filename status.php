<?php  

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	$perm = array('');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "status.tpl");
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		if($_POST['action'] == 'add') {	
			Insert("workflow", array("status" => $_POST['status'], 
									 "user_role" => $_POST['usertype'],
									  "next" => $_POST['next_status'],
									  "complaint" => 0												
									));
			 messages('Workflow added');
			 reload('status.php');
		}else{ 
			Update("workflow", array("status" => $_POST['status'], 
									 "user_role" => $_POST['usertype'],
									  "next" => $_POST['next_status'],
									  "complaint" => 0												
									), "id=".$_GET['id']);
			 messages('Workflow updated');
			 reload('status.php');
		}
	
	}
	
	if(isset($_GET['delete'])) {
		Query("DELETE FROM workflow WHERE id={$_GET['delete']}");
		messages('Workflow deleted');
		reload("status.php");
	
	}
	
	//Get role
	$rolequery = Query("SELECT * FROM `[x]roles` ");	
	while($roleresults = FetchAssoc($rolequery)) {
		$roleoptions[$roleresults["ID"]] = $roleresults["roleName"];
	}
	
	//Get status
	$statusquery = Query("SELECT * FROM `[x]status` where complaint=0 ");	
	while($statusresults = FetchAssoc($statusquery)) {
		$statusoptions[$statusresults["id"]] = $statusresults["status"];
	}
	
	//Get next
	$statusquery = Query("SELECT * FROM `[x]status` where complaint=0");	
	while($statusresults = FetchAssoc($statusquery)) {
		$statusoptions[$statusresults["id"]] = $statusresults["status"];
	}
	
	if(isset($_GET['id'])) {
		$tpl -> AssignValue("action", "edit");
 		$workflow = Fetch(Query("SELECT * FROM workflow where id=".$_GET['id']));
 		$tpl -> AssignValue("select_usertype", createSelect("usertype", $roleoptions, $workflow['user_role']));
		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions, $workflow['status']));
		$tpl -> AssignValue("select_next", createSelect("next_status", $statusoptions, $workflow['next']));
		
	}else{
		$tpl -> AssignValue("action", "add");
	 	$tpl -> AssignValue("select_usertype", createSelect("usertype", $roleoptions));
		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions));
		$tpl -> AssignValue("select_next", createSelect("next_status", $statusoptions));
 
	}
	

	require(DIR_CLASSES . "order.php");
	$order = new Order();	
	if($order->getworkflows()) {
		$tpl -> Loop("workflows", $order->getworkflows());
 	}else{	
		$tpl -> Loop("workflows",$array= array());
		$tpl -> Zone("noworkflow", "enabled");
	}

 	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<?php  

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: zone.php  Friday, June 11, 2010, 04:00:00 PM $
 *		
 */

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_FUNCTIONS . "formvalidation.php");

	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "zone.tpl");
	 
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		 $required = array ("name" => '<LI>'.EMPTY_ZONENAME.'</LI>');
			// while (list($key, $val) = each($required)) {
				foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
			 
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else {		
				
				 if($_POST['action'] == 'Add') {						  
					Insert("zone", array("name" => $_POST['name'], 
										"created_by" => $_SESSION['id'], 
										"created_date" => date('Y-m-d H:i:s')
										));
					messages(ZONE_ADDED);
					reload('zone.php');
				 
				 } else {
					 Update("zone", array("name" => $_POST['name'], 
											"created_by" => $_SESSION['id'], 
											"created_date" => date('Y-m-d H:i:s')
											), "id=".$_GET['zid']);
					  messages(ZONE_UPDATED);
					  reload("zone.php");
				 }
			 }
			 
	 }
	 
	 if(!isset($_GET['action'])) {
	 	
		if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
		}
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		$zonequery = "SELECT * FROM `[x]zone`";	
		$q = new splitResults($zonequery);
		$zones[] ='';
		if(Num($q->out)>0) {	
			while($zoneresults = FetchAssoc($q->out)) {
			$zoneresults['slno'] = $i;
			if($i%2 ==0) {
				$zoneresults['class'] ="two";
			}else {
				$zoneresults['class'] ="one";
			}
			$zones[] = $zoneresults;	
			$i++;		
			}
				
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());	
			$tpl -> Zone("zonavail", "enabled");
			$tpl -> Zone("nozones", "disabled");	
				
		}else{
 			$tpl -> Zone("nozones", "enabled");	
			$tpl -> AssignValue("total", 0);		
		}
		$tpl -> Loop("zones", $zones);
		$tpl -> Zone("listzone", "enabled");
			
	} 
	
	if((isset($_GET['action']) && $_GET['action'] == 'add') ||  (isset($_GET['action']) && $_GET['action'] == 'edit')) {	
		$tpl -> Zone("zone_entry", "enabled");
		$tpl -> Zone("listzone", "disabled");
		$tpl -> AssignValue("action", ucfirst($_GET['action']));		
		if(isset($_GET['zid'])) {		
		$zoneresult = FetchAssoc(Query("SELECT * FROM `[x]zone` where id=" . $_GET['zid']));		
		$tpl -> AssignArray($zoneresult);
		}
    }
 	
	if(isset($_GET['action']) && $_GET['action'] == 'delete') {
		if(dupData("area", "zone_id", $_GET['zid'])) {
 			messages(ZONE_CANNOT_DELETE);
		}else{
		 Query("DELETE FROM zone WHERE id={$_GET['zid']}");
			messages(ZONE_DELETED);
		}
		
		 reload("zone.php");
	}

	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
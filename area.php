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
	$tpl -> Load(TEMPLATE_PATH . "area.tpl");
		
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		 $required = array ("name" => '<LI>'.EMPTY_AREA.'</LI>');
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
		
		if($_POST['zones'] ==0)	{
			$error['error.zone'] = '<li>'.EMPTY_ZONE.'</li>';
		} 	 
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else {			
				 if($_POST['action'] == 'add') {						  
					Insert("area", array("name" => $_POST['name'], 
										 "zone_id"  => $_POST['zones'], 
										"created_by" => $_SESSION['id'], 
										"created_date" => date('Y-m-d H:i:s')
										));
					messages(AREA_ADDED);
					reload('area.php');
				 
				 } else {
					 Update("area", array("name" => $_POST['name'], 
					 					"zone_id"  => $_POST['zones'], 
											"created_by" => $_SESSION['id'], 
											"created_date" => date('Y-m-d H:i:s')
											), "id=".$_GET['aid']);
					messages(AREA_UPDATED);
				    reload("area.php");
				 }
			 }
			 
	 }
	 
	 if(!isset($_GET['action'])) {
	 	$tpl -> Zone("area_entry", "disabled");
		$tpl -> Zone("listarea", "enabled");
		if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
		}
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		$areaquery = "SELECT a.*,z.name as zonename FROM `[x]area` a, `[x]zone` z where a.zone_id=z.id";	
		$q = new splitResults($areaquery);
		$areas[] ='';
		if(Num($q->out)>0) {
			$tpl -> Zone("arealist", "enabled");
			$tpl -> Zone("noareas", "disabled");
			while($arearesults = FetchAssoc($q->out)) {
			$arearesults['slno'] = $i;
			if($i%2 ==0) {
				$arearesults['class'] ="two";
			}else {
				$arearesults['class'] ="one";
			}
			$areas[] = $arearesults;	
			$i++;		
			}
			
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());	
		}else{
			$tpl -> Zone("noareas", "enabled");
			$tpl -> Zone("arealist", "disabled");
			$tpl -> AssignValue("total", 0);	
		}
			$tpl -> Loop("areas", $areas);	
		
			
	} 
	if((isset($_GET['action']) && $_GET['action'] == 'add') ||  (isset($_GET['action']) && $_GET['action'] == 'edit')) {	
		$tpl -> Zone("area_entry", "enabled");
		$tpl -> Zone("listarea", "disabled");
		$tpl -> AssignValue("action", $_GET['action']);	
		 //Get zones
		$zonequery = Query("SELECT * FROM `[x]zone`");	
		$zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}
			
		if(isset($_GET['aid'])) {		
			$zoneresult = FetchAssoc(Query("SELECT * FROM `[x]area` where id=" . $_GET['aid']));		
			$tpl -> AssignArray($zoneresult);
			$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions,$zoneresult['zone_id']));
		}else{
			if(isset($_POST['zones'])) {
				$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions,$_POST['zones']));
			}else{
				$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions));
			}
		}
    }
	
	if(isset($_GET['action']) && $_GET['action'] == 'delete') {
		Query("DELETE FROM area WHERE id={$_GET['aid']}");
		messages('Area deleted successfully');
		reload("area.php");
	}
 
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
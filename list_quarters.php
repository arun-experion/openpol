<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: login.php  Monday, June 8, 2010, 11:47:41 PM $
 *		
 */
    include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	$perm = array('access_admin');
	checkpermission($perm);
 
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "list_quarters.tpl");
  	$query ="SELECT id, name,DATE_FORMAT( `from_date` , '%d/%m/%Y' ) AS from_date, DATE_FORMAT( `to_date` , '%d/%m/%Y' ) AS                  to_date FROM `[x]quarter` ORDER BY id DESC";
	$q = new splitResults($query);
	if(isset($_GET['page']) && $_GET['page'] !=1) {
		$i=(($_GET['page']-1)*10)+1;
	}else{
		$i=1;
	}
	if(Num($q->out))
	{
		while($r = FetchAssoc($q->out)){
		$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] ="two";
				}else {
					$r['class'] ="one";
				}
		$quarters[] = $r;
		$i++;
		}
		
	$tpl -> Loop("quarters", $quarters);
	$tpl -> AssignValue("start", $q->start);
	$tpl -> AssignValue("end", $q->end);
	$tpl -> AssignValue("total", $q->total);
	$tpl -> AssignValue("split_results", $q->show());
	$tpl -> Zone("showlist", "enabled");	
		
    }else{
	$tpl -> Zone("showlist", "disabled");
	$tpl -> Zone("noresults", "enabled");
	$tpl -> AssignValue("total", 0);
	}	
   if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
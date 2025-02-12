<?php  

	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "list_roles.tpl");
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}
    $query = "SELECT * FROM `[x]roles` ORDER BY ID DESC";
	$q = new splitResults($query);
	$roles[] ='';
	if(Num($q->out)>0) {
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		while($r = FetchAssoc($q->out)){
		$r['slno'] = $i;
			if($i%2 ==0) {
				$r['class'] = "two";
			}else {
				$r['class'] = "one";
			}		
		$roles [] = $r;
		$i++;
		}			
		$tpl -> AssignValue("start", $q->start);
		$tpl -> AssignValue("end", $q->end);
		$tpl -> AssignValue("total", $q->total);
		$tpl -> AssignValue("split_results", $q->show());
	}else{
		$tpl -> AssignValue("total", 0);
		$tpl -> Zone("noroles", "enabled");
	}
	$tpl -> Loop("roles", $roles);
	$tpl -> Zone("showrolelist", "enabled");
	$tpl -> Zone("role", "disabled");
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
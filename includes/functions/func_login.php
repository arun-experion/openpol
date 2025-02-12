<?php

function loginbox() {

 
	
  	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		$user_name = $_POST['username'];
		$password = md5($_POST['password']);
		$q = Query("SELECT id, status FROM `[x]user` WHERE username='{$user_name}' AND password='{$password}'");
		
		if(Num($q)) {
			$r = Fetch($q);
			
			if($r['status'] == 1) {
			 
				loadSessions($r['id']);	
						
			
				if(isset($_GET['return'])) 
					reload($_GET['return']);
				else
					reload("dashboard.php");
				
			} else {
				$tpl -> AssignValue("error", USER_NOT_ACTIVE);
				$tpl -> Zone("loginerror", "enabled");
 			}	
		} else {
			$tpl -> Zone("loginerror", "enabled");
			$tpl -> AssignValue("error", USER_PASS_NOT_MATCH);
 		}
		
	}  
	 
	/*$tpl -> ConvertSelf();
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	return $tpl -> Flush(1);*/

}



?>
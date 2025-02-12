<?php  
    include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	require(DIR_CLASSES . "search.php");
	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "list_users.tpl");
	
	if(isset($_GET['uid']))
	{	
		include(DIR_FUNCTIONS . "func_user.php");
		$tpl -> Zone("showuser", "enabled");
		$uname = getUserData($_GET['uid']);
		if($uname['status'] == 1) {
			$status = "Active";
		}else {
			$status = "In Active";
		}
		$tpl -> AssignValue("status", $status);
		$tpl -> AssignArray($uname); 
 		$tpl -> AssignValue("zonename", getZoneName($uname['zone_id']));
		$tpl -> AssignValue("areaname", getAreaName($uname['area_id']));
		$tpl -> AssignValue("utype", getUserType($uname['id']));
		$tpl -> AssignValue("userperms", userperms());
		
		
	} else{
		if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
		}	

		 //Get zones
		$zonequery = Query("SELECT * FROM `[x]zone`");	
		$zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}
		if(isset($_GET['zones']) && !isset($_GET['reset'])) {		
			$tpl -> AssignValue("select_zones", createSelect("zones", $zoneoptions, $_GET['zones']));
		}else{
			$tpl -> AssignValue("select_zones", createSelect("zones", $zoneoptions));
		}
		
		$statusoption[0]	='Inactive';	
		$statusoption[1]	='Active';	
		if(isset($_GET['status']) && !isset($_POST['reset'])) {		
			$tpl -> AssignValue("select_status", createSelect("status", $statusoption, $_GET['status']));	
		}else{
			$tpl -> AssignValue("select_status", createSelect("status", $statusoption, 1));	
		}			 
		
		//Get role
		$roleoptions['0'] = '---Select---';
		$rolequery = Query("SELECT * FROM `[x]roles` ");	
		while($roleresults = FetchAssoc($rolequery)) {
			$roleoptions[$roleresults["ID"]] = $roleresults["roleName"];
		}
		if(isset($_GET['usertype']) && !isset($_GET['reset'])) {		
			$tpl -> AssignValue("select_usertype", createSelect("usertype", $roleoptions, $_GET['usertype']));
		}else{
			$tpl -> AssignValue("select_usertype", createSelect("usertype", $roleoptions));
		}	
 
  			if(isset($_GET['reset'])) {
				$query = "SELECT * FROM `[x]user` where id <>1 ORDER BY id DESC";
			}
			
			if(isset($_GET['submit'])) {			
				if(isset($_GET['q'])) {
					$tpl -> AssignValue("name", $_GET['q']);
				}				
				$searchFields = "u.first_name,u.last_name";
				$condition = array();
	 
				if(isset($_GET['zones']) && $_GET['zones'] !=0) {
			 		$condition['u.zone_id'] =$_GET['zones'];
				}
				if(isset($_GET['usertype']) && $_GET['usertype'] !=0) {
					 $condition['t.roleID'] =  '^' .$_GET['usertype']. '$';
				}
				if(isset($_GET['status'])) {				
			 		$condition['u.status'] = $_GET['status'];
				}
				 
				
				$s = new search($searchFields, $condition, " u.id=t.userID");
				$query = "SELECT u.*, t.* FROM user u, user_roles t" . $s->query ;
			 	//print  $query;
				

			} else {
				$query = "SELECT * FROM `[x]user` where id <>1 ORDER BY id DESC";
			}
		$q = new splitResults($query);
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		if(Num($q->out)>0)
		{
			while($r = FetchAssoc($q->out)){
				$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] ="two";
				}else {
					$r['class'] ="one";
				}
				if($r['status'] == 1) {
					$r['status'] = "Active";
				}else {
					$r['status'] = "In Active";
				}
				$r['zonename'] = getZoneName($r['zone_id']);
				$r['areaname'] = getAreaName($r['area_id']);
				$r['usertype'] = getUserType($r['id']);			
				$users[] = $r;
				$i++;
			}		 
			$tpl -> Loop("users", $users);
			 
			$tpl -> AssignValue("start", $q->start);
			$tpl -> AssignValue("end", $q->end);
			$tpl -> AssignValue("total", $q->total);
			$tpl -> AssignValue("split_results", $q->show());
			$tpl -> Zone("usersavail", "enabled");
			
		}else{
			$tpl -> Zone("nouser", "enabled");
			$tpl -> AssignValue("total", 0);	
		}
		
		$tpl -> Zone("showlist", "enabled");
	}
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
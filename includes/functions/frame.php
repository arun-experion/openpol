<?php

function LoadFrame($contents = '', $return=false) {
 	$tpl = new template;
	$tpl -> Load(TEMPLATE_PATH . "frame.tpl");
 	$tpl -> AssignValue("contents", $contents);
	$tpl -> AssignValue("topheader", topheader());
	$tpl -> AssignValue("site.url", HTTP_SERVER);
	$tpl -> AssignValue("footer", footer());
	if(isset($_SESSION['message'])) {
		unset($_SESSION['message']);
	}
	if (!$return) echo $tpl -> Flush();
	else return $tpl -> Flush(1);
}

function topheader() {

	$myACL = new ACL();	
	$tpl = new template;
	$tpl -> Load(TEMPLATE_PATH . "boxes/topheader.tpl");
	$currentpage = substr(basename($_SERVER['PHP_SELF']),0,strpos(basename($_SERVER['PHP_SELF']),"."));
   	foreach($_SESSION['topmenus'] as $key =>$val) {
   		if(in_array($currentpage, $val)) {
			$tpl -> AssignValue($key, "class='active'");
		}
	}
	if(isset($_SESSION['id'])) {
		$uname = getUserData($_SESSION['id']);
		$tpl -> AssignValue("username", $uname['username']);
		$tpl -> Zone("logoutbutton", "enabled");
		if($myACL->hasPermission('access_admin') || $_SESSION['id'] ==1) {
			$tpl -> Zone("admin_menus", "enabled");
		}else if($myACL->hasPermission('add_order') || $myACL->hasPermission('view_order')) {
			$tpl -> Zone("ba_menus", "enabled");
		}else{
			$tpl -> Zone("se_menus", "enabled");
		}
		
		if($myACL->hasPermission('take_report')){
			$tpl -> Zone("reports", "enabled");
		}
		 
	}else{
		$tpl -> AssignValue("username", 'Anonymous User');
	}
	 
	$tpl -> CleanZones();
	return $tpl -> Flush(1);
}

function footer() {
	$tpl = new template;
	$tpl -> Load(TEMPLATE_PATH . "boxes/footer.tpl");	 
	$tpl -> CleanZones();
	return $tpl -> Flush(1);	
}
?> 
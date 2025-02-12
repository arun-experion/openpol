<?php  
    include("includes/initialize.php");
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "access_denied.tpl");
	LoadFrame($tpl -> Flush(1));

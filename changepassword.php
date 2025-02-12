<?php  

	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
 	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "changepassword.tpl");
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		$required = array ("newpassword" => '<LI>'.EMPTY_PASSWORD.'</LI>', "confirmpassword" => '<LI>'.PASSWORD_NOT_MATCH.'</LI>');
		 
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
			
		
		if($_POST['newpassword'] != $_POST['confirmpassword']) {
			$error['error.passwordnotmatch'] = '<li>'.PASSWORD_NOT_MATCH.'</li>';
		}
		
				 
		if(isset($error)) {			
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
		} else{
			Update("user", array("password" => md5($_POST['newpassword'])), "id=".$_SESSION['id']);
			$tpl -> Zone("passwordreset", "enabled");
			$tpl -> AssignValue("success", PASSWORD_RESET);
 
		}
	}
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
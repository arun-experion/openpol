<?php  

	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	include(DIR_CLASSES . "mail.php");
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "forgotpassword.tpl");
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		 $required = array ("email" => '<LI>'.EMPTY_EMAIL.'</LI>');
		 
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
		$email = $_POST['email'];	
		if(!email($email)) {
			$error['error.notvalidemail'] = '<li>'.EMAIL_NOTVALID.'</li>';
		}	
		
		if (!dupData("user", "email", $email)) {
			$error['error.notfound'] = '<li>'.EMAIL_NOTFOUND.'</li>';
		}
		 
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else{
				$mailContent = "Dear";
				//send mail
				$mail = new SendMail;
				$mail -> From 		= SITE_NAME . " <" . STIE_EMAIL . ">";
				$mail -> To 		=	"syamnath.v@experionglobal.com";
				$mail -> Subject 	= "Your login details of ".SITE_NAME;
				$mail -> Body 		= $mailContent;
				if($mail -> Send())
				{
					echo 'Success';
				}else{
					echo 'Failed';
				}
			
			}
	}
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
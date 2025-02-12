<?php

/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: login.php  Monday, June 2, 2010, 1:47:41 PM $
 *		
 */
 

	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php"); 
 	if(isset($_SESSION['id'])) {
	 reload("dashboard.php");	  
	}  
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "login.tpl");
	
 	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_new_mail();

  
	 echo '<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script><script>$(function(){ $("#loginfeilds").show(); $("#passwordforgot").hide();});</script>';
	 
 	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		if($_POST['actions'] == 'login') {		
			$user_name = $_POST['username'];
			$password = md5($_POST['password']);
			$q = Query("SELECT id, status, area_id, zone_id  FROM `[x]user` WHERE username='{$user_name}' AND password='{$password}'");			
			if(Num($q)) {
				$r = Fetch($q);
				
				if($r['status'] == 1) {			 
					loadSessions($r['id'],$r['area_id'],$r['zone_id']);			
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
		}else{
		
		
			$email = $_POST['email'];	
			if(!email($email)) {
 				$tpl -> AssignValue("ferror", EMAIL_NOTVALID);
				$tpl -> Zone("forgoterror", "enabled");
			}else{	
			
				if (!dupData("user", "email", $email)) {
 					$tpl -> AssignValue("ferror", EMAIL_NOTFOUND);
					$tpl -> Zone("forgoterror", "enabled");
				}else{
					$mail_subject = FORGOT_PASSWORD_SUBJECT;	
					$userdata = Fetch(Query("SELECT id, first_name, username  FROM `[x]user` WHERE email='{$email}'"));
				 	$pass = createRandomString('7');
					Update("user", array("password" => md5($pass)), "id=".$userdata['id']);		
					
					$message = "Dear ".$userdata['first_name'].",<br>";		
					$message .= "Your password reset successfully. Your new login details are as follows.<br><br>";		
					$message .= "Username: "	. $userdata['username'] .'<br>';
					$message .= "Password: " . $pass .'<br><br>';
					$message .=	"Click <a href='".HTTP_SERVER."'>here</a> to login<br><br>";
					$message .=	 "Thanks<br>";
					$message .=	SITE_NAME;
					// $mail->addContent($message);
					// $mail->addTo($email, SITE_OWNER);
					if(prepare_new_mail_send($mail_subject, $email, $message, $SITE_OWNER)){
						 $tpl -> Zone("forgoterror", "disabled");
					} else {
						$tpl -> AssignValue("ferror", MAIL_NOTSENT);
						$tpl -> Zone("forgoterror", "enabled");
					}	 	
					
				}
			}
			
			echo '<script>$(function(){ $("#loginfeilds").hide(); $("#passwordforgot").show();  $("#actions").val("forgotpass");});</script>';
 		
		}
	}  
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	echo $tpl -> Flush(1);

?>

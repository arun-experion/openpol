<?php  
 
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: login.php  Monday, July 9, 2010, 09:00:00 AM $
 *		
 */
	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	include(DIR_CLASSES . "mail.php");
	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_mail();
	
	$perm = array('access_admin');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "user.tpl");
 


 	if($_SERVER['REQUEST_METHOD'] == "POST") {
 	 
		 $required = array ("firstname" => '<li>'.EMPTY_FIRSTNAME.'</li>',
							/*"lastname" => '<li>'.EMPTY_LASTNAME.'</li>',*/
							"username" => '<li>'.EMPTY_USERNAME.'</li>',
 							/*"mobile" => '<li>'.EMPTY_MOBILE.'</li>',	*/						
							"address" => '<li>'.EMPTY_ADDRESS.'</li>'				
						   );
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
			 
		    if (!preg_match('/^[\+\]*\d+[\-\s]*\d+$/', $_POST['mobile']) && $_POST['mobile'] !="") {
				$error['error.validmobile'] = '<li>'.VALID_MOBILE.'</li>';
			}	
 			if (!preg_match('/^\d+[\-\s]*\d+[\-\s]*\d*$/', $_POST['phone']) && $_POST['phone'] !="") {
  				$error['error.validphone'] = '<li>'.VALID_PHONE.'</li>';
			}  
			if(!isset($_GET['id'])) {	
			
				if(isEmpty('password', EMPTY_PASSWORD))	{
					$error['error.password'] = '<li>'.EMPTY_PASSWORD.'</li>';
				} 
				if(isEmpty('title', EMPTY_TITLE))	{
					$error['error.title'] = '<li>'.EMPTY_TITLE.'</li>';
				} 
				
				if(!email($_POST['emailid'])) {
					$error['error.notvalidemail'] = '<li>'.EMAIL_NOTVALID.'</li>';
				}	
				
				if($_POST['password'] != $_POST['confirmpassword']) {
					$error['error.passwordnotmatch'] = '<li>'.PASSWORD_NOT_MATCH.'</li>';
				}
				
				if(dupData("user", "email", $_POST['emailid'])) {
						$error['error.emailid'] = '<li>'.DUPICATE_EMAIL.'</li>';
				}
					
				if(dupData("user", "username", $_POST['username'])) {
					$error['error.username'] = '<li>'.USERNAME_NOT_AVAILABLE.'</li>';
				}
				
			}
			
			if(isset($_GET['id'])) {
				$userdetails = getUserData($_GET['id']);
				
				if(dupData("user", "email", $_POST['emailid'], "AND id<>{$_GET['id']}")) {
						$error['error.emailid'] = '<li>'.DUPICATE_EMAIL.'</li>';
				}
					
				if(dupData("user", "username", $_POST['username'], "AND id<>{$_GET['id']}")) {
					$error['error.username'] = '<li>'.USERNAME_NOT_AVAILABLE.'</li>';
				}
				
				if($_POST['password'] != $_POST['confirmpassword']) {
					$error['error.passwordnotmatch'] = '<li>'.PASSWORD_NOT_MATCH.'</li>';
				}
			}
		if(isset($error)) {
			 
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
			
			//$messageStack -> add("message", NOT_SAVED_ERROR, 'warning');
		} else {	
		
				 if($_POST['action'] == 'add') {	
 					$userid = InsertId("user", array("title" => $_POST['title'], 
											"first_name" => $_POST['firstname'],
											"last_name" => $_POST['lastname'], 
											"username" => $_POST['username'], 
											"email" => $_POST['emailid'], 
											"password" => md5($_POST['password']), 
											"mobile" => $_POST['mobile'], 
											"phone" => $_POST['phone'], 
											"address" => $_POST['address'], 
											"zone_id" => $_POST['zones'], 
											"area_id" => $_POST['area'],											
											"status" => 1, 
											"created_by" => $_SESSION['id'], 
											"created_date" => date('Y-m-d H:i:s')
										), "username", $_POST['username']);
	 		Insert("user_roles", array("userID" => $userid, "roleID" => $_POST['usertype'], "addDate" => date('Y-m-d H:i:s')));
			
					$mail->Subject = SITE_NAME." login details";	
										
					$message = "Dear ".$_POST['firstname'].",<br><br>";		
					$message .= "Your account has been created successfuly. Your login details are as follows.<br><br>";		
					$message .= "Username: "	. $_POST['username'] .'<br>';
					$message .= "Password: " . $_POST['password'] .'<br><br>';
					$message .=	"Click <a href='".HTTP_SERVER."'>here</a> to login<br><br>";
					$message .=	 "Thanks<br>";
					$message .=	SITE_NAME;
					$mail->MsgHTML($message);
					$mail->AddAddress($_POST['emailid'], SITE_OWNER);
					$mail->Send();
					messages(USER_ADDED);
					reload('list_users.php');
				 
				 } else {
				 
				 if($_POST['password'] !='')
				 {
				 	$password = md5($_POST['password']);
				 }else{
					 $password = $_POST['passhiden'];
				 }
					 Update("user", array("title" => $_POST['title'], 
											"first_name" => $_POST['firstname'],
											"last_name" => $_POST['lastname'], 
											"username" => $_POST['username'], 
											"email" => $_POST['emailid'], 
											"password" => $password, 
											"mobile" => $_POST['mobile'], 
											"phone" => $_POST['phone'], 
											"address" => $_POST['address'], 
											"zone_id" => $_POST['zones'], 
											"area_id" =>  $_POST['area'],											
											"status" => $_POST['status'],
											"created_by" => $_SESSION['id'], 
											"created_date" => date('Y-m-d H:i:s')
										), "id=".$_GET['id']);
					 Update("user_roles", array("roleID" => $_POST['usertype']), "userID=".$_GET['id']);
					 messages(USER_UPDATED);		
					  reload("list_users.php");
				 }
			 }
			 
	 }
	
	 

 	if(isset($_GET['id'])) {
		$tpl -> AssignValue("action", 'edit');
		$tpl -> AssignValue("pagename", 'Edit');
		$tpl -> AssignArray(getUserData($_GET['id']));
		$userdata = getUserData($_GET['id']);
		$tpl -> AssignValue("firstname", $userdata['first_name']);
		$tpl -> AssignValue("lastname", $userdata['last_name']);
		$tpl -> AssignValue("emailid", $userdata['email']);
		
		
		//Get role
		$rolequery = Query("SELECT * FROM `[x]roles` ");	
		while($roleresults = FetchAssoc($rolequery)) {
			$roleoptions[$roleresults["ID"]] = $roleresults["roleName"];
		}
		//Get role
		$rolequery = Fetch(Query("SELECT * FROM `[x]user_roles` where userID =". $_GET['id']));	
  		$tpl -> AssignValue("select_role", createSelect("usertype", $roleoptions,$rolequery['roleID']));
		//Get zones
		$zonequery = Query("SELECT * FROM `[x]zone`");	
		$zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}
		$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions,$userdata['zone_id'] ));	
		$tpl -> AssignValue("zoneval", $userdata['zone_id']);
		
		//Get area
		$areaquery = Query("SELECT * FROM `[x]area` where zone_id=". $userdata['zone_id']);	
		$areaoptions[0]	='---Select---';
		while($arearesults = FetchAssoc($areaquery)) {
			$areaoptions[$arearesults["id"]] = $arearesults["name"];
		}		
		if(isset($_POST['area'])) {									
			$tpl -> AssignValue("selectedarea", $_POST['area']);
		}else{
			$tpl -> AssignValue("selectedarea", $userdata['area_id']);
			$tpl -> AssignValue("select_areas", createSelect("area", $areaoptions,$userdata['area_id'] ));	
		}		
		
		
		//Get title		
		$title['Mr.']	='Mr.';	
		$title['Miss.']	='Miss.';	
		$title['Mrs.']	='Mrs.';
		$title['M/s.']	='M/s.';	 		 
		$tpl -> AssignValue("select_title", createSelect("title", $title, $userdata['title']));	
		
		$tpl -> Zone("status", "enabled");	
		$statusoption[0]	='Inactive';	
		$statusoption[1]	='Active';				 
		$tpl -> AssignValue("select_status", createSelect("status", $statusoption, $userdata['status']));	
	
	}else{
		$tpl -> AssignValue("action", 'add');
		$tpl -> AssignValue("pagename", 'Add');
		//Get role
		$rolequery = Query("SELECT * FROM `[x]roles` ");		
		while($roleresults = FetchAssoc($rolequery)) {
			$roleoptions[$roleresults["ID"]] = $roleresults["roleName"];
		}	
		
		if(isset($_POST['usertype'])) {
			$tpl -> AssignValue("select_role", createSelect("usertype", $roleoptions,$_POST['usertype'])); 
		}else{
			$tpl -> AssignValue("select_role", createSelect("usertype", $roleoptions));
		}			
		 //Get zones
		$zonequery = Query("SELECT * FROM `[x]zone`");	
		$zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}		 
											
		if(isset($_POST['zones'])) {									
			$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions,$_POST['zones']));
		}else{
			$tpl -> AssignValue("select_zone", createSelect("zones", $zoneoptions));
		}
		
		//Get area		
		$areaoptions[0]	='---Select---';		 
		//$tpl -> AssignValue("select_areas", createSelect("area", $areaoptions));
		
		if(isset($_POST['area'])) {	
			$tpl -> AssignValue("selectedarea",$_POST['area']);
		}
		
		//Get title	
		$title['']	='---Select---';		
		$title['Mr.']	='Mr.';	
		$title['Miss.']	='Miss.';	
		$title['Mrs.']	='Mrs.';	
		$title['M/s.']	='M/s.';	 
		if(isset($_POST['title'])) {
			$tpl -> AssignValue("select_title", createSelect("title", $title, $_POST['title']));	
		}else{
		 	$tpl -> AssignValue("select_title", createSelect("title", $title));	
		}
	
	}	  	
	
 
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/user.js"></script>

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
    ini_set( "display_errors", 0);
	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	include(DIR_CLASSES . "mail.php");
	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_new_mail();
	
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
			foreach($required as $key =>$val){
				
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
			if(($_POST['usertype'] == '2' || $_POST['usertype'] == '47' ) && $_POST['erp_number']!=''){
				if (preg_match("/[^a-zA-Z0-9-]+/", $_POST['erp_number']) && $_POST['erp_number']!=""){
					$error['error.validerpnumber'] = '<li>'.VALID_ERPNUMBER.'</li>';
				} 
				
				/*if(preg_match('/^c-([0-9]+)$/i', $_POST['erp_number'], $match)){
					
			   	} else if(preg_match('/^c([0-9]+)$/i', $_POST['erp_number'], $match)){

				}else {
					$error['error.validerpnumber'] = '<li>'.VALID_ERPNUMBER.'</li>';
				}*/
			}

			if(($_POST['usertype'] == '2' || $_POST['usertype'] == '47' ) && $_POST['erp_number']==''){
				
				$error['error.emptyerpnumber'] = '<li>'.EMPTY_ERPNUMBER.'</li>';
				
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
				
				if(($_POST['usertype'] == '2' || $_POST['usertype'] == '47' ) && $_POST['erp_number']!=''){
					if(dupData("user", "erp_number", $_POST['erp_number'])) {
						$error['error.duplicate_erp'] = '<li>'.DUPICATE_ERP.'</li>';
					}
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

				if(($_POST['usertype'] == '2' || $_POST['usertype'] == '47' )&& $_POST['erp_number']!=''){
					if(dupData("user", "erp_number", $_POST['erp_number'], "AND id<>{$_GET['id']}")) {
						$error['error.duplicate_erp'] = '<li>'.DUPICATE_ERP.'</li>';
					}
				}
			}
		if(isset($error)) {
			 
			$tpl -> AssignArray($error);
			$tpl -> AssignArray($_POST);
			$tpl -> Zone("error", "enabled");
			
			//$messageStack -> add("message", NOT_SAVED_ERROR, 'warning');
		} else {	
			//New field integration c_ERP Number Add By Abilash FEB 16
			$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			$erp_number	=	'';
			if($_POST['usertype'] == '2' || $_POST['usertype'] == '47' ){
				$erp_number	=	$_POST['erp_number'];
			}

			if($_POST['action'] == 'add') {
					
				$userid 	= InsertId("user", array(
					"title" 		=> $_POST['title'], 
					"erp_number" 	=> $erp_number, 
					"first_name" 	=> $_POST['firstname'],
					"last_name" 	=> $_POST['lastname'], 
					"username" 		=> $_POST['username'], 
					"email" 		=> $_POST['emailid'], 
					"password" 		=> md5($_POST['password']), 
					"mobile" 		=> $_POST['mobile'], 
					"phone" 		=> $_POST['phone'], 
					"address" 		=> mysqli_real_escape_string($conn,$_POST['address']), 
					// "zone_id" 	=> $_POST['zones'], 
					// "area_id" 	=> $_POST['area'],	
					"zone_id" 		=> 0, 
					"area_id" 		=> 0,											
					"status" 		=> 1, 
					"created_by" 	=> $_SESSION['id'], 
					"created_date" 	=> date('Y-m-d H:i:s')
				), "username", $_POST['username']);

				Insert("user_roles", array("userID" => $userid, "roleID" => $_POST['usertype'], "addDate" => date('Y-m-d H:i:s')));

				foreach ($_POST['zones'] as $key => $value) {
					Insert("user_zones", array("userID" => $userid, "zoneID" => $value, "addDate" => date('Y-m-d H:i:s')));
				}
				
				foreach ($_POST['area'] as $key => $value) {
					Insert("user_areas", array("userID" => $userid, "areaID" => $value, "addDate" => date('Y-m-d H:i:s')));
				}
			
				$mail_subject = SITE_NAME." login details";	
									
				$message = "Dear ".$_POST['firstname'].",<br><br>";		
				$message .= "Your account has been created successfuly. Your login details are as follows.<br><br>";		
				$message .= "Username: "	. $_POST['username'] .'<br>';
				$message .= "Password: " . $_POST['password'] .'<br><br>';
				$message .=	"Click <a href='".HTTP_SERVER."'>here</a> to login<br><br>";
				$message .=	 "Thanks<br>";
				$message .=	SITE_NAME;
				$mail->addContent("text/html",$message);
				$mail->addTo($_POST['emailid'], SITE_OWNER);
				// prepare_new_mail_send($mail);
				//prepare_new_mail_send($mail_subject, $_POST['emailid'], $message, SITE_OWNER);
				messages(USER_ADDED);
				reload('list_users.php');
				 
			} else {
				if($_POST['password'] !='')
				{
					$password = md5($_POST['password']);
				}else{
					$password = $_POST['passhiden'];
				}
				Update("user", array(
					"title" 		=> $_POST['title'], 
					"erp_number" 	=> $erp_number,
					"first_name" 	=> $_POST['firstname'],
					"last_name" 	=> $_POST['lastname'], 
					"username" 		=> $_POST['username'], 
					"email" 		=> $_POST['emailid'], 
					"password" 		=> $password, 
					"mobile" 		=> $_POST['mobile'], 
					"phone" 		=> $_POST['phone'], 
					"address" 		=> mysqli_real_escape_string($conn,$_POST['address']),  
					// "zone_id" 	=> $_POST['zones'], 
					// "area_id" 	=>  $_POST['area'],											
					"status" 		=> $_POST['status'],
					"created_by" 	=> $_SESSION['id'], 
					"created_date" 	=> date('Y-m-d H:i:s')
				), "id=".$_GET['id']);
					
				Update("user_roles", array("roleID" => $_POST['usertype']), "userID=".$_GET['id']);

				Delete("user_zones", "userID", $_GET['id']);
				foreach ($_POST['zones'] as $key => $value) {
					Insert("user_zones", array("userID" => $_GET['id'], "zoneID" => $value, "addDate" => date('Y-m-d H:i:s')));
				}
				
				Delete("user_areas", "userID", $_GET['id']);
				foreach ($_POST['area'] as $key => $value) {
					Insert("user_areas", array("userID" => $_GET['id'], "areaID" => $value, "addDate" => date('Y-m-d H:i:s')));
				}
				messages(USER_UPDATED);		
				reload("list_users.php");
			}
		}
			 
	}
	
	 

 	if(isset($_GET['id'])) {
		 //echo $userdata['erp_number'];
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
		//Get role3
		$rolequery = Fetch(Query("SELECT * FROM `[x]user_roles` where userID =". $_GET['id']));	
  		$tpl -> AssignValue("select_role", createSelect("usertype", $roleoptions,$rolequery['roleID']));
		
  		$zonequery = Query("SELECT * FROM `[x]user_zones` where userID =". $_GET['id']);	
  		$i = 0;
  		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneselectedoptions[$i++] = $zoneresults["zoneID"];
		}

		//Get zones
		$zonequery = Query("SELECT * FROM `[x]zone`");	
		// $zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}
		$tpl -> AssignValue("select_zone", createMultiSelect("zones", $zoneoptions, $zoneselectedoptions ));	
		$tpl -> AssignValue("zoneval", json_encode($zoneselectedoptions));
		
		
		$zonequery = Query("SELECT * FROM `[x]user_areas` where userID =". $_GET['id']);	
  		$i = 0;
  		while($zoneresults = FetchAssoc($zonequery)) {
			$areaselectedoptions[$i++] = $zoneresults["areaID"];
		}

		//Get area
		$areaquery = Query("SELECT * FROM `[x]area` where zone_id IN (". implode (", ", $zoneselectedoptions) . ")");	
		// $areaoptions[0]	='---Select---';
		while($arearesults = FetchAssoc($areaquery)) {
			$areaoptions[$arearesults["id"]] = $arearesults["name"];
		}		
		if(isset($_POST['area'])) {									
			$tpl -> AssignValue("selectedarea", json_encode($_POST['area']));
		}else{
			
			$tpl -> AssignValue("selectedarea", json_encode($areaselectedoptions));
			$tpl -> AssignValue("select_areas", createMultiSelect("area", $areaoptions, implode (", ", $zoneselectedoptions) ));	
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
		// $zoneoptions[0]	='---Select---';
		while($zoneresults = FetchAssoc($zonequery)) {
			$zoneoptions[$zoneresults["id"]] = $zoneresults["name"];
		}		 
											
		if(isset($_POST['zones'])) {									
			$tpl -> AssignValue("select_zone", createMultiSelect("zones", $zoneoptions,$_POST['zones']));
		}else{
			$tpl -> AssignValue("select_zone", createMultiSelect("zones", $zoneoptions));
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

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>

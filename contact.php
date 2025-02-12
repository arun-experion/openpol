<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya H
 * @version			$Id: contact.php  Friday, July 02, 2010, 02:55:00 PM $
 *		
 */

	include("includes/initialize.php");
    include(DIR_FUNCTIONS . "formvalidation.php");
	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "contact.tpl");
	//$perm = array('add_order');
	//checkpermission($perm);
	$group_id = 0;
	if(isset($_POST['group'])){
	$group_id = $_POST['group'];
	}
	$options[0]	='---Select---';
	$q_ptype = Query("SELECT * FROM email_group");		
	while($r_ptype = FetchAssoc($q_ptype)) {
		$options[$r_ptype["id"]] = $r_ptype["name"];
	}
	$tpl -> AssignValue("select_group", createSelect("group", $options,$group_id,"class='select_group'"));
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		 $required = array ("subject"       => '<LI>'.EMPTY_CONTACT_SUBJECT.'</LI>',
							"description"   => '<li>'.EMPTY_CONTACT_DESCRIPTION.'</li>'
						   );
		// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
		}
		if($_POST['group']==0){
			
			$error['error.group'] ='<li>'.EMPTY_CONTACT_GROUP.'</li>'	;
		}
			
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
		}else{
				$userdata = Fetch(Query("SELECT first_name,last_name,email FROM `[x]user` WHERE id=".$_SESSION['id']));
				$from_name = $userdata['first_name'];
				$from_email = $userdata['email'];
				$mail = prepare_new_mail($from_name,$from_email);
				$emailids = getEmailGroup($group_id);
				$groupname = getGroupName($group_id);
				$mail_subject = SITE_NAME." ".CONTACT_MAIL_SUBJECT. "-".$_POST['subject'];
				$flag = 1;
				foreach ($emailids as $emailid ){
					$tomail   =  $emailid['email'];
					$toname   =  $emailid['first_name'];
					$message  =  " Dear  ".$toname.",<br><br>";
					$message .=  "  ".$from_name." (".$_SESSION['utype'].") ".CONTACT_MAIL_DESCRIPTION1 ;
					$message .=	 "<br><br>";
					$message .=  "<b>Subject        - ".$_POST['subject']."</b>";
					$message .=	 "<br><br>";
					$message .=  "Description    - ".nl2br($_POST['description']);	
					$message .=	 "<br><br>";
					$message .=	 "Thanks , <br><br><b>";
					$message .=	 SITE_NAME;
					$mail->addContent("text/html",$message);
					$message .=	"</b>";
					$mail->addTo($tomail,$toname);

					$flag = prepare_new_mail_send($mail_subject, $tomail, $message, $toname);

				}
				if($flag = 1){
					$tpl -> AssignValue("message",MAIL_SENT);	
				} else {
					$tpl -> AssignValue("message",MAIL_SENT_FAILED);
				} 	
		}	
	}else{
	
	
	}			
	$tpl -> Zone("error", "disabled");
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>

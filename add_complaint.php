<?php  
 
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Syamnath
 * @version			$Id: add_complaint.php  Monday, July 9, 2010, 09:00:00 AM $
 *		
 */
	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
 	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_new_mail();

	include(DIR_CLASSES . "complaint.php");
	$complaint = new Complaint();
	
	$perm = array('access_admin', 'view_complaint','place_complaints');
	checkpermission($perm);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "add_complaint.tpl");

 	if($_SERVER['REQUEST_METHOD'] == "POST") {
  	
		 $required = array (    "custname"     	 	=> "<li>".EMPTY_CUSTOMER_NAME."</li>",
								"custcontact"   	=> "<li>".EMPTY_CUST_CONTACT."</li>",
								"batchno"        	=> "<li>".EMPTY_BATCH_NO."</li>",
								"dateofincident"	=> "<li>".EMPTY_DATE_OF_INCIDENT."</li>",
								"mfgdate" 		 	=> "<li>".EMPTY_MFG_DATE."</li>",
								"numberofdefective" => "<li>".EMPTY_NUM_OF_DEFECT."</li>",
								"complaintdesc" 	=> "<li>".EMPTY_COMPLAINT_DESC."</li>",
								"product" 			=> "<li>".EMPTY_PRODUCT_NAME."</li>",
								"service_engineers" => "<li>".EMPTY_SERVICE_ENGINEER."</li>"
							  );
	    //  while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
				    $error['error.' . $key ] = $val ;
			    }
			}
	 
		$extensions_allowed =PICTURES_ALLOWED_EXTENTIONS;
		$errmsg="";	
    	for($i=0;$i<count($_FILES['defectpicture']['name']);$i++){		
				if($_FILES['defectpicture']['name'][$i] != ""){	
					$filename=str_replace(" ","_",$_FILES['defectpicture']['name'][$i]); 	 
					$file_part= explode(".", $filename);
					$file_extension= end($file_part);	
					$next =(int)$key+1;				
					if ((strpos($extensions_allowed, $file_extension)) === false) {		 		
						$errmsg .= "<li>Upload failed. Picture ".$next." (".$filename.") extension not allowed. Please re upload.</li>"; 	
					}else if(($_FILES['defectpicture']['size'][$i] )> IMAGE_MAX_FILE_SIZE){  
						$errmsg .= "<li>Upload failed. Please upload  Picture ".$next." (".$filename.") with size less than ".IMAGE_MAX_FILE_SIZE." bytes.</li>" ;
					}
					if($errmsg !="") { 	
						$error['error.file_error'] = $errmsg;		
					}			
				}
		  	}
	 
		
		 if(isset($error)) {		 
			$tpl -> Zone("error", "enabled");
			$tpl -> AssignArray($_POST);
			$tpl -> AssignArray($error);			 
			$tpl -> AssignValue("prodname", $_POST['product']);
 			}else{ 	 
				$cmpnum = FetchAssoc(Query("SELECT COUNT( id ) AS total FROM  `product_complaint`"));
				$next = $cmpnum['total']+1;
				$firnum = "FIR/TSK/".date('dmY')."/".$next; 
				$pics = "";		 
				// while(list($key,$value) = each($_FILES['defectpicture']['name'])) {
					foreach($_FILES['defectpicture']['name'] as $key => $value) {
					if(!empty($value))
					{
						$filename = $value;
						$filename=str_replace(" ","_",$filename); 		
						$add = COMPLAINT_UPLOAD_PATH."$filename";							    
						copy($_FILES['defectpicture']['tmp_name'][$key], $add);
						chmod("$add",0777);					
						$pics .= $filename.",";
					}
				}
				
	 	Insert("product_complaint", array("customer_name" => $_POST['custname'], 
								"customer_contact" => $_POST['custcontact'],
								"fir_no" 		=>  $firnum,
								"ptype"	=> $_POST['product_type'],
								"product_id" => $_POST['product'],
								"mfg_date" => date('Y-m-d H:i:s',strtotime($_POST['mfgdate'])), 
								"batch_no" => $_POST['batchno'], 
								"sterilization_load_no" => $_POST['sterilization'], 
								"dateofincident" => date('Y-m-d H:i:s',strtotime($_POST['dateofincident'])), 
								"defective_no" => $_POST['numberofdefective'], 
								"tpl_person" => $_POST['service_engineers'], 
								"description" => $_POST['complaintdesc'], 
								"pictures" => $pics,
								"defect_noticed" => $_POST['complaintdesc'],
								"microbial_contamination" => $_POST['microbial'],
								"sheet_rupture" => $_POST['sheetrupture'],
								"tubekink" => $_POST['tubekink'],
								"leak" => $_POST['leak'],
								"status" => 1,
								"created_by" =>$_SESSION['id'],
								"created_date" => date('Y-m-d H:i:s')
								));
		$insertid=mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
		Insert("complaint_status", array("complaint_id" => $insertid, "current_status" => 12, "comment" => "Complaint registered", "updated_by" => $_SESSION['id'], "updated_date" => date('Y-m-d H:i:s')));
		 $sezoneid = $_SESSION['zoneid'];
		 $seared = $_SESSION['areaid'];
		 $ptype = $_POST['product_type'];
		 if($ptype==1){
		 	$grpname=COMPLAINT_BB_GROUP;
		 }else if($ptype==2){
			 $grpname=COMPLAINT_BBE_GROUP;		 
		 }else if($ptype==3){
			 $grpname=COMPLAINT_TCE_GROUP;		 
		 }else{
		 	$grpname=COMPLAINT_TCD_GROUP;
		 }
 		$mail_subject = SITE_NAME." - New complaint notification.";
	 
		foreach($complaint->getComplaintMailGroup($grpname) as $emailid){		
			$tomail = $emailid['email'];
			$toname = $emailid['first_name'];
			$message = " Dear  <b>Sir</b>,<br><br>";
			$message .= "New complaint have been placed in the site.<br> <br>"; 
			$message .=	"Click <a href='".HTTP_SERVER."complaints.php?id=".$insertid."'>here</a> to view.<br><br>";
			$message .=	 "Thanks<br>";
			$message .=	SITE_NAME;
			$mail->addContent("text/html",$message);
			$mail->addTo($tomail,$toname);
			prepare_new_mail_send($mail_subject, $tomail, $message, $toname);	
	 						
		} 
 		// $mail->Send();
		// prepare_new_mail_send($mail);

	 
		 messages("Complaint created successfully.");
		 reload('complaints.php'); 
		}
	
	}
 	$tpl -> Zone("defectpic", "enabled");	
	//Get Product type
	$q_ptype = Query("SELECT * FROM product_type");		
	while($r_ptype = FetchAssoc($q_ptype)) {
		$options[$r_ptype["id"]] = $r_ptype["name"];
	}
	$tpl -> AssignValue("select_producttype", createSelect("product_type", $options, '', 'class="listmenus" style="width:182px;"'));
	//Get service engineers
	$q_user = Query("SELECT u.*, t.* FROM user u, user_roles t WHERE t.roleID REGEXP '^12$' AND u.status REGEXP '1' AND u.id=t.userID");	
	$serviceengineers[''] ='Select Service Engineer';	
	while($r_user = FetchAssoc($q_user)) {
		$serviceengineers[$r_user["id"]] = $r_user["first_name"];
	}
	if(isset($_POST['service_engineers'])) {
	$tpl -> AssignValue("select_engineers", createSelect("service_engineers", $serviceengineers, $_POST['service_engineers'], 'class="listmenus" style="width:182px;"'));
	}else{
	$tpl -> AssignValue("select_engineers", createSelect("service_engineers", $serviceengineers, '', 'class="listmenus" style="width:182px;"'));
	}
	$defectnoticed[''] = '----Select----';
	$defectnoticed['Before opening PP cover'] = 'Before opening PP cover';
	$defectnoticed['While phlebotomy'] = 'While phlebotomy';
	$defectnoticed['During collection'] = 'During collection';
	$defectnoticed['During processing'] = 'During processing';
	$defectnoticed['During storage'] = 'During storage';
	
	$tpl -> AssignValue("select_defect", createSelect("defect_noticed", $defectnoticed, '', 'class="listmenus" style="width:275px;"'));
	
	$leak[''] = '----Select----';
	$leak['SAGM fill tube'] = 'SAGM fill tube';
	$leak['NHA tube'] = 'NHA tube';
	$leak['YC'] = 'YC';
	$leak['BOV sleeve'] = 'BOV sleeve';
	$leak['Any other joints'] = 'Any other joints';
	$tpl -> AssignValue("select_leak", createSelect("leak", $leak, '', 'class="listmenus" style="width:275px;"'));
	
	$tubekink[''] = '----Select----';
	$tubekink['Donor tube'] = 'Donor tube';
	$tubekink['Tr. Tube'] = 'Tr. Tube';
	$tubekink['Tube on sampling arm'] = 'Tube on sampling arm';
	$tubekink['SAGM soft tube of TAB bag'] = 'SAGM soft tube of TAB bag';
	$tubekink['Sleeve tube joint'] = 'Sleeve tube joint';
	$tpl -> AssignValue("select_tubekink", createSelect("tubekink", $tubekink, '', 'class="listmenus" style="width:275px;"'));
	
	$microbial[''] = '----Select----';
	$microbial['Noticed outside PP cover'] = 'Noticed outside PP cover';
	$microbial['Surface of bag'] = 'Surface of bag';
	$microbial['RBC storage'] = 'RBC storage';
	$microbial['Plasma storage'] = 'Plasma storage';
	$microbial['Platelet storage'] = 'Platelet storage';
	$tpl -> AssignValue("select_microbial", createSelect("microbial", $microbial, '', 'class="listmenus" style="width:275px;"'));
	
	$sheetrupture[''] = '----Select----';
	$sheetrupture['Centrifuge used'] = 'Centrifuge used';
	$sheetrupture['Hernia formation on primary bag'] = 'Hernia formation on primary bag';
	$sheetrupture['Hernia formation on Tr bag'] = 'Hernia formation on Tr bag';
	$sheetrupture['Hernia formation on platelet bag'] = 'Hernia formation on platelet bag';
	$sheetrupture['Pinhole on sheet along side seal of primary bag'] = 'Pinhole on sheet along side seal of primary bag';
	$tpl -> AssignValue("select_sheetrupture", createSelect("sheetrupture", $sheetrupture, '', 'class="listmenus" style="width:275px;"'));
	
	$tpl -> CleanTags(); 
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/complaint.js"></script> 
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
$(function() {
 	$.get('getproductname.php', {sel:$("#prodname").val()}, function(data) {
				$("#productname").html(data);					
		});
});
</script>
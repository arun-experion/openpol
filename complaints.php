<?php  
/**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya haridas 
 * @version			$Id: login.php  Monday, June 8, 2010, 11:47:41 PM $
 *		
 */
    include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	require(DIR_CLASSES . "search.php");
	$perm = array('access_admin','update_complaint_status','place_complaints','qa_reportupload','view_complaint');
	checkpermission($perm);
 	$myACL = new ACL();
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "complaints.tpl");
	require(DIR_CLASSES . "complaint.php");
	$complaint = new Complaint();	
	require(DIR_CLASSES . "class.phpmailer.php");
	include(DIR_FUNCTIONS . "mail.php");
	$mail = prepare_new_mail();
	
	//success message
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);
		$tpl -> Zone("success", "enabled");
	}
 	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
		if(isset($_POST['uploadreport']) && $_POST['uploadreport'] == 1) {
			 
		  if($_FILES['uploadfile']['name'] != '' ){	  
			   $file_extension= end(explode(".", $_FILES['uploadfile']['name']));
			   $extensions_allowed =ALLOWABLE_DOC_EXT ;
			  
			   if ((strpos($extensions_allowed, $file_extension)) === false) {
					$error['error.file_extension']='<li>'.INVALID_EXTENSION.'</li>'; 
				}	
				if(($_FILES['uploadfile']['size'] )> ALLOWABLE_DOC_SIZE){ 
					$docsize	=	ALLOWABLE_DOC_SIZE;
					$docsize	=	($docsize)/(1024*1024);
					$error['error.file'] = INVALID_FILE_SIZE." ".$docsize." MB";
				}			
		   }else{
		  		$error['error.file'] = EMPTY_BROCHURE;
		   }
		   
		   if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else {			
				$upload_file =$_FILES['uploadfile']['name'];
				$filename=str_replace(" ","_",$upload_file); 	
				$upload_path=COMPLAINT_QAREPORT_UPLOAD_PATH.$filename;
				copy($_FILES['uploadfile']['tmp_name'], $upload_path);			
				Insert("qa_complaintreport", array("cmp_id" => $_POST['cmpid'], 
											"report_path" => $filename,
											"updated_by" => $_SESSION['id'], 
											"updated_date" => date('Y-m-d H:i:s')
										));
				messages("Quality Report uploaded successfully.");
				reload("complaints.php?id=".$_GET['id']);
			}
		  
		
		}else{ 
		
 		 $required = array ("status" => '<LI>'.EMPTY_STATUS.'</LI>');
		 
			// while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.' . $key ] = $val ;
				}
			}
	
		if(isset($error)) {			
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
				$tpl -> Zone("error", "enabled");
			} else {	
				Insert("complaint_status", array("complaint_id" => $_POST['cmpid'], 
											"current_status" => $_POST['status'],
											"comment" => $_POST['comments'], 
											"updated_by" => $_SESSION['id'], 
											"updated_date" => date('Y-m-d H:i:s')
										));
				if($_POST['status'] ==13) {
				//close complaint
					$ptype = $_POST['product_type'];
					$cid = $_POST['cmpid'];
					 if($ptype==1){
						$grpname="BB complaint";
					 }else if($ptype==2){
						 $grpname="BBE complaint";		 
					 }else{
						$grpname="TTP complaint";
					 }
					$mail_subject = SITE_NAME." - Complaint closed notification.";
 					foreach($complaint->getComplaintMailGroup($grpname) as $emailid){		
						$tomail = $emailid['email'];
						$toname = $emailid['first_name'];
						$message = " Dear  <b>Sir</b>,<br><br>";
						$message .= "A Complaint have been successfuly closed.<br> <br>"; 
						$message .=	"Click <a href='".HTTP_SERVER."complaints.php?id=".$cid."'>here</a> to view.<br><br>";
						$message .=	 "Thanks<br>";
						$message .=	SITE_NAME;
						$mail->addContent("text/plain",$message);
						$mail->addTo($tomail,$toname);
						prepare_new_mail_send($mail_subject, $tomail, $message, $toname);	
						
					} 
				}
				messages("Complaint status updated successfully");				
				reload("complaints.php?id=".$_GET['id']);
			}
	   }
	}
	
	
	if(!isset($_GET['id'])) {
	
		if(isset($_GET['submit'])) {	
			if(isset($_GET['q'])) {
				$tpl -> AssignValue("custname", $_GET['q']);
			}				
			$searchFields = "customer_name";
			$condition = array();
			if(isset($_GET['firno']) && $_GET['firno'] !="") {				
				$condition['fir_no'] = $_GET['firno'];
			}
			$extracondition = "";
			if($_GET['from']!='' && $_GET['to'] !='') {
				$tpl -> AssignValue("from", $_GET['from']);
				$tpl -> AssignValue("to", $_GET['to']);
				$from = date('Y-m-d', strtotime($_GET['from']));
				$to = date('Y-m-d', strtotime($_GET['to']));
				$extracondition .=" DATE_FORMAT(created_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(created_date, '%Y-%m-%d') <=  '".$to."'";
				$tpl -> AssignValue("from", $_GET['from']);
				$tpl -> AssignValue("to", $_GET['to']);
			}
			$s = new search($searchFields, $condition, $extracondition);
			$query = "SELECT id, fir_no, customer_name, ptype, DATE_FORMAT( `created_date` , '%d/%m/%Y' ) AS created_date, tpl_person, created_by FROM `[x]product_complaint` " . $s->query . " ORDER BY id DESC" ;
					
		}else{
			$query ="SELECT id, fir_no, customer_name, ptype, DATE_FORMAT( `created_date` , '%d/%m/%Y' ) AS created_date, tpl_person, created_by  FROM `[x]product_complaint` ORDER BY id DESC";
		}
		$q = new splitResults($query);
		if(isset($_GET['page']) && $_GET['page'] !=1) {
			$i=(($_GET['page']-1)*10)+1;
		}else{
			$i=1;
		}
		
		if(Num($q->out))
		{	 
			while($r = FetchAssoc($q->out)){
			$r['slno'] = $i;
				if($i%2 ==0) {
					$r['class'] ="two";
				}else {
					$r['class'] ="one";
				}
				$service_engineer = getUserData($r['tpl_person']);
				$r['service_engineer'] = $service_engineer['first_name'];
				$created = getUserData($r['created_by']);
				$r['createdby'] = $created['first_name'];
			$complaints[] = $r;
			$i++;
			}
		$tpl -> Loop("complaints", $complaints);
		$tpl -> AssignValue("start", $q->start);
		$tpl -> AssignValue("end", $q->end);
		$tpl -> AssignValue("total", $q->total);
		$tpl -> AssignValue("split_results", $q->show());
		$tpl -> Zone("showlist", "enabled");	
			
		}else{
		$tpl -> Zone("showlist", "disabled");
		$tpl -> Zone("noresults", "enabled");
		$tpl -> AssignValue("total", 0);
		}	
	   if(isset($_SESSION['message'])) {
			$tpl -> AssignValue("message", $_SESSION['message']);	
			$tpl -> Zone("success", "enabled");
		}
		$tpl -> Zone("complaintlist", "enabled");	
		if($myACL->hasPermission('place_complaints')){
			$tpl -> Zone("addcomplaint", "enabled");	
		}	
	}else{
 		
		if($myACL->hasPermission('qa_reportupload')){
			$tpl -> Zone("qareport", "enabled");			
		}	
		
		$compid=$_GET['id'];
		$query = Query("SELECT id, cmp_id, report_path, DATE_FORMAT(`updated_date` , '%d/%m/%Y' ) AS updated_date, updated_by FROM `[x]qa_complaintreport` where cmp_id={$compid} ORDER BY id DESC");
		if(Num($query)) {
			while($report=FetchAssoc($query)){
				$report['filename'] = end(explode('/',$report['report_path']));
				$qaperson = getUserData($report['updated_by']);
				$report['qaperson'] = $qaperson['first_name'];
				$reports[]=$report;
			}
			$tpl -> Loop("qareports", $reports); 	
			$tpl -> Zone("qareportdownload", "enabled");
		}
		
		$result = FetchAssoc(Query("SELECT id, fir_no, customer_name, customer_contact, ptype, product_id, DATE_FORMAT( `mfg_date` , '%d/%m/%Y' ) AS mfg_date, DATE_FORMAT( `created_date` , '%d/%m/%Y' ) AS created_date, DATE_FORMAT( `dateofincident` , '%d/%m/%Y' ) AS dateofincident,batch_no, sterilization_load_no, defective_no,description, defect_noticed, pictures, microbial_contamination,sheet_rupture,tubekink,leak,status, tpl_person, created_by  FROM `[x]product_complaint` where id=".$_GET['id']));
		$tpl ->AssignArray($result);
		$service_engineer = getUserData($result['tpl_person']);
		$tpl -> AssignValue("tplperson", $service_engineer['first_name']);	
		$productresult = FetchAssoc(Query("SELECT name FROM product where id=".$result['product_id']));
		$tpl -> AssignValue("product", $productresult['name']);		
		$tpl -> Zone("viewcomplaint", "enabled");	
		$pics = explode(",",$result['pictures']);	
		$output = "";
		foreach($pics as $vals) {
			$output .= "<li class='picli'><a href='complaintpic.php?image=".$vals."&height=500&width=750' class='thickbox'>".$vals."</a></li>";
		}
		$tpl -> AssignValue("picturelinks", $output);	
		
		$allstatus = $complaint->getComplaintStatus($_GET['id']);	
 		$tpl -> Loop("complaintstatus", $allstatus); 
		
		if ($myACL->hasPermission('update_complaint_status') != true) { 
 			$tpl -> Zone("updatecomplaintstatus", "disabled");			 
		}else{ 
  			$options[0] = 'Select Status';
			$workflow = new Workflow();
			$status = $workflow->getcomplaintoptionlist($complaint->getcurrentcomplaintstatus($_GET['id']), $_SESSION['rid']);
    			if(is_array($status) && count($status) > 0) {
				foreach($status as $val) {
					$options[$val['id']] = $val['option'];			
				}
				$tpl -> AssignValue("select_status", createSelect("status", $options));	
				$tpl -> Zone("updatecomplaintstatus", "enabled");
			}else{
				$tpl -> Zone("updatecomplaintstatus", "disabled");
 			} 			
		}
 	 
	}
 	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript">

jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

$(function() {
			   
		var dates = $('#fromdate, #todate').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "fromdate" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
	
</script>
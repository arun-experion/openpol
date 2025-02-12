<?php  
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: brochure.php  Saturday, June 19, 2010, 04:00:00 PM $
 *		
 */
	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	//$perm = array('access_admin');
	//checkpermission($perm);
	// error_reporting(0);
	$tpl = new template();
	$tpl -> Load(TEMPLATE_PATH . "brochure.tpl");
    
	if(isset($_POST['action']) == 'upload'){
		$required = array ( "brochure_name"         => '<li>'. EMPTY_BROCHURE_NAME.'</li>',
							"brochure_description"  => '<li>'.EMPTY_BROCHURE_DESCRIPTION.'</li>'
								 
							);
		//  while (list($key, $val) = each($required)) {
			foreach($required as $key => $val) {
				if(isEmpty($key, $val)) {
					$error['error.'.$key ] = $val ;
				}
		 }
		 
		if($_FILES['uploadfile']['name'] == '' ){
			$error['error.nofile'] = '<li>'.EMPTY_BROCHURE.'</li>' ;
		}
			
	   if($_FILES['uploadfile']['name'] != '' ){	
			$file_parts = explode(".", $_FILES['uploadfile']['name']);   
			$file_extension = end($file_parts);
			$extensions_allowed =ALLOWABLE_DOC_EXT ;
			
		   if ((strpos($extensions_allowed, $file_extension)) === false) {
				$error['error.file_extension']='<li>'.INVALID_EXTENSION.'</li>'; 
			}
		
		}
	   if(($_FILES['uploadfile']['size'] )> ALLOWABLE_DOC_SIZE){ 
	   		$docsize	=	ALLOWABLE_DOC_SIZE;
			$docsize	=	($docsize)/(1024*1024);
			$error['error.file'] = INVALID_FILE_SIZE." ".$docsize." MB";
		}
		if(dupData("brochure", "name", $_POST['brochure_name'])){
			$error['error.file_duplicate'] = '<li>'.DUPICATE_FILE_NAME.'</li>';
	   }
	  
	  
		  if(isset($error)) {
				$tpl -> Zone("error", "enabled");
				$tpl -> AssignArray($error);
				$tpl -> AssignArray($_POST);
					 
		   }else {
					$tpl -> Zone("error", "disabled");
					$upload_file =$_POST['brochure_name'].".".$file_extension;
					$upload_path=BROCHURE_UPLOAD_PATH.$upload_file;
					copy($_FILES['uploadfile']['tmp_name'], $upload_path);
					$insert_brochure= array( "name"             => $_POST['brochure_name'],
											"description"       => $_POST['brochure_description'],
											"file_name"         => $upload_file,
											"uploaded_date"     => date('Y-m-d H:i:s') ,
											"uploaded_by"       => $_SESSION['id']
											); 
					Insert("brochure", $insert_brochure);
					
					messages(UPLOAD_BROCHURE_SUCCESSS);
			
		   }
	
	} 
    $query ="SELECT id,name,description,file_name,DATE_FORMAT(`uploaded_date` , ".SHORT_DATE."  ) AS uploaded_date 
	         FROM `[x]brochure` ORDER BY id DESC";
	if(isset($_POST['searchfile'])){
		if($_POST['searchfile'] == 'Search'|| $_POST['searchvalue']!=''){
			$searchvalue =$_POST['searchvalue'];
			$query ="SELECT id, name, description, file_name, DATE_FORMAT( `uploaded_date` , ".SHORT_DATE."  ) AS uploaded_date
                     FROM brochure WHERE name LIKE '$searchvalue%'";
	}
	
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
		$r['path'] = $r['file_name'];		
		$brochures[] = $r;
		$i++;
		}
		$tpl -> Loop("brochures", $brochures);
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
	}
	if($_SESSION['utype'] !="BA"){	 
	$tpl -> Zone("upload", "enabled");
	} 
	
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/brochure.js"></script>

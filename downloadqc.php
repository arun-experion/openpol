<?php  
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: downloadqc.php  WEDNESDAY, July 7, 2010, 04:00:00 PM $
 *		
 */
	//include("includes/initialize.php");
	
	include("includes/config.inc.php");	
	require(DIR_FUNCTIONS . "database.php");
	$id = $_GET['id'];
	$q= Query("SELECT file_name,order_id FROM `[x]qc_report` WHERE id='{$id}'");	
	$file_name=""; 
    if(Num($q)){
	  $r = FetchAssoc($q);		 	 
	  $file_name = $r['file_name'];
	  $order_id  = $r['order_id'];
	}
	$download_file = QC_REPORT_UPLOAD_PATH.$file_name;
	$file_extension= end(explode(".", $file_name));
	$file_extension=strtolower($file_extension);
	$file_name_download = str_replace(" ","_",$file_name);	
	 header("Cache-Control: public");
	 header('Cache-control: private');
	 header("Content-Description: File Transfer");
	 header("Content-Disposition: attachment; filename=$file_name_download");
	 header("Content-Transfer-Encoding: binary");
	 if($file_extension=="pdf"){
		header("Content-Type: application/pdf");
	 }else if($file_extension=="doc")
	 {
		header("Content-Type: application/ms-word");
	 }
	 else{
		header("Content-Type: application/octet-stream");
	 }
	 readfile($download_file);

?>

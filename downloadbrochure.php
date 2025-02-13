<?php  
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: downloadbrochure.php  TUESDAY, June 22, 2010, 01:00:00 PM $
 *		
 */
	//include("includes/initialize.php");
	
	include("includes/config.inc.php");	
    $download_file = BROCHURE_UPLOAD_PATH.$_GET['download_file'];
	$file_name = $_GET['download_file'];
 	
		$file_parts = explode(".", $file_name);
		$file_extension = end($file_parts);
		$file_extension=strtolower($file_extension);
	
		 header("Cache-Control: public");
		 header('Cache-control: private');
		 header("Content-Description: File Transfer");
		 header("Content-Disposition: attachment; filename=$file_name");
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

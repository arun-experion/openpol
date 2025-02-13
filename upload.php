<?php 
	include("includes/initialize.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	$uploaddir = QC_REPORT_UPLOAD_PATH; 
	if (!is_dir($uploaddir)) {
	    mkdir($uploaddir, 0755, true);
	}
	$file = $uploaddir . basename($_FILES['userfile']['name']); 
	$size=$_FILES['userfile']['size'];
	$order_id=$_REQUEST['id'];
    $uploadstatus = 1;
	$message['errortype']=0;
	$filename_parts = explode(".", basename($_FILES['userfile']['name']));
	$file_extension = strtolower(end($filename_parts));
	$extensions_allowed =ALLOWABLE_DOC_EXT ;	
	$message = [];
	$message['errortype']=0;
	  if(($_FILES['userfile']['size'] )> ALLOWABLE_DOC_SIZE){ 
			$message['filesize'] = INVALID_FILE_SIZE." ".ALLOWABLE_DOC_SIZE." bytes" ;
			$uploadstatus = 0;
			$message['errortype']=1;
		}

	   $file_parts=explode(".", basename($_FILES['userfile']['name']));
	   $file_extension= end($file_parts);
	   $extensions_allowed =ALLOWABLE_DOC_EXT ;
	  
	   if ((strpos($extensions_allowed, $file_extension)) === false) {
			$message['extension'] = INVALID_EXTENSION ;
			$message['errortype']=2; 
			$uploadstatus = 0;
	    }
		
	 if($uploadstatus==0){
		
		$message['upload_id'] = 0;
	 }else{
		$basename = basename($_FILES['userfile']['name']);
		$file= substr($basename,0,strrpos($basename,'.'));
		$end       = substr(strrchr($basename, "."), 1);
	 	$uploadfile = $file."_".date('d-m-Y H_i_s').".".$end;
		$uploadfilepath = $uploaddir.$uploadfile;
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfilepath)) {
			$insert_qc= array( "file_name"         => $uploadfile,
							  "order_id"           => $order_id,
							  "uploaded_date"      => date('Y-m-d H:i:s') ,
							  "uploaded_by"        => $_SESSION['id']
						     ); 
			Insert("qc_report", $insert_qc);
		    $id = mysqli_insert_id($GLOBALS["DB_CONNECTION"]);
			$message['upload_id'] = $id ;
			$uploadstatus =1;
		} 
	 
	 } 
	 echo json_encode($message); 
	 
	
?>
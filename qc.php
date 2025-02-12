<?php  
/**
 * TPL :: Order Management Software
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: qc.php  Saturday, July 7, 2010, 10:00:00 AM $
 *		
 */
	include("includes/initialize.php");
	require(DIR_CLASSES . "splitresults.php");
	include(DIR_FUNCTIONS . "formvalidation.php");
	$myACL = new ACL();
	
	$tpl = new template();
 	$tpl -> Load(TEMPLATE_PATH . "qc.tpl");
	if(isset($_GET['id'])){
		$order_id=$_GET['id'];
	}
	$file_types = ALLOWABLE_DOC_EXT;
	$file_types = str_replace(',','|',$file_types);
	$tpl -> AssignValue("filetypes",$file_types);	
	$tpl -> AssignValue("order_id",$order_id);	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	
    }
	$query =Query("SELECT id,file_name,DATE_FORMAT(`uploaded_date` , '%d-%m-%Y' ) AS uploaded_date 
	         FROM `[x]qc_report`  WHERE order_id=$order_id ORDER BY id DESC");
	$files[]='';
	   $i=1;
		while($r = FetchAssoc($query)){
		$r['slno'] = $i;
			if($i%2 ==0) {
				$r['class'] ="two";
			}else {
				$r['class'] ="one";
			}
		$r['path'] = $r['id'];
		$files[] = $r;
		$i++;
		}
    $total =$i-1;
	$tpl -> AssignValue("total",$total);		
	$tpl -> Loop("files", $files);
	if($myACL->hasPermission('upload_qc_report')){	 
		$tpl -> Zone("upload", "enabled");
	}
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	echo $tpl -> Flush(1);
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.4.1.min.js"></script>
<script type="text/javascript" src="js/qc.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript">
	// jQuery(function(){    
	$(document).ready(function(){   
	 var orderid = $('#order_id').val();
	 var button  = $('#uploadbutton'), interval;
	 var filetypes =  $('#filetypes').val();
	 var upload = new AjaxUpload(button, {
                        action: 'upload.php',
                        name: 'userfile',                        
                        autoSubmit: true,
                        responseType: 'json',
                        onChange: function(file, ext){
                        },
                        onSubmit: function(file, ext){
        			
							    this.setData({
                                     id : orderid
                                });                    
                        },
                        onComplete: function(file, response){
                            this.disable();
                            file_id =  response.upload_id ;
							if(parseInt(file_id)!=0){
								var row_id=$("#file_count").val();	
								var next_row_id = parseInt(row_id) + 1;
								$("#file_count").val(next_row_id);
								$.get('generatefilerow.php',{row_id:next_row_id,filename:file,id:file_id},function(data) {
									$("#file_"+row_id).after(data); 
								});
								$("#error_message").hide();	// add file to the list
								$("#message").html("Uploaded Successfully");
								this.enable();
							}else{
								   if(parseInt(response.errortype)!=0){
										$("#error_message").show();
										$("#error_message").addClass('error');
										if(parseInt(response.errortype)==1){
											$("#error_message").html(response.filesize);
										}
										else if(parseInt(response.errortype)==2){
											$("#error_message").html(response.extension);
										}
										$("#message").html("");
										this.enable();
								   }
								     								
							}	
						
                        }
                    });
        	});
    
</script>
 <style type="text/css">
        h1 {color: #C7D92C;	font-size: 18px; font-weight: 400;}
        a {	color: white;}
        a:hover, a.hover {color: #FFFFFF;}
        #text {	margin: 25px; }
        ul { list-style: none; }
        .example { padding: 0 20px; float: left; width: 230px; }
		.wrapper { width: 133px; margin: 0 auto; }
 </style>

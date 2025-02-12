<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: generatefilerow.php  Thursday, July 8, 2010, 12:40:00 PM $
 *		
 */
  
	include("includes/initialize.php");
    $next_rowid = $_GET['row_id'];
	$file_name  = $_GET['filename'];
	$filename  = explode(".",$file_name);
	$uploadfile = $filename[0]."_".date('d-m-Y H_i_s').".".$filename[1];
	$id         = $_GET['id'];
	if($next_rowid %2==0){
	$class = "two";
	}else{
	$class = "one";
	}
	$image = TEMPLATE_PATH."images/download.png";
    $output ="
	  <tr class=columnrow$class  id=file_$next_rowid>
	  <td class='columnborder'><table width='100%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			  <td class='formtext'>$next_rowid</td>
			</tr>
		</table></td>
		<td class='columnborder'><table width='100%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			  <td class='formtext'>$uploadfile</td>
			</tr>
		</table></td>
		 
		<td class='columnborder'><table width='100%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			  <td class='formtext'>
			  <a href='#' class='qcreport' id=$id  target='_self' >
			Download</a>
			 </td>
			</tr>
		</table></td>                                     
	  </tr>";

	echo $output;
?>
<script>
$('.qcreport').click(function() {
				
	var id=$(this).attr('id');
    document.location.href ="downloadqc.php?id="+id ;
						
}); 
var row_id=$("#file_count").val();
if(parseInt(row_id)!=0){
	$("#nofile").hide();
}else{
	$("#nofile").show();
}

</script>
<?php
include("includes/initialize.php");
	$output = '';
	if(isset($_GET['id']) && $_GET['id'] !='') {
 		$areaquery = Query("SELECT * FROM `[x]area` where zone_id=". $_GET['id']);	
 		$output .= '<select name="area"><option value="">---Select---</option>';
		while($arearesults = FetchAssoc($areaquery)) {
		
		$output .= '<option value="'.$arearesults["id"].'" ';
		
		if(isset($_GET['selected']) && $_GET['selected'] == $arearesults["id"]) {
			$output .=  "selected='selected'";
		}
		
		$output .= '>'.$arearesults["name"].'</option>';
		
 			//$output .= '<option value="'.$arearesults["id"].'">'.$arearesults["name"].'</option>';
		}
		$output .= '</select>';
	}else{
		$output .= '<select name="area"><option value="">---Select---</option></select>';
	}
	
 	echo $output;
 ?>
<?php
include("includes/initialize.php");
	$ids = explode(",", str_replace('"', '', rtrim(ltrim(stripslashes($_GET['id']), '['), ']'))) ;
	
	$output = '';
	if(count($ids) > 0){
		foreach ($ids as $zoneIds) {
			$areaquery = Query("SELECT * FROM `[x]area` where zone_id = ". $zoneIds);	
			while($arearesults = FetchAssoc($areaquery)) {
			
				$output .= '<span class="zone'. $zoneIds.'">';
				$output .= '<input type="checkbox" name="area[]" value="'.$arearesults["id"].'" ';
				
				if(isset($_GET['selected']) && in_array('"'.$arearesults["id"].'"', explode(",", rtrim(ltrim(stripslashes($_GET['selected']), '['), ']') ) )) {
					$output .=  "checked";
				}
				
				$output .= '> '.$arearesults["name"].'<br></span>';
				
			}
		}
	}
	
	echo $output;
 ?>
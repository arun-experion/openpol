<?php
include("includes/initialize.php");
	$output = '';
	if(isset($_GET['id']) && $_GET['id'] !='') {
 		$productquery = Query("SELECT * FROM `[x]product` where product_type_id=". $_GET['id']);	 		
	}else{
		$productquery = Query("SELECT * FROM `[x]product` where product_type_id=1");	
	}	
	$output .= '<select name="product" id="product" style="width:182px;" class="listmenus"><option value="">Select Product</option>';
	if(Num($productquery)) {
		while($productresults = FetchAssoc($productquery)) {
			$output .= '<option value="'.$productresults["id"].'" ';		
			if(isset($_GET['sel']) && $_GET['sel'] == $productresults["id"]) {
				$output .=  "selected='selected'";
			}		
			$output .= '>'.$productresults["name"].'</option>';		
 		}
	}	
	$output .= '</select>';
 	echo $output;
  ?>
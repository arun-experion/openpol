<?php
    /**
    * @category 		Business Associate Listing with ERP Number
    * @author			Abilash
    * @version			$Id: ajax_ba_search.php  FEB 17, 2022
    *		
    */
    include("includes/initialize.php");
	$output = '';
	if (isset($_POST['search_term'])) {
		$output         = '';
        $search_term    = $_POST['search_term'];
		$search_id   	= isset($_POST['search_id']) ? $_POST['search_id'] : '';
		$output         = '';
		$where          = '';
        $plist_id       = 1;
        if ($search_term !=""){
            $where = " AND (first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR erp_number LIKE '%{$search_term}%') ";
        } 

		if($search_id !=""){
			$where = " AND id='{$search_id}'";
		}
		
		$productquery = Query("SELECT u.id,u.first_name,u.last_name,u.erp_number, t.* FROM user u, user_roles t WHERE t.roleID REGEXP '^2$' AND u.status REGEXP '1' AND u.id=t.userID".$where);
		if (Num($productquery) > 0) {
			$output = '';
			$output .= "<div name='product_".$plist_id."' id='product_".$plist_id."'>";
			while($productresults = Fetch($productquery)) {
				$erp_number = '';
				if(!empty($productresults['erp_number'])){
					$erp_number = "(".$productresults['erp_number'].")";
				}
				$product_idx = $productresults['id']."_".$plist_id;
				$output .= "<span  id='".$product_idx."' class='plist_sp'>";
				$output .= $productresults['first_name']." ".$productresults['last_name']."".$erp_number;
				$output .= "</span>";

			}
			$output .= "</div>";

		} else {
			$output = '';
		}
    }
    echo $output;
?>
<script>
    //add class active
    
	$(document).ready(function() {
	
	$(".plist_sp").click(function () {
		$(".plist_sp").removeClass("active");
		$(this).addClass("active");   
		
		var code_list_id=$(this).attr('id');
		var getno = code_list_id.split('_');
		var list_id = getno[0];
		var inputTxt = $(this).text();
        $('#ba').val(list_id);
		$('#live_searchcategory').val(inputTxt);
        $('#category_result').css('display', 'none');
		
	});
});
</script>

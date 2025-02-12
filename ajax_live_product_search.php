<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: ajax_live_product_search.php  Friday, June 18, 2010, 02:00:00 PM $
 *		
 */
    include("includes/initialize.php");
	$output = '';
	if (isset($_POST['search_term']) && isset($_POST['product_type_id']) && isset($_POST['plist_id'])) {
		$output = '';
        $search_term = $_POST['search_term'];
        $product_type_id = $_POST['product_type_id'];
		$plist_id = $_POST['plist_id'];
		if ($product_type_id !="" && $plist_id !="") {
			$output = '';
			$where = '';
			if ($search_term !=""){
				$where = " AND (name LIKE '%{$search_term}%' OR code LIKE '%{$search_term}%') ";
			}
			
			$productquery = Query("Select * from product where status=1 AND product_type_id=".$product_type_id. $where);
			if (Num($productquery) > 0) {
				$output = '';
				$output .= "<div name='product_".$plist_id."' id='product_".$plist_id."'>";
				while($productresults = Fetch($productquery)) {
					$product_idx = $productresults['id']."_".$plist_id;
					$output .= "<span  id='".$product_idx."' class='plist_sp'>";
					$output .= $productresults['name']." (".$productresults['code'].")";
					$output .= "</span>";

				}
				$output .= "</div>";

			} else {
				$output = '';
			}
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
		var list_id = getno[1];
		var inputTxt = $(this).text();
		$('#live_searchproduct'+list_id).val(inputTxt);
        $('#search_result'+list_id).css('display', 'none');

		// var result_Div = $(this).parent().parent().find('.search_result');
		// result_Div.css('display', 'none');

		var product_id = getno[0];
		var pid = product_id;
		if(pid>0){
		$("#product_list_"+list_id).attr('style', 'border:0px solid red');}
	    $("#productid_"+list_id).val(pid);
		$.get('getproductcode.php?id='+product_id, function(data) {
		$("#productcode_"+list_id).html(data.code);	
		$("#price_"+list_id).val(data.rate);
		$("#carton_"+list_id).html(data.carton);
		$("#cartonvalue_"+list_id).val(data.carton);
		if(data.rate){
		$("#price_"+list_id).attr('class', 'rates');
		}
		var carton = $("#carton_"+list_id).text();
		var qty    =  $("#qty_"+list_id).val();
		$("#"+list_id).val(parseFloat(qty));
		if(!isNaN(qty)&&qty>0){
		var remdr =parseFloat(qty)%parseInt(carton);
		var product_type = $("#product_category").val();
		 $("#"+list_id).val(parseFloat(qty)); 
		if(carton!=0) {
			if(remdr!=0 && product_type==1){
				alert ("Please enter Quantity as any multiple of Carton");
				$("#qty_"+list_id).val('');
				$("#total_"+getno[1]).text('');
				$("#total_value").text('');		
				$("#qty_"+list_id).attr('class', 'qtyerror');
			}
		}
		
	    }
		newtotal=parseFloat($("#price_"+list_id).val()) * parseFloat($("#qty_"+list_id).val()) ;
		if(!isNaN(newtotal)){
			$("#total_"+list_id).text(newtotal);
		}else{
			$("#total_"+list_id).text('');
		}
		var total= 0;
		 $('.total').each(function () {
		  if(parseInt($(this).text())>0){
			 total =  parseFloat(total) + parseFloat($(this).text());
			}	
		 });
		 $("#total_value").text(total.toFixed(2));
		
		$("#addorder").show();					
		},'json');
	});
});
</script>

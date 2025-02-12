<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: getproduct.php  Friday, June 18, 2010, 02:00:00 PM $
 *		
 */
    include("includes/initialize.php");
	$output = '';
	$product_type_id=$_GET['product_type_id'];
	//$plist_id = $_GET['plist_id'];
	$plist_id =1;
	$productquery = Query("SELECT * FROM `[x]product` where product_type_id =".$product_type_id." AND status=1");	
	$output .= '<select name="product_'.$plist_id.'"    id="product_'.$plist_id.'"   value="" class="plist">';
	$output .= "<option value='0'>---Select product---</option>";
 	while($productresults = FetchAssoc($productquery)) {
		$productoptions[$productresults["id"]] = $productresults["name"];
		$output .= '<option value="'.$productresults["id"].'">'.$productresults["name"].'</option>';
	}
	$output .= '</select>';
	
    echo $output;
?>
<script>
$('.plist').change(function () {
   		product_id = {id:$(this).val()}
		var code_list_id=$(this).attr('id');
		var getno = code_list_id.split('_');
		var list_id = getno[1];
		var pid=$(this).val();
		if(pid>0){
		$("#product_list_"+list_id).attr('style', 'border:0px solid red');}
	    $("#productid_"+list_id).val($(this).val());
		$.get('getproductcode.php', product_id, function(data) {
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

</script>





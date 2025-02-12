<?php
 /**
 * TPL :: Order Management Software
 *
 * @copyright		Copyright (c) Terumo Penpol. All rights reserved.
 * @category 		Order Processing
 * @identity		Terumo Penpol is India's largest manufacturer of Blood Bags. This web portal would help order management. 
 * @author			Vidhya
 * @version			$Id: generateproduct.php  Friday, June 18, 2010, 09:00:00 AM $
 *		
 */
  
	include("includes/initialize.php");
    $next_divid = $_GET['div_id'];
	if(isset($_GET['type']))
	{
	$product_type_id = $_GET['type'];
	}
	$options[0]	='---Select product---';
	if($product_type_id>0){
	$q_ptype = Query("Select * from product where status=1 AND product_type_id=".$product_type_id );
	while($r_ptype = FetchAssoc($q_ptype)) {
				$options[$r_ptype["id"]] = $r_ptype["name"];
			}
	
	}
	$select_product = createSelect("product_".$next_divid, $options,'',"class='plist'");
	$image='';			
	if($next_divid!=1){			
	$image ="<img src=".TEMPLATE_PATH."images/remove.png class='remove' id=$next_divid>";
	}
    $output ="</tr>
              <tr class='whitecolumnrowone' id=productadd_$next_divid>
              <td class='columnborder'><table width='96%' border='0' cellspacing='10' cellpadding='0'>
              <tr> <td class='formtext'><span  class='productslno' id=productslno_$next_divid> </span> </td></tr></table></td>
              <td class='columnborder'><table width='100%' border='0' cellspacing='5' cellpadding='0'><tr>
			
			<td align='left'><div id=product_list_$next_divid class=productlist  >$select_product</div></td>
			</tr>
			</table></td>
			<td class='columnborder'><table width='100%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			<td class='formtext'>  <input type='hidden' name='product_id[]' class='code'  id=productid_$next_divid value='0'/><div id=productcode_$next_divid ></div></td>
			</tr>
			</table></td>
			<td align='center' class='columnborder'><table width='69%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			<td class='formtext'>
			
			<input name='carton_no[]' type='hidden' class='carton' id=cartonvalue_$next_divid  value='' /><div id=carton_$next_divid> </div>
			</td>
			</tr>
			</table></td>
			<td align='center' class='columnborder'><table width='69%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			<td class='formtext'><label>
			<input name='quantity[]' class='qty'  type='text' class='textboxsmall' id=qty_$next_divid />
			</label></td>
			</tr>
			</table></td>
			<td align='center' class='columnborder'><table width='69%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			<td class='formtext' valign='middle' ><label>
			 <input name='rate[]' type='text' class='rates' id='price_$next_divid' />
			</label></td>
			</tr>
			</table></td>
			<td class='columnborder'><table width='100%' border='0' cellspacing='10' cellpadding='0'>
			<tr>
			<td class='blacktextnormal' align='right'> 
			<input type='hidden' name='value[]'   value='{value}'/>
			<span   id='total_$next_divid' class='total'></span>
			</td>
			<td align='right' width='10%'>$image</td>
			</tr></table></td>
			";

	echo $output;
?>
<script type="text/javascript">
    
	var $j=1;
	$('.productslno').each(function (){ 
		var sl_id=$(this).attr('id');
		var getno = sl_id.split('_');
		var sl_no = getno[1];
		$("#productslno_"+sl_no).text($j);						 
		$j=$j+1;
	});

	$('.rates').keyup(function() {
		var rateid=$(this).attr('id');
		var rate=$(this).val();
		calculate_rate(rateid,rate);			
	});
	$('.rates').blur(function() {
		var rateid=$(this).attr('id');
		var rate=$(this).val();
		calculate_rate(rateid,rate);			
	});


   function calculate_rate(rateid,rate) { 
		var getno = rateid.split('_');
		var qty = $("#qty_"+getno[1]).val();
		
		if (isNaN(rate) || parseFloat(rate) <=0 ) {
			alert("Please enter a valid number");
			$("#"+rateid).val('');
			$("#"+rateid).attr('class', 'rateerror');			
		}else{
			$("#"+rateid).attr('class', 'rates');	
			$("#addorder").show();	 
		}
		
		if(parseInt(qty)>0 && parseInt(rate)>0)	{		
			var total = parseFloat(qty)*parseFloat(rate);
			if (!isNaN(total)) {
				$("#total_"+getno[1]).text(total.toFixed(2));
			} else {
				$("#total_"+getno[1]).text('');
			}
			var total_value = parseFloat($("#total_value").text());
			total_value = total_value + parseFloat(total.toFixed(2));
			if (!isNaN(total_value)){
				$("#total_value").text(total_value.toFixed(2));
			}		
		} else {
			$("#total_"+getno[1]).text('');			
		}
		
		var total= 0;
		 $('.total').each(function () {
			  if(parseFloat($(this).text())>0 && !isNaN(rate)) {
				 total =  parseFloat(total) + parseFloat($(this).text());
			   }	
		 });
		  
		 if (!isNaN(total)){
			$("#total_value").text(total.toFixed(2));
		 }
	} 
	 
	/*$('.qty').keyup(function() {
		var qtyid=$(this).attr('id');	
		var qty=$(this).val();
		calculate_quantity(qtyid,qty);	
	}); */
	

	
		$('.qty').blur(function() {
		var qtyid=$(this).attr('id');	
		var qty=$(this).val();
		calculate_quantity(qtyid,qty);	
	});

	function calculate_quantity(qtyid,qty) {

	    var getno = qtyid.split('_');
	    var productid = $("#productid_"+getno[1]).val();
		var carton = $("#carton_"+getno[1]).text();
		var product_type = $("#product_category").val();	
		if (productid==0) {
		        $("#qty_"+getno[1]).val('');
				$("#total_"+getno[1]).text('');
				$("#total_value").text('');
				alert ("please select a product");
				
		}else{
			var rate = $("#price_"+getno[1]).val();
			if (isNaN(qty) || parseFloat(qty) == 0) {
				alert("Please enter a valid number");
				$("#"+qtyid).val('');
				$("#"+qtyid).attr('class', 'qtyerror');				
			}else{
			    $("#"+qtyid).val(parseFloat(qty)); 
				var remdr =parseFloat(qty)%parseInt(carton);
		   if(remdr==0 || product_type!=1||carton==0){
					$("#"+qtyid).attr('class', 'qty');
					$("#addorder").show();
						
				if(parseFloat(qty)>0 && parseFloat(rate)>0)	{
					var total = parseFloat(qty)*parseFloat(rate);
					if (!isNaN(total)){
					$("#total_"+getno[1]).text(total.toFixed(2));
					}else{
					$("#total_"+getno[1]).text('');			
					}				
				}else{
					$("#total_"+getno[1]).text('');
				}
				
				var total= 0;
				$('.total').each(function () {
				  if(parseFloat($(this).text())>0 && !isNaN(rate)) {
					 total =  parseFloat(total) + parseFloat($(this).text());
				  }	
				});
				  
				if (!isNaN(total)){
					$("#total_value").text(total.toFixed(2));
				}
		}else{
					alert ("Please enter Quantity as any multiple of Carton");
					$("#"+qtyid).val('');
					$("#total_"+getno[1]).text('');
					$("#total_value").text('');		
					$("#"+qtyid).attr('class', 'qtyerror');
		}
				
						 
	  }
				
			
		}
	} 

	$("#payment_no").blur(function() {
		var paymentno = $(this).val();	
		if (paymentno=='') {
			   $(this).attr('class', 'noerror');
				
		}else{
			  $(this).attr('class', 'no');	
			  $("#addorder").show(); 
		}						   
	});
	
	$("#payment_amount").blur(function() {
		var payment_amount =$(this).val();	
		if (isNaN(payment_amount)) {
		    alert("Please enter a valid number");
			$(this).attr('class', 'amounterror');	
			$(this).val('');	   
		}else{
			 $(this).attr('class', 'amount');
			 $("#addorder").show();
		}						   
	} );

	$('.date-pick').change(function() {
		var paymentdate =$(this).val();	
		if (paymentdate) {
			  $(this).attr('style', '');
		}else{
			  $(this).attr('style', 'border:1px solid #FF0000');			  
		}						   
	});

	$('.remove').click(function(){
		var row_id = $(this).attr('id');
		var max_div_id = $("#product_count").val();
		if (row_id == max_div_id){
			max_div_id = max_div_id -1;
			$("#product_count").val(max_div_id);
		}
		
		$("#productadd_"+row_id).remove();
		$i=1;
		$('.whitecolumnrowone').each(function (){ 
			if($i%2 ==0){
				$(this).attr('style', 'background-color: #FFFFFF;');
			}else{
				$(this).attr('style', '');
			}
			$i=$i+1;
		});
			 
		var $j=1;
		$('.productslno').each(function (){ 
			var sl_id=$(this).attr('id');
			var getno = sl_id.split('_');
			var sl_no = getno[1];
			$("#productslno_"+sl_no).text($j);						 
			$j=$j+1;
		});
		
	 
		var total= 0;
		$('.total').each(function () {
		  if(parseInt($(this).text())>0){
			 total =  parseFloat(total) + parseFloat($(this).text());
			}	
		});
		$("#total_value").text(total.toFixed(2));			
		
	});

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
		if(!isNaN(qty)&&qty>0 ){
		var remdr =parseFloat(qty)%parseInt(carton);
		var product_type = $("#product_category").val();
		if (carton!=0){
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
	 
	 
	$("#bloodbagterms").click(function(){
		 if($("#bloodbagterms").attr("checked")){
		 	$("#bloodbagtermserror").text("");
			$("#addorder").show();
		 }
	
	});
	$("#eqpterms").click(function(){
		 if($("#eqpterms").attr("checked")){
		 	$("#eqptermserror").text("");
			$("#addorder").show();
		 }
	
	});
</script>

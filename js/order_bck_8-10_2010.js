$(function()
{ 
    var  current_div_id=$("#product_count").val();
	if(current_div_id==0) {
	var  div_id=$("#product_count").val();	
	var product_type = $("#product_category").val();
		$("#bloodbagtermschk").attr('style', 'display: none;');
		$("#eqptermschk").attr('style', 'display: none;');
		var next_div_id = parseInt(div_id) + 1;
		$("#product_count").val(next_div_id);
	    $.get('generateproduct.php',{div_id:next_div_id,type:product_type},function(data) {
		$("#productadd_"+div_id).after(data);
		});
		
	}
	$("#add_product").click(function(){
		
		var  div_id=$("#product_count").val();	
		var next_div_id = parseInt(div_id) + 1;
		$("#product_count").val(next_div_id);
		var product_type = $("#product_category").val();
		$("#total_row").val(next_div_id);
	    $.get('generateproduct.php',{div_id:next_div_id,type:product_type},function(data) {
			$("#productadd_"+div_id).after(data); 
			$i=1;
			$('.whitecolumnrowone').each(function (){ 
				if($i%2 ==0){
					$(this).attr('style', 'background-color: #FFFFFF;');
				}else{
					$(this).attr('style', '');
				}
				$i=$i+1;
			});
	    });
	
		
		});
	
	$("#addorder").click(function() {
			var errorflag=0;
			$('.rates').each(function () {
				var rate =   parseFloat($(this).val());
				if (isNaN(rate)) {
					$(this).attr('class', 'rateerror');
					errorflag=1; 
				}else{
					$(this).attr('class', 'rates');	 
				}				
			});  
			 
			$('.qty').each(function () {
				 var quantity =   parseFloat($(this).val());
				 if (isNaN(quantity)) {
					$(this).attr('class', 'qtyerror');
					errorflag=1; 
				 }else{
					$(this).attr('class', 'qty');	 
				 }			
			}); 
		
					
			$('.code').each(function () {
				var product_codes =$(this).val();	
				var product_id=$(this).attr('id');	
				var getno = product_id.split('_');
				var id = getno[1] ;
				
			  if(parseInt(product_codes) <= 0){
				 
			     $("#product_list_"+id).attr('style', 'border:1px solid red;');
				 errorflag=1;
			  }else{
				  
				$("#product_list_"+id).attr('style', 'border:0px solid red;');   
			   }
												  
			}); 
			
			   
			var  payment_no = $("#payment_no").val();
			var  paymentdate = $("#paymentdate").val();
			var  payment_amount = $("#payment_amount").val();
			
		
			if(payment_no == ""){		
				$("#payment_no").attr('class', 'noerror');
				errorflag=1;
			}else{
				$("#payment_no").attr('class', 'no');		
			}
			if(paymentdate == ""){
				$("#paymentdate").attr('style', 'border:1px solid #FF0000');	
				errorflag=1;
			}else{
				$("#paymentdate").attr('style', '');		
			}
			if (isNaN(payment_amount)|| parseFloat(payment_amount) <=0 || payment_amount=='' ){
			 	$("#payment_amount").attr('class', 'amounterror');
				$("#payment_amount").val('');
				errorflag=1;
			}else{	
			    
				$("#payment_amount").attr('class', 'amount');		
			}
			var product_type = $("#product_category").val();
			if(product_type==0){
				errorflag=1;	
				$("#product_type").attr('style', 'border:1px solid red;');	
			}else{
				
				$("#product_type").attr('style', 'border:0px solid black;');	
			}
			var credit = $("#credit").val(); 
			
			if(credit=='null'){
				$("#credit").attr('style', 'border:1px solid red;');
				errorflag=1;	
			}
			if(product_type==1){
				if(!$("#bloodbagterms").attr("checked")){
					$("#bloodbagtermserror").attr('class','errortext');
					$("#bloodbagtermserror").text("Please agree to the payment terms.");
					errorflag=1;
				}
			}else{
				if(!$("#eqpterms").attr("checked")){
					$("#eqptermserror").attr('class','errortext');
					$("#eqptermserror").text("Please agree to the payment terms.");
					errorflag=1;
				}
			}
			
			if(errorflag){
				alert("Please enter all required fields")
				$("#addorder").hide();	 
			}else{
				$("#addorder").show();	
				$("#order").submit();
			}
	
    });
		
 			   
 	$('#paymentdate, #prefered_date').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		numberOfMonths: 1,
		disabled: true
 	});
	
	$('.slno').each(function (){
		var slno= $(this).val();
		$('#deliverydate'+slno).datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true
 		});	
	})
	
	/*$('#status').change(function () {
		if($(this).val() == 7){
			$('#deliverydatesection').show();	
		}else{
			$('#deliverydatesection').hide();	
		}
	});*/
	
 
	
   $('.creditlist').change(function () {
				var creditval = $(this).val(); 
		if(creditval!='null'){
		$("#addorder").show();
		$("#credit").attr('style', 'border:0px solid black;');
		}
	});

	$('.ptype').change(function () {
		var type_id        =  $(this).attr('id');
		var type_value     =  $(this).val();
		if(type_value!=0){
		$("#addorder").show();
		$("#product_type").attr('style', 'border:0px solid black;');	
		}
		if(type_value==1){
		$("#bloodbagtermschk").attr('style', 'display: block;');	
		$("#eqptermschk").attr('style', 'display: none;');	
		}else{
		$("#bloodbagtermschk").attr('style', 'display: none;');	
		$("#eqptermschk").attr('style', 'display: block;');
		}
		var  div_id=$("#product_count").val();
		$("#addorder").show();
		if(div_id >1){
			if(confirm("Are you sure you want to reset form?")){
				redirect('order.php');	
			}else{
			   setproduct_type = $("#product_category").val();		
			   $("#product_type").val(setproduct_type);
		    }
		}else{
			$("#product_category").val(type_value);
			var option = { product_type_id:type_value};
			$.get('getproduct.php', { product_type_id:type_value},function(data) {
				var list_id=1;
				$("#product_list_"+list_id).html(data);
				$("#productcode_"+list_id).html('');
				$("#carton_"+list_id).html('');
				$("#qty_"+list_id).val('');
				$("#price_"+list_id).val('');
				$("#total_"+list_id).val('');
				$("#total_value").text('');
				$("#productid_"+list_id).val('0');
			});
		}
	});


 
});


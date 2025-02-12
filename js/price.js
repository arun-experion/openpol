$(document).ready(function() {
    $("#product_type").change(function() {
		var selected = $("#product_type option:selected");    
	    var output = "";
	    if(selected.val() != 0){
	        product_type_id = selected.val();
			quarter_id =  $("#quarter_id").val();
			action =  $("#action").val();
			document.location.href='price.php?product_type_id='+product_type_id+'&quarter_id='+quarter_id+'&action='+action;
	    }
        
    });
	
	var edper = $("#edpercent").val();
	var cstper = $("#cstpercent").val();
 
	
	$('.rateval').blur(function() {	
 		var rateid=$(this).attr('id');
		var getno = rateid.split('_');
			
				if (isNaN($(this).val()) || parseFloat($(this).val())<0) {
					alert('Please enter a valid number');
					$("#"+rateid).attr('class', 'mrperror');
					$("#submitbutton").hide();
				} else {
					$("#"+rateid).attr('class', 'mrp');
					$("#submitbutton").show();
					var val=$(this).val();
					var ed = (parseFloat(val)*parseFloat(edper))/100;
					var edfinal= parseFloat(ed)+parseFloat(val);
					if (isNaN(edfinal)){
						$("#ed_"+getno[1]).text('');
					}else{
						$("#ed_"+getno[1]).text(edfinal.toFixed(2));	
					}
					var cst_cal = (parseFloat(edfinal)*parseFloat(cstper))/100;					
					var cst=   parseFloat(cst_cal) + parseFloat(edfinal);
					if (isNaN(edfinal)){
						$("#cst_"+getno[1]).text('');
					}else{
						$("#cst_"+getno[1]).text(cst.toFixed(2));	
						
					}
					
				} 
	  });
	
	$('.mrp').blur(function() {
			var mrpid=$(this).attr('id');	
			var marp=$(this).val();
			var getno = mrpid.split('_');
			var hospval = $("#hosp_"+getno[1]).val();
			var product_type =$("#ptype").val();
			//alert(product_type);
			if (isNaN($(this).val()) || parseFloat($(this).val())<0) {
					alert('Please enter a valid number');
					$("#"+mrpid).attr('class', 'mrperror');
					$("#submitbutton").hide();
			}
			else if(parseInt(marp) < parseInt(hospval)) {
		 		alert('Please enter MRP greater than Hospital Price');	
				$("#"+mrpid).attr('class', 'mrperror');
				$("#submitbutton").hide();
			}else{
				 $("#submitbutton").show();
				$("#"+mrpid).attr('class', 'mrp');
				$("#hosp_"+getno[1]).attr('class','mrp');	
				$("#submitbutton").show();
			}
	 });
	
		$('.hosp').blur(function() {
			var hospid=$(this).attr('id');	
			var hosp=$(this).val();
			var getno = hospid.split('_');
			var mrpval = $("#mrp_"+getno[1]).val();
			
				if (isNaN($(this).val()) || parseFloat($(this).val())<0) {
					alert('Please enter a valid number');
					$("#"+hospid).attr('class', 'mrperror');
					$("#submitbutton").hide();
				}else if(parseInt(hosp) > parseInt(mrpval)) {
					alert('Please enter Hospital Price less than MRP');	
					$("#"+hospid).attr('class', 'mrperror');
					$("#submitbutton").hide();
				}else{
					$("#submitbutton").show();
					$("#"+hospid).attr('class', 'mrp');	
					$("#mrp_"+getno[1]).attr('class','mrp');
					$("#submitbutton").show();
				}
			
	 });
	$('.pricepdf').click(function() {
			
		var id=$(this).attr('id');
		document.location.href ="price_report.php?id="+id ;
					
	}); 
	
	
	$("#submitbutton").click(function() {
		var errorflag=0;
			 
		  $('.rateval').each(function () {
				var rate =   parseFloat($(this).val());
				if (isNaN(rate)) {
					$(this).attr('class', 'rateerror');
					errorflag=1; 
				}else{
					$(this).attr('class', 'rates');	 
				}				
			});
	
		 $('.hosp').each(function () {
				var rate =   parseFloat($(this).val());
				if (isNaN(rate)) {
					$(this).attr('class', 'rateerror');
					errorflag=1; 
				}else{
					$(this).attr('class', 'rates');	 
				}				
			}); 
		  $('.mrp').each(function () {
				var rate =   parseFloat($(this).val());
				if (isNaN(rate)) {
					$(this).attr('class', 'mrperror');
					errorflag=1; 
				}else{
					$(this).attr('class', 'mrp');	 
				}				
			});
	
	 		if(errorflag){
				alert("Please enter all required fields")
				$("#submitbutton").hide();	 
			}else{
				$("#submitbutton").show();	
				$("#price").submit();
			}
									  
	}); 								  
		
		
		
});


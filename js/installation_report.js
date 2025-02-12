$(function() {
		 $("#order_date").focus(function() {
		 		$(this).blur();
			});
		 $("#order_date").keyup(function() {
			  $(this).blur();
			  $(this).val('');
			 });
		 $("#end_date").keyup(function() {
		 	  $(this).blur();
			  $(this).val('');
			 });						   
									   
		 $("#end_date").focus(function() {
		 		$(this).blur();
			});
		  $("#no_equipments").hide();
		  $("#on_proccessing").hide();
		  var order_no = {id:$("#order_no").val(), selected:$("#productid").val()};
			if($("#order_no").val()){			  
		    //$("#name").val('');		
			//$("#address").html('');
			$("#order_date").val('');
			$("#epmnt_list").html('<select name="eqpmnt_id"  class="eqpmnt"  id="eqpmnt_id" style="width:180px;" ><option value="0">---Select---</option> </select>'); 		
			$.get('getorderdetails.php', order_no, function(data) {
				if(parseInt(data.no_equipments_status)>0){
				$("#no_equipments").show();
				$("#no_equipments").html(data.no_equipments);
				}
				if(parseInt(data.processing_status)>0){
				$("#on_proccessing").show();
				$("#on_proccessing").html(data.processing_stage);
				}
				$("#name").val(data.name);
				$("#address").html(data.address);
				$("#order_date").val(data.order_date);
				$("#epmnt_list").html(data.eqpmnt_list);
				
			},'json');

         }
			   
		$('#order_date, #invoice_date,#warranty_date').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1
			
		});
		
		
		var dates = $('#start_date, #end_date').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "start_date" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat,
				 selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
			
		});
		
 
           
          $("#order_no").blur(function() { 
			$("#no_equipments").hide();						   
		  var order_no = {id:$("#order_no").val(), selected:$("#productid").val()};
 		    $("#name").val('');		
			$("#address").html('');
			$("#order_date").val('');
			$("#epmnt_list").html('<select name="eqpmnt_id"  class="eqpmnt"  id="eqpmnt_id" style="width:180px;" ><option value="0">select</option> </select>'); 		
			$.get('getorderdetails.php', order_no, function(data) {
															
			    if(parseInt(data.no_equipments_status)>0){
				$("#no_equipments").show();
				$("#no_equipments").html(data.no_equipments);
				}
				if(parseInt(data.processing_status)>0){
				$("#on_proccessing").show();
				$("#on_proccessing").html(data.processing_stage);
				}
 				$("#name").val(data.name);
				$("#address").html(data.address);
				$("#order_date").val(data.order_date);
				$("#epmnt_list").html(data.eqpmnt_list);
				
			},'json');
	  });
	
     
 		
		
});




	
		
		
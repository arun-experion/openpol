$(function()
{  
	 	var dates = $('#mfgdate, #dateofincident').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "mfgdate" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	 
	$("#mfgdate").blur(function (){
		if($(this).val() != ""){
			$(this).attr("style","border:0px solid");	
		}
	});
 	
			
 	$("#product_type").change(function () {		
		option = {id:$(this).val()}
		$.get('getproductname.php', option, function(data) {
				$("#productname").html(data);					
		});
		if($(this).val()!=1) {
			$("#leaktr,#kinktr,#microbialtr,#rupturetr").hide();	
		}else{
			$("#leaktr,#kinktr,#microbialtr,#rupturetr").show();	
		}
	});
	
	var i=0;
	$("#addnewpic").click(function(){
		var currenttr = i+1;
		$("#pic"+i).after('</tr><tr id="pic'+currenttr+'"><td><input type="file" name="defectpicture[]"  id="defectpicture'+currenttr+'"/>&nbsp;&nbsp;<a href="javascript:void(0)" class="formtext" onclick="removefunction('+currenttr+')">Remove</a></td></tr>');
		i=i+1;		
	});	
		 
});
 
 function removefunction(id){
	$('#pic'+id).children().remove();
 }
 
 function resetfn(resetid){
 	$('#'+resetid).html('<input type="file" name="defectpicture[]"  id="defectpicture0"/>');
 }

 $('#status').change(function() {
		if($(this).val() == 17){				
			var cmp = $('#cmpid').val();
 			document.location.href ='request_replacement.php?id='+cmp;
		}
 }); 
 
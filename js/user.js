$(function()
{	
	 
	option = {id:$("#zoneval").val(),selected:$("#areaselected").val()}
	$.get('getarea.php', option, function(data) {
			$("#selectarea").html(data);					
	});
			
 	$("#zones").change(function () {
		$("#zoneval").val($(this).val());
		option = {id:$("#zoneval").val()}
			$.get('getarea.php', option, function(data) {
					$("#selectarea").html(data);					
			});
	});

	$(".zones").change(function () {
		if ($(this).is(":checked")) {
			$("#zoneval").val($(this).val());
			option = {id:$("#zoneval").val()}
				$.get('getarea.php', option, function(data) {
						$("#selectarea").append(data);					
				});
		} else {
			$("span").remove(".zone" + $(this).val());
		}
	});

	$('#usertype').css('width','180px');
	
	//New Field Integration Changes Added By Abilash ON FEB16-22
	$("#usertype").change(function () {
		val = $("#usertype").val();
		if(val == 2 || val == 47){
			
			$('#erpblock_field').show();
			$('#erpblock').show();
		} else {
		
			$('#erpblock_field').hide();
			$('#erpblock').hide();
		}
	});

	userType = $("#usertype").val();
	if(userType == 2 || userType == 47){
		$('#erpblock_field').show();
		$('#erpblock').show();
	} else {
		$('#erpblock_field').hide();
		$('#erpblock').hide();
	}
	 
});


































































































































































































































































































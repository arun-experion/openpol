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
		console.log('Change zone');
	});
	 
});
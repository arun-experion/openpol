$(function()
{	
    selected:$("#zones").val($("#zones").val());

	$("#zones").change(function () {
		var zone_id = $("#zones").val();
		var	product_type_id=$("#product_type").val();
		document.location.href ="dashboard.php?zone="+zone_id+"&product_type="+product_type_id;
		
	});
	
	$("#product_type").change(function () {
		var	product_type_id=$("#product_type").val();
		var zone_id = $("#zones").val();
		document.location.href ="dashboard.php?zone="+zone_id+"&product_type="+product_type_id;
	});
	 
	
});
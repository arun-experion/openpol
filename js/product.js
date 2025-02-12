$(function()
{
	if($("#product_type").val()>1)
	{
	$('#pcategory').hide();	 
	$("#weightrequired").attr('style', 'display: none;');
	$("#cartonrequird").attr('style', 'display: none;');
	}
	
	$("#product_type").change(function () {
								 
		 if($(this).val()>1)
		 {
			$('#pcategory').hide();	
			$("#weightrequired").attr('style', 'display: none;');
			$("#cartonrequird").attr('style', 'display: none;');
			
		 }else{
			 $('#pcategory').show();
			 $("#weightrequired").attr('style', '');
			 $("#cartonrequird").attr('style', ''); 
		}
		
		
		
		
	 });
});


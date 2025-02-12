$(function()
{
  $("#username").focus();	
	$("#forgotpass").click(function () {		 	 
		 $("#loginfeilds").hide();	
		$("#passwordforgot").show();
		$("#email").focus(); 	
		 $("#actions").val('forgotpass');
		  $(".error").html("");
	 });
	
	$("#loginlink").click(function () {										
		 $("#loginfeilds").show();	
		 $("#username").focus();
		$("#passwordforgot").hide();	
		 $("#actions").val('login');
		 $(".error").html("");
	 });
	
});

 
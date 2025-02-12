$(function()
{
	$(".deleteaction").click(function (event) {								 
		 
		var deleteconfirm = confirm("Do you want to delete this entry?");
		if (deleteconfirm== true)
		 {
		   window.location=$(this).attr('href');
		 }
		else
		 {
		 return false;
		 }
	});

});
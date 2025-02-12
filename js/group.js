
function moveoutid()
{
	var sda = document.getElementById('allusers');
	var len = sda.length;
 	var sda1 = document.getElementById('groupusers');
	for(var j=0; j<len; j++)
	{  
		if(sda[j] != null)
		{ 
			if(sda[j].selected)
			{ 
				var tmp = sda.options[j].text;
				var tmp1 = sda.options[j].value;
				sda.remove(j);
				j--;
				var y=document.createElement('option');
				y.text=tmp;
				y.value=tmp1;
				try
				{sda1.add(y,null);
				}
				catch(ex)
				{
				sda1.add(y);
				}
			}
		}
	}
}


function moveinid()
{
	var sda = document.getElementById('allusers');
	var sda1 = document.getElementById('groupusers');
	var len = sda1.length;
	for(var j=0; j<len; j++)
	{	
		if(sda1[j] != null)
		{
			if(sda1[j].selected)
			{
				var tmp = sda1.options[j].text;
				var tmp1 = sda1.options[j].value;
				sda1.remove(j);
				j--;
				var y=document.createElement('option');
				y.text=tmp;
				y.value=tmp1;
				try
				{
				sda.add(y,null);}
				catch(ex){
				sda.add(y);	
				}
	
			}
		}
	}	
}


$(function()
{ 
	$("#errormsg").hide();
	$("#addgroup").click(function() {
		var userid = "";								
		$("#groupusers option").each(function()
		{
			userid += $(this).val()+',';
		});
		$("#useridval").val(userid);
		var errorflag=0;
		var error ='';
		var gname = $("#name").val();
 		if($.trim(gname) =='') {		
			error += '<li>Group name required</li>';
			errorflag=1;
		}
		if(userid =='') {
			error += '<li>Please assign users to this group</li>';
			errorflag=1;
		}
		 
		
		if(errorflag) {
			$("#errormsg").show();
			$("#errormsg").html('');
			$("#errormsg").append(error);
		}else{
			$("#group").submit();	
		}
	});							  
								  
});
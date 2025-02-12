$('.qcreport').click(function() {
				
	var id=$(this).attr('id');
    document.location.href ="downloadqc.php?id="+id ;
						
}); 
var row_id=$("#file_count").val();
if(parseInt(row_id)!=0){
	$("#nofile").hide();
}else{
	$("#nofile").show();
}




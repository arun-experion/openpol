$('.download').click(function() {
				
	var id=$(this).attr('id');
    document.location.href ="downloadbrochure.php?download_file="+id ;
						
}); 

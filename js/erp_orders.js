$(document).ready(function () {
	

	/**
    * @category 		BA Search
    * @author			Abilash
    * @version			$Id: BA Search Changes ON FEB 17, 2022
    *		
    */
	$(".live_searchcategory").keyup(function () {
		
		var resultDiv = $(this).parent().find('.search_result_erp').last();
		$('.search_result_erp').css('display', 'none');
		var search_term = $(this).val().trim();

		if (search_term != "") {
			$.ajax({
				url: 'ajax_ba_search.php',
				method: 'POST',
				type: 'POST',
				data: {
					search_term: search_term,
				},
				success: function (data) {
					
					resultDiv.html(data);
					$('.search_result_erp').css('display', 'none');
					resultDiv.css('display', 'block');
					resultDiv.css('position', 'absolute');

					$(".live_searchcategory").focusin(function () {
						var result_Div = $(this).parent().find('.search_result_erp').last();
						result_Div.css('display', 'block');
						result_Div.css('position', 'absolute');

					});
				}
			});
		} 
		else {
		    
			resultDiv.css('display', 'none');
		}
	});

	ba 				=	$("#ba").val();
	search_term 	= 	'';
	var resultDiv 	= $(this).parent().find('.search_result_erp').last();
	$('.search_result_erp').css('display', 'block');
	if(ba != ''){
		$.ajax({
			url: 'ajax_ba_search.php',
			method: 'POST',
			type: 'POST',
			data: {
				search_term: search_term,
				search_id:ba
			},
			success: function (data) {
				$('.search_result_erp').html(data);
				
				$(".plist_sp").addClass("active");   
				var inputTxt = $(".plist_sp").text();
				$('#live_searchcategory').val(inputTxt);
        		$('#category_result').css('display', 'none');
			}
		});
	}
});
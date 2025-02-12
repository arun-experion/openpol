	$(function() {
		var dates = $('#start-date, #end-date').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "start-date" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
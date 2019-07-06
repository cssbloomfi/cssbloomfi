<script type="text/javascript">
$().ready(function() {

	$('.pick-date').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd",
			beforeShow: function() {$('#ui-datepicker-div').maxZIndex(); },
			showOn: 'button',
			buttonImage: '/../images/icons/calendar.gif',
			buttonImageOnly: true,
			buttonText:'Date Picker'
		});

	$('.xlss').click(function(){
			document.getElementById('REQUEST').value = 'xls';
		});

	$('.pdf').click(function(){
			document.getElementById('REQUEST').value = 'pdf';
		});
	

	$(".scheme_name").autocomplete("/ref/scheme/suggestschmnm", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		 minChars: 0,
		 //multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$(".scheme_id").autocomplete("/ref/scheme/suggestschmid", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		 minChars: 0,
		 //multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$(".customer_name").autocomplete("/ref/customer/suggestcustnm", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$(".customer_id").autocomplete("/ref/customer/suggestcustid", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$(".employee_id").autocomplete("/ref/employee/suggestempid", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$(".location").autocomplete("/ref/location/suggestloc1", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
});
</script>
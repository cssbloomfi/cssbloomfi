<script type="text/javascript">

function setThis(selectValue){
document.addTran.copyRow.value = selectValue;
}

$(document).ready(function() {
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

	$(".employee").autocomplete("/ref/employee/suggestempid", {
		width: 260,
		matchContains: true,
	//	mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$(".customer").autocomplete("/ref/customer/suggestcustid", {
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
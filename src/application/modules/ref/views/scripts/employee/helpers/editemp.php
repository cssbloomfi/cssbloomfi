
<script type="text/javascript">
 function delayRedirect(url){
	 var Timeout = setTimeout("window.location='" + url + "'",800);}

$().ready(function() {
	$('#pick-date1').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd",
			beforeShow: function() {$('#ui-datepicker-div').maxZIndex(); },
			showOn: 'button',
			buttonImage: '/../images/icons/calendar.gif',
			buttonImageOnly: true,
			buttonText:'Date Picker'
		});

	$("#empId").keyup(
		function()
		{
			var empId=document.getElementById('empId').value;
			var id=document.getElementById('id').value;
			var data=empId+'/'+id;
			callajax(data,'checkemp','/ref/employee/empchkajax');
		}
	);

	$("#employee_name").autocomplete("/ref/customer/suggestent", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars:0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>

<?php
$script='<script type="text/javascript">
	function cancel(){
	 self.location="'.$this->url.'";
	} </script>';
echo $script;
?>


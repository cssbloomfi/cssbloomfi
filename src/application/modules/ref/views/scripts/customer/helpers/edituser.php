
<script type="text/javascript">
     function delayRedirect(url)
     {
	 var Timeout = setTimeout("window.location='" + url + "'",1000);
     }

$().ready(function() {

	$('.pick-date1').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd",
			beforeShow: function() {$('#ui-datepicker-div').maxZIndex(); },
			showOn: 'button',
			buttonImage: '/../images/icons/calendar.gif',
			buttonImageOnly: true,
			buttonText:'Date Picker'
		});

	$("#custId").blur(
		function()
		{
			var custid=document.getElementById('custId').value;
			var id=document.getElementById('id').value;
			var data=custid+'/'+id;
			callajax(data,'checkcustid','/ref/customer/custchkajax');
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


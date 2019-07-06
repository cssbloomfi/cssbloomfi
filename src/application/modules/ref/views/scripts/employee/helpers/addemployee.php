<script type="text/javascript">

	$().ready(function() {
	$('#pick-date').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd",
			beforeShow: function() {$('#ui-datepicker-div').maxZIndex(); },
			showOn: 'button',
			buttonImage: '/../images/icons/calendar.gif',
			buttonImageOnly: true,
			buttonText:'Date Picker'
		});
		
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

	$("#empId").keyup(
		function()
		{
			var empid=document.getElementById('empId').value;
			callajax(empid,'checkemp','empchkajax');
		});

	});

	


</script>

<?php
$script='<script type="text/javascript">
		$(function(){
			$(".cancel").click(function(){
			 self.location="'.$this->url.'";
			});
		});'
		.
		'$(function(){
		$(".submit_data").click(function(){
			var val=document.getElementById('."'file'".').value.length;
			if(val==0){
			 ans=confirm("'.$this->confirmMsg['empAvatar'].'");
			 if(ans)
				return true;		
			 else
				return false;
			}
			})
		});'
		.'</script>';

echo $script;

?>


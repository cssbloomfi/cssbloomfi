
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

	$("#schmId").keyup(
		function()
		{
			var schmId=document.getElementById('schmId').value;
			callajax(schmId,'checkschm','schmchkajax');
		});
	});

</script>

<?php
$script='<script type="text/javascript">
	function cancel()
	     {
		window.location.href="'.$this->url.'";
	     }</script>';

echo $script;
?>
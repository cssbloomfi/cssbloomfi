<script language="JavaScript">
    function delayRedirect(url){
	 var Timeout = setTimeout("window.location='" + url + "'",1000);
	 }  
	 
	

	$().ready(function() {

	$("#schmId").keyup(
		function()
		{
			var schmId=document.getElementById('schmId').value;
			var id=document.getElementById('id').value;
			var data=schmId+'/'+id;
			callajax(data,'checkschm','/ref/scheme/schmchkajax');
		}
	);

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

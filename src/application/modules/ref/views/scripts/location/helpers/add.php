<script type="text/javascript">

$().ready(function() {

	$("#locId").ready(function(){
			document.getElementById("locId").focus();
	});

	$("#parent").autocomplete("/ref/location/suggestloc", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#locId").blur(
		function()
		{
			var locId=document.getElementById('locId').value;
			callajax(locId,'checkloc','locchkajax');
		});
		
});

</script>

<?php
$script= '<script type="text/javascript">

 function cancel()
	     {
		window.location.href="'.$this->url.'";
	     }</script>';

echo $script;
?>


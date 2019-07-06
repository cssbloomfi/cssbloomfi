<script type="text/javascript">
    function delayRedirect(url){
	 var Timeout = setTimeout("window.location='" + url + "'",1000);
	 }   

$().ready(function() {

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
			var id=document.getElementById('id').value;
			var data=locId+'/'+id;
			callajax(data,'checkloc','/ref/location/locchkajax');
		}
	);

	$("#parent_loc").autocomplete("/ref/location/suggestloc", {
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

<?php
$script= '<script type="text/javascript">
 function cancel()
	     {
		window.location.href="'.$this->url.'";
	     }</script>';

echo $script;
?>

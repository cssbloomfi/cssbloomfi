

<script type="text/javascript">

$().ready(function() {
	$("#param1").autocomplete("/adm/useraccesscontrol/suggestuserid", {
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
$(function(){
	$(".cancel").click(function(){
	 self.location="'.$this->url.'";
	});
});
</script>'; 

echo $script;
?>



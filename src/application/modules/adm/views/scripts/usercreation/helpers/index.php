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
$msg1=$this->messages['confirm'];
$msg2=$this->messages['notselected'];

$script=<<<SCRIPT
<script type="text/javascript">
$(function(){
	$("#delete_icon").click(function(){
		var ans,i,j;
		var len=parseInt(document.getElementById("ttlfields").value);
		var ckecked=false;

		if(len>1)
		for(i=0;i<len;i++)
		{

			if(document.deleteForm.appuserid[i].checked==true)
			 {
			   ans=confirm("$msg1");
			   if(ans)
				return true;
			   else
				return false;
			 }
		}else
		{
			if(document.deleteForm.appuserid.checked==true)
			 {
			   ans=confirm("$msg1");
			   if(ans)
				return true;
			   else
				return false;
			 }
		}
	   alert("$msg2");
	   return false;
	});
});
</script> 

SCRIPT;
echo $script;
?>
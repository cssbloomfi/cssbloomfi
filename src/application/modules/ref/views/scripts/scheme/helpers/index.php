
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

	$("#scheme_name").autocomplete("/ref/scheme/suggestschmnm", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		 minChars: 0,
		 //multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#scheme_id").autocomplete("/ref/scheme/suggestschmid", {
		width: 170,
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
$msg1=$this->confirmMsg['confirm'];
$msg2=$this->confirmMsg['notselected'];

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
			if(document.deleteForm.schmid[i].checked==true)
			 {
			   ans=confirm("$msg1");
			   if(ans)
				return true;
			   else
				return false;
			 }
		}else
		{
			if(document.deleteForm.schmid.checked==true)
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


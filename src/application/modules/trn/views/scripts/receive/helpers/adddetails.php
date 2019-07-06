<script type="text/javascript">
   $(function(){
	$(".cancel").click(function(){
	 self.location="/trn/receive";
	});
   });

  function getInfo(value)
  {
	 var voucherValue;
	 if(value=="") voucherValue=" ";
	 else voucherValue=value; multiAjaxCaller(array(value,'custtrninfo','trninfoajax'),array(value,'trnidresult','trninfooncidajax'))
  }
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
			if(document.deleteForm.tdid[i].checked==true)
			 {
			   ans=confirm("$msg1");
			   if(ans)
				return true;
			   else
				return false;
			 }
		}else
		{
			if(document.deleteForm.tdid.checked==true)
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

<script type="text/javascript">

$().ready(function() {

	$("#memo").keyup(function(){
		var memo=document.getElementById('memo').value;
	callajaxloading(memo,'checkmemo','memochkajax');
	});

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


	$(".employee").autocomplete("/ref/employee/suggestempid", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#customer").autocomplete("/ref/customer/suggestcustid", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#customer").blur(function(){
	});

	/*
	var a = gup('cust');
	$("#transaction").autocomplete("/trn/receive/suggesttrnsoncust?cust="+a, {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 4,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	*/
		
});

function enableScheme()
{
	var customer=document.getElementById('customer').value;
	var memo=document.getElementById('memo').value;
	var voucher=document.getElementById('summaryid').value;
	if(customer!='' && memo!='' && voucher=='default')
		document.getElementById('scheme_id').disabled = false;
	else
		document.getElementById('scheme_id').disabled = true;
}

</script>
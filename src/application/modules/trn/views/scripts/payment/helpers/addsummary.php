<script type="text/javascript">

function getValueAndSend(){
	var scheme_id=document.getElementById('scheme_id').value;
	sendFormValueForScheme(scheme_id);
}

function sendFormValuesForCust(path){
	var customer=document.getElementById('customer').value;
	var scheme_id=document.getElementById('scheme_id').value;
	multiAjaxCaller(array(customer,'custtrninfo',path),array(customer,'trnidresult','pymntdtlsajax'));
	sendFormValues(customer,scheme_id);
}


$(document).ready(function() {

	$("#voucher").keyup(function(){
		var voucher=document.getElementById('voucher').value;
	multiAjaxCaller (array(voucher,'checkvoucher','vchrchkajax'));
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


	$("#employee").autocomplete("/ref/employee/suggestempid", {
		width: 260,
		matchContains: true,
	//	mustMatch: true,
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

$script='<script type="text/javascript">
$(function(){
	$(".cancel").click(function(){
	 self.location="'.$this->url.'";
	});
});
</script>'; 
echo $script;


$script='<script type="text/javascript">'."
function sendFormValues(customer,scheme_id){

	var amount=document.getElementById('amount').value;
	var param=customer+ '/' +scheme_id;
	multiAjaxCaller(array(param,'checkscheme','".$this->checkSchmAjxPath."'),array(scheme_id,'maxschemeamount','".$this->amountAjaxPath."')); 
	}
".'</script>'; 

echo $script;

$script='<script type="text/javascript">'."
function sendFormValueForScheme(scheme_id)
{
	multiAjaxCaller(array(scheme_id,'maxschemeamount','".$this->amountAjaxPath."')); 
}
".'</script>'; 

echo $script;


/*


*/
?>
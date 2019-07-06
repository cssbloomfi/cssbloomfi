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

	$("#customer_name").autocomplete("/ref/customer/suggestcustnm", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#customer_id").autocomplete("/ref/customer/suggestcustid", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#employee_name").autocomplete("/ref/employee/suggestempnm", {
		width: 170,
		matchContains: true,
		//mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#employee_id").autocomplete("/ref/employee/suggestempid", {
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


function initializeString($arr,$searchFormLabel)
	{
		$strObj=new Bloomfi_App_Ulibrary_StrPattern;
		$strObj->setPattern(null, ' and ');
		$strObj->setDataEmptyValidation();
		if(!empty($arr['cnm']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['custname']."</b> '".$arr['cnm']."'");
		if(!empty($arr['cid']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['custid']."</b> '".$arr['cid']."'");
		if(!empty($arr['enm']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['empname']."</b> '".$arr['enm']."'");
		if(!empty($arr['eid']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['empid']."</b> '".$arr['eid']."'");
		if(!empty($arr['schm']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['schemeId']."</b> '".$arr['schm']."'");
		if(!empty($arr['param1']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['schemeType']."</b> '".$arr['param1']."'");
		if(!empty($arr['vchr']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['voucherNo']."</b> '".$arr['vchr']."'");
		if(!empty($arr['strdt']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['startDate']."</b> '".$arr['strdt']."'");
		if(!empty($arr['enddt']))$strObj->insertDataToPattern('<b>'.$searchFormLabel['endDate']."</b> '".$arr['enddt']."'");
		$string=$strObj->isExistPatternString();
		if($string) $strObj->preAddToStringDirect("The Search Result is based on ");
		else $strObj->preAddToStringDirect("The Search Result is based on no params");
		$string=$strObj->getPatternString();
		unset($strObj);
		return $string;
	}
?>
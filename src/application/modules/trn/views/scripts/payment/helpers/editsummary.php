<script type="text/javascript">


function getValueAndSend(){
	var customer=document.getElementById('customer_name').value;
	var scheme_id=document.getElementById('scheme_id').value;
	sendFormValues(customer,scheme_id);
}

function sendFormValuesForCust(path){
	var customer=document.getElementById('customer').value;
	var scheme_id=document.getElementById('scheme_id').value;
	multiAjaxCaller (array(customer,'custtrninfo',path),array(customer,'trnidresult','pymntdtlsajax'))
}

$().ready(function() {

	$('#pick-date1').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:"yy-mm-dd",
			beforeShow: function() {$('#ui-datepicker-div').maxZIndex(); },
			showOn: 'button',
			buttonImage: '/../images/icons/calendar.gif',
			buttonImageOnly: true,
			buttonText:'Date Picker'
		});


	$("#employee_name").autocomplete("/ref/employee/suggestempid", {
		width: 260,
		matchContains: true,
	//	mustMatch: true,
		minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

	$("#customer_name").autocomplete("/ref/customer/suggestcustid", {
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

$script='<script type="text/javascript">
	function cancel(){
	 self.location="'.$this->url.'";
	} </script>';
echo $script;

$script='<script type="text/javascript">'."
function sendFormValues(customer,scheme_id){

	var amount=document.getElementById('amount').value;
	var param=customer+ '/' +scheme_id;	multiAjaxCaller(array(scheme_id,'maxschemeamount','".$this->amountAjaxPath."')); 
	}
".'</script>'; 

echo $script;

?>
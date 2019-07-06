
<?php
class Zend_View_Helper_CustTrnInfo {
    function CustTrnInfo($result) {
		if($result) { 
			$num=new Bloomfi_NumericFormat;
			$totalReceipt=$result[0]->TOTAL_DETAILS-1;
			$tblstart='<table class="clean-table">';
			$tblend='</table>';
			$details='<tr><td>Voucher No</td><td> : <font color="#0066CC">' . $result[0]->VOUCHER_NO .'</font> </td><td> | Status</td><td> : <font color="#FF0000">'.$result[0]->ACTIVE_STATUS.'</font>  </td><td> | Last Update Date</td><td> : '.$result[0]->LATEST_DATE.'  </td></tr><tr><td>' .
				'Collector Code</td><td> : ' . $result[0]->EMPLOYEE_ID .' </td> <td> | ' .
				'Scheme Code</td><td> : '. $result[0]->SCHEME_ID. ' </td><td>  | ' .
				'Total Receipt(s)</td><td> : ' .$totalReceipt. ' </td></tr><tr>'.
				'<td> Payment Amount</td><td class="amount"> : <font color="#FF0000"><b>' . $num->numFormat($result[0]->TOTAL_PAYMENT_PRINCIPAL).'</b></font> </td><td> | ' . 'Receipt Amount</td><td class="amount"> : <font color="#339900"><b>' . $num->numFormat($result[0]->TOTAL_RECEIPT_PRINCIPAL).'</b></font></td><td>  | '.'Due Amount</td><td class="amount"> : <font color="#FF9900"><b>'.$num->numFormat($result[0]->TOTAL_RECEIPT_DUE_PRINCIPAL).'</b></font> </td></tr>';
			echo '<div class="cust-payment-info-details" >';
			echo $tblstart.$details.$tblend;
			echo '</div>';
			unset($num);
		}
	}
}
?>
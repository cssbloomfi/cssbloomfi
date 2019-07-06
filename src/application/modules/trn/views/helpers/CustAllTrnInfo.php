<?php
class Zend_View_Helper_CustAllTrnInfo {
    function CustAllTrnInfo($totalResult) {
		if($totalResult) { 
			$num=new Bloomfi_NumericFormat;
			$details=null;
			$tblstart='<table class="info-table-ajax">';
			$tblend='</table>';
			$i=1;
			foreach($totalResult as $result){
				$rim=$i%2;
			if($rim==0) $class="info-table-div-evenrow";
			else $class="info-table-div-oddrow";
			$i++;
			$details=$details.'<tr><td><div class="'.$class.'"><table class="clean-table1"><tr><td>' .
				'Voucher No</td><td> : <font color="#0066CC">' . $result->VOUCHER_NO .'</font> </td> <td> | ' .
				'Scheme Code</td><td> : '. $result->SCHEME_ID. ' </td><td> | Collector Code</td><td> : '.$result->EMPLOYEE_ID.'  </td></tr><tr>'.
				'<td> Payment Amount</td><td class="amount"> : <font color="#FF0000"><b>' . $num->numFormat($result->TOTAL_PAYMENT_PRINCIPAL).'</b></font> </td><td> | ' . 'Receipt Amount</td><td class="amount"> : <font color="#339900"><b>' . $num->numFormat($result->TOTAL_RECEIPT_PRINCIPAL).'</b></font> </td><td>  | '.'Due Amount</td><td class="amount"> : <font color="#FF9900"><b>'.$num->numFormat($result->TOTAL_RECEIPT_DUE_PRINCIPAL).'</b></font> </td></tr></table></div></td></tr>';
			}
			echo $tblstart.$details.$tblend;
			unset($num);
		}
	}
}
?>
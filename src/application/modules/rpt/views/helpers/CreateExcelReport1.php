
<?php
class Zend_View_Helper_CreateExcelReport1 {
    function createExcelReport1($header,$result) {
		$export_file = ROOT_DIR.'/tmp/excel/report1.xls';
		$excel=new Bloomfi_Excel_Excelwriter($export_file);
		if($excel==false)	
			echo $excel->error;	
		
		$excel->writeLine($header);

		foreach($result as $row )
			{
				 $datas=array($row->CUSTOMER_ID,$row->EMPLOYEE_ID,$row->SCHEME_ID,$row->TRANSACTION_ID,
					$row->FIRST_PAYMENT_DATE,$row->LAST_RECEIPT_DATE,$row->AGE_IN_DAYS,$row->TOTAL_RECEIPT,
					$row->PAYMENT_AMOUNT,$row->RECEIPT_AMOUNT,$row->DUE_AMOUNT);
				 $excel->writeLine($datas);
			}
		$excel->close();
			
		header ("Content-type: application/vnd.ms-excel");
		header ("Content-Disposition: attachment; filename=\"" . basename($export_file) . "\"" );
		readfile($export_file);
		exit;
	}
}
?>
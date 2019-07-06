
<?php
class Zend_View_Helper_CreateExcelReport1 {

    function createExcelReport1($filename,$header,$result)
	{
		$export_file = ROOT_DIR.'/tmp/excel/'.$filename.'.xls';
		$excel=new Bloomfi_Excel_Excelwriter($export_file);
		if($excel==false)
			echo $excel->error;
		if($header!=null)
		$excel->writeLine($header);
		if($result){
			foreach($result as $row ){
				$excel->writeLine($row);
			}
		}
		$excel->close();
		unset($excel);
		header ("Content-type: application/vnd.ms-excel");
		header ("Content-Disposition: attachment; filename=\"" . basename($export_file) . "\"" );
		readfile($export_file);
		exit;
	}

}
?>
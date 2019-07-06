
<?php
class Zend_View_Helper_CreateExcelReport {

    function createExcelReport($filename,$header,$result,$order_cols=null,$escape_cols=null) {
		set_time_limit(3600);
		$export_file = ROOT_DIR.'/tmp/excel/'.$filename.'.xls';
		$excel=new Bloomfi_Excel_Excelwriter($export_file);
		if($excel==false)
			echo $excel->error;
		if($header!=null)
		$excel->writeLine($header);
		if($result){
			if($order_cols==null) $keys=array_keys((array)$result[0]);
			else $keys=$order_cols;
			if($escape_cols!=null){
			foreach($keys as $key => $value)
				foreach ($escape_cols as $delete )
				if (trim($delete) == $keys[$key]){
					unset($keys[$key]);
					break;}
			}
			$i=1;
			foreach($result as $row ){
				//echo "Row : $i<br>";
				$datas=array();
				foreach($keys as $key)
					array_push($datas,$row->$key);
				$excel->writeLine($datas);
			//	echo "-------------------<br>";
				//print_r($datas);
			//	echo "<br>---------------------<br>";
			//	$i++;
			}
		}
		//die;
		$excel->close();
		unset($excel);
		header ("Content-type: application/vnd.ms-excel");
		header ("Content-Disposition: attachment; filename=\"" . basename($export_file) . "\"" );
		readfile($export_file);
		exit;
	}

}
?>
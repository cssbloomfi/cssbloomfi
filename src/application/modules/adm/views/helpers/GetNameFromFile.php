<?php
class Zend_View_Helper_GetNameFromFile {
	function GetNameFromFile($filename,$seperator='->'){
		$handle = @fopen($filename, "r");
		if ($handle) {
			while (!feof($handle)) {
				$buffer=fgets($handle,100000);
				$file=explode('->',$buffer);
				if(isset($file[1]))
					return trim($file[1]);
			}
			fclose($handle);
		}
		return null;
	}
}
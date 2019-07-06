
<?php
class Zend_View_Helper_SearchString {
    function SearchString($arr,$searchFormLabel){
		$strObj=new Bloomfi_App_Ulibrary_StrPattern;
		$strObj->setPattern(null, ' and ');
		$strObj->setDataEmptyValidation();
		foreach($arr as $key=>$value)
		if(!empty($value))$strObj->insertDataToPattern('<b>'.$searchFormLabel[$key]."</b> '".$value."'");
		$string=$strObj->isExistPatternString();
		if($string) $strObj->preAddToStringDirect("The Search Result is based on ");
		else $strObj->preAddToStringDirect("The Search Result is based on no params");
		$string=$strObj->getPatternString();
		unset($strObj);
		return $string;
	}
}
?>
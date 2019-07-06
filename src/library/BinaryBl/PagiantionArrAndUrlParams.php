<?php

class BinaryBl_PagiantionArrAndUrlParams extends Bloomfi_App_Ulibrary_StrPattern
{

	public function createArrAndUrlParams($params=null,$seperator='/',$stringSeperator='/')
	{
		if(!is_array($params)){
			$params=explode($seperator,$params);
		}
		$parray=array();
		$this->clearPattern();
		$this->setPattern(null,'/');
		$i=1;
		if($params)
		foreach($params as $param) {
			$this->insertDataToPattern('param'.$i);
			$this->insertDataToPattern($param);
			$parray=array_merge($parray,array('param'.$i=>$param));
			$i++; }
		$result['url_params']=$this->getPatternString();
		$result['array_params']=$params;
		$result['pagination_params']=$parray;
		$result['string_params']=$this->getStringParams($params,$stringSeperator);
		return $result;
	}

	public function getStringParams($params=null,$seperator)
	{
		$string=null;
		$sarray=array();
		$this->clearPattern();
		$this->setPattern(null,$seperator);
		foreach($params as $param)
			$this->insertDataToPattern($param);
		return $this->getPatternString();
		if(empty($string)) $string=$seperator;
		return $string;
	}
}

?>
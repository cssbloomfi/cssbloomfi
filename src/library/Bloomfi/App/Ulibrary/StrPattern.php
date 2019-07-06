<?php

class Bloomfi_App_Ulibrary_StrPattern extends ZendExtend_Url
{
	protected $_counter=0;
	protected $_seperator=null;
	protected $_string=null;
	protected $_setSeperator=null;
	protected $_diffSeperator=null;
	protected $_sym=null;
	protected $_check=false;

	public function clearPattern()
	{
		$this->_counter=0;
		$this->_seperator=null;
		$this->_string=null;
		$this->_setSeperator=null;
		$this->_sym=null;
		$this->_diffSeperator=null;
		$this->_check=false;
	}

	public function setPattern($type=null,$seperator=', ')
	{
		$this->_setSeperator=$seperator;
		$type=strtolower($type);
		if($type=='string')$this->_sym="'";
		else if ($type!=null){ echo "Only static value 'STRING' or NULL is allowed to pass as a first param";die(); }
	}

	public function insertDataToPattern($data,$string=null,&$count=null)
	{	
		if($this->_check==true){
			if(trim($data)==''){
			if($string)return $string;
			else return null;
		}}
		
			if($this->_counter > 0 && !$this->_seperator)$this->_seperator=$this->_setSeperator;
			$this->_string=$this->_string.$this->_seperator.$this->_sym.$data.$this->_sym;
			$this->_counter++;

			if($count>=0){
				if($count > 0 && !$this->_diffSeperator )$this->_diffSeperator=$this->_setSeperator;
				$string=$string.$this->_diffSeperator.$this->_sym.$data.$this->_sym;
				$count++;
				return $string;
			}
	}

	public function setDataEmptyValidation($check=true)
	{
		$this->_check=$check;
	}

	public function preAddToStringDirect($string)
	{
		$this->_string=$string.$this->_string;
	}

	public function isExistPatternString()
	{
		if($this->_string) return 1;
		else return 0;
	}

	public function postAddToStringDirect($string)
	{
		$this->_string=$this->_string.$string;
	}

	public function getPatternString()
	{
		return $this->_string;
	}

}
<?php

class Bloomfi_App_Ulibrary_ProcessTime extends Bloomfi_App_Ulibrary_StrPattern
{
	protected $_startTime=0;
	protected $_endTime=0;
	protected $_processingTime=0;
	protected $_tempTime=0;

	public function resetProcessing()
	{
		$this->_startTime=$this->_endTime=$this->_processingTime=0; 
	}

	public function startProcessing()
	{
		$this->_startTime=$this->_microtime_float();
		$this->_tempTime=0;
	}

	public function endProcessing()
	{
		$this->_endTime=$this->_microtime_float();
		$this->_tempTime=$this->_endTime-$this->_startTime;
		$this->_processingTime=$this->_processingTime+$this->_tempTime;
	}

	public function getProcessingTime($decimalValAll=null,$seconds=true)
	{
		$time=$this->_endTime-$this->_startTime;
		if($decimalValAll && is_integer($decimalValAll))
			$time=number_format($time,$decimalValAll,null,'');
		if(strtolower($seconds)==true) $time=$time." Second(s)";
		return $time;
	}

	public function getTotalProcessingTime($decimalValAll=null,$seconds=true)
	{
		$time=$this->_processingTime;
		if($decimalValAll && is_integer($decimalValAll))
			$time=number_format($time,$decimalValAll,null,'');
		if(strtolower($seconds)==true) $time=$time." Second(s)";
		return $time;
	}

	public function printProcessingTime($return=true)
	{
		$time=$this->_endTime-$this->_startTime;
		if(strtolower($return)==true)
			echo "[ Processing Time : $time Second(s) ]";
		if(strtolower($return)==false)
			return "[ Processing Time : $time Second(s) ]";
	}

	public function printTotalProcessingTime($return=true)
	{
		$time=$this->_processingTime;
		if(strtolower($return)==true)
			echo "[ Total Processing Time : $time Second(s) ]";
		if(strtolower($return)==false)
			return "[ Total Processing Time : $time Second(s) ]";
	}

	protected function _microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
}


<?php
class modules_com_transaction_totalTransaction extends modules_com_transaction_AbstractTransactionComponent
{

	public function __construct()
	{
		 parent::__construct();
	}

	public function getTotalTrnInfo()
	{
		$caption="Total Transaction";
		$result=$this->_trnModel->getTotalTrnQuery();
		$comp['component']=array('result'=>$result);
		$comp['title']=$caption;
		return $comp;
	}

	public function destroy()
	{
		unset($this->_trnModel,$this->_chartModel);
	}

}
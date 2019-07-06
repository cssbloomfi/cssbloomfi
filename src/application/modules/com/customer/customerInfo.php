<?php
class modules_com_customer_customerInfo extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function getCustomerInfo()
	{
		$result1=$this->_custModel->getTotalCustomerQuery();
		$result2=$this->_custModel->getTotalLoanCustomerQuery();
		$comp['component']=array('result1'=>$result1,'result2'=>$result2);;
		$comp['title']=null;
		return $comp;
	}
	
	public function destroy()
	{
		unset($this->_custModel,$this->_chartModel);
	}
	
}
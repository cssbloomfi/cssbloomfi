<?php

class modules_com_customer_totalCustVsPaymntDisburse extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function totalCustVsPaymntDisburse($id="totalCustVsPaymntDisburse",$width=null,$height=null)
	{
		$caption="Total Beneficiary vs Payment Disburse";
        $labelvalue=array('CUSTOMER','TOTAL');
		$result=$this->_custModel->getTotalCustVsPaymntDisburseQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue,true);
		$comp['component']=$this->_chartModel->renderColumn3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;
	}

	public function destroy()
	{
		unset($this->_custModel,$this->_chartModel);
	}

}
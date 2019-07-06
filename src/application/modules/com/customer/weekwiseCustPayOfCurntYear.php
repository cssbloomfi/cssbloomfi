<?php

class modules_com_customer_weekwiseCustPayOfCurntYear  extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function weekwiseCustPayOfCurntYear($id="WeekwiseCustomerPayment",$width=null,$height=null)
	{
		$caption="Beneficiary payments for this week";
        $labelvalue=array('START_DATE','CUSTOMERS');
		$result=$this->_custModel->getCurrentWeekwiseCustPaymentOfYearQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue);
		$comp['component']=$this->_chartModel->renderPie2D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;
	}

	public function destroy()
	{
		unset($this->_custModel,$this->_chartModel);
	}

}
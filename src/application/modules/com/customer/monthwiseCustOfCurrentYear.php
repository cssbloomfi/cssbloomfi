<?php

class modules_com_customer_monthwiseCustOfCurrentYear  extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function monthwiseCustOfCurrentYear($id="MonthwiseCustomerEntry",$width=null,$height=null)
	{
		$current_year=date('Y');
		$caption=" Month wise beneficiary entries for ".$current_year;
        $labelvalue=array('MONTH','CUSTOMERS');
		$result=$this->_custModel->getMonthwiseCustomerOfYearQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue,true);
		$comp['component']=$this->_chartModel->renderPie3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;
	}


	public function destroy()
	{
		unset($this->_custModel,$this->_chartModel);
	}

}
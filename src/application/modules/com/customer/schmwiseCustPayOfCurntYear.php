<?php

class modules_com_customer_schmwiseCustPayOfCurntYear  extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function schmwiseCustPayOfCurntYear($id="schemewiseCustPaymentOfYearQuery",$width=null,$height=null)
	{
		//$current_year=date('Y');
		$caption="Project wise beneficiary payments of current year";
        $labelvalue=array('SCHEME_ID','CUSTOMERS');
		$result=$this->_custModel->getSchemewiseCustPaymentOfYearQuery($labelvalue);
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
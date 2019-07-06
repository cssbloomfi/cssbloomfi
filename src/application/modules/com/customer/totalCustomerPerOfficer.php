<?php

class modules_com_customer_totalCustomerPerOfficer extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function totalCustomerPerOfficer($id="totalCustomerPerOfficer",$width=null,$height=null)
	{

 		$caption="Total Beneficiary Per Loan Officer";
        $labelvalue=array('FIELD_OFFICER','TOTAL_CUSTOMER');
		$result=$this->_custModel->getTotalCustomerPerOfficerQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue);
		$comp['component']=$this->_chartModel->renderPie3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;

	}


	public function destroy()
	{
		unset($this->_custModel,$this->_chartModel);
	}

}
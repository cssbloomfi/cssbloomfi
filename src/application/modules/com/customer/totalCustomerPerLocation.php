<?php

class modules_com_customer_totalCustomerPerLocation  extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function totalCustomerPerLocation($id="totalCustomerPerLocation",$width=null,$height=null)
	{
		$caption="Total Beneficiary per Location";
        $labelvalue=array('LOCATION','TOTAL_CUSTOMER');
		$result=$this->_custModel->getTotalCustomerPerLocationQuery($labelvalue);
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
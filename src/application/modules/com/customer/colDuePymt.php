<?php
class modules_com_customer_colDuePymt extends modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function colDuePymt($id="asasas",$width=null,$height=null)
	{
		$caption="Collector Wise Total Due Payment";
		$labelvalue=array('CUSTOMER','TOTAL');
		$result=$this->_custModel->getColDuePymtQuery($labelvalue);
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
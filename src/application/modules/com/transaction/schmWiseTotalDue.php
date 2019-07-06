<?php
class modules_com_transaction_schmWiseTotalDue extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function schmWiseTotalDue($id="schmWiseTotalDue",$width=null,$height=null)
	{
		$caption=" Project wise total dues  ";
		$labelvalue=array('SCHEME','DUE');
		$result=$this->_trnModel->getSchmWiseTotalDueQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue);
		$comp['component']=$this->_chartModel->renderPie3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;
	}
	
	public function destroy()
	{
		unset($this->_trnModel,$this->_chartModel);
	}
}
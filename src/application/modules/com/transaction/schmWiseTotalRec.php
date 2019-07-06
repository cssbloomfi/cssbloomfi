<?php
class modules_com_transaction_schmWiseTotalRec extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function schmWiseTotalRec($id="schmWiseTotalRec",$width=null,$height=null)
	{
		$caption=" Project Wise Total Receipt  ";
		$labelvalue=array('SCHEME','RECEIPT');
		$result=$this->_trnModel->getSchmWiseTotalRecQuery($labelvalue);
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
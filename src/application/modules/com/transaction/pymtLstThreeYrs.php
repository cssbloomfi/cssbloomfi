<?php
class modules_com_transaction_pymtLstThreeYrs extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_trnModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function pymtLstThreeYrs($id="pymtLstThreeYrs",$width=null,$height=null)
	{
		$caption=" Payment for last three years  ";
		$labelvalue=array('YEAR','PAYMENT');
		$result=$this->_trnModel->getPymtLstThreeYrsQuery($labelvalue);
		$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue);
		$comp['component']=$this->_chartModel->renderColumn3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;
	}
	
	public function destroy()
	{
		unset($this->_trnModel,$this->_chartModel);
	}
	
}
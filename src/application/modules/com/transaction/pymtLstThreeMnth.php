<?php
class modules_com_transaction_pymtLstThreeMnth extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function pymtLstThreeMnth($id="pymtLstThreeMnth",$width=null,$height=null)
	{
		$caption=" Payment for last three months  ";
		$labelvalue=array('MONTH','PAYMENT');
		$result=$this->_trnModel->getPymtLstThreeMnthQuery($labelvalue);
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
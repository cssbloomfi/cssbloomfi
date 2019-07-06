<?php
class modules_com_transaction_lstMnthCollWisePayment extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function lstMnthCollWisePayment($id="lstMnthCollWisePayment",$width=null,$height=null)
	{
		$caption=" Last month collector wise total payment  ";
		$labelvalue=array('COLLECTOR','PAYMENT');
		$result=$this->_trnModel->getLstMnthCollWisePayment($labelvalue);
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
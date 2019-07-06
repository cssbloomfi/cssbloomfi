<?php
class modules_com_transaction_lstMnthSchmWisePayment extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function lstMnthSchmWisePayment($id="lstMnthSchmWisePayment",$width=null,$height=null)
	{
		$caption=" Last month project wise total payment  ";
		$labelvalue=array('PROJECT','PAYMENT');
		$result=$this->_trnModel->getLstMnthSchmWisePayment($labelvalue);
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
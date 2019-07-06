<?php
class modules_com_transaction_lstMnthSchmWiseReceipt extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function lstMnthSchmWiseReceipt($id="lstMnthSchmWiseReceipt",$width=null,$height=null)
	{
		$caption=" Last month project wise total installment  ";
		$labelvalue=array('PROJECT','RECEIPT');
		$result=$this->_trnModel->getLstMnthSchmWiseReceipt($labelvalue);
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
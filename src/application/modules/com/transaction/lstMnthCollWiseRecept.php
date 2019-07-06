<?php
class modules_com_transaction_lstMnthCollWiseRecept extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function lstMnthCollWiseRecept($id="lstMnthCollWiseRecept",$width=null,$height=null)
	{
		$caption=" Last month collector wise total installment  ";
		$labelvalue=array('COLLECTOR','RECEIPT');
		$result=$this->_trnModel->getLstMnthCollWiseRecept($labelvalue);
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
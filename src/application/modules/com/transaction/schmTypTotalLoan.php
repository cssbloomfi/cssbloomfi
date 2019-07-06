<?php
class modules_com_transaction_schmTypTotalLoan extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function schmTypTotalLoan($id="schmTypTotalLoan",$width=null,$height=null)
	{
		$caption=" Project type wise total loan  ";
		$labelvalue=array('SCHEME_TYPE','LOAN');
		$result=$this->_trnModel->getschmTypTotalLoanQuery($labelvalue);
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
<?php 
	class modules_com_transaction_payReceptDueCurrentYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function payReceptDueCurrentYear($id="payReceptDueCurrentYear",$width=null,$height=null)
		{
			$caption=" Total payment recept due of current year  ";
			$labelvalue=array('AMOUNT','SUM_COLUMN');
			$result=$this->_trnModel->getPayReceptDueCurrentYearQuery($labelvalue);
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
?>
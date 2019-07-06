<?php 
	class modules_com_transaction_payReceptCurrentWeek extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function payReceptCurrentWeek($id="payReceptCurrentWeek",$width=null,$height=null)
		{
			$caption=" Total payment and recept of current week ";
			$labelvalue=array('PAYMENT','Week');
			$result=$this->_trnModel->getPayReceptCurrentWeekQuery($labelvalue);
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
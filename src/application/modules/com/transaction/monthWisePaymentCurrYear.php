<?php 
	class modules_com_transaction_monthWisePaymentCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function monthWisePaymentCurrYear($id="monthWisePaymentCurrYear",$width=null,$height=null)
		{
			$caption=" Month wise payment of current year ";
			$labelvalue=array('MONTH','PAYMENT');
			$result=$this->_trnModel->getMonthWisePaymentCurrYearQuery($labelvalue);
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
?>
<?php 
	class modules_com_transaction_schmWisePaymentCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function schmWisePaymentCurrYear($id="schmWisePaymentCurrYear",$width=null,$height=null)
		{
			$caption=" Project wise during the year total payment ";
			$labelvalue=array('PROJECT','PAYMENT');
			$result=$this->_trnModel->getSchmWisePaymentCurrYear($labelvalue);
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
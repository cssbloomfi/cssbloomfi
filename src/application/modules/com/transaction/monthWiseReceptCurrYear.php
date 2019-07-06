<?php 
	class modules_com_transaction_monthWiseReceptCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function monthWiseReceptCurrYear($id="monthWiseReceptCurrYear",$width=null,$height=null)
		{
			$caption=" Month wise Recept of current year ";
			$labelvalue=array('MONTH','RECEPT');
			$result=$this->_trnModel->getMonthWiseReceptCurrYearQuery($labelvalue);
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
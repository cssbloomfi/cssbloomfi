<?php 
	class modules_com_transaction_collWiseTotalPayCurrentYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function collWiseTotalPayCurrentYear($id="collWiseTotalPayCurrentYear",$width=null,$height=null)
		{
			$caption=" Collector wise during the year total payment  ";
			$labelvalue=array('COLLECTOR','PAYMENT');
			$result=$this->_trnModel->getCollWiseTotalPayCurrentYearQuery($labelvalue);
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
<?php 
	modules_com_transaction_topFiveCollRecCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function topFiveCollRecCurrYear($id="topFiveCollRecCurrYear",$width=null,$height=null)
		{
			$caption=" Top five Collector with maximum recept ";
			$labelvalue=array('COLLECTOR','RECEPT');
			$result=$this->_trnModel->getTopFiveCollRecCurrYearQuery($labelvalue);
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
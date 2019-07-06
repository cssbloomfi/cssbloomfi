<?php 
	class modules_com_transaction_schmTypeWiseTotalReceptCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function schmTypeWiseTotalReceptCurrYear($id="schmTypeWiseTotalReceptCurrYear",$width=null,$height=null)
		{
			$caption=" Project type wise total recept of current year ";
			$labelvalue=array('SCHEME_TYPE','Recept');
			$result=$this->_trnModel->getSchmTypeWiseTotalReceptCurrYearQuery($labelvalue);
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
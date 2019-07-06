<?php 
	class modules_com_transaction_topTenReceptLocCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function topTenReceptLocCurrYear($id="topTenReceptLocCurrYear",$width=null,$height=null)
		{
			$caption=" Top ten Recept location of current year  ";
			$labelvalue=array('LOCATION','RECEIPT');
			$result=$this->_trnModel->getTopTenReceptLocCurrYearQuery($labelvalue);
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
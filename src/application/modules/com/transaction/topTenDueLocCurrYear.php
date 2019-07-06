<?php 
	class modules_com_transaction_topTenDueLocCurrYear extends modules_com_transaction_AbstractTransactionComponent
	{
		protected $_trnModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function topTenDueLocCurrYear($id="topTenDueLocCurrYear",$width=null,$height=null)
		{
			$caption=" Top ten location with maximum due amount ";
			$labelvalue=array('Location','Due');
			$result=$this->_trnModel->getTopTenDueLocCurrYearQuery($labelvalue);
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
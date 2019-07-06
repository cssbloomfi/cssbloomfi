<?php
class modules_com_transaction_topTenPymtLoc extends modules_com_transaction_AbstractTransactionComponent
{
	protected $_custModel;
	protected $_chartModel;

	public function __construct()
	{
		 parent::__construct();
	}

	public function topTenPymtLoc($id="topTenPymtLoc",$width=null,$height=null)
	{
		$caption=" Top ten payment locations of current year";
		$labelvalue=array('LOCATION','LOAN');
		$result=$this->_trnModel->getTopTenPymtLocQuery($labelvalue);
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
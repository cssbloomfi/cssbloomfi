<?php 
	class modules_com_customer_schmWiseTotalCustCurrentYear extends modules_com_customer_AbstractCustomerComponent
	{
		protected $_custModel;
		protected $_chartModel;

		public function __construct()
		{
			 parent::__construct();
		}

		public function schmWiseTotalCustCurrentYear($id="schmWiseTotalCustCurrentYear",$width=null,$height=null)
		{

			$caption="Project wise total beneficiary of current year";
			$labelvalue=array('SCHEME','TOTAL_CUSTOMER');
			$result=$this->_custModel->getSchmWiseTotalCustCurrentYear($labelvalue);
			$strXML=$this->_XmlGenerator->generateXml($result,$caption,$labelvalue);
			$comp['component']=$this->_chartModel->renderPie3D($strXML, $id, $width, $height);
			$comp['title']=$caption;
			return $comp;

		}


		public function destroy()
		{
			unset($this->_custModel,$this->_chartModel);
		}
	}
?>
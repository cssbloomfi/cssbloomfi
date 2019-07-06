<?php
/*BreadCrumb Library writen by Smtiyiman barua */
class BinaryBl_BreadCrumb_Builder extends BinaryBl_BreadCrumb_Container
{
	function __construct()
	{
		$breadCrumbNS = new Zend_Session_Namespace('breadCrumb');
		Zend_Registry::set("breadCrumb", $breadCrumbNS);
		$breadCrumb=Zend_Registry::get('breadCrumb');
		if (!$breadCrumb->data){
			parent::__construct();
			$breadCrumb->data=$this->_data;}
		else
			$this->_data=$breadCrumb->data;
	}

	public function currentBreadCrumbPath($actionHelp=false,$parent_action=null)
	{
		$front = Zend_Controller_Front::getInstance();
		$module = $front->getRequest()->getModuleName();
		$controller = $front->getRequest()->getControllerName();
		$action = $front->getRequest()->getActionName();
		$baseUrl=$this->getBaseURL();
		foreach($this->_data as $arr)
		{
			if($actionHelp==true) {
			  if($arr['PARENT_ACTION']==$parent_action)
				 if($arr['MODULE']==$module && $arr['CONTROLLER']==$controller && $arr['ACTION']==$action)
					return $arr;
			}
			else {
				if($arr['MODULE']==$module && $arr['CONTROLLER']==$controller && $arr['ACTION']==$action)
					return $arr;
			}
		}
	}
	public function getBaseURL() 
	{
		$pageURL = 'http';
		 if (isset($_SERVER['HTTPS']))
		 if ($_SERVER['HTTPS'] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 $pageURL .= $_SERVER["HTTP_HOST"];
		 return $pageURL;
	}


}
<?php

class ZendExtend_Url extends Zend_Controller_Action_Helper_Url
{
	public function url($urlOptions = array(), $name = null, $reset = false, $encode = true)
	{
		$router = $this->getFrontController()->getRouter();
		if($reset==false){
			$parmas=null;
			$params=$this->assembleParams($urlOptions);
			$bUrl=$this->getCurrentUrlBase();
			$url=$bUrl.$params;
		}else{
			$url=$router->assemble($urlOptions, $name, true, $encode);
		}
        return $url;
	}

	public function assembleParams($params)
	{
		$urlParams=null;
		if($params)
			foreach($params as $paramKey=>$paramValue)
				$urlParams=$urlParams."/".$paramKey."/".$paramValue;
		return $urlParams;
	}

	public function getCurrentPageURL()
	{
		$pageURL = 'http';
		 if (isset($_SERVER['HTTPS']))
		 if ($_SERVER['HTTPS'] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
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

	public function getCurrentUrlBase()
	{
		$front = Zend_Controller_Front::getInstance();
		$module = $front->getRequest()->getModuleName();
		$controller = $front->getRequest()->getControllerName();
		$action = $front->getRequest()->getActionName();
		$baseUrl=$this->getBaseURL();
		return $baseUrl."/".$module."/".$controller."/".$action;
	}

	public function getCurrentUrlLevel($moduleName=false,$ControllerName=false,$actionName=false)
	{
		$module=$controller=$action=null;
		$front = Zend_Controller_Front::getInstance();
		if($moduleName==true){
			$module = $front->getRequest()->getModuleName();
			$module = "/".$module;
			if($ControllerName==true){
				$controller = $front->getRequest()->getControllerName();
				$controller = "/".$controller;
				if($actionName==true){
					$action = $front->getRequest()->getActionName();
					$action = "/".$action;
				}
			}
		}
		$baseUrl=$this->getBaseURL();
		return $baseUrl.$module.$controller.$action;
	}

	public function getAppUrlLevel()
	{
		$module=$controller=$action=null;
		$front = Zend_Controller_Front::getInstance();
		$url['module'] = $front->getRequest()->getModuleName();
		$url['controller'] = $front->getRequest()->getControllerName();
		$url['action'] = $front->getRequest()->getActionName();
		return $url;
	}
}
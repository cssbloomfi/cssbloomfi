<?php
class modules_dbd_controllers_DbdController extends Zend_Controller_Action
{
	protected $_session;

	function _initialize(){
		$this->_session=Zend_Registry::get('SQL');
		$this->_session->actionHelp=false;
		$this->view->images=$this->_session->images;
		$this->view->theme=$this->_session->theme['activeTheme'];
		$this->view->themePath=$this->_session->theme['themePath'];
		$this->view->roleId=$this->_session->roleId;
		return $this->_session;
	}

	function _convertAsterixInArray($params)
	{
		foreach($params as $key=>$param){
			$params[$key]=str_replace('*','%',$param);
		}
		return $params;
	}

}

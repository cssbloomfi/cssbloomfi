<?php
class modules_ref_controllers_RefController extends Zend_Controller_Action
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

	function getSession(){
		return $this->_session;
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$rows=5000;
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}

}

<?php
class Adm_IndexController extends Zend_Controller_Action 
{
	protected $_session;

	function preDispatch(){
		$this->_session=Zend_Registry::get('SQL');
	}

    function indexAction()
    {
		$menu = new AccessQuery();
		$this->view->title = $menu->getQueryTitle('AdmMenuQuery');
		$this->view->menu = $menu->getAdmMenuQuery();
		//$this->view->content="From default/index"; 
    }

	function logmanagementAction()
	{
		echo "Log Management";
	}
	
}

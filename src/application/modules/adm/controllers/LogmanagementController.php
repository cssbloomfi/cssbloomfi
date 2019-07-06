<?php
class Adm_LogmanagementController extends Zend_Controller_Action 
{
	protected $_session;

	function preDispatch(){
		$this->_session=Zend_Registry::get('SQL');
	}

    function indexAction()
    {
	  $msgModel=modules_adm_messages_message;
	  $msg=getLogManagementMessages('common');
      $this->view->title = $msg['title'];

	  $model=new modules_adm_labels_label;
	  $this->view->logMgt=$model->getLogMgtLabels('logMgt');
    }
	
}

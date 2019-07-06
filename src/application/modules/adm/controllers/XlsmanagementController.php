<?php
class Adm_XlsmanagementController extends Zend_Controller_Action 
{
    function indexAction()
    {
	  $message=new modules_adm_messages_message;
	  $this->msg=$message->getXlsManagementMessages('common');
      $this->view->title = $this->msg['title'];
    }
	
}

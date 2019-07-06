<?php
class Adm_UseraccesscontrolController extends modules_adm_controllers_AdminController
{
    function indexAction()
    {
      $this->view->title = "Access Control";
	  $this->prepare();
	  echo "<br><br><br>";
	   echo "<br><br><br>";
	     echo "<br><br><br>";
    }

	function suggestuseridAction()
	{
		$this->_admModel = new modules_adm_models_admAccessQuery();
		$uid = strtoupper($this->_request->getParam('q'));
		$this->view->userIds = $this->_admModel->SuggestUserIdQuery($uid);
		$this->_helper->layout->disableLayout();
	}


}
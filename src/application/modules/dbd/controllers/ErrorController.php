<?php 
class ErrorController extends modules_dbd_controllers_DbdController
{
	function preDispatch(){
		$this->_initialize();	
	}

    public function errorAction()
    {
		$msg=new Bloomfi_App_Ulibrary;
		$path = ROOT_DIR."/application/modules/dbd/config/dbd.ini";
		$error_status =  $msg->getIniMessages($path,'error');
		$error_msgs = new modules_dbd_messages_message;
		$msgs = $error_msgs->getDbdErrorMessages('errorMsg');
		$errors = $this->_getParam('error_handler');
		$this->view->error_level_1=$error_status['errorLevel1Active'];
		$this->view->error_level_2=$error_status['errorLevel2Active'];
		$this->view->error_level_3=$error_status['errorLevel3Active'];
		if($this->view->error_level_1 == 1 )
        {  
			$err=(array)$errors;
			if(isset($err['type'])) {
				if($err['type']=='EXCEPTION_NO_CONTROLLER')
					$this->view->error_message = $msgs['noController'];
				if($err['type']=='EXCEPTION_NO_ACTION')
					$this->view->error_message = $msgs['noAction'];
				if($err['type']=='EXCEPTION_OTHER')
					$this->view->error_message = $msgs['internalProblem'];
			}
			else
				$this->view->error_message = $msgs['permissionDenied'];
		}
		if($this->view->error_level_2 == 1 )
		{
			$err=(array)$errors;
			foreach($err as $value){
				$this->view->error_detail_message=$value;
				break;
			}
		}
		if($this->view->error_level_3 == 1 )
		{
		if(isset($errors->type)) {
		switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                $content =<<<EOH
<h1>Error!</h1>
<p>The page you requested was not found.</p>
EOH;
                break;
            default:
                // application error
                $content =<<<EOH
<h1>Error!</h1>
<p>An unexpected error occurred. Please try again later.</p>
EOH;
                break;
        }
        // Clear previous content
        $this->getResponse()->clearBody(); }
       $this->view->content = $errors;
		}
	}
}
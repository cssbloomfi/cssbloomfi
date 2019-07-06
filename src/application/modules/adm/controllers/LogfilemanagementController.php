<?php
class Adm_LogfilemanagementController extends modules_adm_controllers_AdminController 
{
	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
		$lib=new Bloomfi_App_Ulibrary;
		$applicationLogFiles = $this->_getApplicationLogFileInfo();
		$model=new modules_adm_labels_label;
		$this->view->logFileMgt=$model->getLogFileMgtLabels('logFileMgt');
		$this->view->applicationLogs = $lib->crtHtolSortedFilesInfo($applicationLogFiles,'php');
		unset($lib);
    }

	protected function _getApplicationLogFileInfo()
	{
		$files = glob(ROOT_DIR . "/tmp/logs/*.php");
		return $files;
	}

	


}
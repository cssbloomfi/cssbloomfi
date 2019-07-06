<?php
class Adm_TranxlslogmanagementController extends modules_adm_controllers_AdminController 
{
    protected $_trn_valida_file_prefix = "trnXlsValid";
	protected $_trn_upload_file_prefix = "trnXlsUpload";
	protected $_xls_valida_path='/tmp/logs/xlslogs/validation_logs/';
	protected $_xls_upload_path='/tmp/logs/xlslogs/upload_logs/';

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
	  $model=new modules_adm_messages_message;
	  $msg= $model->getTranXlsLogManagementMessages('common');
      $this->view->title = $msg['title'];

	  if($this->getRequest()->isPost()){
			$request = $this->getRequest()->getPost('REQUEST');
			$result=null;
			$i=0;
			if($request=='Transaction Validation Logs'){
				if($this->getRequest()->isPost('trnValidationLog'))
				foreach($this->getRequest()->getPost('trnValidationLog') as $trnValidationLog){
					$file=ROOT_DIR.$this->_xls_valida_path.$trnValidationLog;
					$html=str_replace('.log','.html',$file);
					if( file_exists($file) && file_exists($html)) { 
						$result1=unlink($file);
						$result2=unlink($html);
					//	echo "[$file]=[$html]";
						$i++; }
					else break;
				}
			}
			if($request=='Transaction Upload Logs'){
				if($this->getRequest()->isPost('trnUploadLog'))
				foreach($this->getRequest()->getPost('trnUploadLog') as $trnUploadLog){
					$file=ROOT_DIR.$this->_xls_upload_path.$trnUploadLog;
					$html=str_replace('.log','.html',$file);
					if( file_exists($file) && file_exists($html) ) { 
						$result1=unlink($file);
						$result2=unlink($html);
					//	echo "[$file]=[$html]";
						$i++; }
					else break;
				}
			}
	  }

	  $trnXlsValidationLogFiles = $this->_getXlsLogFileInfo($this->_trn_valida_file_prefix,'VALIDATION');
	  $trnXlsUploadLogFiles=$this->_getXlsLogFileInfo($this->_trn_upload_file_prefix,'UPLOAD');

	  $this->view->trnXlsValidationLogs= $this->_crtHtolSortedFilesInfo($trnXlsValidationLogFiles);
	  $this->view->trnXlsUploadLogs=$this->_crtHtolSortedFilesInfo($trnXlsUploadLogFiles);

    }

	protected function _getXlsLogFileInfo($file_link_nm=null,$purpose=null,$fileExtention='log')
	{
		if($purpose=='VALIDATION')
			$target_folder="validation_logs/(*)";
		if($purpose=='UPLOAD')
			$target_folder="upload_logs/(*)";
		$current_date=date("Y-m-d");
		$files = glob(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder . $file_link_nm ."*.$fileExtention");
		return $files;
	}

	protected function _crtHtolSortedFilesInfo($files,$fileExtention='log')
	{
		$file_no=null;
		if($files) {
		$i=0;
		foreach($files as $filename) {
		$lstatime = date("d-m-Y H:i:s.", fileatime($filename));
		$filename=basename($filename);
		$file=explode('_@',$filename);
		$file_no=$i++;
		$allfilename[$file_no]['id']=$file_no; 
		$allfilename[$file_no]['filename']=$filename; 
		$allfilename[$file_no]['lstatime']=$lstatime;}
		krsort($allfilename); 
		return $allfilename; }
	}
	
}

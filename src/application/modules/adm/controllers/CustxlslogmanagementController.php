<?php
class Adm_CustxlslogmanagementController extends modules_adm_controllers_AdminController 
{
	protected $_cust_valida_file_prefix = "customerXlsValid";
	protected $_cust_upload_file_prefix = "customerXlsUpload";
	protected $_xls_valida_path='/tmp/logs/xlslogs/validation_logs/';
	protected $_xls_upload_path='/tmp/logs/xlslogs/upload_logs/';

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
	 $msgModel=new modules_adm_messages_message;
	 $this->xlsLogMgtMsg=$msgModel->getCustXlsLogMgtMessages('xlsLogManagement');
     $this->view->title = $this->xlsLogMgtMsg['title'];

	  if($this->getRequest()->isPost()){
			$request = $this->getRequest()->getPost('REQUEST');
			$result=null;
			$i=0;
			if($request=='Customer Validation Logs'){
				if($this->getRequest()->isPost('custValidationLog'))
				foreach($this->getRequest()->getPost('custValidationLog') as $custValidationLog){
					$file=ROOT_DIR.$this->_xls_valida_path.$custValidationLog;
					$html=str_replace('.log','.html',$file);
					if( file_exists($file) && file_exists($html)) { 
						$result1=unlink($file);
						$result2=unlink($html);
					//	echo "[$file]=[$html]";
						$i++; }
					else break;
				}
			}
			if($request=='Customer Upload Logs'){
				if($this->getRequest()->isPost('custUploadLog'))
				foreach($this->getRequest()->getPost('custUploadLog') as $custUploadLog){
					$file=ROOT_DIR.$this->_xls_upload_path.$custUploadLog;
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

	  $custXlsValidationLogFiles = $this->_getXlsLogFileInfo($this->_cust_valida_file_prefix,'VALIDATION');
	  $custXlsUploadLogFiles=$this->_getXlsLogFileInfo($this->_cust_upload_file_prefix,'UPLOAD');

	  $this->view->custXlsValidationLogs= $this->_crtHtolSortedFilesInfo($custXlsValidationLogFiles);
	  $this->view->custXlsUploadLogs=$this->_crtHtolSortedFilesInfo($custXlsUploadLogFiles);

	//  print_r($this->view->custXlsValidationLogs);
	//  print_r($this->view->custXlsUploadLogs);

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
			$allfilename[$file_no]['lstatime']=$lstatime;
		}
		krsort($allfilename); 
		return $allfilename; 
		}
	}
}

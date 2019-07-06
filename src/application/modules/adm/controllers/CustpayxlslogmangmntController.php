<?php
class Adm_CustpayxlslogmangmntController extends modules_adm_controllers_AdminController 
{
    protected $_custpay_valida_file_prefix = "custPayXlsValid";
	protected $_custpay_upload_file_prefix = "custPayXlsUpload";
	protected $_xls_valida_path='/tmp/logs/xlslogs/validation_logs/';
	protected $_xls_upload_path='/tmp/logs/xlslogs/upload_logs/';

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
      $this->view->title = "Beneficiary Payment Excel Log Management";

	  if($this->getRequest()->isPost()){
			$request = $this->getRequest()->getPost('REQUEST');
			$result=null;
			$i=0;
			if($request=='Custpay Validation Logs'){
				if($this->getRequest()->isPost('custpayValidationLog'))
				foreach($this->getRequest()->getPost('custpayValidationLog') as $custpayValidationLog){
					$file=ROOT_DIR.$this->_xls_valida_path.$custpayValidationLog;
					$html=str_replace('.log','.html',$file);
					if( file_exists($file) && file_exists($html)) { 
						$result1=unlink($file);
						$result2=unlink($html);
					//	echo "[$file]=[$html]";
						$i++; }
					else break;
				}
			}
			if($request=='Custpay Upload Logs'){
				if($this->getRequest()->isPost('custpayUploadLog'))
				foreach($this->getRequest()->getPost('custpayUploadLog') as $custpayUploadLog){
					$file=ROOT_DIR.$this->_xls_upload_path.$custpayUploadLog;
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

	  $custPayXlsValidationLogFiles = $this->_getXlsLogFileInfo($this->_custpay_valida_file_prefix,'VALIDATION');
	  $custPayXlsUploadLogFiles=$this->_getXlsLogFileInfo($this->_custpay_upload_file_prefix,'UPLOAD');

	  $this->view->custPayXlsValidationLogs= $this->_crtHtolSortedFilesInfo($custPayXlsValidationLogFiles);
	  $this->view->custPayXlsUploadLogs=$this->_crtHtolSortedFilesInfo($custPayXlsUploadLogFiles);

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

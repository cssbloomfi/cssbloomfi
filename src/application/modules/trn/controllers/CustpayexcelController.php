<?php
require_once "library/thirdParty/utilityFunctions.php";
class Trn_CustpayexcelController extends modules_trn_controllers_TrnController 
{

	protected $_refModel;
	protected $_trnModel;
	protected $_message;
	protected $_excel;
	protected $_columns;
	protected $_fileLogger;
	protected $_htmlFile;
	protected $_exportRows=5000;
	protected $_commetPerRows=1;
	protected $_excelMessages;
	protected $_payment_type_key;
	protected $_valida_file_prefix = "custPayXlsValid";
	protected $_upload_file_prefix = "custPayXlsUpload";
	protected $_paymentType='CAPITAL_PAID';
	protected $_paymentAmount=0;

	function preDispatch(){
		$this->_initialize();
		$this->_refModel = new modules_ref_models_refAccessQuery;  
		$applConfig = Zend_Registry::get('applConfig');
		$config=$this->_refModel->getIniParameters($applConfig,'customerImportExport','xls');
		if(!empty($config['exportRows']))$this->_exportRows=$config['exportRows'];
		if(!empty($config['importCommetPerRow']))$this->_commetPerRows=$config['importCommetPerRow'];
	}

	function postDispatch(){
		unset($this->_refModel); 
	}

	public function indexAction()
	{
		$this->_session->actionHelp=false;
		$labels=new modules_trn_labels_label;
		$this->_message=new modules_trn_messages_message;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->view->viewlabels=$labels->getTrnCustPayExcelViewLabels('index');
		$this->view->formLabels=$labels->getTrnCustPayExcelFormLabels('form');
		$this->view->logTable=$labels->getTrnCustPayExcelTableLabels('log');
		$this->view->messages=$this->_excelMessages=$this->_message->getTrnCustPayExcelMessages('index');
		$this->view->hyperlinks = $labels->getTrnAllLinkLabels('exclIndex');
		$this->view->auto=NULL;
		$errors=null;
		if ($this->getRequest()->isPost())
		{
			 $upload = new Zend_File_Transfer_Adapter_Http();
			 try {
			 $upload->receive();
			 } catch (Zend_File_Transfer_Exception $e) {
			 $e->getMessage();
			 }
			$filename = $upload->getFileName('doc_path');
			$request = $this->getRequest()->getPost('REQUEST');
			if($request=='VALIDATE'){		
				$errors = $this->validateXlsFileData($filename);
				if( isset($errors['UNREADABLE']) ){
					$this->view->textErrorsValidation=$errors['UNREADABLE'];
				}
				else {
				$this->view->validationError = $errors;
				$this->view->textSuccessValidate=$this->_excelMessages['successValidation'];	
				$this->view->logDetailsHeader = $this->view->viewlabels['validationLogDetails']; }
			}
			else {
				$errors=$this->loadData($filename); 
				if($errors=='LOCK'){
					$this->view->textInfo=$this->_excelMessages['tableLock'];
				}
				else{
				if($errors){
					if( isset($errors['UNREADABLE']) ){
						$this->view->textErrors=$errors['UNREADABLE'];
					}
					else {
						$this->view->validationError=$errors;
						$this->view->textErrors= str_replace('@VAR1@',$this->view->viewlabels['uploadLogDetails'], $this->_excelMessages['uploadValidationError']); }
				}
				else
					$this->view->textSuccess=$this->_excelMessages['successUpload'];	
				}
				$this->view->logDetailsHeader = $this->view->viewlabels['uploadLogDetails'];
			}					
		 }	

		 if(empty($this->view->logDetailsHeader)) 
			 $this->view->logDetailsHeader = $this->view->viewlabels['defaultLogDetails'];
		 $error_log_files1=$this->_getCustXlsLogFileInfo($this->_upload_file_prefix,"UPLOAD");
		 $error_log_files2=$this->_getCustXlsLogFileInfo($this->_valida_file_prefix,"VALIDATION");
		 $upload_xls_datas=$this->_getCustXlsLogFileInfo($this->_upload_file_prefix,"UPLOAD",'html');
		 $valida_xls_datas=$this->_getCustXlsLogFileInfo($this->_valida_file_prefix,"VALIDATION",'html');
		  if($error_log_files1 && $upload_xls_datas) {
			$this->view->custXlsUploadLogs =$this->_crtHtolSortedFilesInfo($error_log_files1);
			$this->view->custXlsUploadDatas =$this->_crtHtolSortedFilesInfo($upload_xls_datas,'html');
		  }
		 if($error_log_files2 && $valida_xls_datas) {
			$this->view->custXlsValidationLogs =$this->_crtHtolSortedFilesInfo($error_log_files2);
			$this->view->custXlsValidationDatas =$this->_crtHtolSortedFilesInfo($valida_xls_datas,'html');
		 }

		 unset($labels,$this->_message,$upload);
	}

	public function createPaginationParams($array=null)
	{
		$no=1;
		$arr=array();
		if($array)
		foreach($array as $value){
			$arr=array_merge($arr,array('param'.$no=>$value));
			$no++;}
		return $arr;

	}

	public function createArrAndUrlParams($string=null,$seperator='/')
	{
		$params=explode($seperator,$string);
		$parray=array();
		$strPattern=new Bloomfi_App_Ulibrary_StrPattern;
		$strPattern->clearPattern();
		$strPattern->setPattern(null,'/');
		$i=1;
		foreach($params as $param) {
			$strPattern->insertDataToPattern('param'.$i);
			$strPattern->insertDataToPattern($param);
			//$parray=array_merge($parray,array('param'.$i=>$param));
			$i++; }
		$result['url_params']=$strPattern->getPatternString();
		$result['array_params']=$params;
		//$result['pagination_params']=$parray;
		return $result;
	}


	public function loadData($filename)
	{
		$transactionFlag=$Flag=0;
		$transactionRun=false;
		$logmsg=$this->_message->getTrnCustPayExcelMessages('uploadingLogMsgs');
		$this->_excel = new Bloomfi_Excel_Excelreader($filename);
		if($this->_excel->readable==0) { 
			$errors = array('UNREADABLE'=>$this->_excel->error);
			return $errors; }
		$errors=$emp_id=$cust_id=$cust_name=$addr=$age=$loc=$sex=$description=null;
		$effected_rows=$success_rows=$unsuccess_rows=0;
		$file=basename($filename,".xls");
		
		$this->_setupXlsLoggerAndDataFile($this->_upload_file_prefix,'UPLOAD',$file);
		$this->_fileLogger->info("File Name -> ".$file);
		$this->_refModel->resetProcessing();
		$this->_refModel->startProcessing();
		$this->_insertXlsDataToHtmlfile();
		$static=$this->_refModel->getAllCustStaticValQuery();
		$prefix=$this->_refModel->getCustomerPrePostQuery();
		$prefixTrn= $this->_trnModel->getAllTrnPrePostQuery();
		//$allow = $this->_refModel->waitAndAllow('DB',0);
		//if($allow==0){ 
		//	$this->_fileLogger->log($logmsg['tableStatusLock'],Zend_Log::NOTICE);
		//	return 'LOCK'; }
		//else $this->_fileLogger->info($logmsg['tableStatusOpen']);
		$user=$this->_getUser();
		$this->_fileLogger->info($logmsg['uploadingStart']);
		set_time_limit(3600); 
		$start=2;
		$end=$this->_excel->sheets[0]['numRows'];
		
		$this->_columns = array ();
		for ($col = 1; $col <= $this->_excel->sheets[0]['numCols']; $col++) {
			if(isset($this->_excel->sheets[0]['cells'][1][$col]))
				$column = trim($this->_excel->sheets[0]['cells'][1][$col]);
			else
				$column=null;
			if(!empty($column))
			$this->_columns=array_merge($this->_columns,array($this->_excel->sheets[0]['cells'][1][$col] => $col));
		}
		$errors=$this->_checkColumn();
		if($errors[1]){
			//$this->_refModel->Lock('ENTITY');
			foreach($errors[1] as $key => $msg)
			$this->_fileLogger->log("'$key' $msg",Zend_Log::ERR);
			$this->_fileLogger->log($logmsg['fail'],Zend_Log::ALERT);
			return $errors;
		}
		$age_limits = $this->_refModel->getCustomerAgeLimitQuery();
		$errors=array();
		for ($row = $start ; $row <= $end; $row++) {
			if($transactionFlag==0){
				$this->_refModel->startTransaction();
				$transactionRun=true;
			}
			$row_data=$this->_excel->sheets[0]['cells'][$row];
			if($this->_excel->tools->isEmptyRow($row_data)){
				array_walk_recursive($row_data, 'trim_all');
				$error_msgs = $this->validate($row_data);
				if(!$error_msgs){
					$save_point='CUST_'.$user.'_'.$row;
					$this->_refModel->SavepointTransaction($save_point);
					$description=$loc=$emp_id=$addr=null;
					$emp_id=$row_data[$this->_columns['COLLECTOR_CODE']];
					$cust_id=$row_data[$this->_columns['CLIENT_CODE']];
					$cust_name=$row_data[$this->_columns['CLIENT_NAME']];
					$addr=$row_data[$this->_columns['ADDRESS']];
					$date=$row_data[$this->_columns['CLIENT_ENTRY_DATE']];
					if(isset($row_data[$this->_columns['AGE']]))
						$age=(int)$row_data[$this->_columns['AGE']];
					else $age = (int)$age_limits[0]->VALUE_NAME;
					$loc=$row_data[$this->_columns['LOCATION']];
					$sex=$row_data[$this->_columns['GENDER']];
					if( isset($row_data[$this->_columns['DESCRIPTION']]) &&  $row_data[$this->_columns['DESCRIPTION']] !='' )
						$description=$row_data[$this->_columns['DESCRIPTION']];
					$scheme_id=$row_data[$this->_columns['SCHEME_ID']];
					
			//		if(empty($emp_id) || empty($cust_id) || empty($cust_name) || empty($loc) || empty($sex) || empty($date)){
					//	break;
				//	}
					$entry_date=$this->_excel->tools->convertDateToDate($date);
					$creation_date=date("Y-m-d H:m:s");
			//		$appdate=date("Y-m-d");
					$entity_id = $cust_id;
					$this->_refModel->insertRowInEntityTblDML();
					$max_id=$this->_refModel->getLastInsertedId();
					$entity_unique_id = $prefix[0]->PREFIX_VALUE.$max_id->ID;
					$addr_id = $prefix[2]->PREFIX_VALUE.$max_id->ID;
					$css_id='CSS'.$max_id->ID;
					$cust_img=null;
					$datas_ordered_1 = array( $entity_id, $static[0]->VALUE_NAME, $emp_id, $description, 
					$cust_name, $age, $sex, $cust_id, $entity_unique_id, $entry_date, $loc, $addr_id, $creation_date, $cust_img, $css_id,$scheme_id, $max_id->ID);
					$datas_ordered_2 = array( $addr_id, $addr ); 
					$result1=$this->_refModel->updateInsertedCustomerDML($datas_ordered_1);
					$result2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
					$this->_trnModel->insertRowInSummaryDML();
					$summary_max_id=$this->_trnModel->getLastInsertedId();
					$this->_trnModel->insertRowInDetailDML();
					$detail_max_id=$this->_trnModel->getLastInsertedId();
					$receive_amount=0;
					$due_amount=$this->_paymentAmount;
					$new_ts_row_id = $summary_max_id->ID;
					$new_trns_id=$prefixTrn[0]->PREFIX_VALUE.$new_ts_row_id;
					$new_td_row_id = $detail_max_id->ID;
					$new_detail_id=$prefixTrn[1]->PREFIX_VALUE.$new_td_row_id;
					$data_ordered = array( $new_trns_id,$scheme_id,$cust_id,
						 $emp_id, $this->_paymentAmount, $due_amount,$entry_date,null,$new_ts_row_id);
					$data_ordered1 = array ($new_detail_id, $new_trns_id, $scheme_id,
					$cust_id,  $emp_id, $this->_paymentAmount, $this->_paymentType,  $cust_id,null,
					$entry_date,null,$cust_name,$sex,$new_td_row_id);
					$result3=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
					$result4=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);

					if($result1['result'] && $result2 && $result3 && $result4) {
						$success_rows++;
					}
					else{
						 $error_msgs['CLIENT_CODE'] =str_replace('@VAR1@',$cust_id,$this->_excelMessages['customerEntryError']);
						$this->_fileLogger->log('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE] '.$error_msgs['CLIENT_CODE'],Zend_Log::ERR);
						$this->_refModel->RollbackTransaction($save_point);
						$unsuccess_rows++;
					}

					$transactionFlag++;
					if($transactionFlag==$this->_commetPerRows){
						$this->_refModel->commitTransaction();
						$transactionFlag=0;
						$transactionRun=false;
					}
					
				}
				else{
					foreach($error_msgs as $msg){
						$this->_fileLogger->log('[ ROW - '.$row.' ] [COLUMN - '.key($error_msgs).'] '.$msg,Zend_Log::ERR);
							next($error_msgs);}
					$unsuccess_rows++;
				}
				$effected_rows++;
				ob_flush();
				flush();
				if($error_msgs)
					$errors[$row]=$error_msgs;
			}

			$Flag=1;
		}//loop end

		//if($Flag==1) $this->_refModel->Lock('ENTITY');
		if($transactionRun==true)$this->_refModel->commitTransaction();
		$msg_effected=str_replace('@VAR1@',$effected_rows,$logmsg['effectedRows']);
		$msg_success_rows=str_replace('@VAR1@',$success_rows,$logmsg['successRows']);
		$msg_unsuccess_rows=str_replace('@VAR1@',$unsuccess_rows,$logmsg['unSuccessRows']);
		$this->_fileLogger->info($msg_effected);
		$this->_fileLogger->info($msg_success_rows);
		$this->_fileLogger->info($msg_unsuccess_rows);
		$this->_refModel->commitTransaction();
		$this->_refModel->endProcessing();
		$this->_fileLogger->info("Total Consumed time for uploading process is : ".$this->_refModel->getTotalProcessingTime(2));
		$this->_refModel->destroy();
		ob_flush();
		flush();
		unset($this->_excel,$this->_columns,$this->_fileLogger);
		return $errors;	
	} 


	public function validateXlsFileData($file)
	{
		$logmsg=$this->_message->getTrnCustPayExcelMessages('validationLogMsgs');
		$this->_excel = new Bloomfi_Excel_Excelreader($file);
		if($this->_excel->readable==0) { 
			$errors = array('UNREADABLE'=>$this->_excel->error);
			return $errors; }
		//$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();
		$data=$errors=$error_msgs=$cust_id=$scheme_id=$result=null;
		$filename=basename($file,".xls");
		$this->_setupXlsLoggerAndDataFile($this->_valida_file_prefix,'VALIDATION',$filename);
		$this->_fileLogger->info("File Name -> ".$filename);
		$this->_refModel->resetProcessing();
		$this->_refModel->startProcessing();
		$this->_insertXlsDataToHtmlfile();
		set_time_limit(3600); 
		$this->_fileLogger->info($logmsg['validationStart']);
		$start=2;
		$end=$this->_excel->sheets[0]['numRows'];
		$this->_columns = array ();
		for ($col = 1; $col <= $this->_excel->sheets[0]['numCols']; $col++) {
			if(isset($this->_excel->sheets[0]['cells'][1][$col]))
				$column = trim($this->_excel->sheets[0]['cells'][1][$col]);
			else
				$column=null;
			if(!empty($column))
			$this->_columns=array_merge($this->_columns,array($this->_excel->sheets[0]['cells'][1][$col] => $col));
		}
		$error_msgs=array();
		$errors=$this->_checkColumn();
		if($errors[1]){
			foreach($errors[1] as $key => $msg)
			$this->_fileLogger->log("'$key' $msg",Zend_Log::ERR);
			$this->_fileLogger->log($logmsg['fail'],Zend_Log::ALERT);
			return $errors;
		}
		$errors=array();
		for ($row = $start ; $row <= $end; $row++) {
			$row_data=$this->_excel->sheets[0]['cells'][$row];
		//	$rowempty=$this->_isEmptyRow($row_data);
		//	echo "Flag=$rowempty  ";
			if($this->_excel->tools->isEmptyRow($row_data)){
			array_walk_recursive($row_data, 'trim_all');
			$error_msgs = $this->validate($row_data);
			if($error_msgs){
				$errors[$row]=$error_msgs;
				foreach($error_msgs as $msg){
					$this->_fileLogger->log('[ ROW - '.$row.' ] [COLUMN - '.key($error_msgs).'] '.$msg,Zend_Log::ERR);
					next($error_msgs);}
			}}
			ob_flush();
			flush();
		}
		if(!$errors) $this->_fileLogger->info($logmsg['noErrors']);
		$effected_rows=str_replace('@VAR1@',$end,$logmsg['effectedRows']);
		$this->_fileLogger->info($effected_rows);
		$this->_fileLogger->info($logmsg['validationEnd']);
		$this->_refModel->endProcessing();
		$this->_fileLogger->info("Total Consumed time for validation process is : ".$this->_refModel->getTotalProcessingTime(2));
		$this->_refModel->destroy();
		$this->_trnModel->destroy();
		ob_flush();
		flush();
		unset($this->_refModel,$this->_trnModel,$this->_fileLogger,$this->_excel,$this->_columns);
		return $errors;
	}

	protected function _checkColumn()
	{
		$errors=null;
		$columns=array('CLIENT_NAME','CLIENT_CODE','COLLECTOR_CODE', 'GENDER' ,'ADDRESS','AGE','LOCATION','DESCRIPTION', 'CLIENT_ENTRY_DATE','SCHEME_ID','PAYMENT');
		foreach($columns as $column){
			$flag=0;
			foreach($this->_columns as $col=>$value){
				if($col==$column){ $flag=1;
					break;  }
			}
			if($flag==0) $errors[$column]=$this->_excelMessages['errorColumn'];
		}
		$error[1]=$errors;
		return $error;
	}

	protected function validate($data,$row=null)
	{
		$errors = null;
		$current_row=$gender=$emp_id=$cust_id=$age=$isoDate=$date=$scheme=$paymentAmount=null;
		$this->_paymentAmount=0;
		if($row)$current_row="[Row - $row] ";
	
		if(isset($data[$this->_columns['COLLECTOR_CODE']]) && !empty($data[$this->_columns['COLLECTOR_CODE']])){
			$emp_id = $data[$this->_columns['COLLECTOR_CODE']];
			if($emp_id){
				$result=$this->_refModel->isEmployeeIdQuery($emp_id);
				if(!$result){
					$msg=str_replace('@VAR1@',$emp_id,$this->_excelMessages['employeeNotExist']);
					$errors['COLLECTOR_CODE'] = $current_row.$msg;
				}
			}
		}
		else
			$errors['COLLECTOR_CODE'] = $current_row.$this->_excelMessages['employeeEmpty'];

		if(isset($data[$this->_columns['CLIENT_CODE']]) && !empty($data[$this->_columns['CLIENT_CODE']])){
			$cust_id = $data[$this->_columns['CLIENT_CODE']];
			$result = $this->_refModel->isCustomerIdQuery( $cust_id );
			if($result){
				$msg=str_replace('@VAR1@',$cust_id,$this->_excelMessages['customerExist']);
				$errors['CLIENT_CODE'] = $current_row.$msg; }
		
		}
		else
			$errors['CLIENT_CODE'] = $current_row.$this->_excelMessages['customerEmpty'];

		if(isset($data[$this->_columns['CLIENT_NAME']]) && !empty($data[$this->_columns['CLIENT_NAME']]) )
			$cust_name = $data[$this->_columns['CLIENT_NAME']];
		else
			$errors['CLIENT_NAME'] = $current_row.$this->_excelMessages['customerNameEmpty'];

		if(isset($data[$this->_columns['ADDRESS']]) && !empty($data[$this->_columns['ADDRESS']]))
			$addr = $data[$this->_columns['ADDRESS']];
		else
			$errors['ADDRESS'] = $current_row.$this->_excelMessages['addressEmpty'];

		if(isset($data[$this->_columns['GENDER']]) && !empty($data[$this->_columns['GENDER']])){
			$gender = $data[$this->_columns['GENDER']];
			if($gender){
				if( $gender !='M'){
					if($gender !='F') {
					$msg=str_replace('@VAR1@',$cust_id,$this->_excelMessages['genderInvalid']);
					$errors['GENDER'] = $current_row.$msg; }
				}
			}
		}
		else
			$errors['GENDER'] = $current_row.$this->_excelMessages['genderEmpty'];

		if(isset($data[$this->_columns['AGE']]) && !empty($data[$this->_columns['AGE']])){
			$age = $data[$this->_columns['AGE']];
			if($age){
				if(strlen($age)<2){
					$msg=str_replace('@VAR1@',$age,$this->_excelMessages['ageLength']);
					$errors['AGE'] = $current_row.$msg; }
				else {
					if( $age<1 || $age>999 ) {
					$msg=str_replace('@VAR1@',$age,$this->_excelMessages['ageLimit']);
					$errors['AGE'] = $current_row.$msg; }
				}
			}
		} 
	//	else
		//	$errors['AGE'] = $current_row.$this->_excelMessages['ageEmpty'];

		if(isset($data[$this->_columns['CLIENT_ENTRY_DATE']]) && !empty($data[$this->_columns['CLIENT_ENTRY_DATE']])) {
			$date =$this->_excel->tools->convertDateToDate($data[$this->_columns['CLIENT_ENTRY_DATE']] );
			//$result=$this->_excel->tools->isIsoDate($date);
			if(!$date)
				$errors['CLIENT_ENTRY_DATE'] = $current_row.$this->_excelMessages['incorrectDateFormat'];
		}
		else {
			$errors['CLIENT_ENTRY_DATE'] = $current_row.$this->_excelMessages['dateEmpty'];
		} 

		if(isset($data[$this->_columns['SCHEME_ID']]) && isset($data[$this->_columns['SCHEME_ID']])) {
			$scheme =$data[$this->_columns['SCHEME_ID']];
			if($scheme){
				$result = $this->_refModel->getSchmByNmQuery( $scheme );
				if(!$result){
					$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeInvalid']);
					$errors['PROJECT'] = $current_row.$msg;
				}
			}
		}
		else {
			$errors['PROJECT'] = $current_row.$this->_excelMessages['schemeEmpty'];
		} 

		if(isset($data[$this->_columns['PAYMENT']]) && !empty($data[$this->_columns['PAYMENT']])){
			$this->_paymentAmount = (float) $this->_excel->tools->removeComma( $data[$this->_columns['PAYMENT']]);
			if($this->_paymentAmount <= 0){
			$msg=str_replace('@VAR1@',$this->_paymentAmount,$this->_excelMessages['paymentInvalid']);
			$errors['PAYMENT'] = $current_row.$msg;
		}
		}else{
			$errors['PAYMENT'] = $current_row.$this->_excelMessages['paymentEmpty'];
		}
		
		//$errors['Test'] =$current_row."Test Error";

		ob_flush();
		flush();
			
		return $errors;		
	}


	protected function _setupXlsLoggerAndDataFile($file_link_nm,$purpose=null,$filename="FILE")
	{
		$target_folder=null;
		$format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
		$formatter = new Zend_Log_Formatter_Simple($format);
		$current_user=$this->_getUser();
		$files=$this->_getCustXlsLogFileInfo($file_link_nm,$purpose);
		if($files) {
		$files=$this->_crtHtolSortedFilesInfo($files,'log',null);
		foreach($files as $file) break;
		$filenm=basename($file,'.log');
		$no=explode('_@',$filenm);
		$new_no=$no[3]+1; }
		else $new_no=1;
		if($purpose=='VALIDATION')
			$target_folder="validation_logs/(".$filename.")";
		if($purpose=='UPLOAD')
			$target_folder="upload_logs/(".$filename.")";
		$stream1 = @fopen(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder.$file_link_nm ."_@" .$current_user ."_@". date("Y-m-d"). "_@". $new_no . ".log", 'w', true);
		$stream2 = @fopen(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder.$file_link_nm ."_@" .$current_user ."_@". date("Y-m-d"). "_@". $new_no . ".html", 'w', true);
		if (!$stream1 || !$stream2){
			throw new Exception('Failed to open stream');
		}
		try{
			$fileWriter = new Zend_Log_Writer_Stream($stream1);
			$fileWriter->setFormatter($formatter);
			$this->_fileLogger = new Zend_Log($fileWriter);
			$this->_htmlFile = $stream2;
		}
		catch (Zend_Log_Exception $e){
			echo "Error: " . $e->getMessage(); }
		catch (Zend_Exception $e){
			echo "Error: " . $e->getMessage(); }
		ob_flush();
		flush();
		unset($fileWriter,$formatter);
	}

    protected function _getUser()
	{
		$auth = Zend_Auth::getInstance();
		$user=$auth->getIdentity();
		return $user->USER_ID;
	}

	protected function _getCustXlsLogFileInfo($file_link_nm=null,$purpose=null,$fileExtention='log')
	{
		$current_user=$this->_getUser();
		if($purpose=='VALIDATION')
			$target_folder="validation_logs/(*)";
		if($purpose=='UPLOAD')
			$target_folder="upload_logs/(*)";
		$current_date=date("Y-m-d");
		$files = glob(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder . $file_link_nm ."_@". $current_user ."_@". $current_date ."_@*.$fileExtention");
		//print_r($files);
		return $files;
	}

	protected function _crtHtolSortedFilesInfo($files,$fileExtention='log',$details=1)
	{
		foreach($files as $filename) {
		$lstatime = date("d-m-Y H:i:s.", fileatime($filename));
		$filenm=basename($filename);
		$file=explode('_@',$filenm);
		$file_no=basename($file[3],".$fileExtention");
			if($details){
				$allfilename[$file_no]['id']=$file_no; 
				$allfilename[$file_no]['filename']=$filenm; 
				$allfilename[$file_no]['lstatime']=$lstatime;
			}else 
				$allfilename[$file_no]=$filename; 	
		}
		krsort($allfilename);
		return $allfilename;
	}

	protected function _insertXlsDataToHtmlfile()
	{
		error_reporting(E_ALL ^ E_NOTICE);
		$xlsData= $this->_excel->dump(true,true);

		$htmlContent='
		<html>
		<head>
		<style>
		table.excel {
			border-style:ridge;
			border-width:1;
			border-collapse:collapse;
			font-family:sans-serif;
			font-size:12px;
		}
		table.excel thead th, table.excel tbody th {
			background:#CCCCCC;
			border-style:ridge;
			border-width:1;
			text-align: center;
			vertical-align:bottom;
		}
		table.excel tbody th {
			text-align:center;
			width:20px;
		}
		table.excel tbody td {
			vertical-align:bottom;
		}
		table.excel tbody td {
			padding: 0 3px;
			border: 1px solid #EEEEEE;
		}
		</style>
		</head>

		<body>'.
			$xlsData.'
		</body>
		</html>';

		fputs($this->_htmlFile,$htmlContent);
		fclose($this->_htmlFile);
		error_reporting(E_ALL);
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}
}

?>
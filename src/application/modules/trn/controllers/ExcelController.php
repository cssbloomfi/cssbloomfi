<?php
class trn_ExcelController extends modules_trn_controllers_TrnController
{
	protected $_refModel;
	protected $_trnModel;
	protected $_message;
	protected $_excel;
	protected $_columns;
	protected $_fileLogger;
	protected $_htmlFile;
	protected $_excelMessages;
	protected $_exportRows=5000;
	protected $_commetPerRows=1;
	protected $_payment_type_key;
	protected $_receipt_type_key;
	protected $_transactionId;
	protected $_valida_file_prefix = "trnXlsValid";
	protected $_upload_file_prefix = "trnXlsUpload";

	function preDispatch(){
		$this->_initialize();
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$applConfig = Zend_Registry::get('applConfig');
		$config=$this->_trnModel->getIniParameters($applConfig,'transactionImportExport','xls');
		if(!empty($config['exportRows']))$this->_exportRows=$config['exportRows'];
		if(!empty($config['importCommetPerRow']))$this->_commetPerRows=$config['importCommetPerRow'];
		$this->_session=Zend_Registry::get('SQL');
	}

	public function indexAction()
	{
		$this->_session->actionHelp=false;
		$labels=new modules_trn_labels_label;
		$this->_message=new modules_trn_messages_message;
		$this->view->viewlabels=$labels->getTrnExcelViewLabels('index');
		$this->view->formLabels=$labels->getTrnExcelFormLabels('form');
		$this->view->logTable=$labels->getTrnExcelTableLabels('log');
		$this->view->messages=$this->_excelMessages=$this->_message->getTrnExcelMessages('index');
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
						$this->view->textErrors= str_replace('@VAR1@',$this->view->viewlabels['uploadLogDetails'], $this->_excelMessages['uploadValidationError']);
						}
					}
					else
						$this->view->textSuccess=$this->_excelMessages['successUpload'];
				}
				$this->view->logDetailsHeader = $this->view->viewlabels['uploadLogDetails'];
			}
		 }

		 if(empty($this->view->logDetailsHeader))
			 $this->view->logDetailsHeader = $this->view->viewlabels['defaultLogDetails'];
			 $error_log_files1=$this->_getTrnXlsLogFileInfo($this->_upload_file_prefix,"UPLOAD");
			 $error_log_files2=$this->_getTrnXlsLogFileInfo($this->_valida_file_prefix,"VALIDATION");
			 $upload_xls_datas=$this->_getTrnXlsLogFileInfo($this->_upload_file_prefix,"UPLOAD",'html');
			 $valida_xls_datas=$this->_getTrnXlsLogFileInfo ($this->_valida_file_prefix,"VALIDATION",'html');
		  if($error_log_files1 && $upload_xls_datas) {
			$this->view->trnXlsUploadLogs =$this->_crtHtolSortedFilesInfo($error_log_files1);
			$this->view->trnXlsUploadDatas =$this->_crtHtolSortedFilesInfo($upload_xls_datas,'html');
		  }
		 if($error_log_files2 && $valida_xls_datas) {
			$this->view->trnXlsValidationLogs =$this->_crtHtolSortedFilesInfo($error_log_files2);
			$this->view->trnXlsValidationDatas =$this->_crtHtolSortedFilesInfo($valida_xls_datas,'html');
		 }

		 unset($labels,$this->_message,$upload);
	}

	public function transexportAction()
	{
		$this->_session->actionHelp=false;
		$this->view->title="Customer Payment and Receipt Informations";
		$page=$this->_request->getParam('page',1);
		$params=$custId=$empId=$scheme=null;
		$labels=new modules_trn_labels_label;
		$this->view->tableHeader=$labels->getTrnExcelTableLabels('transactionXlsView');
		$this->view->viewLabels=$labels->getTrnExcelViewLabels('transactionExport');
		$this->view->formLabels=$labels->getTrnExcelFormLabels('transactionExport');
		if($this->getRequest()->isPost()) {
			$request=$this->getRequest()->getPost('REQUEST');
			if($request=='search') {
				$custId=$this->getRequest()->getPost('custId');
				$empId=$this->getRequest()->getPost('empId');
				$scheme=$this->getRequest()->getPost('schemeId');
				$page=1;
			}
			if($request=='export') {
				$lib=new Applibrary_XlsUrlHelper;
				$srchParams=$this->getRequest()->getPost('params');
				$auParams=$this->createArrAndUrlParams($srchParams);
				$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_trnModel,'getTransDtlForXlsQuery', '/trn/excel/transxls/'.$auParams['url_params'], 'Transaction Xls Export File',
				$auParams['array_params'],$this->_exportRows);
			}
		}
		else{
			$custId=$this->_request->getParam('param1');
			$empId=$this->_request->getParam('param2');
			$scheme=$this->_request->getParam('param3');
		}
		$this->view->params=array($custId,$empId,$scheme);
		$this->view->pagiParams=$this->createPaginationParams($this->view->params);
		$pagiData=new Bloomfi_QueryFramework_PaginatorData;
		$this->view->result= $pagiData->getResultForPagination($this->_trnModel,'getTransDtlForXlsQuery',$this->view->params,$page,null,10);

		unset($lib,$this->_trnModel);
	}

	public function transxlsAction()
	{
		$labels=new modules_trn_labels_label;
		$this->view->xlsHeader=$labels->getTrnExcelTableLabels('transactionXls');
		$param[0]=$this->_request->getParam('param1');
		$param[1]=$this->_request->getParam('param2');
		$param[2]=$this->_request->getParam('param3');
		$this->view->xlsResult=$this->getDataForXls($this->_trnModel,'getTransDtlForXlsQuery',$param, $this->_exportRows);
		unset($labels,$this->_trnModel);
	}


	public function loadData($filename)
	{
		$transactionRun=false;
		$logmsg=$this->_message->getTrnExcelMessages('uploadingLogMsgs');
		$this->_excel = new Bloomfi_Excel_Excelreader($filename);
		if($this->_excel->readable==0) {
			$errors = array('UNREADABLE'=>$this->_excel->error);
			return $errors; }
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();
		$this->_receipt_type_key=$this->_trnModel->getAllReceiveTypesQuery();
		$errors=$emp_id=$cust_id=$scheme_id=$payment_type=$receive_type=$voucher_no=$memo_no=null;
		$effected_rows=$error_msgs=$success_rows=$unsuccess_rows=$transactionFlag=0;
		$file=basename($filename,".xls");
		//$allow=$this->_trnModel->waitAndAllow('DETAILS');
		//if($allow==1){
		//	$allow=0;
		//	$allow=$this->_trnModel->waitAndAllow('SUMMARY');
		//	if($allow==0)
		//		$this->_trnModel->releaseLock('DETAILS');
		//}
		//else {
		//	$this->_fileLogger->log($logmsg['tableStatusLock'],Zend_Log::NOTICE);
		//}
		$allow=1;
		if($allow==1)
		{
			$this->_setupXlsLoggerAndDataFile($this->_upload_file_prefix,'UPLOAD',$file);
			$this->_fileLogger->info("File Name -> ".$file);
			$this->_trnModel->resetProcessing();
			$this->_trnModel->startProcessing();
			$this->_insertXlsDataToHtmlfile();
			$this->_fileLogger->info($logmsg['tableStatusOpen']);
			$this->_fileLogger->info($logmsg['uploadingStart']);
			ini_set('_input_time','0');
			ini_set('_execution_time','0');
			ini_set('_input_time','0');
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
				//$this->_trnModel->releaseLock('SUMMARY');
				//$this->_trnModel->releaseLock('DETAILS');
				foreach($errors[1] as $key => $msg)
				$this->_fileLogger->log("'$key' $msg",Zend_Log::ERR);
				$this->_fileLogger->log($logmsg['fail'],Zend_Log::ALERT);
				return $errors;
			}
			$errors=array();
			$user=$this->_getUser();
			$prefix_1 = $this->_trnModel->getPaymentPrePostQuery();
			$prefix_2 = $this->_trnModel->getReceivePrePostQuery();
			for ($row = $start ; $row <= $end; $row++) {
					$due=0;
					$trns_summary=null;
				    $save_point='TRSD_'.$user.'_'.$row;
					$this->_trnModel->SavepointTransaction($save_point);
					if($transactionFlag==0){
						$this->_trnModel->startTransaction();
						$transactionRun=true;
					}
					$row_data=$this->_excel->sheets[0]['cells'][$row];
					if($this->_excel->tools->isEmptyRow($row_data)){
						$error_msgs = $this->validate($row_data);
						if($row)$current_row="[Row - $row] ";
						if(!$error_msgs){
							$save_point='TRSD_'.$user.'_'.$row;
							$this->_trnModel->SavepointTransaction($save_point);
							$error_msgs=$voucher=$memo=null;
							$emp_id = $row_data[$this->_columns['COLLECTOR_CODE']];
							$cust_id = $row_data[$this->_columns['CLIENT_CODE']];
							$scheme= $this->_refModel->getSchmByNmQuery($row_data[$this->_columns['PROJECT']]);

							$scheme_id = $scheme[0]->SCHEME_ID;
							$trn_date= $row_data[$this->_columns['TRANSACTION_DATE']];
							$trn_date=$this->_excel->tools->convertDateToDate($trn_date);

							$trnsSmryIdinfo=$this->_trnModel->transactionSummariesByCustID($cust_id);
							if($trnsSmryIdinfo)
							$trns_summary=$this->_trnModel-> getTransactionSummaryQuery($trnsSmryIdinfo[0]->TRAN_SUMMARY_ID);
	//$this->testPrint($trns_summary);
							if( !empty($row_data[$this->_columns['PAYMENT_TYPE']]) )
							{
								$payment_type=$row_data[$this->_columns['PAYMENT_TYPE']];
								$payment_amount= $row_data[$this->_columns['PAYMENT']];
								$payment_amount=(float)$this->_excel->tools->removeComma($payment_amount);
								if(isset($row_data[$this->_columns['VOUCHER_NO']]))
									$voucher=$row_data[$this->_columns['VOUCHER_NO']];
								$receive_due_amount=$payment_amount;
								$memo=null;
			//	$this->testPrint($cust_id." Voucher : ".$voucher);
								//-------------------------------------------------
								if( $payment_type == $this->_payment_type_key[0]->VALUE_NAME ) //CAPITAL_PAID
								{
									$this->_trnModel->insertRowInSummaryDML();
									$summary__id=$this->_trnModel->getLastInsertedId();
									$new_trns_id=$prefix_1[0]->PREFIX_VALUE.$summary__id->ID;

									$this->_trnModel->insertRowInDetailDML();
									$detail__id=$this->_trnModel->getLastInsertedId();
									$new_td_row_id = $detail__id->ID;
									$new_detail_id=$prefix_2[0]->PREFIX_VALUE.$new_td_row_id;

									$trn_smry_data=array($new_trns_id,$scheme_id,$this->_customerId,$emp_id, $payment_amount,$receive_due_amount,$trn_date,'',$summary__id->ID);

									$trn_dtl_data=array($new_detail_id, $new_trns_id, $scheme_id,
													$this->_customerId, $emp_id, $payment_amount, $payment_type, $voucher, $memo,$trn_date,  '',$this->_customerName, $this->_customerGender, $detail__id->ID);

									$status1=$this->_trnModel->updateInsertedCustPaymentDML($trn_smry_data);
									$status2=$this->_trnModel->updateInsertedPaymentDetailDML($trn_dtl_data);
									if($status1 && $status2){
										$success_rows++;
									}
									else{
										$this->_refModel->RollbackTransaction($save_point);
										$unsuccess_rows++;
									}
								}else// BSD_PAID
								{
									$dueAmount=$trns_summary[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
									$receiptSecurityAmount = $trns_summary[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
									$receiptSecurityAmount = $trns_summary[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
									$transId = $trns_summary[0]->TRAN_SUMMARY_ID;
									$s_id = $trns_summary[0]->SCHEME_ID;
									if($dueAmount<=0)
									{
										if($receiptSecurityAmount==$payment_amount)
										{
									  	    $status= $this->_trnModel->updateSecurityDeposAmountDML( array($payment_amount,$transId));
											$this->_trnModel->insertRowInDetailDML();
											$detail__id=$this->_trnModel->getLastInsertedId();
											$new_td_row_id = $detail__id->ID;
											$new_detail_id=$prefix_2[0]->PREFIX_VALUE.$new_td_row_id;
											$data_ordered = array ($new_detail_id, $transId, $s_id,
											$this->_customerId, $emp_id, $payment_amount, $payment_type, $voucher,$memo,
											$trn_date, $remarks,$this->_customerName, $this->_customerGender, $new_td_row_id);
											$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered);
											if($status && $status2)
											{
												$status= $this->_trnModel->updateSmryStatusToCloseDML($transId);
												if($status)
												{
													$success_rows++;
													$this->_trnModel->commitTransaction();
													$c_id=$s_id=$remarks=null;
													$msg=$this->_excelMessages['accountClose'];
													$msg=str_replace('@VAR1@',$cust_id,$msg);
													$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE ]'.$msg,Zend_Log::INFO);

												}else{
													$msg=$this->_excelMessages['unabelToClose'];
													$error_msgs['CLIENT_CODE, PAYMENT_TYPE']= str_replace('@VAR1@',$cust_id,$msg);
													$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE, PAYMENT_TYPE ]'. $error_msgs['CLIENT_CODE, PAYMENT_TYPE'],Zend_Log::ERR);
													$unsuccess_rows++;
												}
											}
											else{
												$msg=$this->_excelMessages['accountClosed'];
												$error_msgs['CLIENT_CODE']=str_replace('@VAR1@',$cust_id,$msg);
												$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE ]'. $error_msgs['CLIENT_CODE'] ,Zend_Log::ERR);
												$unsuccess_rows++;
											}
										}
										else
										{
											$msg=$this->_excelMessages['securityAmount'];
											$error_msgs['CLIENT_CODE, PAYMENT_TYPE']=str_replace('@VAR1@',$receiptSecurityAmount,$msg);
											$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE, PAYMENT_TYPE ]'. $error_msgs['CLIENT_CODE, PAYMENT_TYPE'],Zend_Log::ERR);
											$unsuccess_rows++;
										}
									}
									else
									{
										//BSD_PAYMENT CAN NOT BE DONE
										$msg=$this->_excelMessages['dueAmount'];
										$msg=str_replace('@VAR1@',$cust_id,$msg);
										$error_msgs['CLIENT_CODE, PAYMENT_TYPE']=str_replace('@VAR2@',$dueAmount,$msg);

										$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - CLIENT_CODE, PAYMENT_TYPE ]'. $error_msgs['CLIENT_CODE, PAYMENT_TYPE'],Zend_Log::ERR);
										$unsuccess_rows++;
									}
								}
								//----------------------------------------------------
							}
							else{
								$receipt_type=$row_data[$this->_columns['RECEIVE_TYPE']];
								$memo_no=$row_data[$this->_columns['MEMO_NO']];
								$receipt_amount=$row_data[$this->_columns['RECEIVE']];
								$receipt_amount=(float)$this->_excel->tools->removeComma($receipt_amount);

								if(!$trns_summary) {

									// IF NO PAYMENT EXIST ...................................

									//$error_msgs['CLIENT_CODE'] = $this->_excelMessages['noTransSmry'];
									//$voucher=$this->_customerId;
									$this->_trnModel->insertRowInSummaryDML();
									$summary__id=$this->_trnModel->getLastInsertedId();
									$new_ts_row_id = $summary__id->ID;
									//die($new_ts_row_id);
									$transaction_id=$prefix_1[0]->PREFIX_VALUE.$new_ts_row_id;

									$this->_trnModel->insertRowInDetailDML();
									$detail__id=$this->_trnModel->getLastInsertedId();
									$new_td_row_id = $detail__id->ID;
									$new_detail_id=$prefix_2[0]->PREFIX_VALUE.$new_td_row_id;
									$remarks='Please set the payment amount';
									$voucher=$cust_id;

									$data_ordered = array($transaction_id,$scheme_id,$cust_id,
											$emp_id, 0, 0,$trn_date,'Auto Generated',$new_ts_row_id);

									$data_ordered1 = array ($new_detail_id, $transaction_id, $scheme_id,
										$this->_customerId, $emp_id, 0, $this->_payment_type_key[0]->VALUE_NAME, $voucher,null,
										$trn_date, $remarks,$this->_customerName, $this->_customerGender, $new_td_row_id);

									$status1=$this->_trnModel->updateInsertedCustPaymentDML($data_ordered);
									$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
									//if($status1 && $status2)
									$ts_id=$transaction_id;
									$current_recipt_due =0;
									$current_recipt_amount = 0;
									$current_recpt_security_depos=0;
									$current_recpt_donation=0;
									$current_recpt_fees=0;

								/*	foreach($error_msgs as $key=>$msg){
										$this->_fileLogger->log ('[ ROW - '.$row.' ] [COLUMN - '.$key.']'.$msg,Zend_Log::ERR);
									}*/

								}else
								{
									$transaction_id=$trns_summary[0]->TRAN_SUMMARY_ID;
									$current_recipt_due =(float)$trns_summary[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
									$current_recipt_amount = (float)$trns_summary[0]->TOTAL_RECEIPT_PRINCIPAL;
									$current_recpt_security_depos=(float)$trns_summary[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
									$current_recpt_donation=(float)$trns_summary[0]->TOTAL_RECEIPT_DONATION;
									$current_recpt_fees=(float)$trns_summary[0]->TOTAL_RECEIPT_FEES;
									$scheme_id=$trns_summary[0]->SCHEME_ID;
								}


								//--------------------------------------------------------------------
									// GET ALL DATA SET
								$amounts=$this->getReceiptAmountValueSet($this->_receipt_type_key,$receipt_amount,array($receipt_type, $current_recipt_amount, $current_recipt_due, $current_recpt_security_depos, $current_recpt_donation,$current_recpt_fees ));

								$total_recept_amount=$amounts[0];
								$total_recept_due=$amounts[1];
								$total_recept_security_depos=$amounts[2];
								$total_recept_donation=$amounts[3];
								$total_recept_fees=$amounts[4];

								//--------------------------------------------------------------------
								if(isset($trns_summary[0]->TOTAL_DETAILS))
									$total_details_on_ts = $trns_summary[0]->TOTAL_DETAILS+1;
								else $total_details_on_ts = 2;
								 //===========================================================================

								$this->_trnModel->insertRowInDetailDML();
								$detail__id=$this->_trnModel->getLastInsertedId();
								$new_td_row_id = $detail__id->ID;
								$new_detail_id=$prefix_2[0]->PREFIX_VALUE.$new_td_row_id;
								$remarks='Please set the payment amount';

								$data_ordered1=array($new_detail_id, $transaction_id, $scheme_id,
									$this->_customerId, $emp_id, $receipt_type,$memo_no,$receipt_amount,$trn_date,null,$detail__id->ID);

								$status1=$this->_trnModel->updateInsertedReceiptDetailDML($data_ordered1);

								$data_ordered2=array($total_recept_amount, $total_recept_due,$total_recept_donation, $total_recept_fees, $total_recept_security_depos, $trn_date, $total_details_on_ts, $transaction_id);

								$status2=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($data_ordered2);

								if($status1 && $status2){
									$success_rows++;
								}
								else{
									$this->_refModel->RollbackTransaction($save_point);
									$unsuccess_rows++;
								}

							}
							$transactionFlag++;
							if($transactionFlag==$this->_commetPerRows){
								$this->_refModel->commitTransaction();
								$transactionFlag=0;
								$transactionRun=false;
							}
						}
						else
						{
							//error
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
				}

				//$this->_trnModel->releaseLock('SUMMARY');
				//$this->_trnModel->releaseLock('DETAILS');
		}
		else {
			$this->_fileLogger->log($logmsg['tableStatusLock'],Zend_Log::NOTICE);
			return 'LOCK';
		}

		if($transactionRun==true)$this->_trnModel->commitTransaction();
		$msg_effected=str_replace('@VAR1@',$effected_rows,$logmsg['effectedRows']);
		$msg_success_rows=str_replace('@VAR1@',$success_rows,$logmsg['successRows']);
		$msg_unsuccess_rows=str_replace('@VAR1@',$unsuccess_rows,$logmsg['unSuccessRows']);
		$this->_fileLogger->info($msg_effected);
		$this->_fileLogger->info($msg_success_rows);
		$this->_fileLogger->info($msg_unsuccess_rows);
		$this->_trnModel->endProcessing();
		$this->_fileLogger->info("Total Consumed time for uploading process is : ".$this->_trnModel->getTotalProcessingTime(2));
		$this->_refModel->destroy();
		$this->_trnModel->destroy();
		ob_flush();
		flush();

		unset($this->_refModel,$this->_trnModel,$this->_excel,$this->_columns,$this->_fileLogger);
	//	print_r($errors);

		return $errors;
	}

	public function validateXlsFileData($file)
	{
		$logmsg=$this->_message->getTrnExcelMessages('validationLogMsgs');
		$this->_excel = new Bloomfi_Excel_Excelreader($file);
		if($this->_excel->readable==0) {
			$errors = array('UNREADABLE'=>$this->_excel->error);
			return $errors; }
		set_time_limit(3600);
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();
		$data=$errors=$error_msgs=$cust_id=$scheme_id=$result=null;
		$filename=basename($file,".xls");
		$this->_setupXlsLoggerAndDataFile($this->_valida_file_prefix,'VALIDATION',$filename);
		$this->_fileLogger->info("File Name -> ".$filename);
		$this->_trnModel->resetProcessing();
		$this->_trnModel->startProcessing();
		$this->_insertXlsDataToHtmlfile();
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
			if($this->_excel->tools->isEmptyRow($row_data)){
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
		$this->_trnModel->endProcessing();
		$this->_fileLogger->info("Total Consumed time for validation process is : ".$this->_trnModel->getTotalProcessingTime(2));
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
		$columns=array('CLIENT_CODE','COLLECTOR_CODE','PROJECT','PAYMENT', 'PAYMENT_TYPE','VOUCHER_NO','MEMO_NO','RECEIVE','RECEIVE_TYPE','TRANSACTION_DATE');
		foreach($columns as $column){
			$flag=0;
			foreach($this->_columns as $col=>$value){
				if($col==$column){
					$flag=1;
					break;
				}
			}
			if($flag==0)
				$errors[$column]=$this->_excelMessages['errorColumn'];
		}
		$error[1]=$errors;
		return $error;
	}

	protected function validate($data,$row=null)
	{
		$errors=$msg=$current_row=$emp_id=$cust_id=$scheme_id=$payment_type=$receive_type=$scheme=
		$voucher_no=$memo_no=$receive=$payment=$paymentAmount=$receiveAmount=$trans_date=null;

		if($row)$current_row="[Row - $row] ";

		if(isset($data[$this->_columns['COLLECTOR_CODE']]))
			$emp_id = trim($data[$this->_columns['COLLECTOR_CODE']]);
		if(isset($data[$this->_columns['CLIENT_CODE']]))
			$cust_id = trim($data[$this->_columns['CLIENT_CODE']]);
		if(isset($data[$this->_columns['PROJECT']]))
			$scheme = trim($data[$this->_columns['PROJECT']]);
		if(isset($data[$this->_columns['PAYMENT']]))
			$payment=trim($data[$this->_columns['PAYMENT']]);
		if(isset($data[$this->_columns['RECEIVE']]))
			$receive=trim($data[$this->_columns['RECEIVE']]);
		if(isset($data[$this->_columns['PAYMENT_TYPE']]))
			$payment_type=trim($data[$this->_columns['PAYMENT_TYPE']]);
		if(isset($data[$this->_columns['RECEIVE_TYPE']]))
			$receive_type=trim($data[$this->_columns['RECEIVE_TYPE']]);
		if(isset($data[$this->_columns['MEMO_NO']]))
			$memo_no = trim($data[$this->_columns['MEMO_NO']]);
		if(isset($data[$this->_columns['VOUCHER_NO']]))
			$voucher_no = trim($data[$this->_columns['VOUCHER_NO']]);
		if(isset($data[$this->_columns['TRANSACTION_DATE']]))
			$trans_date = trim($data[$this->_columns['TRANSACTION_DATE']]);

		//------------------------Employee-----------------------------

		if($emp_id){
			$result=$this->_refModel->getEmployeeQuery($emp_id);
			if(!$result){
				$msg=str_replace('@VAR1@',$emp_id,$this->_excelMessages['employeeInvalid']);
				$errors['COLLECTOR_CODE'] = $current_row.$msg;
			}
		}
		else
			$errors['COLLECTOR_CODE'] = $current_row.$this->_excelMessages['employeeEmpty'];

		//------------------------Customer-----------------------------

		if($cust_id){
			$result = $this->_refModel->getCustomerQuery($cust_id);
			if(!$result){
				$msg=str_replace('@VAR1@',$cust_id,$this->_excelMessages['customerInvalid']);
				$errors['CLIENT_CODE'] = $current_row.$msg;
			}else{
				$this->_customerName=$result[0]->ENTITY_NAME;
				$this->_customerGender=$result[0]->SEX;
				$this->_customerId=$result[0]->ENTITY_ID;
			}
		}
		else
			$errors['CLIENT_CODE'] = $current_row.$this->_excelMessages['customerEmpty'];


		//------------------------Scheme-----------------------------

	/*	if($scheme){
			$result = $this->_refModel->getSchmByNmQuery( $scheme );
			if(!$result){
				$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeInvalid']);
				$errors['PROJECT'] = $current_row.$msg;
			}else{
				$scheme_id = $this->_trnModel->getSchemeByCidQuery($cust_id);
				if($scheme_id){
					$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeRunning']);
					$msg=str_replace('@VAR2@',$scheme_id,$msg);
					$msg=str_replace('@VAR3@',$cust_id,$msg);
					$errors['PROJECT'] = $current_row.$msg;
				}
			}
		}
		else
			$errors['PROJECT'] = $current_row.$this->_excelMessages['schemeEmpty'];   */


		//------------------------Payment-----------------------------

		if($payment){
			$paymentAmount = (float) $this->_excel->tools->removeComma( $payment );
		}
		if($paymentAmount)
			{
				if ( $paymentAmount < 0 ){
					$msg=str_replace('@VAR1@',$paymentAmount,$this->_excelMessages['paymentInvalid']);
					$errors['PAYMENT'] = $current_row.$msg;
				}
				if($payment_type){
					$exist=false;

					foreach($this->_payment_type_key as $type)
					{
						if($type->VALUE_NAME==$payment_type) { $exist=true; break; }
					}
					if($exist==false)
					$errors['PAYMENT_TYPE']=$current_row.$this->_excelMessages['paymentTypeInvalid'];
					else{
						if($scheme){
							$result = $this->_refModel->getSchmByNmQuery( $scheme );
							if(!$result){
								$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeInvalid']);
								$errors['PROJECT'] = $current_row.$msg;
							}else
							if($payment_type!=$this->_payment_type_key[1]->VALUE_NAME)	
							{
								$scheme_id = $this->_trnModel->getSchemeByCidQuery($cust_id);
								if($scheme_id){
									$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeRunning']);
									$msg=str_replace('@VAR2@',$scheme_id,$msg);
									$msg=str_replace('@VAR3@',$cust_id,$msg);
									$errors['PROJECT'] = $current_row.$msg;
								}
							}if($payment_type==$this->_payment_type_key[1]->VALUE_NAME)	
							{
								$result=$this->_trnModel->isExistBSDPaymentTypeQuery(array($cust_id,$this->_payment_type_key[1]->VALUE_NAME));
								if($result) {
									$errors['PAYMENT_TYPE']=str_replace('@VAR1@',$cust_id,$this->_excelMessages['bsdPayExist']);
								}
							}
						}
						else
							$errors['PROJECT'] = $current_row.$this->_excelMessages['schemeEmpty'];
					}
				}
				else
				{
					$errors['PAYMENT_TYPE'] = $current_row.$this->_excelMessages['paymentTypeEmpty'];
				}

				if(isset($voucher_no)){
					if(!strstr($voucher_no, " "))
					{
						$result=$this->_trnModel->isVoucherNoQuery($voucher_no);
						if($result){
							$msg= str_replace('@VAR1@',$voucher_no, $this->_excelMessages['duplicateVoucher']);
							$errors['VOUCHER_NO'] = $current_row.$msg;
						}
					}else{														$msg=str_replace('@s@','(s)',str_replace('@VAR1@',$voucher_no,$this->_excelMessages['voucherSpaceExist']));
						$errors['VOUCHER_NO'] = $current_row.$msg;
					}
				}

				if(isset($voucher_no) && isset($memo_no)){
					$errors['VOUCHER_NO, MEMO_NO'] = $current_row.$this->_excelMessages['voucherMemoFill'];
				}
				else{
				if(!$voucher_no && !$memo_no)
					$errors['VOUCHER_NO, MEMO_NO'] = $current_row.$this->_excelMessages['voucherMemoEmpty'];
				else{
					if(isset($voucher_no) && isset($payment_type))
					{
						if(($payment_type!=$this->_payment_type_key[0]->VALUE_NAME) && ($payment_type!=$this->_payment_type_key[1]->VALUE_NAME) )
							{
								$errors['PAYMENT_TYPE'] = $this->_excelMessages['paymentTypeValueInvalid'];
							}
					}
					else
					{
						if(!isset($voucher_no) && isset($payment_type))
						{
							$errors['VOUCHER_NO'] = $this->_excelMessages['paymentVoucherEmpty'];
						}
					}
				}}
			}

		//------------------------Receive-----------------------------

		if( empty($payment) && !empty($receive) )
		{
			$receiveAmount = (float)$this->_excel->tools->removeComma($receive);
			if($receiveAmount)
			{
				if($receiveAmount < 0)
					$errors['RECEIVE'] = $current_row.$this->_excelMessages['receiptValueInvalid'];

				if($receive_type){
					if($scheme){
						$result = $this->_refModel->getSchmByNmQuery( $scheme );
						if(!$result){
							$msg=str_replace('@VAR1@',$scheme,$this->_excelMessages['schemeInvalid']);
							$errors['PROJECT'] = $current_row.$msg;
						}else{
							$scheme_id = $this->_trnModel->getSchemeByCidQuery($cust_id);
							if(!$scheme_id){
								$msg=str_replace('@VAR1@',$cust_id,$this->_excelMessages['noPayment']);
								$errors['PROJECT'] = $current_row.$msg;
							}
						}
					}
					else
						$errors['PROJECT'] = $current_row.$this->_excelMessages['schemeEmpty'];
					$result=$this->_trnModel->isReceiveTypeQuery($receive_type);
					if(!$result)
						$errors['RECEIVE_TYPE']= $current_row.$this->_excelMessages['receiptTypeInvalid'];
					else {
						if($receive_type==$this->_receipt_type_key[1]->VALUE_NAME){
						$result=$this->_trnModel->isExistBSDReceiptTypeQuery(array($cust_id,$this->_receipt_type_key[1]->VALUE_NAME));
						if($result) $errors['RECEIVE_TYPE']=str_replace('@VAR1@',$cust_id,$this->_excelMessages['receiptType']);
						}
					}

				}
				else
					$errors['RECEIVE_TYPE'] = $current_row.$this->_excelMessages['receiptTypeEmpty'];

				if($memo_no) {
					if(!strstr($memo_no, " "))
					{
						$result=$this->_trnModel->isMemoNoQuery($memo_no);
						if($result){
							$msg=str_replace('@VAR1@',$memo_no,$this->_excelMessages['duplicateMemo']);
							$errors['MEMO_NO'] = $current_row.$msg;
						}
					}else{														$msg=str_replace('@s@','(s)',str_replace('@VAR1@',$memo_no,$this->_excelMessages['memoSpaceExist']));
						$errors['MEMO_NO'] = $current_row.$msg;
					}
				}
				else{
					$errors['MEMO_NO'] = $current_row.$this->_excelMessages['receiptMemoEmpty'];
				}

			}
		}



		//----------------------- Payment & Receive-----------------------------

		if( !empty($payment) && !empty($receive) )
				$errors['PAYMENT, RECEIVE'] = $current_row.$this->_excelMessages['paymentReceiptAmountExist'];

		if(empty($payment_type) && empty($receive_type) )
			$errors['PAYMENT_TYPE, RECEIVE_TYPE'] = $current_row.$this->_excelMessages['paymentReceiptEmpty'];

		//------------------------Employee-----------------------------

		if(!$trans_date) {
			$errors['TRANSACTION_DATE'] = $current_row.$this->_excelMessages['dateEmpty'];
		}else{
			$date =$this->_excel->tools->convertDateToDate($trans_date);
			if(!$date)
				$errors['CLIENT_ENTRY_DATE'] = $current_row.$this->_excelMessages['incorrectDateFormat'];
		}

		ob_flush();
		flush();

		//print_r( $errors );
		return $errors;
	}


	public function _setupXlsLoggerAndDataFile($file_link_nm,$purpose=null,$originalFileNm="FILE")
	{
		$target_folder=null;
		$format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
		$formatter = new Zend_Log_Formatter_Simple($format);
		$current_user=$this->_getUser();
		$files=$this->_getTrnXlsLogFileInfo($file_link_nm,$purpose);
		if($files) {
		$files=$this->_crtHtolSortedFilesInfo($files,'log',null);
		foreach($files as $file) break;
		$filenm=basename($file,'.log');
		$no=explode('_@',$filenm);
		$new_no=$no[3]+1; }
		else $new_no=1;
		if($purpose=='VALIDATION')
			$target_folder="validation_logs/(".$originalFileNm.")";
		if($purpose=='UPLOAD')
			$target_folder="upload_logs/(".$originalFileNm.")";
		$stream1 = @fopen(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder.$file_link_nm ."_@" .$current_user ."_@". date("Y-m-d"). "_@". $new_no . ".log", 'w', true);
		$stream2 = @fopen(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder.$file_link_nm ."_@" .$current_user ."_@". date("Y-m-d"). "_@". $new_no . ".html", 'w', true);
		if (!$stream1 || !$stream2){
			throw new Exception('Failed to open stream');
		}
		try {
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

	protected function _getTrnXlsLogFileInfo($file_link_nm=null,$purpose=null,$fileExtention='log')
	{
		$current_user=$this->_getUser();
		if($purpose=='VALIDATION')
			$target_folder="validation_logs/(*)";
		if($purpose=='UPLOAD')
			$target_folder="upload_logs/(*)";
		$current_date=date("Y-m-d");
		$files = glob(ROOT_DIR . "/tmp/logs/xlslogs/".$target_folder . $file_link_nm ."_@". $current_user ."_@". $current_date ."_@*.$fileExtention");
	//	print_r($files);
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
}

?>
<?php

class trn_PaymentController extends modules_trn_controllers_TrnController
{

	protected $_trnModel;
	protected $_refModel;
	protected $_customerId;
	protected $_employeeId;
	protected $_customerInfo=null;
	protected $_path=null;

    function preDispatch(){
		$this->_initialize();
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_trnConfig = new modules_trn_config_trnConfig;
	}

	function postDispatch(){
		$this->_refModel->destroy();
		$this->_trnModel->destroy();
		unset($this->_refModel,$this->_trnModel);
	}

	public function indexAction()
	{
		$this->_session->callerAction='index';
		$this->_session->HelpController='payment';
		ini_set('max_input_time','0');
		ini_set('max_execution_time','0');
		ini_set('max_input_time','0');
		$this->view->title = "Master Payment transaction";
		$this->view->format=new Bloomfi_NumericFormat;
		$element =new Bloomfi_App_UHtmlElement;
		$flag=$check=$current_page=$voucher_ids=$srch_schm_type=$seperator=$data=$search_url_params=$pass=
		$search_params=$success_row=$error_row=null;
		$srch_cust_name=$srch_emp_name=$srch_schm=$srch_schm_type=$srch_cust_id=$srch_emp_id= $srch_voucher=$srch_start_dt=$srch_end_dt=null;
		$pay_types=$this->_trnModel->getAllPaymentTypesQuery();
		$labels=new modules_trn_labels_label;
		$message = new modules_trn_messages_message;
		$indexmsg=$this->view->confirmMsg = $message->getTrnPaymentMessages('confirm');
		$this->view->searchForm=$labels->getTrnPaymentFormLabels('paymentsrch');
		$this->view->viewlabels=$labels->getTrnPaymentViewLabels('index');
		$this->view->links=$labels->getTrnAllLinkLabels('payIndex');
		$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
		$configValues=$this->_trnConfig->getConfigValues('paymentIndexPagination');
		$rows = $configValues['rows'];
		$page=$this->_request->getParam('page',1);
	    Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);
	    if($this->_session->state==1 && $this->_session->controller=='payment')
	    {
		    $this->_session->state=0;
		    $data_bundle=$this->_trnModel->executeSessionSQL($this->_session->sql,"Payment Info");
		    $summary_info=$data_bundle['result'];
		    $count=$this->_session->counter;
			$url=$this->_session->indexUrl;
			$search=$this->_getParam('search');
			if($search){
				$this->view->cnm=$this->_request->getParam('cnm',null);
				$this->view->cid=$this->_request->getParam('cid',null);
				$this->view->enm=$this->_request->getParam('enm',null);
				$this->view->eid=$this->_request->getParam('eid',null);
				$this->view->schm=$this->_request->getParam('schm',null);
				$srch_schm_type=$this->view->schmType=$this->_request->getParam('param1',null);
				$this->view->vchr=$this->_request->getParam('vchr',null);
				$this->view->strdt=$this->_request->getParam('strdt',null);
				$this->view->enddt=$this->_request->getParam('enddt',null);
				$this->view->srch=1;
			}
		}
		else
		{
			if ( $this->getRequest()->isPost() )
			{
				$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
				$request= $this->getRequest()->getPost('REQUEST');

				if ( $request == 'Search' )
				{
					$page=1;
					$srch_cust_name = trim($this->getRequest()->getPost('customer_name'));
					$srch_cust_id = trim($this->getRequest()->getPost('customer_id'));
					$srch_emp_name = trim($this->getRequest()->getPost('employee_name'));
					$srch_emp_id = trim($this->getRequest()->getPost('employee_id'));
					$srch_schm = trim($this->getRequest()->getPost('scheme'));
					$srch_schm_type = trim($this->getRequest()->getPost('scheme_type'));
					$srch_voucher = trim($this->getRequest()->getPost('voucher'));
					$srch_start_dt = trim($this->getRequest()->getPost('startDate'));
					$srch_end_dt = trim($this->getRequest()->getPost('endDate'));
					if(empty($srch_start_dt)) $srch_start_dt='2007-1-1';
					if(empty($srch_end_dt)) $srch_end_dt=date('Y-m-d');
					$this->view->cnm=$srch_cust_name;
					$this->view->cid=$srch_cust_id;
					$this->view->enm=$srch_emp_name;
					$this->view->eid=$srch_emp_id;
					$this->view->schm=$srch_schm;
					$this->view->schmType=$srch_schm_type;
					$this->view->vchr=$srch_voucher;
					$this->view->strdt=$srch_start_dt;
					$this->view->enddt=$srch_end_dt;
					$this->view->srch=1;
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$data=array($srch_cust_name,$srch_emp_name,$srch_schm,$srch_schm_type,$srch_cust_id,$srch_emp_id, $srch_voucher,$srch_start_dt,$srch_end_dt);
					$cons_summary_data = array_merge((array)$data,(array)$pagination_limits);
					$data_bundle =  $this->_trnModel->getTransactionSummaryBySrchQuery($cons_summary_data);
					$summary_info = $data_bundle['result'];
					$count=count($summary_info);
					if($summary_info){
							$search_url_params="/index/search/1/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt/page/$page";
							$this->view->searchparams="/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt";
						$this->view->arrayparams="$srch_cust_name/$srch_emp_name/$srch_schm/$srch_schm_type/$srch_cust_id/$srch_emp_id/$srch_voucher/$srch_start_dt/$srch_end_dt";
					}
					$url = $this->_trnModel->getBaseURL()."/trn/payment".$search_url_params;
				}

				if ( $request == 'Delete' )
				{
					$msg = $message->getTrnPaymentMessages('dbDelete');
					$seperator=$val_id=$datas=$valid_id=null;

					
					foreach($this->getRequest()->getPost('tdid') as $id)
					{
						$transIdInfo=$this->_trnModel->getCombinedTransInfoOnTdIdQuery($id);

						if($transIdInfo)
						{
							if($transIdInfo[0]->PAYMENT_TYPE==$pay_types[0]->VALUE_NAME){
								if ( $transIdInfo[0]->TOTAL_DETAILS > 1 )
								{
									$dtlNo=$transIdInfo[0]->TOTAL_DETAILS-1;
									$error_row[$id]=str_replace('@VAR2@',$dtlNo,str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['custUnableDelete']));	
								}else{
									if($transIdInfo[0]->TOTAL_PAYMENT_SECURITY_DEPOSITE==0){
										$status=$this->_trnModel->cancelTrnSummaryOnTsId2DML($transIdInfo[0]->TRAN_SUMMARY_ID);
										if($status) $success_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['voucherDeleted']);
										else $error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['unableToDelete']);
									}else{
										$error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['unableToDelete2']);
									}
								}
							}
							else if($transIdInfo[0]->PAYMENT_TYPE==$pay_types[1]->VALUE_NAME)
							{
								$status1=$this->_trnModel->updateBSDToZeroAndOpenAccDML($transIdInfo[0]->TRAN_SUMMARY_ID);
								$status2=$this->_trnModel->deleteTrnDetailsDML($id);
								if($status1!=null && $status2!=null)
									$success_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['bsdDeleted']);
								else $error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$indexmsg['bsdDeleteUnable']);
							}
						}
					} 
					$this->view->textSuccess=$success_row;
					$this->view->textErrors = $error_row; 

					$search_params=$this->getRequest()->getPost('params');
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					if(trim(join('',explode('/',$search_params))) != ''){
						$s_param=explode('/',$search_params);
						if( $s_param[0] ) $srch_cust_name =$s_param[0] ;
						else $srch_cust_name =null ;
						if( $s_param[1] ) $srch_cust_id =$s_param[1] ;
						else $srch_cust_id =null ;
						if( $s_param[2] ) $srch_emp_name =$s_param[2] ;
						else $srch_emp_name =null ;
						if( $s_param[3] ) $srch_emp_id =$s_param[3] ;
						else $srch_emp_id=null ;
						if( $s_param[4] ) $srch_schm =$s_param[4] ;
						else $srch_schm=null ;
						if( $s_param[5] ) $srch_voucher =$s_param[5] ;
						else $srch_voucher=null ;
						if( $s_param[6] ) $srch_start_dt =$s_param[6] ;
						else $srch_start_dt='2007-1-1';
						if( $s_param[7] ) $srch_end_dt =$s_param[7] ;
						else $srch_end_dt=date('Y-m-d');
						if( $s_param[8] ) $current_page =$s_param[8] ;
						else $current_page =null ;
						if( $s_param[9] ) $srch_schm_type =$s_param[9] ;
						else $srch_schm_type =null ;
						$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
						$data=array($srch_cust_name,$srch_emp_name,$srch_schm,$srch_schm_type, $srch_cust_id,$srch_emp_id, $srch_voucher,$srch_start_dt,$srch_end_dt);
						$cons_summary_data = array_merge((array)$data,(array)$pagination_limits);
						$data_bundle =  $this->_trnModel->getTransactionSummaryBySrchQuery($cons_summary_data);
						$summary_info = $data_bundle['result'];
						$count=count($summary_info);
						if($summary_info){
							$this->view->cnm=$srch_cust_name;
							$this->view->cid=$srch_cust_id;
							$this->view->enm=$srch_emp_name;
							$this->view->eid=$srch_emp_id;
							$this->view->schm=$srch_schm;
							$this->view->schmType=$srch_schm_type;
							$this->view->vchr=$srch_voucher;
							$this->view->strdt=$srch_start_dt;
							$this->view->enddt=$srch_end_dt;
							$this->view->srch=1;		$search_url_params="/index/search/1/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt/page/$page";
							$this->view->searchparams="/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt";
							$this->view->arrayparams="$srch_cust_name/$srch_emp_name/$srch_schm/$srch_schm_type/$srch_cust_id/$srch_emp_id/$srch_voucher/$srch_start_dt/$srch_end_dt";
						}
						$url = $this->_trnModel->getBaseURL()."/trn/payment".$search_url_params;
					}
					else {
						$data_bundle =  $this->_trnModel->getAllTransactionSummaryQuery($pagination_limits);
						$summary_info = $data_bundle['result'];
					    $count=count($summary_info);
						$url=$this->_trnModel->getCurrentPageURL();
					}
					$lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					if($lower_limit>=$rows && $count==0)
						$count=1;
				}

				if($request!='Search' && $request!='Delete'){
					$arrayParams=null;
					$lib=new Applibrary_XlsUrlHelper;
					$srchParams=$this->getRequest()->getPost('searchparams');
					$arrParams=$this->getRequest()->getPost('arrayparams');
					$search=$this->getRequest()->getPost('search');
					$arrayParams=explode('/',$arrParams);
					if(empty($arrayParams[0])) $arrayParams[0]=null;
					if(empty($arrayParams[1])) $arrayParams[1]=null;
					if(empty($arrayParams[2])) $arrayParams[2]=null;
					if(empty($arrayParams[3])) $arrayParams[3]=null;
					if(empty($arrayParams[4])) $arrayParams[4]=null;
					if(empty($arrayParams[5])) $arrayParams[5]=null;
					if(empty($arrayParams[6])) $arrayParams[6]=null;
					if(empty($arrayParams[7])) $arrayParams[7]='2007-1-1';
					if(empty($arrayParams[8])) $arrayParams[8]=date('Y-m-d');
					$this->view->xlsResults= $lib->createXlsUrlOnResultArray($this->_trnModel,'getTransactionSummaryBySrchQuery', '/trn/index/paymentexcel'.$srchParams, 'Payment Xls File',
					$arrayParams);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_payment_data = array_merge((array)$arrayParams,(array)$pagination_limits);
					$data_bundle = $this->_trnModel->getTransactionSummaryBySrchQuery($cons_payment_data);
					$summary_info=$data_bundle['result'];
					$count=count($summary_info);
					if($summary_info) {
						$this->view->cnm=$arrayParams[0];
						$this->view->enm=$arrayParams[1];
						$this->view->schm=$arrayParams[2];
						$this->view->schmType=$srch_schm_type=$arrayParams[3];
						$this->view->cid=$arrayParams[4];
						$this->view->eid=$arrayParams[5];
						$this->view->vchr=$arrayParams[6];
						$this->view->strdt=$arrayParams[7];
						$this->view->enddt=$arrayParams[8];
						if($search==1) {
						$this->view->srch=1;
						$this->view->searchparams=$srchParams;
						$this->view->arrayparams=$arrParams;
						$search_url_params =
						"/index/search/1/cnm/".$this->view->cnm."/cid/".$this->view->cid."/enm/".$this->view->enm.	"/eid/".$this->view->eid."/schm/".$this->view->schm."/param1/".$this->view->schmType."/vchr/".$this->view->vchr."/strdt/".$this->view->strdt."/enddt/".$this->view->enddt."/page/$page"; }
					}
					$url = $this->_refModel->getBaseURL()."/trn/payment".$search_url_params;
				}
			}
			else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_getParam('search');
				if($search)
				{
					$srch_cust_name=$this->_request->getParam('cnm',null);
					$srch_cust_id=$this->_request->getParam('cid',null);
					$srch_emp_name=$this->_request->getParam('enm',null);
					$srch_emp_id=$this->_request->getParam('eid',null);
					$srch_schm=$this->_request->getParam('schm',null);
					$srch_schm_type=$this->_request->getParam('param1',null);
					$srch_voucher = $this->_request->getParam('vchr',null);
					$srch_start_dt = $this->_request->getParam('strdt',null);
					$srch_end_dt = $this->_request->getParam('enddt',null);
					if(empty($srch_start_dt)) $srch_start_dt='2007-1-1';
					if(empty($srch_end_dt)) $srch_end_dt=date('Y-m-d');
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$data=array($srch_cust_name,$srch_emp_name,$srch_schm,$srch_schm_type, $srch_cust_id,$srch_emp_id, $srch_voucher,$srch_start_dt,$srch_end_dt);
					$cons_summary_data = array_merge((array)$data,(array)$pagination_limits);
					$data_bundle =  $this->_trnModel->getTransactionSummaryBySrchQuery($cons_summary_data);
					$summary_info = $data_bundle['result'];
					$count=count($summary_info);
					if($summary_info){
						$this->view->cnm=$srch_cust_name;
						$this->view->cid=$srch_cust_id;
						$this->view->enm=$srch_emp_name;
						$this->view->eid=$srch_emp_id;
						$this->view->schm=$srch_schm;
						$this->view->schmType=$srch_schm_type;
						$this->view->vchr=$srch_voucher;
						$this->view->strdt=$srch_start_dt;
						$this->view->enddt=$srch_end_dt;
						$this->view->srch=1;		$search_url_params="/index/search/1/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt/page/$page";
						$this->view->searchparams="/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/param1/$srch_schm_type/vchr/$srch_voucher/strdt/$srch_start_dt/enddt/$srch_end_dt";
						$this->view->arrayparams="$srch_cust_name/$srch_emp_name/$srch_schm/$srch_schm_type/$srch_cust_id/$srch_emp_id/$srch_voucher/$srch_start_dt/$srch_end_dt";
					}
					$url = $this->_trnModel->getBaseURL()."/trn/payment".$search_url_params;
				}
				else{
					$data_bundle =  $this->_trnModel->getAllTransactionSummaryQuery($pagination_limits);
					$summary_info = $data_bundle['result'];
					$count=count($summary_info);
					$url=$this->_trnModel->getCurrentPageURL();
				}
			}
		}
		if($count)
			$flag=1;

		if ($flag==1)
			$this->view->paginator = Bloomfi_Paginator::factory($summary_info,$page,$count);


		$this->_session->sql=$data_bundle['sql'];
		$this->_session->indexUrl = $url;
		$this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
		$this->_session->state=0;

		$schemeTypes=$this->_refModel->getAllSchemeTypesQuery();
		$this->view->schemeTypes = $element->createSelectDb("scheme_type",$schemeTypes,'VALUE_ID','VALUE_NAME',$srch_schm_type,'not');

		ob_flush();
		flush();
		unset($lib,$labels,$message,$element);

	}// Index Function End

	public function addsummaryAction()
	{
		$this->_session->actionHelp=false;
		$this->_session->callerAction='addsummary';
		$this->_session->controller=$this->_session->HelpController='payment';
		$this->_trnModel->setPattern();
		$this->view->url=$this->_session->indexUrl;
		$this->view->axpath=$this->_trnModel->getCurrentUrlLevel(true).'/receive/trninfoajax';
		$this->view->format=new Bloomfi_NumericFormat;
		$this->view->title = "Master Payment transaction";
		$element =new Bloomfi_App_UHtmlElement;
		$s_id=$c_id=$e_id=$flag=$check=$type=$vouchers=$data=$voucher_ids=$result=$summary_info=$search_params=$memo=$error=$success_row=
			$error_row=null;
		$max_amount='000';
		$labels=new modules_trn_labels_label;
		$message = new modules_trn_messages_message;
		$this->view->viewlabels=$labels->getTrnPaymentViewLabels('addsummary');
		$pay_types=$this->_trnModel->getAllPaymentTypesQuery();
		$pdate = date('Y-m-d');
		$this->view->confirmMsg = $message->getTrnPaymentMessages('confirm');
		$this->view->searchForm=$labels->getTrnPaymentFormLabels('paymentsrch');
		$this->view->paymentFormHeader=$labels->getTrnPaymentFormLabels('payment');
		if(isset($_GET['dt']))  $this->view->pdate=$_GET['dt'];
		else  $this->view->pdate = $pdate;
		if ( $this->_session->paymentSession!=1 ){
			$this->_session->tsIds=null;
			$this->_session->totalSubmits=0;
			$this->_session->paymentSession=1;
		}
		if($this->_session->tsIds==null)$this->_trnModel->clearPattern();
		$totalSubmits=$this->_session->totalSubmits;
		if ( $this->getRequest()->isPost() )
		{
			$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
			$insertmsg= $message->getTrnPaymentMessages('dbEntry');
			$request= $this->getRequest()->getPost('REQUEST');

			if ( $request == 'Insert' )
			{
				$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
				$total_submits=(int)$this->getRequest()->getPost('totalSubmits');
				$c_id=trim($this->getRequest()->getPost('customer'));
				$e_id=$this->getRequest()->getPost('employee');
				$s_id = $this->getRequest()->getPost('scheme');
				$date = $this->getRequest()->getPost('date');
				$amount = $this->getRequest()->getPost('amount');
				$type = $this->getRequest()->getPost('payment_type');
				$voucher = strtoupper($c_id);
				$remarks = $this->getRequest()->getPost('remarks');
				$check=$select_check=null;

				//PAYMENT FORM VALIDATION-------------
				$msg=$element->
					checkElement($this->view->paymentFormHeader['customer'],$c_id,30,3);
				if($msg)$check['customer']=$msg;
				$msg=$element->
				checkElement($this->view->paymentFormHeader['employee'],$e_id,30,2);
				if($msg)$check['employee']=$msg;
				$msg=$element->checkElementSelect('default',$this->view->paymentFormHeader['scheme'],$s_id);
				if($msg)$check['scheme']=$msg;
				$msg=$element->checkElementSelect('default',$this->view->paymentFormHeader['type'],$type);
				if($msg)$check['type']=$msg;
				$msg=$element->
				checkElementNum($this->view->paymentFormHeader['amount'],$amount,13,1);
				if($msg)$check['amount']=$msg;
				else {
					$amount=(float)$amount;
					$msg=$element->
							checkElementFloatComp ( $this->view->paymentFormHeader['amount'] , $amount ,0, $insertmsg['invalidamount1']);
					if($msg)$check['amount']=$msg;
				}
				$msg=$element->checkElementDate($this->view->paymentFormHeader['date'],$date);
				if($msg)$check['date']=$msg;

				if (empty($check['customer']) || empty($check['employee'])  ){
					$errors=$this->dbEntityValidation($c_id,$e_id);
					if(!$errors){
						$isExist=$this->_trnModel->getTrnIdByCustomerQuery($c_id);
						if($isExist && $type==$pay_types[0]->VALUE_NAME){
								$msg=str_replace('@VAR1@',$s_id,$insertmsg['schemeGiven']);
								$msg=str_replace('@VAR2@',$isExist->SCHEME_ID,$msg);
								$msg=str_replace('@VAR3@',$c_id,$msg);
								$check['Project'] =$msg;
						}
						else{
							if($isExist)
							{
								if($isExist->SCHEME_ID==$s_id && $type==$pay_types[1]->VALUE_NAME )
								{
									$payment_datas =array($c_id ,$s_id, $type);
									$isExist=$this->_trnModel->getPaymentTrnsIdQuery($payment_datas);
									if($isExist){
										$msg= str_replace('@VAR1@',$c_id, $insertmsg['bsdPumntGiven']);
										$check['Project']=$msg;
									}
								}
								else if($isExist->SCHEME_ID!=$s_id && $type==$pay_types[1]->VALUE_NAME )
								{
									$msg= str_replace('@VAR1@',$c_id, $insertmsg['invaildSchmBsdPymnt']);
									$check['Project']=$msg;
								}
							}
						}
					}
					else $check=array_merge((array)$check,$errors);
				}
				//-------------------------------------
				if(!$check)
				{
					if($pay_types[0]->VALUE_NAME==$type)
					{
						$max_amount=$this->_trnModel->getSchemeLimitAmountQuery($s_id);
						if ( $amount <= $max_amount || $max_amount==0)
						{
							if($amount > 0) {
								//$this->_trnModel->startProcessing();
								//$allow=$this->_trnModel->waitAndAllow('SUMMARY');
								//$this->_trnModel->endProcessing();
								$allow=1;
								if($allow==1) {
									//$this->_trnModel->startProcessing();
									$this->_trnModel->startTransaction();
									$this->_trnModel->insertRowInSummaryDML();
									$summary_max_id=$this->_trnModel->getLastInsertedId();
									//$this->_trnModel->releaseLock('SUMMARY');
									//$allow=$this->_trnModel->waitAndAllow('DETAILS');
									//$this->_trnModel->endProcessing();
									if($allow==1) {
										$this->_trnModel->insertRowInDetailDML();
										$detail_max_id=$this->_trnModel->getLastInsertedId();
										//$this->_trnModel->releaseLock('DETAILS');
										$receive_amount=0;
										$due_amount=$amount;
										$prefix= $this->_trnModel->getAllTrnPrePostQuery();
										$new_ts_row_id = $summary_max_id->ID;
										$new_trns_id=$prefix[0]->PREFIX_VALUE.$new_ts_row_id;
										$new_td_row_id = $detail_max_id->ID;
										$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;
										$data_ordered = array( $new_trns_id,$s_id,$this->_customerId,
											$this->_employeeId, $amount, $due_amount,$date,$remarks,$new_ts_row_id);
										$data_ordered1 = array ($new_detail_id, $new_trns_id, $s_id,
										$this->_customerId, $this->_employeeId, $amount, $type, $voucher,$memo,
										$date, $remarks,$this->_customerName,$this->_customerGender , $new_td_row_id);
										$status1=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
										$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);

										if($status1&&$status2){
											$this->_trnModel->commitTransaction();
											$tids=explode(', ',$this->_session->tsIds);
											$totalSubmits=count($tids);
											$trnsIds= $this->_session->tsIds= $this->_trnModel->insertDataToPattern($new_td_row_id,$this->_session->tsIds,$totalSubmits);
											$c_id=$s_id=$remarks=$voucher=null;
											$amount=0;
											$date=$pdate;
											$this->view->textSuccess=$insertmsg['success'];
										 }
										else
										  $this->view->textErrors=$insertmsg['fail'];
									}
									else
										$this->view->textInfo= "<b>SERVER IS BUSY</b>. Please re-submit the form
										&nbsp;&nbsp;".$this->_trnModel->printTotalProcessingTime('false');
								}
								else
									$this->view->textInfo= "<b>SERVER IS BUSY</b>. Please re-submit the form
									&nbsp;&nbsp;".$this->_trnModel->printTotalProcessingTime('false');
							}
							else
							  $this->view->textErrors =
								str_replace('@VAR1@', $this->view->paymentFormHeader['amount'], $insertmsg['invalidamount3']);
						}
						else
							$this->view->textErrors = str_replace('@VAR1@',(float)$max_amount,$insertmsg['invalidamount2']);
					}
					else{

						//$this->_trnModel->startProcessing();
						//$allow=$this->_trnModel->waitAndAllow('SUMMARY');
						//if($allow==1) $allow=$this->_trnModel->waitAndAllow('DETAILS');
						//$this->_trnModel->endProcessing();
						$allow=1;
						if($allow==1)
						{
							$receiptSecurityAmount=$due=$receive_amount=0;
							$trnsInfo=$this->_trnModel->getTranSmryInfosByCustIDQuery($this->_customerId);
							if($trnsInfo)
							{
							$id=$trnsInfo[0]->ID;
							$transId=$trnsInfo[0]->TRAN_SUMMARY_ID;
							$s_id=$trnsInfo[0]->SCHEME_ID;
							$voucher=$trnsInfo[0]->VOUCHER_NO;
							$due=$trnsInfo[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
							$receiptSecurityAmount=$trnsInfo[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
							if($due==0){
								if($receiptSecurityAmount==$amount){
									$status=$this->_trnModel->updateSecurityDeposAmountDML(array($amount,$transId));
									$this->_trnModel->insertRowInDetailDML();
									$detail_max_id=$this->_trnModel->getLastInsertedId();
									$prefix= $this->_trnModel->getAllTrnPrePostQuery();
									$new_td_row_id = $detail_max_id->ID;
									$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;
									$data_ordered = array ($new_detail_id, $transId, $s_id,
									$this->_customerId, $this->_employeeId, $amount, $type, $voucher,$memo,
									$date, $remarks,$this->_customerName,$this->_customerGender , $new_td_row_id);
									$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered);
									if($status && $status2){
										$status=$this->_trnModel->updateSmryStatusToCloseDML($trnsInfo[0]->TRAN_SUMMARY_ID);
										if($status){
											$this->_trnModel->commitTransaction();
											$tids=explode(', ',$this->_session->tsIds);
											$totalSubmits=count($tids);
											$trnsIds= $this->_session->tsIds= $this->_trnModel->insertDataToPattern($new_td_row_id,$this->_session->tsIds,$totalSubmits);
											$c_id=$s_id=$remarks=null;
											$amount=0;
											$date=$pdate;
											$msg['Amount']='Security deposite payment given successfully';
											$msg['Status']="Account of client code '".$this->_customerId."' closed permanently";
											$this->view->textSuccess=$msg;
										}else{
											$error['Status']="Unable to close account of client code".$this->_customerId;
										}
									}
									else $error['Status']="Account closed. Unable to give security depostite payment amount to client code '".$this->_customerId."'";
								}
								else
								{
									$error['Amount']="Security depostite payment amount should be ".$receiptSecurityAmount;
								}}else
								{
									$error['Amount']="Security depostite payment can not be given to client code '".$this->_customerId."'. Client has to give still $due Rs.";
								}
							}
							else{

							}

							//$this->_trnModel->releaseLock('DETAILS');
							//$this->_trnModel->releaseLock('SUMMARY');
							$this->view->textErrors=$error;
						}else
						{
							$this->view->textInfo= "<b>SERVER IS BUSY</b>. Please re-submit the form
									&nbsp;&nbsp;".$this->_trnModel->printTotalProcessingTime('false');
							//$this->_trnModel->releaseLock('SUMMARY');
						}
					}

				//.....................................................................................
				}
				else
				{
					$this->view->textErrors=$check;
				}

				$this->view->employee=$e_id;
				$this->view->customer=$c_id;
				$this->view->scheme=$s_id;
				$this->view->amount=$amount;
				$this->view->voucher=$voucher;
				$this->view->remarks=$remarks;
				$this->view->pdate =$date;

				if($summary_info) $flag=1;
			}//-----------------------Insert End

			if ( $request == 'Delete' )
			{
				$id=$this->getRequest()->getPost('smryid');
				$total_submits=$this->getRequest()->getPost('totalSubmits');
				$msg = $message->getTrnPaymentMessages('dbDelete');
				$seperator=$val_id=$datas=$valid_id=null;
				$vals=$this->getRequest()->getPost('tdid');

				foreach($this->getRequest()->getPost('tdid') as $id)
					{
						$transIdInfo=$this->_trnModel->getCombinedTransInfoOnTdIdQuery($id);

						if($transIdInfo)
						{
							if($transIdInfo[0]->PAYMENT_TYPE==$pay_types[0]->VALUE_NAME){
								if ( $transIdInfo[0]->TOTAL_DETAILS > 1 )
								{
									$dtlNo=$transIdInfo[0]->TOTAL_DETAILS-1;
									$error_row[$id]=str_replace('@VAR2@',$dtlNo,str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['custUnableDelete']));	
								}else{
									if($transIdInfo[0]->TOTAL_PAYMENT_SECURITY_DEPOSITE==0){
										$status=$this->_trnModel->cancelTrnSummaryOnTsId2DML($transIdInfo[0]->TRAN_SUMMARY_ID);
										if($status) $success_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['voucherDeleted']);
										else $error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['unableToDelete']);
									}else{
										$error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['unableToDelete2']);
									}
								}
							}
							else if($transIdInfo[0]->PAYMENT_TYPE==$pay_types[1]->VALUE_NAME)
							{
								$status1=$this->_trnModel->updateBSDToZeroAndOpenAccDML($transIdInfo[0]->TRAN_SUMMARY_ID);
								$status2=$this->_trnModel->deleteTrnDetailsDML($id);
								if($status1!=null && $status2!=null)
									$success_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['bsdDeleted']);
								else $error_row[$id]=str_replace('@VAR1@',$transIdInfo[0]->VOUCHER_NO,$insertmsg['bsdDeleteUnable']);
							}
						}
					} 
					$this->view->textSuccess=$success_row;
					$this->view->textErrors = $error_row; 
			}//-----------------------Delete End

		}//Post data End -------------

	if($this->_session->tsIds)
		$summary_info =  $this->_trnModel->getTransactionSummaryRecentQuery($this->_session->tsIds);
	if($summary_info)
			$flag=1;
	$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
	$schemes=$this->_refModel->getAllSchemeMinInfoQuery();
	$this->view->scheme = $element->createSelectDb("scheme",$schemes,'SCHEME_ID','SCHEME_NAME',$s_id,null,null, ' id="scheme_id" onChange="getValueAndSend();"');
	$this->view->paymentType = $element->createSelectDb("payment_type",$pay_types,'VALUE_NAME','VALUE_NAME',$type);

	if ($flag==1)
		$this->view->result=$summary_info;

	$this->view->totalSubmits=$this->_session->totalSubmits;
	$this->_session->paymentAddPage=$this->_trnModel->getCurrentUrlBase();
	$this->view->amountAjaxPath=$this->_trnModel->getCurrentUrlBase()."/../maxschmamntajax";
	$this->view->checkSchmAjxPath=$this->_trnModel->getCurrentUrlBase()."/../schmchkajax";

	ob_flush();
	flush();
	unset($element,$message,$labels);
	}


	public function editsummaryAction()
	{
		$this->_session->actionHelp=true;
		if($this->_session->callerAction=='index' && $this->_session->HelpController='payment' )
			$this->_session->lastAction = 'index';
		else if($this->_session->callerAction=='addsummary' && $this->_session->HelpController='payment' )
			$this->_session->lastAction = 'addsummary';
		$this->_session->controller='payment';
		$this->_session->state=1;
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->path=$this->_setupAjaxPath();
		$trns_id = $this->_request->getParam('id');
		$this->view->page = $this->_request->getParam('page');
		$this->view->addPageRequest=$this->_request->getParam('add',null);
		if(!$this->view->addPageRequest) $this->view->url=$this->_session->indexUrl;
		else $this->view->url= $this->_session->paymentAddPage;
		$this->view->id = $trns_id;
	    $result=$this->_trnModel->trnsSummaryByTsidQuery($trns_id);
		$message = new modules_trn_messages_message;
		$labels=new modules_trn_labels_label;
	    $this->view->paymentFormHeader=$labels->getTrnPaymentFormLabels('payment');
		$this->view->viewlabels=$labels->getTrnPaymentViewLabels('editsummary');
		$schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		$pay_types=$this->_trnModel->getAllPaymentTypesQuery();
		$accountTypes=$this->_trnModel->getAllAccountStatusTypesQuery();
		$check=$msg=$max_amount=$accountStatus=$scheme_id=$type=null;
		$amount='000';

		if($this->getRequest()->isPost())
		{
			$trns_id=$this->getRequest()->getPost('trns_id');
			$accountStatus=$this->getRequest()->getPost('status');
			$e_id=$this->getRequest()->getPost('employee');
			$c_id=$this->getRequest()->getPost('customer');
			$scheme_id=$this->getRequest()->getPost('scheme');
			$type=$this->getRequest()->getPost('payment_type');
			$pdate=$this->getRequest()->getPost('date');
			$remarks=$this->getRequest()->getPost('remarks');
			$amount=(float)$this->getRequest()->getPost('amount');
			$receipt_amount=(float)$this->getRequest()->getPost('receipt_amount');
			$this->view->totalSubmits=$this->getRequest()->getPost('totalSubmits');
			$this->view->page = $this->getRequest()->getPost('page');
			$editmsg= $message->getTrnPaymentMessages('dbUpdate');

					//PAYMENT FORM VALIDATION-------------
					$msg=$element->
							checkElement($this->view->paymentFormHeader['customer'],$c_id,30,3);
					if($msg)$check['customer']=$msg;
					$msg=$element->
							checkElement($this->view->paymentFormHeader['employee'],$e_id,30,2);
					if($msg)$check['employee']=$msg;
					$msg=$element->checkElementSelect('default',$this->view->paymentFormHeader['scheme'],$scheme_id);
					if($msg)$check['scheme']=$msg;
					$msg=$element->checkElementSelect('default',$this->view->paymentFormHeader['type'],$type);
					if($msg)$check['type']=$msg;
					$msg=$element->
					checkElementNum($this->view->paymentFormHeader['amount'],$amount,13,1);
					if($msg)$check['amount']=$msg;
					else {
						$amount=(float)$amount;
						$msg=$element->
						checkElementFloatComp($this->view->paymentFormHeader['amount'], $amount, 0, $editmsg['invalidamount1']);
						if($msg)$check['amount']=$msg;
					}
					$msg=$element->checkElementDate($this->view->paymentFormHeader['date'],$pdate);
					if($msg)$check['date']=$msg;

					if (empty($check['customer']) || empty($check['employee'])){
						$errors=$this->dbEntityValidation($c_id,$e_id);
						if($errors) $check=array_merge($check,$errors);
					}

					$transIdInfo=$this->_trnModel->tsIdByTdIdQuery($trns_id);
					$transId=$transIdInfo[0]->TRAN_SUMMARY_ID;

					$data=array($this->_customerId,$transId);
					$status=$this->_trnModel->isSchmGivenToCustExceptMeQuery($data);
					if($status && $type==$pay_types[0]->VALUE_NAME) {	
						$check['scheme']=str_replace('@VAR3@',$this->_customerId,str_replace('@VAR2@',$status->SCHEME_ID,str_replace('@VAR1@',$scheme_id,$editmsg['schemeGiven'])));
					}else{
						$isExist=$this->_trnModel->getTrnIdByCustomerQuery($this->_customerId);
						if($isExist && $type==$pay_types[1]->VALUE_NAME )
						{
							if($isExist->SCHEME_ID==$scheme_id)
							{
								if($isExist->ACTIVE_STATUS=='OPEN')
								{
									$payment_datas =array($this->_customerId ,$scheme_id, $type);
									$isExistPay=$this->_trnModel->getPaymentTrnsIdQuery($payment_datas);
									if($isExistPay){
										$msg= str_replace('@VAR1@',$this->_customerId, $editmsg['bsdPumntGiven']);
										$check['Project']=$msg;
									}else if($isExist->TOTAL_RECEIPT_DUE_PRINCIPAL!=0)
									{
										$msg=  str_replace('@VAR2@',$isExist->TOTAL_RECEIPT_DUE_PRINCIPAL, str_replace('@VAR1@',$this->_customerId, $editmsg['dueAmount']));
										$check['Amount']=$msg;
									}else if($isExist->TOTAL_RECEIPT_SECURITY_DEPOSITE!=$amount)
									{
										$msg=  str_replace('@VAR1@',$isExist->TOTAL_RECEIPT_SECURITY_DEPOSITE, $editmsg['securityAmount']);
										$check['Amount']=$msg;
									}
								}else{
									$check['Account']=str_replace('@VAR1@',$this->_customerId, $editmsg['accountClosed']);
								}
							}
							else
							{
								$msg= str_replace('@VAR1@',$this->_customerId, $editmsg['invaildSchmBsdPymnt']);
								$check['Project']=$msg;
							}

						}else if (!$isExist && $type==$pay_types[1]->VALUE_NAME){
							$check['Project']=str_replace('@VAR1@',$this->_customerId, $editmsg['schmNotExist']);
						}
					}
					$voucher=$this->_customerId;

					//-------------------------------------
					if(!$check){
						$this->_trnModel->startTransaction();
						if($type==$pay_types[0]->VALUE_NAME && $transIdInfo[0]->PAYMENT_TYPE!=$pay_types[1]->VALUE_NAME)
						{
								$receive_amount=0;
								$max_amount=$this->_trnModel->getSchemeLimitAmountQuery($scheme_id);
								$due_amount=$amount-(float)$receipt_amount;
								if(($amount<=$max_amount||$max_amount==0)&&($due_amount>=0))
								{
									$data1=array($scheme_id, $this->_customerId, $this->_employeeId, $amount, $due_amount, $pdate, $accountStatus, $transId);
									$data2=array($scheme_id,$this->_customerId, $this->_employeeId, $amount, $type, $voucher, $remarks, $pdate, $this->_customerName,  $this->_customerGender, $type,$transId);
									$result1=$this->_trnModel->editTrnSummaryDML($data1);
									$result2=$this->_trnModel->editTrnSummaryDetailsDML($data2);
									$result3=$this->_trnModel->updateSmryRelatedInfoToDtlsDML(array($scheme_id, $this->_customerId, $this->_employeeId,$transId));
									if($result1!=null && $result2!=null && $result3){
										$this->view->statusMsg=$editmsg['success'];
										$this->_trnModel->commitTransaction();
									}
									else $this->view->textErrors=$editmsg['fail'];
								}
								else{
									$this->view->textErrors = str_replace('@VAR1@',(float)$max_amount,$editmsg['invalidamount2']) ;
								}

						}else if($type==$pay_types[0]->VALUE_NAME && $transIdInfo[0]->PAYMENT_TYPE==$pay_types[1]->VALUE_NAME)
						{
							$status=$this->_trnModel->isSchmGivenToCustQuery($this->_customerId);
							if(!$status) {
								$this->_trnModel->insertRowInSummaryDML();
								$summary_max_id=$this->_trnModel->maxTransactionSummaryIdQuery();
								$receive_amount=0;
								$due_amount=$amount;
								$prefix= $this->_trnModel->getAllTrnPrePostQuery();
								$new_ts_row_id = $summary_max_id->ID;
								$new_trns_id=$prefix[0]->PREFIX_VALUE.$new_ts_row_id;
								$data_ordered = array( $new_trns_id,$scheme_id,$this->_customerId,
									$this->_employeeId, $amount, $due_amount,$pdate,$remarks,$new_ts_row_id);
								$data2=array($new_trns_id,$scheme_id,$this->_customerId, $this->_employeeId, $amount, $type, $voucher, $remarks, $pdate, $this->_customerName,  $this->_customerGender,$trns_id);
								$status=$this->_trnModel->updateBSDToZeroAndOpenAccDML($transId);
								$status1=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
								$status2=$this->_trnModel->editTrnSummaryDetails2DML($data2);
								if($status && $status1 && $status2){
									$this->view->statusMsg=$editmsg['success'];
									$this->_trnModel->commitTransaction();
								}
								else $this->view->textErrors=$editmsg['fail'];
							}else{
								$this->view->textErrors = str_replace('@VAR3@',$this->_customerId,str_replace('@VAR2@',$status->SCHEME_ID,str_replace('@VAR1@',$scheme_id,$editmsg['schemeGiven'])));
							}

						}else if($type==$pay_types[1]->VALUE_NAME)
						{
							$custTransInfo=$this->_trnModel->getTranSmryInfosByCustIDQuery2( $this->_customerId);
							$custInfo=$this->_refModel->getCustomerInfoByCustIdQuery($this->_customerId);
							$result1=$this->_trnModel->updateBSDToZeroAndOpenAccDML($transId);
							$data=array($amount,$custTransInfo[0]->TRAN_SUMMARY_ID);
							$result2=$this->_trnModel->updateBsdPayOnTsIdDML($data);
							$data=array($custTransInfo[0]->TRAN_SUMMARY_ID,$this->_customerId, $this->_employeeId,$custTransInfo[0]->SCHEME_ID,$amount, $voucher,$pdate,$custInfo[0]->NAME,$custInfo[0]->SEX,$trns_id);
							$result3=$this->_trnModel->updateBsdPayDetailsOnTsIdDML($data);
							if($result1 && $result2&& $result3){
								$this->view->statusMsg=$editmsg['success'];
								$this->_trnModel->commitTransaction();
							}
							else $this->view->textErrors=$editmsg['fail'];
						}
					}
					else
					{
						$this->view->textErrors = $check;
					}


				$this->view->employee=$e_id;
				$this->view->customer=$c_id;
				$this->view->amount=$amount;
				$this->view->date=$pdate;
				$this->view->receiptAmount=$receipt_amount;
				$this->view->remarks=$remarks;
		}
		else
		{
				$this->view->employee=$result[0]->EMPLOYEE_ID;
				$this->view->customer=$result[0]->CUSTOMER_ID;
				$scheme_id=$result[0]->SCHEME_ID;
				$type=$result[0]->PAYMENT_TYPE;
				$this->view->amount=$result[0]->TOTAL_PAYMENT_PRINCIPAL;
				$this->view->date=$result[0]->TRANSACTION_DATE;
				$this->view->remarks=$result[0]->REMARKS;
				$this->view->receiptAmount=$result[0]->TOTAL_RECEIPT_PRINCIPAL;
				$this->view->voucher=$result[0]->VOUCHER_NO;
				$accountStatus=$result[0]->ACTIVE_STATUS;
		}

		if($type==$pay_types[0]->VALUE_NAME) $this->view->accStatusVisibility=true;
		else $this->view->accStatusVisibility=false;

		$this->view->amountAjaxPath=$this->_trnModel->getCurrentUrlBase()."/../maxschmamntajax";
		$this->view->checkSchmAjxPath=$this->_trnModel->getCurrentUrlBase()."/../schmchkajax";
		$this->view->scheme = $element->createSelectDb("scheme",$schemes,'SCHEME_ID','SCHEME_NAME',$scheme_id, null, null, ' id="scheme_id" onChange="getValueAndSend();"');
		$this->view->paymentType = $element->createSelectDb("payment_type",$pay_types,'VALUE_NAME','VALUE_NAME', $type, null, null,'id="payment_type"');
		$this->view->accountStatus=$element->createRadioDb('status',$accountTypes,'VALUE_ID','VALUE_ID', $accountStatus);
		ob_flush();
		flush();
		unset($element,$message,$labels);
	}

	public function _setupAjaxPath()
	{
		$this->_path['trninfoajax']=$this->_trnModel->getCurrentUrlLevel(true).'/receive/trninfoajax';
		$this->_path['pymntdtlsajax']=$this->_trnModel->getCurrentUrlLevel(true,true).'/pymntdtlsajax';
		return $this->_path;
	}

	public function dbEntityValidation($customer=null,$employee=null)
	{
		$errors=null;

		if($customer){
			//$cust_values=explode(',',$customer);
			//	$this->_customerId=strtoupper(trim($cust_values[0]));
			   $this->_customerId=trim($customer);
				$result = $this->_refModel->getCustomerQuery( $this->_customerId );
				if(!$result)
					$errors['customer_id'] ="Customer '$this->_customerId ' is not a valid customer id";
				else {
					$this->_customerName=$result[0]->ENTITY_NAME;
					$this->_customerGender=$result[0]->SEX;
					$this->_customerId=$result[0]->ENTITY_ID;
				}
		}
		if($employee){
			//$emp_values=explode(',',$employee);
		//		$this->_employeeId=strtoupper(trim($emp_values[0]));
		        $this->_employeeId=trim($employee);
				$result=$this->_refModel->getEmployeeQuery($this->_employeeId);
				if(!$result)
					$errors['employee_id'] = "Employee '$this->_employeeId' is not a valid employee id";
				else $this->_employeeId=$result[0]->ENTITY_ID;
		}
		//print_r($errors);

		if($errors)
			return $errors;
		else
			return null;
	}

	public function maxschmamntajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$schemId=trim($this->_request->getParam('q',null));
		$this->view->amount=$this->_trnModel->getSchemeLimitAmountQuery($schemId);
	}

	public function dtlsummaryidAction()
	{
		$this->_helper->layout->disableLayout();
		$this->view->format=new Bloomfi_NumericFormat;
		$labels=new modules_trn_labels_label;
		$this->view->detailTableHeader=$labels->getTrnPaymentTableLabels('detailsPmnt');
		$this->view->viewlabels=$labels->getTrnPaymentViewLabels('detailsInfo');
		$trns_id = $this->_request->getParam('id');
		$user=$this->_getUser();
		$details = $this->_trnModel->getTransactionDetailQuery(array($user,$trns_id));
		$this->view->transactionDetails = $details;
		$this->view->trns_id = $trns_id;
		$this->view->totalDetails = count($details);
		unset($labels);
	}

	protected function _getUser()
	{
		$auth = Zend_Auth::getInstance();
		$user=$auth->getIdentity();
		return $user->USER_ID;
	}

	public function pymntdtlsajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$param=trim($this->_request->getParam('q'));
		$values=explode(',',$param);
		$cid=trim($values[0]);
		$this->view->smrydtls=$this->_trnModel->getTranSummaryTotalByCidQuery($cid);
	}

	public function schmchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$param=explode('/',trim($this->_request->getParam('q')));
		$cid=trim($param[0]);
		$this->view->result=$this->_trnModel->getTranOnCustQuery($cid);
	}

	public function vchrchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$voucher=trim($this->_request->getParam('q',null));
		$this->view->result=$this->_trnModel->isVoucherNoQuery($voucher);
	}


	public function suggestentnmAction()
	{
		$entity_name = strtolower($this->_request->getParam('q'));
		$this->view->entity = $this->_trnModel->getEntityQuery($entity_name);
		$this->_helper->layout->disableLayout();
	}

	public function suggestempAction()
	{
		$emp_name = strtolower($this->_request->getParam('q'));
		$this->view->employee = $this->_trnModel->getEmployeeQuery($emp_name);
		$this->_helper->layout->disableLayout();
	}

	public function suggestcustAction()
	{
		$cust_name = strtolower($this->_request->getParam('q'));
		$this->view->customer = $this->_trnModel->getCustomerQuery($cust_name);
		$this->_helper->layout->disableLayout();
	}

	public function suggestidAction()
	{
		$id = strtolower($this->_request->getParam('q'));
		$this->view->id = $this->_trnModel->getAllIdQuery($id);
		$this->_helper->layout->disableLayout();
	}

	public function suggestschmAction()
	{
		$scheme = strtolower($this->_request->getParam('q'));
		$this->view->scheme = $this->_refModel->getSchemeQuery($scheme);
		$this->_helper->layout->disableLayout();
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$rows=5000;
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}

 } // Class End


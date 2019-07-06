<?php

class trn_ReceiveController extends modules_trn_controllers_TrnController
{
	protected $_customerId=null;
	protected $_employeeId=null;
	protected $_refModel=null;
	protected $_trnModel=null;
	protected $_session=null;
	protected $_paths=null;
	protected $_transaction_id=null;
	protected $_customerName=null;
	protected $_customerGender=null;
	protected $_defaultMemoStart='0000000';
	protected $_defaultMemoEnd='zzzzzzzz';
	protected $_receiptTypes=null;

    function preDispatch()
	{
		$this->_initialize();
		$this->_trnConfig = new modules_trn_config_trnConfig;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_refModel = new modules_ref_models_refAccessQuery;
	}

	function postDispatch()
	{
		unset($this->_trnConfig,$this->_trnModel,$this->_refModel,$this->_session);
	}

	public function indexAction()
	{
		$this->_session->actionHelp=false;
		$this->_session->callerAction='index';
		$this->_session->HelpController='receive';
		$labels=new modules_trn_labels_label;
		$message = new modules_trn_messages_message;
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->format=new Bloomfi_NumericFormat;
		$this->view->receiveFormHeader=$labels->getTrnReceiveFormLabels('receive');
		$this->view->searchForm=$labels->getTrnReceiveFormLabels('receivesrch');
		$this->view->detailsTableHeader=$labels->getTrnReceiveTableLabels('detailsRecv');
		$this->view->viewlabels=$labels->getTrnReceiveViewLabels('index');
		$this->view->links=$labels->getTrnAllLinkLabels('recIndex');
		$this->view->confirmMsg = $message->getTrnReceiveMessages('confirm');
		$recv_types=$this->_trnModel->getAllReceiveTypesQuery();
		$flag=$status=$request=$memo_no=$start_date=$end_date=$search=$current_page=$error=$search_url_params=null;
		$configValues=$this->_trnConfig->getConfigValues('receiveIndexPagination');
		$rows = $configValues['rows'];
		$page=$this->_request->getParam('page',1);
		Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);
	    if( $this->_session->state==1 && $this->_session->controller=='receive' )
	    {
		    $this->_session->state=0;
		    $data_bundle=$this->_trnModel->executeSessionSQL($this->_session->sql,"Receive Info");
		    $details=$data_bundle['result'];
		    $count=$this->_session->counter;
			$url=$this->_session->indexUrl;
		}
		else
		{
			if ( $this->getRequest()->isPost() )
			{
				$request = $this->getRequest()->getPost('REQUEST');
				if ( $request == 'Search'  )
				{
					$customer_name =  trim($this->getRequest()->getPost('customer_name'));
					$customer_code =  trim($this->getRequest()->getPost('customer_code'));
					$employee_name =  trim($this->getRequest()->getPost('employee_name'));
					$employee_code =  trim($this->getRequest()->getPost('employee_code'));
					$scheme_id =  trim($this->getRequest()->getPost('scheme_id'));
					$scheme_type =  trim($this->getRequest()->getPost('scheme_type'));
					$memo_no_start =  trim($this->getRequest()->getPost('memo_no_start'));
					$memo_no_end =  trim($this->getRequest()->getPost('memo_no_end'));
					$start_date =  trim($this->getRequest()->getPost('startDate'));
					$end_date =  trim($this->getRequest()->getPost('endDate'));
			//		if(empty($start_date)) $start_date='2007-1-1';
			//		if(empty($end_date)) $end_date=date('Y-m-d');
			//		if(empty($memo_no_start) && !empty($memo_no_end)) $memo_no_start=$this->_defaultMemoStart;
			//		elseif(empty($memo_no_end) && !empty($memo_no_start)) $memo_no_end=$this->_defaultMemoEnd;
					$this->view->cnm=$customer_name;
					$this->view->cid=$customer_code;
					$this->view->enm=$employee_name;
					$this->view->eid=$employee_code;
					$this->view->schm=$scheme_id;
					$this->view->schmType=$scheme_type;
					$this->view->memoStart=$memo_no_start;
					$this->view->memoEnd=$memo_no_end;
					$this->view->strdt=$start_date;
					$this->view->enddt=$end_date;
					$this->view->srch=1;
					$page=1;
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$data=array($customer_name,$employee_name,$customer_code,$employee_code, $scheme_id,$start_date,$end_date,$memo_no_start,$memo_no_end,$scheme_type);
					$cons_details_data = array_merge((array)$data,(array)$pagination_limits);
					$data_bundle = $this->_trnModel->getTransactionDetailBySrchQuery($cons_details_data);
					$details = $data_bundle['result'];
					$count=count($details);
					if($details){	$search_url_params="/index/search/1/cnm/$customer_name/cid/$customer_code/enm/$employee_name/eid/$employee_code/schm/$scheme_id/strdt/$start_date/enddt/$end_date/param1/$memo_no_start/param2/$memo_no_end/param3/$scheme_type/page/$page";
					$this->view->searchparams="/cnm/$customer_name/cid/$customer_code/enm/$employee_name/eid/$employee_code/schm/$scheme_id/strdt/$start_date/enddt/$end_date/param1/$memo_no_start/param2/$memo_no_end/param3/$scheme_type";
						$this->view->arrayparams="$customer_name/$employee_name/$customer_code/$employee_code/$scheme_id/$start_date/$end_date/$memo_no_start/$memo_no_end/$scheme_type";
					}
					$url = $this->_trnModel->getBaseURL()."/trn/receive".$search_url_params;
				}

				if ( $request == 'Delete' )
				{
					$msg=$message->getTrnReceiveMessages('dbDelete');
					$search_params=$this->getRequest()->getPost('params');
					$valid_id=null;
					foreach($this->getRequest()->getPost('tdid') as $id){
						$valid_id=$this->_trnModel->isExistDetailsQuery($id);
						if(!$valid_id) break;}
					if($valid_id) {
						foreach($this->getRequest()->getPost('tdid') as $id){
							$date=date('Y-m-d');
							$td_info = $this->_trnModel->transactionDetailByTdIdQuery($id);
							$ts_info = $this->_trnModel->trnsSummaryByTsid2Query($td_info[0]->TRAN_SUMMARY_ID);
							$currentData=array($td_info[0]->RECEIPT_TYPE,$ts_info[0]->TOTAL_RECEIPT_PRINCIPAL,$ts_info[0]->DUE,$ts_info[0]->RECEIPT_SECURITY_DEPOSITE,
								$ts_info[0]->TOTAL_RECEIPT_DONATION,$ts_info[0]->TOTAL_RECEIPT_FEES);
							$prev_total_details=$ts_info[0]->TOTAL_DETAILS - 1;
						//	print_r($currentData);
							$prevData=$this->getRollBackedReceiptAmountValueSet($recv_types,$td_info[0]->RECEIPT_AMOUNT,$currentData);
						//	print_r($prevData);
							$prev_ts_data=array($prevData[0], $prevData[1], $prevData[3], $prevData[4],$prevData[2],
								$date,$prev_total_details,$td_info[0]->TRAN_SUMMARY_ID);
							$result=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($prev_ts_data);
							if($result!=null) {
								$status[$id]=$this->_trnModel->deleteTrnDetailsDML($id);
							}
							else{
								$error[$id]= "'$id' ".$msg['defaultdetail'];
							}
						}
						if($error){
							$this->view->textErrors = $error;
						}
						if($status){
							$this->view->textSuccess= $msg['success'];
						}
					}
					else
					{
						//echo "Invalied Request";
					}

					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					if(trim(join('',explode('/',$search_params))) != ''){
						$s_param=explode('/',$search_params);
						if(!empty($s_param[0])) $srch_cust_name =$s_param[0] ;
						else $srch_cust_name=null ;
						if(!empty($s_param[1])) $srch_cust_id =$s_param[1] ;
						else $srch_cust_id=null ;
						if(!empty( $s_param[2])) $srch_emp_name =$s_param[2] ;
						else $srch_emp_name=null ;
						if(!empty($s_param[3])) $srch_emp_id =$s_param[3] ;
						else $srch_emp_id=null ;
						if(!empty($s_param[4])) $srch_schm =$s_param[4] ;
						else $srch_schm=null ;
						if(!empty($s_param[5])) $srch_start_dt =$s_param[5] ;
						else $srch_start_dt=null ;
						if(!empty($s_param[6])) $srch_end_dt =$s_param[6] ;
						else $srch_end_dt =null ;
						if(!empty($s_param[7])) $srch_memo_start_no =$s_param[7] ;
						else $srch_memo_start_no=null ;
						if(!empty($s_param[8])) $srch_memo_end_no =$s_param[8] ;
						else $srch_memo_end_no=null ;
						if(!empty($s_param[9])) $srch_schm_type =$s_param[9] ;
						else $srch_schm_type=null ;
						if(!empty($s_param[10])) $current_page =$s_param[10] ;
						else $current_page =null ;
						$data=array($srch_cust_name,$srch_emp_name,$srch_cust_id,$srch_emp_id, $srch_schm,$srch_start_dt,$srch_end_dt,$srch_memo_start_no,$srch_memo_end_no, $srch_schm_type);
						$cons_details_data = array_merge((array)$data,(array)$pagination_limits);
						$data_bundle = $this->_trnModel->getTransactionDetailBySrchQuery($cons_details_data);
						$details = $data_bundle['result'];
					    $count=count($details);
						if($details) {
							$this->view->cnm=$srch_cust_name;
							$this->view->cid=$srch_cust_id;
							$this->view->enm=$srch_emp_name;
							$this->view->eid=$srch_emp_id;
							$this->view->schm=$srch_schm;
							$this->view->strdt=$srch_start_dt;
							$this->view->enddt=$srch_end_dt;
							$this->view->memoStart=$srch_memo_start_no;
							$this->view->memoEnd=$srch_memo_end_no;
							$this->view->schmType=$srch_schm_type;
							$this->view->srch=1;	$search_url_params="/index/search/1/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/strdt/$start_date/enddt/$end_date/param1/$srch_memo_start_no/param2/$srch_memo_end_no/param3/$srch_schm_type/page/$page";
							$this->view->searchparams="/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/strdt/$start_date/enddt/$end_date/param1/$srch_memo_start_no/param2/$srch_memo_end_no/param3/$srch_schm_type";
						$this->view->arrayparams="$srch_cust_name/$srch_emp_name/$srch_cust_id/$srch_emp_id/$srch_schm/$srch_start_dt/$srch_end_dt/$srch_memo_start_no/$srch_memo_end_no/$srch_schm_type";
						}
						$url = $this->_trnModel->getBaseURL()."/trn/receive".$search_url_params;
					}
					else{
						$data_bundle = $this->_trnModel->getAllTransactionDetailQuery($pagination_limits);
						$details = $data_bundle['result'];
					    $count=count($details);
						$url=$this->_trnModel->getCurrentPageURL();
					}

					$lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					if($lower_limit>=$rows && $count==0)
						$count=1;
				}

				if($request!='Search' && $request!='Delete'){
					$arrayParams=null;
					$lib=new Applibrary_XlsUrlHelper;
					$page=$this->_request->getParam('page',1);
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
					if(empty($arrayParams[7])) $arrayParams[7]=null;
					if(empty($arrayParams[8])) $arrayParams[8]=null;
					if(empty($arrayParams[9])) $arrayParams[9]=null;
					$this->view->xlsResults= $lib->createXlsUrlOnResultArray($this->_trnModel,'getTransactionDetailBySrchQuery', '/trn/index/receiveexcel'.$srchParams, 'Receive Xls File',
					$arrayParams);
					//print_r($this->view->xlsResults);
					//print_r($arrayParams);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_receive_data = array_merge((array)$arrayParams,(array)$pagination_limits);
					$data_bundle = $this->_trnModel->getTransactionDetailBySrchQuery($cons_receive_data);
					$details=$data_bundle['result'];
					$count=count($details);
					if($details) {
						$this->view->cnm=$arrayParams[0];
						$this->view->enm=$arrayParams[1];
						$this->view->schm=$arrayParams[2];
						$this->view->cid=$arrayParams[3];
						$this->view->eid=$arrayParams[4];
						$this->view->strdt=$arrayParams[5];
						$this->view->enddt=$arrayParams[6];
						$this->view->memoStart=$arrayParams[7];
						$this->view->memoEnd=$arrayParams[8];
						$this->view->schmType=$arrayParams[9];
						if($search==1) {
						$this->view->srch=1;
						$this->view->searchparams=$srchParams;
						$this->view->arrayparams=$arrParams;
						$search_url_params =
						"/index/search/1/cnm/".$this->view->cnm."/cid/".$this->view->cid."/enm/".$this->view->enm.	"/eid/".$this->view->eid."/schm/".$this->view->schm."/parma1/".$this->view->memoStart."/param2/".$this->view->memoEnd."/param3/".$this->view->schmType."/strdt/".$this->view->strdt."/enddt/".$this->view->enddt."/page/$page"; }
					}
					$url = $this->_trnModel->getBaseURL()."/trn/receive".$search_url_params;
					//echo $url;
				}
			}
			else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_getParam('search');
				if($search)
				{
					$srch_cust_name=$this->_getParam('cnm',null);
					$srch_cust_id=$this->_getParam('cid',null);
					$srch_emp_name=$this->_getParam('enm',null);
					$srch_emp_id=$this->_getParam('eid',null);
					$srch_schm=$this->_getParam('schm',null);
					$srch_start_dt=$this->_getParam('strdt',null);
					$srch_end_dt=$this->_getParam('enddt',null);
					$srch_memo_start_no=$this->_getParam('param1',null);
					$srch_memo_end_no=$this->_getParam('param2',null);
					$srch_schm_type=$this->_getParam('param3',null);
					$data=array($srch_cust_name,$srch_emp_name,$srch_cust_id,$srch_emp_id, $srch_schm,$srch_start_dt,$srch_end_dt, $srch_memo_start_no, $srch_memo_end_no, $srch_schm_type);
					$cons_details_data = array_merge((array)$data,(array)$pagination_limits);
					$data_bundle =  $this->_trnModel->getTransactionDetailBySrchQuery($cons_details_data);
					$details = $data_bundle['result'];
					$count=count($details);
					if($details){
						$this->view->cnm=$srch_cust_name;
						$this->view->cid=$srch_cust_id;
						$this->view->enm=$srch_emp_name;
						$this->view->eid=$srch_emp_id;
						$this->view->schm=$srch_schm;
						$this->view->strdt=$srch_start_dt;
						$this->view->enddt=$srch_end_dt;
						$this->view->memoStart=$srch_memo_start_no;
						$this->view->memoEnd=$srch_memo_end_no;
						$this->view->schmType=$srch_schm_type;
						$this->view->srch=1;	$search_url_params="/index/search/1/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/strdt/$start_date/enddt/$end_date/param1/$srch_memo_start_no/param2/$srch_memo_end_no/param3/$srch_schm_type/page/$page";
						$this->view->searchparams ="/cnm/$srch_cust_name/cid/$srch_cust_id/enm/$srch_emp_name/eid/$srch_emp_id/schm/$srch_schm/strdt/$start_date/enddt/$end_date/param1/$srch_memo_start_no/param2/$srch_memo_end_no/param3/$srch_schm_type";
						$this->view->arrayparams="$srch_cust_name/$srch_emp_name/$srch_cust_id/$srch_emp_id/$srch_schm/$srch_start_dt/$srch_end_dt/$srch_memo_start_no/$srch_memo_end_no/$srch_schm_type";
					}
					$url = $this->_trnModel->getBaseURL()."/trn/receive".$search_url_params;
				}
				else {
					$data_bundle = $this->_trnModel->getAllTransactionDetailQuery($pagination_limits);
					$details = $data_bundle['result'];
					$count=count($details);
					$url=$this->_trnModel->getCurrentPageURL();
				}
			}
		}
		if($count)
			$flag=1;

		if ($flag==1)
			$this->view->paginator = Bloomfi_Paginator::factory($details,$page,$count);

		$this->_session->sql=$data_bundle['sql'];
		$this->_session->indexUrl = $url;
		$this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
		//echo $this->_session->indexUrl."<< $url >>";
		$this->_trnModel->destroy();
		$schemeTypes=$this->_refModel->getAllSchemeTypesQuery();
		$this->view->schemeTypes = $element->createSelectDb("scheme_type",$schemeTypes,'VALUE_ID','VALUE_NAME',null,'not');

		ob_flush();
		flush();
		unset($this->_trnModel,$message,$labels,$element);
		$this->_session->state=0;
	}

	public function adddetailsAction()
	{
		$this->_session=Zend_Registry::get('SQL');
		$this->_session->actionHelp=$clear=false;
		$trnsIds=$this->_session->tdIds;
		$trnClearance=true;
		$this->_session->callerAction='adddetails';
		$this->_session->controller=$this->_session->HelpController='receive';
		$this->_trnModel->setPattern();
		$this->view->title = "Master Receive Transaction";
		$this->view->format=new Bloomfi_NumericFormat;
		$message = new modules_trn_messages_message;
		$labels=new modules_trn_labels_label;
		$lib = new Bloomfi_App_Ulibrary;
		$element =new Bloomfi_App_UHtmlElement;
		$s_id=$c_id=$e_id=$customers=$trnsSummaries=$trns_id=$status=$flag=$error=$transaction_id= $type=$employee=$customer=$amount=$remarks=$memo=$result=$details=$trns_summary=$scheme_id=$scheme=null;
		$active_status=$active_status2='disabled';
		$max_amount=0;
		$this->view->detailsTableHeader=$labels->getTrnReceiveTableLabels('detailsRecv');
		$this->view->viewlabels=$labels->getTrnReceiveViewLabels('adddetails');
		$this->view->confirmMsg = $message->getTrnReceiveMessages('confirm');
		$employees=$this->_trnModel->getAllEmployeeQuery('Officer');
		$this->_receiptTypes=$recv_types=$this->_trnModel->getAllReceiveTypesQuery();
		$pymnt_types=$this->_trnModel->getAllPaymentTypesQuery();
		$date = date('Y-m-d');
		$this->view->receiveFormHeader=$labels->getTrnReceiveFormLabels('receive');
		$this->view->searchForm=$labels->getTrnReceiveFormLabels('receivesrch');
		if ( $this->_session->receiveSession==null ){
			$this->_session->tdIds=null;
			$this->_session->totalSubmits=0;
			$this->_session->receiveSession=1;
		}
		if($this->_session->tdIds==null)$this->_trnModel->clearPattern();
		$totalSubmits=$this->_session->totalSubmits;
		if ( $this->getRequest()->isPost() )
		{
			$this->view->detailsTableHeader=$labels->getTrnReceiveTableLabels('detailsRecv');
			$request = $this->getRequest()->getPost('REQUEST');
			if ( $request == 'Delete' )
			{
				$msg=$message->getTrnReceiveMessages('dbDelete');
				$total_submits=(int)$this->getRequest()->getPost('totalSubmits');
				$valid_id=null;
				foreach($this->getRequest()->getPost('tdid') as $id){
					$valid_id=$this->_trnModel->isExistDetailsQuery($id);
					if(!$valid_id) break;}
				$vals=$this->getRequest()->getPost('tdid');
				if($valid_id) {
					foreach($this->getRequest()->getPost('tdid') as $id){
						$date=date('Y-m-d');
						$td_info = $this->_trnModel->transactionDetailByTdIdQuery($id);
						$ts_info = $this->_trnModel->trnsSummaryByTsid2Query($td_info[0]->TRAN_SUMMARY_ID);
						$currentData=array($td_info[0]->RECEIPT_TYPE,$ts_info[0]->TOTAL_RECEIPT_PRINCIPAL,$ts_info[0]->DUE,$ts_info[0]->RECEIPT_SECURITY_DEPOSITE,
							$ts_info[0]->TOTAL_RECEIPT_DONATION,$ts_info[0]->TOTAL_RECEIPT_FEES);
						$prev_total_details=$ts_info[0]->TOTAL_DETAILS - 1;
					//	print_r($currentData);
						$prevData=$this->getRollBackedReceiptAmountValueSet($recv_types,$td_info[0]->RECEIPT_AMOUNT,$currentData);
					//	print_r($prevData);
						$prev_ts_data=array($prevData[0], $prevData[1], $prevData[3], $prevData[4],$prevData[2],
							$date,$prev_total_details,$td_info[0]->TRAN_SUMMARY_ID);
						$result=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($prev_ts_data);
						if($result!=null) {
							$status[$id]=$this->_trnModel->deleteTrnDetailsDML($id);
						}
						else{
							$error[$id]= "'$id' ".$msg['defaultdetail'];
						}
					}
					if($error){
						$this->view->textErrors = $error;
					}
					if($status){
						$this->view->textSuccess= $msg['success'];
					}
				}
				else
				{
					//echo "Invalied Request";
				}
			}

			if ( $request == 'Insert' )
			{
				$voucher=$customer=trim($this->getRequest()->getPost('customer'));
				$employee=trim($this->getRequest()->getPost('employee'));
				$amount = trim($this->getRequest()->getPost('amount'));
				$date=trim($this->getRequest()->getPost('date'));
				$type = trim($this->getRequest()->getPost('receive_type'));
				$remarks = trim($this->getRequest()->getPost('remarks'));
				$memo = trim($this->getRequest()->getPost('memo'));
				$lib = new Bloomfi_App_Ulibrary;
				$add_msg=$message->getTrnReceiveMessages('dbEntry');

				//FORM VALIDATION-------------
				$check=$this->receiptValidation($element,array('customer'=>$customer,'employee'=>$employee, 'amount'=>$amount, 'date'=>$date, 'memo'=>$memo,'type'=>$type),$add_msg);
				//--------------------------------------------------------------------

				$trnsSummaries=$this->_trnModel->transactionSummariesByCustID($this->_customerId);
				if(!empty($trnsSummaries[0]->TRAN_SUMMARY_ID))
				$transaction_id=$trnsSummaries[0]->TRAN_SUMMARY_ID;

			//	$check['test']="Stop Now";

				if(!$check)
				{
					//$trn_identifier="SUMMARY ID-$transaction_id";
					//$prefix= $this->_trnModel->getAllTrnPrePostQuery();
					//$this->_trnModel->startProcessing();
					//if($transaction_id){
					//	$allow=$this->_trnModel->waitAndAllow($trn_identifier);
					//	$summaryid=true;
					//}
					//else{
					//	$allow=$this->_trnModel->waitAndAllow('SUMMARY');
					//	$summaryid=false;
					//}
					//if($allow==1) $allow=$this->_trnModel->waitAndAllow('DETAILS');
					//$this->_trnModel->endProcessing();
					$allow=1;
					if($allow==1)
					{
						$this->_trnModel->startTransaction();
						if(!empty($transaction_id))
							$trns_summary= $this->_trnModel->getTransactionSummaryQuery($transaction_id);
						if($trns_summary){
							if(!$this->_employeeId)
								$this->_employeeId=$trns_summary[0]->EMPLOYEE_ID;
							$payment_principle=(float)$trns_summary[0]->TOTAL_PAYMENT_PRINCIPAL;
							$current_recipt_due =(float)$trns_summary[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
							$current_recipt_amount = (float)$trns_summary[0]->TOTAL_RECEIPT_PRINCIPAL;
							$current_recpt_security_depos=(float)$trns_summary[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
							$current_recpt_donation=(float)$trns_summary[0]->TOTAL_RECEIPT_DONATION;
							$current_recpt_fees=(float)$trns_summary[0]->TOTAL_RECEIPT_FEES;
							$scheme_id=$trns_summary[0]->SCHEME_ID;
							$clear=true;
						}
						else
						{
							$msg=$element->
							checkElement($this->view->receiveFormHeader['employee'],$employee,50,2);
							if($msg)$check['employee']=$msg;

							if(!$check){
								$voucher=$this->_customerId;
								$this->_trnModel->insertRowInSummaryDML();
								$summary_max_id=$this->_trnModel->getLastInsertedId();
								$new_ts_row_id = $summary_max_id->ID;
								$transaction_id=$prefix[0]->PREFIX_VALUE.$new_ts_row_id;
								$data_ordered = array($transaction_id,$scheme,$this->_customerId,
										$this->_employeeId, 0, 0,$date,'Auto Generated',$new_ts_row_id);
								$status1=$this->_trnModel->updateInsertedCustPaymentDML($data_ordered);
								$this->_trnModel->insertRowInDetailDML();
								$detail_max_id=$this->_trnModel->getLastInsertedId();
								//$this->_trnModel->releaseLock('DETAILS');
								$new_td_row_id = $detail_max_id->ID;
								$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;
								$remarks='Please set the payment amount';
								$data_ordered1 = array ($new_detail_id, $transaction_id, $scheme_id,
									$this->_customerId, $this->_employeeId, 0,$pymnt_types[0]->VALUE_NAME, $voucher,$memo,
									$date, $remarks,$this->_customerName,$this->_customerGender, $new_td_row_id);
								$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
								if($status1 && $status2)$clear=true;
								$payment_principle=0;
								$current_recipt_due =0;
								$current_recipt_amount=0;
								$current_recpt_fees=0;
								$current_recpt_security_depos=$current_recpt_donation=0;
								$scheme_id=$scheme;
								$trns_summary=$this->_trnModel->getTransactionSummaryQuery($transaction_id);
							}
							else
							{
								$this->view->textErrors=$check;
								$trnClearance=false;
								//$this->_trnModel->releaseLock('DETAILS');
								//$this->_trnModel->releaseLock('SUMMARY');
							}

						}
						if($trnClearance==true)
						{if($clear==true)
							{
								$detail_max_id=null;
								$this->_trnModel->insertRowInDetailDML();
								$detail_max_id=$this->_trnModel->getLastInsertedId();
								//$this->_trnModel->releaseLock('DETAILS');
								$new_detail_id=$prefix[1]->PREFIX_VALUE.$detail_max_id->ID;
								$data_ordered1=array($new_detail_id, $transaction_id, $scheme_id,
									$this->_customerId, $this->_employeeId, $type,$memo,$amount,$date, $remarks,$detail_max_id->ID);
								$status1=$this->_trnModel->updateInsertedReceiptDetailDML($data_ordered1);

								//------------------------
								$amounts=$this->getReceiptAmountValueSet($recv_types,$amount,array($type, $current_recipt_amount, $current_recipt_due, $current_recpt_security_depos, $current_recpt_donation,$current_recpt_fees ));

								$total_recept_amount=$amounts[0];
								$total_recept_due=$amounts[1];
								$total_recept_security_depos=$amounts[2];
								$total_recept_donation=$amounts[3];
								$total_recept_fees=$amounts[4];
								//-------------------------

								$total_details_on_ts = $trns_summary[0]->TOTAL_DETAILS + 1;
								$data_ordered2=array($total_recept_amount, $total_recept_due,$total_recept_donation, $total_recept_fees, $total_recept_security_depos, $date, $total_details_on_ts, $transaction_id);
								$status2=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($data_ordered2);
								if($status1!=null && $status2!=null){
									$this->_trnModel->commitTransaction();
								}

								//if($summaryid==true)
								//	$this->_trnModel->releaseLock($trn_identifier);
								//else $this->_trnModel->releaseLock('SUMMARY');

								if($status1!=null && $status2!=null){
									$this->view->statusMsg=$add_msg['success'];
									$tids=explode(', ',$this->_session->tsIds);
									$totalSubmits=count($tids);
									$trnsIds= $this->_session->tsIds= $this->_trnModel->insertDataToPattern($detail_max_id->ID,$this->_session->tsIds,$totalSubmits);
									$customer=$trnsSummaries=$memo=$transaction_id=$remarks=null;
									$amount=0; }
								else
								  $this->view->textErrors=$add_msg['fail'];
						}
						else
						{
							//if($summaryid==true)
							//	$this->_trnModel->releaseLock($trn_identifier);
							//else $this->_trnModel->releaseLock('SUMMARY');

							$this->view->textInfo=$add_msg['dbBusy'] . $this->_trnModel->printTotalProcessingTime('false');
						}}
					}
					else{
						$msg=str_replace('@VAR1@',$transaction_id,$add_msg['tranUseByOther']);
						$this->view->textInfo= $msg.$this->_trnModel->printTotalProcessingTime('false');
						//if($summaryid==true)
						//	$this->_trnModel->releaseLock($trn_identifier);
						//else $this->_trnModel->releaseLock('SUMMARY');
					}
				}
				else
				{
					$this->view->textErrors=$check;
				}
			} // Insert End----------------------------------------------
		}


		if($trnsIds)
			$details = $this->_trnModel->getTrnReceiptRecentQuery($trnsIds);
		if($details)
				$flag=1;

		if($transaction_id)
			$active_status=null;
		$this->view->trnSummary = $element->createSelectDb('trn_summary',$trnsSummaries,'TRAN_SUMMARY_ID'
		,'VOUCHER_NO',$transaction_id,null, null,'id="summaryid" onchange="callajax(this.value'.",'trnidresult','trninfoonidajax'".');" '.$active_status);
		$this->view->receiveType = $element->createSelectDb("receive_type",$recv_types,'VALUE_NAME',
		'VALUE_NAME', $type,null,null,'id="recv_type"');
	//	$this->_refModel = new modules_ref_models_refAccessQuery;
		$schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		if(!empty($scheme)) $active_status2=null;
		$this->view->scheme = $element->createSelectDb("scheme",$schemes, 'SCHEME_ID','SCHEME_NAME',$scheme, null, null, ' id="scheme_id"');

		$this->view->employee=$employee;
		$this->view->customer=$customer;
		$this->view->amount=$amount;
		$this->view->pdate = $date;
		$this->view->remarks = $remarks;
		$this->view->memo = $memo;

		if ($flag==1)
			$this->view->result =$details;
		$this->_session->receiptAddPage=$this->_trnModel->getCurrentUrlBase();
		$this->_session->totalSubmits=$this->view->totalSubmits=$totalSubmits;
		$this->_session->tdIds=$trnsIds;
	}

	public function editdtlAction()
	{
		$this->_session->actionHelp=true;
		if($this->_session->callerAction=='index' && $this->_session->HelpController='receive' )
			$this->_session->lastAction = 'index';
		else if($this->_session->callerAction=='adddetails' && $this->_session->HelpController='receive' )
			$this->_session->lastAction = 'adddetails';
		$this->_session->state=1;
		$this->_session->controller='receive';
		$this->view->paths=$this->_setAjaxPath();
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->view->page = $this->_request->getParam('page');
		$this->view->addPageRequest=$this->_request->getParam('add',null);
		if(!$this->view->addPageRequest)
			$this->view->url=$this->_session->indexUrl;
		else $this->view->url= $this->_session->receiptAddPage;
		$model=new modules_ref_models_refAccessQuery;
		$labels=new modules_trn_labels_label;
		$element =new Bloomfi_App_UHtmlElement;
		$message = new modules_trn_messages_message;
		$this->view->receiveFormHeader=$labels->getTrnReceiveFormLabels('receive');
		$this->view->viewlabels=$labels->getTrnReceiveViewLabels('editdtl');
		$this->_receiptTypes=$recv_types=$this->_trnModel->getAllReceiveTypesQuery();
		$details=$summary_id=$trnsSummaries=$customer_id=$option=$active_status=$type=null;

		if($this->getRequest()->isPost())
		{
			$trn_detail_id=trim($this->getRequest()->getPost('detailid'));
			$amount=trim($this->getRequest()->getPost('amount'));
			//$summary_id=trim($this->getRequest()->getPost('trn_summary'));
			$type=trim($this->getRequest()->getPost('receive_type'));
			$memo=trim($this->getRequest()->getPost('memo'));
			$remarks=trim($this->getRequest()->getPost('remarks'));
			$customer=trim($this->getRequest()->getPost('customer'));
			$employee=trim($this->getRequest()->getPost('employee'));
			$date=trim($this->getRequest()->getPost('date'));
			$this->view->page = $this->getRequest()->getPost('page');
			$this->view->totalSubmits=$this->getRequest()->getPost('totalSubmits');
			$detail_status=$this->_trnModel->transactionDetailByTdIdQuery($trn_detail_id);
			$edit_msg=$message->getTrnReceiveMessages('dbUpdate');
			$element =new Bloomfi_App_UHtmlElement;

			//FORM VALIDATION-------------
			$check=$this->receiptValidation($element,array('customer'=>$customer,'employee'=>$employee, 'amount'=>$amount, 'date'=>$date, 'memo'=>$memo,'type'=>$type,'tdid'=>$trn_detail_id) ,$edit_msg,'edit');
			//--------------------------------------------------------------------

			$summary_id=$this->_transaction_id;
	
				if(!$check)
				{
					$date=date('Y-m-d');
					$this->_trnModel->startProcessing();
					$td_identifier="DETAILS ID-".$trn_detail_id;
					$allow=$this->_trnModel->waitAndAllow($td_identifier);
					$this->_trnModel->endProcessing();
					if($allow==1) {
						$this->_trnModel->startProcessing();
						$td_info = $this->_trnModel->transactionDetailByTdIdQuery($trn_detail_id);
						$td_ts_idendifier_1='SUMMARY ID-'.$td_info[0]->TRAN_SUMMARY_ID;
						$allow1=$this->_trnModel->waitAndAllow($td_ts_idendifier_1);
						$this->_trnModel->endProcessing();
						if($allow1==1){
							$this->_trnModel->startTransaction();
							$ts_info = $this->_trnModel->getTransactionSummaryQuery($td_info[0]->TRAN_SUMMARY_ID);

							//-------------------------
							$current_recipt_due =(float)$ts_info[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
							$current_recipt_amount = (float)$ts_info[0]->TOTAL_RECEIPT_PRINCIPAL;
							$current_recpt_security_depos=(float)$ts_info[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
							$current_recpt_donation=(float)$ts_info[0]->TOTAL_RECEIPT_DONATION;
							$current_recpt_fees=(float)$ts_info[0]->TOTAL_RECEIPT_FEES;
							$current_recpt_type=$td_info[0]->RECEIPT_TYPE;
							$amounts=$this->getRollBackedReceiptAmountValueSet($recv_types,$td_info[0]->RECEIPT_AMOUNT, array($current_recpt_type, $current_recipt_amount, $current_recipt_due, $current_recpt_security_depos, $current_recpt_donation,$current_recpt_fees ));
							$total_recept_amount=$amounts[0];
							$total_recept_due=$amounts[1];
							$total_recept_security_depos=$amounts[2];
							$total_recept_donation=$amounts[3];
							$total_recept_fees=$amounts[4];
							$prev_total_details=$ts_info[0]->TOTAL_DETAILS-1;
							//-------------------------

							$data_ordered=array($total_recept_amount, $total_recept_due,$total_recept_donation, $total_recept_fees, $total_recept_security_depos, $date, $prev_total_details, $td_info[0]->TRAN_SUMMARY_ID );

							$status1=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($data_ordered);

							if($status1!=null) {
								$this->_trnModel->startProcessing();
								$td_ts_idendifier_2='SUMMARY ID-'.$summary_id;
								if($summary_id==$td_info[0]->TRAN_SUMMARY_ID)
									$allow=1;
								else
									$allow=$this->_trnModel->waitAndAllow($td_ts_idendifier_2);
								$this->_trnModel->endProcessing();
								if($allow==1) {
									$new_ts_info = $this->_trnModel->getTransactionSummaryQuery($summary_id);
									if(!$this->_employeeId) $this->_employeeId=$new_ts_info[0]->EMPLOYEE_ID;

									//------------------------------------------------

									$current_recipt_due =(float)$new_ts_info[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
									$current_recipt_amount = (float)$new_ts_info[0]->TOTAL_RECEIPT_PRINCIPAL;
									$current_recpt_security_depos= (float)$new_ts_info[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
									$current_recpt_donation= (float)$new_ts_info[0]->TOTAL_RECEIPT_DONATION;
									$current_recpt_fees= (float)$new_ts_info[0]->TOTAL_RECEIPT_FEES;
									$amounts=$this->getReceiptAmountValueSet($recv_types,$amount,array($type, $current_recipt_amount, $current_recipt_due, $current_recpt_security_depos, $current_recpt_donation,$current_recpt_fees ));

									$new_total_recept_amount=$amounts[0];
									$new_total_recept_due=$amounts[1];
									$new_total_recept_security_depos=$amounts[2];
									$new_total_recept_donation=$amounts[3];
									$new_total_recept_fees=$amounts[4];

									//------------------------------------------------
									$new_ts_total_details = $new_ts_info[0]->TOTAL_DETAILS+1;
									$new_td_scheme=$new_ts_info[0]->SCHEME_ID;

									$new_ts_data=array($new_total_recept_amount, $new_total_recept_due,$new_total_recept_donation, $new_total_recept_fees, $new_total_recept_security_depos, $date, $new_ts_total_details, $summary_id);
									$new_td_data=array($summary_id,$new_td_scheme,$this->_customerId,$this->_employeeId, $amount,$type,$memo,$remarks,$date,$trn_detail_id);

									$result1=$this->_trnModel->UpdateTrnDetailQuery($new_td_data);
									if ( $result1!=null){
										$result= $this->_trnModel->UpdateTrnSummaryByTsIdQuery($new_ts_data);
										if($result!=null){
											$this->_trnModel->commitTransaction();
											$this->view->textSuccess= $edit_msg['success'];}
										else
											$this->view->textErrors= $edit_msg['phase3'];
									}
									else
										$this->view->textErrors= $edit_msg['phase2'];

									//$this->_trnModel->releaseLock($td_ts_idendifier_2);
								}
								else
									$this->view->textInfo= "Unable to execute your request. Transaction '<b>".$summary_id."</b>' is using by another person. Please re-submit the form. ".$this->_trnModel->printTotalProcessingTime('false');
							}
							else
								$this->view->textErrors= $edit_msg['phase1'];

							//$this->_trnModel->releaseLock($td_ts_idendifier_1);
						}
						else
							$this->view->textInfo= "Unable to execute your request. Transaction '<b>".$td_info[0]->TRAN_SUMMARY_ID."</b>' is using by another person. Please re-submit the form. ".$this->_trnModel->printTotalProcessingTime('false');

						//$this->_trnModel->releaseLock($td_identifier);
					}
					else
					{
						$this->view->textInfo= "Unable to execute your request. Transaction '<b>".$trn_detail_id."</b>' is using by another person. Please re-submit the form. ".$this->_trnModel->printTotalProcessingTime('false');
					}
				}
				else
				{
					$this->view->textErrors=$check;
				}

				$this->view->trnDetailId=$trn_detail_id;
				$this->view->customer=$customer;
				$this->view->employee=$employee;
				$this->view->amount=$amount;
				$this->view->remarks=$remarks;
				$this->view->rdate=$date;
				$this->view->memo=$memo;
		}
		else
		{

			$trn_detail_id = $this->_request->getParam('id',null);
			$details=$this->_trnModel->transactionDetailByTdIdQuery($trn_detail_id);
			if($details) {
			$this->view->employee =$details[0]->EMPLOYEE_ID;
			$this->view->customer = $details[0]->CUSTOMER_ID;
			$customer_id=$details[0]->CUSTOMER_ID;
			$summary_id = $details[0]->TRAN_SUMMARY_ID;
			$this->view->amount = $details[0]->RECEIPT_AMOUNT;
			$type=$details[0]->RECEIPT_TYPE;
			$this->view->remarks=$details[0]->REMARKS;
			$this->view->rdate=$details[0]->TRANSACTION_DATE;
			$this->view->memo=$details[0]->MEMO_NO;
			$this->view->trnDetailId= $details[0]->TRAN_DETAILS_ID;}
		}
		$trnsSummaries=$this->_trnModel->transactionSummariesByCustID($customer_id);
		if($trnsSummaries)
			$summary_id=$trnsSummaries[0]->TRAN_SUMMARY_ID;
		else $active_status='disabled';	$this->view->trnSummary=$element->createSelectDb('trn_summary',$trnsSummaries,'TRAN_SUMMARY_ID','VOUCHER_NO',$summary_id,null,null,'id="summaryid" onChange="callajax(this.value'.",'trnidresult','".$this->_paths['urlTransInfoOnId']."'".');"'.$active_status);
		$this->view->receiveType = $element->createSelectDb("receive_type",$recv_types,'VALUE_NAME','VALUE_NAME', $type,null,null,'id="recv_type"');
		$this->_trnModel->destroy();
		unset($this->_trnModel,$message,$labels,$element);

	}

	public function summarydtlidAction()
	{
		$this->_helper->layout->disableLayout();
		$labels=new modules_trn_labels_label;
		$this->view->detailTableHeader=$labels->getTrnReceiveTableLabels('detailsPmnt');
		$this->view->viewlabels=$labels->getTrnReceiveViewLabels('detailsInfo');
		$trns_id = $this->_request->getParam('tsid');
		$user=$this->_getUser();
		$details = $this->_trnModel->getTransactionDetailQuery(array($user,$trns_id));
		$this->view->transactionDetails = $details;
		$this->view->trns_id = $trns_id;
		$this->view->trns_dtl_id = $this->_request->getParam('tdid');
		$this->view->totalDetails = count($details);
		$this->_trnModel->destroy();
		ob_flush();
		flush();
		unset($this->_trnModel,$labels);
	}


	protected function _setAjaxPath()
	{
		$this->_paths['url']=$this->_trnModel->getCurrentUrlBase();
		$this->_paths['urlVoucher']=$this->_paths['url']."/../voucherajax";
		$this->_paths['urlTransInfo']=$this->_paths['url']."/../trninfoajax";
		$this->_paths['urlTransInfoOnId']=$this->_paths['url']."/../trninfooncidajax";
		$this->_paths['urlTrnInfoOnId']=$this->_paths['url']."/../trninfoonidajax";
		return $this->_paths;
	}

	public function suggestcustonempAction()
	{
		$model = new Modules_Trn_Models_TrnAccessQuery;
		$cust_name = strtolower($this->_request->getParam('q'));
		if (!$cust_name) return;
		$employee_val= explode(',',$this->_request->getParam('emp'));
		$employee_id=trim($employee_val[1]);
		$datas=array($employee_id,$cust_name);
		$this->view->customer = $model->getCustOnEmpQuery($datas);
		$this->_helper->layout->disableLayout();
		unset($model);

	}

	public function suggesttrnsoncustAction()
	{
		$model = new Modules_Trn_Models_TrnAccessQuery;
		$scheme_name = strtolower($this->_request->getParam('q'));
		if (!$scheme_name) return;
		$customer_val= explode(',',$this->_request->getParam('cust'));
		$customer_id=trim($customer_val[1]);
		$datas=array($customer_id,$scheme_name);
		$this->view->transactions = $model->getTrnsOnCustQuery($datas);
		$this->_helper->layout->disableLayout();
		unset($model);
	}

	public function voucherajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$path=$this->_setAjaxPath();
		$transaction_id=$trnsSummaries=null;
		$element =new Bloomfi_App_UHtmlElement;
		$param=trim($this->_request->getParam('q',null));
		if($param){
		$values=explode(',',$param);
		$c_id=trim($values[0]);
		$trnsSummaries=$this->_trnModel->transactionSummariesByCustID($c_id); }
		if($trnsSummaries)
			$transaction_id=$trnsSummaries[0]->TRAN_SUMMARY_ID;
		else $active_status='disabled';
		if($transaction_id)
			$active_status=null;
		$this->view->trans = $element->createSelectDb('trn_summary',$trnsSummaries,'TRAN_SUMMARY_ID'
		,'VOUCHER_NO',$transaction_id,null, null,'id="summaryid" onChange="callajax(this.value'.",'trnidresult','".$path['urlTrnInfoOnId']."'".');" '.$active_status);
		unset($element);
	}

	public function trninfoajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$param=trim($this->_request->getParam('q'));
		$values=explode(',',$param);
		$this->view->customer_id=trim($values[0]);
		$this->view->smryInfos=$this->_trnModel->getTranSmryInfosByCustIDQuery($this->view->customer_id);
	}

	public function trninfoonidajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$param=trim($this->_request->getParam('q',null));
		$this->view->smryInfos=$this->_trnModel->getTransactionSummaryQuery($param);
	}

	public function trninfooncidajaxAction()
	{
		$employee=null;
		$this->_helper->layout->disableLayout();
		$param=trim($this->_request->getParam('q'));
		$values=explode(',',$param);
		$customer_id=trim($values[0]);
		$result=$this->_trnModel->getTranSmryInfosByCustIDQuery($customer_id);
		if($result)
			$this->view->smryInfos=$this->_trnModel->getTransactionSummaryQuery($result[0]->TRAN_SUMMARY_ID);
	}

	public function memochkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$memo=trim($this->_request->getParam('q',null));
		$this->view->result=$this->_trnModel->isMemoNoQuery($memo);
	}

	public function receiptValidation($element,$data,$messages,$section=null)
	{
		$check=$select_check=$errors=null;
		$msg=$element->
					checkElement($this->view->receiveFormHeader['customer'],$data['customer'],50,2);
		if($msg)$check['customer']=$msg;
		$msg=$element->
			checkElementSpace($this->view->receiveFormHeader['memo'],$data['memo'],30,0);
		if($msg)$check['memo']=$msg;
		else {
			 }
		$msg=$element->
					checkElementNum($this->view->receiveFormHeader['receiptAmount'],$data['amount'],13,1);
		if($msg)$check['amount']=$msg;
		else {
			$amount=(float)$data['amount'];
			$msg=$element->	checkElementFloatComp($this->view->receiveFormHeader['receiptAmount'],$amount,0,$messages['invalidAmount1']);
			if($msg)$check['amount']=$msg;
		}
		$msg=$element->checkElementSelect('default',$this->view->receiveFormHeader['receiptType'],$data['type']);
		if($msg)$check['receiptType']=$msg;
		$msg=$element->checkElementDate($this->view->receiveFormHeader['receiptDate'],$data['date']);
		if($msg)$check['date']=$msg;
		if(!$check)
		$errors=$this->dbValidation($data,$messages,$section);

		if($errors) $check=array_merge((array)$check,$errors);

		return $check;
	}

	public function dbValidation($data=null,$messages,$section=null)
	{
		$errors=null;
		if($data['customer']){
			//$cust_values=explode(',',$customer);
		//	$this->_customerId=strtoupper(trim($cust_values[0]));
			$this->_customerId=$data['customer'];
			$result = $this->_refModel->getCustomerQuery( $this->_customerId );
			if(!$result)
				$errors['customer_id'] ="Customer '<b>$this->_customerId</b>' is not a valid customer id";
			else {
					$this->_customerName=$result[0]->ENTITY_NAME;
					$this->_customerGender=$result[0]->SEX;
					$this->_customerId=$result[0]->ENTITY_ID;
					if($section=='edit'){
						$trnsSummaries=$this->_trnModel->transactionSummariesByCustID($this->_customerId);
						$this->_transaction_id=$trnsSummaries[0]->TRAN_SUMMARY_ID;
					}
				}
		}
		if($data['employee']){
		//	$emp_values=explode(',',$employee);
		//	$this->_employeeId=strtoupper(trim($emp_values[0]));
			$this->_employeeId=$data['employee'];
			$result=$this->_refModel->getEmployeeQuery($this->_employeeId);
			if(!$result)
				$errors['employee_id'] = "Employee '<b>$this->_employeeId</b>' is not a valid employee id";
			else $this->_employeeId=$result[0]->ENTITY_ID;
		}

		if($data['memo']){
			if($section=='edit')
			{
				$memoInfo=array($data['memo'],$data['tdid']);
				$result=$this->_trnModel->isMemoNoExceptMeQuery($memoInfo);
				if($result) $check['memo']=str_replace('@VAR1@',$data['memo'],$messages['duplicateMemo']);
			}
			else {
				$result=$this->_trnModel->isMemoNoQuery($data['memo']);
				if($result) $errors['memo']=str_replace('@VAR1@',$data['memo'],$messages['duplicateMemo']);
			}
		}

		if($data['type']){
			if($section=='edit'){
				if($this->_receiptTypes[1]->VALUE_NAME==$data['type']){
					$typInfo=array($data['customer'],$this->_receiptTypes[1]->VALUE_NAME,$data['tdid']);
					$result=$this->_trnModel->isExistExceptMeBSDReceiptTypeQuery($typInfo);
					if($result) $check['receiptType']=str_replace('@VAR1@',$data['customer'],$messages['receiptType']);
				}
			}
			else {
				if($this->_receiptTypes[1]->VALUE_NAME==$data['type']){
					$result=$this->_trnModel->isExistBSDReceiptTypeQuery(array($data['customer'],$this->_receiptTypes[1]->VALUE_NAME));
					if($result) $errors['receiptType']=str_replace('@VAR1@',$data['customer'],$messages['receiptType']);
				}
			}
		}

	//	$errors['test']='Error';

		if($errors)
			return $errors;
		else
			return null;

	}

}

<?php

class Trn_IndexController extends modules_trn_controllers_TrnController
{
	protected $_session;

    function preDispatch()
	{
		$this->_initialize();
	}

	public function indexAction()
	{
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'trn','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'trn','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'trn','position'=>'Right'));
	}

	function paymentexcelAction()
	{
		$model = new modules_trn_models_trnAccessQuery;
		$labels=new modules_trn_labels_label;
		$this->view->tableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
		$customer_name = $this->_request->getParam('cnm');
		$customer_code =  $this->_request->getParam('cid');
		$employee_name =  $this->_request->getParam('enm');
		$employee_code =  $this->_request->getParam('eid');
		$scheme = $this->_request->getParam('schm');
		$scheme_type = $this->_request->getParam('param1');
		$voucher =  $this->_request->getParam('vchr');
		$start_date =  $this->_request->getParam('strdt');
		$end_date =  $this->_request->getParam('enddt');
		$payment_data = array( $customer_name,$employee_name,$scheme,$scheme_type,$customer_code,$employee_code,$voucher, $start_date, $end_date);
		$data_bundle = $this->getDataForXls($model,'getTransactionSummaryBySrchQuery',$payment_data);
		$this->view->result=$data_bundle['result'];
		$model->destroy();
		unset($model,$labels);
	}

	function receiveexcelAction()
	{
		$customer_name=$employee_name=$customer_code=$employee_code=$scheme= $start_date=$end_date= $memo_start= $memo_end= $scheme_type=null;
		$model = new modules_trn_models_trnAccessQuery;
		$labels=new modules_trn_labels_label;
		$this->view->tableHeader=$labels->getTrnReceiveTableLabels('detailsRecv');
		$customer_name = $this->_request->getParam('cnm');
		$customer_code =  $this->_request->getParam('cid');
		$employee_name =  $this->_request->getParam('enm');
		$employee_code =  $this->_request->getParam('eid');
		$scheme = $this->_request->getParam('schm');
		$memo_start =  $this->_request->getParam('param1');
		$memo_end =  $this->_request->getParam('param2');
		$scheme_type =  $this->_request->getParam('param3');
		$start_date =  $this->_request->getParam('strdt');
		$end_date =  $this->_request->getParam('enddt');
		$receive_data = array( $customer_name,$employee_name,$customer_code,$employee_code,$scheme, $start_date, $end_date, $memo_start, $memo_end, $scheme_type);
	//	print_r($receive_data);
	//	die;
		$data_bundle = $this->getDataForXls($model,'getTransactionDetailBySrchQuery',$receive_data);
		$this->view->result=$data_bundle['result'];
		$model->destroy();
		unset($model,$labels);
	}

	function totaltrnAction()
	{
		$this->view->formatter=new Bloomfi_NumericFormat;
		$this->_helper->layout->disableLayout();
		$component = new modules_com_transaction_totalTransaction;
		$result = $component->getTotalTrnInfo();
		$this->view->totalTrnInfo = $result[0];
		$component->destroy();
		unset($component,$formatter);
	}

}
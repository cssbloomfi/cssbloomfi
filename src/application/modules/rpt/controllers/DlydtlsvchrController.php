<?php
class Rpt_DlydtlsvchrController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Daily Details Voucher Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDlyDtlsVchrXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDlyDtlsVchrXml','filePrefix'=>'Dly_Dtls_Vchr_','viewFileName'=>'Daily Details Voucher Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


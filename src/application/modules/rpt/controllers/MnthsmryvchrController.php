<?php
class Rpt_MnthsmryvchrController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Monthly Summary Voucher Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getMnthSmryVchrXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getMnthSmryVchrXml','filePrefix'=>'Mnth_Smry_Vchr_','viewFileName'=>'Monthly Summary Vchr Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


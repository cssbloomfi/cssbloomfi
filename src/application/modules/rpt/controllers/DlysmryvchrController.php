<?php
class Rpt_DlysmryvchrController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Daily Summary Voucher Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDlySmryVchrXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDlySmryVchrXml','filePrefix'=>'Dly_SmryMemo_','viewFileName'=>'Daily Summary Voucher Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


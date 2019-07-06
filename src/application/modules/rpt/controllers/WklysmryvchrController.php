<?php
class Rpt_WklysmryvchrController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Weekly Summary Voucher Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getWklySmryVchrXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getWklySmryVchrXml','filePrefix'=>'Wkly_Smry_Vchr_','viewFileName'=>'Weekly Summary Voucher Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_DlydtlsmemoController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Daily Details Memo Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDlyDtlsMemoXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDlyDtlsMemoXml','filePrefix'=>'Dly_Dtls_Memo_','viewFileName'=>'Daily Details Memo Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}

?>
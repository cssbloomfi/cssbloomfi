<?php
class Rpt_MnthsmrymemoController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Monthly Summary Memo Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getMnthSmryMemoXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getMnthSmryMemoXml','filePrefix'=>'Mnth_Smry_Memo_','viewFileName'=>'Monthly Summary Memo Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


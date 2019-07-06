<?php
class Rpt_DlysmrymemoController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Daily Summary Memo Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDlySmryMemoXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDlySmryMemoXml','filePrefix'=>'DlySmryMemo_','viewFileName'=>'Daily Summary Memo Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


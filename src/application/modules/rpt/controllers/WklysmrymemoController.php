<?php
class Rpt_WklysmrymemoController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Weekly Summary Memo Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getWklySmryMemoXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getWklySmryMemoXml','filePrefix'=>'Wkly_Smry_Memo_','viewFileName'=>'Weekly Summary Memo Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_WeektopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Week Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getWeekTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getWeekTopShtXml','filePrefix'=>'Week_Top_Sht','viewFileName'=>'Week Top Sht Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


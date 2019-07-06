<?php
class Rpt_MnthtopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Month Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getMnthTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getMnthTopShtXml','filePrefix'=>'Mnth_Top_Sht','viewFileName'=>'Month Top Sheet Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_LoctopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Location Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getLocTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getLocTopShtXml','filePrefix'=>'Loc_Top_Sht','viewFileName'=>'Location Top Sheet Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


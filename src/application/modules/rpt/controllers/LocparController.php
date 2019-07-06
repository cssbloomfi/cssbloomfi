<?php
class Rpt_LocparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Location Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getLocParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getLocParXml','filePrefix'=>'Loc_Par_','viewFileName'=>'Location Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


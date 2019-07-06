<?php
class Rpt_ColllocsmryactController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Location Summary Activity Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollLocSmryActXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollLocSmryActXml','filePrefix'=>'Coll_Loc_Smry_Act_','viewFileName'=>'Collector Location Summarymry Activity Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_CollsmryactController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Summary Activity Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollSmryActXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollSmryActXml','filePrefix'=>'Coll_Smry_Act_','viewFileName'=>'Collector Summary Activity Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_ColllocgndrsmryactController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Location Gender Summary Activity Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollLocGndrSmryActXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollLocGndrSmryActXml','filePrefix'=>'Coll_Loc_Gndr_Smry_Act_','viewFileName'=>'Collecor Location Gender Summary Activity Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


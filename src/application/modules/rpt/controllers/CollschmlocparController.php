<?php
class Rpt_CollschmlocparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Project Location Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollSchmLocParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollSchmLocParXml','filePrefix'=>'Coll_Schm_Loc_Par_','viewFileName'=>'Collector Project Location Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


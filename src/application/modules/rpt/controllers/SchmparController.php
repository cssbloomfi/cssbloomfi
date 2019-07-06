<?php
class Rpt_SchmparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Project Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getSchmParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getSchmParXml','filePrefix'=>'Schm_Par_','viewFileName'=>'Project Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


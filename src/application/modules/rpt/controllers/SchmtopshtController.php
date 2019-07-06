<?php
class Rpt_SchmtopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Project Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getSchmTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getSchmTopShtXml','filePrefix'=>'Schm_Top_Sht','viewFileName'=>'Project Top Sheet Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


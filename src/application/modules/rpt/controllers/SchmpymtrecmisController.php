<?php
class Rpt_SchmpymtrecmisController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Project Wise Payment Receipt";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getSchmPymtRecMisXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getSchmPymtRecMisXml','filePrefix'=>'Schm_Pymt_Rec_Mis_','viewFileName'=>'Project Wise Payment Recept Mis  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_CollschmparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Project Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollSchmParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollSchmParXml','filePrefix'=>'Coll_Schm_Par_','viewFileName'=>'Collector Project Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


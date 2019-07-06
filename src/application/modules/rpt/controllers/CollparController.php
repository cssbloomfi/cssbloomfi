<?php
class Rpt_CollparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollParXml','filePrefix'=>'Coll_Par_','viewFileName'=>'Collector Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_GndrparController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Gender Par Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getGndrParXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getGndrParXml','filePrefix'=>'Gndr_Par_','viewFileName'=>'Gender Par  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


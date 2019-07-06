<?php
class Rpt_BsdController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Bsd Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getBsdXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getBsdXml','filePrefix'=>'Bsd_','viewFileName'=>'Bsd  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


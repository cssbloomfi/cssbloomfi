<?php
class Rpt_AcnttyptopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Account Type Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getAcntTypTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getAcntTypTopShtXml','filePrefix'=>'Acnt_Typ_Top_Sht','viewFileName'=>'Account Type Top Sht Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_ColltopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollTopShtXml','filePrefix'=>'Coll_Top_Sht','viewFileName'=>'Collector Top Sheet Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


<?php
class Rpt_DtltopshtController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Detailed Top Sheet Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDtlTopShtXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDtlTopShtXml','filePrefix'=>'Dtl_Top_Sht','viewFileName'=>'Detailed Top Sht Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


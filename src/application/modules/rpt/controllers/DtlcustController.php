<?php
class Rpt_DtlcustController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Detailed Beneficiary Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDtlCustXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDtlCustXml','filePrefix'=>'DtlCust1_','viewFileName'=>'Detailed Beneficiary  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


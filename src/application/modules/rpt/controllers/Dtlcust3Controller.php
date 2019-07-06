<?php
class Rpt_Dtlcust3Controller extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Detailed Beneficiary Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDtlCust3Xml();
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDtlCust3Xml','filePrefix'=>'DtlCust3_','viewFileName'=>'Detailed Beneficiary  Xls Export File'));
		$this->createFormSet($result);
		unset($model);
	}
}


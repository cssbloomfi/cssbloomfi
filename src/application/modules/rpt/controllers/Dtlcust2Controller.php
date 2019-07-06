<?php
class Rpt_Dtlcust2Controller extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Detailed Beneficiary Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getDtlCust2Xml();
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getDtlCust2Xml','filePrefix'=>'DtlCust2_','viewFileName'=>'Detailed Beneficiary  Xls Export File'));
		$this->createFormSet($result);
		unset($model);
	}
}


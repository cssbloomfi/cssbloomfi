<?php
class Rpt_CustlocController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Beneficiary Location";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCustLocXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCustLocXml','filePrefix'=>'cust_loc_','viewFileName'=>'Beneficiary Location Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


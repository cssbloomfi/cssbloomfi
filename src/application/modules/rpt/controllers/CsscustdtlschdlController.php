<?php 
	class Rpt_CsscustdtlschdlController extends modules_rpt_controllers_ReportController
	{
		function preDispatch()
		{
			$this->_initialize();
		}

		function indexAction()
		{
			$this->view->title="Benificiary Schedule";
			$model=new modules_rpt_models_rptReportQuery;
			$result=$model->getCssCustDtlSchdlXml();	
			$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCssCustDtlSchdlXml','filePrefix'=>'cust_dtl_schedule_','viewFileName'=>'Beneficiary Detail Schedule'));
			$this->createFormSet($result);
			unset($model); 
		}
	}

?>
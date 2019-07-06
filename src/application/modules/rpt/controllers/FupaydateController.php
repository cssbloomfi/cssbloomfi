<?php 
	class Rpt_FupaydateController extends modules_rpt_controllers_ReportController
	{
		function preDispatch()
		{
			$this->_initialize();
		}

		function indexAction()
		{
			$this->view->title="Payment Entry In Future Date";
			$model=new modules_rpt_models_rptReportQuery;
			$result=$model->getFuPayDateXml();	
			$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getFuPayDateXml','filePrefix'=>'future_pay_date_','viewFileName'=>'Payment Entry With Future Date Xls Export File'));
			$this->createFormSet($result);
			unset($model); 
		}
	}

?>
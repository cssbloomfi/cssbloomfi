<?php 
	class Rpt_FurecdateController extends modules_rpt_controllers_ReportController
	{
		function preDispatch()
		{
			$this->_initialize();
		}

		function indexAction()
		{
			$this->view->title="Recept Entry In Future Date";
			$model=new modules_rpt_models_rptReportQuery;
			$result=$model->getFuRecDateXml();	
			$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getFuRecDateXml','filePrefix'=>'future_rec_date_','viewFileName'=>'Recept Entry With Future Date Xls Export File'));
			$this->createFormSet($result);
			unset($model); 
		}
	}

?>
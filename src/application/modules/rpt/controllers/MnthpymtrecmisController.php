<?php
class Rpt_MnthpymtrecmisController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Month Wise Payment Receipt";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getMnthPymtRecMisXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getMnthPymtRecMisXml','filePrefix'=>'Mnth_Pymt_Rec_Mis_','viewFileName'=>'Month Wise Payment Recept Mis  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


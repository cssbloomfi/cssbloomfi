<?php
class Rpt_GndrpymtrecmisController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Gender Wise Payment Receipt";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getGndrPymtRecMisXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getGndrPymtRecMisXml','filePrefix'=>'Gndr_Pymt_Rec_Mis_','viewFileName'=>'Gender Wise Payment Recept Mis  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


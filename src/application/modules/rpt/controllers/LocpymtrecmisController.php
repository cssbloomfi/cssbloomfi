<?php
class Rpt_LocpymtrecmisController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Location Wise Payment Receipt";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getLocPymtRecMisXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getLocPymtRecMisXml','filePrefix'=>'Loc_Pymt_Rec_Mis_','viewFileName'=>'Location Wise Payment Recept Mis  Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


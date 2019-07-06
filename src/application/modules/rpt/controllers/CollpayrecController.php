<?php
class Rpt_CollpayrecController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Payment Recept Reports";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollPayRecXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollPayRecXml','filePrefix'=>'Coll_Pay_Rec','viewFileName'=>'Collector Payment Recept Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


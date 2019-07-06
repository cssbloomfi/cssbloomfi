<?php
class Rpt_ColllocgndrdtlsactController extends modules_rpt_controllers_ReportController
{
	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$this->view->title="Collector Location Gender Details Activity Report";
		$model=new modules_rpt_models_rptReportQuery;
		$result=$model->getCollLocGndrDtlsActXml();	
		$this->setBasicFrameParams( array('model'=>'modules_rpt_models_rptReportQuery','function'=>'getCollLocGndrDtlsActXml','filePrefix'=>'Coll_Loc_Gndr_Dtls_Act_','viewFileName'=>'Collector Location Gender Details Act Xls Export File'));
		$this->createFormSet($result);
		unset($model); 
	}
}


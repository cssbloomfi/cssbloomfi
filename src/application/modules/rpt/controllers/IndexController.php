<?php
class Rpt_IndexController extends modules_rpt_controllers_ReportController
{
	protected $_label;
	protected $_session;

	function preDispatch(){
		$this->_initialize();
		$this->_label=new modules_rpt_labels_label;
	}

    function indexAction()
    {
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'rpt','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'rpt','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'rpt','position'=>'Right'));
    }

	function commonrptwindowAction()
	{
		$this->_helper->layout->disableLayout();
	}

	function getDataForXls($class,$funtion,$rows=5000,$start)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$rows=5000;
		$data = array($start,$rows);
		$result=$class->$funtion($data);
		return $result;
	}

}

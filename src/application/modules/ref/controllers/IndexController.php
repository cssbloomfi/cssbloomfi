<?php
class Ref_IndexController extends modules_ref_controllers_RefController
{
	protected $_session;

	function preDispatch(){
		$this->_session=$this->_initialize();
	}

    function indexAction()
    {
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'ref','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'ref','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'ref','position'=>'Right'));
    }

	function totalinfoAction()
	{
		$this->_helper->layout->disableLayout();
		$component = new modules_com_reference_totalCustSchmCollLoc;
		$result = $component->getTotalCustSchmCollLoc();
		$component->destroy();
		$this->view->totalCustResult = $result['component']['result1'][0];
		$this->view->totalSchmResult = $result['component']['result2'][0];
		$this->view->totalCollResult = $result['component']['result3'][0];
		$this->view->totalLocResult  = $result['component']['result4'][0];
	}
}

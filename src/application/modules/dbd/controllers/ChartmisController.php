<?php
class ChartmisController extends modules_dbd_controllers_DbdController
{
	protected $_dbdModel;
	protected $_session;
	protected $_sqlParam;
	protected $_width=450;
	protected $_height=300;

	function preDispatch(){
		$this->_initialize();
	}

	function indexAction()
	{
		$this->view->title = "Manegement Information System";
		$model=new AccessQuery;
		$roleId=$this->_session->roleId;
		$result=$model->getComponentAccessQuery($roleId);
		$this->view->result = $result;
	}

	
}

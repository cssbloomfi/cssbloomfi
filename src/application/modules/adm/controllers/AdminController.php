<?php
class modules_adm_controllers_AdminController extends Zend_Controller_Action
{
	protected $_session=null;
	protected $_admConfig=null;
	protected $_admModel=null;
	protected $_page=1;
	protected $_flag=null;
	protected $_labels;
	protected $_url=null;
	protected $_modelName=null;

	public function prepare()
	{
		$this->_session=Zend_Registry::get('SQL');
		$this->_admModel = new modules_adm_models_admAccessQuery(); 
		$this->_modelName = 'modules_adm_models_admAccessQuery';
		$this->_admConfig = new modules_adm_config_adm;
		$this->_labels = new modules_adm_labels_label;
		$this->view->images=$this->_session->images;
		$this->view->theme=$this->_session->theme['activeTheme'];
		$this->view->themePath=$this->_session->theme['themePath'];
		$this->_session->actionHelp=false;
		return $this->_session;
	}

	function setupSessionData($sqlName)
	{
		$this->_session->state=0;
		$this->_bundle=$this->_admModel->executeSessionSQL($this->_session->sql,$sqlName);
		$this->_count=$this->_session->counter;
		$this->_url=$this->_session->indexUrl;
	}

	function setUrlData()
	{
		$this->_url = $url;
	}

	function getPage()
	{
		$this->_page=$this->_request->getParam('page',1);
	}

	function setPage($page=1)
	{
		$this->_page=$page;
	}

	function getPageValue()
	{
		return $this->_page;
	}

	function prepareActionPage()
	{
		$this->_flag=0;
		Bloomfi_Paginator::initializePaginator(10,10);
	}

	function prepareData($function=null,$data=null)
	{
		$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($this->_page);
		if($data)$data=array_merge($data,$pagination_limits);
		else $data=$pagination_limits;
		$data_bundle= $this->_admModel->$function($data);
		return $data_bundle;
	}

	function setPrepareData($data_bundle,$url,$session=false)
	{
		if($session==false){
			$this->_url=$url;
			$this->createResultSet($data_bundle['result'],$data_bundle['sql']); }
		else{
			$this->createResultSet($this->_bundle['result'],$this->_bundle['sql']);
		}
	}

	function createResultSet($result=null,$sql=null)
	{
		 $count=count($result);		
		 if($count>0) $this->_flag=1;
		 if ($this->_flag==1)
			$this->view->paginator = Bloomfi_Paginator::factory($result,$this->_page,$count);
		 $this->_session->sql=$sql;
		 $this->_session->indexUrl = $this->_url;
		 $this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
		 $this->_session->state=0;
	}

	function _setExportSessionDatas($functionName,$auParams,$table,$fileName)
	{
		$this->_session->modelName=$this->_modelName;
		$this->_session->functionName=$functionName;
		$this->_session->data=$auParams['array_params'];
		$this->_session->tableHeaders=$table['headers'];
		$this->_session->orderColumns=$table['columns'];
		$this->_session->exportFilePrefix=$fileName;
	}
	
	function _getUser()
	{
		$auth = Zend_Auth::getInstance();
		$user=$auth->getIdentity();
		return $user->USER_ID;
	}

}

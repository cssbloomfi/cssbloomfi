<?php
class IndexController extends modules_dbd_controllers_DbdController
{
	protected $_dbdModel;
	protected $_sqlParam;
	protected $_width=450;
	protected $_height=300;

	function preDispatch(){
		$this->_initialize();
	}

	function indexAction()
	{
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'dbd','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'dbd','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'dbd','position'=>'Right'));
	}

	function xlsexpimpAction()
	{
		$this->view->title = "Excel Export Import";
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'xls','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'xls','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'xls','position'=>'Right'));
	}

	function helpAction()
	{
		$url=new ZendExtend_Url;
		if($this->_request->getParam('fnm')) {
			$fileName = $this->_request->getParam('fnm');
			$this->view->videoFile =$url->getBaseURL().'/videos/'.$fileName.'.swf'; }
		unset($url);
	}

	function mgmtinfsysAction()
	{
		$this->view->title = "Manegement Information System";
		$comp=new modules_com_library_loader_compLoader;
		$this->view->componentListLeft=$comp->load(array('module'=>'visrpt','position'=>'Left'));
		$this->view->componentListCenter=$comp->load(array('module'=>'visrpt','position'=>'Center'));
		$this->view->componentListRight=$comp->load(array('module'=>'visrpt','position'=>'Right'));
	}

	function createpdfAction()
	{
		$fileName=null;
		$totalData=$this->_session->data;
		$modelName=$this->_session->modelName;
		$functionName=$this->_session->functionName;
		$tableRequireData=$this->_session->tableRequireData;
		$fileno=$this->_request->getParam('file');
		$start=$this->_request->getParam('start');
		$rows=$this->_request->getParam('rows');
		$fileName=$this->_session->exportFilePrefix."_".$fileno;
		$this->getParamValue($totalData);
		$model=new $modelName;
		$this->_sqlParam=array_merge($this->_sqlParam,array($start,$rows));
		$resultSet = $model->$functionName($this->_sqlParam);
		if(is_array($resultSet)) $resultSet=$resultSet['result'];
		$this->view->trData=$tableRequireData;
		$this->view->result=$resultSet;
		$this->view->fileName=$fileName;
		$this->view->type='L';
	}

	function exceluploadAction()
	{
		$this->_session->actionHelp=false;
		$menu = new AccessQuery();
		$this->view->title = "Excel Uploading";
		$this->view->menu = $menu->getExcelUploadingMenuQuery();
	}

	function commonexportAction()
	{
		$i=1;
		$expParams=null;
		$fileno=$this->_request->getParam('file');
		$start=$this->_request->getParam('start');
		$rows=$this->_request->getParam('rows');
		$model=new $this->_session->modelName;
		$functionName=$this->_session->functionName;
		$data=$this->_session->data;
		$this->view->fileName=$this->_session->exportFilePrefix."_".$fileno;
		$data=array_merge($data,array($start,$rows));
		$result=$model->$functionName($data);
		$xml=new BinaryBl_ReportFrameWork_ReportGenerator($result);
		$this->getParamValue($xml);
		$this->view->xlsHeader=$xml->getXmlTableHeaderLabel();
		$xml->setSqlParams($data);
		$this->view->xlsResult=$this->getDataForXls($xml,$this->_sqlParam);
		//print_r($this->_sqlParam);
		if($this->_sqlParam){
			foreach($this->_sqlParam as $param)	{
				$key='param'.$i;
				$expParams[$key]=$param;
				$i++;	}
		}
		//print_r($expParams);
		$this->view->xlsFooter=$xml->_getFooterSql($expParams);
		//print_r($this->view->xlsFooter);
		//die;
	}

	function commonexport1Action()
	{
		$start=$rows=null;
		$fileno=$this->_request->getParam('file');
		$start=$this->_request->getParam('start');
		$rows=$this->_request->getParam('rows');
		$model=new $this->_session->modelName;
		$functionName=$this->_session->functionName;
		$data=$this->_session->data;
		array_push($data,$start);
		array_push($data,$rows);
		$result=$model->$functionName($data);
		$this->view->result=$result['result'];
		$this->view->tableHeaders=$this->_session->tableHeaders;
		$this->view->orderColumns=$this->_session->orderColumns;
		$this->view->fileName=$this->_session->exportFilePrefix."_".$fileno;
	}

	function xlsexprtarrAction()
	{
		$this->view->tableHeaders=$this->_session->xlsHeader;
		$this->view->tableResults=$this->_session->xlsResult;
		$this->view->fileName=$this->_session->fileName;
	}

	function custcompAction()
	{
		$this->_helper->layout->disableLayout();
		$component=new modules_com_customer_customerInfo;
		$result=$component->getCustomerInfo();
		$this->view->totalCustomerResult=$result['component']['result1'][0];
		$this->view->loanCustomerResult=$result['component']['result2'][0];
	}


	public function getParamValue(&$require=null)
	{
		$this->_sqlParam=array();
		if(is_object($require))$count=$require->getTotalParamsForSqlResult();
		elseif(is_array($require))$count=count($require);
		else $count=$require;
		for($i=1;$i<=$count;$i++){
			$value=$this->_request->getParam("param".$i);
			array_push($this->_sqlParam,$value);
		}
	}

	public function getDataForXls(&$xml,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$sqlBundle=$xml->getXmlResultSqlBundle();
		$rows=5000;
		$params=$this->_convertAsterixInArray($params);
		if($params)
			$sqlQuery=$xml->bindSqlParams($sqlBundle['sql'],$sqlBundle['params'],$params,true);
		else
			$sqlQuery = $sqlBundle['sql'];
		$sqlQuery=$sqlQuery. " LIMIT ".$start.",".$rows;
		$db=new Bloomfi_SqlUtil;
		$result = $db->fireSqlFetchAll($sqlQuery);
		unset($db);
		return $result;
	}
}

<?php
class modules_rpt_controllers_ReportController extends Zend_Controller_Action
{
	protected $_session=null;
	protected $_sqlParam=array();
	protected $_pagination=null;
	protected $_paginationLimits=null;
	protected $_xmlForm=null;
	protected $_page=1;
	protected $_totalFormColumnsPerRow=2;
	protected $_exportFileName=null;
	protected $_model=null;
	protected $_function=null;
	protected $_filePrefix=null;
	protected $_tableSetExternal=null;
	protected $_htmlTableFormat=null;

	public function _initialize(){
		$this->_session=Zend_Registry::get('SQL');
		$this->_session->actionHelp=false;
		$this->view->images=$this->_session->images;
		$this->view->theme=$this->_session->theme['activeTheme'];
		$this->view->themePath=$this->_session->theme['themePath'];
		return $this->_session;
	}

	public function createFormSet($result,$search=true,$order=true,$limit=true)
	{
		$this->_sqlParam=array();
		$pagiObj=new BinaryBl_PagiantionArrAndUrlParams;
		$this->_page=$this->_request->getParam('page',1);
		$this->_xmlForm=new BinaryBl_ReportFrameWork_ReportGenerator($result);
		$pagiValue=$this->_xmlForm->getPaginationConfigValue();
		$this->view->heading=$this->_xmlForm->getXmlTitle();
		$this->_pagination=new Bloomfi_Paginator;
		$this->_pagination->initializePaginator($pagiValue['pages'],$pagiValue['rowsperpage']);
		$this->_session->modelName=$this->_model;
		$this->_session->functionName=$this->_function;
		$this->_session->exportFilePrefix=$this->_filePrefix;
		$this->_xmlForm->setColumnsPerRowForTable($this->_totalFormColumnsPerRow);

		$params=$this->_xmlForm->getSearchParamList();
		if($this->getRequest()->isPost()) {
			$request=$this->getRequest()->getPost('REQUEST');
			if($request=='search') {
				$this->_page=1;
				$this->_sqlParam=$this->getPostValue($params);
			}
			if($request=='export') {
				$lib=new Applibrary_XlsUrlHelper;
				$srchParams=$this->getRequest()->getPost('params');
				$auParams=$pagiObj->createArrAndUrlParams($srchParams);
				$this->_sqlParam=$auParams['array_params'];
				$this->_xmlForm->setSqlParams($this->_sqlParam);
				$this->_session->data=$this->_sqlParam;
				$sqlBundle=$this->_xmlForm->getXmlResultSqlBundle($srchParams,$order,$limit);
				$this->view->xlsResults= $lib->createSqlXlsUrlOnResult($sqlBundle, '/dbd/index/commonexport/'.$auParams['url_params'], $this->_exportFileName,
				$auParams['array_params']);
				unset($lib);}
		}
		else $this->_sqlParam=$this->getParamValue($params);
		$check=$this->isExistParams();
		if($check==true) {
			$this->view->srch=1;
		}
		$this->_xmlForm->createFormTable();
		$this->view->form=$this->_xmlForm->getForm();
		$this->_paginationLimits=$this->_pagination->getRowLimitsForPagination($this->_page);
		$this->_xmlForm->sqlFetchLimit($this->_paginationLimits);
		$this->_xmlForm->setSqlParams($this->_sqlParam);
		$this->view->xlsExportForm=$this->_xmlForm->getXlsExportForm($this->_sqlParam);
		$this->view->paginator=$this->_xmlForm->getSqlResult($this->_page,$search,$order,$limit);
		//print_r($this->view->paginator);
		$this->view->tableHeader=$this->_xmlForm->getSqlResultTableHeader();
		$this->view->pagiParams=$pagiObj->createArrAndUrlParams($this->_sqlParam);
		$labels=$this->_xmlForm->getActiveFormLabels();
		$this->view->slabels=$this->organizeForParams($labels);
		$this->view->sparams=$this->organizeForParams($this->_sqlParam);
		$this->view->sumColumns=$this->_xmlForm->getSumColumns();
		$this->view->tableFormatInfo=$this->_xmlForm->getTableFormatInfo();
		$this->view->tableFormatValueInfo=$this->_xmlForm->getTableFormatValueInfo();
		//print_r($this->view->tableFormatInfo);
	//	print_r($this->view->tableFormatValueInfo);
		$this->_tableSetExternal=$this->_xmlForm->isTableSetExternal();
		$this->checkAndSetExternalFormat();
		$this->view->windowData=$this->_xmlForm->getWindowData();
		$this->view->footerSqlResult= $this->_xmlForm->_getFooterSql($this->view->sparams);
		//$session=Zend_Registry::get('SQL');
	//	print_r($this->view->sparams); 

		unset($pagiObj,$this->_xmlForm,$this->_pagination);
	}

	public function checkAndSetExternalFormat()
	{
		if($this->_tableSetExternal){
			$obj=new $this->_tableSetExternal['class'];
			$func=$this->_tableSetExternal['function'];
			$this->_htmlTableFormat=$obj->$func();
		}
		$this->_htmlTableFormat['labels']=$this->view->tableFormatInfo;
		$this->_htmlTableFormat['values']=$this->view->tableFormatValueInfo;
		$this->view->tableFormatInfo=$this->_htmlTableFormat;
	}

	public function isExistParams()
	{
		foreach( $this->_sqlParam as $val)
			if($val) return true;
		return false;
	}

	public function organizeForParams($arr=null)
	{
		$i=1;
		$array=array();
		if($arr)
		foreach($arr as $value){
			$array=array_merge($array,array('param'.$i=>$value));
			$i++;
		}
		return $array;
	}

	public function setBasicFrameParams($data)
	{
		$this->_model=$data['model'];
		$this->_function=$data['function'];
		$this->_filePrefix=$data['filePrefix'];
		$this->_exportFileName=$data['viewFileName'];
	}

	public function getPostValue($params)
	{
		$sqlParam=array();
		//print_r($params);
		//echo "<br>----------------------------------<br>";
//		$params=$obj->getSearchParamList();
		foreach($params as $param){
			$value=trim($this->getRequest()->getPost("$param"));
			$this->_xmlForm->setFormElementValue($param,$value);
			array_push($sqlParam,$value);
		}

		//$arr=$this->_xmlForm->getFormElementValue();
		//print_r($arr);
		return $sqlParam;
	}

	public function getParamValue($params)
	{
		$sqlParam=array();
	//	$params=$obj->getSearchParamList();
		$count=count($params);
		for($i=1;$i<=$count;$i++){
			$value=$this->_request->getParam("param".$i);
			array_push($sqlParam,$value);
		}
		return $sqlParam;
	}

	public function getPosts()
	{
		$values=$this->getRequest()->getPost();
		foreach($values as $key=>$value){
			$values[$key]=trim($value);
		}
		return $values;
	}

/*
	public function generateNullSetParams(&$sqlParam,&$params)
	{
		$total=count($params);
		$sqlParam=array();
		for($i=0;$i<$total;$i++)
			array_push($sqlParam,null);
	} */
}

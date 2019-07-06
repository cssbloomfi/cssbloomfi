<?php
require_once('library/thirdParty/utilityFunctions.php');
class Adm_FinyearController extends modules_adm_controllers_AdminController
{
        protected $_exportFileName='finyear';

	function preDispatch(){
		$this->prepare();
		$this->view->images=$this->_session->images;
	}
        
        function indexAction()
        {
                $message=new modules_adm_messages_message;
		  $this->view->messages=$message->getFinYearCreationMessages('common');
		  $this->msg=$message->getFinYearCreationMessages('common');
		  $this->view->title = $this->msg['title'];
		  $url=$startDt=$endDt=$result=$successResult=$errorResult=$curPage=$this->view->srch=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getFinYearFormLabels('search');
		  $this->getPage();
		  $this->prepareActionPage();
		
		  if($this->_session->state==1 &&  $this->_session->controller=='finyear') {
			$this->_session->state=0;
			$data_bundle=$this->_admModel->executeSessionSQL($this->_session->sql,"Fin year Info");
			$result=$data_bundle['result'];
			$count=$this->_session->counter;
			$url=$this->_session->indexUrl;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$curPage=1;
						$startDt=trim($this->getRequest()->getPost('param1',null));
						$endDt=trim($this->getRequest()->getPost('param2',null));
						$data=array($startDt,$endDt);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete"){
						$ids=$this->getRequest()->getPost('finid');

					foreach($ids as $id){
							$chk=$this->_admModel->checkActiveFinYear($id);
							if(!$chk){
							$status=$this->_admModel->deleteFinYearInfoDML($id);
							if($status)
								$successResult[$id]="Financial Period information deleted successfully.";
							}else
							$errorResult[$id]="Active Financial Period cannot be deleted.";
						}
						
						$sparams=trim($this->getRequest()->getPost('params'));
						if(!empty($sparams)){
							$params=explode('/',$sparams);
							if(isset($params[0]))$startDt=$params[0];
							if(isset($params[1])) $endDt=$params[1];
							$this->view->srch=1;
						}
						$data=array($startDt,$endDt);
						//print_r($data);
						
						$this->view->textSuccess=$successResult;
						$this->view->textErrors=$errorResult; 
					}
					if($request=='FinYearActivation'){
						$id=$this->getRequest()->getPost('id');
						$deact=$this->_admModel->deactivateAllFinancialYear();
						$stat=$this->_admModel->activateFinancialYear($id);
						if(!$stat)
						{
							$successResult[$id]="Selected Financial period activated successfully.";
							$this->view->textSuccess=$successResult;
						}
						
						$sparams=trim($this->getRequest()->getPost('params'));
						
						if(!empty($sparams)){
							$params=explode('/',$sparams);
							if(isset($params[0]))$startDt=$params[0];
							if(isset($params[1])) $endDt=$params[1];
							$this->view->srch=1;
						}
						
						
						$data=array($startDt,$endDt);
					}
					
					if($request!="Delete" && $request!="Search" && $request!="FinYearActivation"){
						$pagiObj=new BinaryBl_PagiantionArrAndUrlParams;
						$lib=new Applibrary_XlsUrlHelper;
						$table=$this->__getIndexTableHeaders();
						$srchParams=$this->getRequest()->getPost('arrayparams');
						if($this->getRequest()->getPost('search')==1) $this->view->srch=1;
						$auParams=$pagiObj->createArrAndUrlParams($srchParams);
						$this->_setExportSessionDatas('getFinYearInfoOnSrchQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName,
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					//print_r($data);
					$result=$this->prepareData('getFinYearInfoOnSrchQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$uid=$this->_request->getParam('param1');
						$this->view->srch=1;
					}
					$data=array($startDt,$endDt);
					$result=$this->prepareData('getFinYearInfoOnSrchQuery',$data);
					$url=$this->_admModel->getCurrentUrlBase();
			  }
		}
		$auParams=$par->createArrAndUrlParams($data);
		$this->view->searchparams=$auParams['url_params'];
		$this->view->arrayparams=$auParams['string_params'];
		$this->view->paginationparams=$auParams['pagination_params'];
		$url=$this->_admModel->getCurrentUrlLevel(true,true,true);
		if($this->view->srch) $url=$url.'/search/1/'.$auParams['url_params'];
		$this->__setViewFormParams($data);
		$this->setPrepareData($result,$url,$session);
		ob_flush();
		flush();
	}
	
	
	function addfinyearAction()
	{
		$data=$params=$stYear=$stMnth=$stDay=$endYear=$endMnth=$endDay=$check=$strt_date=$end_date=null;
		$message=new modules_adm_messages_message;
		$this->msg=$message->getFinYearCreationMessages('addFinYear');
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='finyear';
		$this->view->title = $this->msg['addTitle'];
		$this->view->messages=$message->getFinYearCreationMessages('addFinYear');
		$this->view->title = 'Financial Year';
		$this->view->labels=$this->_labels->getFinYearFormLabels('addForm');
		//$params=array($strtYr,$endYr);
		if ( $this->getRequest()->isPost() )
		{
			$strt_date = trim($this->getRequest()->getPost("startDate"));
			$end_date= trim($this->getRequest()->getPost("endDate"));
			$desc=trim($this->getRequest()->getPost("desc"));
			
			$stDt= explode('-',$strt_date);
			$endDt=explode('-',$end_date);

			//print_r($stDt);
			//print_r($endDt);
			//die;
			$params=array($strt_date,$end_date,$desc);
			$check=$this->__checkValues($params);
			if(!$check){
				//print_r($data);
				$data=array_merge(array_reverse($stDt),array_reverse($endDt));
				array_push($data,$desc);
				$status=$this->_admModel->insertFinYearInfoDML($data);
				if($status){
					$this->view->textSuccess="Financial year information inserted successfully.";
					$params=null;
				}
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		$this->__setViewFormParams($params);
	}
	
	
	function editfinyearAction()
	{
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='finyear';
		$message=new modules_adm_messages_message;
		
		$this->msg=$message->getFinYearCreationMessages('editFinYear');
		$this->view->title = $this->msg['editTitle'];
		$check=$params=$user_nm=$user_id=$user_pwd=$user_re_pwd=$type=$updated_by=$id=null;
		$this->view->messages=$message->getFinYearCreationMessages('editFinYear');
		$this->msg=$message->getFinYearCreationMessages('editFinYear');
		$this->view->labels=$this->_labels->getFinYearFormLabels('addForm');
		if ( $this->getRequest()->isPost() )
		{
			$strt_date = trim($this->getRequest()->getPost("startDate"));
			$end_date= trim($this->getRequest()->getPost("endDate"));
			$desc= trim($this->getRequest()->getPost("desc"));
			$id=trim($this->getRequest()->getPost("id"));
			$stDt= explode('-',$strt_date);
			$endDt=explode('-',$end_date);

			//print_r($stDt);
			//print_r($endDt);
			//die;
			$params=array($strt_date,$end_date,$desc,$id);
			$check=$this->__checkValues($params,$option='edit');
			if(!$check){
				//print_r($data);
				$arr=array_merge(array_reverse($stDt),array_reverse($endDt));
				$arr=array_merge($arr,array($desc,$id));
				//print_r($arr);
				//die;
				$status=$this->_admModel->
				updateFinYearInfoDML($arr);
				if($status){
					$this->view->textSuccess="Financial year information updated successfully.";
					$this->view->url=$this->_session->indexUrl;
					$params=null;
				}
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		else{
			$id=$this->_request->getParam('id');
			$data=$this->_admModel->getFinYearInfoById($id);
			if($data){
				$params=array($data->START_DATE,$data->END_DATE,$data->DESCRIPTION,$data->ID);
			}
		}
		$this->__setViewFormParams($params);
		//$this->view->url = $this->_admModel->getBaseURL()."/adm/usercreation";
	}
       
       
       
        private function __setViewFormParams($data)
	{
		$this->view->param=$data;
	}
	
	private function __checkValues(&$data,$option='add')
	{
		$check=null;
		$model=new modules_adm_models_admAccessQuery;
		$element=new Bloomfi_App_UHtmlElement;
		
		if(isset($data[0]))
			$startDt=$data[0];
		if(isset($data[1]))
			$endDate=$data[1];
		if(isset($data[2]))
			$descrip=$data[2];
		if(isset($data[3]))
			$id=$data[3]; 
		
		$msg=$element->checkElementDate($this->view->labels['strtDt'],$startDt);
		if($msg)$check['Start Date']=$msg;
		
		$msg=$element->checkElementDate($this->view->labels['endDt'],$endDate);
		if($msg)$check['End Date']=$msg;
		
		$msg=$element->checkElement($this->view->labels['desc'],$descrip,100,3);
		if($msg)$check['Description']=$msg;
		
		if(!$check){
			$diff=dateDifference($startDt,$endDate);
			if(!$diff)$check['End Date']='Please correct the End data';
		}
		
		if($option=='edit'){
			$val=$model->isExistFinYearExceptMeQuery(array($startDt,$endDate,$id));
		}else{
			$val=$model->isExistFinYearQuery(array($startDt,$endDate));
		}
		if($val)
		$check['Date Exist']="Financial period already exists.";
		
		return $check;
	}
	
	function setupSessionData($sqlName)
	{
		$this->_session->state=0;
		$this->_bundle=$this->_admModel->executeSessionSQL($this->_session->sql,$sqlName);
		$this->_count=$this->_session->counter;
		$this->_url=$this->_session->indexUrl;
	}

	
	
	function _getUser()
	{
		$auth = Zend_Auth::getInstance();
		$user=$auth->getIdentity();
		return $user->USER_ID;
	}
       
       
       
        
}
?>
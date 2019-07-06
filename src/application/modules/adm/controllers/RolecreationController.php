<?php
class Adm_RolecreationController extends modules_adm_controllers_AdminController
{
	protected $_messages=null;
	protected $_exportFileName='Application_Role';
	protected $_msgs=null;

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
		  $message=new modules_adm_messages_message;
		  $this->view->messages=$message->getAdmRoleCreationMessages('common');
		  $msg=$message->getAdmUserCreationMessages('common');
		  $this->view->title = $this->view->messages['title'];
		  $url=$roleId=$result=$this->view->srch=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getRoleCreationLabels('search');
		  $this->getPage();
		  $this->prepareActionPage();
		  if($this->_session->state==1 &&  $this->_session->controller=='rolecreation') {
			  $this->setupSessionData("Role Info");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$roleId=$this->getRequest()->getPost('param1',null);
						$data=array($roleId);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete")
					{
						$roles=$this->getRequest()->getPost('role');

						foreach($roles as $roleid){
							$status1=$this->_admModel->deleteRoleInfoDML($roleid);
							$status2=$this->_admModel->deleteRoleMenuInfoDML($roleid);
							$status3=$this->_admModel->deleteAllComponentOnRoleDML($roleid);
							if($status1 && $status2 && $status3){
								$delMsg=str_replace('@VAR1@',$roleid,$this->view->messages['deleted']);
								$successResult[$roleid]=$delMsg;
							}
						}
						if($this->_request->getParam('search')==1){
							$roleId=$this->_request->getParam('param1');
							$this->view->srch=1;
						}
						$data=array($roleId);
						$this->view->textSuccess=$successResult;
					}
					if($request!="Delete" && $request!="Search")
					{
						$pagiObj=new BinaryBl_PagiantionArrAndUrlParams;
						$lib=new Applibrary_XlsUrlHelper;
						$table=$this->__getIndexTableHeaders();
						$srchParams=$this->getRequest()->getPost('arrayparams');
						if($this->getRequest()->getPost('search')==1) $this->view->srch=1;
						$auParams=$pagiObj->createArrAndUrlParams($srchParams);
						$this->_setExportSessionDatas('getAllRoleInfoOnSrchQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName,
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					$result=$this->prepareData('getAllRoleInfoOnSrchQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$uid=$this->_request->getParam('param1');
						$this->view->srch=1;
					}
					$data=array($roleId);
					$result=$this->prepareData('getAllRoleInfoOnSrchQuery',$data);
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

	function addroleAction()
	{
		$data=$params=$created_by=$roleId=$roleType=$roleDesc=$check=null;
		$this->view->url=$this->_session->indexUrl;
		$message=new modules_adm_messages_message;
		$this->_msgs=$this->view->messages=$message->getAdmRoleCreationMessages('addRole');
		$this->_session->controller='usercreation';
		$this->view->title = $this->_msgs['title'];
		$message=new modules_adm_messages_message;
		$this->_msgs=$this->view->messages=$message->getAdmRoleCreationMessages('addRole');
		$this->view->labels=$this->_labels->getRoleCreationLabels('roleForm');
		if ( $this->getRequest()->isPost() )
		{
			$roleId = $this->getRequest()->getPost("param1");
			$roleType = $this->getRequest()->getPost("param2");
			$roleDesc = $this->getRequest()->getPost("param3");
			$created_by = $this->_getUser();
			$params=array($roleId,$roleType,$roleDesc);
			$check=$this->__checkValues($params);
			if(!$check){
				$data=array($roleId,$roleType,$roleDesc,$created_by);
				$status=$this->_admModel->insertRoleInfoDML($data);
				if($status)
					$this->view->textSuccess=str_replace('@VAR1@',$roleId,$this->view->messages['createSuccess']);
					$params=null;
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		$this->__setViewFormParams($params);
	}

	function editroleAction()
	{
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='rolecreation';
		$this->view->title = "Role edit page";
		$check=$params=$roleId=$roleType=$roleDesc=$id=$updated_by=$id=null;
		$message=new modules_adm_messages_message;
		$this->_msgs=$this->view->messages=$message->getAdmRoleCreationMessages('editRole');
		$this->view->labels=$this->_labels->getRoleCreationLabels('roleForm');
		if ( $this->getRequest()->isPost() )
		{
			$roleId = $this->getRequest()->getPost("param1");
			$roleType = $this->getRequest()->getPost("param2");
			$roleDesc = $this->getRequest()->getPost("param3");
			$id = $this->getRequest()->getPost("param4");
			$updated_by = $this->_getUser();
			$params=array($roleId,$roleType,$roleDesc,$id);
			$check=$this->__checkValues($params,'edit');
			if(!$check){
				$this->_admModel->startTransaction();
				$roleInfo=$this->_admModel->getRoleInfoOnIdQuery($id);
				$data=array($roleId,$roleDesc,$roleType,$updated_by,$id);
				$status1=$this->_admModel->updateRoleInfoDML($data);
				$status2=$this->_admModel->updateRoleIdInResJoinDML(array($roleId,$roleInfo->ACCESS_ROLE_ID));
				$status3=$this->_admModel->updateComponentsRoleIdDML(array($roleId,$roleInfo->ACCESS_ROLE_ID));
				$status4=$this->_admModel->updateRoleIdInUserJoinDML(array($roleId,$roleInfo->ACCESS_ROLE_ID));
				if($status1 && $status2){
					$this->_admModel->commitTransaction();
					$this->view->textSuccess = str_replace('@VAR1@',$roleId,$this->view->messages['updateSuccess']);
				}
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		else{
			$id=$this->_request->getParam('id');
			$data=$this->_admModel->getRoleInfoByIdQuery($id);
			if($data){
				$roleId=$data->ACCESS_ROLE_ID;
				$roleType=$data->ACCESS_ROLE_TYPE;
				$roleDesc=$data->ACCESS_ROLE_DESC;
			}
		}
		$params=array($roleId,$roleType,$roleDesc,$id);
		$this->__setViewFormParams($params);
		$this->view->url = $this->_admModel->getBaseURL()."/adm/rolecreation";
	}

	private function __getIndexTableHeaders()
	{
		$table['headers']= array(  $this->view->labels['roleId'], $this->view->labels['roleType'], $this->view->labels['roleDesc'],$this->view->labels['createdBy']);
		$table['columns']=array('ACCESS_ROLE_ID','ACCESS_ROLE_TYPE','ACCESS_ROLE_DESC','CREATED_BY');
		return $table;
	}

	private function __setViewFormParams($data)
	{
		$this->view->param=$data;
	}

	private function __checkValues(&$data,$option='add')
	{
		$check=null;
		$element=new Bloomfi_App_UHtmlElement;
		$msg=$element->checkElement($this->view->labels['roleId'],$data[0],50,2);
				if($msg)$check['roleId']=$msg;
		$msg=$element->checkElement($this->view->labels['roleType'],$data[1],50,2);
				if($msg)$check['roleType']=$msg;
		$msg=$element->checkElement($this->view->labels['roleDesc'],$data[2],50,6);
				if($msg)$check['roleDesc']=$msg;
		if(!$check) $check=$this->_dbCheck($data,$option);
		return $check;
	}

	private function _dbCheck($data,$option)
	{
		$check=$result=null;
		$roleId=$data[0];
		if($option=='add'){
			$result=$this->_admModel->isExistRoleIdQuery($roleId);
		}else{
			$id=$data[3];
			$result=$this->_admModel->isExistRoleIdExceptMeQuery(array($roleId,$id));
		}
		if($result) $check['roleExist']=str_replace('@VAR1@',$roleId,$this->_msgs['roleExist']);
		return $check;
	}
}
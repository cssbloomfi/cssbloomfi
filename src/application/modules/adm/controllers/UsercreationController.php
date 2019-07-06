<?php
class Adm_UsercreationController extends modules_adm_controllers_AdminController
{
	protected $_messages=null;
	protected $_exportFileName='ApplicationUser';

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
		  $message=new modules_adm_messages_message;
		  $this->view->messages=$message->getAdmUserCreationMessages('common');
		  $this->msg=$message->getAdmUserCreationMessages('common');
		  $this->view->title = $this->msg['title'];
		  $url=$uid=$result=$successResult=$this->view->srch=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getUserCreationLabels('search');
		  $this->getPage();
		  $this->prepareActionPage();
		  if($this->_session->state==1 &&  $this->_session->controller=='usercreation') {
			  $this->setupSessionData("User Info");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$uid=$this->getRequest()->getPost('param1',null);
						$data=array($uid);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete")
					{
						$user=$this->getRequest()->getPost('appuserid');

						foreach($user as $userid){
							$status=$this->_admModel->deleteUserInfoDML($userid);
							if($status){
								$delMsg=str_replace('@VAR1@',$userid,$this->msg['deleted']);
								$successResult[$userid]=$delMsg;
							}
						}
						if($this->_request->getParam('search')==1){
							$uid=$this->_request->getParam('param1');
							$this->view->srch=1;
						}
						$data=array($uid);
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
						$this->_setExportSessionDatas('getUserOnSrchQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName,
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					$result=$this->prepareData('getUserOnSrchQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$uid=$this->_request->getParam('param1');
						$this->view->srch=1;
					}
					$data=array($uid);
					$result=$this->prepareData('getUserOnSrchQuery',$data);
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

	function addappuserAction()
	{
		$data=$params=$user_nm=$user_id=$user_pwd=$user_re_pwd=$type=$check=null;
	    $message=new modules_adm_messages_message;
	    $this->msg=$message->getAdmUserCreationMessages('addUser');
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='usercreation';
		$this->view->title = $this->msg['addTitle'];
		$this->view->messages=$message->getAdmUserCreationMessages('addUser');
		$this->view->labels=$this->_labels->getUserCreationLabels('userForm');
		$params=array($user_nm,$user_id,$user_pwd,$user_re_pwd,$type);
		if ( $this->getRequest()->isPost() )
		{
			$user_nm = $this->getRequest()->getPost("unm");
			$user_id = $this->getRequest()->getPost("uid");
			$user_pwd = $this->getRequest()->getPost("pwd");
			$user_re_pwd = $this->getRequest()->getPost("repwd");
			$type = $this->getRequest()->getPost("type");
			$created_by = $this->_getUser();
			$params=array($user_nm,$user_id,$user_pwd,$user_re_pwd,$type);
			$check=$this->__checkValues($params);
			if(!$check){
				$data=array($user_nm,$user_id,$user_pwd,$type,$created_by);
				$status=$this->_admModel->insertUserInfoDML($data);
				if($status){
					$this->view->textSuccess=str_replace('@VAR1@',$user_id,$this->view->messages['createSuccess']);
					$params=null;
				}
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		$this->__setViewFormParams($params);
	}

	function editappuserAction()
	{
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='usercreation';
		$message=new modules_adm_messages_message;
		$this->msg=$message->getAdmUserCreationMessages('editUser');
		$this->view->title = $this->msg['editTitle'];
		$check=$params=$user_nm=$user_id=$user_pwd=$user_re_pwd=$type=$updated_by=$id=null;
		$this->view->messages=$message->getAdmUserCreationMessages('editUser');
		$this->msg=$message->getAdmUserCreationMessages('editUser');
		$this->view->labels=$this->_labels->getUserCreationLabels('userForm');
		if ( $this->getRequest()->isPost() )
		{
			$user_nm = $this->getRequest()->getPost("unm");
			$user_id = $this->getRequest()->getPost("uid");
			$user_pwd = $this->getRequest()->getPost("pwd");
			$user_re_pwd = $this->getRequest()->getPost("repwd");
			$type = $this->getRequest()->getPost("type");
			$id = $this->getRequest()->getPost("id");
			$updated_by = $this->_getUser();
			$params=array($user_nm,$user_id,$user_pwd,$user_re_pwd,$type,$id);
			$check=$this->__checkValues($params,'edit');
			if(!$check){
				$data=array($user_nm,$user_id,$user_pwd,$type,$updated_by,$id);
				$status1=$this->_admModel->updateUserIdForRole(array($user_id,$id));
				$status=$this->_admModel->updateUserInfoDML($data);
				if($status && $status1)
					$this->view->textSuccess=str_replace('@VAR1@',$user_id,$this->view->messages['updateSuccess']);
			}
			else{
				$this->view->textErrors = $check;
			}
		}
		else{
			$id=$this->_request->getParam('id');
			$data=$this->_admModel->getUserInfoByIdQuery($id);
			if($data){
				$user_nm=$data->USER_NAME;
				$user_id=$data->USER_ID;
				$user_pwd=$user_re_pwd=$data->USER_PASSWORD;
				$type=$data->USER_TYPE;
			}
		}
		$params=array($user_nm,$user_id,$user_pwd,$user_re_pwd,$id,$type);
		$this->__setViewFormParams($params);
		$this->view->url = $this->_admModel->getBaseURL()."/adm/usercreation";
	}

	private function __getIndexTableHeaders()
	{
		$table['headers']= array(  $this->view->labels['userId'], $this->view->labels['userName'], $this->view->labels['userType'],$this->view->labels['creationDate']);
		$table['columns']=array('USER_ID','USER_NAME','USER_TYPE','CREATION_DATE');
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
		$msg=$element->checkElement($this->view->labels['userName'],$data[0],50,2);
				if($msg)$check['user_name']=$msg;
		$msg=$element->checkElement($this->view->labels['userId'],$data[1],50,2);
				if($msg)$check['user_id']=$msg;
		$msg=$element->checkElement($this->view->labels['password'],$data[2],50,6);
				if($msg)$check['password']=$msg;
		$msg=$element->checkElement($this->view->labels['repassword'],$data[3],50,6);
			if($msg)$check['re_password']=$msg;
		if(!isset($check['password']))
		if($data[2]!=$data[3]){
			$check['password'] = $this->view->messages['pwdNotMatched'];
			$data[2]=$data[3]=null;
		}
		$msg=$element->checkElement($this->view->labels['userType'],$data[4],50,4);
			if($msg)$check['type']=$msg;
		if(!$check)
			$check=$this->_checkDb($data,$option);
		return $check;
	}

	private function _checkDb($data,$option)
	{
		$check=null;
		if($option=='add'){
			$result=$this->_admModel->isExistUserIdQuery($data[1]);
			if($result)
				$check['userid']=str_replace('@VAR1@',$data[1],$this->view->messages['userExist']);
		}else{
			$result=$this->_admModel->isExistUserIdExceptMeQuery( array($data[1],$data[5]) );
			if($result)
				$check['userid']=str_replace('@VAR1@',$data[1],$this->view->messages['userExist']);
		}
		return $check;
	}
}
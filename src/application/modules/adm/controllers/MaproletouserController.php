<?php
class Adm_MaproletouserController extends modules_adm_controllers_AdminController
{
	protected $_messages=null;
	protected $_exportFileName='UserRole';

	function preDispatch(){
		$this->prepare();
	}

    function indexAction()
    {
		  $message=new modules_adm_messages_message;
		  $this->mapRoleToUserMsg=$message->getAdmMapRoleToUserMessages('mapRoleToUser');
		  $this->view->confirmMsg=$message->getAdmMapRoleToUserMessages('mapRoleToUser');
		  $this->view->title = $this->mapRoleToUserMsg['title'];
		  $url=$uid=$roleid=$result=$params=$this->view->srch=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getMapUserToRoleLabels('search');
		  $element =new Bloomfi_App_UHtmlElement;
		  $this->getPage();
		  $this->prepareActionPage();
		  if($this->_session->state==1 &&  $this->_session->controller=='maproletouser') {
			  $this->setupSessionData("Role Info");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$this->view->param1=$uid=$this->getRequest()->getPost('param1',null);
						$this->view->param2=$roleid=$this->getRequest()->getPost('param2',null);
						$data=array($uid,$roleid);
						$this->view->srch=1;
						$params=$uid.'/'.$roleid;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete")
					{
						$userids=$this->getRequest()->getPost('userid');

						foreach($userids as $userid){
							$status=$this->_admModel->deleteUserRoleOnUserIdInfoDML($userid);
							if($status){
								$msg=str_replace('@VAR1@',$userid,$this->mapRoleToUserMsg['deleted'])
								$successResult[$userid]=$msg;
							}
						}

						if($this->getRequest()->getPost('params')){
							$params=$this->getRequest()->getPost('params');
							$scrhParams=explode('/',$params);
							
							if($scrhParams){
								$i=1;
								foreach($scrhParams as $param){
									$paramNo='param'.$i;
									$this->view->$paramNo=$param;
									$i++;
								}
								$this->view->srch=1;
							}
							
						}
						$data=array($uid,$roleid);
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
						$this->_setExportSessionDatas('getUserRoleOnSrchQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName,
						$auParams['array_params']);
						$data=$auParams['array_params'];
						$params=join('/',$auParams['array_params']);
						unset($lib,$pagiObj);
					}
					$result=$this->prepareData('getUserRoleOnSrchQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$uid=$this->_request->getParam('param1');
						$roleid=$this->_request->getParam('param2');
						$this->view->srch=1;
						$params=$uid.'/'.$roleid;
					}
					$data=array($uid,$roleid);
					$result=$this->prepareData('getUserRoleOnSrchQuery',$data);
					$url=$this->_admModel->getCurrentUrlBase();
			  }
		}
		$this->view->params=$params;
		$auParams=$par->createArrAndUrlParams($params);
		$this->view->searchparams=$auParams['url_params'];
		$this->view->arrayparams=$auParams['string_params'];
		$this->view->paginationparams=$auParams['pagination_params'];
		$url=$this->_admModel->getCurrentUrlLevel(true,true,true);
		if($this->view->srch) $url=$url.'/search/1/'.$auParams['url_params'];
		$this->__setViewFormParams($data);
		$this->setPrepareData($result,$url,$session);
		$roles=$this->_admModel->getAllRolesQuery();
		$this->view->roles=$element->createSelectDb("param2",$roles,'ACCESS_ROLE_ID','ACCESS_ROLE_ID', $roleid ,'NOT',null,' width=15');
		ob_flush();
		flush();
	}

	function mapuserroleAction()
	{
		$message=new modules_adm_messages_message;
		$this->mapUserRoleMsg=$message->getAdmMapRoleToUserMessages('mapRoleToUser');
		$data=$params=$user_nm=$user_id=$user_pwd=$user_re_pwd=$check=$userInfo=$userRoles=null;
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='maproletouser';
		$this->view->title = $this->mapUserRoleMsg['mapRoleTitle'];
		
		$this->view->messages=$message->getAdmUserCreationMessages('addUser');
		$this->view->labels=$this->_labels->getMapUserToRoleLabels('mapUserToRole');

		if($this->getRequest()->isPost('param1')) {
			$uid=trim($this->getRequest()->getPost('param1'));
			$userRoles=$this->getRequest()->getPost('roles');

		//	{
				$created_by = $this->_getUser();
				if($uid!=$created_by) {
				$userInfo=$this->_admModel->getUserInfoByUserIdQuery($uid);
				if($userInfo->USER_ID)
					$result1=$this->_admModel->deleteUserRoleDML($userInfo->USER_ID);
				if($userRoles){
					foreach($this->getRequest()->getPost('roles') as $role) {
						if(!empty($role)) {
						$data=array($role,$userInfo->USER_ID,$created_by);
						$result2=$this->_admModel->insertUserRoleInfoDML($data);
						if($result2==null){
							$this->view->textErrors= $this->mapUserRoleMsg['notInsert'];
							break;
						}else
							{
								$msg=str_replace('@VAR1@',$userInfo->USER_ID,$this->mapUserRoleMsg['success']);
								$this->view->textSuccess= $msg;
							}
						}
						else break;
					}
				  }
				}
				else $this->view->textErrors=array(0=>"'$uid' user can not be modified self role");
		//	}
		}

		if($this->_request->getParam('mapid')){
			$mapId = $this->_request->getParam('mapid');
			if($userInfo)
			if($userInfo->ID!=$mapId )
				$mapId=$userInfo->ID;
			$this->view->result = $this->_admModel->getUsrRoleInfoByMapIdQuery($mapId);
			$this->view->userId = $mapId;
		}

	//	$this->__setViewFormParams($params);
		$this->view->roles = $this->_admModel->getAllRolesQuery();
	}


	private function __getIndexTableHeaders()
	{
		$table['headers']= array(  $this->view->labels['userId'], $this->view->labels['roleId'],$this->view->labels['roleDesc'], $this->view->labels['userName'], $this->view->labels['userType'],$this->view->labels['roleType']);
		$table['columns']=array('USER_ID', 'ACCESS_ROLE_ID', 'ACCESS_ROLE_DESC','USER_NAME','USER_TYPE','ACCESS_ROLE_TYPE');
		return $table;
	}

	private function __setViewFormParams($data)
	{
		$this->view->param=$data;
	}

	private function __checkValues(&$data)
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
		return $check;
	}
}
<?php
class Adm_MapmenutoroleController extends modules_adm_controllers_AdminController 
{
	protected $_messages=null;
	protected $_exportFileName='RoleMenu';

	function preDispatch(){
		$this->prepare();
		$this->view->images=$this->_session->images;
	}

    function indexAction()
    {
		  $msgModel= new modules_adm_messages_message;
		  $this->menuToRoleMessages=$msgModel->getAdmMapMenuToRoleMessages('mapMenuToRole');
		  $this->view->confirmMsg=$msgModel->getAdmMapMenuToRoleMessages('mapRoleMenu');
		  $this->view->title = $this->menuToRoleMessages['title'];
		  $url=$roleId=$resName=$result=$this->view->srch=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getMapMenuToRoleLabels('search');
		  $element =new Bloomfi_App_UHtmlElement;
		  $this->getPage();
		  $this->prepareActionPage();
		  if($this->_session->state==1 &&  $this->_session->controller=='mapusertorole') {	
			  $this->setupSessionData("Role's Menu Info");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$resName=trim($this->getRequest()->getPost('param1',null));
						$roleId=trim($this->getRequest()->getPost('param2',null));
						$data=array($resName,$roleId);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete")
					{
						$roles=$this->getRequest()->getPost('role');

						foreach($roles as $role){
							$status=$this->_admModel->deleteRoleMenuOnRoleIdInfoDML($role);
							if($status){
								$msg=str_replace('@VAR1@',$role, $this->menuToRoleMessages['deleted']);
								$successResult[$role]=$msg;
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
						$resName=$this->view->param1;
						$roleId=$this->view->param2;
						$data=array($resName,$roleId);
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
						$this->_setExportSessionDatas('getRoleMenuOnSrchQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName, 
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					$result=$this->prepareData('getRoleMenuOnSrchQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$resName=$this->_request->getParam('param1');
						$roleId=$this->_request->getParam('param2');
						$this->view->srch=1;
					}
					$data=array($resName,$roleId);
					$result=$this->prepareData('getRoleMenuOnSrchQuery',$data);	
					$url=$this->_admModel->getCurrentUrlBase();
			  }
		}
		$auParams=$par->createArrAndUrlParams($data);
		$this->view->params=join('/',$data);
		$this->view->searchparams=$auParams['url_params'];
		$this->view->arrayparams=$auParams['string_params'];
		$this->view->paginationparams=$auParams['pagination_params'];
		$url=$this->_admModel->getCurrentUrlLevel(true,true,true);
		if($this->view->srch) $url=$url.'/search/1/'.$auParams['url_params'];
		$this->__setViewFormParams($data);
		$this->setPrepareData($result,$url,$session);
		$roles=$this->_admModel->getAllRolesQuery();
		$this->view->roles=$element->createSelectDb("param2",$roles,'ACCESS_ROLE_ID','ACCESS_ROLE_ID', $roleId ,'NOT',null,' width=15');
		ob_flush();
		flush();
	}

	function maprolemenuAction()
	{
		$message= new modules_adm_messages_message;
		$this->mapRoleMenuMessages=$message->getAdmMapMenuToRoleMessages('mapRoleMenu');
		$data=$params=$userRole=$roleId=$role=$created_by=null;
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='mapusertorole';
		$this->view->title = $this->mapRoleMenuMessages['roleMap'];
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->messages=$message->getAdmUserCreationMessages('addUser');
		$this->view->labels=$this->_labels->getMapMenuToRoleLabels('mapMenuToRole');

		if($this->getRequest()->isPost('param1')) {
			$roleId=trim($this->getRequest()->getPost('param1'));
			$created_by = $this->_getUser();
			$userRole=$this->_admModel->getRoleFromRolAppResQuery($roleId);
			if($userRole)
				$result1=$this->_admModel->deleteRoleMenuInfoDML($userRole->ROLE_ID);
			if($this->getRequest()->getPost('menus')){
				$userMenus=$this->getRequest()->getPost('menus');
				foreach($userMenus as $menu) {
					if(!empty($menu)) {
					$data=array($roleId,$menu,$created_by);
					$result2=$this->_admModel->insertMenuRoleInfoDML($data);
					if($result2==null){
						echo $this->mapRoleMenuMessages['notInsert'];
						break;
					}else{
							$msg=str_replace('@VAR1@',$roleId,$this->mapRoleMenuMessages['insert']);
						$this->view->textSuccess=$msg;	
					}}
					else break;
				}
			}
		}

		if($this->_request->getParam('mapid')){
			$mapId = $this->_request->getParam('mapid');
			if($userRole)
				if($userRole->ROLE_ID!=$mapId )
					$mapId=$userRole->ROLE_ID;
			$this->view->result = $this->_admModel->getRoleMenuInfoByMapIdQuery($mapId);
			$roleId = $mapId;
		}

	//	$this->__setViewFormParams($params);
		$model= new AccessQuery;
		$menu=$model->getAllMenuResourceQuery();
		$menuObj=new BinaryBl_Menu_Tree;
		$this->view->resources=$menuObj->buildMenu($menu);
		//$this->view->resources = $this->_admModel->getAllResourceMenuQuery();
		$roles=$this->_admModel->getAllRolesQuery();
		$this->view->roles=$element->createSelectDb("param1",$roles,'ACCESS_ROLE_ID','ACCESS_ROLE_ID', $roleId ,'NOT',null,' width=15');
		ob_flush();
		flush();
	}


	private function __getIndexTableHeaders()
	{
		$table['headers']= array(  $this->view->labels['roleId'], $this->view->labels['resourceName'],$this->view->labels['createdBy']);
		$table['columns']=array('ACCESS_ROLE_ID', 'RESOURCE_NAME','CREATED_BY');
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
<?php
class Adm_CompaccessController extends modules_adm_controllers_AdminController 
{
	protected $_exportFileName='compaccess';

	function preDispatch(){
		$this->prepare();
		$this->view->images=$this->_session->images;
	}

    function indexAction()
    {
		$model=new modules_adm_labels_label;
		$this->title=$model->getMapGroupToRoleLabels('title');
		$this->view->title = $this->title['indexTitle'];
		  $url=$roleId=$roleid=$result=$this->view->srch=$data=$scrnPos=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;

		  $this->view->labels=$this->_labels->getMapMenuToRoleLabels('search');
		  $element =new Bloomfi_App_UHtmlElement;
		  $this->getPage();
		  $this->prepareActionPage();
		  if($this->_session->state==1 &&  $this->_session->controller=='compaccess') {	
			  $this->setupSessionData("Component Access");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$roleid=trim($this->getRequest()->getPost('param1',null));
						$data=array($roleid);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request=="Delete")
					{
					}
					if($request!="Delete" && $request!="Search")
					{
						$pagiObj=new BinaryBl_PagiantionArrAndUrlParams;
						$lib=new Applibrary_XlsUrlHelper;
						$table=$this->__getIndexTableHeaders();
						$srchParams=$this->getRequest()->getPost('arrayparams');
						if($this->getRequest()->getPost('search')==1) $this->view->srch=1;
						$auParams=$pagiObj->createArrAndUrlParams($srchParams);
					//	print_r($auParams);
					//	die;
						$this->_setExportSessionDatas('getAllComponentGroupQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName, 
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					//print_r($data);
					$result=$this->prepareData('getAllComponentGroupQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$roleid=$this->_request->getParam('param1');
						$this->view->srch=1;
					}
					$data=array($roleid);
					$result=$this->prepareData('getAllComponentGroupQuery',$data);	
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
		$roles=$this->_admModel->getAllRolesQuery();
		$this->view->mapGroupToRoles=$model->getMapGroupToRoleLabels('mapGroupToRoles');
	    $this->view->roles=$element->createSelectDb("param1",$roles,'ACCESS_ROLE_ID','ACCESS_ROLE_ID', $roleid ,'NOT',null,' width=15');
		ob_flush();
		flush();
	}

	function entryAction()
    {
	  $roleid=$check=$id=$gid=$data=null;
	  ob_start();
	  $msgModel=new modules_adm_messages_message;
	  $this->compAccessMsg=$msgModel->getCompaccessMessages('compaccess');
      $this->view->title = $this->compAccessMsg['title'];
	  $element =new Bloomfi_App_UHtmlElement;
	  $this->view->components=$this->_admModel->getAllComponentGroupListQuery();
	  $this->view->roles=$this->_admModel->getAllRolesQuery();
	  $model= new modules_adm_labels_label;
      $this->view->entry = $model->getCompAccessEntryLabels('entry');
	  
	 
	 // print_r( $this->view->roles);
	  if( $this->getRequest()->getPost() ){
			$data=$this->getRequest()->getPost();
			//print_r($data);
			//$roleid=$data['role'];
			$check=$this->validate($data);

			if(!$check){
				foreach($this->view->roles as $role){
					$roleid=$role->ACCESS_ROLE_ID;
					foreach($this->view->components as $comp){		$this->_admModel->deleteRoleComponentDML(array($roleid,$comp->COMP_DISPLAY_GROUP_ID));
					}
				}
				
				foreach($data['comp'] as $comp)
				{
					$par=explode('/',$comp);
					$keyName=$par[0].'-role';
					$i=0;
					//die($keyName);
					foreach($data[$keyName] as $roleid)
					{
						$compRoles[$keyName][$i++]=$roleid;
						$result=$this->_admModel->insertComponentAccessDML(array($roleid,$par[0]));
						if($result){
							
							$msg=str_replace(array('@VAR1@','@VAR2@'),array(join(' ',explode('_',$par[0])),$roleid),$this->compAccessMsg['success']);
							$this->view->textSuccess.=$msg.'<br>';
						}
					}
				}
				$data['role']=$compRoles;
			}
			else{
				$this->view->textErrors=$check;
				$compRoles=null;
				foreach($data as $key=>$value){
					$comp=array();
					if( $key!='comp' && $key!='save' ){
						foreach($value as $val) array_push($comp,$val);
						$compRoles[$key]=$comp;
					}
				}
				$data['role']=$compRoles;
			}
	  }else{	
		$gid=$this->_request->getParam('id');
		if($gid)
		{
			$comps=$roles=array();
			$result1=$result=$this->_admModel->getRoleCompGroupInfoQuery();
			//print_r($result);
			$this->view->result=$result;
			$compRoles=null;
			foreach($result as $res){
				if(!empty($res->ASSOC_SCREEN_ID))
					array_push($comps, $res->COMP_DISPLAY_GROUP_ID.'/'.$res->ASSOC_SCREEN_ID.'_'.$res->SCREEN_POSITION);
				$displayId=$res->COMP_DISPLAY_GROUP_ID;
				$roleComName=$displayId.'-role';
				$i=0;
				foreach($result1 as $rolec){
					if($displayId==$rolec->COMP_DISPLAY_GROUP_ID){
						$compRoles[$roleComName][$i++]=$rolec->ACCESS_ROLE_ID;
					}
				}
			}
			$data['comp']=$comps;
			$data['role']=$compRoles;
		}
	  }
	  
	//  $this->view->roles=$element->createSelectDb("role",$roles,'ACCESS_ROLE_ID','ACCESS_ROLE_ID', $roleid ,'NOT',null,' width=15');
	  if(isset($data['comp'])) $this->view->selectedComps=$data['comp'];
	  if(isset($data['role'])) $this->view->selectedRoles=$data['role'];

	  ob_flush();
	  flush();
    }


	function validate($data)
	{
		$error=$role=$comp=null;

		if(isset($data['comp']))$comp=$data['comp'];

		if(!$comp){
			$error['comp']=$this->compAccessMsg['selectComp'];
		}else{
			foreach($comp as $com){
				$par=explode('/',$com);
				$keyName=$par[0].'-role';
				if(!isset($data[$keyName])){
					$name=$this->_admModel->getCompGroupNameOnCompGroupIdQuery($par[0]);
					$msg=str_replace('@VAR1@',$name->DISPLAY_NAME,$this->compAccessMsg['selectRole']);
					$error[$keyName]=$msg;
				}
			}
			
		}
		//$error['test']="Test Error";

		return $error;
	}

	private function __getIndexTableHeaders()
	{
		$table['headers']= array('Role','Group Name','Screen Id','Screen position');
		$table['columns']=array('ACCESS_ROLE_ID', 'COMP_DISPLAY_GROUP_NAME','ASSOC_SCREEN_ID','SCREEN_POSITION');
		return $table;
	}

	private function __setViewFormParams($data)
	{
		$this->view->param=$data;
	}
	
}

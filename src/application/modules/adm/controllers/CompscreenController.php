<?php
class Adm_CompscreenController extends modules_adm_controllers_AdminController 
{
	function preDispatch(){
		$this->prepare();
		$this->view->images=$this->_session->images;
	}

    function indexAction()
    {
		  $msgModel=new modules_adm_messages_message;
		  $this->compScreenMsg=$msgModel->getCompScreenMessages('compScreen');
		  $this->view->title = $this->compScreenMsg['title'];
		  $url=$roleId=$scrnName=$result=$this->view->srch=$data=$scrnPos=$param1=$param2=$param3=null;
		  $session=false;
		  $par= new BinaryBl_PagiantionArrAndUrlParams;
		  $this->view->labels=$this->_labels->getMapMenuToRoleLabels('search');
		  $element =new Bloomfi_App_UHtmlElement;
		  $this->getPage();
		  $this->prepareActionPage();
		  $model=new modules_adm_labels_label;
		  $this->view->compScreenFormLable=$model->getCompScreenFormLabels('searchSection');
		  if($this->_session->state==1 &&  $this->_session->controller=='compscreen') {	
			  $this->setupSessionData("Component Screen");
			  $session=true;
		  }
		  else{
			  if ( $this->getRequest()->isPost())
			  {
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search"){
						$this->setPage(1);
						$param1=trim($this->getRequest()->getPost('param1',null));
						$param2=trim($this->getRequest()->getPost('param2',null));
						$data=array($param1, $param2);
						$this->view->srch=1;
						$url=$this->_admModel->getCurrentUrlBase();
					}
					if($request!="Delete" && $request!="Search")
					{
						$pagiObj=new BinaryBl_PagiantionArrAndUrlParams;
						$lib=new Applibrary_XlsUrlHelper;
						$table=$this->__getIndexTableHeaders();
						$srchParams=$this->getRequest()->getPost('arrayparams');
						if($this->getRequest()->getPost('search')==1) $this->view->srch=1;
						$auParams=$pagiObj->createArrAndUrlParams($srchParams);
						$this->_setExportSessionDatas('getAllScreenInfoQuery',$auParams, $table,$this->_exportFileName);
						$this->view->xlsResults= $lib->createXlsUrlOnResult($this->_admModel, $this->_session->functionName, '/dbd/index/commonexport1', $this->_exportFileName, 
						$auParams['array_params']);
						$data=$auParams['array_params'];
						unset($lib,$pagiObj);
					}
					$result=$this->prepareData('getAllScreenInfoQuery',$data);
			  }
			  else
			  {		if($this->_request->getParam('search')==1){
						$param1=$this->_request->getParam('param1');
						$param2=$this->_request->getParam('param2');
						$this->view->srch=1;
					}
					$data=array($param1,$param2);
					$result=$this->prepareData('getAllScreenInfoQuery',$data);	
					$url=$this->_admModel->getCurrentUrlBase();
			  }
		}
		if($this->_session->messages){
			$this->view->textSuccess=$this->_session->messages;
			$this->_session->messages=null;
		}
		$auParams=$par->createArrAndUrlParams($data);
		$this->view->searchparams=$auParams['url_params'];
		$this->view->arrayparams=$auParams['string_params'];
		$this->view->paginationparams=$auParams['pagination_params'];
		$url=$this->_admModel->getCurrentUrlLevel(true,true,true);
		if($this->view->srch) $url=$url.'/search/1/'.$auParams['url_params'];
		$this->__setViewFormParams($data);
		$this->setPrepareData($result,$url,$session);
		//$screen=$this->_admModel->getAllCompScreenPositionQuery();
		$groupNames=$this->_admModel->getAllCompGroupInfoQuery();
		$appScreens=$this->_admModel->getAllApplicationScreensQuery();
	  $this->view->appScreenId=$element->createSelectDb("param2",$appScreens,'RESOURCE_ID','RESOURCE_NAME', null ,'NOT',null,' width=15');
		ob_flush();
		flush();
	}


	function entryAction()
    {
	  $roleid=$check=$compgrpId=$grpNm=$grpId=$scrnId=$scrnPos=$id=null;

	  ob_start();
	  $msgModel=new modules_adm_messages_message;
	  $this->entryMsg=$msgModel->getCompScreenMessages('entry');
      $this->view->title = $this->entryMsg['title'];
	  $element =new Bloomfi_App_UHtmlElement;
	  $this->view->components=$this->_admModel->getAllComponentNameQuery();
	  $model= new modules_adm_labels_label;
	  $this->view->entry=$model->getCompScreenFormLabels('entry');
	  //print_r( $this->view->components);
	  if( $this->getRequest()->getPost() ){
			$data=$this->getRequest()->getPost();
			//print_r($data);
			$check=$this->validate($data);
			
			$grpNm=strtoupper(trim($data['compgrpNm']));
			$grpId=$this->createComponentGroupId($grpNm);
			if(isset($data['screenId']))$scrnIds=$data['screenId'];
			$scrnPos=$data['screenPos'];
			$this->view->id=$data['id'];

			if(!$check){
				if(empty($data['id'])) {
					foreach($scrnIds as $scrnId){
						$basicInfo=array($grpId,$grpNm,$grpNm,$scrnId,$scrnPos);
						$result=$this->_admModel->insertComponentScreenBasicInfoDML($basicInfo);
					}
				}else{
					$ids=explode(', ',$data['id']);
					$result=$this->_admModel->getCompGroupInfoOnIdQuery($ids[0]);
					$oldgrpId=$result[0]->COMP_DISPLAY_GROUP_ID;
					$this->_admModel->deleteCompGroupCompInfoOngrpIdDML($oldgrpId);
					$this->_admModel->deleteCompGroupGrpIdDML($oldgrpId);
					$i=0;
					foreach($scrnIds as $scrnId){
						$basicInfo=array($grpId,$grpNm,$grpNm,$scrnId,$scrnPos);
						$result=$this->_admModel->insertComponentScreenBasicInfoDML($basicInfo);
					}
					$result=$this->_admModel->updateGroupIdRoleInfoDML(array($grpId,$oldgrpId));
					$this->view->edit=true;
				}
				foreach($data['comp'] as $comp){
					$compInfo=array($grpId,$comp);
					$result=$this->_admModel->insertComponentScreenDML($compInfo);
					if($result){
						$msg=str_replace('@VAR1@',$grpNm,$this->entryMsg['grpCreated']);
						$this->view->textSuccess=$msg; 
					}
				}
				//$this->_redirect('adm/compscreen');
			}
			else{
				$this->view->textErrors=$check;
			}
		//print_r($data);
	  }else{
			$id=$this->_request->getParam('id');
			if($id){
				$result=$this->_admModel->getCompGroupInfoOnIdQuery($id);
				$compgrpId=$result[0]->COMP_DISPLAY_GROUP_ID;
				//print_r($result);
				$result1=$this->_admModel->getCompGroupCompsOnGrpIdQuery($compgrpId);
				if($result1){
					$grpNm=$result[0]->COMP_DISPLAY_GROUP_NAME;
					$scrnId=$result[0]->ASSOC_SCREEN_ID;
					$scrnPos=$result[0]->SCREEN_POSITION;
					$comps=$scrnIds=array();
					$this->view->id=$result1[0]->ID;
					$str=new Bloomfi_App_Ulibrary_StrPattern;
					$str->setPattern();
					foreach($result as $row)
						$str->insertDataToPattern($row->ID);
					$ids=$str->getPatternString();
					$this->view->id=$ids;
					foreach($result as $row){
						array_push($scrnIds,$row->ASSOC_SCREEN_ID);
					}
					foreach($result1 as $row)
						array_push($comps,$row->COMP_ID);
					$data['comp']=$comps;
					$data['screenId']=$scrnIds;
				}
			}
	  }
	  
	  $this->view->compgrpNm=$grpNm;
	  $this->view->compgrpId=$grpId;
	 // $this->view->screenId=$scrnId;
	  $screen=$this->_admModel->getAllCompScreenPositionQuery();
	  $this->view->screen=$element->createSelectDb("screenPos",$screen,'POSITION_ID','POSITION_NAME', $scrnPos ,'NOT',null,' width=15');
	  $this->view->appScreenId=$this->_admModel->getAllApplicationScreensQuery();
	 // $this->view->appScreenId=$element->createSelectDb("screenId",$appScreens,'RESOURCE_ID','RESOURCE_NAME', $scrnId ,'NOT',null,' width=15');
	  if(isset($data['comp'])) $this->view->selectedComps=$data['comp'];
	  if(isset($data['screenId'])) $this->view->selectedScreens=$data['screenId'];
	  ob_flush();
	  flush();
    }

	function delcomgrpAction()
	{
		$grpId=null;
		$msgModel=new modules_adm_messages_message;
	    $this->delMsg=$msgModel->getCompScreenMessages('delete');
		$data=$this->getRequest()->getPost();
		$str=new Bloomfi_App_Ulibrary_StrPattern;
		$str->setPattern();
		foreach( $this->getRequest()->getPost('gid') as $id ){
			$result=$this->_admModel->getCompGroupInfoOnIdQuery($id);
			$grpId=$result[0]->COMP_DISPLAY_GROUP_ID;
			$str->insertDataToPattern($result[0]->COMP_DISPLAY_GROUP_NAME);
			$result=$this->_admModel->deleteCompGroupCompInfoOngrpIdDML($grpId);
			$result=$this->_admModel->deleteCompGroupGrpIdDML($grpId);
			$result=$this->_admModel->deleteAllRoleOnCompGroupIdDML($grpId);
		}
		if($result){
			$compName=$str->getPatternString();
			$msg=str_replace('@VAR1@',$compName,$this->delMsg['deleted']);
			$this->_session->messages=$msg;
			$this->_redirect('/adm/compscreen');
		}
	}

	function createComponentGroupId($name=null)
	{
		$wds=explode(' ',$name);
		$grpId=join('_',$wds);
		//echo "Group Id : ".$grpId;
		return $grpId;
	}

	function validate($data)
	{
		$error=$grpId=$grpNm=$scrnPos=$comp=$id=$scrnId=null;
		$msgModel=new modules_adm_messages_message;
	    $this->validateMsg=$msgModel->getCompScreenMessages('compScreen');
		$id=$data['id'];
		if(isset($data['compgrpNm']))$grpNm=$data['compgrpNm'];
		if(isset($data['screenId']))$scrnId=$data['screenId'];
		if(isset($data['screenPos']))$scrnPos=$data['screenPos'];
		if(isset($data['comp']))$comp=$data['comp'];

		$element=new Bloomfi_App_UHtmlElement;

		//print_r($data);

	/*	$msg=$element->checkElement('Screen Code',$grpId,50,1);
		if($msg)$error['screen_code']=$msg;
		else {
			$result=null;
			//print_r($id);
			if(empty($id)){
				$result=$this->_admModel->isExistScreenCodeQuery($grpId);
			}
			else{
				$result=$this->_admModel->isExistScreenCodeExceptMeQuery(array($grpId,$id));
			}

			if($result)
				$error['screen_code']="Please enter an another code. '$grpId' code is already exist.";
		} */

		$msg=$element->checkElement('Screen Name',$grpNm,50,1);
		if($msg)$error['screen_name']=$msg;
		else {
			$result=null;
			if(empty($id)){
				$result=$this->_admModel->isExistScreenNameQuery($grpNm);
			}
			else {
				$result=$this->_admModel->isExistScreenNameExceptMeQuery(array($grpNm,$id));
			}
			if($result)
			{
				$msg=str_replace('@VAR1@',$grpNm,$this->validateMsg['alreadyExist']);
				$error['screen_name']=$msg;
			}
		}

		if(!$scrnId){
			$error['screenId']=$this->validateMsg['selectCode'];
		}

		if(!$scrnPos){
			$error['scrnPos']=$this->validateMsg['selectPos'];
		}

		if(!$comp){
			$error['comp']=$this->validateMsg['selectComp'];
		}

		//$error['test']='Testing';

		return $error;
	}

	private function __getIndexTableHeaders()
	{
		$table['headers']= array(  'Screen Code', 'Screen Name','Screen location');
		$table['columns']=array('COMP_APPLICATION_RESOURCE_ID', 'COMP_APPLICATION_RESOURCE_SCREEN_NAME','APPL_SCREEN_NAME');
		return $table;
	}

	private function __setViewFormParams($data)
	{
		$this->view->param=$data;
	}
	
}

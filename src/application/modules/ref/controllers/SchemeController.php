<?php
class Ref_SchemeController extends modules_ref_controllers_RefController 
{
	protected $_refModel;
	protected $_session;

	function preDispatch()
	{
		$this->_session=$this->_initialize();
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->_refModel=new modules_ref_models_refAccessQuery;
	}
    function indexAction()
    {
		$labels=new modules_ref_labels_label;
		$this->view->searchFormLabel=$labels->getSchemeFormLabels('searchScheme');
		$this->view->schemeTableHeader=$labels->getSchemeTableLabels('scheme');
		$this->view->viewlabels=$labels->getSchemeViewLabels('index');
		$this->view->links=$labels->getAllLinkLabels('schmIndex');
		$message= new modules_ref_messages_message;
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->confirmMsg = $message->getRefSchemeMessages('confirm');
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$flag=$current_page=$datas=$seperator=$search_url_params=null;
		$configValues=$this->_refConfig->getConfigValues('schemeIndexPagination');
	    $rows=$configValues['rows'];
		$page=$this->_request->getParam('page',1);
		Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);
		if($this->_session->state==1 && $this->_session->controller=='scheme') {	
		  $this->_session->state=0;
		  $data_bundle=$this->_refModel->executeSessionSQL($this->_session->sql,"Location Information");
		  $schemes = $data_bundle['result'];
		  $count=$this->_session->counter;
		  $url=$this->_session->indexUrl;
		  $search=$this->_request->getParam('search');
			if($search){
				$this->view->snm=$this->_request->getParam('nm',null);
				$this->view->sid=$this->_request->getParam('id',null);
				$this->view->sdt=$this->_request->getParam('sdt',null);
				$this->view->edt=$this->_request->getParam('edt',null);
				$this->view->typ=$typ = $this->_request->getParam('typ',null);
				$this->view->srch=1;
			}
		}
		else
		{
			if($this->getRequest()->isPost())
			{
				$request=$this->getRequest()->getPost('REQUEST');
				if($request=='Search')
				{
					$this->view->snm=trim($name=$this->getRequest()->getPost('scheme_name'));
					$this->view->sid=trim($id=$this->getRequest()->getPost('scheme_id'));
					$this->view->sdt=$start_dt=trim($this->getRequest()->getPost('start_date'));
					$this->view->edt=$end_dt=trim($this->getRequest()->getPost('end_date'));
					$this->view->typ=$typ=trim($this->getRequest()->getPost('scheme_type'));
					$this->view->srch=1;
					$page=1;
					$search_data=array($id,$name,$typ,$start_dt,$end_dt);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination();
					$cons_schm_data=array_merge((array)$search_data,(array)$pagination_limits);
					$data_bundle= $this->_refModel->getAllSchemeInfoBySrchQuery($cons_schm_data);
					$schemes = $data_bundle['result'];
					$count=count($schemes);
					if($schemes){		$search_url_params="/index/search/1/nm/$name/id/$id/typ/$typ/sdt/$start_dt/edt/$end_dt/page/$page";
						$this->view->searchparams="/nm/$name/id/$id/typ/$typ/sdt/$start_dt/edt/$end_dt";
						$this->view->arrayparams="$id/$name/$typ/$start_dt/$end_dt";
					}	
					$url = $this->_refModel->getBaseURL()."/ref/scheme".$search_url_params;
				}
				if($request=='Delete')
				{
					$msg = $message->getRefSchemeMessages('dbDelete');
					$i=0;
					foreach($this->getRequest()->getPost('schmid') as $id){
						if($i==1) 
						$seperator=',';
						$val_id=$seperator.$id;
						$datas=$datas.$val_id;
						$i++;
					}
					$result=$this->_refModel->getAllSchemeInIdQuery($datas);
					if($result){
						$result=$this->_refModel->cancelSchemeInIdDML($datas);
						if($result!=null)
							$this->view->textSuccess=$msg['success'];
						else{
							$error['error']=$msg['notexist'];
							$this->view->textErrors=$error;
						}
					}
					else{
						$error['error']=$msg['fail'];
						$this->view->textErrors=$error;
					}
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$search_params=$this->getRequest()->getPost('params');
					if(trim(join('',explode('/',$search_params)))!= ''){
						$id=$name=$start_dt=$end_dt=null;
						$s_param=explode('/',$search_params);
						if( $s_param[0] ) $this->view->snm=$name =$s_param[0] ;  
						if( $s_param[1] ) $this->view->sid=$id =$s_param[1] ; 
						if( $s_param[1] ) $this->view->typ=$typ =$s_param[2] ;
						if( $s_param[2] ) $this->view->sdt=$start_dt =$s_param[3] ;  
						if( $s_param[3] ) $this->view->edt=$end_dt =$s_param[4] ;  
						$search_data=array($id,$name,$typ,$start_dt,$end_dt);
						$cons_schm_data=array_merge((array)$search_data,(array)$pagination_limits);
						$data_bundle= $this->_refModel->getAllSchemeInfoBySrchQuery($cons_schm_data);
						$schemes = $data_bundle['result'];
						$count=count($schemes);
						if($schemes) {
							$this->view->srch=1;	$search_url_params="/index/search/1/nm/$name/id/$id/typ/$typ/sdt/$start_dt/edt/$end_dt/page/$page";
							$this->view->searchparams="/nm/$name/id/$id/typ/$typ/sdt/$start_dt/edt/$end_dt";
							$this->view->arrayparams="$id/$name/$typ/$start_dt/$end_dt";
						}	
						$url = $this->_refModel->getBaseURL()."/ref/scheme".$search_url_params;
					}
					else {
						$data_bundle= $this->_refModel->getAllSchemeQuery($pagination_limits);
						$schemes = $data_bundle['result'];
						$count=count($schemes);
						$url=$this->_refModel->getCurrentPageURL();
					}

					 $lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					 if($lower_limit>=$rows && $count==0)
						$count=1;		
				}
				 if($request!='Search' && $request!='Delete'){
					$arrayParams=null;
					$lib=new Applibrary_XlsUrlHelper;
					$page=$this->_request->getParam('page',1);	
					$srchParams=$this->getRequest()->getPost('searchparams');	
					$arrParams=$this->getRequest()->getPost('arrayparams');	
					$search=$this->getRequest()->getPost('search');	
					$arrayParams=explode('/',$arrParams);
					if(empty($arrayParams[0])) $arrayParams[0]=null;
					if(empty($arrayParams[1])) $arrayParams[1]=null;
					if(empty($arrayParams[2])) $arrayParams[2]=null;
					if(empty($arrayParams[3])) $arrayParams[3]=null;
					if(empty($arrayParams[4])) $arrayParams[4]=null;
					$this->view->xlsResults= $lib->createXlsUrlOnResultArray($this->_refModel,'getAllSchemeInfoBySrchQuery', '/ref/scheme/schemeexcel'.$srchParams, 'Scheme Xls File', 
					$arrayParams,null,null,false);
					//print_r($this->view->xlsResults);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_scheme_data = array_merge((array)$arrayParams,(array)$pagination_limits);
					$data_bundle = $this->_refModel->getAllSchemeInfoBySrchQuery($cons_scheme_data);
					$schemes = $data_bundle['result'];
					$count=count($schemes);
					if($schemes) {
						$this->view->snm=$arrayParams[0];
						$this->view->sid=$arrayParams[1];
						$this->view->typ=$arrayParams[2];
						$this->view->sdt=$arrayParams[3];
						$this->view->edt=$arrayParams[4];
						if($search==1) {
						$this->view->srch=1;		$search_url_params="/index/search/1/nm/".$this->view->snm."/id/".$this->view->sid."/typ/".$this->view->typ."/sdt/".$this->view->sdt."/edt/".$this->view->edt."/page/$page"; }
					 }		
					 $url = $this->_refModel->getBaseURL()."/ref/scheme".$search_url_params;
				}
			}
			else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_request->getParam('search');
				if($search){
					$this->view->snm=$name = $this->getRequest()->getParam('nm');
					$this->view->sid=$id =  $this->getRequest()->getParam('id');
					$this->view->sdt=$start_dt =  $this->getRequest()->getParam('sdt');
					$this->view->edt=$end_dt =  $this->getRequest()->getParam('edt');
					$this->view->typ=$typ =  $this->getRequest()->getParam('typ');
					$search_data=array($id,$name,$typ,$start_dt,$end_dt);
					$cons_schm_data=array_merge((array)$search_data,(array)$pagination_limits);
					$data_bundle= $this->_refModel->getAllSchemeInfoBySrchQuery($cons_schm_data);
					$schemes = $data_bundle['result'];
					$count=count($schemes);
					if($schemes) {
						$this->view->srch=1;	$search_url_params="/index/search/1/nm/$name/id/$id/typ/$typ/sdt/$start_dt/edt/$end_dt/page/$page";
					}	
					$url = $this->_refModel->getBaseURL()."/ref/scheme".$search_url_params;
				}
				else {
					$data_bundle= $this->_refModel->getAllSchemeQuery($pagination_limits);
					$schemes = $data_bundle['result'];
					$count=count($schemes);
					$url=$this->_refModel->getCurrentUrlBase();
				}
			}
		}
		if($count)  $flag=1;
		
		if ($flag==1) 
			$this->view->paginator = Bloomfi_Paginator::factory($schemes,$page,$count);
	
		$this->_session->sql=$data_bundle['sql'];
		$this->_session->indexUrl = $url;
		$this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
		$this->_session->state=0;

		$schemeTypes=$this->_refModel->getAllSchemeTypesQuery();
		$this->view->schemeTypes = $element->createSelectDb("scheme_type",$schemeTypes,'VALUE_ID','VALUE_NAME',null,'not');

		$this->_refModel->destroy();
		ob_flush();
		flush();
		unset($this->_refModel,$labels,$message,$element);
    }

	function addschmAction()
    {
		$this->_session->actionHelp=false;
		$this->_session->controller='scheme';
		$this->view->url=$this->_session->indexUrl;
		$labels=new modules_ref_labels_label;
		$message= new modules_ref_messages_message;
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->addFormLabel=$labels->getSchemeFormLabels('addScheme');
		$this->view->viewlabels=$labels->getSchemeViewLabels('addschm');
		$schm_name=$schm_id=$schm_desc=$schm_type=null;
		$schm_amount=0;
		$start_dt=date('Y-m-d');
		$end_dt=date('Y-m-d',time()+(60*60*24*365));
		if( $this->getRequest()->isPost() )
		{
			$schm_id=$this->getRequest()->getPost('schm_id');
			$schm_name=$this->getRequest()->getPost('schm_nm');
			$schm_type=$this->getRequest()->getPost('schm_type');
			$schm_desc=$this->getRequest()->getPost('schm_desc');
			$schm_amount=$this->getRequest()->getPost('schm_amount');
			$start_dt=$this->getRequest()->getPost('start_dt');
			$end_dt=$this->getRequest()->getPost('end_dt');

			//PAYMENT FORM VALIDATION-------------
			$insert_msg = $message->getRefSchemeMessages('dbEntry');
			$check=$select_option=null;
			$msg=$element->checkElement($this->view->addFormLabel['name'],$schm_name,30,3);
			if($msg)$check['name']=$msg;
			$msg=$element->checkElementSpace($this->view->addFormLabel['id'],$schm_id,10,2);
			if($msg)$check['id']=$msg;
			else{
				$result=$this->_refModel->getSchmQuery($schm_id);
				if($result) $check['id']=$insert_msg['exist'];
			}

			$msg=$element->checkElementSelect('default',$this->view->addFormLabel['type'],$schm_type);
			if($msg)$check['type']=$msg;
			$msg=$element->checkElement($this->view->addFormLabel['desc'],$schm_desc,20,3);
			if($msg)$check['desc']=$msg;
			$msg=$element->checkElementNum($this->view->addFormLabel['amount'],$schm_amount,13,1);
			if($msg)$check['amount']=$msg;
			$msg=$element->checkElementDate($this->view->addFormLabel['startDt'],$start_dt);
			if($msg)$check['startDt']=$msg;
			$msg=$element->checkElementDate($this->view->addFormLabel['endDt'],$end_dt);
			if($msg)$check['endDt']=$msg;
			

			//-------------------------------------
			
			if(!$check) {
				//$this->_refModel->startProcessing();
				//$allow=$this->_refModel->waitAndAllow('DB');
				//$this->_refModel->endProcessing();
				$allow=1;
				if($allow==1) {
					$this->_refModel->startTransaction();
					$this->_refModel->insertRowInSchemeTblDML();
					$max_id=$this->_refModel->getLastInsertedId();
					//$this->_refModel->releaseLock('DB');
					$data=array($schm_id,$schm_name,$schm_type,$schm_desc,$schm_amount,$start_dt,$end_dt,$max_id->ID);
					$result1=$this->_refModel->updateInsertedSchemeDML($data);
					if($result1){
						$this->_refModel->commitTransaction();
						$this->view->textSuccess=$insert_msg['success'];
						$schm_id=$schm_name=$schm_desc=$schm_amount=null;
						$start_dt=date('Y-m-d');
						$end_dt=date('Y-m-d',time()+(60*60*24*365));
					}
					else
						$this->view->textErrors=$insert_msg['fail'];
				}
				else
				 $this->view->textInfo= "Unable to execute your request. Scheme table is busy with another process in Database. Please re-submit the form. ".printTotalProcessingTime(false);
			}
			else{
				$this->view->textErrors=$check;	
			}
		}
		$this->view->name = $schm_name;
		$this->view->sid = $schm_id;
		$this->view->desc =  $schm_desc;
		$this->view->amount = (float) $schm_amount;
		$this->view->startDt =$start_dt;
		$this->view->endDt =$end_dt;

		$schemeTypes=$this->_refModel->getAllSchemeTypesQuery();
		$this->view->schemeTypes = $element->createSelectDb("schm_type",$schemeTypes,'VALUE_ID','VALUE_NAME',$schm_type);

		$this->_refModel->destroy();
		ob_flush();
		flush();
		unset($this->_refModel,$labels,$message,$element);
    }
	
	function editschmAction()
    {
		$this->_session->actionHelp=false;
		$this->_session->state=1;
		$this->_session->controller='scheme';
		$this->view->url=$this->_session->indexUrl;
		$id = $this->_request->getParam('id');
		$labels=new modules_ref_labels_label;
		$element =new Bloomfi_App_UHtmlElement;
		$message= new modules_ref_messages_message;
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->view->editFormLabel=$labels->getSchemeFormLabels('addScheme');
		$this->view->viewlabels=$labels->getSchemeViewLabels('addschm');
		$stat=0;
		
		if($this->getRequest()->isPost()){
			$id=$this->getRequest()->getPost('id');
			$s_nm = $this->getRequest()->getPost('schm_nm');
			$s_id = $this->getRequest()->getPost('schm_id');
			$s_type = $this->getRequest()->getPost('schm_type');
			$s_desc = $this->getRequest()->getPost('schm_desc');
			$s_amount = $this->getRequest()->getPost('schm_amount');
			$s_startdt = $this->getRequest()->getPost('start_dt');
			$s_enddt = $this->getRequest()->getPost('end_dt');
			$this->view->page = $this->getRequest()->getPost('page');

			//PAYMENT FORM VALIDATION-------------
			$check=$select_option=null;
			$msg=$element->checkElement($this->view->editFormLabel['name'],$s_nm,30,3);
			if($msg)$check['name']=$msg;
			$msg=$element->checkElementSpace($this->view->editFormLabel['id'],$s_id,10,2);
			if($msg)$check['id']=$msg;

			$msg=$element->checkElementSelect('default',$this->view->editFormLabel['type'],$s_type);
			if($msg)$check['type']=$msg;

            $msg=$element->checkElementNum($this->view->editFormLabel['amount'],$s_amount,13,1);
			if($msg)$check['amount']=$msg;
		/*	else { 
				$s_amount=(float)$s_amount;	$msg=$element->checkElementFloatComp($this->view->editFormLabel['amount'],$s_amount,0,'Amount is invalid.');
				if($msg)$check['amount']=$msg;
			} */
			$msg=$element->checkElementDate($this->view->editFormLabel['startDt'],$s_startdt);
			if($msg)$check['startDt']=$msg;
			$msg=$element->checkElementDate($this->view->editFormLabel['endDt'],$s_enddt);
			if($msg)$check['endDt']=$msg;
	
			
			//-------------------------------------
			$msg = $message->getRefSchemeMessages('dbUpdate');
			if( !$check  ) {
				$result=$this->_refModel->getSchmQuery($s_id);
				if($result){ if($result[0]->ID==$id)$stat=1; }
				if( $stat==1 || !$result){
					$data=array($s_id,$s_nm, $s_type, $s_desc,$s_amount,$s_startdt,$s_enddt,$id);
					$result=$this->_refModel->updateSchemeDML($data);
					if($result)
						$this->view->textSuccess=$msg['success'];
					else{
						$error['error']=$msg['fail'];
						$this->view->textErrors=$error;
					}
				}
				else{
					$error['error']=$msg['exist'];
					$this->view->textErrors=$error;
				}
			}
			else
			{
				$this->view->textErrors=$check;		
			}
		}
		else{
			$info=$this->_refModel->getSchemeInfoByIdQuery($id);
			$id=$id;
			$s_nm = $info[0]->SCHEME_NAME;
			$s_id = $info[0]->SCHEME_ID;
			$s_type = $info[0]->SCHEME_TYPE;
			$s_desc = $info[0]->SCHEME_DESC;
			$s_amount = (float)$info[0]->SCHEME_AMT_LIMIT;
			$s_startdt =$info[0]->SCHEME_START_DATE;
			$s_enddt =$info[0]->SCHEME_END_DATE;
		}
		$this->view->id = $id;
		$this->view->name = $s_nm;
		$this->view->sid = $s_id;
		$this->view->desc = $s_desc;
		$this->view->amount = (float)$s_amount;
		$this->view->startDt =$s_startdt;
		$this->view->endDt =$s_enddt;

		$schemeTypes=$this->_refModel->getAllSchemeTypesQuery();
		$this->view->schemeTypes = $element->createSelectDb("schm_type",$schemeTypes,'VALUE_ID','VALUE_NAME',$s_type);

		$this->_refModel->destroy();
		ob_flush();
		flush();
		unset($this->_refModel,$labels,$message,$element);
    }

	public function suggestschmnmAction()
	{
		$data = new modules_ref_models_refAccessQuery(); 
		$nm = strtolower($this->_request->getParam('q'));
		$this->view->schemes = $data->getSuggestedSchmNmQuery($nm);
		$this->_helper->layout->disableLayout();
	}

	
	public function suggestschmidAction()
	{
		$data = new modules_ref_models_refAccessQuery(); 
		$id = strtolower($this->_request->getParam('q'));
		$this->view->schemes = $data->getSuggestedSchmIdQuery($id);
		$this->_helper->layout->disableLayout();
	}

	public function schmchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$data=trim($this->_request->getParam('q',null));
		$param=explode('/',$data);
		if(isset($param[1]))
			$this->view->result=$this->_refModel->isSchemeIdExceptMeQuery($param);
		else
			$this->view->result=$this->_refModel->isSchemeIdQuery($param[0]);
	}

	public function schemeexcelAction()
	{	
		$labels=new modules_ref_labels_label;
		$this->view->schemeHeader=$labels->getSchemeTableLabels('scheme');
		$scheme_name = $this->_request->getParam('nm');
		$scheme_id =  $this->_request->getParam('id');
		$start_date =  $this->_request->getParam('sdt');
		$end_date =  $this->_request->getParam('edt');
		$type =  $this->_request->getParam('edt');
		$scheme_data = array( $scheme_id,$scheme_name,$type,$start_date,$end_date );
		$data_bundle = $this->getDataForXls($this->_refModel,'getAllSchemeInfoBySrchQuery',$scheme_data);
		$this->view->xlsResult=$data_bundle['result'];
		unset($labels);
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}

	
}

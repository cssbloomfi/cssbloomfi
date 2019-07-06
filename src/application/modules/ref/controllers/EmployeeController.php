<?php

class Ref_EmployeeController extends modules_ref_controllers_RefController
{
    protected $_lib;
	protected $_imageWidth = 100;
	protected $_imageHeight = 100;
	protected $_temp=null;
	protected $_session;
	protected $_refModel;

	function preDispatch()
	{
		$this->_session=$this->_initialize();
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->_refModel = new modules_ref_models_refAccessQuery;
	}

	function indexAction()
    {
      $this->_session->actionHelp=false;
      $this->view->title="All Collectors";
	  $labels=new modules_ref_labels_label;
	  $this->view->searchFormLabel=$labels->getEmployeeFormLabels('searchemployee');
	  $this->view->employeeTableLabel=$labels->getEmployeeTableLabels('employee');
	  $message= new modules_ref_messages_message;
	  $element=new Bloomfi_App_UHtmlElement;
	  $this->view->confirmMsg = $message->getRefEmployeeMessages('confirm');
	  $this->view->viewlabels=$labels->getEmployeeViewLabels('index');
	  $this->view->links=$labels->getAllLinkLabels('empIndex');
	  $genders=$this->_refModel->getAllGenderTypesQuery();
	  $this->view->genders=$genders;
	  $flag=$request=$url=$search_url_params=$sex=null;
	  $configValues=$this->_refConfig->getConfigValues('employeeIndexPagination');
	  $rows=$configValues['rows'];
	  $page=$this->_request->getParam('page',1);
	  Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);
	  if($this->_session->state==1 && $this->_session->controller=='employee')
	  {
		  $this->_session->state=0;
		  $data_bundle=$this->_refModel->executeSessionSQL($this->_session->sql,"Employee Information");
		  $employees = $data_bundle['result'];
		  $url=$this->_session->indexUrl;
		  $count=$this->_session->counter;
		  if($count>0)
			$flag=1;
	  }
	  else
	  {
		  if ( $this->getRequest()->isPost('REQUEST')  )
			{
				$request=$this->getRequest()->getPost('REQUEST');
				if($request=="Search")
				{
					$page=1;
					$employee_name =  trim($this->getRequest()->getPost('employee_name'));
					$employee_code =  trim($this->getRequest()->getPost('employee_code'));
					$sex =  $this->getRequest()->getPost('sex');
					$entry_date =  trim($this->getRequest()->getPost('entry_date'));
					if(empty($employee_name)) $employee_name=null;
					if(empty($employee_code)) $employee_code=null;
					if(empty($sex)) $sex=null;
					if(empty($entry_date)) $entry_date=null;
					$this->view->enm=$employee_name;
					$this->view->eid=$employee_code;
					$this->view->sx = $sex;
					$this->view->edt = $entry_date;
					$this->view->srch=1;
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination();
					$employee_data=array($employee_name,$employee_code,$sex,$entry_date);
					$cons_employee_data = array_merge((array)$employee_data,(array)$pagination_limits);
					$data_bundle = $this->_refModel->getAllEmployeesInfoBySrchQuery($cons_employee_data);
					$employees = $data_bundle['result'];
					$count=count($employees);
					if($employees){	$search_url_params="/index/search/1/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date/page/$page";
						$this->view->searchparams="/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date";
						$this->view->arrayparams="$employee_name/$employee_code/$sex/$entry_date";
					}
					$url = $this->_refModel->getBaseURL()."/ref/employee".$search_url_params;
				}
				if($request=='Delete')
				{
					$search_params=$this->getRequest()->getPost('params');
					$id=$this->getRequest()->getPost('empid');
					$msg = $message->getRefEmployeeMessages('dbDelete');
					$seperator=$valid_id=$val_id=$datas=$addresses=null;
					foreach($this->getRequest()->getPost('empid') as $id){
					$valid_id=$this->_refModel->getCollectorIdQuery($id);
					if($valid_id) break;
					}
					if($valid_id){
					if(!empty($id)){
						$i=0;
						foreach($this->getRequest()->getPost('empid') as $id){
								if($i==1)
									$seperator=',';
								$val_id=$seperator."'$id'";
								$datas=$datas.$val_id;
								$i++;
							}
						$addrs = $this->_refModel->getEmpAddrIdQuery($datas);
						$i=0;
						$seperator=null;
						foreach($addrs as $id){
								if($i==1)
									$seperator=',';
								$val_id=$seperator."'".$id->ADDRESS_ID."'";
								$addresses=$addresses.$val_id;
								$i++;
							}
						 $result1=$this->_refModel->deleteEntityAddrDML($addresses);
						 $result2=$this->_refModel->deleteEmployeeDML($datas);
						 $msg = $message->getRefEmployeeMessages('dbDelete');
						if($result1!=null && $result2!=null){
							$this->view->textSuccess=$msg['success'];
							$this->view->delete=3; }
						else{
							$error['error']=$msg['fail'];
							$this->view->textErrors = $error; }
					}}
					else{
						$error['error']=$msg['fail'];
						$this->view->textErrors = $error;
					}
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					if(trim(join('',explode('/',$search_params))) != ''){
						$s_param=explode('/',$search_params);
						if( $s_param[0] ) $employee_name =$s_param[0] ;
						else $employee_name =null ;
						if( $s_param[1] ) $employee_code =$s_param[1] ;
						else $employee_code =null ;
						if( $s_param[2] ) $sex =$s_param[2] ;
						else $sex =null ;
						if( $s_param[3] ) $entry_date =$s_param[4] ;
						else $entry_date =null ;
						$employee_data=array($employee_name,$employee_code,$sex,$entry_date);
						$cons_employee_data = array_merge((array)$employee_data,(array)$pagination_limits);
						$data_bundle = $this->_refModel->getAllEmployeesInfoBySrchQuery($cons_employee_data);
					    $employees = $data_bundle['result'];
						$count=count($employees);
						if($employees) {
							$this->view->enm=$employee_name;
							$this->view->eid=$employee_code;
							$this->view->sx = $sex;
							$this->view->edt = $entry_date;
							$this->view->srch=1;	$search_url_params="/index/search/1/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date/page/$page";
							$this->view->searchparams ="/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date";
							$this->view->arrayparams="$employee_name/$employee_code/$sex/$entry_date";
						}
						$url = $this->_refModel->getBaseURL()."/ref/employee".$search_url_params;
					}
					else{
						$data_bundle = $this->_refModel->getAllEmployeesInfoQuery($pagination_limits);
						$employees = $data_bundle['result'];
						$count=count($employees);
						$url=$this->_refModel->getCurrentPageURL();
					}

					$lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					if($lower_limit>=$rows && $count==0)
							$count=1;

				} // Delete End;

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
					$this->view->xlsResults= $lib->createXlsUrlOnResultArray($this->_refModel,'getAllEmployeesInfoBySrchQuery', '/ref/employee/employeeexcel'.$srchParams, 'Employee Xls File',
					$arrayParams);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_employee_data = array_merge((array)$arrayParams,(array)$pagination_limits);
				//	print_r($cons_employee_data);
					$data_bundle = $this->_refModel->getAllEmployeesInfoBySrchQuery($cons_employee_data);
					$employees=$data_bundle['result'];
					$count=count($employees);
					if($employees) {
						$this->view->enm=$arrayParams[0];
						$this->view->eid=$arrayParams[1];
						$this->view->sx = $arrayParams[2];
						$this->view->edt =$arrayParams[3];
						if($search==1) {
						$this->view->srch=1;
						$this->view->searchparams=$srchParams;
						$this->view->arrayparams=$arrParams;
						$search_url_params = "/index/search/1/nm/".$this->view->enm."/id/".$this->view->eid."/sx/".$this->view->sx."/edt/".$this->view->edt."/page/$page"; }
					}
					$url = $this->_refModel->getBaseURL()."/ref/employee".$search_url_params;
					//echo $url;
				}
			}
			else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_request->getParam('search');
				if($search)
				{
					$employee_name = $this->_request->getParam('nm');
					$employee_code = $this->_request->getParam('id');
					$start_age =  $this->_request->getParam('sage');
					$end_age =  $this->_request->getParam('eage');
					$sex = $this->_request->getParam('sx');
					$entry_date =  $this->_request->getParam('edt');
					$employee_data=array($employee_name,$employee_code,$sex,$entry_date);
					$cons_employee_data = array_merge((array)$employee_data,(array)$pagination_limits);
				//	print_r($cons_employee_data);
					$data_bundle = $this->_refModel->getAllEmployeesInfoBySrchQuery($cons_employee_data);
				//	print_r($data_bundle);
					$employees = $data_bundle['result'];
			//		print_r($employees);
					$count=count($employees);
					if($employees){
						$this->view->enm=$employee_name;
						$this->view->eid=$employee_code;
						$this->view->sage= $start_age;
						$this->view->eage= $end_age;
						$this->view->sx = $sex;
						$this->view->edt = $entry_date;
						$this->view->srch=1; 	$search_url_params="/index/search/1/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date/page/$page";
						$this->view->searchparams ="/nm/$employee_name/id/$employee_code/sx/$sex/edt/$entry_date";
						$this->view->arrayparams="$employee_name/$employee_code/$sex/$entry_date";
					}
					$url = $this->_refModel->getBaseURL()."/ref/employee".$search_url_params;
				}
				else
				{
					$data_bundle = $this->_refModel->getAllEmployeesInfoQuery($pagination_limits);
					$employees = $data_bundle['result'];
					$count=count($employees);
					$url=$this->_refModel->getCurrentUrlBase();
				}
			}
			if($count>0)  $flag=1;
		}
		if ($flag==1)
			$this->view->paginator = Bloomfi_Paginator::factory($employees,$page,$count);

		$this->_session->sql=$data_bundle['sql'];
		$this->_session->indexUrl = $url;
		$this->_session->counter=$count+Bloomfi_Paginator::getLastLowerStartLimit();
		$this->_session->state=0;
		 $this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex,'not');
    }

	function addemployeeAction()
	{
		$this->_session->actionHelp=false;
		$this->view->url=$this->_session->indexUrl;
		$this->view->title = "Add Collector";
		$this->_session->controller='employee';
		$message= new modules_ref_messages_message;
	    $this->view->confirmMsg = $message->getRefEmployeeMessages('dbCheckError');
		$labels=new modules_ref_labels_label;
		$values=new modules_ref_values_value;
		$element=new Bloomfi_App_UHtmlElement;
		$this->view->formLabel=$labels->getEmployeeFormLabels('addemployee');
		$this->view->desgDt=$this->view->joinDt = date("Y-m-d");
		$check=$datas=$sex=$emp_img=$emp_id=null;
		if ( $this->getRequest()->isPost()  )
		{
				$age_limits = $this->_refModel->getCustomerAgeLimitQuery();
				$employee_id=$this->getRequest()->getPost('empId');
				$sex=$this->getRequest()->getPost('sex');
				$nm=$this->getRequest()->getPost('name');
				$addr=$this->getRequest()->getPost('address');
				$age=$this->getRequest()->getPost('age');
				$designation=$this->getRequest()->getPost('designation');
				$joindate=$this->getRequest()->getPost('joindate');
				$description=$this->getRequest()->getPost('description');
			/*	$mstemp=trim($this->getRequest()->getPost('mstemp'));
				if($mstemp){ $empinfo=explode(',', $mstemp);
				if($empinfo[0]) $emp_id=trim($empinfo[0]);
				} */
				$upload = new Zend_File_Transfer_Adapter_Http();
				try {
				 $upload->receive();
				} catch (Zend_File_Transfer_Exception $e) {
				$e->getMessage();
				 }
				$image_filename = $upload->getFileName('file');

				//FORM VALIDATION---------
				$message= new modules_ref_messages_message;
				$entry_messages=$message->getRefEmployeeMessages('dbEntry');
				$msg=$element->checkElementSpace($this->view->formLabel['employeeId'],$employee_id,50,1);
				if($msg)$check['employeeId']=$msg;
				else{
					$result=$this->_refModel->getEmployeeQuery($employee_id);
					if($result)	$check['employeeId']= str_replace('@VAR1@',$employee_id,$entry_messages['duplicateEmpId']);
				}
				$msg=$element->checkElementAlpha($this->view->formLabel['name'],$nm,50,2);
				if($msg)$check['name']=$msg;
				if($age){
				$msg=$element->checkElementNum($this->view->formLabel['age'],$age,2,1);
				if($msg)$check['age']=$msg; }
				else
					$age = (int)$age_limits[0]->VALUE_NAME;

				$msg=$element->checkElementSelect('default',$this->view->formLabel['sex'],$sex);
				if($msg)$check['sex']=$msg;

				$msg=$element->checkElement($this->view->formLabel['addr'],$addr,70,1);
				if($msg)$check['address']=$msg;
				$msg=$element->checkElement($this->view->formLabel['desg'],$designation,50,1);
				if($msg)$check['desg']=$msg;
				/*
				if($emp_id) {
					$result=$this->_refModel->getEmployeeQuery($emp_id);
					if(!$result){
						$msg=str_replace('@VAR1@',$this->view->formLabel['mstEmp'],$entry_messages['noMstEmpId']);
						$check['mstempid']=str_replace('@VAR2@',$emp_id,$msg);	}
				} */
				$msg=$element->checkElementDate($this->view->formLabel['joindt'],$joindate);
				if($msg)$check['join_date']=$msg;

				
				if($image_filename) {
				$exts=array('jpg','bmp','png');
				$file_ext=$element->stripExtension($image_filename);
				if(!in_array($file_ext,$exts)){
					$check['exts']='Please select the file for "'.$this->view->formLabel['image'].'" with extention jpg/bmp/png';
				}}
				if($check)
			     if($image_filename)
					$check['image']="Please reselect the image file";

				//----------------

				if(!$check)
				 {
					$lib = new Bloomfi_App_Ulibrary;
					$path=ROOT_DIR."/images/entity/employee";
					$static=$this->_refModel->getAllEmpStaticValQuery();
					$employee = $this->_refModel->getAllEmployeeQuery($static[0]->VALUE_NAME);
					$prefix=$this->_refModel->getEmployeePrePostQuery();
					//$this->_refModel->startProcessing();
					//$allow=$this->_refModel->waitAndAllow('DB');
					//$this->_refModel->endProcessing();
					$allow=1;
					if($allow==1) {
						$this->_refModel->startTransaction();
						$this->_refModel->insertRowInCollectorTblDML();
						$max_id=$this->_refModel->getLastInsertedId();
						//$this->_refModel->releaseLock('DB');
						$entity_id = $employee_id;
					//	if($employee_id==$emp_id) $emp_id=null;
						$addr_id = $prefix[1]->PREFIX_VALUE.$max_id->ID;
						$entity_unique_id = $prefix[0]->PREFIX_VALUE.$max_id->ID;
						if($image_filename)
						$emp_img=$max_id->ID.".jpg";
						$datas_ordered_1 = array( $entity_id,$entity_unique_id,$static[0]->VALUE_NAME, $description, $nm, $age, $sex, $employee_id, $joindate, $designation, $addr_id,$emp_img,$max_id->ID);
						$datas_ordered_2 = array( $addr_id, $addr );
						$result1=$this->_refModel->updateInsertedEmployeeDML($datas_ordered_1);
						$result2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
						if($result1!=null && $result2!=null){
							$this->_refModel->commitTransaction();
							if($image_filename)
								$lib->imageUpload($image_filename,$emp_img,$path, $this->_imageHeight,$this->_imageWidth);
							$this->view->textSuccess=$entry_messages['success'];
							$nm=$age=$addr=$designation=$joindate=$description=$employee_id=null;
							$this->view->insert=1; }
						else
							$this->view->textErrors = $entry_messages['fail'];
					}
					else{
						$this->view->textInfo= "Unable to execute your request. Entity table is busy with another process in Database. Please re-submit the form. ".printTotalProcessingTime('false');
					}
				 }
				else
				 {
					
					$this->view->textErrors = $check;
				 }
				 $this->view->name = $nm;
				 $this->view->age = $age;
				 $this->view->address = $addr;
				 $this->view->desg = $designation ;
				 $this->view->joinDt =$joindate ;
				 $this->view->desc = $description;
			//	 $this->view->mstemp = $mstemp;
				 $this->view->empId = $employee_id;
		}
		$genders=$this->_refModel->getAllGenderTypesQuery();
		$this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex,null,null,null);
	}


	public function editempAction()
	{
		$this->_session->actionHelp=false;
		$this->view->title="Edit Collector";
		$this->_session->state=1;
		$this->_session->controller='employee';
		$this->view->url=$this->_session->indexUrl;
		$id = $this->_request->getParam('id');
		$labels=new modules_ref_labels_label;
		$values=new modules_ref_values_value;
		$element=new Bloomfi_App_UHtmlElement;
		$genders=$this->_refModel->getAllGenderTypesQuery();
		$this->view->formLabel=$labels->getEmployeeFormLabels('addemployee');
		$this->view->desgDt=$this->view->joinDt = date("Y-m-d");
		$check=$datas=$sex=$image_name=$emp_id=null;

		if($this->getRequest()->isPost())
		{
			$age_limits = $this->_refModel->getCustomerAgeLimitQuery();
			$employee_id=$this->getRequest()->getPost('empId');
			$sex=$this->getRequest()->getPost('sex');
			$name=$this->getRequest()->getPost('name');
			$age=$this->getRequest()->getPost('age');
			$addr=$this->getRequest()->getPost('address');
			$joindate=$this->getRequest()->getPost('joindate');
			$designation=$this->getRequest()->getPost('designation');
			$description=$this->getRequest()->getPost('description');
		/*	$mstemp=trim($this->getRequest()->getPost('mstemp'));
			if($mstemp){ $empinfo=explode(',', $mstemp);
			if($empinfo[0]) $emp_id=trim($empinfo[0]); }  */
			$hidden_params=$this->getRequest()->getPost('params');
				$params=explode('/',$hidden_params);
				$id=$params[0];
				if(!empty($params[1]))
					$image=$params[1];
				else {
					if($sex==$genders[1]->VALUE_ID) $image='FEMALE.jpg';
					if($sex==$genders[0]->VALUE_ID) $image='MALE.jpg';
				}
			$upload = new Zend_File_Transfer_Adapter_Http();
				try {
				 $upload->receive();
				} catch (Zend_File_Transfer_Exception $e) {
				$e->getMessage();
				 }
			$image_filename = $upload->getFileName('file');

			//FORM VALIDATION---------
			$message= new modules_ref_messages_message;
			$edit_message=$message->getRefEmployeeMessages('dbUpdate');
			$msg=$element->checkElementSpace($this->view->formLabel['employeeId'],$employee_id,50,1);
			if($msg)$check['employeeId']=$msg;
			else{
				$result=$this->_refModel->getEmployeeQuery($employee_id);
				if($result && $result[0]->ID!=$id)
					$check['employeeId']=str_replace('@VAR1@',$employee_id,$edit_message['duplicateEmpId']);
			}
			$msg=$element->checkElementAlpha($this->view->formLabel['name'],$name,50,2);
			if($msg)$check['name']=$msg;
			if($age){
			$msg=$element->checkElementNum($this->view->formLabel['age'],$age,2,1);
			if($msg)$check['age']=$msg; }
			else
				$age = (int)$age_limits[0]->VALUE_NAME;

			$msg=$element->checkElementSelect('default',$this->view->formLabel['sex'],$sex);
				if($msg)$check['sex']=$msg;

			$msg=$element->checkElement($this->view->formLabel['addr'],$addr,70,1);
			if($msg)$check['address']=$msg;
			$msg=$element->checkElement($this->view->formLabel['desg'],$designation,50,1);
			if($msg)$check['desg']=$msg;
		/*	if($emp_id) {
					$result=$this->_refModel->getEmployeeQuery($emp_id);
					if(!$result){
						$msg=str_replace('@VAR1@',$this->view->formLabel['mstEmp'],$edit_message['noMstEmpId']);
						$check['mstempid']=str_replace('@VAR2@',$emp_id,$msg);	}
				} */
			$msg=$element->checkElementDate($this->view->formLabel['joindt'],$joindate);
			if($msg)$check['join_date']=$msg;

			

			if($image_filename) {
				$exts=array('jpg','bmp','png');
				$file_ext=$element->stripExtension($image_filename);
				if(!in_array($file_ext,$exts)){
					$check['exts']='Please select the file for "'.$this->view->formLabel['image'].'" with extention jpg/bmp/png';
				}}

				if($check)
			     if($image_filename)
					$check['image']="Please reselect the image file";

			//--------------------------------------------------

			if(!$check)
			{
				$this->_lib = new Bloomfi_App_Ulibrary;
				$path=ROOT_DIR."/images/entity/employee";
				$this->_temp=$id.".jpg";
				if(($this->_temp!=$image && $image_filename) || $this->_temp==$image)
					$image_name=$this->_temp;
				$datas_ordered_1 = array($employee_id, $name, $age, $sex, $joindate, $designation,$description,$image_name,$id);
				$datas_ordered_2 = array($addr,$employee_id);
				$result1=$this->_refModel->updateEmployeeDML($datas_ordered_1);
				$result2=$this->_refModel->updateEmployeeAddrDML($datas_ordered_2);
				if($result1!=null && $result2!=null){
					if($image_filename)
						$this->_lib->imageUpload($image_filename,$image_name, $path,$this->_imageHeight,$this->_imageWidth);
					$this->view->textSuccess=$edit_message['success'];
					$this->view->update=2; }
				else
					$this->view->textErrors = $edit_message['fail'];
			}
			else
			{
				$this->view->id = $id;
				$this->view->name = $name;
				$this->view->age = $age;
				$this->view->address = $addr;
				$this->view->desg = $designation;
				$this->view->joinDt = $joindate;
				$this->view->desc = $description;
				$this->view->image = $image;
				$this->view->empId = $employee_id;
			//	$this->view->mstemp=$mstemp;
				$this->view->textErrors = $check;
			}
		}
		else
		{
			$employee=$this->_refModel->getEmployeeInfoByIdQuery($id);
			$this->view->id = $id;
			$this->view->empId = $employee[0]->EMPLOYEE_ID;
			$this->view->name = $employee[0]->NAME;
			$sex=$employee[0]->SEX;
			$this->view->age = $employee[0]->AGE;
			$this->view->address = $employee[0]->ADDRESS;
			$this->view->desg =$employee[0]->EMPLOYEE_DESIGNATION;
	//		$this->view->mstemp=$employee[0]->PARENT_ENTITY_ID;
			$this->view->joinDt =$employee[0]->EMPLOYEE_JOIN_DATE;
			$this->view->desc =$employee[0]->ENTITY_DESC;
			if($employee[0]->IMAGE)
			$this->view->image=$employee[0]->IMAGE;
			else{
			  if($sex==$genders[1]->VALUE_ID) $this->view->image='FEMALE.jpg';
			  if($sex==$genders[0]->VALUE_ID) $this->view->image='MALE.jpg';
			}
		}
		$this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex,null,null,'id="sex"');
	}


	public function emplocmapAction()
	{
		$this->_session->actionHelp=false;
		$this->view->title="Collector's Location Map";
		$this->_session->state=1;
		$this->_session->controller='employee';
		$this->view->url=$this->_session->indexUrl;
		$label=new modules_ref_labels_label;
		$msg=new modules_ref_messages_message;
		$this->view->formLabel=$label->getEmployeeFormLabels('employeeLocationMap');
		$this->view->localMessages=$msg->getRefEmployeeMessages('empLocationMap');

		if($this->getRequest()->isPost('entId')) {
			$id=$this->getRequest()->getPost('entId');
			$result1=$this->_refModel->deleteEmpLocInEntidDML($id);
			if($result1!=null){
				if($this->getRequest()->getPost('loc')){
				foreach($this->getRequest()->getPost('loc') as $loc) {
					if(!empty($loc)) {
					$data=array($id,$loc);
					$result2=$this->_refModel->insertEmpLocInfoDML($data);
					if($result2==null){
						echo "Unable to insert";
						break;
					}}
					else break;
				}
			  }
			}
		}
		else $id=$this->_request->getParam('id');

		$this->view->empId=$id;
		$this->view->result=$this->_refModel->getEmployeeLocationsQuery($this->view->empId);
		$this->view->locations=$this->_refModel->getAllLocationsQuery();
	}


	public function suggestempnmAction()
	{
		$this->_helper->layout->disableLayout();
		$employee_name = strtolower($this->_request->getParam('q'));
		$this->view->employee = $this->_refModel->getEmployeesNmQuery($employee_name);
	}

	public function suggestempidAction()
	{
		$employee_id = strtolower($this->_request->getParam('q'));
		$this->view->employee = $this->_refModel->getEmployeesIdQuery($employee_id);
		$this->_helper->layout->disableLayout();
	}

	public function empchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$data=trim($this->_request->getParam('q',null));
		$param=explode('/',$data);
		if(isset($param[1]))
			$this->view->result=$this->_refModel->isEmployeeIdExceptMeQuery($param);
		else
			$this->view->result=$this->_refModel->isEmployeeIdQuery($param[0]);
	}

	public function employeeexcelAction()
	{
		$labels=new modules_ref_labels_label;
		$this->view->employeeHeader=$labels->getEmployeeTableLabels('employee');
		$employee_name = $this->_request->getParam('nm');
		$employee_code =  $this->_request->getParam('id');
		$sex = $this->_request->getParam('sx');
		$entry_date =  $this->_request->getParam('edt');
		$employee_data = array( $employee_name,$employee_code,$sex,$entry_date);
		$data_bundle = $this->getDataForXls($this->_refModel,'getAllEmployeesInfoBySrchQuery',$employee_data);
		$this->view->xlsResult=$data_bundle['result'];
		unset($labels);
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$rows=5000;
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}

}


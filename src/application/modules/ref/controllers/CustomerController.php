<?php
require_once (ROOT_DIR.'/library/thirdParty/utilityFunctions.php');
class Ref_CustomerController extends modules_ref_controllers_RefController
{
	protected $_lib;
	protected $_imageWidth = 100;
	protected $_imageHeight = 100;
	protected $_temp;
	protected $_session;
	protected $_refModel;
	protected $_refConfig;

    function preDispatch(){
		$this->_session=$this->_initialize();
		$this->_refModel = new modules_ref_models_refAccessQuery();
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->view->acl=$this->_session->acl;
	}

	function postDispatch(){
		$this->_refModel->destroy();
		unset($this->_refModel);
	}

    function indexAction()
    {
      $this->view->title = "All Customers";
	  $labels=new modules_ref_labels_label;
	  $element=new Bloomfi_App_UHtmlElement;
	  $this->view->searchFormLabel=$labels->getCustomerFormLabels('searchcustomer');
	  $this->view->customerTableHeader=$labels->getCustomerTableLabels('customer');
	  $this->view->viewlabels=$labels->getCustomerViewLabels('index');
	  $this->view->links=$labels->getAllLinkLabels('custIndex');
	  $message= new modules_ref_messages_message;
	  $this->view->confirmMsg = $message->getRefCustomerMessages('confirm');
	  $genders=$this->_refModel->getAllGenderTypesQuery();
	  $this->view->genders= $genders;
	  $locations = $this->_refModel->getAllTrnLocations();
	  $flag=$customers=$request=$search_url_params=$url=$value=$temp=$location=$sex=null;
	  $postFlag=$count=0;
	  $configValues=$this->_refConfig->getConfigValues('customerIndexPagination');
	  $rows=$configValues['rows'];
	  $page=$this->_request->getParam('page',1);
	  Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);

	  if($this->_session->state==1 &&  $this->_session->controller=='customer') {
		  $this->_session->state=0;
		  $data_bundle=$this->_refModel->executeSessionSQL($this->_session->sql,"Customer Info");
		  $customers=$data_bundle['result'];
		  $count=$this->_session->counter;
		  $url=$this->_session->indexUrl;
	  }
	  else
	  {
		  if ( $this->getRequest()->isPost())
			{
				$request=$this->getRequest()->getPost('REQUEST');
				if($request=="Search")
				{
					$customer_name =  trim($this->getRequest()->getPost('customer_name'));
					$customer_code =  trim($this->getRequest()->getPost('customer_code'));
					$sex =  $this->getRequest()->getPost('sex');
					$entry_date =  trim($this->getRequest()->getPost('entry_date'));
					$location =  $this->getRequest()->getPost('location');
					$employee_code =  trim($this->getRequest()->getPost('employee_code'));
					if(empty($customer_name)) $customer_name=null;
					if(empty($customer_code)) $customer_code=null;
					if(empty($sex)) $sex=null;
					if(empty($entry_date)) $entry_date=null;
					if(empty($location)) $location=null;
					if(empty($employee_code)) $employee_code=null;
					$this->view->cnm=$customer_name;
					$this->view->cid=$customer_code;
					$this->view->sx = $sex;
					$this->view->edt = $entry_date;
					$this->view->loc = $location;
					$this->view->eid = $employee_code;
					$this->view->srch=1;
					$page=1;
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination();
					$customer_data = array($customer_code,$customer_name,$sex,$entry_date,$location,$employee_code);
					$cons_customer_data = array_merge((array)$customer_data,(array)$pagination_limits);
					$data_bundle = $this->_refModel->getAllCustInfoBySrchQuery($cons_customer_data);
					$customers = $data_bundle['result'];
					$count=count($customers);
					if($customers){
							$search_url_params="/index/search/1/nm/$customer_name/id/$customer_code/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code/page/$page";
						$this->view->searchparams="/id/$customer_code/nm/$customer_name/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code";
						$this->view->arrayparams= "$customer_code/$customer_name/$sex/$entry_date/$location/$employee_code";
					}
					$url = $this->_refModel->getBaseURL()."/ref/customer".$search_url_params;
				}
				if($request=='Delete')
				{
                                        //$allow=$this->_refModel->waitAndAllow($this->dbVirtualKey);
                                        //if
					$search_params=$this->getRequest()->getPost('params');
					$id=$this->getRequest()->getPost('custid');
					$msg = $message->getRefCustomerMessages('dbDelete');
					$seperator=$val_id=$datas=$addresses=$valid_id=null;
					foreach($this->getRequest()->getPost('custid') as $id){
					$valid_id=$this->_refModel->getEntityIdQuery($id);
					if($valid_id) break;
					}
					if($valid_id){
					if(!empty($id)){
						$i=0;
						foreach($this->getRequest()->getPost('custid') as $id){
								if($i==1)
									$seperator=',';
								$val_id=$seperator."'$id'";
								$datas=$datas.$val_id;
								$i++;
							}
						$addrs = $this->_refModel->getCustAddrIdQuery($datas);
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
						$result2=$this->_refModel->deleteCustomerDML($datas);
						if($result1!=null && $result2!=null){
							$this->view->textSuccess=$msg['success'];
							$this->view->delete=3; }
						else {
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
						if( $s_param[0] ) $customer_name =$s_param[0] ;
						else $customer_name =null ;
						if( $s_param[1] ) $customer_code =$s_param[1] ;
						else $customer_code =null ;
						if( $s_param[2] ) $sex =$s_param[2] ;
						else $sex =null ;
						if( $s_param[3] ) $entry_date =$s_param[3] ;
						else $entry_date =null ;
						if( $s_param[4] ) $location =$s_param[4] ;
						else $location =null ;
						if( $s_param[5] ) $employee_code =$s_param[5] ;
						else $employee_code =null ;
						$customer_data = array( $customer_code,$customer_name,$sex,$entry_date,$location,$employee_code );
						$cons_customer_data = array_merge((array)$customer_data,(array)$pagination_limits);
						$data_bundle = $this->_refModel->getAllCustInfoBySrchQuery($cons_customer_data);
						$customers=$data_bundle['result'];
						$count=count($customers);
						if($customers) {
							$this->view->cnm=$customer_name;
							$this->view->cid=$customer_code;
							$this->view->sx = $sex;
							$this->view->edt = $entry_date;
							$this->view->loc = $location;
							$this->view->eid = $employee_code;
							$this->view->srch=1;	$search_url_params="/index/search/1/nm/$customer_name/id/$customer_code/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code/page/$page";
							$this->view->searchparams="/id/$customer_code/nm/$customer_name/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code";
							$this->view->arrayparams= "$customer_code/$customer_name/$sex/$entry_date/$location/$employee_code";
						}
						$url = $this->_refModel->getBaseURL()."/ref/customer".$search_url_params;
					}
					else{
						$data_bundle= $this->_refModel->getAllCustomersInfoQuery($pagination_limits);
						$customers = $data_bundle['result'];
						$count=count($customers);
						$url=$this->_refModel->getCurrentPageURL();
					}

					$lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					if($lower_limit>=$rows && $count==0)
						$count=1;
				}



				if($request!='Search' && $request!='Delete'){

					$arrayParams=null;
					$lib=new Applibrary_XlsUrlHelper;
					//die ("Ok upto here");
					$page=$this->_request->getParam('page',1);
					$srchParams=$this->getRequest()->getPost('searchparams');
					$arrParams=$this->getRequest()->getPost('arrayparams');
					$search=$this->getRequest()->getPost('search');
					$request=$this->getRequest()->getPost('REQUEST');
					$arrayParams=explode('/',$arrParams);
					if(empty($arrayParams[0])) $arrayParams[0]=null;
					if(empty($arrayParams[1])) $arrayParams[1]=null;
					if(empty($arrayParams[2])) $arrayParams[2]=null;
					if(empty($arrayParams[3])) $arrayParams[3]=null;
					if(empty($arrayParams[4])) $arrayParams[4]=null;
					if(empty($arrayParams[5])) $arrayParams[5]=null;

					if($request=='xls'){
						 $this->view->xlsResults = $lib->createXlsUrlOnResultArray($this->_refModel, 'getAllCustInfoBySrchQuery', '/ref/customer/customerexcel'.$srchParams, 'Customer Xls File',
					$arrayParams);

					}

					if($request=='pdf'){
                        $params=$this->organizeSearchUrlParams($srchParams);
						$this->_session->modelName='modules_ref_models_refAccessQuery';
						$this->_session->functionName='getAllCustInfoBySrchQuery';
						$this->_session->exportFilePrefix='Customer_info';
						$this->_session->tableRequireData=$this-> getCustomerTableRequiredData($this->view->customerTableHeader);
						$this->_session->data=count($arrayParams);
						$this->view->xlsResults = $lib->createPdfUrlOnResultArray($this->_refModel, 'getAllCustInfoBySrchQuery', '/dbd/index/createpdf'.$params, 'Customer Pdf File',
					$arrayParams);
					}
					//print_r($arrayParams);

					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_customer_data = array_merge((array)$arrayParams,(array)$pagination_limits);
					$data_bundle = $this->_refModel->getAllCustInfoBySrchQuery($cons_customer_data);
					$customers=$data_bundle['result'];
					$count=count($customers);
					if($customers) {
						$this->view->cnm=$arrayParams[0];
						$this->view->cid=$arrayParams[1];
						$this->view->sx =$arrayParams[2];
						$this->view->edt =$arrayParams[3];
						$this->view->loc = $arrayParams[4];
						$this->view->eid = $arrayParams[5];
						if($search==1){
						$this->view->srch=1;
						$this->view->searchparams=$srchParams;
						$this->view->arrayparams=$arrParams;
						$search_url_params = "/index/search/1/nm/".$this->view->cnm."/id/".$this->view->cid."/sx/".$this->view->sx."/edt/".$this->view->edt."/loc/".$this->view->loc."/eid/".$this->view->eid."/page/$page"; }
					}
					$url = $this->_refModel->getBaseURL()."/ref/customer".$search_url_params;
					//echo $url;
				}
			}
		 else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_request->getParam('search');
				if($search){
					$customer_name=$this->_request->getParam('nm');
					$customer_code=$this->_request->getParam('id');
					$sex=$this->_request->getParam('sx');
					$entry_date=$this->_request->getParam('edt');
					$location=$this->_request->getParam('loc');
					$employee_code=$this->_request->getParam('eid');
					$customer_data = array( $customer_code,$customer_name,$sex, $entry_date,$location,$employee_code );
					$cons_customer_data = array_merge((array)$customer_data,(array)$pagination_limits);
					$data_bundle = $this->_refModel->getAllCustInfoBySrchQuery($cons_customer_data);
					$customers = $data_bundle['result'];
					$count=count($customers);
					if($customers){
						$this->view->cnm=$customer_name;
						$this->view->cid=$customer_code;
						$this->view->sx = $sex;
						$this->view->edt = $entry_date;
						$this->view->loc = $location;
						$this->view->eid = $employee_code;
						$this->view->srch=1;	$search_url_params="/index/search/1/nm/$customer_name/id/$customer_code/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code/page/$page";
						$this->view->searchparams="/id/$customer_code/nm/$customer_name/sx/$sex/edt/$entry_date/loc/$location/eid/$employee_code";
						$this->view->arrayparams= "$customer_code/$customer_name/$sex/$entry_date/$location/$employee_code";
					}
					$url = $this->_refModel->getBaseURL()."/ref/customer".$search_url_params;
				}
				else{
					$data_bundle= $this->_refModel->getAllCustomersInfoQuery($pagination_limits);
					$customers = $data_bundle['result'];
					$count=count($customers);
					$url=$this->_refModel->getCurrentUrlBase();
				}
			}
	  }
	 if($count>0) $flag=1;
	 if ($flag==1)
		$this->view->paginator = Bloomfi_Paginator::factory($customers,$page,$count);

	 $this->_session->sql=$data_bundle['sql'];
	 $this->_session->indexUrl = $url;
	 $this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
	 $this->_session->state=0;
	 $this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex,'not');
	 $this->view->location = $element->createSelectDb("location",$locations,'LOCATION_ID','LOCATION_NAME', $location,'not',null,' width=15');

	 unset($labels,$message,$element);
    }

	public function getCustomerTableRequiredData(&$label)
	{
		$data['tableHeaders'] = array($label['id'],$label['name'],$label['empId'],$label['age'],$label['sex'], $label['location'],$label['description'],$label['entrydt']);
		$data['tableSQLColumns'] = array('CUSTOMER_ID','ENTITY_NAME','EMPLOYEE_CODE','AGE','SEX','LOCATION_ID', 'ENTITY_DESC', 'CUSTOMER_ENTRY_DATE');
		return $data;
	}

	function adduserAction()
	{
		$this->_session->actionHelp=false;
		$this->view->url=$this->_session->indexUrl;
		$this->_session->controller='customer';
		$this->view->title = "This is User add page";
		$message= new modules_ref_messages_message;
	    $this->view->confirmMsg = $message->getRefCustomerMessages('dbCheckError');
		$labels=new modules_ref_labels_label;
		$element=new Bloomfi_App_UHtmlElement;
		$this->_lib=new Bloomfi_App_Ulibrary;
		$this->view->viewlabels=$labels->getCustomerViewLabels('adduser');
		$this->view->formLabel=$labels->getCustomerFormLabels('addcustomer');
		$location = $this->view->defaultValues['location'];
		$locations=$this->_refModel->getDivisionsByState($location);
		$this->view->appdate=date("Y-m-d");
		$sex=$e_id=$loc_id=$cust_img=$cssId=$s_id=null;

		if ( $this->getRequest()->isPost()  )
		{
			    $age_limits = $this->_refModel->getCustomerAgeLimitQuery();
				$customer_id=strtoupper(trim($this->getRequest()->getPost('custId')));
				$cssId=strtoupper(trim($this->getRequest()->getPost('cssId')));
				$sex=trim($this->getRequest()->getPost('sex'));
				$loc_id=trim($this->getRequest()->getPost('location'));
				$astemp=strtoupper(trim($this->getRequest()->getPost('astemp')));
				$nm=strtoupper(trim($this->getRequest()->getPost('name')));
				$age=trim($this->getRequest()->getPost('age'));
				$addr=strtoupper(trim($this->getRequest()->getPost('address')));
				$appdate=trim($this->getRequest()->getPost('appdate'));
				$description=trim($this->getRequest()->getPost('description'));
				$s_id=strtoupper(trim($this->getRequest()->getPost('scheme')));
				$upload = new Zend_File_Transfer_Adapter_Http();
				try {
				 $upload->receive();
				} catch (Zend_File_Transfer_Exception $e) {
				$e->getMessage();
				 }
				$image_filename = $upload->getFileName('file');

				//FORM VALIDATION---------
				$message= new modules_ref_messages_message;
				$insert_msg=$message->getRefCustomerMessages('dbEntry');
				$check=null;
				$msg=$element->checkElementSpace($this->view->formLabel['customerId'],$customer_id,50,1);
				if($msg)$check['customerId']=$msg;
				else{
					$result=$this->_refModel->getCustomerQuery($customer_id);
					if($result)
						$check['customerId']=str_replace('@VAR1@',$customer_id,$insert_msg['duplicateCustId']);
				}
				$msg=$element->checkElement($this->view->formLabel['cssId'],$nm,50,1);
				if($msg)$check['cssId']=$msg;
				$msg=$element->checkElementAlpha($this->view->formLabel['name'],$nm,50,3);
				if($msg)$check['name']=$msg;
				if($age) {
				$msg=$element->checkElementNum($this->view->formLabel['age'],$age,2,1);
				if($msg)$check['age']=$msg; }
				else
					$age = (int)$age_limits[0]->VALUE_NAME;

				//----Select option validation modified --------------------------------
// isExist() function replaced by checkElementSelect() function

				$msg=$element->checkElementSelect('default',$this->view->formLabel['sex'],$sex);
				if($msg)$check['sex']=$msg;

				$msg=$element->checkElementSelect('default',$this->view->formLabel['location'],$loc_id);
				if($msg)$check['location']=$msg;

				$msg=$element->checkElement($this->view->formLabel['addr'],$addr,70,1);
				if($msg)$check['address']=$msg;
				$msg=$element->checkElement($this->view->formLabel['astemp'],$astemp,50,2);
				if($msg)$check['astemp']=$msg;
				else {
				$emp_values=explode(',',$astemp);
				$e_id=trim($emp_values[0]);
				$e_id_result=$this->_refModel->isEmployeeIdQuery($e_id);
				if(!$e_id_result)
					$check['emp']='"'.$this->view->formLabel['astemp'].'" '.$insert_msg['associateEmp'];
				}
				if(empty($s_id))$s_id=null;
				$msg=$element->checkElementDate($this->view->formLabel['appldt'],$appdate);
				if($msg)$check['app_date']=$msg;
//---------------------------------------------------------------------------
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
					$path=ROOT_DIR."/images/entity/customer";
					$static=$this->_refModel->getAllCustStaticValQuery();
					$prefix=$this->_refModel->getCustomerPrePostQuery();
					//$this->_refModel->startProcessing();
					//$allow=$this->_refModel->waitAndAllow('DB');
					//$this->_refModel->endProcessing();
                                        $allow=1;
					if($allow==1) {
						$this->_refModel->startTransaction();
						$this->_refModel->insertRowInEntityTblDML();
						$max_id=$this->_refModel->getLastInsertedId();
						//$this->_refModel->releaseLock('DB');
						$entity_id = $customer_id;
						$entity_unique_id = $prefix[0]->PREFIX_VALUE.$max_id->ID;
						$addr_id = $prefix[2]->PREFIX_VALUE.$max_id->ID;
						$age=(int)$age;
						$creation_date=date("Y-m-d H:m:s");
						if($image_filename)
						$cust_img=$max_id->ID.".jpg";
						$datas_ordered_1 = array( $entity_id, $static[0]->VALUE_NAME, $e_id, $description, $nm, $age, $sex, $customer_id, $entity_unique_id, $appdate, $loc_id, $addr_id, $creation_date, $cust_img,$cssId,$s_id,$max_id->ID);
						$datas_ordered_2 = array( $addr_id, $addr );
					//	die;
						$result1=$this->_refModel->updateInsertedCustomerDML($datas_ordered_1);
						$result2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
						if($result1!=null && $result2!=null){
							$this->_refModel->commitTransaction();
							if($image_filename)
								$this->_lib->imageUpload($image_filename,$cust_img,$path,
								$this->_imageHeight,$this->_imageWidth);
							$this->view->textSuccess=$insert_msg['success'];
							$this->view->insert=1;
							$nm=$age=$addr=$astemp=$description=$sex=$loc_id=$customer_id=$cssId=null;
							$appdate=$this->view->appdate;
						}
						else {
							$error['error']=$insert_msg['fail'];
							$this->view->textErrors = $error;
						}
					 }
					else{
						$this->view->textInfo= "Unable to execute your request. Entity table is busy with another process in Database. Please re-submit the form. ".$this->_refModel->printTotalProcessingTime(false);
					 }
				 }
				else{
					$this->view->textErrors = $check;
				 }
				$this->view->name = $nm;
				$this->view->age = $age;
				$this->view->address = $addr;
				$this->view->astemp =$astemp ;
				$this->view->appdate =$appdate ;
				$this->view->desc =$description ;
				$this->view->custId=$customer_id;
				$this->view->cssId=$cssId;
		}

		$genders=$this->_refModel->getAllGenderTypesQuery();
		$locations = $this->_refModel->getAllTrnLocations();
		$this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex);
		$this->view->location = $element->createSelectDb("location",$locations,'LOCATION_ID','LOCATION_NAME',$loc_id);
		$schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		//print_r($schemes);
		$this->view->scheme = $element->createSelectDb("scheme",$schemes,'SCHEME_ID','SCHEME_NAME',$s_id,'NOT');
		unset($labels,$message,$element,$this->_lib);
	}


	function edituserAction()
	{
		$this->_session->actionHelp=false;
		$this->_session->state=1;
		$this->_session->controller='customer';
		$this->view->url=$this->_session->indexUrl;
		$id = $this->_request->getParam('id');
		$labels=new modules_ref_labels_label;
		$values=new modules_ref_values_value;
		$element=new Bloomfi_App_UHtmlElement;
		$this->view->formLabel=$labels->getCustomerFormLabels('addcustomer');
		$this->view->viewlabels=$labels->getCustomerViewLabels('edituser');
		$this->view->appdate=date("Y-m-d");
		$sex=$e_id=$loc_id=$image_name=$image=null;
		$genders=$this->_refModel->getAllGenderTypesQuery();
		$locations = $this->_refModel->getAllTrnLocations();

		if ( $this->getRequest()->isPost() )
		{
				$age_limits = $this->_refModel->getCustomerAgeLimitQuery();
				$this->_lib=new Bloomfi_App_Ulibrary;
				$custid=trim($this->getRequest()->getPost('custId'));
				$cssId=trim($this->getRequest()->getPost('cssId'));
				$sex=trim($this->getRequest()->getPost('sex'));
				$loc_id=trim($this->getRequest()->getPost('location'));
				$astemp=trim($this->getRequest()->getPost('astemp'));
				$nm=trim($this->getRequest()->getPost('name'));
				$age=trim($this->getRequest()->getPost('age'));
				$addr=trim($this->getRequest()->getPost('address'));
				$appdate=trim($this->getRequest()->getPost('appdate'));
				$description=trim($this->getRequest()->getPost('description'));
				$s_id=trim($this->getRequest()->getPost('scheme'));
				$hidden_params=trim($this->getRequest()->getPost('params'));
				$params=explode('/',$hidden_params);
				$id=$params[0];
				if(!empty($params[1]) )
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
				$validation_msg = $message->getRefCustomerMessages('dbCheckError');
				$check=null;
				$msg=$element->checkElementSpace($this->view->formLabel['customerId'],$custid,50,1);
				if($msg)$check['customerId']=$msg;
				else{
					$result=$this->_refModel->getCustomerQuery($custid);
					if( $result && $result[0]->ID!=$id)
						$check['customerId']=str_replace('@VAR1@',$custid,$validation_msg['duplicateCustId']);
				}
				$msg=$element->checkElement($this->view->formLabel['cssId'],$nm,50,1);
				if($msg)$check['cssId']=$msg;
				$msg=$element->checkElementAlpha($this->view->formLabel['name'],$nm,50,3);
				if($msg)$check['name']=$msg;
				if($age) {
				$msg=$element->checkElementNum($this->view->formLabel['age'],$age,2,1);
				if($msg)$check['age']=$msg; }
				else $age = (int)$age_limits[0]->VALUE_NAME;

				$msg=$element->checkElementSelect('default',$this->view->formLabel['sex'],$sex);
				if($msg)$check['sex']=$msg;

				$msg=$element->checkElementSelect('default',$this->view->formLabel['location'],$loc_id);
				if($msg)$check['location']=$msg;

				$msg=$element->checkElement($this->view->formLabel['addr'],$addr,70,5);
				if($msg)$check['address']=$msg;

				$msg=$element->checkElement($this->view->formLabel['astemp'],$astemp,50,2);
				if($msg)$check['astemp']=$msg;
				else {
				$emp_values=explode(',',$astemp);
				$e_id=trim($emp_values[0]);
				$employee_id=$this->_refModel->isEmployeeIdQuery($e_id);
				if(!$employee_id)
					$check['emp']='"'.$this->view->formLabel['astemp'].'" '.$validation_msg['associateEmp'];
				}
				$msg=$element->checkElementSelect('default',$this->view->formLabel['scheme'],$s_id);
				if($msg)$check['scheme']=$msg;
				$msg=$element->checkElementDate($this->view->formLabel['appldt'],$appdate);
				if($msg)$check['app_date']=$msg;

				if($image_filename) {
				$exts=array('jpg','bmp','png');
				$file_ext=$element->stripExtension($image_filename);
				if(!in_array($file_ext,$exts)){
					$check['exts']='Please select the file for "'.$this->view->formLabel['image'].'" with extention jpg/bmp/png';
				}}

				if( $check)
			     if($image_filename)
					$check['image']="Please reselect the image file";

				//----------------

				if(!$check)
				 {
					$path=ROOT_DIR."/images/entity/customer";
					$this->_temp=$id.".jpg";
					if(($this->_temp!=$image && $image_filename) || $this->_temp==$image)
						$image_name=$this->_temp;
					$datas_ordered_1 = array($custid, $e_id, $description, $nm, $age, $sex, $appdate, $description, $loc_id, $image_name, $cssId, $s_id, $id);
					$datas_ordered_2 = array($addr,$custid);
				    $result1=$this->_refModel->updateCustomerDML($datas_ordered_1);
					$result2=$this->_refModel->updateCustomerAddrDML($datas_ordered_2);
					$msg=$message->getRefCustomerMessages('dbUpdate');
					if($result1!=null && $result2!=null){
						if($image_filename)
						$this->_lib->imageUpload($image_filename, $image_name, $path, $this->_imageHeight,$this->_imageWidth);
						$this->view->textSuccess=$msg['success'];
						$this->view->update=2; }
					else{
						$error['error']=$msg['fail'];
						$this->view->textErrors = $error; }
				 }
				else
				 {
					$this->view->id = $id;
					$this->view->name = $nm;
					$this->view->age = $age;
					$this->view->address = $addr;
					$this->view->astemp =$astemp ;
					$this->view->appdate =$appdate ;
					$this->view->desc =$description ;
					$this->view->image=$image;
					$this->view->custId=$custid;
					$this->view->cssId=$cssId;

					$this->view->textErrors = $check;
				 }
		}
		else
		{
			$customer=$this->_refModel->getCustomerInfoByIdQuery($id);
			$this->view->id = $customer[0]->ID;
			$this->view->custId = $customer[0]->CUSTOMER_ID;
			$this->view->name = $customer[0]->NAME;
			$this->view->age = $customer[0]->AGE;
			$this->view->address = $customer[0]->ADDRESS;
			if($customer[0]->EMPLOYEE_ID)
			$this->view->astemp =$customer[0]->EMPLOYEE_ID." , ".$customer[0]->EMPLOYEE_NAME;
			$this->view->appdate =$customer[0]->CUSTOMER_ENTRY_DATE;
			$this->view->desc =$customer[0]->ENTITY_DESC;
			$this->view->cssId=$customer[0]->CUSTOMER_UNIQUE_ID;
			$sex=$customer[0]->SEX;
			$loc_id=$customer[0]->LOCATION_ID;
			$s_id=$customer[0]->SCHEME_ID;
			if(!empty($customer[0]->IMAGE)) {
			$this->view->image=$customer[0]->IMAGE;
			}
			else{
			  if($sex==$genders[1]->VALUE_ID) $this->view->image='FEMALE.jpg';
			  if($sex==$genders[0]->VALUE_ID) $this->view->image='MALE.jpg';
			}
		}
		$this->view->sex = $element->createSelectDb("sex",$genders,'VALUE_ID','VALUE_NAME',$sex,null,null,'id="sex"');
		$this->view->location = $element->createSelectDb("location",$locations,'LOCATION_ID','LOCATION_NAME',$loc_id,null,null ,'id="location"');
		$schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		//print_r($schemes);
		$this->view->scheme = $element->createSelectDb("scheme",$schemes,'SCHEME_ID','SCHEME_NAME',$s_id,'NOT');

		unset($labels,$message,$element,$this->_lib);
	}

	public function customerexcelAction()
	{
		$labels=new modules_ref_labels_label;
		$this->view->customerHeader=$labels->getCustomerTableLabels('customer');

		$customer_name = $this->_request->getParam('nm');
		$customer_code =  $this->_request->getParam('id');
		$temp = $this->_request->getParam('sx');
		$sex=$temp[0];
		$entry_date =  $this->_request->getParam('edt');
		$location =  $this->_request->getParam('loc');
		$employee_code =  $this->_request->getParam('eid');
		$customer_data = array( $customer_code,$customer_name,$sex,$entry_date,$location,$employee_code );
		$data_bundle = $this->getDataForXls($this->_refModel,'getAllCustInfoBySrchQuery',$customer_data);
		$this->view->xlsResult=$data_bundle['result'];
		unset($labels);
	}

	public function organizeSearchUrlParams($urlParams)
	{
		$params=null;
		$i=1;
		$array=explode('/',$urlParams);
		foreach($array as $key=>$value){
			if($key%2==0 && $key!=0){
				$params=$params.'/param'.$i.'/'.$value;
				$i++;
			}
		}
		return $params;
	}

	public function suggestcustnmAction()
	{
		$customer_name = trim(strtolower($this->_request->getParam('q')));
		$this->view->customer = $this->_refModel->getCustomersNmQuery($customer_name);
		$this->_helper->layout->disableLayout();
	}

	public function suggestcustidAction()
	{
		$customer_id = trim(strtolower($this->_request->getParam('q')));
		$this->view->customer = $this->_refModel->getCustomersIdQuery($customer_id);
		$this->_helper->layout->disableLayout();
	}

	public function suggestentAction()
	{
		$ent = trim(strtolower($this->_request->getParam('q')));
		$this->view->entities = $this->_refModel->getEntityQuery($ent);
		$this->_helper->layout->disableLayout();
	}

	public function suggestcssidAction()
	{
		$ent = trim(strtolower($this->_request->getParam('q')));
		$this->view->entities = $this->_refModel->getEntityCssIdQuery($ent);
		$this->_helper->layout->disableLayout();
	}

	public function custchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$data=trim($this->_request->getParam('q',null));
		$param=explode('/',$data);
		
		if(!empty($param[0])){	
		if(isset($param[1]))
			$this->view->result=$this->_refModel->isCustomerIdExceptMeQuery($param);
		else $this->view->result=$this->_refModel->isCustomerIdQuery($param[0]);}
		else $this->view->result=1;
	}

}
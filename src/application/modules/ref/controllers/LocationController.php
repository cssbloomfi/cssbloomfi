<?php

class Ref_LocationController extends modules_ref_controllers_RefController
{
	protected $_refModel;
	protected $_session;

	function preDispatch()
	{
		$this->_session=$this->_initialize();
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->_refModel = new modules_ref_models_refAccessQuery;
	}

	function indexAction()
	{
		$labels=new modules_ref_labels_label;
		$element=new Bloomfi_App_UHtmlElement;
		$message= new modules_ref_messages_message;
		$this->view->locationSearchForm = $labels->getlocFormLabels('searchLocation');
		$this->view->locationTableHeaders = $labels->getLocationTableLabels('location');
		$this->view->confirmMsg = $message->getRefLocationMessages('confirm');
		$this->view->viewlabels=$labels->getLocationViewLabels('index');
		$this->view->links=$labels->getAllLinkLabels('locIndex');
		$levels=$this->_refModel->getAllLocationLevelsQuery();
		$types=$this->_refModel->getAllLocationTypesQuery();
		$child=$request=$flag=$search_url_params=$url=$location_type=$location_level=$parent_location=null;
		$configValues=$this->_refConfig->getConfigValues('locationIndexPagination');
	    $rows=$configValues['rows'];
		$page=$this->_request->getParam('page',1);
		Bloomfi_Paginator::initializePaginator($configValues['totalPages'],$rows);
		if($this->_session->state==1 && $this->_session->controller=='location') {
		  $this->_session->state=0;
		  $data_bundle=$this->_refModel->executeSessionSQL($this->_session->sql,"Location Information");
		  $locations = $data_bundle['result'];
		  $url=$this->_session->indexUrl;
		  $count=$this->_session->counter;
		}
		else
		{
			if ( $this->getRequest()->isPost()  )
			{
					$request=$this->getRequest()->getPost('REQUEST');
					if($request=="Search")
					{
						$this->view->search=1;
						$location_name =  trim($this->getRequest()->getPost('loc_name'));
						$parent_location =  trim($this->getRequest()->getPost('parent_loc_name'));
						$location_type =  $this->getRequest()->getPost('loc_type');
						$location_level =  $this->getRequest()->getPost('loc_level');
						$this->view->loc=$location_name;
						$this->view->ploc=$parent_location;
						$this->view->typ=$location_type;
						$this->view->lvl=$location_level;
						$this->view->srch=$page=1;
						$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination();
						$data = array($location_name,$parent_location,$location_type,$location_level);
						$cons_location_data = array_merge((array)$data,(array)$pagination_limits);
						$data_bundle = $this->_refModel->MasterLocationsBySrchQuery($cons_location_data);
						$locations = $data_bundle['result'];
						$count=count($locations);
						if($locations){
							$search_url_params="/index/search/1/loc/$location_name/ploc/$parent_location/typ/$location_type/levl/$location_level/page/$page";

							$this->view->searchparams="/loc/$location_name/ploc/$parent_location/typ/$location_type/levl/$location_level";
							$this->view->arrayparams="$location_name/$parent_location/$location_type/$location_level";
						}
						$url = $this->_refModel->getBaseURL()."/ref/location".$search_url_params;
					}
					if($request=="Delete")
					{
						$validation_msg = $message->getRefLocationMessages('dbCheckError');
						$msg = $message->getRefLocationMessages('dbDelete');
						$id=$this->getRequest()->getPost('locid');
						$seperator=$valid_id=$val_id=$datas=$has_child=$check=$var_msg=null;
						if(!empty($id)){
						 $i=0;
						 foreach($this->getRequest()->getPost('locid') as $id){
							$has_child=$this->_refModel->getLocationIfChildExists($id);
							if($has_child){
							if($has_child[0]->TOTAL_CHILD==1) $var_msg = $validation_msg['child_loc_2nd'];
							else $var_msg = $validation_msg['child_loc_3rd'];
							$check[$id]='"'.$has_child[0]->LOCATION_NAME.'" '.$validation_msg['child_loc_1st'].' '.$has_child[0]->TOTAL_CHILD.' '.$var_msg; }
							if($i==1)
								$seperator=',';
							$val_id=$seperator."'$id'";
							$datas=$datas.$val_id;
							$i++;
						 }
						 if(!$check )
						 {
							$search_params=$this->getRequest()->getPost('params');
							foreach($this->getRequest()->getPost('locid') as $id){
							$valid_id=$this->_refModel->getMasterLocationsbyLocIdQuery($id);
							if($valid_id) break;}
							if($valid_id){
								 $result=$this->_refModel->deleteLocationDML($datas);
								 if($result!=null){
									$this->view->textSuccess=$msg['success'];
									$this->view->delete=3; }
								 else{
									$error['error']=$msg['fail'];
									$this->view->textErrors = $error; }
							}
							else{
								$error['error']=$msg['fail'];
								$this->view->textErrors = $error;
							}
						}
						else
							$this->view->textErrors = $check;
					  }
					  $pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					  if(trim(join('',explode('/',$search_params))) != ''){
						  $location_name=$parent_location=$location_level=$location_type=null;
						$s_param=explode('/',$search_params);
						if( isset($s_param[0]) ) $location_name =$s_param[0] ;
						if( isset($s_param[1]) ) $parent_location =$s_param[1] ;
						if( isset($s_param[2]) ) $location_type =$s_param[2] ;
						if( isset($s_param[3]) ) $location_level =$s_param[3] ;
						$data = array($location_name,$parent_location,$location_type,$location_level);
						$cons_loc_data = array_merge((array)$data,(array)$pagination_limits);
						$data_bundle = $this->_refModel->MasterLocationsBySrchQuery($cons_loc_data);
						$locations = $data_bundle['result'];
						$count=count($locations);
						if($locations) {
							$this->view->loc=$location_name;
							$this->view->ploc=$parent_location;
							$this->view->typ=$location_type;
							$this->view->lvl=$location_level;
							$this->view->srch=1;		$search_url_params="/index/search/1/loc/$location_name/ploc/$parent_location/typ/$location_type/levl/$location_level/page/$page";
							$this->view->searchparams="/loc/$location_name/ploc/$parent_location/typ/$location_type/levl/$location_level";
							$this->view->arrayparams="$location_name/$parent_location/$location_type/$location_level";
						 }
						 $url = $this->_refModel->getBaseURL()."/ref/location".$search_url_params;
					   }
					   else{
						$data_bundle = $this->_refModel->getMasterLocationsQuery($pagination_limits);
					    $locations = $data_bundle['result'];
						$count=count($locations);
						$url=$this->_refModel->getCurrentPageURL();
					   }

					  $lower_limit=Bloomfi_Paginator::getLastLowerStartLimit();
					  if($lower_limit>=$rows && $count==0)
							$count=1;

				 } //- Delete End

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
					$this->view->xlsResults= $lib->createXlsUrlOnResultArray($this->_refModel,'MasterLocationsBySrchQuery', '/ref/location/locationexcel'.$srchParams, 'Location Xls File',
					$arrayParams);
					//print_r($arrayParams);
					$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
					$cons_loc_data = array_merge((array)$arrayParams,(array)$pagination_limits);
					$data_bundle = $this->_refModel->MasterLocationsBySrchQuery($cons_loc_data);
					$locations = $data_bundle['result'];
					$count=count($locations);
					if($locations) {
						$this->view->loc=$arrayParams[0];
						$this->view->ploc=$arrayParams[1];
						$this->view->typ=$arrayParams[2];
						$this->view->lvl=$arrayParams[3];
						if($search==1) {
						$this->view->srch=1;		$search_url_params="/index/search/1/loc/".$this->view->loc."/ploc/".$this->view->ploc."/typ/".$this->view->typ."/levl/".$this->view->lvl."/page/$page"; }
					 }
					 $url = $this->_refModel->getBaseURL()."/ref/location".$search_url_params;
					//echo $url;

				}
			} //- Post end
			else
			{
				$pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
				$search=$this->_getParam('search');
				if($search)
				{
					$location_name = $this->_getParam('loc',null);
					$parent_location = $this->_getParam('ploc',null);
					$location_type =  $this->_getParam('typ',null);
					$location_level = $this->_getParam('levl',null);
					$data = array($location_name,$parent_location,$location_type,$location_level);
					$cons_loc_data = array_merge((array)$data,(array)$pagination_limits);
					$data_bundle = $this->_refModel->MasterLocationsBySrchQuery($cons_loc_data);
					$locations = $data_bundle['result'];
					$count=count($locations);
					if($locations){
						$this->view->loc=$location_name;
						$this->view->ploc=$parent_location;
						$this->view->typ=$location_type;
						$this->view->lvl=$location_level;
						$this->view->srch=1;				$search_url_params="/index/search/1/loc/$location_name/ploc/$parent_location/typ/$location_type/levl/$location_level/page/$page";
					}
					$url = $this->_refModel->getBaseURL()."/ref/location".$search_url_params;
				}
				else{
					$data_bundle = $this->_refModel->getMasterLocationsQuery($pagination_limits);
					$locations = $data_bundle['result'];
					$count=count($locations);
					$url=$this->_refModel->getCurrentUrlBase();
				}
			}
		}
		if($count>0) $flag=1;

		if ( $flag==1 )
			$this->view->paginator = Bloomfi_Paginator::factory($locations,$page,$count);

		$this->_session->sql=$data_bundle['sql'];
		$this->_session->indexUrl = $url;
		$this->_session->counter=$count + Bloomfi_Paginator::getLastLowerStartLimit();
		$this->_session->state=0;
		$this->view->location_levels =
			$element->createSelectDb("loc_level",$levels,'KEY_NAME','VALUE_NAME',$location_level,'NOT',null,null);
		$this->view->location_types =
			$element->createSelectDb("loc_type",$types,'KEY_NAME','VALUE_NAME',$location_type,'NOT',null,null);
	}

	 function addAction()
	{
		$this->_session->controller='location';
		$this->view->url=$this->_session->indexUrl;
		$values=new modules_ref_values_value;
		$labels=new modules_ref_labels_label;
		$element=new Bloomfi_App_UHtmlElement;
		$type=$check=null;
		$this->view->locationForm = $labels->getlocFormLabels('addLocation');
		$message= new modules_ref_messages_message;
		$insert_msg = $message->getRefLocationMessages('dbEntry');
		$validation_msg = $message->getRefLocationMessages('dbCheckError');
		
		if ( $this->getRequest()->isPost() )
		{
			$parent_loc = $this->getRequest()->getPost('parent_loc');
			$loc = $this->getRequest()->getPost('location_id');
			$locNm = $this->getRequest()->getPost('location_nm');
			$type=$this->getRequest()->getPost('location_type');
			$desc = $this->getRequest()->getPost('description');

			
			$msg=$element->checkElement($this->view->locationForm['locationId'],$loc,40,3);
			if($msg)$check['locationId']=$msg;
			else{
				$result=$this->_refModel->isLocationIdQuery($loc);
				if($result) $check['locationId']=str_replace('@VAR1@',$loc,$validation_msg['locExist']);
			}

			$msg=$element->checkElement($this->view->locationForm['locationName'],$locNm,40,3);
			if($msg)$check['locationName']=$msg;

			$msg=$element->checkElementSelect('default',$this->view->locationForm['type'],$type);
				if($msg)$check['location_type']=$msg;

			$msg=$element->checkElement($this->view->locationForm['parent_location'],$parent_loc,40,3);
			if($msg)$check['parent_location']=$msg;

			if(!$check ) {
				$this->_refModel = new modules_ref_models_refAccessQuery;
				$location=$this->_refModel->getLocationByNmQuery($parent_loc);
				if($location){
					$check_child=$location[0]->LOCATION_TYPE;
					if($check_child <= $type) {
					  $datas=array($location[0]->LOCATION_ID,$loc);
					  $loc_result =$this->_refModel->getLocationNmByPrntQuery($datas);
					  if($loc_result)
						$check['location'] = '"'.$loc.'" '.$validation_msg['location'] . '" '.$parent_loc .'"';}
					else{
	                   $check['type'] = '"'.$this->view->locationForm['type'].'" '.$validation_msg['type'];
					}
				}
				else{
					$check['parent_location'] =  '"'.$parent_loc.'" '.$validation_msg['parent_location'];
				}
				if(!$check)
					{
						//$this->_refModel->startProcessing();
						//$allow=$this->_refModel->waitAndAllow('DB');
						//$this->_refModel->endProcessing();
						$allow=1;
						if($allow==1) {
							$this->_refModel->startTransaction();
							$this->_refModel->insertRowInLocationTblDML();
							$max_id = $this->_refModel->getLastInsertedId();
							//$this->_refModel->releaseLock('DB');
							$addr_id=$max_id->ID;
							$level=$location[0]->LOCATION_LEVEL + 1;
							$datas=array( $loc,$locNm,$location[0]->LOCATION_ID,$loc,$desc,$type,$level
							,$addr_id,$max_id->ID);
							$result1=$this->_refModel->updateInsertedLocationDML($datas);
							if($result1!=null){
								$this->_refModel->commitTransaction();
								$this->view->textSuccess=$insert_msg['success'];
								$this->view->insert=1;
								$parent_loc=$loc=$desc=$type=null;
							}
							else
								$this->view->textErrors = $insert_msg['fail'];
						}
						else
							$this->view->textInfo= "Unable to execute your request. Location table is busy with another process in Database. Please re-submit the form. ".printTotalProcessingTime('false');
					}
				else
					 $this->view->textErrors = $check;
			}
			else
			{
				
				$this->view->textErrors = $check;
			}

			$this->view->parent_loc=$parent_loc;
			$this->view->locNm=$locNm;
			$this->view->loc=$loc;
			$this->view->desc=$desc;
		}

		$types=$this->_refModel->getAllLocationTypesQuery();
		$this->view->location_types =
			$element->createSelectDb("location_type",$types,'KEY_NAME','VALUE_NAME',$type,null,null,null);
	}

	 function editAction()
	{
		$this->_session->state=1;
		$this->_session->controller='location';
		$this->view->url=$this->_session->indexUrl;
		$loc_id = $this->_request->getParam('id');
		$labels=new modules_ref_labels_label;
		$element=new Bloomfi_App_UHtmlElement;
		$this->view->locationForm = $labels->getlocFormLabels('addLocation');
		$check=$select_check=$loc_type=null;
		if ( $this->getRequest()->isPost() )
		{
			$id=$this->getRequest()->getPost('id');
			$parent_loc =$this->getRequest()->getPost('parent_loc');
			$loc =$this->getRequest()->getPost('location_name');
			$locId =$this->getRequest()->getPost('location_id');
			$type=$this->getRequest()->getPost('location_type');
			$desc = $this->getRequest()->getPost('description');
			$this->view->page = $this->getRequest()->getPost('page');
			$msg=$element->checkElement($this->view->locationForm['locationId'],$locId,40,3);
			if($msg)$check['locationId']=$msg;
			else{
				$result=$this->_refModel->isLocationIdExceptMeQuery(array($locId,$id));
				if($result) $check['locationId']=str_replace('@VAR1@',$locId,$validation_msg['locExist']);
			} 
			$msg=$element->checkElement($this->view->locationForm['locationName'],$loc,40,3);
			if($msg)$check['locationName']=$msg;

			$msg=$element->checkElementSelect('default',$this->view->locationForm['type'],$type);
			if($msg)$check['type']=$msg;

			$msg=$element->checkElement($this->view->locationForm['parent_location'],$parent_loc,40,3);
			if($msg)$check['parent_location']=$msg;
			

			if(!$check)
			{
				$this->_refModel = new modules_ref_models_refAccessQuery;
				$message= new modules_ref_messages_message;
				$validation_msg = $message->getRefLocationMessages('dbCheckError');
				$location=$this->_refModel->getLocationByNmQuery($parent_loc);
				if($location){
					$check_child=$location[0]->LOCATION_TYPE;
					if($check_child <= $type) {
					  $datas=array($location[0]->LOCATION_ID,$locId,$id);
					  $loc_result =$this->_refModel->getLocationNmByPrntOnIdExceptMeQuery($datas);
					  if($loc_result)
						$check['location'] = '"'.$locId.'" '.$validation_msg['location'] . '" '.$parent_loc .'"';
					 }
					else{
						$check['type'] = '"'.$this->view->locationForm['type'].'" '.$validation_msg['type'];
					}
				}
				else{
					$check['parent_location'] =  '"'.$parent_loc.'" '.$validation_msg['parent_location'];
				}
				if(!$check)
					{
						$location=$this->_refModel->getLocationByNmQuery($parent_loc);
						$level=$location[0]->LOCATION_LEVEL + 1;
						$datas=array( $locId,$loc, $location[0]->LOCATION_ID,$desc,$type,$level,$id);
						$result=$this->_refModel->updateLocationDML($datas);
						$msg = $message->getRefLocationMessages('dbUpdate');
						if($result!=null){
						$this->view->textSuccess=$msg['success'];
						$this->view->update=2; }
					else{
						$error['error']=$msg['fail'];
						$this->view->textErrors = $error; }
					}
				else
					{
					  $this->view->id = $id;
					  $this->view->parent_loc=$parent_loc;
					  $this->view->loc=$loc;
					  $this->view->desc=$desc;
					  $loc_type=$type;
					  $this->view->textErrors = $check;
					}
			}
			else
			{
				$this->view->id = $id;
				$this->view->parent_loc=$parent_loc;
				$this->view->loc=$loc;
				$this->view->desc=$desc;
				$loc_type=$type;
				$this->view->textErrors = $check;
			}
		}
		else
		{
			$locations = $this->_refModel->getLocationInfobyIdQuery($loc_id);
			$this->view->id = $loc_id;
			$this->view->locId= $locations[0]->LOCATION_ID;
			$this->view->loc = $locations[0]->LOCATION_NAME;
			$this->view->parent_loc=$locations[0]->PARENT_LOCATION_NAME;
			$this->view->desc=$locations[0]->LOCATION_DESC;
			$loc_type=$locations[0]->LOCATION_TYPE;
		}

		$types=$this->_refModel->getAllLocationTypesQuery();
		$this->view->location_types = 	$element->createSelectDb("location_type",$types,'KEY_NAME','VALUE_NAME',$loc_type,null,null,' id="type"');
	}


	public function suggestlocAction()
	{
		$id=$this->_request->getParam('id');
		$loc = strtolower($this->_request->getParam('q'));
		$this->view->locations = $this->_refModel->getLocationQuery($loc);
		if(!empty($id)) $this->view->id=$id;
		$this->_helper->layout->disableLayout();
	}

	public function suggestloc1Action()
	{
		$id=$this->_request->getParam('id');
		$loc = strtolower($this->_request->getParam('q'));
		$this->view->locations = $this->_refModel->getLocation1Query($loc);
		if(!empty($id)) $this->view->id=$id;
		$this->_helper->layout->disableLayout();
	}

	public function suggestcountryAction()
	{
		$loc = strtolower($this->_request->getParam('q'));
		if (!$loc) return;
		$this->view->countries = $this->_refModel->getCountryQuery($loc);
		$this->_helper->layout->disableLayout();
	}

	public function locchkajaxAction()
	{
		$this->_helper->layout->disableLayout();
		$data=trim($this->_request->getParam('q',null));
		$param=explode('/',$data);
		if(isset($param[1]))
			$this->view->result=$this->_refModel->isLocationIdExceptMeQuery($param);
		else
		$this->view->result=$this->_refModel->isLocationIdQuery($param[0]);
	}

	public function locationexcelAction()
	{
		$labels=new modules_ref_labels_label;
		$this->view->locationHeader=$labels->getLocationTableLabels('location');

		$loc = $this->_request->getParam('loc');
		$ploc =  $this->_request->getParam('ploc');
		$typ =  $this->_request->getParam('typ');
		$levl =  $this->_request->getParam('levl');
		$location_data = array( $loc,$ploc,$typ,$levl );
		$data_bundle = $this->getDataForXls($this->_refModel,'MasterLocationsBySrchQuery',$location_data);

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
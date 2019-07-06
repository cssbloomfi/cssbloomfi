<?php
class Ref_MultilocationController extends modules_ref_controllers_RefController
{
	protected $_lib;
	protected $_imageWidth = 100;
	protected $_imageHeight = 100;
	protected $_temp;
	protected $_session;
	protected $_refModel;
	protected $_refConfig;
	protected $_maxRows=30;
	protected $_defaultRows=10;
	protected $_startId=1;
	protected $_resultLabels=null;
	protected $_fileName='Inserted-Projects';

    function preDispatch(){  
		$this->_session=$this->_initialize();
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->view->acl=$this->_session->acl;
		$this->_session->xlsResult=null;
		$this->_session->xlsHeader=null;
	}

	function postDispatch(){
		$this->_refModel->destroy();
		unset($this->_refModel);
	}

    function insertlocationAction()
	{ 
		$successResults=$msg=$total_scheme_cust=$insertMsg=$msg_status=$validation_msg=null;
		$no=0;

		$element=new Bloomfi_App_UHtmlElement;
		$this->view->rows=$this->_defaultRows;
		$labels=new modules_ref_labels_label;
		$this->view->formLabels=$labels->getRefMultiLocationFormLabels('addScheme');
		$this->view->numRowsLabel=$labels->getRefMultiLocationFormLabels('row_nums');
		$this->view->statusLabels=$labels->getRefMultiSchemeFormLabels('status');
		$message=new modules_ref_messages_message;
		$this->insertMsg=$message->getRefMultiLocationMessages('error');
		$this->statusMsg=$message->getRefMultiLocationMessages('statusMsg');
		$this->_resultLabels=$this->view->resultLabels=$labels->getRefMultiLocationFormLabels('result');
		
		$this->view->locationTypes=$this->_refModel->getAllLocationTypesQuery();
		
		$ele=$this->getRequest()->getPost();
          
		if($this->getRequest()->getPost('rows') || $this->getRequest()->getPost('rows1'))
		{
			$row=$this->getRequest()->getPost('rows');
			if($row>$this->_maxRows){
				$maxRowInput=str_replace('@VAR1@',$this->_maxRows,$this->insertMsg['maxRow']);
				$msg['error']=$maxRowInput;
				$row=null;
			}
			$row1=$this->getRequest()->getPost('rows1');
		}

		if(!empty($row))
		{
			$this->view->rows=$row;
		}elseif(!empty($row1))
		{
			$this->view->rows=$row1;
		} 

		if($this->getRequest()->getPost('save'))
		{

			for($i=0;$i<$this->view->rows;$i++)
			{
				//echo "[$i] => ".$this->view->rows."<br>";
				if(isset($ele['locId'][$i]) && !empty($ele['locId'][$i]))
					$locId[$i]=$ele['locId'][$i];
				else $locId[$i]=null;
				if(isset($ele['locName'][$i]) && !empty($ele['locName'][$i]))
					$locNm[$i]=$ele['locName'][$i];
				else $locNm[$i]=null;
				if(isset($ele['locType'][$i]) && !empty($ele['locType'][$i]))
					$locType[$i]=$ele['locType'][$i];
				else $locType[$i]=null;
				if(isset($ele['parentLoc'][$i]) && !empty($ele['parentLoc'][$i]))
					$parentLoc[$i]=$ele['parentLoc'][$i];
				else $parentLoc[$i]=null;
				if(isset($ele['desc'][$i]) && !empty($ele['desc'][$i]))
					$desc[$i]=$ele['desc'][$i];
				else $desc[$i]=null;
			
				
				
				$loc_id=$locId[$i];
				$loc_nm=$locNm[$i];
				$loc_type=$locType[$i];
				$parent_loc=$parentLoc[$i];
				$description=$desc[$i];
				$location=$this->_refModel->getLocationByNmQuery($parent_loc);
				$data=array('locId'=>$loc_id,'locName'=>$loc_nm,'locType'=>$loc_type,'parentLoc'=>$parent_loc,'desc'=>$description);	

				if($location){
					$check_child=$location[0]->LOCATION_TYPE;
					if($check_child <= $loc_type) {
					  $datas=array($location[0]->LOCATION_ID,$loc_id);
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
					
				$check=$this->validate($data);
				
			//	print_r($check);
				if(!$check)
				 {
					//$this->_refModel->startProcessing();
					//$allow=$this->_refModel->waitAndAllow('LOCATION');
					//$this->_refModel->endProcessing();
					$location=$this->_refModel->getLocationByNmQuery($parent_loc);
					$allow=1;
					if($allow==1) {
						$this->_refModel->startTransaction();
						$this->_refModel->insertRowInLocationTblDML();
						$max_id = $this->_refModel->getLastInsertedId();
						//$this->_refModel->releaseLock('LOCATION');
						$addr_id=$max_id->ID;
						$level=$location[0]->LOCATION_LEVEL + 1;
						$datas=array( $loc_id,$loc_nm,$location[0]->LOCATION_ID,$loc_id,$description,$loc_type,$level
						,$addr_id,$max_id->ID);
						$result1=$this->_refModel->updateInsertedLocationDML($datas);
					
					
					if($result1!=null){
						$msg_status[$i+1]['error']['Error']=$this->statusMsg['notFound'];
						$msg_status[$i+1]['status']=$this->statusMsg['success'];
						$msg_status[$i+1]['skip']=false;
						$this->_refModel->commitTransaction();
						$successResults[$no++]=array('locId'=>$loc_id,'locName'=>$loc_nm,
							'locType'=>$loc_type,'parentLoc'=>$parent_loc,'desc'=>$description);

						//$nm=$age=$addr=$astemp=$description=$sex=$loc_id=$customer_id=$cssId=null;
					}
					else {
						$this->view->textErrors = $this->statusMsg['notInsert'];
					}}
				 }
				else{
					$msg_status[$i+1]['error']=$check;
					$msg_status[$i+1]['status']=$this->statusMsg['failed'];
					if($this->_skip==true) $msg_status[$i+1]['skip']=true;
					else $msg_status[$i+1]['skip']=false;
				 }
			}

			$this->view->locId=$locId;
			$this->view->locNm=$locNm;
			$this->view->locType=$locType;
			$this->view->parentLoc=$parentLoc;
			$this->view->desc=$desc;
			

			$this->view->validationMsg=$msg_status;
			$this->view->sucsessfulEntries=$successResults;
			$this->_session->xlsResult=$successResults;
			$this->_session->xlsHeader=$this->_getMultiLocationInsertedResultsHeader();
			$this->_session->fileName=$this->_fileName;

		}else{
			$o_locId=$o_locNm=$o_locType=$o_parentLoc=$o_desc=null;

			$copy=$this->getRequest()->getPost('copyRow');
			$ele=$this->getRequest()->getPost();
			if($copy!=$this->_maxRows)
			{
				if($this->view->rows==$copy)
						$this->view->rows++;

				for($i=0;$i<$this->view->rows;$i++)
					{
						
						if($i!=$copy)
						{
							
							if(isset($ele['locId'][$i]) && !empty($ele['locId'][$i]))
								$locId[$i]=$ele['locId'][$i];
							else $locId[$i]=null;
							if(isset($ele['locName'][$i]) && !empty($ele['locName'][$i]))
								$locNm[$i]=$ele['locName'][$i];
							else $locNm[$i]=null;
							if(isset($ele['locType'][$i]) && !empty($ele['locType'][$i]))
								$locType[$i]=$ele['locType'][$i];
							else $locType[$i]=null;
							if(isset($ele['parentLoc'][$i]) && !empty($ele['parentLoc'][$i]))
								$parentLoc[$i]=$ele['parentLoc'][$i];
							else $parentLoc[$i]=null;
							if(isset($ele['desc'][$i]) && !empty($ele['desc'][$i]))
								$desc[$i]=$ele['desc'][$i];
							else $desc[$i]=null;	
						}else
						{
							$locId[$i]=$o_locId;
							$locNm[$i]=$o_locNm;
							$locType[$i]=$o_locType;
							$parentLoc[$i]=$o_parentLoc;
							$desc[$i]=$o_desc;
						}

						if($i==$copy-1)
						{
							$o_locId=$locId[$i];
							$o_locNm=$locNm[$i];
							$o_locType=$locType[$i];
							$o_parentLoc=$parentLoc[$i];
							$o_desc=$desc[$i];
						}
					}
				$this->view->locId=$locId;
				$this->view->locNm=$locNm;
				$this->view->locType=$locType;
				$this->view->parentLoc=$parentLoc;
				$this->view->desc=$desc;
				
			}else{
				$msg['error']=$this->statusMsg['notCopy'];
			}
		}

		$this->view->textErrors = $msg;
	}

	protected function _getMultiLocationInsertedResultsHeader()
	{
		$lbl=$this->_resultLabels;
		//print_r($lbl);
		//die;
		$header=array($lbl['locationCode'],$lbl['locationName'],$lbl['type'],$lbl['parentLoc'],$lbl['desc']);
		return $header;
	}

	/*
	 Scheme Validation
	*/
	protected function validate($data,$row=null)
	{
		$check=$msg=$res=$current_row=$locationId=$locationName=$locationType=$parentLoc=$descrip=$insert_msg=$valMsg=null;
	
		
		if($row)$current_row="[Row - $row] ";

		$element=new Bloomfi_App_UHtmlElement;
		$validateMsg=new modules_ref_messages_message;
		$this->errorMsg=$validateMsg->getRefMultiCollMessages('ValidateMsg');
	//	print_r($this->errorMsg);
		$this->_skip=false;

		//print_r($data);
		//die; 
		if(isset($data['locId']))
			$locationId = $data['locId']; 
		if(isset($data['locName']))
			$locationName = $data['locName'];
		if(isset($data['locType']))
			$locationType=$data['locType'];
		if(isset($data['parentLoc']))
			$parentLoc=$data['parentLoc'];
		if(isset($data['desc']))
			$descrip=$data['desc'];
	
		if ( empty($locationId) && empty($locationName) && empty($locationType) && empty($parentLoc) &&
			empty($descrip) ) {
			//$msg_status=false;
			$this->_skip=true;
			return array('Error'=>true);
			
		}
		

		//------------------------Collector-----------------------------
		$msg=$element->checkElement($this->view->formLabels['locationCode'],$locationId,40,3);
			if($msg)$check['Location Code']=$msg;
			else{
				$res=$this->_refModel->getLocationIdByLocIdQuery($locationId);
				if($res){
					$check['Location Code']="<b>Location Code</b> alresdy exists.";
				}
			}

			$msg=$element->checkElement($this->view->formLabels['locationName'],$locationName,40,3);
			if($msg)$check['Location Name']=$msg;

			$msg=$element->checkElementSelect('default',$this->view->formLabels['type'],$locationType);
				if($msg)$check['Location Type']=$msg;

			$msg=$element->checkElement($this->view->formLabels['parentLoc'],$parentLoc,40,3);
			if($msg)$check['Parent Location']=$msg;
			else{ 
				$res=$this->_refModel->getLocationIdByLocIdQuery($parentLoc);
				if(!$res){
					$check['Parent Location']="<b>Parent Location</b> is not found. ";
				}
			}
			$msg=$element->checkElement($this->view->formLabels['desc'],$descrip,20,3);
			if($msg)$check['Description']=$msg;
		
		
		ob_flush();
		flush();
		
			
		return $check;
	}  
}
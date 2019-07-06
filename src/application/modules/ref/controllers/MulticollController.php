<?php
class Ref_MulticollController extends modules_ref_controllers_RefController
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
	protected $_fileName='Inserted-Collectors';

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

    function insertcollAction()
	{ 
		$successResults=$msg=$total_scheme_cust=$insertMsg=$msg_status=null;
		$no=0;

		$static=$this->_refModel->getAllEmpStaticValQuery();
		$prefix=$this->_refModel->getEmployeePrePostQuery();
		$element=new Bloomfi_App_UHtmlElement;
		$this->view->rows=$this->_defaultRows;
		$labels=new modules_ref_labels_label;
		$this->view->formLabels=$labels->getRefMultiCollFormLabels('addCust');
		$this->view->numRowsLabel=$labels->getRefMultiCollFormLabels('row_nums');
		$this->view->statusLabels=$labels->getRefMultiCollFormLabels('status');
		$message=new modules_ref_messages_message;
		$this->insertMsg=$message->getRefMultiCollMessages('error');
		$this->statusMsg=$message->getRefMultiCollMessages('statusMsg');
		$this->_resultLabels=$this->view->resultLabels=$labels->getRefMultiCollFormLabels('result');
	
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
				if(isset($ele['employeeId'][$i]) && !empty($ele['employeeId'][$i]))
					$empId[$i]=$ele['employeeId'][$i];
				else $empId[$i]=null;
				if(isset($ele['employeeNm'][$i]) && !empty($ele['employeeNm'][$i]))
					$empNm[$i]=$ele['employeeNm'][$i];
				else $empNm[$i]=null;
				if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
					$ageC[$i]=$ele['age'][$i];
				else $ageC[$i]=null;
				if(isset($ele['sex'][$i]) && !empty($ele['sex'][$i]))
					$sx[$i]=$ele['sex'][$i];
				else $sx[$i]=null;
				if(isset($ele['addr'][$i]) && !empty($ele['addr'][$i]))
					$address[$i]=$ele['addr'][$i];
				else $address[$i]=null;
				if(isset($ele['desig'][$i]) && !empty($ele['desig'][$i]))
					$designation[$i]=$ele['desig'][$i];
				else $designation[$i]=null;
				if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
					$dt[$i]=$ele['date'][$i];
				else $dt[$i]=null;
				
				
				$emp_id=$empId[$i];
				$nm=$empNm[$i];
				$age=$ageC[$i];
				$sex=$sx[$i];
				$addr=$address[$i];
				$desig=$designation[$i];
				$appdate=$dt[$i];
				

				$data=array('employeeId'=>$emp_id,'employeeNm'=>$nm,'age'=>$age,'sex'=>$sex,'address'=>$addr,'designation'=>$desig,
					'date'=>$appdate);

				$check=null;
				$check=$this->validate($data);
				
				if(!$check)
				 {
					$this->_refModel->startTransaction();
					$this->_refModel->insertRowInCollectorTblDML();
					$max_id=$this->_refModel->getLastInsertedId();
					//$total_scheme_cust=$this->_refModel->getEntityMaxIdOnSchemeQuery($s_id);
					if($total_scheme_cust)$entNewIDNo=$total_scheme_cust->ID + 1;
					else $entNewIDNo = $this->_startId;
					$addr_id = $prefix[1]->PREFIX_VALUE.$max_id->ID;
					$entity_id=$emp_id;
					$entity_unique_id = $prefix[0]->PREFIX_VALUE.$max_id->ID;
				//	$age=(int)$age;
					$creation_date=date("Y-m-d H:m:s");
					$datas_ordered_1 = array( $entity_id,$entity_unique_id, $static[0]->VALUE_NAME,null, $nm,$age, $sex,$emp_id, $appdate, $desig,$addr_id,null,$max_id->ID);
					$datas_ordered_2 = array( $addr_id, $addr );
					//print_r($datas_ordered_1);
					//die;
					$result1=$this->_refModel->updateInsertedEmployeeDML($datas_ordered_1);
					
					$result2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
					if($result1!=null && $result2!=null){
						$msg_status[$i+1]['error']['Error']=$this->statusMsg['notFound'];
						$msg_status[$i+1]['status']=$this->statusMsg['success'];
						$msg_status[$i+1]['skip']=false;
						$this->_refModel->commitTransaction();
						$successResults[$no++]=array('employeeId'=>$emp_id,'employeeName'=>$nm,
							'age'=>$age,'sex'=>$sex,'address'=>$addr,'designation'=>$desig,'date'=>$appdate);

						//$nm=$age=$addr=$astemp=$description=$sex=$loc_id=$customer_id=$cssId=null;
					}
					else {
						$this->view->textErrors = $this->statusMsg['notInsert'];
					}			
				 }
				else{
					$msg_status[$i+1]['error']=$check;
					$msg_status[$i+1]['status']=$this->statusMsg['failed'];
					if($this->_skip==true) $msg_status[$i+1]['skip']=true;
					else $msg_status[$i+1]['skip']=false;
				 }
			}

			$this->view->empId=$empId;
			$this->view->empNm=$empNm;
			$this->view->sge=$ageC;
			$this->view->gender=$sx;
			$this->view->address=$address;
			$this->view->desig=$designation;
			$this->view->dt=$dt;
			

			$this->view->validationMsg=$msg_status;
			$this->view->sucsessfulEntries=$successResults;
			$this->_session->xlsResult=$successResults;
			$this->_session->xlsHeader=$this->_getMultiCollInsertedResultsHeader();
			$this->_session->fileName=$this->_fileName;

		}else{
			$o_empId=$o_empNm=$o_age=$o_dt=$o_sx=$o_address=$o_desig=null;

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
							
							if(isset($ele['employeeId'][$i]) && !empty($ele['employeeId'][$i]))
								$empId[$i]=$ele['employeeId'][$i];
							else $empId[$i]=null;
							if(isset($ele['employeeNm'][$i]) && !empty($ele['employeeNm'][$i]))
								$empNm[$i]=$ele['employeeNm'][$i];
							else $empNm[$i]=null;
							if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
								$ageC[$i]=$ele['age'][$i];
							else $ageC[$i]=null;
							if(isset($ele['sex'][$i]) && !empty($ele['sex'][$i]))
								$sex[$i]=$ele['sex'][$i];
							else $sex[$i]=null;
							if(isset($ele['addr'][$i]) && !empty($ele['addr'][$i]))
								$address[$i]=$ele['addr'][$i];
							else $address[$i]=null;
							if(isset($ele['desig'][$i]) && !empty($ele['desig'][$i]))
								$designation[$i]=$ele['desig'][$i];
							else $designation[$i]=null;
							if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
								$dt[$i]=$ele['date'][$i];
							else $dt[$i]=null;
							
						}else
						{
							$empId[$i]=$o_empId;
							$empNm[$i]=$o_empNm;
							$ageC[$i]=$o_age;
							$sex[$i]=$o_sx;
							$address[$i]=$o_address;
							$designation[$i]=$o_desig;
							$dt[$i]=$o_dt;
						}

						if($i==$copy-1)
						{
							$o_empId=$empId[$i];
							$o_empNm=$empNm[$i];
							$o_age=$ageC[$i];
							$o_sx=$sex[$i];
							$o_address=$address[$i];
							$o_desig=$designation[$i];
							$o_dt=$dt[$i];
						}
					}
				$this->view->empId=$empId;
				$this->view->empNm=$empNm;
				$this->view->age=$ageC;
				$this->view->gender=$sex;
				$this->view->address=$address;
				$this->view->desig=$designation;
				$this->view->dt=$dt;
				
				//print_r($empId);
			}else{
				$msg['error']=$this->statusMsg['notCopy'];
			}
		}

		$this->view->sex = $this->_refModel->getAllGenderTypesQuery();
		$this->view->textErrors = $msg;
	}

	protected function _getMultiCollInsertedResultsHeader()
	{
		$lbl=$this->_resultLabels;
		$header=array($lbl['employeeId'],$lbl['employeeName'],$lbl['age'],$lbl['sex'],$lbl['address'], $lbl['designation'],$lbl['date']);
		return $header;
	}

	/*
	 Collector Validation
	*/
	protected function validate($data,$row=null)
	{
		$check=$msg=$current_row=$sex=$age=$emp_id=$emp_nm=$scheme_id=$date=$location_id=$valMsg=null;
		$age_limits = $this->_refModel->getCustomerAgeLimitQuery();
		
		if($row)$current_row="[Row - $row] ";

		$element=new Bloomfi_App_UHtmlElement;
		$validateMsg=new modules_ref_messages_message;
		$this->errorMsg=$validateMsg->getRefMultiCollMessages('ValidateMsg');
	//	print_r($this->errorMsg);
		$this->_skip=false;

		
	//	die; 
		if(isset($data['employeeId']))
			$emp_id = $data['employeeId']; 
		if(isset($data['employeeNm']))
			$emp_nm = $data['employeeNm'];
		if(isset($data['age']))
			$age=$data['age'];
		if(isset($data['sex']))
			$sex=$data['sex'];
		if(isset($data['address']))
			$address=$data['address'];
		if(isset($data['designation']))
			$desig=$data['designation'];
		if(isset($data['date']))
			$date = $data['date'];
	
		if ( empty($emp_id) && empty($emp_nm) && empty($age) && empty($sex) &&
			empty($address) && empty($desig) && empty($date)) {
			//$msg_status=false;
			$this->_skip=true;
			return array('Error'=>true);
		}
		

		//------------------------Employee-----------------------------
		$msg=$element->checkElement($this->view->formLabels['employeeCode'],$emp_id,50,2);
		if($msg)$check[$this->view->formLabels['employeeCode']]=$msg;
		else{
			$result=$this->_refModel->getEmployeeQuery($emp_id);
			if($result)
			$check[$this->view->formLabels['employeeCode']]=$this->errorMsg['invalidEmp'];
		}
		

		$msg=$element->checkElementAlpha($this->view->formLabels['employeeName'],$emp_nm,50,2);
		if($msg)$check[$this->view->formLabels['employeeName']]=$msg;
		
		if(!$age){
			$check['Age']=$this->errorMsg['emptyAge'];
		}

		if($age){
				$msg=$element->checkElementNum($this->view->formLabel['age'],$age,2,1);
				if($msg)$check['age']=$msg; }
				else
					$age = (int)$age_limits[0]->VALUE_NAME;
		

		if(!$sex) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyGndr']);
			$check['Gender'] = $valMsg;
		}  

		$msg=$element->checkElement($this->view->formLabels['address'],$address,70,1);
		if($msg)$check['Address']=$msg;
		
		$msg=$element->checkElement($this->view->formLabels['designation'],$desig,50,2);
		if($msg)$check[$this->view->formLabels['designation']]=$msg;

		if(!$date) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyDate']);
			$check['Date'] = $valMsg;
		}else
		{
			$msg=$element->checkElementDate('Date',$date);
			if($msg) $check['Date'] = $current_row.$msg;
		}
		
		

		ob_flush();
		flush();
			
		
		//print_r( $check );  
		
		return $check;
	}  
}
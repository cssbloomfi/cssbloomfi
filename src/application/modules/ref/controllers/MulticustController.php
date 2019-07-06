<?php
require_once(ROOT_DIR.'/library/thirdParty/utilityFunctions.php');
class Ref_MulticustController extends modules_ref_controllers_RefController
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
	protected $_fileName='Inserted-Beneficiaries';

    function preDispatch(){
		$this->_session=$this->_initialize();
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_refConfig = new modules_ref_config_refConfig;
		$this->view->acl=$this->_session->acl;
		$this->_session->xlsResult=null;
		$this->_session->xlsHeader=null;
	}

	function postDispatch(){
		$this->_refModel->destroy();
		unset($this->_refModel);
	}

    function insertcustAction()
	{
		$successResults=$msg=$total_scheme_cust=$insertMsg=null;
		$no=0;

		$static=$this->_refModel->getAllCustStaticValQuery();
		$prefix=$this->_refModel->getCustomerPrePostQuery();
		$element=new Bloomfi_App_UHtmlElement;
		$this->view->rows=$this->_defaultRows;
		$labels=new modules_ref_labels_label;
		$this->view->formLabels=$labels->getRefMultiCustFormLabels('addCust');
		$this->view->numRowsLabel=$labels->getRefMultiCustFormLabels('row_nums');
		$this->view->statusLabels=$labels->getRefMultiCustFormLabels('status');
		$message=new modules_ref_messages_message;
		$this->insertMsg=$message->getRefMultiCustMessages('error');
		$this->statusMsg=$message->getRefMultiCustMessages('statusMsg');
		$this->_resultLabels=$this->view->resultLabels=$labels->getRefMultiCustFormLabels('result');
	
		$ele=$this->getRequest()->getPost();
		trim_all($ele);

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
				if(isset($ele['customerNm'][$i]) && !empty($ele['customerNm'][$i]))
					$custNm[$i]=$ele['customerNm'][$i];
				else $custNm[$i]=null;
				if(isset($ele['employeeId'][$i]) && !empty($ele['employeeId'][$i]))
					$empId[$i]=$ele['employeeId'][$i];
				else $empId[$i]=null;
				if(isset($ele['sex'][$i]) && !empty($ele['sex'][$i]))
					$sx[$i]=$ele['sex'][$i];
				else $sx[$i]=null;
				if(isset($ele['scheme'][$i]) && !empty($ele['scheme'][$i]))
					$schm[$i]=$ele['scheme'][$i];
				else $schm[$i]=null;
				if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
					$dt[$i]=$ele['date'][$i];
				else $dt[$i]=null;
				if(isset($ele['location'][$i]) && !empty($ele['location'][$i]))
					$loc[$i]=$ele['location'][$i];
				else $loc[$i]=null;
				if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
					$age[$i]=$ele['age'][$i];
				else $age[$i]=null;

				$nm=$custNm[$i];
				$e_id=$empId[$i];	
				$appdate=$dt[$i];
				$loc_id=$loc[$i];
				$sex=$sx[$i];
				$s_id=$schm[$i];
				$c_age=$age[$i];

				$data=array('customer'=>$nm,'employee'=>$e_id,'sex'=>$sex,'age'=>$c_age,'location'=>$loc_id,
					'date'=>$appdate,'scheme'=>$s_id);

				$check=null;
				$check=$this->validate($data);
				
				if(!$check)
				 {
					$this->_refModel->startTransaction();
					$this->_refModel->insertRowInEntityTblDML();
					$max_id=$this->_refModel->getLastInsertedId();
					$total_scheme_cust=$this->_refModel->getEntityMaxIdOnSchemeQuery($s_id);
					if($total_scheme_cust)$entNewIDNo=$total_scheme_cust->ID + 1;
					else $entNewIDNo = $this->_startId;
					$entity_id = $customer_id=$s_id.$entNewIDNo;
					//die($customer_id);
					$entity_unique_id = $prefix[0]->PREFIX_VALUE.$max_id->ID;
					$addr_id = $prefix[2]->PREFIX_VALUE.$max_id->ID;
				//	$age=(int)$age;
					$creation_date=date("Y-m-d H:m:s");
					$datas_ordered_1 = array( $entity_id, $static[0]->VALUE_NAME, $e_id, null, $nm, $c_age, $sex, $customer_id, $entity_unique_id, $appdate, $loc_id, $addr_id, $creation_date, null,null,$s_id,$max_id->ID);
					$datas_ordered_2 = array( $addr_id, null );
				//	die;
					$result1=$this->_refModel->updateInsertedCustomerDML($datas_ordered_1);
					$result2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
					if($result1!=null && $result2!=null){
						$msg_status[$i+1]['error']['Error']=$this->statusMsg['notFound'];
						$msg_status[$i+1]['status']=$this->statusMsg['success'];
						$msg_status[$i+1]['skip']=false;
						$this->_refModel->commitTransaction();
						$successResults[$no++]=array('custname'=>$nm,'custcode'=>$customer_id,
							'gender'=>$sex,'age'=>$c_age,'project'=>$s_id,'location'=>$loc_id,'date'=>$appdate);

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

			$this->view->custNm=$custNm;
			$this->view->empId=$empId;
			$this->view->schm=$schm;
			$this->view->gender=$sx;
			$this->view->dt=$dt;
			$this->view->loc=$loc;
			$this->view->age=$age;

			$this->view->validationMsg=$msg_status;
			$this->view->sucsessfulEntries=$successResults;
			$this->_session->xlsResult=$successResults;
			$this->_session->xlsHeader=$this->_getMultiCustInsertedResultsHeader();
			$this->_session->fileName=$this->_fileName;

		}else{
			$o_cust=$o_emp=$o_schm=$o_dt=$o_sx=$o_loc=$o_age=null;

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
							if(isset($ele['customerNm'][$i]) && !empty($ele['customerNm'][$i]))
								$custNm[$i]=$ele['customerNm'][$i];
							else $custNm[$i]=null;
							if(isset($ele['employeeId'][$i]) && !empty($ele['employeeId'][$i]))
								$empId[$i]=$ele['employeeId'][$i];
							else $empId[$i]=null;
							if(isset($ele['sex'][$i]) && !empty($ele['sex'][$i]))
								$sex[$i]=$ele['sex'][$i];
							else $sex[$i]=null;
							if(isset($ele['scheme'][$i]) && !empty($ele['scheme'][$i]))
								$schm[$i]=$ele['scheme'][$i];
							else $schm[$i]=null;
							if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
								$dt[$i]=$ele['date'][$i];
							else $dt[$i]=null;
							if(isset($ele['location'][$i]) && !empty($ele['location'][$i]))
								$loc[$i]=$ele['location'][$i];
							else $loc[$i]=null;
							if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
								$age[$i]=$ele['age'][$i];
							else $age[$i]=null;
						}else
						{
							$custNm[$i]=$o_cust;
							$empId[$i]=$o_emp;
							$schm[$i]=$o_schm;
							$sex[$i]=$o_sx;
							$loc[$i]=$o_loc;
							$dt[$i]=$o_dt;
							$age[$i]=$o_age;
						}

						if($i==$copy-1)
						{
							$o_cust=$custNm[$i];
							$o_emp=$empId[$i];
							$o_schm=$schm[$i];
							$o_sx=$sex[$i];
							$o_loc=$loc[$i];
							$o_dt=$dt[$i];
							$o_age=$age[$i];
						}
					}
				$this->view->custNm=$custNm;
				$this->view->empId=$empId;
				$this->view->schm=$schm;
				$this->view->gender=$sex;
				$this->view->dt=$dt;
				$this->view->loc=$loc;
				$this->view->age=$age;
			}else{
				$msg['error']=$this->statusMsg['notCopy'];
			}
		}

		$this->view->sex = $this->_refModel->getAllGenderTypesQuery();
		$this->view->locations = $this->_refModel->getAllTrnLocations();
		$this->view->schemes = $this->_refModel->getAllSchemeMinInfoQuery();
		$this->view->textErrors = $msg;
	}

	protected function _getMultiCustInsertedResultsHeader()
	{
		$lbl=$this->_resultLabels;
		$header=array($lbl['customerName'],$lbl['customerCode'],$lbl['sex'],$lbl['scheme'], $lbl['location'],$lbl['date']);
		return $header;
	}

	protected function validate($data,$row=null)
	{
		$msg_status=$msg=$current_row=$sex=$emp_id=$cust_nm=$scheme_id=$date=$location_id=$valMsg=$age=null;

		if($row)$current_row="[Row - $row] ";

		$element=new Bloomfi_App_UHtmlElement;
		$validateMsg=new modules_ref_messages_message;
		$this->errorMsg=$validateMsg->getRefMultiCustMessages('ValidateMsg');
		$this->_skip=false;

	//	print_r($data);
	//	die; 
		if(isset($data['scheme']))
			$scheme_id = $data['scheme']; 
		if(isset($data['customer']))
			$cust_nm = $data['customer'];
		if(isset($data['employee']))
			$emp_id=$data['employee'];
		if(isset($data['sex']))
			$sex=$data['sex'];
		if(isset($data['age']))
			$age=$data['age'];
		if(isset($data['date']))
			$date = $data['date'];
		if(isset($data['location']))
			$location_id = $data['location'];

		if ( empty($cust_nm) && empty($emp_id) && empty($date) && empty($location_id) &&
			empty($sex) && empty($scheme_id) && empty($age)) {
			//$msg_status=false;
			$this->_skip=true;
			return array('Error'=>true);
		}

		if(!$cust_nm) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyCust']);
			$msg_status['Beneficiary&nbsp;Name'] = $valMsg;
		} 

		//------------------------Employee-----------------------------

		if($emp_id){
			$result=$this->_refModel->getEmployeeQuery($emp_id);
			if(!$result){
				//$msg=$msg=str_replace('@VAR1@',$emp_id,$this->_payMessages['employeeInvalid']);
				$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['invalidEmp']);
				$msg_status['Collector'] = $valMsg;
			}
		}
		else
		{
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyEmp']);
			$msg_status['Collector'] = $valMsg;
		}

		if(!$sex) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyGndr']);
			$msg_status['Gender'] = $valMsg;
		}
		
		if(!$age){
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyAge']);
			$msg_status['Age'] = $valMsg;
		}else{
			if($age<0 || $age>99)
			$msg_status['Age']=str_replace('@VAR1@',$current_row,$this->errorMsg['ageInvalid']);
		}

		if(!$scheme_id) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyProject']);
			$msg_status['Project'] = $valMsg;
		}  

		if(!$date) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyDate']);
			$msg_status['Date'] = $valMsg;
		}else
		{
			$msg=$element->checkElementDate('Date',$date);
			if($msg) $msg_status['Date'] = $current_row.$msg;
		}

		if(!$location_id) {
			$valMsg=str_replace('@VAR1@',$current_row,$this->errorMsg['emptyLoc']);
			$msg_status['Location'] = $valMsg;
		} 

		ob_flush();
		flush();

		//print_r( $msg_status );
		return $msg_status;
	}

}
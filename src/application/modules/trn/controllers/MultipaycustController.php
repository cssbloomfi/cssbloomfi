<?php
require_once(ROOT_DIR.'/library/thirdParty/utilityFunctions.php');
class Trn_MultipaycustController extends modules_trn_controllers_TrnController
{
	protected $_refModel;
	protected $_trnModel;
	protected $_payment_type_key;
	protected $_paymentKey1='CAPITAL_PAID';
	protected $_paymentKey2='BSD_PAID';
	protected $_element;
	protected $_customerEntry;
	protected $_fileName='beneficiary-payment(Optional)';
	protected $_labels=null;

	function preDispatch()
	{
		$this->_initialize();
		$this->_element=new Bloomfi_App_UHtmlElement;
	}

    function indexAction()
    {
		$cust=$emp=$schm=$typ=$amnt=$dt=$row1=$successResults=null;
		$errors=null;
		$s_id=$c_id=$e_id=$flag=$check=$type=$vouchers=$data=$voucher_ids=$result=$summary_info=
		$search_params=$memo=$error=$gender=$sex=$custnm=$loc=$msg_status=null;
		$no=0;
		$statusMsg=null;
		$message = new modules_trn_messages_message;
		$this->statusMsg=$message->getTrnMultiPaymentMessages('statusMsg');
		$this->view->title = $this->statusMsg['title'];
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_trnConfig = new modules_trn_config_trnConfig;
		$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		$this->view->pay_types=$pay_types=$this->_trnModel->getAllPaymentTypesQuery();
		$this->view->sex=$this->_refModel->getAllGenderTypesQuery();
		$this->view->locations = $this->_refModel->getAllTrnLocations();
		$this->arrangeKeyValue($pay_types,'VALUE_NAME','VALUE_NAME');
		$static=$this->_refModel->getAllCustStaticValQuery();
		$custprefix=$this->_refModel->getCustomerPrePostQuery();

		$this->view->format=new Bloomfi_NumericFormat;
		$max_amount='000';
		$labels=new modules_trn_labels_label;
	//	$this->view->viewlabels=$labels->getTrnPaymentViewLabels('addsummary');
		$pdate = date('Y-m-d');
		$this->view->confirmMsg = $message->getTrnPaymentMessages('confirm');
		$this->_payMessages=$message->getTrnMultiPaymentMessages('multiPayment');
		$this->_labels=$this->view->formLabel=$labels->getTrnPaymentCustFormLabels('addTran');
		$this->view->numRowsLabel=$labels->getTrnPaymentCustFormLabels('row_nums');
		$this->view->ststusLabel=$labels->getTrnPaymentCustFormLabels('status');
		$this->view->paymentFormHeader=$labels->getTrnPaymentFormLabels('payment');

		
		if($this->getRequest()->getPost('rows') || $this->getRequest()->getPost('rows1'))
		{
			$row=$this->getRequest()->getPost('rows');
			$row1=$this->getRequest()->getPost('rows1');
		}

		if(!empty($row))
		{
			$this->view->rows=$row;
		}elseif(!empty($row1))
		{
			$this->view->rows=$row1;
		}else {
			$this->view->rows= 10;
		}

		if($this->getRequest()->getPost('save'))
		{
			$ele=$this->getRequest()->getPost();
			trim_all($ele);
			//print_r($ele);
			//die;
			//$this->_trnModel->startProcessing();
			//$allow=$this->_trnModel->waitAndAllow('SUMMARY');
			//$this->_trnModel->endProcessing();
			//if($allow==1) {
			//	$this->_trnModel->startProcessing();
			//	$allow=$this->_trnModel->waitAndAllow('DETAILS');
			//	$this->_trnModel->endProcessing();
			//}else{
			//	$this->view->textInfo=$this->_payMessages['serverBusy'] ."&nbsp;&nbsp;".$this->_trnModel->printTotalProcessingTime('false');
			//	$this->_trnModel->releaseLock('SUMMARY');
			//}
			$allow=1;
			if($allow==1)
			{
				for($i=0;$i<$this->view->rows;$i++)
				{
					if(isset($ele['customernm'][$i]) && !empty($ele['customernm'][$i]))
						$custnm[$i]=$ele['customernm'][$i];
					else $custnm[$i]=null;
					if(isset($ele['gender'][$i]) && !empty($ele['gender'][$i]))
						$sex[$i]=$ele['gender'][$i];
					else $sex[$i]=null;
					if(isset($ele['location'][$i]) && !empty($ele['location'][$i]))
						$loc[$i]=$ele['location'][$i];
					else $loc[$i]=null;
					if(isset($ele['customer'][$i]) && !empty($ele['customer'][$i]))
						$cust[$i]=$ele['customer'][$i];
					else $cust[$i]=null;
					if(isset($ele['employee'][$i]) && !empty($ele['employee'][$i]))
						$emp[$i]=$ele['employee'][$i];
					else $emp[$i]=null;
					if(isset($ele['scheme'][$i]) && !empty($ele['scheme'][$i]))
						$schm[$i]=$ele['scheme'][$i];
					else $schm[$i]=null;
					if(isset($ele['payment_type'][$i]) && !empty($ele['payment_type'][$i]))
						$typ[$i]=$ele['payment_type'][$i];
					else $typ[$i]=null;
					if(isset($ele['amount'][$i]) && !empty($ele['amount'][$i]))
						$amnt[$i]=$ele['amount'][$i];
					else $amnt[$i]=null;
					if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
						$dt[$i]=$ele['date'][$i];
					else $dt[$i]=null;
					if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
						$age[$i]=$ele['age'][$i];
					else $age[$i]=null;
					
					$c_nm=$custnm[$i];
					$gender=$sex[$i];
					$location = $loc[$i];

					$c_id=$cust[$i];
					$e_id=$emp[$i];
					$s_id = $schm[$i];
					$date = $dt[$i];
					$amount = $amnt[$i];
					$type = $typ[$i];
					$voucher = strtoupper($c_id);
					$remarks ='';
					$custAge=$age[$i];
					$check=$select_check=null;

					//PAYMENT FORM VALIDATION-------------

					$check=$this->validate(array('customerName'=>$c_nm,'age'=>$custAge,'sex'=>$gender,'location'=>$location,'customer'=>$c_id,'employee'=>$e_id,'scheme'=>$s_id,'amount'=>$amount,'type'=>$type,'date'=>$date));

					//echo $check;
					//-------------------------------------
					if(!$check)
					{
						$done=false;
						$this->_trnModel->startTransaction();
						if($this->_customerEntry==false){
							$c_nm=$this->_customerName;
							$gender=$this->_customerGender;
							$location=$this->_customerLocation;
						}
						if(!$s_id) $s_id=$this->_customerScheme;
						if(!$emp[$i]) $emp[$i]=$this->_employeeId;
						//...................................................

				//		echo "Project>".$s_id.' Employee>'.$this->_employeeId.' Gender>'.$this->_customerGender;
					//	die;

						// Action for CAPITAL_PAID
						if($pay_types[$this->_paymentKey1]==$typ[$i])
						{
							$this->_trnModel->insertRowInSummaryDML();
							$summary_max_id=$this->_trnModel->getLastInsertedId();
							$this->_trnModel->insertRowInDetailDML();
							$detail_max_id=$this->_trnModel->getLastInsertedId();
							//$this->_trnModel->releaseLock('DETAILS');
							$receive_amount=0;
							$due_amount=$amount;
							$prefix= $this->_trnModel->getAllTrnPrePostQuery();
							$new_ts_row_id = $summary_max_id->ID;
							$new_trns_id=$prefix[0]->PREFIX_VALUE.$new_ts_row_id;
							$new_td_row_id = $detail_max_id->ID;
							$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;

							$data_ordered = array( $new_trns_id,$s_id,$cust[$i],
								$emp[$i], $amount, $due_amount,$date,$remarks,$new_ts_row_id);
							$data_ordered1 = array ($new_detail_id, $new_trns_id, $s_id,
							$cust[$i], $emp[$i], $amount, $pay_types[$this->_paymentKey1], $voucher,$memo,
							$date, null, $c_nm, $gender, $new_td_row_id);
							if($this->_customerEntry==true)
							{
								$this->_refModel->insertRowInEntityTblDML();
								$max_id=$this->_refModel->getLastInsertedId();
								//print_r($max_id);
								$entity_id = $cust[$i];
								$entity_unique_id = $custprefix[0]->PREFIX_VALUE.$max_id->ID;
								$addr_id = $custprefix[2]->PREFIX_VALUE.$max_id->ID;
								$datas_ordered_1 = array( $entity_id, $static[0]->VALUE_NAME, $emp[$i], null, $c_nm, $custAge, $gender, $c_id, $entity_unique_id,$date, $location, $addr_id, $date, null,null,$s_id,$max_id->ID);
							//	print_r($datas_ordered_1);die;
								$datas_ordered_2 = array( $addr_id, null );
								$res1=$this->_refModel->updateInsertedCustomerDML($datas_ordered_1);
								$res2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
							}
							$status1=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
							$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
							if($status1&&$status2){
								$msg_status[$i+1]['error']['Error']=$this->statusMsg['notFound'];
								$msg_status[$i+1]['status']=$this->statusMsg['success'];
								$msg_status[$i+1]['skip']=false;
								$this->_trnModel->commitTransaction();
								$done=true;
								$successResults[$no++]=array('custcode'=>$cust[$i],'type'=>$type,'amount'=>$amount,'date'=>$date,'custname'=>$c_nm,'empcode'=>$emp[$i], 'project'=>$s_id,'location'=>$location,'gender'=>$gender);
							 }
							else
							  $check['Error']=$this->statusMsg['notInsert'];

						}

						// Action for BSD_PAID
						if($pay_types[$this->_paymentKey2]==$typ[$i])
						{
							$receiptSecurityAmount=$due=$receive_amount=0;
							$trnsInfo=$this->_trnModel->getTranSmryInfosByCustIDQuery($cust[$i]);
							if($trnsInfo) {
							$id=$trnsInfo[0]->ID;
							$transId=$trnsInfo[0]->TRAN_SUMMARY_ID;
							$s_id=$trnsInfo[0]->SCHEME_ID;
							$voucher=$trnsInfo[0]->VOUCHER_NO;
							$due=$trnsInfo[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
							$receiptSecurityAmount=$trnsInfo[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
							if($due==0){
								if($receiptSecurityAmount==$amount){
									$status=$this->_trnModel->updateSecurityDeposAmountDML(array($amount,$transId));
									$this->_trnModel->insertRowInDetailDML();
									$detail_max_id=$this->_trnModel->getLastInsertedId();
									$prefix= $this->_trnModel->getAllTrnPrePostQuery();
									$new_td_row_id = $detail_max_id->ID;
									$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;
									$data_ordered = array ($new_detail_id, $transId, $s_id,
									$cust[$i], $emp[$i], $amount, $type, $voucher,$memo,
									$date, null, $c_nm, $gender,$new_td_row_id);
									$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered);
									if($status && $status2){		
									    $status=$this->_trnModel->updateSmryStatusToCloseDML($trnsInfo[0]->TRAN_SUMMARY_ID);
										if($status){
											$msg['Amount']=$this->_payMessages['securityPmntAmount'];
											$msg['Status']=str_replace('@VAR1@',$cust[$i],$this->_payMessages['accountClose']);
											$msg_status[$i+1]['status']=$this->statusMsg['success'];
											$msg_status[$i+1]['error']=$msg;
											$msg_status[$i+1]['skip']=false;
											$this->_trnModel->commitTransaction();
											$done=true;
											$successResults[$no++]=array('custcode'=>$cust[$i],'type'=>$type,'amount'=>$amount,'date'=>$date,'custname'=>$c_nm,'empcode'=>$emp[$i], 'project'=>$s_id,'location'=>$location,'gender'=>$gender);
										}else{
											$check['Account']=
											str_replace('@VAR1@',$cust[$i],$this->_payMessages['unabelToClose']);
										}
									}
									else $check['Account']=
									str_replace('@VAR1@',$cust[$i],$this->_payMessages['accountClosed']);
								}
								else
								{

									$check['Amount']=str_replace('@VAR1@',$receiptSecurityAmount,$this->_payMessages['securityAmount']);

								}}else
								{
									$msg=
									str_replace('@VAR2@',$due,str_replace('@VAR1@',$cust[$i],$this->_payMessages['dueAmount']));
									$check['Amount']=
									str_replace('@VAR2@',$due,$msg);
								}
							}
							else{
							}
							if($done=false){
							$msg_status[$i+1]['status']=$this->statusMsg['failed'];
							$msg_status[$i+1]['error']=$check;
							if($this->_skip==true) $msg_status[$i+1]['skip']=true;
							else $msg_status[$i+1]['skip']=false; }
						}

					//.....................................................................................
					}
					else
					{
						//$this->view->validationError=$check;
						$msg_status[$i+1]['error']=$check;
						$msg_status[$i+1]['status']=$this->statusMsg['failed'];
						if($this->_skip==true) $msg_status[$i+1]['skip']=true;
						else $msg_status[$i+1]['skip']=false;
						//print_r($check);
					}

					//$this->view->employee=$e_id;
					//$this->view->customer=$c_id;
					//$this->view->scheme=$s_id;
					//$this->view->amount=$amount;
					//$this->view->voucher=$voucher;
					//$this->view->remarks=$remarks;
					//$this->view->pdate =$date;

					if ($flag==1)
						$this->view->result=$summary_info;

					ob_flush();
					flush();
					unset($element,$message,$labels);

					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++ END INSERTATION +++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				}

				//print_r($loc);
				$this->view->custNm=$custnm;
				$this->view->sx=$sex;
				$this->view->locs=$loc;
				$this->view->cust=$cust;
				$this->view->emp=$emp;
				$this->view->schm=$schm;
				$this->view->typ=$typ;
				$this->view->dt=$dt;
				$this->view->amnt=$amnt;
				$this->view->age=$age;
				
				//$this->_trnModel->releaseLock('DETAILS');
				//$this->_trnModel->releaseLock('SUMMARY');
			}else
			{
				$this->view->textInfo=$this->_payMessages['serverBusy'] ."&nbsp;&nbsp;".$this->_trnModel->printTotalProcessingTime('false');
				//$this->_trnModel->releaseLock('SUMMARY');
			}

			$this->view->validationMsg=$msg_status;
			$this->view->sucsessfulEntries=$successResults;
			$this->_session->xlsResult=$successResults;
			$this->_session->xlsHeader=$this->_getMultiCustPayInsertedResultsHeader();
			$this->_session->fileName=$this->_fileName;
		}
		else
		{
			$o_custnm=$o_sex=$o_loc=$o_cust=$o_emp=$o_schm=$o_typ=$o_amt=$o_dt=$o_age=null;

			$copy=$this->getRequest()->getPost('copyRow');
			$ele=$this->getRequest()->getPost();


			//print_r($ele);

			if($this->view->rows==$copy)
					$this->view->rows++;

			for($i=0;$i<$this->view->rows;$i++)
				{
					if($i!=$copy)
					{
						if(isset($ele['customernm'][$i]) && !empty($ele['customernm'][$i]))
							$custnm[$i]=$ele['customernm'][$i];
						else $custnm[$i]=null;
						if(isset($ele['gender'][$i]) && !empty($ele['gender'][$i]))
							$sex[$i]=$ele['gender'][$i];
						else $sex[$i]=null;
						if(isset($ele['location'][$i]) && !empty($ele['location'][$i]))
							$loc[$i]=$ele['location'][$i];
						else $loc[$i]=null;
						if(isset($ele['customer'][$i]) && !empty($ele['customer'][$i]))
							$cust[$i]=$ele['customer'][$i];
						else $cust[$i]=null;
						if(isset($ele['employee'][$i]) && !empty($ele['employee'][$i]))
							$emp[$i]=$ele['employee'][$i];
						else $emp[$i]=null;
						if(isset($ele['scheme'][$i]) && !empty($ele['scheme'][$i]))
							$schm[$i]=$ele['scheme'][$i];
						else $schm[$i]=null;
						if(isset($ele['payment_type'][$i]) && !empty($ele['payment_type'][$i]))
							$typ[$i]=$ele['payment_type'][$i];
						else $typ[$i]=null;
						if(isset($ele['amount'][$i]) && !empty($ele['amount'][$i]))
							$amnt[$i]=$ele['amount'][$i];
						else $amnt[$i]=null;
						if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
							$dt[$i]=$ele['date'][$i];
						else $dt[$i]=null;
						if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
							$age[$i]=$ele['age'][$i];
						else $age[$i]=null;
					}else
					{
						$custnm[$i]=$o_custnm;
						$sex[$i]=$o_sex;
						$loc[$i]=$o_loc;
						$cust[$i]=$o_cust;
						$emp[$i]=$o_emp;
						$schm[$i]=$o_schm;
						$typ[$i]=$o_typ;
						$amnt[$i]=$o_amt;
						$dt[$i]=$o_dt;
						$age[$i]=$o_age;
					}

					if($i==$copy-1)
					{
						$o_custnm=$custnm[$i];
						$o_sex=$sex[$i];
						$o_loc=$loc[$i];
						$o_cust=$cust[$i];
						$o_emp=$emp[$i];
						$o_schm=$schm[$i];
						$o_typ=$typ[$i];
						$o_amt=$amnt[$i];
						$o_dt=$dt[$i];
						$o_age=$age[$i];					}
					}
					
			$this->view->custNm=$custnm;
			$this->view->sx=$sex;
			$this->view->locs=$loc;
			$this->view->cust=$cust;
			$this->view->emp=$emp;
			$this->view->schm=$schm;
			$this->view->typ=$typ;
			$this->view->dt=$dt;
			$this->view->amnt=$amnt;
			$this->view->age=$age;
		}
	}

	protected function _getMultiCustPayInsertedResultsHeader()
	{
		$lbl=$this->_labels;
		$header=array($lbl['customerCode'],$lbl['type'],$lbl['amount'], $lbl['date'],$lbl['customerName'],$lbl['collectorCode'], 
		$lbl['scheme'], $lbl['location'],$lbl['sex']);
		return $header;
	}

	protected function validate($data,$row=null)
	{
		$msg_status=$msg=$current_row=$emp_id=$cust_id=$scheme_id=$location=$payment_type=
		$voucher_no=$age=$scheme=$payment=$paymentAmount=$trans_date=$cust_nm=$loc=$sex=$isExist=null;

		if($row)$current_row="[Row - $row] ";
		$this->_customerEntry=false;

		//print_r($data);
		//die;

		$this->_skip=false;

		if(isset($data['employee']))
			$emp_id = $data['employee'];
		if(isset($data['customerName']))
			$cust_nm = $data['customerName'];
		if(isset($data['sex']))
			$sex = $data['sex'];
		if(isset($data['location']))
			$location = $data['location'];
		if(isset($data['customer']))
			$cust_id = $data['customer'];
		if(isset($data['scheme']))
			$scheme = $data['scheme'];
		if(isset($data['amount']))
			$payment=$data['amount'];
		if(isset($data['type']))
			$payment_type=$data['type'];
		if(isset($data['date']))
			$trans_date = $data['date'];
		if(isset($data['age']))
			$age = $data['age'];


		if ( empty($cust_nm) && empty($sex) && empty($age) && empty($location[0]) && empty($emp_id) && empty($scheme) && empty($cust_id) && empty($payment) && empty($payment_type) && empty($trans_date))
		{
			$this->_skip=true;
			return array('Error'=>true);
		}


		//------------------------Customer-----------------------------

		if($cust_nm || $sex || $location || $age )
		{
			$this->_customerEntry=true;

			$msg=$this->_element->checkElementAlpha('Beneficiary Name',$cust_nm,50,3);
			if($msg) $msg_status['Beneficiary&nbsp;Name'] = $current_row.$msg;
			
			$msg=$this->_element->checkElementSelect('','Location',$location);
			if($msg) $msg_status['location'] = $current_row.$msg;
			$msg=$this->_element->checkElementSelect('','Project',$scheme);
			if($msg) $msg_status['Project'] = $current_row.$msg;
			$result=$this->_refModel->getEmployeeQuery($emp_id);
			if(!$result){
				$msg=str_replace('@VAR1@',$emp_id,$this->_payMessages['employeeInvalid']);
				$msg_status['Collector'] = $current_row.$msg;
			}
			$msg=$this->_element->checkElementSelect('','Gender',$sex);
			if($msg) $msg_status['Gender'] = $current_row.$msg;
			if(!$age)$msg_status['Age']=$current_row.$this->_payMessages['emptyAge'];
			else{
				if($age<0 || $age>99)
				$msg_status['Age'] = $current_row.$this->_payMessages['ageInvalid'];
			}
			
		}else
		{

			if($emp_id){
				$result=$this->_refModel->getEmployeeQuery($emp_id);
				if(!$result){
					$msg=$msg=str_replace('@VAR1@',$emp_id,$this->_payMessages['employeeInvalid']);
					$msg_status['Collector'] = $current_row.$msg;
				}}
		}

		//print_r($data);
		//die;

		if(!$scheme || !$emp_id){
			$customer=$this->_refModel->getCustomerInfoByCustIdQuery($cust_id);
			if($customer){
				$this->_customerName=$customer[0]->ENTITY_NAME;
				$this->_customerGender=$customer[0]->SEX;
				$this->_customerLocation=$customer[0]->LOCATION_ID;
				if(!$scheme) {
					if(isset($customer[0]->SCHEME_ID) && !empty($customer[0]->SCHEME_ID))
						$scheme=$this->_customerScheme=$customer[0]->SCHEME_ID;
					else $msg_status['Project'] = 'Project not found';
				}
				$this->_employeeId=$customer[0]->EMPLOYEE_ID;
			}
		}
			
		if($cust_id){
			if(!strstr($cust_id, " "))
			{
				$result = $this->_refModel->getCustomerQuery($cust_id);
				if(!$result && $this->_customerEntry==false){
					$msg=str_replace('@VAR1@',$cust_id,$this->_payMessages['customerInvalid']);
					$msg_status['Beneficiary'] = $current_row.$msg;
				}elseif($result && $this->_customerEntry==true){
					$msg=str_replace('@VAR1@',$cust_id,$this->_payMessages['customerExist']);
					$msg_status['Beneficiary'] = $current_row.$msg;
				}
			}else{
				$msg=str_replace('@s@','(s)',str_replace('@VAR1@',$cust_id,$this->_payMessages['customerCodeSpaceExist']));
				$msg_status['Beneficiary'] = $current_row.$msg;
			}
		}
		else $msg_status['Beneficiary'] = $current_row.$this->_payMessages['customerEmpty'];

		//------------------------Payment-----------------------------

		if(trim($payment)!='')
		{
			$payment = (float) $payment;

			if ( $payment < 0 ){
				$msg=str_replace('@VAR1@',$paymentAmount,$this->_payMessages['paymentInvalid']);
				$msg_status['Amount'] = $current_row.$msg;
			}else
			{
				$max_amount=$this->_trnModel->getSchemeLimitAmountQuery($scheme_id);
				if ($payment > $max_amount && $max_amount>0)
				{
				  $msg=str_replace('@VAR1@',(float)$max_amount,$this->_payMessages['invalidamount2']);
				  $msg_status['Amount'] = $current_row.$msg;
				}
			}
		}
		else
		{
			$msg=$this->_payMessages['paymentEmpty'];
			$msg_status['Amount'] = $current_row.$msg;
		}

		if(!$payment_type)
		{
			$msg_status['Type'] = $current_row.$this->_payMessages['paymentTypeEmpty'];
		}else {
			if($this->_customerEntry==true && $payment_type==$this->_payment_type_key[1]->VALUE_NAME)
				$msg_status['Type'] = $current_row.$this->_payMessages['paymentTypeValueInvalid'];
		}

		if(!$trans_date) {
			$msg_status['Date'] = $current_row.$this->_payMessages['dateEmpty'];
		}else
		{
			$msg=$this->_element->checkElementDate('Date',$trans_date);
			if($msg) $msg_status['Date'] = $current_row.$msg;
		}

		if(!$msg_status){
			$isExist=$this->_trnModel->getTrnIdByCustomerQuery($cust_id);
			if($isExist && $payment_type==$this->_payment_type_key[0]->VALUE_NAME){
					$msg=str_replace('@VAR1@',$scheme,$this->_payMessages['schemeRunning']);
					$msg=str_replace('@VAR2@',$isExist->SCHEME_ID,$msg);
					$msg=str_replace('@VAR3@',$cust_id,$msg);
					$msg_status['Project'] = $current_row.$msg;
			}
			else{
				if($isExist)
				{
					$isExist=$this->_trnModel->getTrnIdByCustomerQuery($cust_id);
					if($isExist && $payment_type==$this->_payment_type_key[1]->VALUE_NAME )
					{
						if($isExist->SCHEME_ID==$scheme)
						{
							if($isExist->ACTIVE_STATUS=='OPEN')
							{
								$payment_datas =array($cust_id ,$scheme, $payment_type);
								$isExistPay=$this->_trnModel->getPaymentTrnsIdQuery($payment_datas);
								if($isExistPay){
									$msg= str_replace('@VAR1@',$cust_id, $this->_payMessages['bsdPumntGiven']);
									$msg_status['Project']=$msg;
								}else if($isExist->TOTAL_RECEIPT_DUE_PRINCIPAL!=0)
								{
									$msg=  str_replace('@VAR2@',$isExist->TOTAL_RECEIPT_DUE_PRINCIPAL, str_replace('@VAR1@',$cust_id, $this->_payMessages['dueAmount']));
									$msg_status['Amount']=$msg;
								}else if($isExist->TOTAL_RECEIPT_SECURITY_DEPOSITE!=$payment)
								{
									$msg=  str_replace('@VAR1@',$isExist->TOTAL_RECEIPT_SECURITY_DEPOSITE, $this->_payMessages['securityAmount']);
									$msg_status['Amount']=$msg;
								}
							}else{
								$msg_status['Status']=str_replace('@VAR1@',$cust_id, $this->_payMessages['accountClosed']);
							}
						}
						else
						{
							$msg= str_replace('@VAR1@',$cust_id, $this->_payMessages['invaildSchmBsdPymnt']);
							$msg_status['Project']=$msg;
						}

					}
				}
			}
		}

		ob_flush();
		flush();
		return $msg_status;
	}

}

?>
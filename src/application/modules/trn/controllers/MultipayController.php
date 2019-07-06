<?php
class Trn_MultipayController extends modules_trn_controllers_TrnController
{
	protected $_refModel;
	protected $_trnModel;
	protected $_payment_type_key;
	protected $_paymentKey1='CAPITAL_PAID';
	protected $_paymentKey2='BSD_PAID';
	protected $_labels=null;
    protected $_fileName='Inserted-payment';

	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$cust=$emp=$schm=$typ=$amnt=$dt=$row1=null;
		$errors=$successResults=null;
		$s_id=$c_id=$e_id=$flag=$check=$type=$vouchers=$data=$voucher_ids=$result=$summary_info=$search_params=$memo=$error=$statusMessages=null;
		$no=0;
		$this->view->title = "Master Payment transaction";
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_trnConfig = new modules_trn_config_trnConfig;
		$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();
		$element =new Bloomfi_App_UHtmlElement;
		$this->view->schemes=$this->_refModel->getAllSchemeMinInfoQuery();
		$this->view->pay_types=$pay_types=$this->_trnModel->getAllPaymentTypesQuery();
		$this->arrangeKeyValue($pay_types,'VALUE_NAME','VALUE_NAME');

		$this->view->format=new Bloomfi_NumericFormat;
		$max_amount='000';
		$labels=new modules_trn_labels_label;
		$message = new modules_trn_messages_message;
	//	$this->view->viewlabels=$labels->getTrnPaymentViewLabels('addsummary');
		$pdate = date('Y-m-d');
		$this->view->confirmMsg = $message->getTrnPaymentMessages('confirm');
		$this->_payMessages=$message->getTrnMultiPaymentMessages('multiPayment');
		$this->statusMessages=$message->getTrnMultiPaymentMessages('statusMsg');
		$this->_labels=$this->view->formLabels=$labels->getTrnMultiPayFormLabels('addTran');
		$this->view->numRowsLabel=$labels->getTrnMultiPayFormLabels('row_nums');
		$this->view->statusLabels=$labels->getTrnMultiPayFormLabels('status');
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
					//echo "[$i] => ".$this->view->rows."<br>";
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

					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//+++++++++++++++++++++++++++++ START INSERTATION ++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


				//	$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
				//	$insertmsg= $message->getTrnPaymentMessages('dbEntry');
				//	$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
					$c_id=$cust[$i];
					$e_id=$emp[$i];
					$s_id = $schm[$i];
					$date = $dt[$i];
					$amount = $amnt[$i];
					$type = $typ[$i];
					$voucher = strtoupper($c_id);
					$remarks ='';
					$check=$select_check=null;

					//PAYMENT FORM VALIDATION-------------
					$check=$this->validate(array('customer'=>$c_id,'scheme'=>$s_id,'employee'=>$e_id,'amount' =>$amount,'type'=>$type,'date'=>$date));

					//-------------------------------------

					if(!$check)
					{
						$this->_trnModel->startTransaction();
						$done=false;
						$customer=$this->_refModel->getCustomerInfoByCustIdQuery($c_id);
					//	$s_id=$customer[0]->SCHEME_ID;
					//	$e_id=$customer[0]->EMPLOYEE_ID;
						$c_nm=$customer[0]->ENTITY_NAME;
						$gender=$customer[0]->SEX;

						//...................................................
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
								$e_id, $amount, $due_amount,$date,$remarks,$new_ts_row_id);
							$data_ordered1 = array ($new_detail_id, $new_trns_id, $s_id,
							$cust[$i], $e_id, $amount, $type, $voucher,$memo,
							$date, null,$c_nm,$gender , $new_td_row_id);
							$status1=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
							$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
							if($status1&&$status2){
								$msg_status[$i+1]['error']['Error']=$this->statusMessages['notFound'];
								$msg_status[$i+1]['status']=$this->statusMessages['success'];
								$msg_status[$i+1]['skip']=false;
								$this->_trnModel->commitTransaction();
								$done=true;
								$successResults[$no++]=array('custcode'=>$cust[$i],
								'empcode'=>$e_id,'type'=>$type,'project'=>$s_id,'amount'=>$amount,
								'date'=>$date);
							 }
							else
							  $this->view->textErrors=$insertmsg['fail'];
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
									$cust[$i], $e_id, $amount, $type, $voucher,$memo,
									$date, null,$c_nm, $gender , $new_td_row_id);
									$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered);
									if($status && $status2){
										$status=$this->_trnModel->updateSmryStatusToCloseDML($trnsInfo[0]->TRAN_SUMMARY_ID);
										if($status){
											$msg['Amount']=$this->_payMessages['securityPmntAmount'];
											$msg['Status']=str_replace('@VAR1@',$cust[$i],$this->_payMessages['accountClose']);
											$msg_status[$i+1]['error']=$msg;
											$msg_status[$i+1]['status']=$this->statusMessages['success'];
											$msg_status[$i+1]['skip']=false;
											$done=true;
											$this->_trnModel->commitTransaction();
											$successResults[$no++]=array('custcode'=>$cust[$i],
											'empcode'=>$e_id,'type'=>$type,'project'=>$s_id,'amount'=>$amount,
											'date'=>$date);
										}else{
											$check['Status']=
											str_replace('@VAR1@',$cust[$i],$this->_payMessages['unabelToClose']);
										}
									}
									else{ $check['Status']=
									str_replace('@VAR1@',$cust[$i],$this->_payMessages['accountClosed']);
									}
								}
								else
								{
									$check['Amount']=str_replace('@VAR1@',$receiptSecurityAmount,$this->_payMessages['securityAmount']);
	
								}}else
								{
									$msg=
									str_replace('@VAR1@',$cust[$i],$this->_payMessages['securityAmount']);
									$check['Amount']=
									str_replace('@VAR2@',$due,$msg);
								}
							}
							else{
							}

							if($done==false){
							$msg_status[$i+1]['error']=$check;
							$msg_status[$i+1]['status']=$this->statusMessages['failed'];
							if($this->_skip==true) $msg_status[$i+1]['skip']=true;
							else $msg_status[$i+1]['skip']=false; }
						}

					//.....................................................................................
					}
					else
					{
						$msg_status[$i+1]['error']=$check;
						$msg_status[$i+1]['status']=$this->statusMessages['failed'];
						if($this->_skip==true) $msg_status[$i+1]['skip']=true;
						else $msg_status[$i+1]['skip']=false;
						
					}

					
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++ END INSERTATION +++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				}

				$this->view->cust=$cust;
				$this->view->emp=$emp;
				$this->view->schm=$schm;
				$this->view->typ=$typ;
				$this->view->dt=$dt;
				$this->view->amnt=$amnt;

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
			$this->_session->xlsHeader=$this->_getMultiPayInsertedResultsHeader();
			$this->_session->fileName=$this->_fileName;
		}
		else
		{
			$o_cust=$o_emp=$o_schm=$o_typ=$o_amt=$o_dt=null;

			$copy=$this->getRequest()->getPost('copyRow');
			$ele=$this->getRequest()->getPost();

			if($this->view->rows==$copy)
					$this->view->rows++;

			for($i=0;$i<$this->view->rows;$i++)
				{

					if($i!=$copy)
					{
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
					}else
					{
						$cust[$i]=$o_cust;
						$emp[$i]=$o_emp;
						$schm[$i]=$o_schm;
						$typ[$i]=$o_typ;
						$amnt[$i]=$o_amt;
						$dt[$i]=$o_dt;
					}

					if($i==$copy-1)
					{
						$o_cust=$cust[$i];
						$o_emp=$emp[$i];
						$o_schm=$schm[$i];
						$o_typ=$typ[$i];
						$o_amt=$amnt[$i];
						$o_dt=$dt[$i];
					}
				}
			$this->view->cust=$cust;
			$this->view->emp=$emp;
			$this->view->schm=$schm;
			$this->view->typ=$typ;
			$this->view->dt=$dt;
			$this->view->amnt=$amnt;
		}
	}

	protected function _getMultiPayInsertedResultsHeader()
	{
		$lbl=$this->_labels;
		$header=array($lbl['customerCode'],$lbl['employee'], 
		$lbl['type'],$lbl['scheme'], $lbl['amount'], $lbl['date']);
		return $header;
	}

	protected function validate($data,$row=null)
	{
		$msg_status=$msg=$current_row=$emp_id=$cust_id=$scheme_id=$payment_type=
		$voucher_no=$scheme=$payment=$paymentAmount=$trans_date=$isExist=null;

		if($row)$current_row="[Row - $row] ";

		$element=new Bloomfi_App_UHtmlElement;
		$this->_skip=false;

	//	print_r($data);
	//	die;

		if(isset($data['employee']))
			$emp_id = $data['employee']; 
		if(isset($data['scheme']))
			$scheme = $data['scheme']; 
		if(isset($data['customer']))
			$cust_id = $data['customer'];
		if(isset($data['amount']))
			$payment=$data['amount'];
		if(isset($data['type']))
			$payment_type=$data['type'];
		if(isset($data['date']))
			$trans_date = $data['date'];

		if ( empty($cust_id) && empty($payment) && empty($scheme)  && empty($emp_id) && empty($payment_type) && empty($trans_date) ) {
			//$msg_status=false;
			$this->_skip=true;
			return array('Error'=>true);
		}

		//------------------------Employee-----------------------------

		if($emp_id){
			$result=$this->_refModel->getEmployeeQuery($emp_id);
			if(!$result){
				$msg=$msg=str_replace('@VAR1@',$emp_id,$this->_payMessages['employeeInvalid']);
				$msg_status['Collector'] = $current_row.$msg;
			}
		}
		else $msg_status['Collector'] = $current_row.$this->_payMessages['employeeEmpty']; 

		//------------------------Customer-----------------------------

		if($cust_id){
			$result = $this->_refModel->getCustomerQuery($cust_id);
			if(!$result){
				$msg=$msg=str_replace('@VAR1@',$cust_id,$this->_payMessages['customerInvalid']);
				$msg_status['Beneficiary'] = $current_row.$msg;
			}else{
				$this->_customerName=$result[0]->ENTITY_NAME;
				$this->_customerGender=$result[0]->SEX;
				$cust_id=$this->_customerId=$result[0]->ENTITY_ID;
			}
		}
		else $msg_status['Beneficiary'] = $current_row.$this->_payMessages['customerEmpty'];

		//------------------------Scheme-----------------------------

		if($scheme){
			if( !isset($msg_status['Beneficiary']) && $payment_type) {
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
			
		}}
		else {
			$msg_status['Project'] = $current_row.$this->_payMessages['schemeEmpty'];
		}  

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

		if(!$payment_type){
			$msg_status['Type'] = $current_row.$this->_payMessages['paymentTypeEmpty'];
		}else{
		}

		if(!$trans_date) {
			$msg_status['Date'] = $current_row.$this->_payMessages['dateEmpty'];
		}else
		{
			$msg=$element->checkElementDate('Date',$trans_date);
			if($msg) $msg_status['Date'] = $current_row.$msg;
		}

		ob_flush();
		flush();
		return $msg_status;
	}
}

?>
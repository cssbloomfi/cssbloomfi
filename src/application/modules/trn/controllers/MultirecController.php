<?php
class Trn_MultirecController extends modules_trn_controllers_TrnController
{
	protected $_refModel;
	protected $_trnModel;
	protected $_payment_type_key;
	protected $_recMessages;
	protected $_receiptTypes;
	protected $_fileName='inserted-receipts';
	protected $_labels=null;

	function preDispatch()
	{
		$this->_initialize();
	}

    function indexAction()
    {
		$cust=$emp=$schm=$typ=$amnt=$dt=$row1=$successResults=null;
		$errors=null;
		$no=0;
		$labels=new modules_trn_labels_label;
		$message=new modules_trn_messages_message;
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_recMessages = $message->getTrnMultiReceiveMessages('multiReceipt');
		$element =new Bloomfi_App_UHtmlElement;
		$this->_receiptTypes=$this->view->recv_types=$recv_types= $this->_trnModel->getAllReceiveTypesQuery();
		$this->_labels=$this->view->formLabels=$labels->getTrnMultiRecFormLabels('addTran');
		$this->view->numRowsLabel=$labels->getTrnMultiRecFormLabels('row_nums');
		$this->view->statusLabels=$labels->getTrnMultiRecFormLabels('status');
		$pymnt_types=$this->_trnModel->getAllPaymentTypesQuery();

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
			$this->_trnConfig = new modules_trn_config_trnConfig;
			$this->_payment_type_key=$this->_trnModel->getAllPaymentTypesQuery();


			$s_id=$c_id=$e_id=$customers=$trnsSummaries=$trns_id=$status=$flag=$error=$transaction_id= $type=$employee=$customer=$amount=$remarks=$memo=$result=$details=$trns_summary=$scheme_id=$scheme=$check=null;
			$active_status=$active_status2='disabled';
			$max_amount=0;
			$employees=$this->_trnModel->getAllEmployeeQuery('Officer');

			$date = date('Y-m-d');

		//	print_r($ele);
		//	die;
			for($i=0;$i<$this->view->rows;$i++)
			{
				if(isset($ele['customer'][$i]) && !empty($ele['customer'][$i]))
					$cust[$i]=$ele['customer'][$i];
				else $cust[$i]=null;
				if(isset($ele['memo'][$i]) && !empty($ele['memo'][$i]))
					$memono[$i]=$ele['memo'][$i];
				else $memono[$i]=null;
				if(isset($ele['receipt_type'][$i]) && !empty($ele['receipt_type'][$i]))
					$typ[$i]=$ele['receipt_type'][$i];
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

				$voucher=$this->_customerId=$customer=$cust[$i];
				$amount = $amnt[$i];
				$date=$dt[$i];
				$type = $typ[$i];
				$memo =$memono[$i];
				$lib = new Bloomfi_App_Ulibrary;
				$trnClearance=true;

				

				$check=$this->validate(array('customer'=>$customer,'memo'=>$memo,'type'=>$type,
					'amount'=>$amount,'date'=>$date));

				if(!$check)
				{
					$trnsSummaries=$this->_trnModel->transactionSummariesByCustID($this->_customerId);
					if(!empty($trnsSummaries[0]->TRAN_SUMMARY_ID))
					$transaction_id=$trnsSummaries[0]->TRAN_SUMMARY_ID;

					//$trn_identifier="SUMMARY ID-$transaction_id";
					//$prefix= $this->_trnModel->getAllTrnPrePostQuery();
					//$this->_trnModel->startProcessing();
					//if($transaction_id){
					//	$allow=$this->_trnModel->waitAndAllow($trn_identifier);
					//	$summaryid=true;
					//}
					//else{
					//	$allow=$this->_trnModel->waitAndAllow('SUMMARY');
					//	$summaryid=false;
					//}
					//if($allow==1) $allow=$this->_trnModel->waitAndAllow('DETAILS');
					//$this->_trnModel->endProcessing();
					$allow=1;
					if($allow==1)
					{
						$this->_trnModel->startTransaction();
						if(!empty($transaction_id))
							$trns_summary= $this->_trnModel->getTransactionSummaryQuery($transaction_id);
						if($trns_summary){
							$this->_employeeId=$trns_summary[0]->EMPLOYEE_ID;
							$payment_principle=(float)$trns_summary[0]->TOTAL_PAYMENT_PRINCIPAL;
							$current_recipt_due =(float)$trns_summary[0]->TOTAL_RECEIPT_DUE_PRINCIPAL;
							$current_recipt_amount = (float)$trns_summary[0]->TOTAL_RECEIPT_PRINCIPAL;
							$current_recpt_security_depos=(float)$trns_summary[0]->TOTAL_RECEIPT_SECURITY_DEPOSITE;
							$current_recpt_donation=(float)$trns_summary[0]->TOTAL_RECEIPT_DONATION;
							$current_recpt_fees=(float)$trns_summary[0]->TOTAL_RECEIPT_FEES;
							$scheme_id=$trns_summary[0]->SCHEME_ID;
							$clear=true;
						}
						else
						{
							if(empty($this->_employeeId))
							{

								$check['Collector']=$this->_recMessages['employeeNotExist'];
							}

							if(!$check){
								$voucher=$this->_customerId;
								$this->_trnModel->insertRowInSummaryDML();
								$summary_max_id=$this->_trnModel->getLastInsertedId();
								$new_ts_row_id = $summary_max_id->ID;
								$transaction_id=$prefix[0]->PREFIX_VALUE.$new_ts_row_id;
								$data_ordered = array($transaction_id,$scheme,$this->_customerId,
										$this->_employeeId, 0, 0,$date,'Auto Generated',$new_ts_row_id);
								$status1=$this->_trnModel->updateInsertedCustPaymentDML($data_ordered);
								$this->_trnModel->insertRowInDetailDML();
								$detail_max_id=$this->_trnModel->getLastInsertedId();
								//$this->_trnModel->releaseLock('DETAILS');
								$new_td_row_id = $detail_max_id->ID;
								$new_detail_id=$prefix[1]->PREFIX_VALUE.$new_td_row_id;
								$remarks=$this->_recMessages['setPayAmount'];
								$data_ordered1 = array ($new_detail_id, $transaction_id, $scheme_id,
									$this->_customerId, $this->_employeeId, 0,$pymnt_types[0]->VALUE_NAME, $voucher,$memo,
									$date, $remarks,$this->_customerName,$this->_customerGender, $new_td_row_id);
								$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
								if($status1 && $status2){
									$errors[$i+1]['status']=$this->_recMessages['statusSuccess'];
									$errors[$i+1]['skip']=false;
									$errors[$i+1]['error']=array('Error'=>'not found');
									$clear=true;
								}
								$payment_principle=0;
								$current_recipt_due =0;
								$current_recipt_amount=0;
								$current_recpt_fees=0;
								$current_recpt_security_depos=$current_recpt_donation=0;
								$scheme_id=$scheme;
								$trns_summary=$this->_trnModel->getTransactionSummaryQuery($transaction_id);
							}
							else
							{
						//		$this->view->optionsErrors=$select_check;
								$this->view->textErrors=$check;
								//print_r($check);
								$errors[$i+1]['status']=$this->_recMessages['statusFailed'];
								$errors[$i+1]['error']=$check;
								if($this->_skip==true) $errors[$i+1]['skip']=true;
								else $errors[$i+1]['skip']=false;
								$trnClearance=false;
								//$this->_trnModel->releaseLock('DETAILS');
								//$this->_trnModel->releaseLock('SUMMARY');
							}

						}
						if($trnClearance==true)
						{if($clear==true)
							{
								//die('Clear');
								$detail_max_id=null;
								$this->_trnModel->insertRowInDetailDML();
								$detail_max_id=$this->_trnModel->getLastInsertedId();
								//$this->_trnModel->releaseLock('DETAILS');
								$new_detail_id=$prefix[1]->PREFIX_VALUE.$detail_max_id->ID;
								$data_ordered1=array($new_detail_id, $transaction_id, $scheme_id,
									$this->_customerId, $this->_employeeId, $type,$memo,$amount,$date, $remarks,$detail_max_id->ID);
								$status1=$this->_trnModel->updateInsertedReceiptDetailDML($data_ordered1);
								//------------------------
								$amounts=$this->getReceiptAmountValueSet($recv_types,$amount,array($type, $current_recipt_amount, $current_recipt_due, $current_recpt_security_depos, $current_recpt_donation,$current_recpt_fees ));

								$total_recept_amount=$amounts[0];
								$total_recept_due=$amounts[1];
								$total_recept_security_depos=$amounts[2];
								$total_recept_donation=$amounts[3];
								$total_recept_fees=$amounts[4];
								//-------------------------

								$total_details_on_ts = $trns_summary[0]->TOTAL_DETAILS + 1;
								$data_ordered2=array($total_recept_amount, $total_recept_due,$total_recept_donation, $total_recept_fees, $total_recept_security_depos, $date, $total_details_on_ts, $transaction_id);
								$status2=$this->_trnModel->UpdateTrnSummaryByTsIdQuery($data_ordered2);
								if($status1!=null && $status2!=null){
									$this->_trnModel->commitTransaction();
								}

								//if($summaryid==true)
								//	$this->_trnModel->releaseLock($trn_identifier);
								//else $this->_trnModel->releaseLock('SUMMARY');

								if($status1!=null && $status2!=null){
									//die('I commit status');
									$this->view->statusMsg=$this->_recMessages['success'];
									$errors[$i+1]['status']=$this->_recMessages['statusSuccess'];
									$errors[$i+1]['error']=array('Error'=>'not found');
									$errors[$i+1]['skip']=false;
									$successResults[$no++]=array('customer'=>$this->_customerId, 
									'memo'=>$memo,'type'=>$type,'date'=>$date,'amount'=>$amount);
									$customer=$trnsSummaries=$memo=$transaction_id=$remarks=null;
									$amount=0; }
								else
								  $this->view->textErrors=$this->_recMessages['fail'];
						}
						else
						{
							//if($summaryid==true)
							//	$this->_trnModel->releaseLock($trn_identifier);
							//else $this->_trnModel->releaseLock('SUMMARY');

							$this->view->textInfo=$this->_recMessages['dbBusy'] . $this->_trnModel->printTotalProcessingTime('false');
						}}else
						{
							//die('Transaction Not clear');
						}
					}
					else{
						$msg=str_replace('@VAR1@',$transaction_id,$this->_recMessages['tranUseByOther']);
						$this->view->textInfo= $msg.$this->_trnModel->printTotalProcessingTime('false');
						//if($summaryid==true)
						//	$this->_trnModel->releaseLock($trn_identifier);
						//else $this->_trnModel->releaseLock('SUMMARY');
					}
				}
				else
				{
					$errors[$i+1]['status']=$this->_recMessages['statusFailed'];
					$errors[$i+1]['error']=$check;
					if($this->_skip==true) $errors[$i+1]['skip']=true;
					else $errors[$i+1]['skip']=false;
				}

				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++ END INSERTATION +++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			}
			$this->view->cust=$cust;
			$this->view->memo=$memono;
			$this->view->typ=$typ;
			$this->view->dt=$dt;
			$this->view->amnt=$amnt;
		}
		else
		{
			$o_cust=$o_memo=$o_typ=$o_amt=$o_dt=null;

			$copy=$this->getRequest()->getPost('copyRow');
			$ele=$this->getRequest()->getPost();

			//print_r($ele);

			if($this->view->rows==$copy)
					$this->view->rows++;

			for($i=0;$i<$this->view->rows;$i++)
				{
					if($i!=$copy)
					{
						if(isset($ele['customer'][$i]) && !empty($ele['customer'][$i]))
							$cust[$i]=$ele['customer'][$i];
						else $cust[$i]=null;
						if(isset($ele['memo'][$i]) && !empty($ele['memo'][$i]))
							$memono[$i]=$ele['memo'][$i];
						else $memono[$i]=null;
						if(isset($ele['receipt_type'][$i]) && !empty($ele['receipt_type'][$i]))
							$typ[$i]=$ele['receipt_type'][$i];
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
						$memono[$i]=$o_memo;
						$typ[$i]=$o_typ;
						$amnt[$i]=$o_amt;
						$dt[$i]=$o_dt;
					}

					if($i==$copy-1)
					{
						$o_cust=$cust[$i];
						$o_memo=$memono[$i];
						$o_typ=$typ[$i];
						$o_amt=$amnt[$i];
						$o_dt=$dt[$i];
					}
				}
			$this->view->cust=$cust;
			$this->view->memo=$memono;
			$this->view->typ=$typ;
			$this->view->dt=$dt;
			$this->view->amnt=$amnt;
		}

		//print_r($errors);
		$this->view->validationMsg=$errors;
		$this->view->sucsessfulEntries=$successResults;
		$this->_session->xlsResult=$successResults;
		$this->_session->xlsHeader=$this->_getMultiRecpInsertedResultsHeader();
		$this->_session->fileName=$this->_fileName;
	}

	protected function _getMultiRecpInsertedResultsHeader()
	{
		$lbl=$this->_labels;
		$header=array($lbl['customerCode'],$lbl['memo'],$lbl['type'], $lbl['date'],$lbl['amount']);
		return $header;
	}

	protected function validate($data,$row=null)
	{
		$errors=$msg=$current_row=$cust_id=$receive_type=
		$memo=$receive=$receiveAmount=$trans_date=null;

	//	print_r($data);
	//	die;
		$this->_skip=false;
		$element=new Bloomfi_App_UHtmlElement;

		if($row)$current_row="[Row - $row] ";

		if(isset($data['customer']))
			$cust_id = $data['customer'];
		if(isset($data['memo']))
			$memo = $data['memo'];
		if(isset($data['amount']))
			$receive=$data['amount'];
		if(isset($data['type']))
			$receive_type=$data['type'];
		if(isset($data['date']))
			$trans_date = $data['date'];

		if ( empty($cust_id) && empty($memo) && empty($receive_type) && empty($receive) && empty($trans_date) )
		{
			$this->_skip=true;
			return array('Error'=>true);
		}

		//------------------------Customer-----------------------------

		if($cust_id){
			$result = $this->_refModel->getCustomerQuery($cust_id);
			if(!$result){
				$msg=str_replace('@VAR1@',$cust_id,$this->_recMessages['customerInvalid']);
				$errors['Beneficiary'] = $current_row.$msg;
			}else{
				$this->_customerName=$result[0]->ENTITY_NAME;
				$this->_customerGender=$result[0]->SEX;
				$this->_customerId=$result[0]->ENTITY_ID;
				$this->_employeeId=$result[0]->PARENT_ENTITY_ID;
			}
		}
		else
			$errors['Beneficiary'] = $current_row.$this->_recMessages['customerEmpty'];


		//------------------------Receive-----------------------------

		if($memo) {
			if(!strstr($memo, " "))
			{
				$result=$this->_trnModel->isMemoNoQuery($memo);
				if($result){
					$msg=str_replace('@VAR1@',$memo,$this->_recMessages['duplicateMemo']);
					$errors['Memo'] = $current_row.$msg;
				}
			}else{
				$msg=str_replace('@s@','(s)',str_replace('@VAR1@',$memo,$this->_recMessages['receiptMemoSpaceExist']));
				$errors['Memo'] = $current_row.$msg;
			}
		}
		else{
			$errors['Memo'] = $current_row.$this->_recMessages['receiptMemoEmpty'];
		}

		$receiveAmount = $receive;

		if(!$receive_type)
			$errors['Type'] = $current_row.$this->_recMessages['receiptTypeEmpty'];

		if(!isset($errors['Type']))
		{
			if($this->_receiptTypes[1]->VALUE_NAME==$receive_type){
				$result=$this->_trnModel->isExistBSDReceiptTypeQuery(array($cust_id,$this->_receiptTypes[1]->VALUE_NAME));
				if($result) $errors['Type']=str_replace('@VAR1@',$cust_id,$this->_recMessages['receiptType']);
			}
		}

		if($trans_date) {
			$msg=$element->checkElementDate('Date',$trans_date);
			if($msg) $errors['Date'] = $current_row.$msg;
		}else
		{
			$errors['Date'] = $current_row.$this->_recMessages['dateEmpty'];
		}

		if($receiveAmount) {
			if($receiveAmount < 0)
				$errors['Amount'] = $current_row.$this->_recMessages['receiptValueInvalid']; }
		else
			$errors['Amount'] = $current_row.$this->_recMessages['receiptEmpty'];

		ob_flush();
		flush();

		//$errors['TEST'] = 'Error';

		//print_r( $errors );
		return $errors;
	}
}

?>
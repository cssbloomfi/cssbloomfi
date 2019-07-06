<?php
class Trn_Multipaycust2Controller extends modules_trn_controllers_TrnController
{
	protected $_refModel;
	protected $_trnModel;
	protected $_payment_type_key;
	protected $_paymentKey1='CAPITAL_PAID';
	protected $_paymentKey2='BSD_PAID';
	protected $_element;
	protected $_customerEntry;
	protected $_startId=1;
	protected $_labels=null;
	protected $_fileName='Inserted-Beneficiary-Payment';

	function preDispatch()
	{
		$this->_initialize();
		$this->_element=new Bloomfi_App_UHtmlElement;
	}

    function indexAction()
    {
		$statusMsg=null;
		$message = new modules_trn_messages_message;
		$this->_payMessages=$message->getTrnMultiPaymentMessages('multiPayment');
		$this->statusMsg=$message->getTrnMultiPaymentMessages('statusMsg');
		$cust=$emp=$schm=$typ=$amnt=$dt=$row1=$max_ent_id=null;
		$errors=$successResults=$no=null;
		$s_id=$c_id=$e_id=$flag=$check=$type=$vouchers=$data=$voucher_ids=$result=$summary_info=
		$search_params=$memo=$error=$gender=$sex=$custnm=$loc=$msg_status=null;
		$this->view->title = $this->statusMsg['title'];
		$this->_refModel = new modules_ref_models_refAccessQuery;
		$this->_trnModel = new modules_trn_models_trnAccessQuery;
		$this->_trnConfig = new modules_trn_config_trnConfig;
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
		$this->_labels=$this->view->formLabel=$labels->getTrnPaymentCustFormLabels('addTran');
		$this->view->numRowsLabel=$labels->getTrnPaymentCustFormLabels('row_nums');
		$this->view->statusLabel=$labels->getTrnPaymentCustFormLabels('status');
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
				$no=0;
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
			/*		if(isset($ele['payment_type'][$i]) && !empty($ele['payment_type'][$i]))
						$typ[$i]=$ele['payment_type'][$i];
					else $typ[$i]=null;   */
					if(isset($ele['amount'][$i]) && !empty($ele['amount'][$i]))
						$amnt[$i]=$ele['amount'][$i];
					else $amnt[$i]=null;
					if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
						$dt[$i]=$ele['date'][$i];
					else $dt[$i]=null;
					if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
						$custage[$i]=$ele['age'][$i];
					else $custage[$i]=0;

					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//+++++++++++++++++++++++++++++ START INSERTATION ++++++++++++++++++++++++
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


				//	$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
				//	$insertmsg= $message->getTrnPaymentMessages('dbEntry');
				//	$this->view->summaryTableHeader=$labels->getTrnPaymentTableLabels('summaryPmnt');
					
					$c_nm=$custnm[$i];
					$gender=$sex[$i];
					$location = $loc[$i];
					$e_id=$emp[$i];
					$s_id = $schm[$i];
					$date = $dt[$i];
					$amount = $amnt[$i];
                                        $age = $custage[$i];
				//	$type = $typ[$i];
					$voucher = strtoupper($c_id);
					$remarks ='';
					$check=$select_check=null;

					//PAYMENT FORM VALIDATION-------------

					$check=$this->validate(array('customerName'=>$c_nm,'sex'=>$gender,'location'=>$location,
                                                                     'employee'=>$e_id,'scheme'=>$s_id,'amount'=>$amount,'date'=>$date,'age'=>$age));

					//echo $check;
					//-------------------------------------
					if(!$check)
					{
						$this->_trnModel->startTransaction();

						//--------------------------------------------------------
						$this->_refModel->insertRowInEntityTblDML();
						$max_id=$this->_refModel->getLastInsertedId();
						$max_ent_id=$this->_refModel->getEntityMaxIdOnSchemeQuery($s_id);
						if($max_ent_id)$entNewIDNo=$max_ent_id->ID + 1;
						else $entNewIDNo = $this->_startId;
						//print_r($max_id);
						$entity_unique_id = $custprefix[0]->PREFIX_VALUE.$max_id->ID;
						$c_id=$entity_id=$s_id.$entNewIDNo;
						$addr_id = $custprefix[2]->PREFIX_VALUE.$max_id->ID;
						$datas_ordered_1 = array( $entity_id, $static[0]->VALUE_NAME, $emp[$i], null, $c_nm, $age, $gender, $c_id, $entity_unique_id,$date, $location, $addr_id, $date, null,null,$s_id,$max_id->ID);
						// print_r($datas_ordered_1);
						// die;
						$datas_ordered_2 = array( $addr_id, null );
						$res1=$this->_refModel->updateInsertedCustomerDML($datas_ordered_1);
						$res2=$this->_refModel->InsertEntityAddressQuery($datas_ordered_2);
						//---------------------------------------------------------

						// die;
						// Action for CAPITAL_PAID
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

						$data_ordered = array( $new_trns_id,$s_id,$c_id,
							$emp[$i], $amount, $due_amount,$date,$remarks,$new_ts_row_id);
						$data_ordered1 = array ($new_detail_id, $new_trns_id, $s_id,
						$c_id, $emp[$i], $amount, $pay_types[$this->_paymentKey1], $c_id,$memo,
						$date, null, $c_nm, $gender, $new_td_row_id);

						$status1=$this->_trnModel-> updateInsertedCustPaymentDML($data_ordered);
						$status2=$this->_trnModel-> updateInsertedPaymentDetailDML($data_ordered1);
						if($status1&&$status2){
							$msg_status[$i+1]['error']['Error']=$this->statusMsg['notFound'];
							$msg_status[$i+1]['status']=$this->statusMsg['success'];
							$msg_status[$i+1]['skip']=false;
							$this->_trnModel->commitTransaction();
							$successResults[$no++]=array('custname'=>$c_nm,'custcode'=>$c_id,
							'empcode'=>$emp[$i],'gender'=>$gender,'project'=>$s_id,
							'location'=>$location,'amount'=>$amount,
							'date'=>$date,'age'=>$age);
						 }
						else
						  $this->view->textErrors=$this->statusMsg['notInsert'];

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

					$this->view->employee=$e_id;
					$this->view->customer=$c_id;
					$this->view->scheme=$s_id;
					$this->view->amount=$amount;
					$this->view->voucher=$voucher;
					$this->view->remarks=$remarks;
					$this->view->pdate =$date;
                                        $this->view->age=$age;

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
			//	$this->view->typ=$typ;
				$this->view->dt=$dt;
				$this->view->amnt=$amnt;
                                $this->view->age=$custage;

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
			$o_custnm=$o_sex=$o_loc=$o_cust=$o_emp=$o_schm=$o_typ=$o_amt=$o_dt=$o_amt=$o_age=null;

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
					/*	if(isset($ele['payment_type'][$i]) && !empty($ele['payment_type'][$i]))
							$typ[$i]=$ele['payment_type'][$i];
						else $typ[$i]=null; */
						if(isset($ele['amount'][$i]) && !empty($ele['amount'][$i]))
							$amnt[$i]=$ele['amount'][$i];
						else $amnt[$i]=null;
						if(isset($ele['date'][$i]) && !empty($ele['date'][$i]))
							$dt[$i]=$ele['date'][$i];
						else $dt[$i]=null;
                                                if(isset($ele['age'][$i]) && !empty($ele['age'][$i]))
							$custage[$i]=$ele['age'][$i];
						else $custage[$i]=null;
					}else
					{
						$custnm[$i]=$o_custnm;
						$sex[$i]=$o_sex;
						$loc[$i]=$o_loc;
						$cust[$i]=$o_cust;
						$emp[$i]=$o_emp;
						$schm[$i]=$o_schm;
					//	$typ[$i]=$o_typ;
						$amnt[$i]=$o_amt;
						$dt[$i]=$o_dt;
                                                $custage[$i]=$o_age;
					}

					if($i==$copy-1)
					{
						$o_custnm=$custnm[$i];
						$o_sex=$sex[$i];
						$o_loc=$loc[$i];
						$o_cust=$cust[$i];
						$o_emp=$emp[$i];
						$o_schm=$schm[$i];
					//	$o_typ=$typ[$i];
						$o_amt=$amnt[$i];
						$o_dt=$dt[$i];
                                                $o_age=$custage[$i];                                                
					}
				}
			$this->view->custNm=$custnm;
			$this->view->sx=$sex;
			$this->view->locs=$loc;
			$this->view->cust=$cust;
			$this->view->emp=$emp;
			$this->view->schm=$schm;
		//	$this->view->typ=$typ;
			$this->view->dt=$dt;
			$this->view->amnt=$amnt;
                        $this->view->age=$custage;
		}
	}

	protected function _getMultiCustPayInsertedResultsHeader()
	{
		$lbl=$this->_labels;
		$header=array($lbl['customerName'],$lbl['customerCode'],$lbl['collectorCode'], 
		$lbl['sex'],$lbl['scheme'], $lbl['location'],$lbl['amount'], $lbl['date']);
		return $header;
	}

	protected function validate($data,$row=null)
	{
		$msg_status=$msg=$current_row=$emp_id=$cust_id=$scheme_id=$location=$payment_type=
		$voucher_no=$scheme=$payment=$paymentAmount=$trans_date=$cust_nm=$loc=$sex=$isExist=null;

		if($row)$current_row="[Row - $row] ";
		$this->_customerEntry=false;
		$element=new Bloomfi_App_UHtmlElement;

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


		if ( empty($cust_nm) && empty($sex) && empty($location[0]) && empty($emp_id) &&
                    empty($scheme) && empty($cust_id) && empty($payment) && empty($payment_type) &&
                    empty($trans_date) && (empty($age) || $age==0) )
		{
			$this->_skip=true;
			return array('Error'=>true);
		}


		$msg=$this->_element->checkElementAlpha('Beneficiary Name',$cust_nm,50,3);
		if($msg) $msg_status['Beneficiary&nbsp;Name'] = $current_row.$msg;
		$msg=$this->_element->checkElementSelect('','Gender',$sex);
		if($msg) $msg_status['Gender'] = $current_row.$msg;
		$msg=$this->_element->checkElementSelect('','Location',$location);
		if($msg) $msg_status['location'] = $current_row.$msg;
		$msg=$this->_element->checkElementSelect('','Project',$scheme);
		if($msg) $msg_status['Project'] = $current_row.$msg;
		$result=$this->_refModel->getEmployeeQuery($emp_id);
		if(!$result){
			$msg=$msg=str_replace('@VAR1@',$emp_id,$this->_payMessages['employeeInvalid']);
			$msg_status['Collector'] = $current_row.$msg;
		}
			
		//print_r($data);
		//die;

		

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
                
                if($age>99 || $age<0){
                    $msg_status['Age']=$current_row.$this->_payMessages['invalidAge'];
                }

		if(!$trans_date) {
			$msg_status['Date'] = $current_row.$this->_payMessages['dateEmpty'];
		}else
		{
			$msg=$element->checkElementDate('Date',$trans_date);
			if($msg) $msg_status['Date'] = $current_row.$msg;
		}

		if(!$msg_status){
			$payment_datas =array($cust_id,$scheme, $payment_type);
			$isExist=$this->_trnModel->getPaymentTrnsIdQuery($payment_datas);
			if($isExist) $msg_status['Project']="Project is given to client";
		}

		ob_flush();
		flush();

		//print_r( $msg_status );
		return $msg_status;
	}
}

?>
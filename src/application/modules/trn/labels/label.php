<?php

class modules_trn_labels_label extends Bloomfi_App_Ulibrary
{

	/*-------------------- Form lables -------------------------------------------------*/

	//Function to get Payment Form labels  
	public function getTrnPaymentFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/paymentFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Receive Form labels  
	public function getTrnReceiveFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/receiveFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Receive Form labels  
	public function getTrnExcelFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/excelFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get multi payment cust Form labels
	public function getTrnPaymentCustFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/multiPaymentCustFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get multi payment Form labels
	public function getTrnMultiPayFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/multiPayFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get multi Receipt Form labels
	public function getTrnMultiRecFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/multiRecFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Cust payment Excel Form labels
	public function getTrnCustPayExcelFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/custPayExcelFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	/*-------------------- Table Labels -------------------------------------------------*/

	public function getTrnPaymentTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/paymentTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnReceiveTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/receiveTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnExcelTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/excelTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnCustPayExcelTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/custPayExcelTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	/*-------------------- View Labels -------------------------------------------------*/


	public function getTrnPaymentViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/paymentViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnReceiveViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/receiveViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnExcelViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/excelViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	public function getTrnCustPayExcelViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/custPayExcelViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	/*----------------- All Hyperlinks ----------------------*/

	public function getTrnAllLinkLabels($key)
	{
		$path = ROOT_DIR."/application/modules/trn/labels/allLinkLabel.ini";
		return $this->getIniLabels($path,$key);
	}
}
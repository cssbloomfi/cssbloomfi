<?php

class modules_trn_messages_message extends Bloomfi_App_Ulibrary
{
	//Function to get Messages related with Payment
	public function getTrnPaymentMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/paymentMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with Multiple Payment Entry
	public function getTrnMultiPaymentMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/multiPaymentMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with Receive
	public function getTrnReceiveMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/receiveMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with Receive
	public function getTrnMultiReceiveMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/multiReceiptMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with Excel
	public function getTrnExcelMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/excelMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with Excel
	public function getTrnCustPayExcelMessages($key)
	{
		$path = ROOT_DIR."/application/modules/trn/messages/custPayExcelMessages.ini";
		return $this->getIniMessages($path,$key);
	}

}
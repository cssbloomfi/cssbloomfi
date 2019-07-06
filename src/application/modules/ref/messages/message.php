<?php

class modules_ref_messages_message extends Bloomfi_App_Ulibrary
{
	//Function to get Messages related with location
	public function getRefLocationMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/locationMessages.ini";
		return $this->getIniMessages($path,$key);

	}

	//Function to get Messages related with customer
	public function getRefCustomerMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/customerMessages.ini";
		return $this->getIniMessages($path,$key);

	}

	//Function to get Messages related with employee
	public function getRefEmployeeMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/employeeMessages.ini";
		return $this->getIniMessages($path,$key);

	}

	//Function to get Messages related with scheme
	public function getRefSchemeMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/schemeMessages.ini";
		return $this->getIniMessages($path,$key);

	}

	//Function to get Messages related with Customer Excel
	public function getCustomerExcelMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/customerExcelMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//function to get messages related with multi cust
	public function getRefMultiCustMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/multicustMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	public function getRefMultiCollMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/multicollMessages.ini";
		return $this->getIniMessages($path,$key);
	}
	
	public function getRefMultiSchemeMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/multischemelMessages.ini";
		return $this->getIniMessages($path,$key);
	}
	
	public function getRefMultiLocationMessages($key)
	{
		$path = ROOT_DIR."/application/modules/ref/messages/multilocationMessages.ini";
		return $this->getIniMessages($path,$key);
	}
}
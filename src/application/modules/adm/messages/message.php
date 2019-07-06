<?php

class modules_adm_messages_message extends Bloomfi_App_Ulibrary
{
	//Function to get Messages related with user creation
	public function getAdmUserCreationMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/userCreationMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with role creation
	public function getAdmRoleCreationMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/roleCreationMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with role & user
	public function getAdmMapRoleToUserMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/mapRoleToUserMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//Function to get Messages related with role & menu
	public function getAdmMapMenuToRoleMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/mapMenuToRoleMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//function to get messages related with comp access
	public function getCompaccessMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/compAccessMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//function to get messages relatedwith comp screen
	public function getCompScreenMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/compScreenMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	//function to get messages related to cust xls log management
	public function getCustXlsLogMgtMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/custXlsLogManagementMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	public function getLogManagementMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/logManagementMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	public function getTranXlsLogManagementMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/tranXlsLogManagementMessages.ini";
		return $this->getIniMessages($path,$key);
	}

	public function getXlsManagementMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/XlsManagementMessages.ini";
		return $this->getIniMessages($path,$key);
	}
	
	public function getFinYearCreationMessages($key)
	{
		$path = ROOT_DIR."/application/modules/adm/messages/finyearMessages.ini";
		return $this->getIniMessages($path,$key);
	}
}
<?php

class modules_adm_labels_label extends Bloomfi_App_Ulibrary
{
	//Function to get user creation labels 
	public function getUserCreationLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/userCreation.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get role creation labels 
	public function getRoleCreationLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/roleCreation.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get map menu to role labels 
	public function getMapMenuToRoleLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/mapMenuToRole.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get map role to user labels 
	public function getMapUserToRoleLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/mapUserToRole.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get map comp group to roles
	public function getMapGroupToRoleLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/compaccessFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//function to get the entry labels 
    public function getCompAccessEntryLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/compaccessEntryLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//function to get the comp screen form labels
	public function getCompScreenFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/compscreenFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//function to get the log file management labels
	public function getLogFileMgtLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/logfilemanagementFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	// function to get the log management labels
	public function getLogMgtLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/logmanagementFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}
	
	public function getFinYearFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/adm/labels/finyearFormLabels.ini";
		return $this->getIniLabels($path,$key);
	}
}
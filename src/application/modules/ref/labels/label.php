<?php

class modules_ref_labels_label extends Bloomfi_App_Ulibrary
{
	//Function to get Customer Form labels 
	public function getCustomerFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Employee Form labels  
	public function getEmployeeFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/employeeFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}


	//Function to get location Form labels  
	public function getlocFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/locationFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get scheme Form labels  
	public function getSchemeFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/schemeFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Customer Upload Form labels  
	public function getCustomerExcelFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerExcelFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Customer Table labels  
	public function getCustomerTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Employee Table labels  
	public function getEmployeeTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/employeeTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Location Table labels  
	public function getLocationTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/locationTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Scheme Table labels  
	public function getSchemeTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/schemeTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Customer Upload Table labels  
	public function getCustomerExcelTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerExcelTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Customer view labels  
	public function getCustomerViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Employee view labels  
	public function getEmployeeViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/employeeViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Employee view labels  
	public function getLocationViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/locationViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Scheme view labels  
	public function getSchemeViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/schemeViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Customer upload view labels  
	public function getCustomerExcelViewLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/customerExcelViewLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get Employee view labels  
	public function getAllLinkLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/allLinkLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//function to get multi cust view labels
	public function getRefMultiCustFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/multicustFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	/**
	  *  function to get multi collector form labels 
	  */
	public function getRefMultiCollFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/multicollFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}
	
	/**
	  *  function to get multi scheme form labels 
	  */
	public function getRefMultiSchemeFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/multischemeFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}
	
	public function getRefMultiLocationFormLabels($key)
	{
		$path = ROOT_DIR."/application/modules/ref/labels/multilocationFormLabel.ini";
		return $this->getIniLabels($path,$key);
	}

}
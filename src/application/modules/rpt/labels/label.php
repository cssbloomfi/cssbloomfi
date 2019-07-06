<?php

class modules_rpt_labels_label extends Bloomfi_App_Ulibrary
{
	//Function to get Customer report table labels 
	public function getCustomerReportTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/customerReport/customerReportTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get report 1 table labels 
	public function getReport1TableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/report1/report1TableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get invest summary report table labels 
	public function getInvestSummaryTableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/investSummary/investSummaryTableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get report 2 table labels 
	public function getReport2TableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/report2/report2TableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get report 3 table labels 
	public function getReport3TableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/report3/report3TableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get report 4 table labels 
	public function getReport4TableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/report4/report4TableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

	//Function to get report 5 table labels 
	public function getReport5TableLabels($key)
	{
		$path = ROOT_DIR."/application/modules/rpt/labels/report5/report5TableLabel.ini";
		return $this->getIniLabels($path,$key);
	}

}
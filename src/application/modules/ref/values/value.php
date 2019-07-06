<?php

class modules_ref_values_value extends Bloomfi_App_Ulibrary
{
	//Function to get Form Values from 
	public function getDefaultFormValues($key)
	{
		$path = ROOT_DIR."/application/modules/ref/values/locationFormDefaultValue.ini";
		return $this->getIniValues($path,$key);
	}

}
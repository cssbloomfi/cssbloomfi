<?php

class modules_ref_config_refConfig extends Bloomfi_App_Ulibrary
{
	//Function to get ref config values
	public function getConfigValues($key)
	{
		$path = ROOT_DIR."/application/modules/ref/config/refConfig.ini";
		return $this->getIniValues($path,$key);
	}

}
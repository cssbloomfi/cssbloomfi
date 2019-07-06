<?php

class modules_trn_config_trnConfig extends Bloomfi_App_Ulibrary
{
	//Function to get ref config values
	public function getConfigValues($key)
	{
		$path = ROOT_DIR."/application/modules/trn/config/trnConfig.ini";
		return $this->getIniValues($path,$key);
	}

}
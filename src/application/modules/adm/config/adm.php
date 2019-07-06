<?php

class modules_adm_config_adm extends Bloomfi_App_Ulibrary
{
	//Function to get adm config values
	public function getConfigValues($key)
	{	
		$path = ROOT_DIR."/application/modules/adm/config/adm.ini";
		return $this->getIniValues($path,$key);
	}

}
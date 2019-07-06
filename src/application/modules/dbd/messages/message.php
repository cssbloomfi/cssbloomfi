<?php

class modules_dbd_messages_message extends Bloomfi_App_Ulibrary
{
	//Function to get Messages related with location
	public function getDbdErrorMessages($key)
	{
		$path = ROOT_DIR."/application/modules/dbd/messages/errorMessages.ini";
		return $this->getIniMessages($path,$key);
	}

}
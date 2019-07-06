
<?php

class Bloomfi_App_Messages_Message extends Bloomfi_App_Ulibrary
{
	//Function to get Messages 
	public function getValidationMessages($key)
	{
		$path = ROOT_DIR."/library/Bloomfi/App/Messages/validationMessages.ini";
		return $this->getIniMessages($path,$key);
	}
}
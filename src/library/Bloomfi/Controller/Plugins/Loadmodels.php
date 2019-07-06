<?php 
class Bloomfi_Controller_Plugins_Loadmodels extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        set_include_path(ROOT_DIR . '/application/modules/'.$request->getModuleName().'/models' . PATH_SEPARATOR . INCLUDE_PATH);
		$this->loadModuleConfig($request);
    }

	private function loadModuleConfig($request){
		$registry = Zend_Registry::getInstance();
		$logger = $registry->get('fileLogger');

		$moduleConfigPath = ROOT_DIR . '/application/modules/'.$request->getModuleName().'/config/';
		$moduleConfigFileName = $request->getModuleName().".ini";
		$moduleConfigKey = $request->getModuleName()."CFG";
		
		if (!Zend_Registry::isRegistered($moduleConfigKey)) {
			if (file_exists($moduleConfigPath . $moduleConfigFileName)) {
				$config = new Zend_Config_Ini($moduleConfigPath . $moduleConfigFileName);	
				$registry[$moduleConfigKey] = $config;

			}else{
				$logger->info(" ** Unable to load ModuleConfig file. [ ". $moduleConfigPath . $moduleConfigFileName ." ]" );
			}
		}
		else
		{
		//	$logger->info(" ** $moduleConfigKey ** Registered " );
		}
	}
}
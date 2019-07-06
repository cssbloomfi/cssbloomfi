<?php
require_once 'Zend/Loader.php';

class Bootstrap
{

    public static $frontController = null;

    public static $root = '';

    public static $registry = null;

    public static $fileLogger = null;

    //Primary function will be called first from index.php, it will call rest of functions to boot
    public static function run()
    {
        self::prepare();
        try{
			$response = self::$frontController->dispatch();
		}catch (Exception $e){
			echo $e;

			self::$fileLogger->log($e->getMessage(), 1);
		}
        self::sendResponse($response);
    }

    /*It is used to prepare from macro view.
	It gives macro view idea about preparation.
	Sequence of each call is important.
	*/
	public static function prepare()
    {
        self::setupPath();
    	self::setupErrorReporting();

		//To load all classes automatically, without include or require statement
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();
		$loader->setFallbackAutoloader(true)->registerNamespace('Modules_');

        self::setupRegistry();
        self::setupConfiguration();
		self::setupLogger();
		self::setupRouter();
        self::setupFrontController();
        self::setupView();
		self::setupDateTime();
        self::setupDatabase();
		self::setupSession();
		self::setupControllerQueryLib();
		self::setupBusinessQueryLib();
		self::setupUI();
		self::setupChart();
    }

    //Error reporting setting
	public static function setupErrorReporting()
    {
    	error_reporting(E_ALL|E_STRICT);
		//error_reporting(E_ALL ^ E_NOTICE);
    	ini_set('display_errors', false);
    }

    //Path settings will be done using this
	public static function setupPath()
    {
        $root = dirname(dirname(__FILE__));
		set_include_path(
		    $root . '/library' . PATH_SEPARATOR .
			$root . '/Zend' . PATH_SEPARATOR .
			$root . '/application' . PATH_SEPARATOR .
			$root . '/application/themes' . PATH_SEPARATOR .
			$root . '/application/models' . PATH_SEPARATOR .
			$root . '/application/models/query' . PATH_SEPARATOR . get_include_path()
		);
        self::$root = dirname(dirname(__FILE__));
		define('MODULES', ROOT_DIR.'/application/modules');
    }

	//Date time setting will be done here
	public static function setupDateTime()
	{
		date_default_timezone_set('Europe/London');
	}

    //Registry setting will be done here.
	public static function setupRegistry()
    {
        self::$registry = new Zend_Registry(array(), ArrayObject::ARRAY_AS_PROPS);
        Zend_Registry::setInstance(self::$registry);
    }

    //Configuration file reading & setting up configuration will be done using following.
	public static function setupConfiguration()
    {
        $config = new Zend_Config_Ini(
            self::$root . '/application/config/config.ini',
            'general'
        );
        self::$registry->configuration = $config;
		if (!Zend_Registry::isRegistered('applConfig'))
		{
			 self::$registry->applConfig = self::$root . '/application/config/xlscfg.ini';
		}
    }

    //Important: Setting of front controller will done here.
	public static function setupFrontController()
    {
        self::$frontController = Zend_Controller_Front::getInstance();
        self::$frontController->throwExceptions(false);
        self::$frontController->returnResponse(true);
		self::$frontController->addModuleDirectory(self::$root . '/application/modules');
		self::$frontController->setModuleControllerDirectoryName("controllers");
		self::$frontController->setDefaultModule("dbd");
        self::$frontController->setParam('registry', self::$registry);
		// Error Handler plugin
		/*
		$plugin = new Zend_Controller_Plugin_ErrorHandler();
		$plugin->setErrorHandlerModule('dbd')
			->setErrorHandlerController('error')
			->setErrorHandlerAction('error');
	    self::$frontController->registerPlugin($plugin);
		*/
		/*
		$front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
			'module'     => 'error',
			'controller' => 'error',
			'action'     => 'error'
		)));
		*/
		//$router = self::$frontController->getRouter();
		//self::$fileLogger->info("Router Array" . var_dump($router));
		//$route = new Zend_Controller_Router_Route(':module/:controller/:action/*', array('module' => 'default'));
		//$router->addRoute('default', $route);

		self::$frontController->registerPlugin(new Bloomfi_Controller_Plugins_Loadmodels());
		self::$frontController->registerPlugin(new Bloomfi_Controller_Plugins_Access());

		//self::$frontController->registerPlugin(new Bloomfi_Controller_Plugins_Noroute());
		define('INCLUDE_PATH', get_include_path());

    }

	public static function setupRouter()
	{
		$router = new Zend_Controller_Router_Rewrite();
		$route = new Zend_Controller_Router_Route(':module/:controller/:action/*', array('module' => 'default'));
		$router->addRoute('default', $route);
	}
    /*View setup will be done here.
	Setup view encoding, layout setup also done here
	*/
	public static function setupView()
    {
        $view = new Zend_View;
        $view->setEncoding('UTF-8');
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
        Zend_Layout::startMvc(
			array(
                'layoutPath' => self::$root . '/application/layouts'
			)
        );
    }

    /*DB setup done here.
	Read configuration, create db instance & set in registry to use in other part of application.*/
	public static function setupDatabase()
    {
        $config = self::$registry->configuration;
        $db = Zend_Db::factory($config->db->adapter, $config->db->toArray());
        $db->query("SET NAMES 'utf8'");
        self::$registry->database = $db;
        Zend_Db_Table::setDefaultAdapter($db);
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$db->query('SET group_concat_max_len := @@max_allowed_packet');
		Zend_Registry::set("dbConnection", $db);
    }

    //Response will be sent from following function, also set header for response.
	public static function sendResponse(Zend_Controller_Response_Http $response)
    {
      //  $response->setHeader('Content-Type', 'text/html; charset=UTF-8', true);
    	$response->sendResponse();
    }

	//Logger setup will can be done using following
	public static function setupLogger()
	{
		/**
		* Create a log formatter
		*/
		$format = '<%timestamp% %priorityName% (%priority%)>:: %message%' . PHP_EOL;
		$formatter = new Zend_Log_Formatter_Simple($format);

		/**
		* Create a file logger
		*/
		$stream = @fopen(self::$root . "/tmp/logs/" . date("Y-m-d") . ".php", 'a', true);

		if (!$stream)
		{
			throw new Exception('Failed to open stream');
		}
		try
		{
			$config = self::$registry->configuration;
			$fileWriter = new Zend_Log_Writer_Stream($stream);
			if($config->log->level){
				$logLevel=(integer)$config->log->level;
				$filter = new Zend_Log_Filter_Priority($logLevel);
				$fileWriter->addFilter($filter);
			}
			$fileWriter->setFormatter($formatter);
			$fileLogger = new Zend_Log($fileWriter);
			self::$fileLogger = $fileLogger;
			Zend_Registry::set("fileLogger", $fileLogger);
		}
		catch (Zend_Log_Exception $e){
			echo "Error: " . $e->getMessage();
		}
		catch (Zend_Exception $e){
			echo "Error: " . $e->getMessage();
		}
	}

	/*
	Zend session setting done here.
	*/
	public static function setupSession()
	{
		try
		{
			Zend_Session::setOptions(array(
				'save_path' => self::$root . "/tmp/sessions",
				'remember_me_seconds' => 7200,
		));
		Zend_Session::start();
		}
		catch (Zend_Session_Exception $e)
		{
			//$dbLogger->log('Error: ' . $e->getMessage(), 1);
			self::$fileLogger->log($e->getMessage(), 1);
		}

		$defaultNs = new Zend_Session_Namespace('default');
		$sql = new Zend_Session_Namespace('SQL');
		$application = new Zend_Session_Namespace('application');

		Zend_Registry::set("defaultNs", $defaultNs);
		Zend_Registry::set("SQL", $sql);
		Zend_Registry::set('application',$application);

		self::$fileLogger->info("Bootstrap Sessions setup finished!");
		/*if($config->log_level == 2)
		{
			$fileLogger->info("Sessions setup finished!");
		}
		*/
	}

	public static function setupUI()
	{
		$session=Zend_Registry::get('SQL');
		if(!$session->images && !$session->theme){
			$lib=new Bloomfi_App_Ulibrary;
			//Theme setup
			if(!$session->theme){
				$config = self::$registry->configuration;
				if(!is_dir(ROOT_DIR."/application/themes/".$config->thm->activeTheme))
					die("Theme folder is not Found");
				else{
					$session->theme=array('activeTheme'=>$config->thm->activeTheme, 'themePath'=>ROOT_DIR."/application/themes/".$config->thm->activeTheme);
					self::$fileLogger->info("Theme path initialized");
				}
			}
			//Image setup
			if(!$session->images){
			//	$themefolder=$session->theme['activeTheme'];
				$path = $session->theme['themePath']."/config/imgConfig.ini";
				$session->images=$lib->getIniParameters($path,'image','img');
			}
			unset($lib);
		}
	}

	public static function setupChart()
	{
		$session=Zend_Registry::get('SQL');
		if(!$session->activeChart){
			$config = self::$registry->configuration;
			if(!is_dir(ROOT_DIR."/charts/".$config->comp->activeChart))
				die("Chart folder '".$config->comp->activeChart."' is not Found");
			else{
				$session->chart=array('activeChart'=>$config->comp->activeChart, 'chartPath'=>ROOT_DIR."/charts/".$config->comp->activeChart);
				self::$fileLogger->info("Chart path initialized");
			}
		}
	}

	//Path settings will be done using this
	public static function setupControllerQueryLib()
    {
		define('ACCESS_QUERY_LIB', ROOT_DIR . "/application/models/query/AccessQueryLibrary.xml");
		define('BLOOMFI_ACCESS_QUERY_LIB', ROOT_DIR . "/library/Bloomfi/Models/Query/AccessQueryLibrary.xml");
  	}

	//Path settings will be done using this
	public static function setupBusinessQueryLib()
    {
		define('BSD_QUERY_LIB', ROOT_DIR . "/application/modules/rpt/models/query/BsdQueryLibrary.xml");
		define('ADM_QUERY_LIB', ROOT_DIR . "/application/modules/adm/models/query/admAccessQueryLibrary.xml");
		define('DBD_MASTER_LIB' , ROOT_DIR . "/application/modules/dbd/models/query/dbdAccessQueryLibrary.xml");
		define('REF_MASTER_LIB' , ROOT_DIR . "/application/modules/ref/models/query/refAccessQueryLibrary.xml");
		define('TRN_MASTER_LIB' , ROOT_DIR . "/application/modules/trn/models/query/trnAccessQueryLibrary.xml");
		define('REF_TEST_LIB' , ROOT_DIR . "/application/modules/ref/models/query/TestQuery.xml");
		define('TST_LIB' , ROOT_DIR . "/application/modules/tst/models/query/tstAccessQueryLibrary.xml");
		define('CUSTOMER_LIB' , ROOT_DIR . "/application/modules/rpt/models/query/CustomerQueryLibrary.xml");
  	}

}

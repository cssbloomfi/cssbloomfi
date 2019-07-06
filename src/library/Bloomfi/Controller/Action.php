<?php
abstract class Bloomfi_Controller_Action extends Zend_Controller_Action
{
	protected $_redirector;
	protected $_flashMessenger;
	private $registry;
	private $modConfig;

	public function init()
	{
		$this->registry =  Zend_Registry::getInstance();
		$this->_flashMessenger 	= $this->_helper->getHelper('FlashMessenger');
		$this->_redirector = $this->_helper->getHelper('Redirector');
		//parent::preDispatch();
		//$this->$modConfig = $this->registry->get($this->_request->getModuleName()."CFG");
	}
	protected function flash($message,$to)
	{
		$this->_flashMessenger->addMessage($message);
		$this->_redirector->gotoUrl($to);
	}
	protected function addflash($message)
	{
		$this->_flashMessenger->addMessage($message);

	}
	protected function redirect($to)
	{
		$this->_redirector->gotoUrl($to);

	}

	protected function setMessages()
	{
		$this->view->messages = join("<br/>",$this->_flashMessenger->getMessages());
	}
    public function postDispatch()
	{
		$this->setMessages();
		parent::postDispatch();
	}

	public function initView()
	{
		if (null === $this->view) {
            if (Zend_Registry::isRegistered('view')) {
                $this->view = Zend_Registry::get('view');
            } else {
                $this->view = new Zend_View();
                $this->view->setBasePath(dirname(__FILE__) . '/../module/views');
            }
		}
		$this->$fileLogger->info("Something from Bloomfi Extended Abstract Controller!");
		return $this->view;
	}

	public function isEmpty($obj){
		if (count($obj)<1){
			return true;
		}else{
			return false;
		}
	}
	public function getDbConnection(){
		/*$registry = Zend_Registry::getInstance();
		$config= $registry->get("configuration");
		$db = Zend_Db::factory($config->db);
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		return $db;*/

		$db= $this->registry->get("database");
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		return $db;
	}

	public function getModuleConfig(){
		$this->modConfig = $this->registry->get($this->_request->getModuleName()."CFG");
		return $this->modConfig;
	}
}
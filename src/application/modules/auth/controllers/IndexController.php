<?php
class Auth_IndexController extends Bloomfi_Controller_Action
{
	protected $_session;
	protected $_userName;

	public function preDispatch()
	{
		$this->_session=Zend_Registry::get('SQL');
	}

	public function getAuthAdapter(array $params)
    {
		$registry = Zend_Registry::getInstance();
		$authAdapter  = new Zend_Auth_Adapter_DbTable($registry->database);
		$authAdapter->setTableName('ref_mst_user');
		$authAdapter->setIdentityColumn('USER_ID');
		$authAdapter->setCredentialColumn('USER_PASSWORD');
		$this->_userName=$username = $params['username'];
		$password = $params['password'];
		// Set the input credential values to authenticate against
		$authAdapter->setIdentity($username);
		$authAdapter->setCredential($password);
		//return new AuthAdapter($params['username'], $params['password']);
		return $authAdapter;
    }
	public function getForm()
    {
		$actionUrl = $this->view->url(array(
				'module'=>'auth',
				'controller'=>'index',
				'action'=>'identify') );

		$form = new Loginform(array(
            'action' => $actionUrl,
            'method' => 'post',
        ));

		return $form;
    }
	public function indexAction()
	{
	$this->_forward('login');
	}

	public function loginAction()
	{
		$this->view->form = $this->getForm();
		$this->view->errors=$this->_session->loginError;
	}
	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		Zend_Session::destroy();
		$this->_redirect('/auth/index/login');
	}

	public function identifyAction()
	{
		$success = false;
		$message = '';

		if ($this->_request->isPost()) {
			// collect the data from the user
			$formData = $this->getRequest()->getPost();
			$form = $this->getForm();

			if (!$form->isValid($_POST)) {
				$error['username']="Username ". join(" ", $form->getMessages('username'));
				$error['password']="Password ". join(" ", $form->getMessages('password'));
				$this->_session->loginError=$error;
				//$this->addflash("Username ". join(" ", $form->getMessages('username')));
				//$this->addflash("Password ". join(" ", $form->getMessages('password')));
			}
			else{
				// do the authentication
				$authAdapter = $this->getAuthAdapter($formData);
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);

				if ($result->isValid()) {
					// success: store database row to auth's storage
					// (Not the password though!)
					$data = $authAdapter->getResultRowObject(null,'password');
					$auth->getStorage()->write($data); 		$success = true;
					// Load menu to session
					$registry = Zend_Registry::getInstance();
					$db = $registry->get('database');

					$model= new AccessQuery;
					$config = new Zend_Config_Ini(
						ROOT_DIR. '/application/config/config.ini',
						'general'
					);
					$menuConfig=strtolower($config->menu->disableMenuVisibility);
					if($menuConfig=='invisible') 
					$userRole=$model->getUserRoleOnUserId($formData['username']);
					else if($menuConfig=='visible') $userRole= '%';
					else die("Please check 'menu' option in config.ini.");

					$menu=$model->getAllMenuQuery($userRole);


					$menuObj=new BinaryBl_Menu_Tree;
					$objMenu=$menuObj->buildMenu($menu);
					$tmenu = $this->buildMenu($menu);

					$menustorage = new Zend_Session_Namespace('menu');
					$logger = $registry->get('fileLogger');
					try{
						$logger->info(" ** Treeutils Instance Creating .....");
						$treeutils= Bloomfi_Dbutils_Treeutils::getInstance();
						$logger->info(" ** Treeutils Instance Created >>>>>>>>");
						$testmenu= $treeutils->getFullTreeArray('ref_mst_application_resource','RESOURCE_MASTER_ID','RESOURCE_MASTER_PARENT_ID',0);
						$logger->info(" ** Treeutils Instance Returned TreeArray +++++++++");
					} catch(Exception $e){
						$logger->info(" ******* Trree build error :: " .$e);
						$menustorage->error =$e;
					}
					$menustorage->menu = $menu;
					$menustorage->tmenu = $tmenu;
					$menustorage->objmenu = $objMenu;
					$redirectUrl = $this->_redirectUrl;

				} else {
					$this->addflash('Authentication failed!');
				}
			}
		}

		$redirectUrl = '/dbd/index';
		if(!$success) {
			$redirectUrl = '/auth/index/login';
		}

		$this->redirect($redirectUrl);
	}

	private function buildMenu($arr){
		$treemenu = array();
		$cnt=$id=0;
		$temp = $arr;
		foreach($arr as $val){
			if(!empty($val) && $val['RESOURCE_MASTER_PARENT_ID']==0){
				$treemenu[$cnt] = $val;
				$id = $val['ID'];
				$cnt1=0;
				$arr2 = $temp;
				foreach($arr2 as $val2){
					if($val2['RESOURCE_MASTER_PARENT_ID']==$id){
						$treemenu[$cnt]['children'][$cnt1]=$val2;
					}
				$cnt1++;
				}
			}
			$cnt++;
		}
		return $treemenu;
	}
}
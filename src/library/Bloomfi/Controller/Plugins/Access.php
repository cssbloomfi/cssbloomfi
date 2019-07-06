<?php
class Bloomfi_Controller_Plugins_Access extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
		$this->_session=Zend_Registry::get('SQL');

		// TODO
		// GET Allowed Modules and Controllers list from config
		$allowedModuleList= array('auth');
		$allowedControllerList = array('login','error');

		if(in_array($request->getModuleName(),$allowedModuleList) || in_array($request->getControllerName(),$allowedControllerList) ){			return;  // do nothing
		}


	    $acl = Bloomfi_Acl::getInstance();
		$request = $this->getRequest();

		/*
		$acl = $this->getAcl();
		$auth = Zend_Auth::getInstance();

		// if they have an identity
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
		}
		else {
			// add as guest to ACL
			$user = new User('guest@test.com');
		}

		// allow all view scripts access to the 'User' object
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->initView();
		$viewRenderer->view->user = $user;
		$viewRenderer->view->hasIdentity = $auth->hasIdentity();

		$allowed = $acl->isAllowed($user->getGroup(), $request->getControllerName(), $request->getActionName());
		if (!$allowed){

			// for now just throw error, but you probably want to goto
			// an Unauthorized error page
			if ($auth->hasIdentity()) {

				throw new Exception('Sorry, you do not have access.');

			}
			else{

				// set a parameter on the request telling the login controller where we
				// were trying to go to
				$request->setParam("_requestUri", $request->getRequestUri());

				// forward to login
				$request->setModuleName('auth')
				        ->setControllerName('index')
				        ->setActionName('index');

			}


		}
		*/
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
		}
		else {
			// add as guest to ACL
			$user = new User('guest');
		}

		// allow all view scripts access to the 'User' object
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->initView();
		$viewRenderer->view->user = $user;
		$viewRenderer->view->hasIdentity = $auth->hasIdentity();
		if ($auth->hasIdentity()) {

			$userRoleId = $this->getUserRoleId($user);

			$this->_session->roleId=$userRoleId;

			// check permission
			if (!$acl->hasRole($userRoleId))
			{
				$error = "Sorry, the requested user role '".$userRoleId."' does not exist";
			}


			elseif (!$acl->has($request->getModuleName().'/'.$request->getControllerName()))
			{
				$error = "Sorry, the requested controller '".$request->getControllerName()."' does not exist as an ACL resource";
			}


			elseif (!$acl->isAllowed($userRoleId, $request->getModuleName().'/'.$request->getControllerName(), $request->getActionName()))
			{
				$error = "Sorry, the page you requested does not exist or you do not have access ";
			}

			if (isset($error)) {
				Zend_Layout::getMvcInstance()->getView()->error = $error;
				$request->setModuleName('dbd');
				$request->setControllerName('error');
				$request->setActionName('error');
				$request->setDispatched(false);
				$err= new Zend_Exception($error,99);
				$request->setParam('error_handler', $err);
			}
			else
			{
				//throw new Exception('Sorry, you do not have access.');
				$request->setParam("_requestUri", $request->getRequestUri());
			}
		}
		else{
			$request->setModuleName('auth')
				        ->setControllerName('index')
				        ->setActionName('index');
		}
    }

	private function getUserRoleId($userObject)
	{
		$roleinfo = new Bloomfi_Models_AccessQuery;
		$result = $roleinfo->getUserRoleIdInfoQuery($userObject->USER_ID);
		foreach ($result as $role)
		{
			return $role->ACCESS_ROLE_ID;
		}
	}

	private function getAcl() {
		$acl = new Zend_Acl_Acl();

		// define our possible user groups
		$acl->addRole(new Zend_Acl_Role('guest'));

		// members have at least same access as guest
		$acl->addRole(new Zend_Acl_Role('member'), array('guest'));

		$acl->addRole(new Zend_Acl_Role('admin'));

		// define our controllers as resources.
		$acl->add(new Zend_Acl_Resource('index'));
		$acl->add(new Zend_Acl_Resource('account'));

		// define our access rules
		$acl->allow('guest', 'index');
		$acl->allow('member', 'account');

		// admins can get to everything
		$acl->allow('admin');
		return $acl;
    }

}
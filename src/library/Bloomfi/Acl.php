<?php

class Bloomfi_Acl extends Zend_Acl {

	protected static $_instance = null;

	private function __construct()
	{}

	private function __clone()
	{}

	protected function _initialize()
	{
		$access = new Bloomfi_Models_AccessQuery;
		$roles = $access->getUserRoleAccessQuery();

		foreach ($roles as $role) {
			if (!$this->has($role->acl_module_name.'/'.$role->acl_resource_name))
			{
				$this->add(new Zend_Acl_Resource($role->acl_module_name.'/'.$role->acl_resource_name));
			}
			if (!$this->hasRole($role->acl_role_id))
			{
				$this->addRole(new Zend_Acl_Role($role->acl_role_id));
			}

		}

		$this->deny();

		//$this->allow(null, 'dbd_error');

		foreach ($roles as $role)
		{
			$this->allow($role->acl_role_id, $role->acl_module_name.'/'.$role->acl_resource_name,
			             $role->acl_privilege_name);
		}
	}

	public static function getInstance()
    {
	   if (null === self::$_instance) {
		self::$_instance = new self();
		self::$_instance->_initialize();
	   }

	   return self::$_instance;
    }

}
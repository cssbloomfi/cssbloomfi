<?php

class Bloomfi_Dbutils_Treeutils {
 
	protected static $_instance = null;
	private $treeArray;
	private $tableName='';
	private $identColumnName='';
	private $parentIdentColumnName='';
	private $rootElementId=0;
	private $db;
	private function __construct()
	{}
 
	private function __clone()
	{}
 
	protected function _initialize()
	{
 
		$registry = Zend_Registry::getInstance();
		//$db = $registry->get('database');
		//$db = Zend_Db_Table::getDefaultAdapter();
 
				$roles = $db->fetchAll("SELECT
				acl_role_privilege.acl_role_id, 
				acl_module.acl_module_name,
				acl_resource.acl_resource_name,
				acl_privilege.acl_privilege_name
				FROM acl_role_privilege
				INNER JOIN acl_privilege 
				ON acl_role_privilege.acl_privilege_id = acl_privilege.acl_privilege_id
				INNER JOIN acl_resource
				ON acl_privilege.acl_resource_id = acl_resource.acl_resource_id
				INNER JOIN acl_module
				ON acl_resource.acl_module_id = acl_module.acl_module_id");
 
		foreach ($roles as $role) {
			if (!$this->has($role['acl_module_name'].'/'.$role['acl_resource_name'])) {
				$this->add(new Zend_Acl_Resource($role['acl_module_name'].'/'.$role['acl_resource_name']));
			}
			if (!$this->hasRole($role['acl_role_id'])) {
				$this->addRole(new Zend_Acl_Role($role['acl_role_id']));
			}
		}
 
		$this->deny();
		//$this->allow(null, 'dbd_error');
 
		foreach ($roles as $role) {
			$this->allow($role['acl_role_id'], $role['acl_module_name'].'/'.$role['acl_resource_name'], $role['acl_privilege_name']);
		}
 
	}
 
	public static function getInstance()
    {
	   if (null === self::$_instance) {
		self::$_instance = new self();
		//self::$_instance->_initialize();
	   }
 
	   return self::$_instance;
    }

	public function getFullTreeArray($tblName,$idColumnName,$parentIdColumnName,$parentIdValue){
		$this->tableName = $tblName;
		$this->identColumnName = $idColumnName;
		$this->parentIdentColumnName = $parentIdColumnName;
		$this->rootElementId=$parentIdValue;
		
		$this->initDB();
		$tArray = $this->getTree($parentIdValue);
		return $tArray; 
	}
	
	public function getTree($parentId){
		$filelogger = Zend_Registry::get('fileLogger');
		$filelogger->info("oooooo ParentID supplied to getTree=>> " .$parentId);
		$returnArray=null;
		$sql="SELECT * FROM " . $this->tableName ." WHERE ". $this->parentIdentColumnName ." = '" .$parentId ."' order by display_sequence";
		$filelogger->info("oooooo SQL ::> " .$sql);
		$result = $this->db->fetchAssoc($sql);
		$filelogger->info("oooooo SQL executed Successfully ::> " .$sql);
		//for($i=0;$i<count($result);$i++){
		$i=0;
		foreach($result as $row){
			$returnArray[$i]=$row;
			$parentid=$row['RESOURCE_MASTER_ID'];
			$children = $this->getTree($parentid);
			if ($children != null){
				$returnArray[$i]['children']= $children;
			}
			$i++;
		}
		return $returnArray;

		print_r($returnArray);
	}

	public function initDB(){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('database');
		$this->db = $db;
	}

}

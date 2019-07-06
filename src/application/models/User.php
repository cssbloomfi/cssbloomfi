<?php 

class User
{
	private $_username;
	private $_group;
	private $_roleid;
	
	public function __construct($user) {
		$this->_username = $user;
		$this->_group = 'guest';
		$this->_roleid =4;
	}
	
	public function setUserName($user){
		$this->_username = $user;
	}
	
	public function getUserName(){
		return $this->_username;
	}
	
	public function setGroup($group){
		$this->_group = $group;
	}
	
	public function getGroup(){
		return $this->_group;
	}

	public function setRoleID($roleid){
		$this->_roleid = $roleid;
	}
	
	public function getRoleID(){
		return $this->_roleid;
	}
	
}
	
	
	
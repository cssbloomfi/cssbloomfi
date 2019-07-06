<?php

require_once "Zend/Db.php";
class Bloomfi_Models_AccessQuery extends Bloomfi_App_Ulibrary
	{

	protected  $db;

	public function __construct()
	{
		$this->db=new Bloomfi_SqlUtil;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to print the content of query library
		------------------------------------------------------------------------
	*/
	public function printQueryLibrary()
    {
	  $querylibrary = simplexml_load_file(BLOOMFI_ACCESS_QUERY_LIB);
	  foreach ($querylibrary->query as $query) 
		  {
		  printf("Query Id     : %s\n", $query['id']);
		  printf("Query Title  : %s\n", $query->title);
		  printf("Query Content: %s\n", $query->content);
	      } 
       return null;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the content of query
		------------------------------------------------------------------------
	*/
	public function getQueryContent($queryid)
    {
	  $querylibrary = simplexml_load_file(BLOOMFI_ACCESS_QUERY_LIB);
	  foreach ($querylibrary->query as $query) 
		  {
		  if ( $query['id'] == $queryid )
			  {
			  return $query->content;
			  }
	      } 
       return null;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the content of query
		------------------------------------------------------------------------
	*/
	public function getQueryTitle($queryid)
    {
	  $querylibrary = simplexml_load_file(BLOOMFI_ACCESS_QUERY_LIB);
	  foreach ($querylibrary->query as $query) 
		  {
		  if ( $query['id'] == $queryid )
			  {
				return $query->title;
			  }
	      } 
       return null;
	}

	/*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the parameters of query
		------------------------------------------------------------------------
	*/
	public function getQueryParams($queryid)
    {
	  $querylibrary = simplexml_load_file(BLOOMFI_ACCESS_QUERY_LIB);
	  foreach ($querylibrary->query as $query) 
		  {
		  if ( $query['id'] == $queryid )
			  {
				return $query->params;
			  }
	      } 
       return null;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the DB connection
		------------------------------------------------------------------------
	*/
	public function getDbConnection()
    {
		$registry = Zend_Registry::getInstance();
		$config= $registry->get("configuration");
		$db = Zend_Db::factory($config->db);
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		return $db;

	}

	
	
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of user role access informations
		------------------------------------------------------------------------
	*/
	public function getUserRoleAccessQuery()
    {        
		$sql  = $this->getQueryContent('UserRoleAccessQuery');
		return $this->db->fireSqlFetchAll($sql,'UserRoleAccessQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of informations of a user id
		------------------------------------------------------------------------
	*/
	public   function getUserRoleIdInfoQuery($id)
    {      
		$sql  = $this->getQueryContent('UserRoleIdInfoQuery');
		$params = $this->getQueryParams('UserRoleIdInfoQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'UserRoleIdInfoQuery');
	}



}

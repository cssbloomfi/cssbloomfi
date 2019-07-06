<?php

require_once "Zend/Db.php";
class BinaryBl_BreadCrumb_Models_AccessQuery extends Bloomfi_App_Ulibrary
	{
	protected  $db;

	public function __construct()
	{
		$this->db=new Bloomfi_SqlUtil;
		defined('BREADCRUMB_SQL_LIBRARY') || define('BREADCRUMB_SQL_LIBRARY' , ROOT_DIR . "/library/BinaryBl/BreadCrumb/Models/Query/BreadCrumbQueryLibrary.xml");
	}
    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to print the content of query library
		------------------------------------------------------------------------
	*/
	public function printQueryLibrary()
    {
	  $querylibrary = simplexml_load_file(BREADCRUMB_SQL_LIBRARY);
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
	  $querylibrary = simplexml_load_file(BREADCRUMB_SQL_LIBRARY);
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
	  $querylibrary = simplexml_load_file(BREADCRUMB_SQL_LIBRARY);
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
	  $querylibrary = simplexml_load_file(BREADCRUMB_SQL_LIBRARY);
	  foreach ($querylibrary->query as $query) 
		  {
		  if ( $query['id'] == $queryid )
			  {
				return $query->params;
			  }
	      } 
       return null;
	}



	/*===================================================================================*/


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the results of resources of a parent id
		------------------------------------------------------------------------
	*/
	public function getResourceByParentIdQuery($id)
    {      
		$sql  = $this->getQueryContent('resourceByParentIdQuery');
		$params = $this->getQueryParams('resourceByParentIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'resourceByParentIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the results of resources of a id
		------------------------------------------------------------------------
	*/
	public function getResourceByIdQuery($id)
    {      
		$sql  = $this->getQueryContent('resourceByIdQuery');
		$params = $this->getQueryParams('resourceByIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'resourceByIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the max id of resources 
		------------------------------------------------------------------------
	*/
	public function getMaxResourceIdQuery()
    {      
		$sql  = $this->getQueryContent('maxResourceIdQuery');
		return $this->db->fireSqlQueryFetchObject($sql,'maxResourceIdQuery')->MAX_ID;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the resource master id of an id
		------------------------------------------------------------------------
	*/
	public function getResourceMasterIdonIdQuery($id)
    {      
		$sql  = $this->getQueryContent('resourceMasterIdonIdQuery');
		$params = $this->getQueryParams('resourceMasterIdonIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlQueryFetchObject($sql,'resourceMasterIdonIdQuery');
	}



}

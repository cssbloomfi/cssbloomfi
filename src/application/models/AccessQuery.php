<?php

class AccessQuery extends Bloomfi_App_Ulibrary
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
	}

	public function destroy()
	{
		unset($this->db);
	}

	/*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to print the content of query library
		------------------------------------------------------------------------
	*/
	public  function printQueryLibrary()
    {
	  $querylibrary = simplexml_load_file(ACCESS_QUERY_LIB);
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
	public  function getQueryContent($queryid)
    {
	  $querylibrary = simplexml_load_file(ACCESS_QUERY_LIB);
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
	public  function getQueryTitle($queryid)
    {
	  $querylibrary = simplexml_load_file(ACCESS_QUERY_LIB);
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
	public  function getQueryParams($queryid)
    {
	  $querylibrary = simplexml_load_file(ACCESS_QUERY_LIB);
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
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Menu on role
		------------------------------------------------------------------------
	*/

	public  function getAllMenuQuery($role)
    {
		$sql  = $this->getQueryContent('AllMenuQuery');
		$params=$this->getQueryParams('AllMenuQuery');
		$sql = $this->bindSqlParams($sql,$params,$role);
		return $this->db->fireSqlFetchAssoc($sql,'AllMenuQuery');
	}

	
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		FuFunction to get the result of all Menu
		------------------------------------------------------------------------
	*/
	public  function getAllMenuResourceQuery()
    {
		$sql  = $this->getQueryContent('allMenuResourceQuery');
		return $this->db->fireSqlFetchAll($sql,'allMenuResourceQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of dbd Menu
		------------------------------------------------------------------------
	*/
	public  function getDbdMenuQuery()
    {
		$sql  = $this->getQueryContent('DbdMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'DbdMenuQuery');
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Menu
		------------------------------------------------------------------------
	*/
	public  function getRefMenuQuery()
    {
		$sql  = $this->getQueryContent('RefMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'RefMenuQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Adm Menu
		------------------------------------------------------------------------
	*/
	public  function getAdmMenuQuery()
    {
		$sql  = $this->getQueryContent('AdmMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'AdmMenuQuery');
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Menu
		------------------------------------------------------------------------
	*/
	public  function getRptMenuQuery()
    {
		$sql  = $this->getQueryContent('RptMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'RptMenuQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of trn Menu
		------------------------------------------------------------------------
	*/
	public  function getTrnMenuQuery()
    {
		$sql  = $this->getQueryContent('TrnMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'TrnMenuQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Node Menu
		------------------------------------------------------------------------
	*/

	public  function getAllNodeMenuQuery()
    {
		$sql  = $this->getQueryContent('AllNodeMenuQuery');
		return $this->db->fireSqlFetchAll($sql);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Node Menu
		------------------------------------------------------------------------
	*/

	public  function getAllGroupMenuQuery($db)
    {
		$sql  = $this->getQueryContent('AllGroupMenuQuery');
		return $this->db->fireSqlFetchAll($sql);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Uploading page Menu
		------------------------------------------------------------------------
	*/
	public  function getExcelUploadingMenuQuery()
    {
		$sql  = $this->getQueryContent('excelUploadingMenuQuery');
		return $this->db->fireSqlFetchAll($sql,'excelUploadingMenuQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the component lists on screen id
		------------------------------------------------------------------------
	*/
	public  function getChartComponentOfScreenId($data)
    {
		$sql = $this->getQueryContent('chartComponentOfScreenId');
		$params = $this->getQueryParams('chartComponentOfScreenId');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'chartComponentOfScreenId');
	}

	public function getComponentAccessQuery($roleId)
	{
		$sql = $this->getQueryContent('componentAccessQuery');
		$params=$this->getQueryParams('componentAccessQuery');
		$sql = $this->bindSqlParams($sql,$params,$roleId);
		return $this->db->fireSqlFetchAll($sql,'componentAccessQuery');
	}

	public function getUserComponentAccessQuery($roleId)
	{
		$sql = $this->getQueryContent('userComponentAccessQuery');
		$params=$this->getQueryParams('userComponentAccessQuery');
		$sql = $this->bindSqlParams($sql,$params,$roleId);
		return $this->db->fireSqlFetchAll($sql,'userComponentAccessQuery');
	}

	public function getUserRoleOnUserId($userId)
	{
		$sql = $this->getQueryContent('userRoleOnUserId');
		$params=$this->getQueryParams('userRoleOnUserId');
		$sql = $this->bindSqlParams($sql,$params,$userId);
		return $this->db->fireSqlQueryFetchObject($sql,'userRoleOnUserId')->ACCESS_ROLE_ID;
	}


}

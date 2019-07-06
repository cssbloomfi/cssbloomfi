<?php

class  modules_dbd_models_dbdAccessQuery extends Bloomfi_App_Ulibrary
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
	  $querylibrary = simplexml_load_file(DBD_MASTER_LIB);
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
	  $querylibrary = simplexml_load_file(DBD_MASTER_LIB);
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
	  $querylibrary = simplexml_load_file(DBD_MASTER_LIB);
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
	  $querylibrary = simplexml_load_file(DBD_MASTER_LIB);
	  foreach ($querylibrary->query as $query) 
		  {
		  if ( $query['id'] == $queryid )
			  {
				return $query->params;
			  }
	      } 
       return null;
	}

   /*-----------------------------------------------------------------------------*/


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result 
		------------------------------------------------------------------------
	*/
	public  function getCustomerEntryMonthWiseQuery()
    {
		$sql  = $this->getQueryContent('customerEntryMonthWise');
		return $this->db->fireSqlFetchAll($sql,'customerEntryMonthWise');
	}
	
}

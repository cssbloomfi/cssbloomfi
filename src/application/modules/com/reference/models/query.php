<?php

class modules_com_reference_models_query extends Bloomfi_App_Ulibrary
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		if(!defined('REFERENCE_COMPONENT_QUERY_LIB'))
		define('REFERENCE_COMPONENT_QUERY_LIB', ROOT_DIR . "/application/modules/com/reference/models/query/queryLibrary.xml");
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

	  $querylibrary = simplexml_load_file(REFERENCE_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(REFERENCE_COMPONENT_QUERY_LIB);
	  foreach ($querythisrary->query as $query)
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
	  $querythisrary = simplexml_load_file(REFERENCE_COMPONENT_QUERY_LIB);
	  foreach ($querythisrary->query as $query)
		  if ( $query['id'] == $queryid )
				return $query->title;

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
	  $querythisrary = simplexml_load_file(REFERENCE_COMPONENT_QUERY_LIB);
	  foreach ($querythisrary->query as $query)
		  if ( $query['id'] == $queryid )
				return $query->params;

       return null;
	}


	/*========================== DIRECT EXECUTION SECTION FOR FAST PROCESSING =======================

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function startTransaction()
    {
		return $this->db->fireFastSqlQuery("START TRANSACTION");
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function commitTransaction()
    {
		return $this->db->fireFastSqlQuery("COMMIT");
	}
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function isLock($string)
    {
		return $this->db->fireFastSqlQuery("SELECT IS_FREE_LOCK('$string') 'LOCK'",'isLock')->fetchObject()->LOCK;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLock($string,$time=300)
    {
		return $this->db->fireFastSqlQuery("SELECT GET_LOCK('$string',$time) 'LOCK'",'getLock');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function releaseLock($string)
    {
		return $this->db->fireFastSqlQuery("SELECT RELEASE_LOCK('$string') 'LOCK'",'releaseLock');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public function waitAndAllow($string,$timeOut=300)
	{
		$allow=$this->isLock($string);
		if($allow==1) {
			$this->getLock($string);
			return $allow; }
		else{
			if($string) {
			set_time_limit(3600);
			$allow=0;
			$phase1_microSec=rand(100,200);
			$phase1_limit=rand(16000,17000);
			for($i=0;$i<$phase1_limit;$i++){
				$allow=$this->isLock($string);
				if($allow==1){ $this->getLock($string,$timeOut);
					return $allow;}
				else usleep($phase1_microSec);}
			$phase2_microSec=rand(10,50);
			$phase2_limit=rand(12000,13000);
			for($i=0;$i<$phase2_limit;$i++){
				$allow=$this->isLock($string);
				if($allow==1){ $this->getLock($string,$timeOut);
					return $allow;}
				else usleep($phase2_microSec);}
			$phase3_microSec=rand(1,10);
			$phase3_limit=rand(10000,11000);
			for($i=0;$i<$phase3_limit;$i++){
				$allow=$this->isLock($string);
				if($allow==1){ $this->getLock($string,$timeOut);
				return $allow;}
				else usleep($phase3_microSec);}
			}
			else
				echo "No String passed to check lock status";
		}
		return $allow;
	}

	/*=================================================================================================*/

//-------------------  S E L E C T      F U N C T I O N S ------------------------------

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Total reference,Scheme,Collector,Location
	--------------------------------------------------------------------------------
	*/

	public function getTotalCustQuery()
	{
		$id = 'totalCustQuery';
		$sql = $this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	public function getTotalSchmQuery()
	{
		$id = 'totalSchmQuery';
		$sql = $this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	public function getTotalCollQuery()
	{
		$id = 'totalCollQuery';
		$sql = $this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	public function getTotalLocQuery()
	{
		$id = 'totalLocQuery';
		$sql = $this->getQueryContent($id);
		return $this->db->fireSqlFetchAll($sql);
	}

}
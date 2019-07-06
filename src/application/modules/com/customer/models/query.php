<?php

class modules_com_customer_models_query extends Bloomfi_App_Ulibrary
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		if(!defined('CUSTOMER_COMPONENT_QUERY_LIB'))
		define('CUSTOMER_COMPONENT_QUERY_LIB', ROOT_DIR . "/application/modules/com/customer/models/query/queryLibrary.xml");
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

	  $querylibrary = simplexml_load_file(CUSTOMER_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(CUSTOMER_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(CUSTOMER_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(CUSTOMER_COMPONENT_QUERY_LIB);
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

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get month-wise customer entry of a year
	------------------------------------------------------------------------
	*/

	public function getMonthwiseCustomerOfYearQuery($labelvalue)
		{
			$queryid='monthwiseCustomerOfYearQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlFetchAll($sql,$queryid);
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get scheme-wise customer payment of current year
	------------------------------------------------------------------------
	*/

	public function getSchemewiseCustPaymentOfYearQuery($labelvalue)
		{
			$queryid='schemewiseCustPaymentOfYearQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlQuery($sql,$queryid);
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get current week-wise customer payment of current year
	------------------------------------------------------------------------
	*/

	public function getCurrentWeekwiseCustPaymentOfYearQuery($labelvalue)
		{
			$queryid='weekwiseCustPaymentOfYearQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlQuery($sql,$queryid);
		}


	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get total customers per employee
	------------------------------------------------------------------------
	*/

	public function getTotalCustomerPerOfficerQuery($labelvalue)
		{
			$queryid='totalCustomerPerOfficerQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlQuery($sql,$queryid);
		}



	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get total customers per location
	------------------------------------------------------------------------
	*/

	public function getTotalCustomerPerLocationQuery($labelvalue)
		{
			$queryid='totalCustomerPerLocationQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlQuery($sql,$queryid);
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get result total customers vs payment disburse
	------------------------------------------------------------------------
	*/

	public function getTotalCustVsPaymntDisburseQuery($labelvalue)
		{
			$queryid='totalCustVsPaymntDisburseQuery';
			$sql = $this->getQueryContent($queryid);
			$params = $this->getQueryParams($queryid);
			$sql = $this->bindSqlParams($sql,$params,$labelvalue);
			return $this->db->fireSqlQuery($sql,$queryid);
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get result total customers
	------------------------------------------------------------------------
	*/

	public function getTotalCustomerQuery()
	{
		$id='totalCustomerQuery';
		$sql = $this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get result total loan customers
	------------------------------------------------------------------------
	*/

	public function getTotalLoanCustomerQuery()
	{
		$id='totalLoanCustomerQuery';
		$sql = $this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get result total due for each collector
	------------------------------------------------------------------------
	*/

	public function getColDuePymtQuery($labelvalue)
	{
		$queryid='colDuePymtQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getSchmWiseTotalCustCurrentYear($labelvalue)
	{
		$queryid='schmWiseTotalCustCurrentYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

}
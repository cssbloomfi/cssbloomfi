<?php

class modules_com_transaction_models_query extends Bloomfi_App_Ulibrary
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		if(!defined('TRANSACTION_COMPONENT_QUERY_LIB'))
		define('TRANSACTION_COMPONENT_QUERY_LIB', ROOT_DIR . "/application/modules/com/transaction/models/query/queryLibrary.xml");
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

	  $querylibrary = simplexml_load_file(TRANSACTION_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(TRANSACTION_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(TRANSACTION_COMPONENT_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(TRANSACTION_COMPONENT_QUERY_LIB);
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
	Function to get payment and receipt in different types
	------------------------------------------------------------------------
	*/

	public function getPaymentReceiptInDiffTypesQuery()
		{
			$sql = $this->getQueryContent('paymentReceiptInDiffTypesQuery');
			return $this->db->fireSqlQuery($sql,'paymentReceiptInDiffTypesQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get payment and receipt in different types
	------------------------------------------------------------------------
	*/

	public function getEmpAndSchmWishPayAndRecpQuery()
		{
			$sql = $this->getQueryContent('empAndSchmWishPayAndRecpQuery');
			return $this->db->fireSqlFetchAll($sql,'empAndSchmWishPayAndRecpQuery');
		}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Total Transaction
	--------------------------------------------------------------------------------
	*/
	public function getTotalTrnQuery()
	{
		$id='totalTrnQuery';
		$sql=$this->getQueryContent($id);
		 return $this->db->fireSqlFetchAll($sql);
	}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Total payment for last three months
	--------------------------------------------------------------------------------
	*/

	public function getPymtLstThreeMnthQuery($labelvalue)
	{
		$queryid='pymtLstThreeMnthQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Total payment for last three years
	--------------------------------------------------------------------------------
	*/

	public function getPymtLstThreeYrsQuery($labelvalue)
	{
		$queryid='pymtLstThreeYrsQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Scheme Wise Total Receipt 
	--------------------------------------------------------------------------------
	*/

	public function getSchmWiseTotalRecQuery($labelvalue)
	{
		$queryid='schmWiseTotalRecQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Scheme Wise Total Due 
	--------------------------------------------------------------------------------
	*/

	public function getSchmWiseTotalDueQuery($labelvalue)
	{
		$queryid='schmWiseTotalDueQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	/*------------------------------------------------------------------------------
	  QUERY SPECIFIC FUNCTION
	  Function To Get Scheme Wise Total Due 
	--------------------------------------------------------------------------------
	*/

	public function getTopTenPymtLocQuery($labelvalue)
	{
		$queryid='topTenPymtLocQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getschmTypTotalLoanQuery($labelvalue)
	{
		$queryid='schmTypTotalLoanQuery';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}


	public function getCollWiseTotalPayCurrentYearQuery($labelvalue)
	{
		$queryid='collWiseTotalPayCurrentYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getPayReceptDueCurrentYearQuery($labelvalue)
	{
		$queryid='payReceptDueCurrentYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getSchmTypeWiseTotalReceptCurrYearQuery($labelvalue)
	{
		$queryid='schmTypeWiseTotalReceptCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getTopTenReceptLocCurrYearQuery($labelvalue)
	{
		$queryid='topTenReceptLocCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getPayReceptCurrentWeekQuery($labelvalue)
	{
		$queryid='payReceptCurrentWeek';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getTopTenDueLocCurrYearQuery($labelvalue)
	{
		$queryid='topTenDueLocCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getMonthWisePaymentCurrYearQuery($labelvalue)
	{
		$queryid='monthWisePaymentCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getMonthWiseReceptCurrYearQuery($labelvalue)
	{
		$queryid='monthWiseReceptCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getTopFiveCollRecCurrYearQuery($labelvalue)
	{
		$queryid='topFiveCollRecCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getSchmWisePaymentCurrYear($labelvalue)
	{
		$queryid='schmWisePaymentCurrYear';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getLstMnthSchmWisePayment($labelvalue)
	{
		$queryid='lstMnthSchmWisePayment';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getLstMnthCollWisePayment($labelvalue)
	{
		$queryid='lstMnthCollWisePayment';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getLstMnthCollWiseRecept($labelvalue)
	{
		$queryid='lstMnthCollWiseRecept';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

	public function getLstMnthSchmWiseReceipt($labelvalue)
	{
		$queryid='lstMnthSchmWiseReceipt';
		$sql = $this->getQueryContent($queryid);
		$params = $this->getQueryParams($queryid);
		$sql = $this->bindSqlParams($sql,$params,$labelvalue);
		return $this->db->fireSqlFetchAll($sql,$queryid);
	}

}
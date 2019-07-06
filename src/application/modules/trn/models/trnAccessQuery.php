<?php

class modules_trn_models_trnAccessQuery extends BinaryBl_XmlSqlBuilder
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		parent::__construct(TRN_MASTER_LIB);
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

	  $querylibrary = simplexml_load_file(TRN_MASTER_LIB);
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
	  $querylibrary = simplexml_load_file(TRN_MASTER_LIB);
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
	  $querylibrary = simplexml_load_file(TRN_MASTER_LIB);
	  foreach ($querylibrary->query as $query)
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
	  $querylibrary = simplexml_load_file(TRN_MASTER_LIB);
	  foreach ($querylibrary->query as $query)
		  if ( $query['id'] == $queryid )
				return $query->params;

       return null;
	}



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function isLockSummaryTbl()
    {
		$sql  = $this->getQueryContent('isLockSummaryTbl');
		return $this->db->fireFastSqlQuery($sql)->fetchObject()->LOCK;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLockSummaryTbl()
    {
		$sql  = $this->getQueryContent('getLockSummaryTbl');
		return $this->db->fireSqlQuery($sql,'getLockSummaryTbl');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function releaseLockSummaryTbl()
	{
		$sql  = $this->getQueryContent('releaseLockSummaryTbl');
		return $this->db->fireSqlQuery($sql,'releaseLockSummaryTbl');
	}


	/*========================== DIRECT EXECUTION SECTION FOR FAST PROCESSING =======================


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function SavepointTransaction($savePoint)
        {
		return $this->db->SavepointTransaction($savePoint);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function RollbackTransaction($savePoint)
        {
		return $this->db->RollbackTransaction($savePoint);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function startTransaction()
        {
		return $this->db-> startTransaction();
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function flushTable()
        {
		return $this->db->flushTable();
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function commitTransaction()
        {
		return $this->db->commitTransaction();
	}
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function isLock($string)
        {
		return $this->db->isLock($string);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLock($string,$time=300)
        {
		return $this->db->getLock($string);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function releaseLock($string)
        {
		return $this->db->releaseLock($string);
	}
        
        /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLastInsertedId()
        {
		return $this->db->getLastInsertedId();
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public function waitAndAllow($string,$timeOut=300)
	{
                return $this->db->waitAndAllow($string,$timeOut);
	}

	/*=================================================================================================*/


//-------------------SELECT QUERY-----------------------------------------------



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Payment related prefix and postfix value
		------------------------------------------------------------------------
	*/
	public  function getPaymentPrePostQuery()
    {
		$sql  = $this->getQueryContent('paymentPrePostQuery');
		return $this->db->fireSqlFetchAll($sql,'paymentPrePostQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Receive related prefix and postfix value
		------------------------------------------------------------------------
	*/
	public  function getReceivePrePostQuery()
    {
		$sql  = $this->getQueryContent('receivePrePostQuery');
		return $this->db->fireSqlFetchAll($sql,'receivePrePostQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Payment and Receive related prefix and postfix value
		------------------------------------------------------------------------
	*/
	public  function getAllTrnPrePostQuery()
    {
		$sql  = $this->getQueryContent('allTrnPrePostQuery');
		return $this->db->fireSqlFetchAll($sql,'allTrnPrePostQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Payment Types
		------------------------------------------------------------------------
	*/
	public  function getAllPaymentTypesQuery()
    {
		$sql  = $this->getQueryContent('allPaymentTypeQuery');
		return $this->db->fireSqlFetchAll($sql,'allPaymentTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Account Status Types
		------------------------------------------------------------------------
	*/
	public  function getAllAccountStatusTypesQuery()
    {
		$sql  = $this->getQueryContent('allAccountStatusTypeQuery');
		return $this->db->fireSqlFetchAll($sql,'allAccountStatusTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Receipt Type is exist
		------------------------------------------------------------------------
	*/
	public  function isExistBSDReceiptTypeQuery($value)
    {
		$sql  = $this->getQueryContent('isExistBSDReceiptTypeQuery');
		$params = $this->getQueryParams('isExistBSDReceiptTypeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlFetchAll($sql,'isExistBSDReceiptTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Payment Type is exist
		------------------------------------------------------------------------
	*/
	public  function isExistBSDPaymentTypeQuery($value)
    {
		$sql  = $this->getQueryContent('isExistBSDPaymentTypeQuery');
		$params = $this->getQueryParams('isExistBSDPaymentTypeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlFetchAll($sql,'isExistBSDPaymentTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Payment Type is exist
		------------------------------------------------------------------------
	*/
	public  function isExistExceptMeBSDReceiptTypeQuery($value)
    {
		$sql  = $this->getQueryContent('isExistExceptMeBSDReceiptTypeQuery');
		$params = $this->getQueryParams('isExistExceptMeBSDReceiptTypeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlFetchAll($sql,'isExistExceptMeBSDReceiptTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Payment Type is exist
		------------------------------------------------------------------------
	*/
	public  function isPaymentTypeQuery($value)
    {
		$sql  = $this->getQueryContent('isPaymentTypeQuery');
		$params = $this->getQueryParams('isPaymentTypeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlFetchAll($sql,'isPaymentTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the receive Type is exist
		------------------------------------------------------------------------
	*/
	public  function isReceiveTypeQuery($value)
    {
		$sql  = $this->getQueryContent('isReceiveTypeQuery');
		$params = $this->getQueryParams('isReceiveTypeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlFetchAll($sql,'isReceiveTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the receive Type is exist
		------------------------------------------------------------------------
	*/
	public  function isVoucherNoQuery($value)
    {
		$sql  = $this->getQueryContent('isVoucherNoQuery');
		$params = $this->getQueryParams('isVoucherNoQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlQueryFetchObject($sql,'isVoucherNoQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the receive Type is exist
		------------------------------------------------------------------------
	*/
	public  function isMemoNoQuery($value)
    {
		$sql  = $this->getQueryContent('isMemoNoQuery');
		$params = $this->getQueryParams('isMemoNoQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlQueryFetchObject($sql,'isMemoNoQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Check the Voucher is exist
		------------------------------------------------------------------------
	*/
	public  function isVoucherNoExceptMeQuery($value)
    {
		$sql  = $this->getQueryContent('isVoucherNoExceptMeQuery');
		$params = $this->getQueryParams('isVoucherNoExceptMeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlQueryFetchObject($sql,'isVoucherNoExceptMeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Check the Voucher is exist
		------------------------------------------------------------------------
	*/
	public  function isMemoNoExceptMeQuery($value)
    {
		$sql  = $this->getQueryContent('isMemoNoExceptMeQuery');
		$params = $this->getQueryParams('isMemoNoExceptMeQuery');
		$sql = $this->bindSqlParams($sql,$params,$value);
		return $this->db->fireSqlQueryFetchObject($sql,'isMemoNoExceptMeQuery');
	}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function check weither a details id exist or not
		------------------------------------------------------------------------
	*/

	public function isExistDetailsQuery($id)
		{
			$sql = $this->getQueryContent('isExistDetailsQuery');
			$params = $this->getQueryParams('isExistDetailsQuery');
			$sql = $this->bindSqlParams($sql,$params,$id);
			return $this->db->fireSqlFetchAll($sql,'isExistDetailsQuery');
		}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function check weither a scheme is given to customer or not
		------------------------------------------------------------------------
	*/

	public function isSchmGivenToCustQuery($id)
		{
			$sql = $this->getQueryContent('isSchmGivenToCustQuery');
			$params = $this->getQueryParams('isSchmGivenToCustQuery');
			$sql = $this->bindSqlParams($sql,$params,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'isSchmGivenToCustQuery');
		}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function check weither a scheme is given to customer or not
		------------------------------------------------------------------------
	*/

	public function isSchmGivenToCustExceptMeQuery($id)
		{
			$sql = $this->getQueryContent('isSchmGivenToCustExceptMeQuery');
			$params = $this->getQueryParams('isSchmGivenToCustExceptMeQuery');
			$sql = $this->bindSqlParams($sql,$params,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'isSchmGivenToCustExceptMeQuery');
		}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function check weither a scheme is given to customer or not
		------------------------------------------------------------------------
	*/

	public function isSchmGivenToCustExceptMeQuery2($id)
		{
			$sql = $this->getQueryContent('isSchmGivenToCustExceptMeQuery2');
			$params = $this->getQueryParams('isSchmGivenToCustExceptMeQuery2');
			$sql = $this->bindSqlParams($sql,$params,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'isSchmGivenToCustExceptMeQuery2');
		}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function to get trn id on the basis of customer id
		------------------------------------------------------------------------
	*/

	public function getTrnIdByCustomerQuery($custId)
		{
			$sql = $this->getQueryContent('trnIdByCustomerQuery');
			$params = $this->getQueryParams('trnIdByCustomerQuery');
			$sql = $this->bindSqlParams($sql,$params,$custId);
			return $this->db->fireSqlQueryFetchObject($sql,'trnIdByCustomerQuery');
		}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Receive Types
		------------------------------------------------------------------------
	*/
	public  function getAllReceiveTypesQuery()
    {
		$sql  = $this->getQueryContent('allReceiveTypeQuery');
		return $this->db->fireSqlFetchAll($sql,'getAllReceiveTypesQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of activate rows	of given table	------------------------------------------------------------------------
	*/
	public  function getTotalActiveRowsQuery($tbl)
    {
		$sql  = $this->getQueryContent('totalActiveRowsQuery');
		$params = $this->getQueryParams('totalActiveRowsQuery');
		$sql = $this->bindSqlParams($sql,$params,$tbl);
		return $this->db->fireSqlQueryFetchObject($sql,'totalActiveRowsQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  transaction id on the basis of customer, scheme and type		------------------------------------------------------------------------
	*/
	public  function getPaymentTrnsIdQuery($entId)
    {
		$sql  = $this->getQueryContent('paymentTrnsIdQuery');
		$params = $this->getQueryParams('paymentTrnsIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'getPaymentTrnsIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All Scheme ID
		------------------------------------------------------------------------
	*/
	public  function getAllSchemeIdQuery()
    {
		$sql  = $this->getQueryContent('AllSchemeQuery');
		return $this->db->fireSqlFetchAll($sql,'AllSchemeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  Entity information on the basis of entity id
		------------------------------------------------------------------------
	*/
	public  function getEntityIdQuery($entId)
    {
		$sql  = $this->getQueryContent('EntityIdQuery');
		$params = $this->getQueryParams('EntityIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'getEntityIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  a Entity ID of the basis on employee id
		------------------------------------------------------------------------
	*/
	public  function employeeQuery($id)
    {
		$sql  = $this->getQueryContent('employeeQuery');
		$params = $this->getQueryParams('employeeQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$data= $this->db->fireSqlFetchAll($sql,'employeeQuery');
		if($data) return $data;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  a Entity ID of the basis on customer id
		------------------------------------------------------------------------
	*/
	public  function customerQuery($id)
    {
		$sql  = $this->getQueryContent('customerQuery');
		$params = $this->getQueryParams('customerQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$data= $this->db->fireSqlFetchAll($sql,'customerQuery');
		if($data) return $data;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  a scheme name of the basis on scheme id
		------------------------------------------------------------------------
	*/
	public  function schemeQuery($id)
    {
		$sql  = $this->getQueryContent('schemeQuery');
		$params = $this->getQueryParams('schemeQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$data= $this->db->fireSqlFetchAll($sql,'schemeQuery');
		if($data) return $data;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  Scheme ID limit Amount
		------------------------------------------------------------------------
	*/
	public  function getSchemeLimitAmountQuery($id)
    {
		$sql  = $this->getQueryContent('SchemeLimitAmountQuery');
		$params = $this->getQueryParams('SchemeLimitAmountQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$data = $this->db->fireSqlQueryFetchObject($sql,'getSchemeLimitAmountQuery');
		if($data) return $data->SCHEME_AMT_LIMIT;
		else return 0;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers details
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersQuery($type)
    {
		$sql  = $this->getQueryContent('AllCustomersQuery');
		$params = $this->getQueryParams('AllCustomersQuery');;
		$sql = $this->bindSqlParams($sql,$params,$type);
		return $this->db->fireSqlFetchAll($sql,'AllCustomersQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Loan Officers
		------------------------------------------------------------------------
	*/
	public  function getAllEmployeeQuery($type)
    {
		$sql  = $this->getQueryContent('AllEmployeeQuery');
		$params = $this->getQueryParams('AllEmployeeQuery');
		$sql = $this->bindSqlParams($sql,$params,$type);
		return $this->db->fireSqlFetchAll($sql,'AllEmployeeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by customer and scheme id
		------------------------------------------------------------------------
	*/
	public  function getTrnSmryIdForXlsDtlQuery($data)
    {
		$sql  = $this->getQueryContent('trnSmryIdForXlsDtlQuery');
		$params = $this->getQueryParams('trnSmryIdForXlsDtlQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'getTrnSmryIdForXlsDtlQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a scheme by customer id
		------------------------------------------------------------------------
	*/
	public  function getSchemeByCidQuery($cid)
    {
		$sql  = $this->getQueryContent('getSchemeByCidQuery');
		$params = $this->getQueryParams('getSchemeByCidQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		$result= $this->db->fireSqlQueryFetchObject($sql,'getSchemeByCidQuery');
		if($result) return $result->SCHEME_ID;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by customer id
		------------------------------------------------------------------------
	*/
	public  function getTranSummaryTotalByCidQuery($cid)
    {
		$sql  = $this->getQueryContent('TranSummaryTotalByCidQuery');
		$params = $this->getQueryParams('TranSummaryTotalByCidQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'TranSummaryTotalByCidQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by employee id
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryByEidQuery($cid)
    {
		$sql  = $this->getQueryContent('TransactionSummaryByEidQuery');
		$params = $this->getQueryParams('TransactionSummaryByEidQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryByEidQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by Transaction id
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryByTidQuery($tid)
    {
		$sql  = $this->getQueryContent('TransactionSummaryByTidQuery');
		$params = $this->getQueryParams('TransactionSummaryByTidQuery');
		$sql = $this->bindSqlParams($sql,$params,$tid);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryByTidQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by Transaction id
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryBySidQuery($cid)
    {
		$sql  = $this->getQueryContent('TransactionSummaryBySidQuery');
		$params = $this->getQueryParams('TransactionSummaryBySidQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryBySidQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by customer name
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryByCNmQuery($cnm)
    {
		$sql  = $this->getQueryContent('TransactionSummaryByCNmQuery');
		$params = $this->getQueryParams('TransactionSummaryByCNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$cnm);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryByCNmQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by Employee name
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryByENmQuery($cnm)
    {
		$sql  = $this->getQueryContent('TransactionSummaryByENmQuery');
		$params = $this->getQueryParams('TransactionSummaryByENmQuery');
		$sql = $this->bindSqlParams($sql,$params,$cnm);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryByENmQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by searching
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryBySrchQuery($data)
    {
		$xmlData= $this->_getXMLDataById('TransactionSummaryByScrhQuery');
		$result['sql'] =  $this->_readSql($xmlData,$data,true,true);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'], 'TransactionSummaryByScrhQuery');
		return $result;
	}
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by searching
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryRecentQuery($ids)
    {
		$sql  = $this->getQueryContent('TransactionSummaryRecentQuery');
		$params = $this->getQueryParams('TransactionSummaryRecentQuery');
		$sql = $this->bindSqlParams($sql,$params,$ids);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryRecentQuery');
	}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		To get result of transaction on the basis of customer id & scheme id
		------------------------------------------------------------------------
	*/

	public function getTranOnCustAndSchmQuery($data)
		{
			$sql = $this->getQueryContent('tranOnCustAndSchmQuery');
			$params = $this->getQueryParams('tranOnCustAndSchmQuery');
			$sql = $this->bindSqlParams($sql,$params,$data);
			return $this->db->fireSqlQueryFetchObject($sql,'tranOnCustAndSchmQuery');
		}

	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		To get result of transaction on the basis of customer id & scheme id
		------------------------------------------------------------------------
	*/

	public function getTranOnCustQuery($custId)
		{
			$sql = $this->getQueryContent('getTranOnCustQuery');
			$params = $this->getQueryParams('getTranOnCustQuery');
			$sql = $this->bindSqlParams($sql,$params,$custId);
			return $this->db->fireSqlQueryFetchObject($sql,'getTranOnCustQuery');
		}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by searching
		------------------------------------------------------------------------
	*/
	public  function getTrnReceiptRecentQuery($ids)
    {
		$sql  = $this->getQueryContent('trnReceiptRecentQuery');
		$params = $this->getQueryParams('trnReceiptRecentQuery');
		$sql = $this->bindSqlParams($sql,$params,$ids);
		return $this->db->fireSqlFetchAll($sql,'trnReceiptRecentQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by summary id
		------------------------------------------------------------------------
	*/
	public  function getTransactionSummaryQuery($sid)
    {
		$sql  = $this->getQueryContent('TransactionSummaryQuery');
		$params = $this->getQueryParams('TransactionSummaryQuery');
		$sql = $this->bindSqlParams($sql,$params,$sid);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction summary by summary id
		------------------------------------------------------------------------
	*/
	public  function getSummaryByTsIdQuery($sid)
    {
		$sql  = $this->getQueryContent('TransactionSummaryByIdQuery');
		$params = $this->getQueryParams('TransactionSummaryByIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$sid);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryByIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All Customer by payment by employee
		------------------------------------------------------------------------
	*/
	public  function getCustomersByEmployeePayment($eid)
    {
		$sql  = $this->getQueryContent('AllCustomerByEmployeePaymentQuery');
		$params = $this->getQueryParams('AllCustomerByEmployeePaymentQuery');
		$sql = $this->bindSqlParams($sql,$params,$eid);
		return $this->db->fireSqlFetchAll($sql,'AllCustomerByEmployeePaymentQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All Transaction Summaries by customer id
		------------------------------------------------------------------------
	*/
	public  function transactionSummariesByCustID($cid)
    {
		$sql  = $this->getQueryContent('transSummaryByCustIDQuery');
		$params = $this->getQueryParams('transSummaryByCustIDQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'transSummaryByCustIDQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All Transaction Summaries Information by customer id
		------------------------------------------------------------------------
	*/
	public  function getTranSmryInfosByCustIDQuery($cid)
    {
		$sql  = $this->getQueryContent('tranSmryInfosByCustIDQuery');
		$params = $this->getQueryParams('tranSmryInfosByCustIDQuery');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'tranSmryInfosByCustIDQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All Transaction Summaries Information by customer id
		------------------------------------------------------------------------
	*/
	public  function getTranSmryInfosByCustIDQuery2($cid)
    {
		$sql  = $this->getQueryContent('tranSmryInfosByCustIDQuery2');
		$params = $this->getQueryParams('tranSmryInfosByCustIDQuery2');
		$sql = $this->bindSqlParams($sql,$params,$cid);
		return $this->db->fireSqlFetchAll($sql,'tranSmryInfosByCustIDQuery2');
	}



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All transaction summary  (Default)
		------------------------------------------------------------------------
	*/
	public  function getAllTransactionSummaryQuery($limits)
    {
		$sql  = $this->getQueryContent('AllTransactionSummaryQuery');
		$params = $this->getQueryParams('AllTransactionSummaryQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'AllTransactionSummaryQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all payment  (Default)
		------------------------------------------------------------------------
	*/
	public  function getAllPaymentQuery($data)
    {
		$sql  = $this->getQueryContent('AllTransactionSummaryQuery');
		$params = $this->getQueryParams('AllTransactionSummaryQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'AllTransactionSummaryQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of max id of transaction summary  (Default)
		------------------------------------------------------------------------
	*/
	public  function maxTransactionSummaryIdQuery()
    {
		$sql  = $this->getQueryContent('maxTransactionSummaryIdQuery');
		return $this->db->fireSqlQueryFetchObject($sql,'maxTransactionSummaryIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of max id od transaction summary details (Default)
		------------------------------------------------------------------------
	*/
	public  function maxTransactionDetailIdQuery()
    {
		$sql  = $this->getQueryContent('maxTransactionDetailIdQuery');
		return $this->db->fireSqlQueryFetchObject($sql,'maxTransactionDetailIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by transaction summary id
		------------------------------------------------------------------------
	*/
	public  function getTransactionDetailQuery($id)
    {
		$sql  = $this->getQueryContent('TransactionDetailQuery');
		$params = $this->getQueryParams('TransactionDetailQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'TransactionDetailQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by customer id
		------------------------------------------------------------------------
	*/
	public  function tsIdByTdIdQuery($id)
    {
		$sql  = $this->getQueryContent('tsIdByTdIdQuery');
		$params = $this->getQueryParams('tsIdByTdIdQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'tsIdByTdIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by customer id
		------------------------------------------------------------------------
	*/
	public  function trnsSummaryByTsidQuery($id)
    {
		$sql  = $this->getQueryContent('TransactionSummaryOnTsidQuery');
		$params = $this->getQueryParams('TransactionSummaryOnTsidQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryOnTsidQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by customer id
		------------------------------------------------------------------------
	*/
	public  function trnsSummaryByTsid2Query($id)
	{
		$sql  = $this->getQueryContent('TransactionSummaryOnTsid2Query');
		$params = $this->getQueryParams('TransactionSummaryOnTsidQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'TransactionSummaryOnTsid2Query');
	}



	/*
		------------------------------------------------------------------------
		QUERY SPECIFIC FUNCTION
		Function to get due amount of a payment
		------------------------------------------------------------------------
	*/

	public function getTrnSmryDueByTsIdQuery($trnId)
	{
		$sql = $this->getQueryContent('trnSmryDueByTsIdQuery');
		$params = $this->getQueryParams('trnSmryDueByTsIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$trnId);
		return $this->db->fireSqlQueryFetchObject($sql,'trnSmryDueByTsIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by customer id
		------------------------------------------------------------------------
	*/
	public  function getTransactionDetailByCidQuery($id)
	{
		$sql  = $this->getQueryContent('TransactionDetailByCidQuery');
		$params = $this->getQueryParams('TransactionDetailByCidQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'TransactionDetailByCidQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by customer id
		------------------------------------------------------------------------
	*/
	public  function transactionDetailByTdIdQuery($id)
    {
		$sql  = $this->getQueryContent('transactionDetailByTdIdQuery');
		$params = $this->getQueryParams('transactionDetailByTdIdQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'transactionDetailByTdIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Voucher no by Transaction id
		------------------------------------------------------------------------
	*/
	public  function getVoucherNoBySmryIdQuery($id)
    {
		$sql  = $this->getQueryContent('voucherNoBySmryIdQuery');
		$params = $this->getQueryParams('voucherNoBySmryIdQuery');
		$sql = $this->bindSqlParams( $sql,$params,$id);
		return $this->db->fireSqlQueryFetchObject($sql,'voucherNoBySmryIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Voucher Nos by Transaction Ids
		------------------------------------------------------------------------
	*/
	public  function getVoucherNosByTrnsSmryIdsQuery($ids)
    {
		$sql  = $this->getQueryContent('voucherNosByTrnsSmryIdsQuery');
		$params = $this->getQueryParams('voucherNosByTrnsSmryIdsQuery');
		$sql = $this->bindSqlParams( $sql,$params,$ids);
		return $this->db->fireSqlQuery($sql,'voucherNosByTrnsSmryIdsQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a transaction details by searching
		------------------------------------------------------------------------
	*/
	public  function getTransactionDetailBySrchQuery($data)
    {
		$xmlData= $this->_getXMLDataById('TransactionDetailBySrchQuery');
		$result['sql'] =  $this->_readSql($xmlData,$data,true,true);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'TransactionDetailBySrchQuery');
		return $result;
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All transaction summary
		------------------------------------------------------------------------
	*/
	public  function getAllTransactionDetailQuery($limits)
    {
		$sql  = $this->getQueryContent('AllTransactionDetailQuery');
		$params = $this->getQueryParams('AllTransactionDetailQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'AllTransactionDetailQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of All transaction details
		------------------------------------------------------------------------
	*/
	public  function getAllReceiveQuery($limits)
    {
		$sql  = $this->getQueryContent('AllTransactionDetailQuery');
		$params = $this->getQueryParams('AllTransactionDetailQuery');
		$sql = $this->bindSqlParams($sql,$params,$limits);
		return $this->db->fireSqlFetchAll($sql,'AllTransactionDetailQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location of branches
		------------------------------------------------------------------------
	*/
	public  function getMasterLocationsQuery()
    {
		$sql  = $this->getQueryContent('MasterLocationQuery');
		return $this->db->fireSqlQuery($sql,'MasterLocationQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location of branches
		------------------------------------------------------------------------
	*/
	public  function getTransactionChartQuery()
    {
		$sql  = $this->getQueryContent('transactionChartQuery');
		return $this->db->fireSqlFetchAll($sql,'transactionChartQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get employee on customer transaction
	------------------------------------------------------------------------
	*/

	public function getEmpOnCustTranQuery($custId)
	{
		$sql = $this->getQueryContent('empOnCustTranQuery');
		$params = $this->getQueryParams('empOnCustTranQuery');
		$sql = $this->bindSqlParams($sql,$params,$custId);
		return $this->db->fireSqlFetchAll($sql,'empOnCustTranQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get employee on customer transaction
	------------------------------------------------------------------------
	*/

	public function getCombinedTransInfoOnTdIdQuery($tdid)
	{
		$sql = $this->getQueryContent('combinedTransInfoOnTdIdQuery');
		$params = $this->getQueryParams('combinedTransInfoOnTdIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$tdid);
		return $this->db->fireSqlFetchAll($sql,'combinedTransInfoOnTdIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entity based on pattern
		------------------------------------------------------------------------
	*/
	public  function getEntityQuery($ent_nm)
    {
		$sql  = $this->getQueryContent('SuggestEntityNameQuery');
		$params = $this->getQueryParams('SuggestEntityNameQuery');
		$sql = $this->bindSqlParams($sql,$params,$ent_nm);
		return $this->db->fireSqlFetchAll($sql,'SuggestEntityNameQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Employee name and id
		------------------------------------------------------------------------
	*/
	public  function getEmployeeQuery($ent_nm)
    {
		$sql  = $this->getQueryContent('SuggestEmployeeQuery');
		$params = $this->getQueryParams('SuggestEmployeeQuery');
		$sql = $this->bindSqlParams($sql,$params,$ent_nm);
		return $this->db->fireSqlFetchAll($sql,'SuggestEmployeeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer name and id
		------------------------------------------------------------------------
	*/
	public  function getCustomerQuery($cust_nm)
    {
		$sql  = $this->getQueryContent('SuggestCustomerQuery');
		$params = $this->getQueryParams('SuggestCustomerQuery');
		$sql = $this->bindSqlParams($sql,$params,$cust_nm);
		return $this->db->fireSqlFetchAll($sql,'SuggestCustomerQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entity based on pattern
		------------------------------------------------------------------------
	*/
	public  function getAllIdQuery($id)
    {
		$sql  = $this->getQueryContent('SuggestAllIdQuery');
		$params = $this->getQueryParams('SuggestAllIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'SuggestAllIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Scheme information		------------------------------------------------------------------------
	*/
	public  function getSchemeQuery($schm)
    {
		$sql  = $this->getQueryContent('SuggestSchemeQuery');
		$params = $this->getQueryParams('SuggestSchemeQuery');
		$sql = $this->bindSqlParams($sql,$params,$schm);
		return $this->db->fireSqlFetchAll($sql,'SuggestSchemeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customer Name and Id on the basis of employee		------------------------------------------------------------------------
	*/
	public  function getCustOnEmpQuery($data)
    {
		$sql  = $this->getQueryContent('SuggestCustOnEmpQuery');
		$params = $this->getQueryParams('SuggestCustOnEmpQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'SuggestCustOnEmpQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Scheme Name and Transaction Id on the basis of customer		------------------------------------------------------------------------
	*/
	public  function getTrnsOnCustQuery($data)
    {
		$sql  = $this->getQueryContent('SuggestTrnsOnCustQuery');
		$params = $this->getQueryParams('SuggestTrnsOnCustQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'SuggestTrnsOnCustQuery');
	}



/*=================================== E X C E L      Q U R I E S ============================================*/

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of transaction details
		------------------------------------------------------------------------
	*/
	public  function getTransDtlForXlsQuery($data)
    {
		$sqlId='transDtlForXlsQuery';
		$sql  = $this->getQueryContent($sqlId);
		$params = $this->getQueryParams($sqlId);
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,$sqlId);
	}


//----------------------------------- I N S E R T    F U N C T I O N S --------------------------------------
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the address of a Entity
		------------------------------------------------------------------------
	*/
	public  function insertAdditonalRefInfoDML_1($data)
    {
		$sql  = $this->getQueryContent('insertAdditonalRefInfoDML_1');
		$params = $this->getqueryParams('insertAdditonalRefInfoDML_1');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertAdditonalRefInfoDML_1');
		if($status) return 1;
		else return null;
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the Transaction Details of a customer
		------------------------------------------------------------------------
	*/
	public  function InsertTransactionDetailQuery2($data)
    {
		$sql  = $this->getQueryContent('AddTransactionDetailsQuery2');
		$params = $this->getqueryParams('AddTransactionDetailsQuery2');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'AddTransactionDetailsQuery2');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the Transaction summary information collected from XLS file
		------------------------------------------------------------------------
	*/
	public  function insertXLSTrnSmryDML($data)
    {
		$sql  = $this->getQueryContent('insertXLSTrnSmryDML');
		$params = $this->getqueryParams('insertXLSTrnSmryDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertXLSTrnSmryDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the Transaction Details information based on Summary
		------------------------------------------------------------------------
	*/
	public  function insertXLSTrnDtlonSmryDML($data)
    {
		$sql  = $this->getQueryContent('insertXLSTrnDtlonSmryDML');
		$params = $this->getqueryParams('insertXLSTrnDtlonSmryDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertXLSTrnDtlonSmryDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the Transaction Details information collected from XLS file
		------------------------------------------------------------------------
	*/
	public  function insertXLSTrnDtlDML($data)
    {
		$sql  = $this->getQueryContent('insertXLSTrnDtlDML');
		$params = $this->getqueryParams('insertXLSTrnDtlDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertXLSTrnDtlDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert create a empty row the Transaction Summary Table
		------------------------------------------------------------------------
	*/
	public  function insertRowInSummaryDML()
    {
		$sql  = $this->getQueryContent('insertRowInSummaryDML');
		$this->db->fireSqlQuery($sql);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert create a empty row the Transaction Details Table
		------------------------------------------------------------------------
	*/
	public  function insertRowInDetailDML()
    {
		$sql  = $this->getQueryContent('insertRowInDetailDML');
		$this->db->fireSqlQuery($sql);
	}




//------------------------------- U P D A T E -----------------------------------------------


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert payment data to resently added row in summary
		------------------------------------------------------------------------
	*/
	public  function updateInsertedCustPaymentDML($data)
    {
		$sql  = $this->getQueryContent('updateInsertedCustPaymentDML');
		$params = $this->getqueryParams('updateInsertedCustPaymentDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedCustPaymentDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert payment data to resently added row in details
		------------------------------------------------------------------------
	*/
	public  function updateInsertedPaymentDetailDML($data)
    {
		$sql  = $this->getQueryContent('updateInsertedPaymentDetailDML');
		$params = $this->getqueryParams('updateInsertedPaymentDetailDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedPaymentDetailDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the Transaction Details of a customer
		------------------------------------------------------------------------
	*/
	public  function updateInsertedReceiptDetailDML($data)
    {
		$sql  = $this->getQueryContent('updateInsertedReceiptDetailDML');
		$params = $this->getqueryParams('updateInsertedReceiptDetailDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedReceiptDetailDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Update the Transaction Summary information collected from XLS file
		------------------------------------------------------------------------
	*/
	public  function updateXLSTrnSmryDML($data)
    {
		$sql  = $this->getQueryContent('updateXLSTrnSmryDML');
		$params = $this->getqueryParams('updateXLSTrnSmryDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateXLSTrnSmryDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Update the Security deposite payment amount of a customer
		------------------------------------------------------------------------
	*/
	public  function updateSecurityDeposAmountDML($data)
    {
		$sql  = $this->getQueryContent('updateSecurityDeposAmountDML');
		$params = $this->getqueryParams('updateSecurityDeposAmountDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateSecurityDeposAmountDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Update the Transaction Summery of a customer after reciving a amount
		------------------------------------------------------------------------
	*/
	public  function UpdateTrnSummaryByTsIdQuery($data)
    {
		$sql  = $this->getQueryContent('UpdateTrnSummaryByTsIdQuery');
		$params = $this->getqueryParams('UpdateTrnSummaryByTsIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'UpdateTrnSummaryByTsIdQuery');
		if($status) return 1;
		else return null;
	}


	/*
		------------------------------------------------------------------------
		FUNCTION
		Function to update to status field to 'CLOSE'
		------------------------------------------------------------------------
	*/

	public function updateSmryStatusToCloseDML($tsId)
		{
			$sql = $this->getQueryContent('updateSmryStatusToCloseDML');
			$params = $this->getQueryParams('updateSmryStatusToCloseDML');
			$sql = $this->bindSqlParams($sql,$params,$tsId);
			return $this->db->fireSqlQuery($sql,'updateSmryStatusToCloseDML');
		}

	/*
		------------------------------------------------------------------------
		FUNCTION
		Function to update to status field to 'DISBALANCED'
		------------------------------------------------------------------------
	*/

	public function updateSmrStatToDisbalDML($tsId)
		{
			$sql = $this->getQueryContent('updateSmrStatToDisbalDML');
			$params = $this->getQueryParams('updateSmrStatToDisbalDML');
			$sql = $this->bindSqlParams($sql,$params,$tsId);
			return $this->db->fireSqlQuery($sql,'updateSmrStatToDisbalDML');
		}

	/*
		------------------------------------------------------------------------
		FUNCTION
		Function to update to status field to 'CLOSE'
		------------------------------------------------------------------------
	*/

	public function updateSmryStatusToOpenDML($tsId)
		{
			$sql = $this->getQueryContent('updateSmryStatusToOpenDML');
			$params = $this->getQueryParams('updateSmryStatusToOpenDML');
			$sql = $this->bindSqlParams($sql,$params,$tsId);
			return $this->db->fireSqlQuery($sql,'updateSmryStatusToOpenDML');
		}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Update the Transaction details of a customer
		------------------------------------------------------------------------
	*/
	public  function UpdateTrnDetailQuery($data)
    {
		$sql  = $this->getQueryContent('UpdateTrnDetailQuery');
		$params = $this->getqueryParams('UpdateTrnDetailQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'UpdateTrnDetailQuery');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Edit the Transaction Summery of a customer
		------------------------------------------------------------------------
	*/
	public  function editTrnSummaryDML($data)
    {
		$sql  = $this->getQueryContent('editTrnSummaryDML');
		$params = $this->getqueryParams('editTrnSummaryDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'editTrnSummaryDML');
		if($status) return 1;
		else return null;
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Edit the Transaction details of Summery
		------------------------------------------------------------------------
	*/
	public  function editTrnSummaryDetailsDML($data)
    {
		$sql  = $this->getQueryContent('editTrnSummaryDetailsDML');
		$params = $this->getqueryParams('editTrnSummaryDetailsDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'editTrnSummaryDetailsDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Edit the Transaction details of Summery
		------------------------------------------------------------------------
	*/
	public  function editTrnSummaryDetails2DML($data)
    {
		$sql  = $this->getQueryContent('editTrnSummaryDetails2DML');
		$params = $this->getqueryParams('editTrnSummaryDetails2DML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'editTrnSummaryDetails2DML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to update the Transaction details of Summery related infos
		------------------------------------------------------------------------
	*/
	public  function updateSmryRelatedInfoToDtlsDML($data)
    {
		$sql  = $this->getQueryContent('updateSmryRelatedInfoToDtlsDML');
		$params = $this->getqueryParams('updateSmryRelatedInfoToDtlsDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateSmryRelatedInfoToDtlsDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to update the Transaction summary voucher no
		------------------------------------------------------------------------
	*/
	public  function editTrnVoucherOnTrnsIdDML($data)
    {
		$sql  = $this->getQueryContent('editTrnVoucherOnTrnsIdDML');
		$params = $this->getqueryParams('editTrnVoucherOnTrnsIdDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'editTrnVoucherOnTrnsIdDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Edit the Transaction details memo no
		------------------------------------------------------------------------
	*/
	public  function updateTrnMemoOnTdlIdDML($data)
    {
		$sql  = $this->getQueryContent('updateTrnMemoOnTdlIdDML');
		$params = $this->getqueryParams('updateTrnMemoOnTdlIdDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateTrnMemoOnTdlIdDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		
		------------------------------------------------------------------------
	*/
	public  function updateBSDToZeroAndOpenAccDML($data)
    {
		$sql  = $this->getQueryContent('updateBSDToZeroAndOpenAccDML');
		$params = $this->getqueryParams('updateBSDToZeroAndOpenAccDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateBSDToZeroAndOpenAccDML');
		if($status) return 1;
		else return null;
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		
		------------------------------------------------------------------------
	*/
	public  function updateBsdPayOnTsIdDML($data)
    {
		$sql  = $this->getQueryContent('updateBsdPayOnTsIdDML');
		$params = $this->getqueryParams('updateBsdPayOnTsIdDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateBsdPayOnTsIdDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		
		------------------------------------------------------------------------
	*/
	public  function updateBsdPayDetailsOnTsIdDML($data)
    {
		$sql  = $this->getQueryContent('updateBsdPayDetailsOnTsIdDML');
		$params = $this->getqueryParams('updateBsdPayDetailsOnTsIdDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'updateBsdPayDetailsOnTsIdDML');
		if($status) return 1;
		else return null;
	}



//-------------------------- D E L E T E    F U N C T I O N --------------------------------------------

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to cancel the Transaction Summery
		------------------------------------------------------------------------
	*/
	public  function deleteTrnSummaryDML($data)
    {
		$sql  = $this->getQueryContent('cancelTrnSummaryDML');
		$params = $this->getqueryParams('cancelTrnSummaryDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'cancelTrnSummaryDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to cancel the Transaction Summery
		------------------------------------------------------------------------
	*/
	public  function cancelTrnSummaryOnTsId2DML($data)
    {
		$sql  = $this->getQueryContent('cancelTrnSummaryOnTsId2DML');
		$params = $this->getqueryParams('cancelTrnSummaryOnTsId2DML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'cancelTrnSummaryOnTsId2DML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to cancel the Transaction details of Summery
		------------------------------------------------------------------------
	*/
	public  function deleteTrnSummaryDetailsDML($data)
    {
		$sql  = $this->getQueryContent('cancelTrnSummaryDetailsDML');
		$params = $this->getqueryParams('cancelTrnSummaryDetailsDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'cancelTrnSummaryDetailsDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to cancel the Transaction details of Summery
		------------------------------------------------------------------------
	*/
	public  function deleteTrnSummaryVoucherIdsDML($data)
    {
		$sql  = $this->getQueryContent('cancelTrnSummaryVoucherIdsDML');
		$params = $this->getqueryParams('cancelTrnSummaryVoucherIdsDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'cancelTrnSummaryVoucherIdsDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to cancel the Transaction details
		------------------------------------------------------------------------
	*/
	public  function deleteTrnDetailsDML($id)
    {
		$sql  = $this->getQueryContent('cancelTrnDetailsDML');
		$params = $this->getqueryParams('cancelTrnDetailsDML');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$status=$this->db->fireSqlQuery($sql,'cancelTrnDetailsDML');
		if($status) return 1;
		else return null;
	}

	/*-----------------------------SESSION QUERY -----------------------------------*/

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Run Sql taken from session
		------------------------------------------------------------------------
	*/
	public  function executeSessionSQL($sql,$name='Default')
    {
		$result['sql']=$sql;
		$result['result']=$this->db->fireSqlFetchAll($sql,'SESSION-'.$name);
		return $result;
	}


}
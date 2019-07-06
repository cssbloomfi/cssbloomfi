<?php

class modules_ref_models_refAccessQuery extends BinaryBl_XmlSqlBuilder
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		parent::__construct(REF_MASTER_LIB);
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

	  $querylibrary = simplexml_load_file(REF_MASTER_LIB);
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
	  $querythisrary = simplexml_load_file(REF_MASTER_LIB);
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
	  $querythisrary = simplexml_load_file(REF_MASTER_LIB);
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
	  $querythisrary = simplexml_load_file(REF_MASTER_LIB);
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

//-------------------  S E L E C T      F U N C T I O N S ------------------------------

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a customer id
	------------------------------------------------------------------------
	*/

	public function isCustomerIdQuery($custId)
		{
			$sql = $this->getQueryContent('isCustomerIdQuery');
			$params = $this->getQueryParams('isCustomerIdQuery');
			$sql = $this->bindSqlParams($sql,$params,$custId);
			return $this->db->fireSqlFetchAll($sql,'isCustomerIdQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a customer id except self id
	------------------------------------------------------------------------
	*/

	public function isCustomerIdExceptMeQuery($data)
		{
			$sql = $this->getQueryContent('isCustomerIdExceptMeQuery');
			$params = $this->getQueryParams('isCustomerIdExceptMeQuery');
			$sql = $this->bindSqlParams($sql,$params,$data);
			return $this->db->fireSqlFetchAll($sql,'isCustomerIdExceptMeQuery');
		}


	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a employee id
	------------------------------------------------------------------------
	*/

	public function isEmployeeIdQuery($empId)
		{
			$sql = $this->getQueryContent('isEmployeeIdQuery');
			$params = $this->getQueryParams('isEmployeeIdQuery');
			$sql = $this->bindSqlParams($sql,$params,$empId);
			return $this->db->fireSqlFetchAll($sql,'isEmployeeIdQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a employee id except self id
	------------------------------------------------------------------------
	*/

	public function isEmployeeIdExceptMeQuery($data)
		{
			$sql = $this->getQueryContent('isEmployeeIdExceptMeQuery');
			$params = $this->getQueryParams('isEmployeeIdExceptMeQuery');
			$sql = $this->bindSqlParams($sql,$params,$data);
			return $this->db->fireSqlFetchAll($sql,'isEmployeeIdExceptMeQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a scheme id
	------------------------------------------------------------------------
	*/

	public function isSchemeIdQuery($schmId)
		{
			$sql = $this->getQueryContent('isSchemeIdQuery');
			$params = $this->getQueryParams('isSchemeIdQuery');
			$sql = $this->bindSqlParams($sql,$params,$schmId);
			return $this->db->fireSqlFetchAll($sql,'isSchemeIdQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a scheme id except self id
	------------------------------------------------------------------------
	*/

	public function isSchemeIdExceptMeQuery($schmId)
		{
			$sql = $this->getQueryContent('isSchemeIdExceptMeQuery');
			$params = $this->getQueryParams('isSchemeIdExceptMeQuery');
			$sql = $this->bindSqlParams($sql,$params,$schmId);
			return $this->db->fireSqlFetchAll($sql,'isSchemeIdExceptMeQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a location id
	------------------------------------------------------------------------
	*/

	public function isLocationIdQuery($locId)
		{
			$sql = $this->getQueryContent('isLocationIdQuery');
			$params = $this->getQueryParams('isLocationIdQuery');
			$sql = $this->bindSqlParams($sql,$params,$locId);
			return $this->db->fireSqlFetchAll($sql,'isLocationIdQuery');
		}

	/*
	------------------------------------------------------------------------
	OUERY SPECIFIC FUNCTION
	Function to find a location id except self id
	------------------------------------------------------------------------
	*/

	public function isLocationIdExceptMeQuery($locId)
		{
			$sql = $this->getQueryContent('isLocationIdExceptMeQuery');
			$params = $this->getQueryParams('isLocationIdExceptMeQuery');
			$sql = $this->bindSqlParams($sql,$params,$locId);
			return $this->db->fireSqlFetchAll($sql,'isLocationIdExceptMeQuery');
		}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Id list on limit
		------------------------------------------------------------------------
	*/
	public  function getCustomersIdListQuery($limits)
    {
		$sql  = $this->getQueryContent('customersIdListQuery');
		$params = $this->getQueryParams('customersIdListQuery');
		$sql = $this->bindSqlParams($sql,$params,$limits);
		return $this->db->fireSqlFetchAll($sql,'customersIdListQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Searching
		------------------------------------------------------------------------
	*/
	public  function getCustomerIdListBySrchQuery($datas)
    {
		$sql  = $this->getQueryContent('customerIdListBySrchQuery');
		$params = $this->getQueryParams('customerIdListBySrchQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'customerIdListBySrchQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Id list on limit
		------------------------------------------------------------------------
	*/
	public  function getEmployeesIdListQuery($limits)
    {
		$sql  = $this->getQueryContent('employeesIdListQuery');
		$params = $this->getQueryParams('employeesIdListQuery');
		$sql = $this->bindSqlParams($sql,$params,$limits);
		return $this->db->fireSqlFetchAll($sql,'employeesIdListQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Locations on the basis of employee
		------------------------------------------------------------------------
	*/
	public  function getEmployeeLocationsQuery($empId)
    {
		$sql  = $this->getQueryContent('employeeLocationsQuery');
		$params = $this->getQueryParams('employeeLocationsQuery');
		$sql = $this->bindSqlParams($sql,$params,$empId);
		return $this->db->fireSqlFetchAll($sql,'employeeLocationsQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Id list on limit
		------------------------------------------------------------------------
	*/
	public  function getLocationIdListQuery($limits)
    {
		$sql  = $this->getQueryContent('locationIdListQuery');
		$params = $this->getQueryParams('locationIdListQuery');
		$sql = $this->bindSqlParams($sql,$params,$limits);
		return $this->db->fireSqlFetchAll($sql,'locationIdListQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Searching
		------------------------------------------------------------------------
	*/
	public  function getLocationIdListBySrchQuery($datas)
    {
		$sql  = $this->getQueryContent('locationIdListBySrchQuery');
		$params = $this->getQueryParams('locationIdListBySrchQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$datas);
		$result['result']=$this->db->fireSqlFetchAll($result['sql'],'locationIdListBySrchQuery');
		return $result;
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customer related prefix and postfix value
		------------------------------------------------------------------------
	*/
	public  function getCustomerPrePostQuery()
    {
		$sql  = $this->getQueryContent('customerPrePostQuery');
		return $this->db->fireSqlFetchAll($sql,'customerPrePostQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employee related prefix and postfix value
		------------------------------------------------------------------------
	*/
	public  function getEmployeePrePostQuery()
    {
		$sql  = $this->getQueryContent('employeePrePostQuery');
		return $this->db->fireSqlFetchAll($sql,'employeePrePostQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of age limit value
		------------------------------------------------------------------------
	*/
	public  function getCustomerAgeLimitQuery()
    {
		$sql  = $this->getQueryContent('customerAgeLimitQuery');
		return $this->db->fireSqlFetchAll($sql,'customerAgeLimitQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of scheme types
		------------------------------------------------------------------------
	*/
	public  function getAllSchemeTypesQuery()
    {
		$sql  = $this->getQueryContent('allSchemeTypesQuery');
		return $this->db->fireSqlFetchAll($sql,'allSchemeTypesQuery');
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
		Function to get the result of activate rows	of given table	------------------------------------------------------------------------
	*/
	public  function getTotalSchemeCustomerQuery($scheme)
    {
		$sql  = $this->getQueryContent('totalSchemeCustomerQuery');
		$params = $this->getQueryParams('totalSchemeCustomerQuery');
		$sql = $this->bindSqlParams($sql,$params,$scheme);
		return $this->db->fireSqlQueryFetchObject($sql,'totalSchemeCustomerQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entities
		------------------------------------------------------------------------
	*/
	public  function getAllEntityQuery()
    {
		$sql  = $this->getQueryContent('allEntityQuery');
		return $this->db->fireSqlFetchAll($sql,'allEntityQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entities
		------------------------------------------------------------------------
	*/
	public  function getEntityMaxIdQuery()
    {
		$sql  = $this->getQueryContent('entityMaxIdQuery');
		return $this->db->fireFastSqlQueryFetchObject($sql,'entityMaxIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entities
		------------------------------------------------------------------------
	*/
	public  function getEntityMaxIdOnSchemeQuery($schId)
    {
		$sql  = $this->getQueryContent('entityMaxIdOnSchemeQuery');
		$params = $this->getQueryParams('entityMaxIdOnSchemeQuery');
		$sql = $this->bindSqlParams($sql,$params,$schId);
		return $this->db->fireFastSqlQueryFetchObject($sql,'entityMaxIdOnSchemeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the max id
		------------------------------------------------------------------------
	*/
	public  function getCollectorMaxIdQuery()
    {
		$sql  = $this->getQueryContent('collectorMaxIdQuery');
		return $this->db->fireFastSqlQueryFetchObject($sql,'collectorMaxIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name
		------------------------------------------------------------------------
	*/
	public  function getLocationMaxIdQuery()
    {
		$sql  = $this->getQueryContent('locationMaxIdQuery');
		return $this->db->fireFastSqlQueryFetchObject($sql,'locationMaxIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the max id scheme table
		------------------------------------------------------------------------
	*/
	public  function getSchemeMaxIdQuery()
    {
		$sql = $this->getQueryContent('schemeMaxIdQuery');
		return $this->db->fireFastSqlQueryFetchObject($sql);
	}

	 /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  Entity  on the basis of entity id
		------------------------------------------------------------------------
	*/
	public  function getEntityIdQuery($entId)
    {
		$sql  = $this->getQueryContent('EntityIdQuery');
		$params = $this->getQueryParams('EntityIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'EntityIdQuery');
	}

	 /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  collector information on the basis of entity id
		------------------------------------------------------------------------
	*/
	public  function getCollectorIdQuery($entId)
    {
		$sql  = $this->getQueryContent('collectorIdQuery');
		$params = $this->getQueryParams('collectorIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'collectorIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a employee
		------------------------------------------------------------------------
	*/
	public  function getEmployeeQuery($id)
    {
		$sql  = $this->getQueryContent('employeeQuery');
		$params = $this->getQueryParams('employeeQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'employeeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a customer
		------------------------------------------------------------------------
	*/
	public  function getCustomerQuery($id)
    {
		$sql  = $this->getQueryContent('customerQuery');
		$params = $this->getQueryParams('customerQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'customerQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a customer
		------------------------------------------------------------------------
	*/
	public  function isCustomerQuery($id)
    {
		$sql  = $this->getQueryContent('isCustomerQuery');
		$params = $this->getQueryParams('isCustomerQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'isCustomerQuery');
	}



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a scheme on the basis of scheme id
		------------------------------------------------------------------------
	*/
	public  function getSchmQuery($id)
    {
		$sql  = $this->getQueryContent('schemeQuery');
		$params = $this->getQueryParams('schemeQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'schemeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a scheme on the basis of scheme Name
		------------------------------------------------------------------------
	*/
	public  function getSchmByNmQuery($nm)
    {
		$sql  = $this->getQueryContent('schemeByNmQuery');
		$params = $this->getQueryParams('schemeByNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm);
		return $this->db->fireSqlFetchAll($sql,'schemeByNmQuery');
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
		Function to get the result of all Employees Information
		------------------------------------------------------------------------
	*/
	public  function getAllEmployeesInfoQuery($limits)
    {
		$sql  = $this->getQueryContent('AllEmployeesInfoQuery');
		$params = $this->getQueryParams('AllEmployeesInfoQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'AllEmployeesInfoQuery');
		return $result;
	}



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Information By Employee Id
		------------------------------------------------------------------------
	*/
	public  function getEmployeeInfoByIdQuery($id)
    {
		$sql  = $this->getQueryContent('employeeInfoByIdQuery');
		$params = $this->getQueryParams('employeeInfoByIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'employeeInfoByIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Information By searching
		------------------------------------------------------------------------
	*/
	public  function getAllEmployeesInfoBySrchQuery($datas)
    {
		$xmlData= $this->_getXMLDataById('AllEmployeesInfoBySrchQuery');
		$result['sql'] = $this->_readSql($xmlData,$datas,true,true);
		$result['result']= $this->db->fireSqlFetchAll($result['sql'],'AllEmployeesInfoBySrchQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Information By searching
		------------------------------------------------------------------------
	*/
	public  function getAllEmployeesInfoBySrchCountQuery($datas)
    {
		$sql  = $this->getQueryContent('AllEmployeesInfoBySrchCountQuery');
		$params = $this->getQueryParams('AllEmployeesInfoBySrchCountQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'AllEmployeesInfoBySrchCountQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  Customer details on the basis of customer id
		------------------------------------------------------------------------
	*/
	public  function getCustomerInfoByIdQuery($id)
    {
		$sql  = $this->getQueryContent('customersInfoByIdQuery');
		$params = $this->getQueryParams('customersInfoByIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'customersInfoByIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of  Customer details on the basis of customer id
		------------------------------------------------------------------------
	*/
	public  function getCustomerInfoByCustIdQuery($data)
    {
		$sql  = $this->getQueryContent('customersInfoByCustIdQuery');
		$params = $this->getQueryParams('customersInfoByCustIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'customersInfoByCustIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersInfoQuery($limits)
    {
		$sql  = $this->getQueryContent('AllCustomersInfoQuery');
		$params = $this->getQueryParams('AllCustomersInfoQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'AllCustomersInfoQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersInfoCountQuery()
    {
		$sql  = $this->getQueryContent('AllCustomersInfoCountQuery');
		return $this->db->fireSqlFetchAll($sql,'AllCustomersInfoCountQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersQuery()
    {
		$sql  = $this->getQueryContent('AllCustomersQuery');
		return $this->db->fireSqlFetchAll($sql,'AllCustomersQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Customer Id
		------------------------------------------------------------------------
	*/
	public  function getCustAddrIdQuery($ids)
    {
		$sql  = $this->getQueryContent('custAddrIdQuery');
		$params = $this->getQueryParams('custAddrIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$ids);
		return $this->db->fireSqlFetchAll($sql,'custAddrIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Information By Employee Id
		------------------------------------------------------------------------
	*/
	public  function getEmpAddrIdQuery($ids)
    {
		$sql  = $this->getQueryContent('empAddrIdQuery');
		$params = $this->getQueryParams('empAddrIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$ids);
		return $this->db->fireSqlFetchAll($sql,'empAddrIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Customer Id
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersInfoByCIdQuery($id)
    {
		$sql  = $this->getQueryContent('AllCustomersInfoByCIdQuery');
		$params = $this->getQueryParams('AllCustomersInfoByCIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'AllCustomersInfoByCIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Customer Name
		------------------------------------------------------------------------
	*/
	public  function getAllCustomersInfoByCNmQuery($nm)
    {
		$sql  = $this->getQueryContent('AllCustomersInfoByCNmQuery');
		$params = $this->getQueryParams('AllCustomersInfoByCNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm);
		return $this->db->fireSqlFetchAll($sql,'AllCustomersInfoByCNmQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Searching
		------------------------------------------------------------------------
	*/
	public  function getAllCustInfoBySrchQuery($data)
    {
		$xmlData= $this->_getXMLDataById('allCustInfoBySrchQuery');
		$result['sql'] = $this->_readSql($xmlData,$data,true,true);
		$result['result']=$this->db->fireSqlFetchAll($result['sql'],'allCustInfoBySrchQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Information By Searching
		------------------------------------------------------------------------
	*/
	public  function getAllCustInfoBySrchCountQuery($datas)
    {
		$sql  = $this->getQueryContent('allCustInfoBySrchCountQuery');
		$params = $this->getQueryParams('allCustInfoBySrchCountQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'allCustInfoBySrchCountQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location of branches
		------------------------------------------------------------------------
	*/
	public  function getMasterLocationsQuery($limits)
    {
		$sql  = $this->getQueryContent('MasterLocationQuery');
		$params = $this->getQueryParams('MasterLocationQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'MasterLocationQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location on the bases of Location Id
		------------------------------------------------------------------------
	*/
	public  function getMasterLocationsbyLocIdQuery($id)
    {
		$sql  = $this->getQueryContent('MasterLocationByLocIdQuery');
		$params = $this->getQueryParams('MasterLocationByLocIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'MasterLocationByLocIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location on the bases of Id
		------------------------------------------------------------------------
	*/
	public  function getLocationInfobyIdQuery($id)
    {
		$sql  = $this->getQueryContent('locationInfobyIdQuery');
		$params = $this->getQueryParams('locationInfobyIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'locationInfobyIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Master Location
		------------------------------------------------------------------------
	*/
	public  function getAllMasterLocationsQuery()
    {
		$sql  = $this->getQueryContent('allMasterLocationQuery');
		return $this->db->fireSqlFetchAll($sql,'allMasterLocationQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Master Location
		------------------------------------------------------------------------
	*/
	public  function getAllLocationsQuery()
    {
		$sql  = $this->getQueryContent('allLocationsQuery');
		return $this->db->fireSqlFetchAll($sql,'allLocationsQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of a Master Location of branches on the bases of search
		------------------------------------------------------------------------
	*/
	public  function MasterLocationsBySrchQuery($datas)
    {
		$xmlData= $this->_getXMLDataById('MasterLocationsBySrchQuery');
		$result['sql'] = $this->_readSql($xmlData,$datas,true,true);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'MasterLocationsBySrchQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name
		------------------------------------------------------------------------
	*/
	public  function getLocationByNmQuery($loc)
    {
		$sql  = $this->getQueryContent('locationQuery');
		$params = $this->getQueryParams('locationQuery');
		$sql = $this->bindSqlParams($sql,$params,$loc);
		return $this->db->fireSqlFetchAll($sql,'locationQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name on the basis of Parent_location
		------------------------------------------------------------------------
	*/
	public  function getLocationNmByPrntQuery($datas)
    {
		$sql  = $this->getQueryContent('locationNmByPrntQuery');
		$params = $this->getQueryParams('locationNmByPrntQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'locationNmByPrntQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name on the basis of Parent_location
		------------------------------------------------------------------------
	*/
	public  function getLocationNmByPrntOnIdQuery($datas)
    {
		$sql  = $this->getQueryContent('locationNmByPrntOnIdQuery');
		$params = $this->getQueryParams('locationNmByPrntOnIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'locationNmByPrntOnIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name on the basis of Parent_location
		------------------------------------------------------------------------
	*/
	public  function getLocationNmByPrntOnIdExceptMeQuery($datas)
    {
		$sql  = $this->getQueryContent('locationNmByPrntOnIdExceptMeQuery');
		$params = $this->getQueryParams('locationNmByPrntOnIdExceptMeQuery');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlFetchAll($sql,'locationNmByPrntOnIdExceptMeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name
		------------------------------------------------------------------------
	*/
	public  function getLocationIdByNmQuery($loc)
    {
		$sql  = $this->getQueryContent('locationIdByNmQuery');
		$params = $this->getQueryParams('locationIdByNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$loc);
		return $this->db->fireSqlFetchAll($sql,'locationIdByNmQuery');
	}
	
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location Id
		------------------------------------------------------------------------
	*/
	public  function getLocationIdByLocIdQuery($loc)
	{
		$sql  = $this->getQueryContent('locationIdByLocIdQuery');
		$params = $this->getQueryParams('locationIdByLocIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$loc);
		return $this->db->fireSqlFetchAll($sql,'locationIdByLocIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location name
		------------------------------------------------------------------------
	*/
	public  function getLocationIfChildExists($locid)
    {
		$sql  = $this->getQueryContent('locationNameIfChildExistQuery');
		$params = $this->getQueryParams('locationNameIfChildExistQuery');
		$sql = $this->bindSqlParams($sql,$params,$locid);
		return $this->db->fireSqlFetchAll($sql,'locationNameIfChildExistQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all scheme
		------------------------------------------------------------------------
	*/
	public  function getAllSchemeQuery($limits)
    {
		$sql  = $this->getQueryContent('allSchemeQuery');
		$params = $this->getQueryParams('allSchemeQuery');
		$result['sql'] = $this->bindSqlParams($sql,$params,$limits);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'allSchemeQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all scheme
		------------------------------------------------------------------------
	*/
	public  function getAllSchemeMinInfoQuery()
    {
		$sql  = $this->getQueryContent('allSchemeMinInfoQuery');
		return $this->db->fireSqlFetchAll($sql,'allSchemeMinInfoQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location Levels
		------------------------------------------------------------------------
	*/
	public  function getAllLocationLevelsQuery()
    {
		$sql  = $this->getQueryContent('allLocationLevelQuery');
		return $this->db->fireSqlFetchAll($sql,'allLocationLevelQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location Types
		------------------------------------------------------------------------
	*/
	public  function getAllLocationTypesQuery()
    {
		$sql  = $this->getQueryContent('allLocationTypeQuery');
		return $this->db->fireSqlFetchAll($sql,'allLocationTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Location Node Location
		------------------------------------------------------------------------
	*/
	public  function getAllTrnLocations()
    {
		$sql  = $this->getQueryContent('allTrnLocations');
		return $this->db->fireSqlFetchAll($sql,'allTrnLocations');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the Gender Types
		------------------------------------------------------------------------
	*/
	public  function getAllGenderTypesQuery()
    {
		$sql  = $this->getQueryContent('allGenderTypeQuery');
		return $this->db->fireSqlFetchAll($sql,'allGenderTypeQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the All static value of customer
		------------------------------------------------------------------------
	*/
	public  function getAllCustStaticValQuery()
    {
		$sql  = $this->getQueryContent('allCustStaticValQuery');
		return $this->db->fireSqlFetchAll($sql,'allCustStaticValQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the All static value of employee
		------------------------------------------------------------------------
	*/
	public  function getAllEmpStaticValQuery()
    {
		$sql  = $this->getQueryContent('allEmpStaticValQuery');
		return $this->db->fireSqlFetchAll($sql,'getAllEmpStaticValQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Scheme  		------------------------------------------------------------------------
	*/
	public  function getSchemeInfoByIdQuery($id)
    {
		$sql  = $this->getQueryContent('schemeInfoByIdQuery');
		$params = $this->getQueryParams('schemeInfoByIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'getSchemeInfoByIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the division area name on the basis of state
		------------------------------------------------------------------------
	*/
	public  function getDivisionsByState($state)
    {
		$sql  = $this->getQueryContent('divisionsByStateQuery');
		$params = $this->getQueryParams('divisionsByStateQuery');
		$sql = $this->bindSqlParams($sql,$params,$state);
		return $this->db->fireSqlFetchAll($sql,'divisionsByStateQuery');
	}


	 /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entities name and id on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/

	public  function getEntityQuery($entId)
    {
		$sql  = $this->getQueryContent('SuggestEmployeeEntityIdQuery');
		$params = $this->getQueryParams('SuggestEmployeeEntityIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'SuggestEmployeeEntityIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all entitie css ids on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/

	public  function getEntityCssIdQuery($entId)
    {
		$sql  = $this->getQueryContent('SuggestEntityCssIdQuery');
		$params = $this->getQueryParams('SuggestEntityCssIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$entId);
		return $this->db->fireSqlFetchAll($sql,'SuggestEntityCssIdQuery');
	}



	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Customers Name on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/
	public  function getCustomersNmQuery($nm_key)
    {
		$sql  = $this->getQueryContent('SuggestCustomersNmQuery');
		$params = $this->getQueryParams('SuggestCustomersNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm_key);
		return $this->db->fireSqlFetchAll($sql,'SuggestCustomersNmQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Name on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/
	public  function getEmployeesNmQuery($nm_key)
    {
		$sql  = $this->getQueryContent('SuggestEmployeesNmQuery');
		$params = $this->getQueryParams('SuggestEmployeesNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm_key);
		return $this->db->fireSqlFetchAll($sql,'SuggestEmployeesNmQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees Name and Entity Id on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/
	public  function getEmployeeEntityIdQuery($nm_key)
    {
		$sql  = $this->getQueryContent('SuggestEmployeeEntityIdQuery');
		$params = $this->getQueryParams('SuggestEmployeeEntityIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm_key);
		return $this->db->fireSqlFetchAll($sql,'SuggestEmployeeEntityIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all customer id on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/
	public  function getCustomersIdQuery($id)
    {
		$sql  = $this->getQueryContent('SuggestCustomersIdQuery');
		$params = $this->getQueryParams('SuggestCustomersIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'SuggestCustomersIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Employees id on the basis of name pattern for AutoComplete
		------------------------------------------------------------------------
	*/
	public  function getEmployeesIdQuery($id)
    {
		$sql  = $this->getQueryContent('SuggestEmployeesIdQuery');
		$params = $this->getQueryParams('SuggestEmployeesIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'SuggestEmployeesIdQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Scheme information for AutoComplete		------------------------------------------------------------------------
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
		Function to get the result of all Scheme information for AutoComplete		------------------------------------------------------------------------
	*/
	public  function getAllSchemeInfoBySrchQuery($data)
    {
		$xmlData= $this->_getXMLDataById('allSchemeInfoBySrchQuery');
		$result['sql'] = $this->_readSql($xmlData,$data,true,true);
		$result['result'] = $this->db->fireSqlFetchAll($result['sql'],'allSchemeInfoBySrchQuery');
		return $result;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of all Scheme information for AutoComplete		------------------------------------------------------------------------
	*/
	public  function getAllSchemeInIdQuery($data)
    {
		$sql  = $this->getQueryContent('allSchemeInIdQuery');
		$params = $this->getQueryParams('allSchemeInIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,'getAllSchemeInIdQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of State name(s) for AutoComplete	 		------------------------------------------------------------------------
	*/
	public  function getCountryQuery($country)
    {
		$sql  = $this->getQueryContent('SuggestCountryQuery');
		$params = $this->getQueryParams('SuggestCountryQuery');
		$sql = $this->bindSqlParams($sql,$params,$country);
		return $this->db->fireSqlFetchAll($sql,'SuggestCountryQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of State name(s) for AutoComplete	 		------------------------------------------------------------------------
	*/
	public  function getStateQuery($state)
    {
		$sql  = $this->getQueryContent('SuggestStateQuery');
		$params = $this->getQueryParams('SuggestStateQuery');
		$sql = $this->bindSqlParams($sql,$params,$state);
		return $this->db->fireSqlFetchAll($sql,'SuggestStateQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Loction  name(s) for AutoComplete	 		------------------------------------------------------------------------
	*/
	public  function getLocationQuery($loc)
    {
		$sql  = $this->getQueryContent('SuggestLocQuery');
		$params = $this->getQueryParams('SuggestLocQuery');
		$sql = $this->bindSqlParams($sql,$params,$loc);
		return $this->db->fireSqlFetchAll($sql,'SuggestLocQuery');
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Loction  name(s) for AutoComplete	 		------------------------------------------------------------------------
	*/
	public  function getLocation1Query($loc)
    {
		$sql  = $this->getQueryContent('SuggestLoc1Query');
		$params = $this->getQueryParams('SuggestLoc1Query');
		$sql = $this->bindSqlParams($sql,$params,$loc);
		return $this->db->fireSqlFetchAll($sql,'SuggestLoc1Query');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Scheme  name(s) for AutoComplete	 	------------------------------------------------------------------------
	*/
	public  function getSuggestedSchmNmQuery($nm)
    {
		$sql  = $this->getQueryContent('SuggestSchmNmQuery');
		$params = $this->getQueryParams('SuggestSchmNmQuery');
		$sql = $this->bindSqlParams($sql,$params,$nm);
		return $this->db->fireSqlFetchAll($sql,'getSuggestedSchmNmQuery');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of Scheme  id(s) for AutoComplete	 	------------------------------------------------------------------------
	*/
	public  function getSuggestedSchmIdQuery($id)
    {
		$sql  = $this->getQueryContent('SuggestSchmIdQuery');
		$params = $this->getQueryParams('SuggestSchmIdQuery');
		$sql = $this->bindSqlParams($sql,$params,$id);
		return $this->db->fireSqlFetchAll($sql,'getSuggestedSchmIdQuery');
	}

/*============================== XLS QUERIERS ===================================*/

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customers for excel export	 	------------------------------------------------------------------------
	*/
	public  function getCustomersForXlsQuery($data)
    {
		$sqlId='customersForXlsQuery';
		$sql  = $this->getQueryContent($sqlId);
		$params = $this->getQueryParams($sqlId);
		$sql = $this->bindSqlParams($sql,$params,$data);
		return $this->db->fireSqlFetchAll($sql,$sqlId);
	}


//------------------------ I N S E R T      F U N C T I O N S ------------------------

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert a empty row to entity table
		------------------------------------------------------------------------
	*/
	public  function insertRowInEntityTblDML()
    {
		$sql = $this->getQueryContent('insertRowInEntityTblDML');
		return $this->db->fireFastSqlQuery($sql,'insertRowInEntityTblDML');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert a empty row to collector table
		------------------------------------------------------------------------
	*/
	public  function insertRowInCollectorTblDML()
    {
		$sql = $this->getQueryContent('insertRowInCollectorTblDML');
		return $this->db->fireFastSqlQuery($sql,'insertRowInCollectorTblDML');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert a empty row to location table
		------------------------------------------------------------------------
	*/
	public  function insertRowInLocationTblDML()
    {
		$sql = $this->getQueryContent('insertRowInLocationTblDML');
		return $this->db->fireFastSqlQuery($sql);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to insert a empty row to scheme table
		------------------------------------------------------------------------
	*/
	public  function insertRowInSchemeTblDML()
    {
		$sql = $this->getQueryContent('insertRowInSchemeTblDML');
		return $this->db->fireFastSqlQuery($sql);
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the address of a Entity
		------------------------------------------------------------------------
	*/
	public  function InsertEntityAddressQuery($data)
    {
		$sql  = $this->getQueryContent('insertEntityAddressQuery');
		$params = $this->getqueryParams('insertEntityAddressQuery');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertEntityAddressQuery');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the address of a Entity
		------------------------------------------------------------------------
	*/
	public  function insertEmpLocInfoDML($data)
    {
		$sql  = $this->getQueryContent('insertEmpLocInfoDML');
		$params = $this->getqueryParams('insertEmpLocInfoDML');
		$sql = $this->bindSqlParams($sql,$params,$data);
		$status=$this->db->fireSqlQuery($sql,'insertEmpLocInfoDML');
		if($status) return 1;
		else return null;
	}




//-----------------U P D A T E    F U N C T I O N -----------------------------------


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the account informations of a customer
		------------------------------------------------------------------------
	*/
	public  function updateInsertedCustomerDML($datas)
    {
		$sql  = $this->getQueryContent('updateInsertedCustomerDML');
		$params = $this->getqueryParams('updateInsertedCustomerDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		return $this->db->fireSqlForException($sql,'updateInsertedCustomerDML');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert the account informations of a customer
		------------------------------------------------------------------------
	*/
	public  function updateInsertedEmployeeDML($datas)
    {
		$sql  = $this->getQueryContent('updateInsertedEmployeeDML');
		$params = $this->getqueryParams('updateInsertedEmployeeDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedEmployeeDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert Scheme Information
		------------------------------------------------------------------------
	*/
	public  function updateInsertedSchemeDML($datas)
    {
		$sql  = $this->getQueryContent('updateInsertedSchemeDML');
		$params = $this->getqueryParams('updateInsertedSchemeDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedSchemeDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to Insert Location Information
		------------------------------------------------------------------------
	*/
	public  function updateInsertedLocationDML($datas)
    {
		$sql  = $this->getQueryContent('updateInsertedLocationDML');
		$params = $this->getqueryParams('updateInsertedLocationDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateInsertedLocationDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Customer Information
		------------------------------------------------------------------------
	*/
	public  function updateCustomerDML($datas)
    {
		$sql  = $this->getQueryContent('updateCustomerDML');
		$params = $this->getqueryParams('updateCustomerDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateCustomerDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Customer's address Information
		------------------------------------------------------------------------
	*/
	public  function updateCustomerAddrDML($datas)
    {
		$sql  = $this->getQueryContent('updateCustomerAddrDML');
		$params = $this->getqueryParams('updateCustomerAddrDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateCustomerAddrDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Employee Information
		------------------------------------------------------------------------
	*/
	public  function updateEmployeeDML($datas)
    {
		$sql  = $this->getQueryContent('updateEmployeeDML');
		$params = $this->getqueryParams('updateEmployeeDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateEmployeeDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Employee's address Information
		------------------------------------------------------------------------
	*/
	public  function updateEmployeeAddrDML($datas)
    {
		$sql  = $this->getQueryContent('updateEmployeeAddrDML');
		$params = $this->getqueryParams('updateEmployeeAddrDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateEmployeeAddrDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Location Information
		------------------------------------------------------------------------
	*/
	public  function updateLocationDML($datas)
    {
		$sql  = $this->getQueryContent('updateLocationDML');
		$params = $this->getqueryParams('updateLocationDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateLocationDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    UPDATE SPECIFIC FUNCTION
		Function to Update Master Scheme Information
		------------------------------------------------------------------------
	*/
	public  function updateSchemeDML($datas)
    {
		$sql  = $this->getQueryContent('updateSchemeDML');
		$params = $this->getqueryParams('updateSchemeDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'updateSchemeDML');
		if($status) return 1;
		else return null;
	}

//-----------------D E L E T E    F U N C T I O N -----------------------------------

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to Update Master Location Information
		------------------------------------------------------------------------
	*/
	public  function deleteLocationDML($datas)
    {
		$sql  = $this->getQueryContent('cancelLocationDML');
		$params = $this->getqueryParams('cancelLocationDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'cancelLocationDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to Cancel Master Customer Information
		------------------------------------------------------------------------
	*/
	public  function deleteCustomerDML($datas)
    {
		$sql  = $this->getQueryContent('cancelCustDML');
		$params = $this->getqueryParams('cancelCustDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'cancelCustDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to Cancel Master Employee Information
		------------------------------------------------------------------------
	*/
	public  function deleteEmployeeDML($datas)
    {
		$sql  = $this->getQueryContent('cancelEmpDML');
		$params = $this->getqueryParams('cancelEmpDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'cancelEmpDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to inactive Master Entities Address Information
		------------------------------------------------------------------------
	*/
	public  function deleteEntityAddrDML($datas)
    {
		$sql  = $this->getQueryContent('cancelEntityAddrDML');
		$params = $this->getqueryParams('cancelEntityAddrDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'cancelEntityAddrDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to inactive Master Entities Address Information
		------------------------------------------------------------------------
	*/
	public  function cancelSchemeInIdDML($datas)
    {
		$sql  = $this->getQueryContent('cancelSchemeInIdDML');
		$params = $this->getqueryParams('cancelSchemeInIdDML');
		$sql = $this->bindSqlParams($sql,$params,$datas);
		$status=$this->db->fireSqlQuery($sql,'cancelSchemeInIdDML');
		if($status) return 1;
		else return null;
	}

	/*
		------------------------------------------------------------------------
	    DELETE SPECIFIC FUNCTION
		Function to delete rows from the employee location map table on the basis of entity id
		------------------------------------------------------------------------
	*/
	public  function deleteEmpLocInEntidDML($id)
    {
		$sql  = $this->getQueryContent('deleteEmpLocInEntidDML');
		$params = $this->getqueryParams('deleteEmpLocInEntidDML');
		$sql = $this->bindSqlParams($sql,$params,$id);
		$status=$this->db->fireSqlQuery($sql,'deleteEmpLocInEntidDML');
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
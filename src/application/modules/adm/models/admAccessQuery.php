<?php

class modules_adm_models_admAccessQuery extends Bloomfi_App_Ulibrary
{
	protected  $db;
	protected $_param=null;

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

	  $querylibrary = simplexml_load_file(ADM_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(ADM_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(ADM_QUERY_LIB);
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
	  $querythisrary = simplexml_load_file(ADM_QUERY_LIB);
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
	
	//
	//
	//public function checkForDbLock($arr=null,$lockerVariableName='locker')
	//{
	//	$this->_param[$lockerVariableName]=array();
	//	foreach($arr as $dbKey){
	//		$status=$this->goForlock($dbKey,$lockerVariableName);
	//		if($status==false){
	//			$this->unlockAllDbLock($lockerVariableName);
	//			return null;
	//		}
	//	}
	//	return true;
	//}
	//	
	//public function goForlock($dbKey,$lockerVariableName)
	//{
	//	$status=$this->waitOrGo($dbKey);
	//	if($status){
	//		array_push($this->_param[$lockerVariableName],$dbKey);
	//		return true;
	//	}else{
	//		return false;
	//	}	
	//}
	//
	//public function unlockAllDbLock($lockerVariableName='locker')
	//{
	//	$sectionKeys=array_reverse($this->_param[$lockerVariableName]);
	//	foreach( $sectionKeys as $dbKey)
	//	{
	//		$this->releaseSectionLock($dbKey);
	//	}
	//}
	//
	//public function isSectionLock($section,$status='BUSY')
	//{
	//	$query="SELECT ACTIVITY_STATUS FROM mst_app_status WHERE SECTION='$section' AND ACTIVITY_STATUS='$status'";
	//	$result=$this->db->fireFastSqlQueryFetchObject($query);
	//	if($result) return true;
	//	else null;
	//}
	//public function getSectionLock($section,$status='BUSY')
	//{
	//	$query="UPDATE mst_app_status SET ACTIVITY_STATUS='$status'  WHERE SECTION='$section'";
	//	$this->db->fireFastSqlQuery($query);
	//}
	//
	//public function releaseSectionLock($section,$status='NORMAL')
	//{
	//	$query="UPDATE mst_app_status SET ACTIVITY_STATUS='$status'  WHERE SECTION='$section'";
	//	$this->db->fireFastSqlQuery($query);
	//}
	//
	//public function waitOrGo($string)
	//{
	//	$start_phase=rand(100,500);
	//	usleep($start_phase);
	//	$status=$this->isSectionLock($string);
	//	if(!$status) {
	//		$this->getSectionLock($string);
	//		return true; }
	//	else{
	//		set_time_limit(3600);
	//		$allow=0;
	//		$phase1_microSec=rand(100,200);
	//		$phase1_limit=rand(16000,17000);
	//		for($i=0;$i<$phase1_limit;$i++){
	//			$status=$this->isSectionLock($string);
	//			if(!$status){ $this->getSectionLock($string);
	//				return true;}
	//			else usleep($phase1_microSec);}
	//		$phase2_microSec=rand(10,50);
	//		$phase2_limit=rand(12000,13000);
	//		for($i=0;$i<$phase2_limit;$i++){
	//			$status=$this->isSectionLock($string);
	//			if(!$status){ $this->getSectionLock($string);
	//				return true;}
	//			else usleep($phase2_microSec);}
	//		$phase3_microSec=rand(1,10);
	//		$phase3_limit=rand(10000,11000);
	//		for($i=0;$i<$phase3_limit;$i++){
	//			$status=$this->isSectionLock($string);
	//			if(!$status){ $this->getSectionLock($string);
	//			return true;}
	//			else usleep($phase3_microSec);}
	//	}
	//	return null;
	//}


	/*=================================================================================================*/

	//-------------------  S E L E C T      F U N C T I O N S ------------------------------

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not
	------------------------------------------------------------------------
	*/

	public function isExistScreenNameQuery($nm)
	{
		$sql=$this->getQueryContentWithParams('isExistScreenNameQuery',true,$nm);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistScreenNameQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not
	------------------------------------------------------------------------
	*/

	public function isExistScreenNameExceptMeQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistScreenNameExceptMeQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistScreenNameExceptMeQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not
	------------------------------------------------------------------------
	*/

	public function isExistScreenCodeQuery($id)
	{
		$sql=$this->getQueryContentWithParams('isExistScreenCodeQuery',true,$id);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistScreenCodeQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not
	------------------------------------------------------------------------
	*/

	public function isExistScreenCodeExceptMeQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistScreenCodeExceptMeQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistScreenCodeExceptMeQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not
	------------------------------------------------------------------------
	*/
	public function isExistRoleIdQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistRoleIdQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistRoleIdQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a screen name is exist or not except existing row
	------------------------------------------------------------------------
	*/
	public function isExistRoleIdExceptMeQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistRoleIdExceptMeQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistRoleIdExceptMeQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a user id is exist or not
	------------------------------------------------------------------------
	*/
	public function isExistUserIdQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistUserIdQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistUserIdQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a user id is exist or not except existing row
	------------------------------------------------------------------------
	*/
	public function isExistUserIdExceptMeQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistUserIdExceptMeQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistUserIdExceptMeQuery');
	}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getUserOnSrchQuery($data)
		{
			$result['sql'] = $sql=$this->getQueryContentWithParams('userOnSrchQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'userOnSrchQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user information by id
	------------------------------------------------------------------------
	*/

	public function getUserInfoByIdQuery($id)
		{
			$sql=$this->getQueryContentWithParams('userInfoByIdQuery',true,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'userInfoByIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user information by user id
	------------------------------------------------------------------------
	*/

	public function getUserInfoByUserIdQuery($uid)
		{
			$sql=$this->getQueryContentWithParams('userInfoByUserIdQuery',true,$uid);
			return $this->db->fireSqlQueryFetchObject($sql,'userInfoByUserIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get component group information by  id
	------------------------------------------------------------------------
	*/

	public function getCompGroupInfoOnIdQuery($id)
		{
			$sql=$this->getQueryContentWithParams('compGroupInfoOnIdQuery',true,$id);
			return $this->db->fireSqlFetchAll($sql,'compGroupInfoOnIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get component group information by  id
	------------------------------------------------------------------------
	*/

	public function getCompGroupCompsOnGrpIdQuery($id)
		{
			$sql=$this->getQueryContentWithParams('compGroupCompsOnGrpIdQuery',true,$id);
			return $this->db->fireSqlFetchAll($sql,'compGroupCompsOnGrpIdQuery');
		}


	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user all user roles
	------------------------------------------------------------------------
	*/

	public function getAllRolesQuery()
		{
			$sql=$this->getQueryContentWithParams('allRolesQuery');
			return $this->db->fireSqlFetchAll($sql,'allRolesQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION

	------------------------------------------------------------------------
	*/

	public function getAllCompScreenPositionQuery()
		{
			$sql=$this->getQueryContentWithParams('allCompScreenPositionQuery');
			return $this->db->fireSqlFetchAll($sql,'allCompScreenPositionQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all component group name
	------------------------------------------------------------------------
	*/

	public function getAllCompGroupInfoQuery()
		{
			$sql=$this->getQueryContentWithParams('allCompGroupInfoQuery');
			return $this->db->fireSqlFetchAll($sql,'allCompGroupInfoQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user roles on map id
	------------------------------------------------------------------------
	*/

	public function getUsrRoleInfoByMapIdQuery($mapId)
		{
			$sql=$this->getQueryContentWithParams('userRoleInfoByMapIdQuery',true,$mapId);
			return $this->db->fireSqlFetchAll($sql,'userRoleInfoByMapIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user roles on map id
	------------------------------------------------------------------------
	*/

	public function getRoleMenuInfoByMapIdQuery($mapId)
		{
			$sql=$this->getQueryContentWithParams('roleMenuInfoByMapIdQuery',true,$mapId);
			return $this->db->fireSqlFetchAll($sql,'roleMenuInfoByMapIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get role information by id
	------------------------------------------------------------------------
	*/

	public function getRoleInfoByIdQuery($id)
		{
			$sql=$this->getQueryContentWithParams('roleInfoByIdQuery',true,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'roleInfoByIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user and role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getAllResourceMenuQuery()
		{
			$sql = $this->getQueryContentWithParams('allResourceMenuQuery');
			$result=$this->db->fireSqlFetchAll($sql,'allResourceMenuQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user and role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getUserRoleOnSrchQuery($data)
		{
			$result['sql'] = $this->getQueryContentWithParams('userRoleOnSrchQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'userRoleOnSrchQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user and role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getRoleMenuOnSrchQuery($data)
		{
			$result['sql'] = $this->getQueryContentWithParams('roleMenuOnSrchQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'roleMenuOnSrchQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all screen information
	------------------------------------------------------------------------
	*/

	public function getAllScreenInfoQuery($data)
		{
			$result['sql'] = $this->getQueryContentWithParams('allScreenInfoQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'allScreenInfoQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all component group information
	------------------------------------------------------------------------
	*/

	public function getAllComponentGroupQuery($data)
		{
			$result['sql'] = $this->getQueryContentWithParams('allComponentGroupQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'allComponentGroupQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	------------------------------------------------------------------------
	*/

	public function getComponentGroupOnIdQuery()
		{
			$sql = $this->getQueryContentWithParams('componentGroupOnIdQuery');
			return $this->db->fireSqlFetchAll($sql,'componentGroupOnIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get component gruop information on id
	------------------------------------------------------------------------
	*/

	public function getRoleCompGroupInfoQuery()
		{
			$sql = $this->getQueryContentWithParams('roleCompGroupInfoQuery');
			return $this->db->fireSqlFetchAll($sql,'roleCompGroupInfoQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get component gruop name on comp id
	------------------------------------------------------------------------
	*/

	public function getCompGroupNameOnCompGroupIdQuery($id)
		{
			$sql = $this->getQueryContentWithParams('compGroupNameOnCompGroupIdQuery',true,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'compGroupNameOnCompGroupIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all screen information
	------------------------------------------------------------------------
	*/

	public function getScreenInfoOnScrnIdQuery($data)
		{
			$sql = $this->getQueryContentWithParams('screenInfoOnScrnIdQuery',true,$data);
			return $this->db->fireSqlFetchAll($sql,'screenInfoOnScrnIdQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user and role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getRoleFromRolAppResQuery($userId)
		{
			$sql=$this->getQueryContentWithParams('roleFromRolAppResQuery',true,$userId);
			$result=$this->db->fireSqlQueryFetchObject($sql,'roleFromRolAppResQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getAllRoleInfoOnSrchQuery($data)
		{
			$result['sql']=$this->getQueryContentWithParams('allRoleInfoOnSrchQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'allRoleInfoOnSrchQuery');
			return $result;
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getAllComponentGroupListQuery()
		{
			$sql=$this->getQueryContentWithParams('allComponentGroupListQuery',true,null);
			return $this->db->fireSqlFetchAll($sql,'allComponentGroupListQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all role information all/basis on  search
	------------------------------------------------------------------------
	*/

	public function getAllComponentNameQuery()
		{
			$sql=$this->getQueryContentWithParams('allComponentNameQuery',true,null);
			return $this->db->fireSqlFetchAll($sql,'allComponentNameQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all application screen id
	------------------------------------------------------------------------
	*/

	public function getAllApplicationScreensQuery()
		{
			$sql=$this->getQueryContentWithParams('allApplicationScreensQuery');
			return $this->db->fireSqlFetchAll($sql,'allApplicationScreensQuery');
		}

	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get all application screen id
	------------------------------------------------------------------------
	*/

	public function getRoleInfoOnIdQuery($id)
		{
			$sql=$this->getQueryContentWithParams('roleInfoOnIdQuery',true,$id);
			return $this->db->fireSqlQueryFetchObject($sql,'roleInfoOnIdQuery');
		}



	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user all user roles
	------------------------------------------------------------------------
	*/

	public function SuggestUserIdQuery($uid)
		{
			$sql=$this->getQueryContentWithParams('SuggestUserIdQuery',true,$uid);
			return $this->db->fireSqlFetchAll($sql,'SuggestUserIdQuery');
		}
		
	
	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a user id is exist or not except existing row
	------------------------------------------------------------------------
	*/
	public function isExistFinYearExceptMeQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistFinYearExceptMeQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistFinYearExceptMeQuery');
	}
	
	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to check weither a user id is exist or not 
	------------------------------------------------------------------------
	*/
	public function isExistFinYearQuery($data)
	{
		$sql=$this->getQueryContentWithParams('isExistFinYearQuery',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'isExistFinYearQuery');
	}
	
	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user information all/basis on  search
	------------------------------------------------------------------------
	*/
	
	public function getFinYearInfoOnSrchQuery($data)
		{
			$result['sql'] = $sql=$this->getQueryContentWithParams('finYearInfoOnSrchQuery',true,$data);
			$result['result']=$this->db->fireSqlFetchAll($result['sql'],'finYearInfoOnSrchQuery');
			return $result;
		}
		
	/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get user information all/basis on  search
	------------------------------------------------------------------------
	*/
	
	public function getFinYearInfoById($data)
	{
		$sql=$this->getQueryContentWithParams('finYearInfoById',true,$data);
		return $this->db->fireSqlQueryFetchObject($sql,'finYearInfoById');
	}
	
		/*
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	Function to get Financial year activation by  id
	------------------------------------------------------------------------
	*/
	
	public function activateFinancialYear($id)
	{
		$sql=$this->getQueryContentWithParams('activateFinancialYearQuery',true,$id);
		return $this->db->fireSqlFetchAll($sql,'activateFinancialYearQuery');
	}
	
	/*	
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	
	------------------------------------------------------------------------
	*/
	
	public function deactivateAllFinancialYear()
		{
			$sql=$this->getQueryContentWithParams('deactivateAllFinancialYearQuery');
			return $this->db->fireSqlFetchAll($sql,'deactivateAllFinancialYearQuery');
		}
			
	/*	
	------------------------------------------------------------------------
	QUERY SPECIFIC FUNCTION
	
	------------------------------------------------------------------------
	*/
	
	public function checkActiveFinYear($id)
		{
			$sql=$this->getQueryContentWithParams('checkActiveFinYearQuery',true,$id);
			return $this->db->fireSqlFetchAll($sql,'checkActiveFinYearQuery');
		}



	//------------- S E L E C T      F U N C T I O N S      E N D S -------------------------



	//------------------ I N S E R T       F U N C T I O N S ------------------------------
	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function insertUserInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertUserInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertUserInfoDML');
			return $this->status($result);
		}
		
		 /*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert financial year information
	------------------------------------------------------------------------
	*/
	
	public function insertFinYearInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertFinYearInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertFinYearInfoDML');
			return $this->status($result);
		}
	
			
	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to get user information all/basis on  search
	------------------------------------------------------------------------
	*/
	
	public function updateFinYearInfoDML($data)
	{
		$sql=$this->getQueryContentWithParams('updateFinYearInfoDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'updateFinYearInfoDML');
		return $this->status($result);
	}


	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user role information
	------------------------------------------------------------------------
	*/

	public function insertUserRoleInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertUserRoleInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertUserRoleInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user role information
	------------------------------------------------------------------------
	*/

	public function insertMenuRoleInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertMenuRoleInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertMenuRoleInfoDML');
			return $this->status($result);
		}


	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function insertRoleInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertRoleInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertRoleInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function insertComponentAccessDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertComponentAccessDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertComponentAccessDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert component detail information
	------------------------------------------------------------------------
	*/

	public function insertComponentScreenDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertComponentScreenDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertComponentScreenDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert component basic information
	------------------------------------------------------------------------
	*/

	public function insertComponentScreenBasicInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('insertComponentScreenBasicInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'insertComponentScreenBasicInfoDML');
			return $this->status($result);
		}

	//------------- I N S E R T      F U N C T I O N S      E N D S -------------------------

	//-------------------  U P D A T E       F U N C T I O N S ------------------------------
	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function updateUserInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateUserInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateUserInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function updateUserIdForRole($data)
		{
			$sql=$this->getQueryContentWithParams('updateUserIdForRole',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateUserIdForRole');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert user information
	------------------------------------------------------------------------
	*/

	public function updateRoleInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateRoleInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateRoleInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert component basic information
	------------------------------------------------------------------------
	*/
	public function updateComponentScreenBasicInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateComponentScreenBasicInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateComponentScreenBasicInfoDML');
			return $this->status($result);
		}


	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function
	------------------------------------------------------------------------
	*/
	public function updateRoleIdInResJoinDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateRoleIdInResJoinDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateRoleIdInResJoinDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to update role id of components on role id
	------------------------------------------------------------------------
	*/
	public function updateComponentsRoleIdDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateComponentsRoleIdDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateComponentsRoleIdDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to update role id of user role
	------------------------------------------------------------------------
	*/
	public function updateRoleIdInUserJoinDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateRoleIdInUserJoinDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateRoleIdInUserJoinDML');
			return $this->status($result);
		}


	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to insert component basic information
	------------------------------------------------------------------------
	*/
	public function updateGroupIdRoleInfoDML($data)
		{
			$sql=$this->getQueryContentWithParams('updateGroupIdRoleInfoDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'updateGroupIdRoleInfoDML');
			return $this->status($result);
		}


	//------------U P D A T E      F U N C T I O N S      E N D S -------------------------

	//----------------  D E L E T E      F U N C T I O N S ------------------------------

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete user role information
	------------------------------------------------------------------------
	*/

	public function deleteUserRoleDML($userId)
		{
			$sql=$this->getQueryContentWithParams('deleteUserRoleDML',true,$userId);
			$result= $this->db->fireSqlQuery($sql,'deleteUserRoleDML');
			return $this->status($result);
		}

	/*

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete user role information
	------------------------------------------------------------------------
	*/

	public function deleteUserInfoDML($userId)
		{
			$sql=$this->getQueryContentWithParams('deleteUserInfoDML',true,$userId);
			$result= $this->db->fireSqlQuery($sql,'deleteUserInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete user role information
	------------------------------------------------------------------------
	*/

	public function deleteRoleInfoDML($roleid)
		{
			$sql=$this->getQueryContentWithParams('deleteRoleInfoDML',true,$roleid);
			$result= $this->db->fireSqlQuery($sql,'deleteRoleInfoDML');
			return $this->status($result);
		}

	/*

	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete menu role information
	------------------------------------------------------------------------
	*/

	public function deleteRoleMenuInfoDML($roleId)
		{
			$sql=$this->getQueryContentWithParams('deleteRoleMenuInfoDML',true,$roleId);
			$result= $this->db->fireSqlQuery($sql,'deleteRoleMenuInfoDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete menu role information
	------------------------------------------------------------------------
	*/

	public function deleteRoleComponentDML($data)
		{
			$sql=$this->getQueryContentWithParams('deleteRoleComponentDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'deleteRoleComponentDML');
			return $this->status($result);
		}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete all components of a role
	------------------------------------------------------------------------
	*/

	public function deleteAllComponentOnRoleDML($role)
		{
			$sql=$this->getQueryContentWithParams('deleteAllComponentOnRoleDML',true,$role);
			$result= $this->db->fireSqlQuery($sql,'deleteAllComponentOnRoleDML');
			return $this->status($result);
		}

	/*

	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete
	------------------------------------------------------------------------
	*/

	public function deleteScreenCompListDML($data)
		{
			$sql=$this->getQueryContentWithParams('deleteScreenCompListDML',true,$data);
			$result= $this->db->fireSqlQuery($sql,'deleteScreenCompListDML');
			return $this->status($result);
		}

	/*

	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete
	------------------------------------------------------------------------
	*/

	public function deleteCompGroupCompInfoOngrpIdDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteCompGroupCompInfoOngrpIdDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteCompGroupCompInfoOngrpIdDML');
		return $this->status($result);
	}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete
	------------------------------------------------------------------------
	*/

	public function deleteCompGroupGrpIdDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteCompGroupGrpIdDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteCompGroupGrpIdDML');
		return $this->status($result);
	}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete
	------------------------------------------------------------------------
	*/

	public function deleteUserRoleOnUserIdInfoDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteUserRoleOnUserIdInfoDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteUserRoleOnUserIdInfoDML');
		return $this->status($result);
	}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete
	------------------------------------------------------------------------
	*/

	public function deleteRoleMenuOnRoleIdInfoDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteRoleMenuOnRoleIdInfoDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteRoleMenuOnRoleIdInfoDML');
		return $this->status($result);
	}

	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete all roles of component group
	------------------------------------------------------------------------
	*/

	public function deleteAllRoleOnCompGroupIdDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteAllRoleOnCompGroupIdDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteAllRoleOnCompGroupIdDML');
		return $this->status($result);
	}
	
	
	/*
	------------------------------------------------------------------------
	DML FUNCTION
	Function to delete finacial year information
	------------------------------------------------------------------------
	*/
	public function deleteFinYearInfoDML($data)
	{
		$sql=$this->getQueryContentWithParams('deleteFinYearInfoDML',true,$data);
		$result= $this->db->fireSqlQuery($sql,'deleteFinYearInfoDML');
		return $this->status($result);
	}




	//------------- D E L E T E      F U N C T I O N S      E N D S -------------------------

	/*-------------------  S E S S I O N     Q U E R Y -----------------------------------*/

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

	//------------------ H E L P E R     F U N C T I O N S------------------------------------------

	function status($result=null)
	{
		if($result) return 1;
		else return null;
	}

	function getQueryContentWithParams($sqlId=null,$params=false,$data=null)
	{
		$sql = $this->getQueryContent($sqlId);
		if($params==true){
			$params = $this->getQueryParams($sqlId);
			return $this->bindSqlParams($sql,$params,$data);}
		else return $sql;
	}


}
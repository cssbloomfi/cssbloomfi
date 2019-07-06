<?php
require_once "Zend/Db.php";

class Bloomfi_SqlUtil extends Bloomfi_App_Ulibrary
{
	protected $filelogger;
	protected $result;
	protected $session;

	public function __construct()
	{
		$this->db = Zend_Registry::get('dbConnection');
		$this->filelogger = Zend_Registry::get('fileLogger');
	}

	public function fireFastSqlQuery($sql)
	{
		return $this->db->query($sql);
	}

	public function fireFastSqlQueryFetchObject($sql)
	{
		return $this->db->query($sql)->fetchObject();
	}

	public function fireFastSqlFetchAll($sql)
	{
		return $this->db->fetchAll($sql);
	}

	public function fireSqlForException($sql,$name='Function')
	{
		try {
			$this->firstLogSection($name,$sql);
			$result['result'] = $this->db->query($sql);
			$this->secondLogSection($name);
			return $result;
		}
		catch (Exception $e) {
			$result['result']=null;
			$result['exception']=$e->getMessage();
			$this->thirdLogSection($name,$result['exception']);
			return $result;
		}
	}

	public function fireSqlQuery($sql,$name='Function')
	{
		try {
			$this->firstLogSection($name,$sql);
			$this->result = $this->db->query($sql);
			$this->secondLogSection($name);
			return $this->result;
		}catch (Exception $e){
			$this->thirdLogSection($name,$e->getMessage());
		}
	}

	public function fireSqlQueryFetchObject($sql,$name='Function')
	{
		try {
			$this->firstLogSection($name,$sql);
			$this->result = $this->db->query($sql)->fetchObject();
			$this->secondLogSection($name);
			return $this->result;
		}catch (Exception $e){
			$this->thirdLogSection($name,$e->getMessage());
		}
	}

	public function fireSqlFetchAll($sql,$name='Function')
	{
		try {
			$this->firstLogSection($name,$sql);
			$this->result = $this->db->fetchAll($sql);
			$this->secondLogSection($name);
			return $this->result;
		}catch (Exception $e){
			$this->thirdLogSection($name,$e->getMessage());
		}
	}

	public function fireSqlfetchAssoc($sql,$name='Function')
	{
		try {
			$this->firstLogSection($name,$sql);
			$this->result = $this->db->fetchAssoc($sql);
			$this->secondLogSection($name);
			return $this->result;
		}catch(Exception $e){
			$this->thirdLogSection($name,$e->getMessage());
		}
	}

	private function firstLogSection($name,$sql)
	{
		$this->filelogger->info("<[$name] SQL(query for exception) 'Execution Started'>");
		$this->filelogger->info("$sql");
	}

	private function secondLogSection($name)
	{
		$this->filelogger->info("<[$name] SQL(query for exception) 'executed successfully'> ");
	}

	private function thirdLogSection($name,$exception)
	{
		$this->filelogger->log("<[$name] SQL (Error) >".$exception,Zend_Log::CRIT);
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
		return $this->fireFastSqlQuery("SAVEPOINT $savePoint");
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function RollbackTransaction($savePoint)
	{
		return $this->fireFastSqlQuery("ROLLBACK TO SAVEPOINT $savePoint");
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function startTransaction()
	{
		return $this->fireFastSqlQuery("START TRANSACTION");
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function flushTable()
	{
		return $this->db->fireFastSqlQuery("FLUSH TABLE");
	}


	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function commitTransaction()
	{
		return $this->fireFastSqlQuery("COMMIT");
	}
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function isLock($string)
	{
		return $this->fireFastSqlQuery("SELECT IS_FREE_LOCK('$string') 'LOCK'",'isLock')->fetchObject()->LOCK;
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLock($string,$time=300)
    {
		return $this->fireFastSqlQuery("SELECT GET_LOCK('$string',$time) 'LOCK'",'getLock');
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function releaseLock($string)
	{
		return $this->fireFastSqlQuery("SELECT RELEASE_LOCK('$string') 'LOCK'",'releaseLock');
	}
	
	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function
		------------------------------------------------------------------------
	*/
	public  function getLastInsertedId()
	{
		return $this->fireFastSqlQuery("SELECT LAST_INSERT_ID() AS ID")->fetchObject();
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



}


?>
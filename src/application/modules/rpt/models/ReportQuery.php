<?php

require_once "Zend/Db.php";
class ReportQuery {

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to print the content of query library
		------------------------------------------------------------------------
	*/
	public static function printQueryLibrary()
    {
        
      $self = new ReportQuery();
	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
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
	public static function getQueryContent($queryid)
    {
      $self = new ReportQuery();
	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
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
	public static function getQueryTitle($queryid)
    {
      $self = new ReportQuery();
	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
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
		Function to get the DB connection
		------------------------------------------------------------------------
	*/
	public static function getDbConnection()
    {
		$registry = Zend_Registry::getInstance();
		$config= $registry->get("configuration");
		$db = Zend_Db::factory($config->db);
		$db->setFetchMode(Zend_Db::FETCH_OBJ);

		return $db;

	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return
		------------------------------------------------------------------------
	*/
	public static function getCustomerWiseInvestReturn()
    {
        
        $self = new ReportQuery();   
		$sql  = $self->getQueryContent('CustomerWiseBsdQuery');
		$db   = $self->getDbConnection();
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getCustomerWiseInvestReturnWithConn($db)
    {
        /*$self = new ReportQuery();*/     
		$sql  = self::getQueryContent('CustomerWiseBsdQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return
		------------------------------------------------------------------------
	*/
	public static function getEmployeeWiseInvestReturn()
    {
        $self = new ReportQuery();   
		$sql  = $self->getQueryContent('EmployeeWiseBsdQuery');
		$db   = $self->getDbConnection();
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getEmployeeWiseInvestReturnWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('EmployeeWiseBsdQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of scheme wise report
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getProjectBasedCollectionQueryWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('ProjectBasedCollectionQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getCustomerTypeBsdQueryWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('CustomerTypeBsdQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getDateWiseBsdQueryWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('DateWiseBsdQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getAmountDistributionBsdQueryWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('AmountDistributionBsdQuery');
		return $db->fetchAll($sql);
	}

	/*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the result of customer wise invest return 
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getEmployeeWiseAmountDistributionBsdQueryWithConn($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('EmployeeWiseAmountDistributionBsdQuery');
		return $db->fetchAll($sql);
	}

    /*
		------------------------------------------------------------------------
	    QUERY SPECIFIC FUNCTION
		Function to get the list of customer
		with external DB connection
		------------------------------------------------------------------------
	*/
	public static function getCustomerFullQuery($db)
    {
        $self = new ReportQuery();        
		$sql  = $self->getQueryContent('CustomerFullQuery');
		return $db->fetchAll($sql);
	}

}

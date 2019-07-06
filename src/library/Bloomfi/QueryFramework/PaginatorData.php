<?php

class Bloomfi_QueryFramework_PaginatorData extends Bloomfi_SqlUtil
{
	protected $_result=null;
	protected $_paginator=null;
	protected $_totalPages=9; // default number of pages
	protected $_rows=20; // default number of rows per pages

	/*
		Description: A function to fetch the from database and to create a result table with pagination
		@object (class object): A instance of a data model
		@fuction (string): A function of @object
		@params (array): Parameters of function @function
		@page (integer): Selected page from pagination
		@totalPages (integer): Total pages for pagination
		@rows (integer): Total rows per page
	*/

    public function getResultForPagination(&$object,$function,$params=null,$page=1,$totalPages=null,$rows=null)
	{
		 if(!$totalPages) $totalPages=$this->_totalPages;
		 if(!$rows) $rows=$this->_rows;
		 $fetchParams = $this->setFetchParams($params,$page,$totalPages,$rows);
		// print_r($fetchParams);
		 $this->_result=$object->$function($fetchParams);
		 $this->getPaginatorData($page);
		 if($this->_paginator)
			return $this->_paginator;
	}

	/*
		Description: A function to fetch the from database and to create a result table with pagination
		@object (class object): A instance of a data model
		@fuction (string): A function of @object
		@params (array): Parameters of function @function
		@page (integer): Selected page from pagination
		@totalPages (integer): Total pages for pagination
		@rows (integer): Total rows per page
	*/
	public function getXmlResultForPagination(&$sql,$paramStrings,$params=null,$page=1)
	{
		if($params)
			$sql=$this->bindSqlParams($sql,$paramStrings,$params,true);
		$this->_result=$this->fireSqlFetchAll($sql,'getXmlResultForPagination');
		$this->getPaginatorData($page);
		if($this->_paginator)
			return $this->_paginator;
	}

	public function setFetchParams($params,$page,$totalPages,$rows)
	{
		Bloomfi_Paginator::initializePaginator($totalPages, $rows);
		 $pagination_limits=Bloomfi_Paginator::getRowLimitsForPagination($page);
		 if($params && is_array($params)){
			$fetchParams = array_merge((array)$params,(array)$pagination_limits);
		 }
		 else $fetchParams = $pagination_limits; 
		 return $fetchParams;
	}

	public function getPaginatorData($page)
	{
		if($this->_result) {
			$count=count($this->_result);
			$this->_paginator = Bloomfi_Paginator::factory($this->_result,$page,$count);
		 }	
	}



}
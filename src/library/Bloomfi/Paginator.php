<?php
require_once 'Zend/Paginator.php';

class Bloomfi_Paginator  
{
	protected static $_rows=0;
	protected static $_totalPagesForPagination=10;
	protected static $_rowsForPagination=20;
	protected static $_lowerLimit=0;
	protected static $_totalRows=0;

	public static function initializePaginator($totalPages=10,$rows=20)
	{
		self::$_rows = $rows;
		self::$_totalPagesForPagination=$totalPages;
		self::$_rowsForPagination=$totalPages*$rows;
		self::$_lowerLimit=0;
		self::$_totalRows=0;
	}

	public static function getRowLimitsForPagination($page=1)
	{
		self::$_lowerLimit = ($page * self::$_rows) - self::$_rows;
		$pagination_limits=array(self::$_lowerLimit,self::$_rowsForPagination);
		return $pagination_limits;
	}

	public static function factory ( $data=null,$selectedPage=1,$count=0)
	{
		$data_set=null;
		self::$_totalRows=self::$_lowerLimit+$count;
		$paginator = Zend_Paginator::factory(self::$_totalRows);
		$paginator->setItemCountPerPage(self::$_rows);
		$paginator->setCurrentPageNumber($selectedPage);
		$paginator->setPageRange(self::$_totalPagesForPagination);
		$i=self::$_rows;
		foreach($data as $key=>$value){
			if($i>0) {
				$data_set[$key]=$value;
				$i--;}
			else break;
		}
		$pagination['data'] =$data_set;
		$pagination['paginator'] = $paginator;
		return $pagination;
	}

	public static function getLastLowerStartLimit()
	{
		return self::$_lowerLimit;
	}
}
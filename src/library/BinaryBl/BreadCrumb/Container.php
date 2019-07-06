<?php
/*BreadCrumb Library writen by Smtiyiman barua */
class BinaryBl_BreadCrumb_Container extends BinaryBl_BreadCrumb_Models_AccessQuery
{

	protected $_data;

	function __construct()
	{
		parent::__construct();
		$max=$this->getMaxResourceIdQuery();
		for($i=0; $i<=$max ; $i++){
			$masterId=$this->getResourceMasterIdonIdQuery($i);
			if($masterId)
				$this->makeBraedCrumbData($masterId->RESOURCE_MASTER_ID);
		}
	}


	function getAllBreadCrumbPath()
	{
		return $this->_data;
	}

	function makeBraedCrumbData($id)
	{
		$result=$this->getResourceByParentIdQuery($id);
		$arr=null;
		foreach( $result as $row ){
			$newarr=$newarrurl=array();
			$arr['ID']=$row->ID;
			$arr['MODULE']=$row->MODULE_ID;
			$arr['CONTROLLER']=$row->RESOURCE_ID;
			$arr['ACTION']=$row->MENU_ID;
			$arr['PARENT_ACTION']=$row->PARENT_ACTION_ID;
			$pid=$row->RESOURCE_MASTER_PARENT_ID;
			array_push($newarr,$row->RESOURCE_NAME);
			array_push($newarrurl,$row->RESOURCE_URL);
			$this->getBreadCrumbPath($newarr,$newarrurl,$pid);
			$newarr=array_reverse($newarr);
			$newarrurl=array_reverse($newarrurl);
			$arr['PATH']=$newarr;
			$arr['URL']=$newarrurl;
			$this->_data[$row->ID]=$arr;
		}		
	}

	function getBreadCrumbPath(&$newarr,&$newarrurl,$id)
	{
		$result=$this->getResourceByIdQuery($id);
		foreach( $result as $row ){
			array_push($newarr,$row->RESOURCE_NAME);
			array_push($newarrurl,$row->RESOURCE_URL);
			$this->getBreadCrumbPath($newarr,$newarrurl,$row->RESOURCE_MASTER_PARENT_ID);
		}
	}

}
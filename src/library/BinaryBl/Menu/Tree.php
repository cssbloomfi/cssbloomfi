<?php
class BinaryBl_Menu_Tree extends Bloomfi_App_Ulibrary
{
	protected $_model;
	protected $_treemenu;
	protected $_count=0;
	protected $_menu;

	public function buildMenu($menu)
	{
		$this->_treemenu=$menu;

		foreach($this->_treemenu as $val)
		{
			$val=$this->objectToArray($val);
			if(!empty($val) && $val['RESOURCE_MASTER_PARENT_ID']=='0')
			{
				$this->_menu[$this->_count]['RESOURCE'] = $val['RESOURCE_NAME'];
				$this->_menu[$this->_count]['URL'] = $val['RESOURCE_URL'];
				$this->_menu[$this->_count]['RESOURCE_ID'] = $val['RESOURCE_MASTER_ID'];
				$id = $val['RESOURCE_MASTER_ID'];
				$this->subMenu($this->_menu[$this->_count]['CHILD'],$id);
				$this->_count++;	
			}			
		}
		return $this->_menu;

	} 

	private function subMenu(&$arr,$id)
	{
		foreach($this->_treemenu as $val2)
		{
			$val2=$this->objectToArray($val2);
			if($val2['RESOURCE_MASTER_PARENT_ID']==$id)
			{
				$arr[$val2['ID']]['RESOURCE']=$val2['RESOURCE_NAME'];
				$arr[$val2['ID']]['URL']=$val2['RESOURCE_URL'];
				$arr[$val2['ID']]['RESOURCE_ID']=$val2['RESOURCE_MASTER_ID'];
				$pid=$val2['RESOURCE_MASTER_ID'];
				$this->subMenu($arr[$val2['ID']]['CHILD'],$pid);
			}
		}
	}
}
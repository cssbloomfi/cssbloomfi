<?php
class modules_com_library_loader_compLoader
{
	protected $_model=null;

	function __construct()
	{
		$this->_model=new AccessQuery;
		$this->_session=Zend_Registry::get('SQL');
	}

	function load($data=null)
	{
		$screenId=$data['module'];
		$position=$data['position'];
		$component=$parameters=null;
		$roleId=$this->_session->roleId;
		$componentList=$this->_model->getChartComponentOfScreenId(array($roleId,$screenId,$position));
		if($componentList){
			$i=0;
			$component['screenId']=$screenId.'-'.$position;
			//$component['screenPos']=$position;
			foreach($componentList as $list){
				$compRoleId=$list->ACCESS_ROLE_ID;
				if($roleId==$compRoleId){
					$component[$i]['name']=$list->COMP_SCREEN_NAME;
					if(isset($list->COMP_GROUP_ID) && isset($list->COMP_NAME)) {
						$section=$list->COMP_GROUP_ID;
						$comp=$list->COMP_NAME;
						$modelName='modules_com_'.$section.'_'.$comp;
						$component[$i]['model']=$modelName;
						$component[$i]['method']=$comp; }
					$component[$i]['type']=$list->RESOURCE_TYPE;
					if(isset($list->PARAMETERS)){
						$params=$list->PARAMETERS;
						$dbParamList=explode(',',$params);
						$j=0;
						foreach($dbParamList as $arr){
							$arrP=explode('=>',$arr);
							if(isset($arrP[0])) {
								if(isset($arrP[1])){
								$key=$arrP[0];
								$parameters[$key]=$arrP[1];}
							}else $parameters['_default']=null;	}
						if(isset($data['width']))$component[$i]['params']['width']=$data['width'];
						$component[$i]['params']=$parameters; }
					if(isset($list->MODULE_CONTROLLER) && isset($list->ACTION)){
						$component[$i]['path']=$list->MODULE_CONTROLLER.'/'.$list->ACTION;
					}
					$i++;
					unset($modelName);
				}
			}
		}
		return $component;
	}
}
?>
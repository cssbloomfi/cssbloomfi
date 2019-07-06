<?php
class modules_com_reference_totalCustSchmCollLoc
extends modules_com_reference_AbstractReferenceComponent
{

	public function __construct()
	{
		 parent::__construct();
	}

	public function getTotalCustSchmCollLoc()
	{
		$result1=$this->_refModel->getTotalCustQuery();
		$result2=$this->_refModel->getTotalSchmQuery();
		$result3=$this->_refModel->getTotalCollQuery();
		$result4=$this->_refModel->getTotalLocQuery();
		$comp['component']=array('result1'=>$result1,'result2'=>$result2,'result3'=>$result3,'result4'=>$result4);
		$comp['title']=null;
		return $comp;
	}

	public function destroy()
	{
		unset($this->_refModel,$this->_chartModel);
	}

}
<?php

class modules_com_Reference_AbstractReferenceComponent
{
	protected $_refModel;

	public function __construct()
	{
		$this->_refModel= new modules_com_reference_models_query;
	}

}
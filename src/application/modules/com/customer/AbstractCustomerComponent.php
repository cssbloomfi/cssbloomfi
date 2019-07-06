<?php

class modules_com_customer_AbstractCustomerComponent
{
	protected $_custModel;
	protected $_chartModel;
	protected $_session;

	public function __construct()
	{
		$this->_session=Zend_Registry::get('SQL');
		$classPrefix='modules_com_library_chart_'. $this->_session->chart['activeChart'].'_';
		$renderClass=$classPrefix.'renderchart';
		$xmlRenderClass=$classPrefix.'fusionChart_XmlGenerator';
		$this->_custModel= new modules_com_customer_models_query;
		$this->_chartModel=new $renderClass;
		$this->_XmlGenerator=new $xmlRenderClass;
	}

}
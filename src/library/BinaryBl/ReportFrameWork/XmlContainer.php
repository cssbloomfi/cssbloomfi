<?php

class BinaryBl_ReportFrameWork_XmlContainer extends Bloomfi_App_Ulibrary
{
	protected $_xmlTitle=null;
	protected $_xmlData=null;
	protected $_xpathValue=null;
	protected $_xpathRoots=null;
	protected $_xmlCriteriaData=null;
	protected $_xmlResultData=null;
	protected $_xpathFormRoots=null;
	protected $_xpathResultRoots=null;
	protected $_xpathResultValue=null;
	protected $_tableClass=null;

	//TODO : Comment
	public function __construct($data)
	{
		$this->setAllXmlContent($data);
		$this->autoloadXpathFromIni();
	}

	//TODO : Comment
	public function setNullXpathValues()
	{
		$this->_xpathValue=null;
	}

	//TODO : Comment
	public function autoloadXpathFromIni()
	{
		$this->setNullXpathValues();
		$path=ROOT_DIR."/library/BinaryBl/ReportFrameWork/Xpath.ini";
		$this->_xpathRoots=$this->getIniParameters($path,'xpathRoots','xpath');
		$this->_xmlTitle=$this->_xmlData->xpath($this->_xpathRoots['title']->root);
		$this->_xmlCriteriaData=$this->_xmlData->xpath($this->_xpathRoots['criteria']->root);
		$this->_xmlResultData=$this->_xmlData->xpath($this->_xpathRoots['result']->root);
		$this->loadValueResultXpath();
	}

	//TODO : Comment
	public function loadXmlFormValue(&$data)
	{
		$this->setNullXpathValues();
		$this->loadValueFromXpath($data);
	}

	//TODO : Comment
	public function loadXmlDefaultSqlValue(&$data)
	{
		$this->setNullXpathValues();
		$this->loadDefaultSqlValue($data);
	}

	//TODO : Comment
	public function loadValueResultXpath()
	{
		foreach($this->_xpathRoots['result'] as $key => $path)
		{
			$value=null;
			$newpath=$this->extractXpathFromXpath($this->_xpathRoots['result']->$key,  $this->_xpathRoots['result']->root);
			if($newpath) {
				$value=$this->_xmlResultData[0]->xpath($newpath);
			if($value)
				$this->_xpathResultValue[$key]=$value[0];
			}
		}
	}

	//TODO : Comment
	public function loadValueFromXpath(&$data)
	{
		foreach($this->_xpathRoots['criteria'] as $key => $path)
		{
			$value=null;
			$newpath=$this->extractXpathFromXpath($this->_xpathRoots['criteria']->$key,  $this->_xpathRoots['criteria']->searchitem);
			if($newpath)
			$value=$data->xpath($newpath);
			if($value){
			$this->_xpathValue[$key]=$value[0];
			}
		}
	}

	//TODO : Comment
	public function loadDefaultSqlValue(&$data)
	{
		foreach($this->_xpathRoots['result'] as $key => $path)
		{
			$value=null;
			$newpath=$this->extractXpathFromXpath($this->_xpathRoots['result']->$key,  $this->_xpathRoots['result']->defaultfilter);
			if($newpath)
			$value=$data->xpath($newpath);
			if($value){
			$this->_xpathValue[$key]=$value[0];
			}
		}
	}

	//TODO : Comment
	public function extractXpathFromXpath($mainXpath=null,$removeXpath=null)
	{
		$path1=explode('/',$mainXpath);
		$path2=explode('/',$removeXpath);
		$newPath=array_diff($path1,$path2);
		$newPath=join('/',$newPath);
		return $newPath;
	}

	//TODO : Comment
	public function setAllXmlContent($data)
	{
		$this->_xmlData=$data;
	}

	//TODO : Comment
	public function getAllXmlContent()
	{
		return $this->_xmlData;
	}

	public function getXmlTitle()
	{
		return $this->_xmlTitle[0];
	}

}
<?php
/*
Class						: BinaryBl_XmlSqlBuilder
Date						: 31.8.2010
Purpose						: Read The XML Data and Dynamiclly construct SQL Statement
Author						: Santojit Ghosh, Smritiman Barua
Default join				: AND 
Default condition			: EQUAL
Default datatype			: CHAR
Default orderby type		: ASC
Tag params case sensitive	: False

XML DATA PATTERN ===========================================================

---------------------- Tag & Params -------------------------------------
Tag: <query>		Param	: id  (strict)
Tag: <queryparam>	Params	: join, condition, datatype (strict)
Tag: <orderby>		Params	: type (strict)

strict tags : <query>, <content>, <queryparams>, <queryparam>, <orderby>, <limit>, <start>, <rows>
----------------------------------------------------------------------------

 <query id = "SQL_ID" > 
		 <title> Title of sql </title>  \\---------TITLE SECTION----------

		 <content>  \\------------------------------SQL SECTION----------
			SELECT * FROM Table_Name
		 </content>

		 <queryparams> \\------------------------------CONDITION SECTION----------
				<queryparam condition='ISNULL' datatype='INTEGER'> COLUMN_NAME_1 </queryparam>
				<group>
					<queryparam condition='BETWEEN' datatype='INTEGER'> COLUMN_NAME_2 </queryparam>
					<queryparam join='OR' condition='NOTEQUAL'> COLUMN_NAME_3 </queryparam>
				</group>
		 </queryparams>

		 <orderby> \\------------------------------ORDER BY SECTION----------
			<group type="ASC"> 
				<item> COLUMN_NAME_1 </item>
				<item> COLUMN_NAME_2 </item>
			</groupitem>
			<group type="DESC"> 
				<item> COLUMN_NAME_3 </item>
			</group>
		 </orderby>

		 <limit>  \\------------------------------LIMIT SECTION----------
			<start> VALUE_1 </start>
			<rows> VALUE_2 </rows>
		 </limit>
</query>
=======================================================================================
*/

class BinaryBl_XmlSqlBuilder extends Bloomfi_App_Ulibrary
{
	protected $_xmlFile=null;
	protected $_counter=0;
	protected $_equal='EQUAL';	
	protected $_notEqual='NOTEQUAL';	
	protected $_like='LIKE';	
	protected $_notLike='NOTLIKE';	
	protected $_greater='GREATER';	
	protected $_greaterEqual='GREATEREQUAL';	
	protected $_less='LESS';	
	protected $_lessEqual='LESSEQUAL';		
	protected $_between='BETWEEN';
	protected $_charType='CHAR';
	protected $_intType='INTEGER';
	protected $_andJoin='AND';
	protected $_orJoin='OR';
	protected $_ascOrder="ASC"; 
	protected $_descOrder="DESC"; 
	
	//Constructor to set XML file path
	function __construct($file=null)
	{
		$this->_xmlFile=$file;
	}

	//Sets the XML file path to read the XML data
	protected function _setXmlFilePath($file=null)
	{
		$this->_xmlFile=$file;
	}

	//Function to get the of query data on the basis on ID
	protected  function _getXMLDataById($queryid,$xmlPath=null)
    {
		if(!$xmlPath) $xmlPath=$this->_xmlFile;
		$querylibrary = simplexml_load_file($xmlPath);
		foreach ($querylibrary->query as $query) {
			if ( $query['id'] == $queryid )
				return $query; }
		return null;
	}

	// Read and Construct SQL statement from XML Data
	protected function _readSql($xmlData,$values,$limit=false,$both=false)
	{
		$this->_counter=0;
		$sql=$limitCondition=$startCondition=$rows=$orderByXml=$orderByCondition=
		$limitXml=null;
		$content=$xmlData->xpath('content');
		$qparams=$xmlData->xpath('queryparams');
		$orderByXml=$xmlData->xpath('orderby');
		$limitXml=$xmlData->xpath('limit');
		foreach($qparams as $param)
			$this->_getSqlCondition($param,$sql,$values);
		$sql= $content[0].$sql;
		if($limit==true) {
			$totalValues=count($values);
			if($both==true) {
				$start=$values[$totalValues-2];
				$startCondition=" $start,"; }
			$rows=$values[$totalValues-1];
			$limitCondition=" LIMIT ".$startCondition.$rows;  }
		if($limit==false) 
			if($limitXml)
				$limitCondition=$this->_getLimitSql($limitXml); 
		if($orderByXml)
			$orderByCondition=$this->_getOrderBySql($orderByXml);
		return $sql.$orderByCondition.$limitCondition;
	}

	//Rerurn SQL condition after constructing LMIT SQL condition from XML Data
	protected function _getlimitSql($data)
	{
		$limitCondition=$start=$rows=null;
		if($data[0]->start)
			$start=$data[0]->start.", ";
		if($data[0]->rows)
			return ' LIMIT '.$start.$data[0]->rows;
		return null;
	}

	//Rerurn SQL condition after constructing OREDER BY  SQL condition from XML Data
	protected function _getOrderBySql($data)
	{
		$this->clearPattern();
		$this->setPattern();
		$this->preAddToStringDirect(" ORDER BY ");
		foreach($data as $params)
			foreach($params as $param) {
				$type=$this->_ascOrder;
			    if( isset($param['type']) )
					$type=$param['type'];
				if($type!=$this->_ascOrder && $type!=$this->_descOrder)
					die("Please use ASC/DESE in xml sql condition as a order by type.<br>");
				foreach($param as $item) 
					 $this->insertDataToPattern($item);
				$this->postAddToStringDirect(" ".$type." ");
			}
		return $this->getPatternString();
	}

	//Rerurn SQL condition after constructing the SQL condition from XML Data
	protected function _getSqlCondition($param,&$sql,$values)
	{
		foreach($param as $data) {
			if(isset($data->queryparam)) {
				$j=0;
				foreach($data as $val) {
				 if($values[$this->_counter] && !empty($values[$this->_counter])){
					$sql=$sql.$this->_constructSQLCondition($val,$values,$j);
					$j++; }
				 $this->_counter++; }
				$sql=$sql." ) "; }
			else  {
				if($values[$this->_counter] && !empty($values[$this->_counter]))
					 $sql=$sql.$this->_constructSQLCondition($data,$values,1);
				$this->_counter++;  }
		}
	}

	//Construct the SQL condition from XML Data
	function _constructSQLCondition($data,$values,$j=null)
	{
		$status=false; 
		$bracketOpen=$exsepVal=$sql=null;
		if($j==0) $bracketOpen='( ';
		$type=$this->_charType; // Default column type 'Character'
		$join=$this->_andJoin; // Default column join type 'AND'
		$condition=$this->_equal; // Default condition type 'EQUAL'
		$column=$data;
		if(isset($data['datatype'])) $type=strtoupper($data['datatype']);
		if(isset($data['join'])) $join=strtoupper($data['join']);
		if(isset($data['condition'])) $condition=strtoupper($data['condition']);
		if($type!=$this->_intType && $type!=$this->_charType )
			die("Please use CHAR/INTEGER in xml sql condition as a datatype.<br>");
		if($join!=$this->_andJoin && $join!=$this->_orJoin )
			die("Please use AND/OR in xml sql condition as a join type.<br>");
	//	if(isset($data['wildcard']))
	//		$wildcard=strtoupper($data['wildcard']);
		if($condition==$this->_between)
			$exsepVal=$values[$this->_counter++];
		$value=$values[$this->_counter];
		if($type==$this->_charType) {
			$value="'$value'";
			if($exsepVal) $exsepVal="'$exsepVal'"; }
		$val="$value";
		$status=$this->_checkAsterix($val);
		if($status==true){
			if($condition==$this->_equal) $condition=$this->_like;
			elseif($condition==$this->_notEqual) $condition=$this->_notLike;
			$value=str_replace('*','%',$value); }
		if($exsepVal){ 
			$val="'$exsepVal'";
			$status=$this->_checkAsterix($val);
			if($status==true) $value=str_replace('*','%',$exsepVal);
			$exsepVal=$exsepVal." AND ";
		}
		$this->_decodeCondition($condition);
		$sql = " ".$join." ".$bracketOpen.$column." ".$condition." ".$exsepVal.$value; 
		return $sql;
	}

	//Check for a asterix in a string
	function _checkAsterix($value)
	{
		$status=false;
		$count=strlen($value);
		for($i=0;$i<$count;$i++){
			if($value[$i]=='*'){
				$status=true;
				break; }}
		return $status;
	}

	//Decodes the encoded condition string
	function _decodeCondition(&$condition)
	{
		if($condition==$this->_equal) $condition="=";
		elseif($condition==$this->_notEqual) $condition="<>";
		elseif($condition==$this->_like) $condition="LIKE";
		elseif($condition==$this->_notLike) $condition="NOT LIKE";
		elseif($condition==$this->_greater) $condition=">";
		elseif($condition==$this->_greaterEqual) $condition=">=";
		elseif($condition==$this->_less) $condition="<";
		elseif($condition==$this->_lessEqual) $condition="<=";
		elseif($condition==$this->_between) $condition="BETWEEN";
	}

}
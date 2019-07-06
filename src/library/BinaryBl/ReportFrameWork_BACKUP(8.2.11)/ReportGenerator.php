<?php

class BinaryBl_ReportFrameWork_ReportGenerator extends  BinaryBl_ReportFrameWork_XmlContainer
{
	protected $_formSet=null;
	protected $_elementLabelSet=null;
	protected $_formTable=null;
	protected $_searchParamList=array();
	protected $_searchParamFilterList=array();
	protected $_searchParamValueFilterList=array();
	protected $_searchFieldParamList=array();
	protected $_sqlParams=array();
	protected $_db=null;
	protected $_columnsPerRow=1;
	protected $_defaultTotalRows=20;
	protected $_formValues=array();
	protected $_defaultPages=20;
	protected $_start=null;
	protected $_rows=100;
	protected $_conditionCount=null;
	protected $_fetchLimitValue=null;
	protected $_orderByCondition=null;
	protected $_resultSql=null;
	protected $_filelogger;
	protected $_defaultTableClass="zebra";
	protected $_sqlSearchCondition=null;
	protected $_sqlSearchConditionVar=array();
	protected $_formatterBaseLocation='application/modules/';
	protected $_formatterClassModule='modules_';

	public function __construct($data)
	{
		$this->_db=new Bloomfi_SqlUtil;
		$this->_filelogger = Zend_Registry::get('fileLogger');
		parent::__construct($data);
		$this->createForm();
	}

	//Function to print log information for each function call
	public function functionCallLog($string)
	{
		$this->_filelogger->info("[ReportGenerator] Function $string");
	}

	//Function reads the total elements and generates the search table
	public function createFormTable()
	{
		$tableClass=null;
		$this->functionCallLog('createFormTable');
		//checks for elements existance
		if($this->_formSet){
		$form_elements=null;
		if($this->_tableClass){
			if($this->_tableClass!='Not Required') $tableClass='CLASS="'.$this->_tableClass.'"';
		}
		else $tableClass='CLASS="'.$this->_defaultTableClass.'"';
		$form_start='<FORM NAME="TEST" METHOD="POST"><INPUT TYPE="HIDDEN" NAME="REQUEST" VALUE="search"><TABLE '.$tableClass.'>';
		$form_end='</TABLE></FORM>';
		//divides the main array to sub arrays
		$elements=array_chunk($this->_formSet,$this->_columnsPerRow);
		//inserts the element to row column of a table
		foreach($elements as $element){
			if(!is_array($element)){
			$form_elements=$form_elements."<TR><TD><B> ".$element['label']."</B></TD><TD>".$element['element']."</TD></TR>";}
			else{
			  $form_elements=$form_elements."<TR>";
			  foreach($element as $elemnt)
				$form_elements= $form_elements."<TD><B>".$elemnt['label']."</B></TD><TD>".$elemnt['element']."</TD>";
			  $form_elements=$form_elements."</TR>";
			}}
		//constructs the total form
		$this->_formTable=$form_start.$form_elements.$form_end;
		}
	}


	//Function to construct Html form elements from XML file
	public function createForm()
	{
		$this->_conditionCount=$paramNo=1;
		$this->functionCallLog('createForm');
		foreach($this->_xmlCriteriaData as $searchdata){
		foreach($searchdata as $data){
			foreach($data as $set){
			 $this->loadXmlFormValue($set);
			$element=$elementLabel=null;
			//print_r($this->_xpathValue);
			//checks the element weither visible or not
			if((strtoupper($this->_xpathValue['isdisplay']) == 'Y') || (strtoupper($this->_xpathValue['isdisplay']) == 'YES')){
				$type=$this->_xpathValue['displaytype'];
				//checks the element weither a search element or not
				if(isset($this->_xpathValue['searchparam']))
				if((strtoupper($this->_xpathValue['searchparam']) == 'Y') || (strtoupper($this->_xpathValue['searchparam']) == 'YES')){
					$param=':param'.$paramNo++;
					$this->_searchFieldParamList=array_merge($this->_searchFieldParamList,array((string)$this->_xpathValue['name']=>$param));
					array_push($this->_searchParamList,$this->_xpathValue['name']);
					if(isset($this->_xpathValue['columnfilter'])){
						$this->_searchParamFilterList=array_merge($this->_searchParamFilterList,array((string)$this->_xpathValue['dbtblcolumn']=>(string)$this->_xpathValue['columnfilter']));
					//	print_r($this->_searchParamFilterList);
					}
					if(isset($this->_xpathValue['valuefilter'])){
						//print_r($this->_xpathValue['valuefilter']);
						$this->_searchParamValueFilterList=array_merge($this->_searchParamValueFilterList,array((string)$this->_xpathValue['name']=>(string)$this->_xpathValue['valuefilter']));
					//	print_r($this->_searchParamValueFilterList);
					}
					if(isset($this->_xpathValue['elementlabel']))
						$elementLabel=$this->_xpathValue['elementlabel'];
				}

				$bundle=$this->_createSqlSearchBundle();
				//generates the form element
				$element['element']=$this->selectAndCreateElement($type);
				if(isset($this->_xpathValue['elementlabel']))
					$element['label']=$this->_xpathValue['elementlabel'];
				else $element['label']='';
				if($element){
				$i=0;
				while($i>=0){
					//arranges the element based on order field. overridig of array key avoided
					if(!isset($this->_formSet[(string)$set->order+$i])){
						$this->_formSet[(string)$set->order+$i]=$element;
						$i=-1;}
					else $i++;
				}}
				if($elementLabel){
				$i=0;
				while($i>=0){
					//arranges the element based on order field. overridig of array key avoided
					if(!isset($this->_elementLabelSet[(string)$set->order+$i])){
						$this->_elementLabelSet[(string)$set->order+$i]=$elementLabel;
						$i=-1;}
					else $i++;
				}}
			}
		}}}

		//print_r($this->_searchParamValueFilterList);
		//die;
		if($this->_formSet)
			ksort($this->_formSet);
		if($this->_elementLabelSet)
			ksort($this->_elementLabelSet);
	}

	public function getTableFormatInfo()
	{
		if(isset($this->_xpathResultValue['tableformat']))
			return $this->_xpathResultValue['tableformat'];
		else return $this->_xpathResultValue['tableheader'];
	}

	public function getTableFormatValueInfo()
	{
		return $this->_xpathResultValue['queryheader'];
	}

	public function getWindowData()
	{
		if(isset($this->_xpathResultValue['window']))
			return $this->_xpathResultValue['window'];
	}

	public function isTableSetExternal()
	{
		$this->functionCallLog('isTableSetExternal');
		$this->_formatterBaseLocation=ROOT_DIR.'/'.$this->_formatterBaseLocation;
	//	print_r($this->_xpathResultValue);
		if(isset($this->_xpathResultValue['externalTableFormat'])){
				if((strtoupper($this->_xpathResultValue['externalTableFormat']) == 'Y') || (strtoupper($this->_xpathResultValue['externalTableFormat']) == 'YES')){
			if(isset($this->_xpathResultValue['tableClass']))
				$this->_tableClass=$this->_xpathResultValue['tableClass'];
			else $this->_tableClass='Not Required';
			$url=new ZendExtend_Url;
			$appUrlLevel=$url->getAppUrlLevel();
			$formatter['location']=$this->_formatterBaseLocation.$appUrlLevel['module'].'/formatter/'. $appUrlLevel['controller'].'ReportTableFormat.php';
			if(is_file($formatter['location'])){
			$formatter['class']=$this->_formatterClassModule.$appUrlLevel['module']. '_formatter_'.$appUrlLevel['controller'].'ReportTableFormat';
			$formatter['function']=$appUrlLevel['controller'];
			return $formatter;
			}else return null;
		}}
	}

	public function getActiveFormLabels()
	{
		//print_r($this->_elementLabelSet);
		return $this->_elementLabelSet;
	}


	public function getSumColumns()
	{
		//foreach($this->_xpathResultValue['queryheader'] as $param)
		if(isset($this->_xpathResultValue['sumrequired']))
			return $this->_xpathResultValue['sumrequired'];
	}


	// Function to construct xml sql variables
	protected function _createSqlSearchBundle()
	{
		$sepa=$paramNo=null;
		if(isset($this->_xpathValue['searchparam']))
				if((strtoupper($this->_xpathValue['searchparam']) == 'Y') || (strtoupper($this->_xpathValue['searchparam']) == 'YES'))
		$paramNo=count($this->_sqlSearchConditionVar);$paramNo++;
		if(isset($this->_xpathValue['dbtblcolumn']) && isset($this->_xpathValue['conditiontype'])) {{
				if($this->_xpathValue['datatype']=='CHAR') $sepa="'";
				$column=(string)$this->_xpathValue['dbtblcolumn'];
				$name=(string)$this->_xpathValue['name'];
				if(isset($this->_searchParamFilterList[$column])){
					$col='parent.'.$column;
					$col=str_replace('@COLUMN@', $col, $this->_searchParamFilterList[$column]);
					$str=" AND ".$col.' '.$this->_xpathValue['conditiontype']." ";}
				else $str=' AND parent.'.$this->_xpathValue['dbtblcolumn']." ".$this->_xpathValue['conditiontype']." ";
				if(isset($this->_searchParamValueFilterList[$name])){
					$searchFVal=$this->_searchParamValueFilterList[$name];
					$paramVar=':param'.$paramNo;
					$searchFVal=str_replace('@VALUE@',$paramVar,$searchFVal);
					foreach($this->_searchFieldParamList as $key => $value)
						$searchFVal=str_replace($key,$value,$searchFVal);
					$searchVariable=$searchFVal;
				}else $searchVariable=$sepa.':param'.$paramNo.$sepa;
				$str.=$searchVariable;
				$this->_sqlSearchCondition[$this->_conditionCount++]=$str;
				$this->functionCallLog('_createSqlSearchBundle(p) -> '.$str);
			}}
		if(isset($this->_xpathValue['searchparam']))
				if((strtoupper($this->_xpathValue['searchparam']) == 'Y') || (strtoupper($this->_xpathValue['searchparam']) == 'YES'))
		array_push($this->_sqlSearchConditionVar,':param'.$paramNo);
	}

	//Function to create xls export form
	public function getXlsExportForm($params)
	{
		$this->functionCallLog('getXlsExportForm');

		$form='<FORM NAME="exportForm" METHOD="POST"><INPUT TYPE="hidden" NAME="REQUEST" VALUE="export" />';
			$this->clearPattern();
			$this->setPattern(null,'/');
			if($params)
			foreach($params as $param)
			   $this->insertDataToPattern($param);
		$form=$form.'<INPUT TYPE="hidden" NAME="params" VALUE="'.$this->getPatternString().'" >';
		$form=$form.'<INPUT TYPE="submit" ID="xlss" NAME="export" VALUE=""></FORM>';
		return $form;
	}

	//Function to create an Html element on the basis of element type
	public function selectAndCreateElement($type=null)
	{
		$this->functionCallLog('selectAndCreateElement -> ' .$type);
		$element=null;
		if(strtoupper($type)=='TEXT')
			$element=$this->elementText();
		if(strtoupper($type)=='DROPDOWN')
			$element=$this->elementDropdown();
		if(strtoupper($type)=='ORDERED LIST')
			$element=$this->elementList('ORDERED LIST');
		if(strtoupper($type)=='DEFINATION LIST')
			$element=$this->elementList('DEFINATION LIST');
		if(strtoupper($type)=='UNORDERED LIST')
			$element=$this->elementList();
		if(strtoupper($type)=='RADIO')
			$element=$this->elementRadio();
		if(strtoupper($type)=='CHECKBOX')
			$element=$this->elementCheckbox();
		if(strtoupper($type)=='SUBMIT')
			$element=$this->elementSubmit();
		if(strtoupper($type)=='BLANK')
			$element='';

		return $element;
	}

	//Function to create Text element
	public function elementText()
	{
		$this->functionCallLog('elementText');
		//setting additional parameters of text element
		$para=$this->setBasics();
		return  '<INPUT TYPE="'.$this->_xpathValue['displaytype'].'" '.$para.' >';
	}

	//Function to create Select element
	public function elementDropdown()
	{
		$this->functionCallLog('elementDropdown');
		//setting additional parameters of select element
		$para=$this->setBasics('DROPDOWN');
		$select='<SELECT '.$para.'>';
			// If static values exist then it will taken as default values for select element
			if(isset($this->_xpathValue['values'])){
				$valArrCount=count($this->_xpathValue['values']->label);
				for( $i=0; $i<$valArrCount;$i++ ) {
					$selected=null;
					if($i==0) $selected='selected';
					$select=$select. '<OPTION VALUE="'.$this->_xpathValue['values']->value[$i]. '"  '.$selected.'>'. $this->_xpathValue['values']->label[$i].'</OPTION>';}
			}
			/* If static values do not exist then it will taken from the sql given result based on 2columns
			one for Label and another for Label Value for select element */
			else {
				$this->result=$this->runSqlQuery($this->_xpathValue['sql']);
				$label=$this->_xpathValue['labelcolumn'];
				$value=$this->_xpathValue['valuecolumn'];
				$i=0;
				$select=$select.'<OPTION VALUE="" >Select</OPTION>';
				foreach($this->result as $row) {
					$selected=null;
					//if($i==0) $selected='selected';
					$select=$select.'<OPTION VALUE="'.$row->$value.'" '.$selected.' >'. $row->$label.'</OPTION>';
					$i++;
				}
			}
		$select=$select.'</SELECT>';
		return $select;
	}

	//TODO : Comment
	public function elementRadio()
	{
		$this->functionCallLog('elementRadio');

		$para=$this->setBasics('RADIO');
		$radios=null;
			if(isset($this->_xpathValue['values'])){
				$valArrCount=count($this->_xpathValue['values']->label);
				for( $i=0; $i<$valArrCount;$i++ ){
					$selected=null;
					if($i==0) $selected='selected';
					$radios=$radios. '<INPUT TYPE="RADIO" ' .$para . ' VALUE="'.$this->_xpathValue['values']->value[$i].'" '.$selected.' >'.$this->_xpathValue['values']->label[$i];
					}
			}
			else {
				$this->result=$this->runSqlQuery($this->_xpathValue['sql']);
				$label=$this->_xpathValue['labelcolumn'];
				$value=$this->_xpathValue['valuecolumn'];
				$i=0;
				foreach($this->result as $row){
					$selected=null;
					if($i==0) $selected='selected';
					$radios=$radios. '<INPUT TYPE="RADIO" ' .$para. ' VALUE="'.$row->$value.'" '.$selected.'>'.$row->$label;
					$i++;
				}
			}
		return $radios;
	}

	//TODO : Comment
	public function elementSubmit()
	{
		$this->functionCallLog('elementSubmit');

		$para=$this->setBasics('SUBMIT');
		$submit='<INPUT TYPE="SUBMIT" '.$para.'>';
		return $submit;
	}

	//TODO : Comment
	public function elementCheckbox()
	{
		$this->functionCallLog('elementCheckbox');

		$para=$this->setBasics('CHECKBOX');
		$checkboxs=null;
			if(isset($this->_xpathValue['values'])){
				$valArrCount=count($this->_xpathValue['values']->label);
				for( $i=0; $i<$valArrCount;$i++ )
					$checkboxs=$checkboxs. '<INPUT TYPE="CHECKBOX" ' .$para. ' VALUE="'.$this->_xpathValue['values']->value[$i].'" >'.$this->_xpathValue['values']->label[$i];
			}
			else {
				$this->result=$this->runSqlQuery($this->_xpathValue['sql']);
				$label=$this->_xpathValue['labelcolumn'];
				$value=$this->_xpathValue['valuecolumn'];
				foreach($this->result as $row)
					$checkboxs=$checkboxs. '<INPUT TYPE="CHECKBOX" ' .$para. ' VALUE="'.$row->$value.'" >'.$row->$label;
			}
		return $checkboxs;
	}

	//Comment : TODO
	public function elementList($type=null)
	{
		$this->functionCallLog('elementList');

		if($type=='ORDERED LIST') {
			$lTypStrt='<OL>';$lTypEnd='</OL>';
			$ltStrt='<LI>';$ltEnd='</LI>';
		}
		if($type=='DEFINATION LIST') {
			$lTypStrt='<DL>';$lTypEnd='</DL>';
			$ltStrt='<DD>';$ltEnd='</DD>';
		}
		else {
			$lTypStrt='<UL>';$lTypEnd='</UL>';
			$ltStrt='<LI>';$ltEnd='</LI>';
		}

		$listType['start']=$lTypStrt;
		$listType['end']=$lTypEnd;
		$listvalue['start']=$ltStrt;
		$listvalue['end']=$ltEnd;


		$list=$listType['start'];
		if(isset($this->_xpathValue['values'])){
			$valArrCount=count($this->_xpathValue['values']->value);
			for( $i=0; $i<$valArrCount;$i++ )
				$list=$list.$listvalue['start'] . $this->_xpathValue['values']->value[$i]. $listvalue['end'];
		}
		else {
			$this->result=$this->runSqlQuery($this->_xpathValue['sql']);
			$label=$this->_xpathValue['labelcolumn'];
			foreach($this->result as $row)
				$list=$list.$listvalue['start'].$row->$label.$listvalue['end'];
		}
		$list=$list.$listType['end'];
		return $list;
	}

	//To construct basic parameters
	public function setBasics($type='TEXT')
	{
		$this->functionCallLog('setBasics ('.$type.')');

		$class=$name=$id=$length=$value=$additional=null;
		if (!empty($this->_xpathValue['name'])) $name=' NAME="'.$this->_xpathValue['name'].'"';
		if (!empty($this->_xpathValue['class'])) $class=' CLASS="'.$this->_xpathValue['class'].'"';
		if (!empty($this->_xpathValue['id'])) $id=' ID="'.$this->_xpathValue['id'].'"';
		if($type=='TEXT' || $type=='SUBMIT' || $type=='DROPDOWN'){
			if (!empty($this->_xpathValue['length'])) $length=' SIZE='.$this->_xpathValue['length'];
			if($type!='DROPDOWN')
			if (!empty($this->_xpathValue['value'])){
				$eleName=(array)$this->_xpathValue['name'];
				if(isset($this->_formValues[$eleName[0]]))
				{
					die("here");
					$value=' VALUE="'.$this->_formValues[$eleName[0]].'"';
				}
				else $value=' VALUE="'.$this->_xpathValue['value'].'"';
			}
		}
		if (!empty($this->_xpathValue['additional'])) $additional=' '.$this->_xpathValue['additional'];
		return $name.$class.$id.$length.$value.$additional;
	}

	public function setFormElementValue($param,$value)
	{
		$param=(array)$param;
		$this->_formValues=array_merge($this->_formValues,array($param[0]=>$value));
	}

	public function getFormElementValue()
	{
		return $this->_formValues;
	}

	//Function to get xml form
	public function getForm()
	{
		$this->functionCallLog('getForm');
		return $this->_formTable;
	}

	//Comment : TODO
	public function getFormElements()
	{
		//return $this->
	}

	//Function to get total activated for elements for sql
	public function getTotalParamsForSqlResult()
	{
		$this->functionCallLog('getTotalParamsForSqlResult');

		$count=0;
		foreach($this->_xmlCriteriaData as $searchdata){
		foreach($searchdata as $data){
			foreach($data as $set){
			 $this->loadXmlFormValue($set);
			if((strtoupper($this->_xpathValue['isdisplay']) == 'Y') || (strtoupper($this->_xpathValue['isdisplay']) == 'YES')){
				if(isset($this->_xpathValue['searchparam']))
				if((strtoupper($this->_xpathValue['searchparam']) == 'Y') || (strtoupper($this->_xpathValue['searchparam']) == 'YES')){
					$count++;
				}
			}
		}}}
		return $count;
	}

	//Comment : TODO
	public function getSearchParamList()
	{
		$this->functionCallLog('getSearchParamList');
		return $this->_searchParamList;
	}

	//set form params for sql params
	public function setSqlParams($params=null)
	{
		$this->_sqlParams=$params;
	}

	//Function to execute sql construction & run
	public function runSqlQuery($sql)
	{
		if($this->_searchParamList)
			$sql = $this->bindSqlParamsSpecial($sql,null,null);
		$this->functionCallLog('runSqlQuery -> '.$sql);
		return $this->_db->fireSqlFetchAll($sql);
	}

	//Comment : TODO
	public function getSqlResult($page,$search=true,$order=true,$limit=true)
	{
		$this->functionCallLog('getSqlResult for Page -> '.$page );
		$this->_resultSql=$this->constructSqlFromXml($search,$order,$limit);
		$params=null;
		$pagiData=new Bloomfi_QueryFramework_PaginatorData;
		if($this->_sqlSearchCondition)
			$params=$this->_sqlSearchConditionVar;
		$result= $pagiData->getXmlResultForPagination($this->_resultSql, $params,$this->_sqlParams,$page);
		unset($pagiData);
		return $result;
	}

	//Comment : TODO
	public function getSqlResultTableHeader()
	{
		$this->functionCallLog('getSqlResultTableHeader');
		if(isset($this->_xpathResultValue['tableheader']))
			return $this->_xpathResultValue['tableheader'];
	}

	//Comment : TODO
	public function setColumnsPerRowForTable(&$value)
	{
		$this->functionCallLog('setColumnsPerRowForTable -> '. $value);
		$this->_columnsPerRow=$value;
	}

	//Comment : TODO
	public function getPaginationConfigValue()
	{
		$pages=$rowsperpage=null;
		if(isset($this->_xpathResultValue['patinatorconditions'])) {
		$pagiValues= $this->_xpathResultValue['patinatorconditions'];
		$this->functionCallLog('getPaginationConfigValue -> Pages:'. $pagiValues->pages.' RowsPerPage:'.$pagiValues->rowsperpage);
		if(isset($pagiValues->pages) && isset($pagiValues->rowsperpage) && !empty($pagiValues->pages) && !empty($pagiValues->rowsperpage))
			$values = $this->objectToArray($pagiValues);
		else {
				if(isset($pagiValues->pages) && empty($pagiValues->pages))
					$pages=$this->_defaultPages;
				else $pages=$pagiValues->pages;
				if(isset($pagiValues->rowsperpage) && empty($pagiValues->rowsperpage))
					$rowsperpage=$this->_defaultTotalRows;
				else $rowsperpage=$pagiValues->rowsperpage;
				$values=array('pages'=>$pages,'rowsperpage'=>$rowsperpage);
			}
		}
		else $values=array('pages'=>$this->_defaultPages,'rowsperpage'=>$this->_defaultTotalRows);
		return $values;
	}

	//Comment : TODO
	public function sqlFetchLimit($configValue=null)
	{
		$this->functionCallLog('sqlFetchLimit');
		if(is_array($configValue)){
			$this->_start = $configValue[0];
			if(isset($configValue[1]) && !empty($configValue[1]))$this->_rows=$configValue[1];
		}
		else{
			if($configValue && is_integer($configValue))
				$this->_start = $configValue;
			else die("Limit start value required for Report Framework");
		}
		$this->_fetchLimitValue=' LIMIT '.$this->_start.','.$this->_rows;
	}

	//Comment : TODO
	public function sqlOrderByCondition($configValue=null)
	{
		$this->functionCallLog('sqlOrderByCondition');
		$this->clearPattern();
		$this->setPattern();
		$this->preAddToStringDirect(" ORDER BY ");
		if(!isset($this->_xpathResultValue['orderby']))
			return;
		foreach($this->_xpathResultValue['orderby'] as $group) {
			foreach ( $group->item as $value)
				 $this->insertDataToPattern("parent.".$value);
			$this->postAddToStringDirect(" ".$group->type); }
		$this->_orderByCondition=$this->getPatternString();
	}

	//Comment : TODO
	public function getXmlResultSqlBundle($search=true,$order=true,$limit=true)
	{
		$this->functionCallLog('getXmlResultSqlBundle');

		$sql['sql']=$this->constructSqlFromXml($search,$order,$limit);
		$sql['params']=$this->_sqlSearchConditionVar;
		return $sql;
	}

	//Comment : TODO
	public function getXmlTableHeaderLabel()
	{
		$this->functionCallLog('getXmlTableHeaderLabel');

		if(isset($this->_xpathResultValue['tableheader'])){
			$label=$this->_xpathResultValue['tableheader'];
			$headerLabel=array();
			foreach($label as $lbl)
				array_push($headerLabel,$lbl);
			return $headerLabel;
		}
		else return null;
	}

	public function getHeaderSql()
	{
		return $this->_xpathResultValue['sqlheader'];
	}

	//Comment : TODO
	public function constructSqlFromXml($search=true,$order=true,$limit=true)
	{
		//print_r($this->_searchParamFilterList);
		$this->functionCallLog('constructSqlFromXml');
		$this->_decodeSQLConditionCodes($this->_xpathResultValue['sql']);
		$check=false;
		$result=$searchCondition=$condition=null;
		$sql="SELECT ";
		$this->clearPattern();
		$this->setPattern();
		foreach($this->_xpathResultValue['queryheader'] as $param)
			   $this->insertDataToPattern('parent.'.$param);
		$str=$this->getPatternString();
		$sql=$sql.$str." FROM ( ".$this->_xpathResultValue['sql']." ) parent WHERE 1=1 ";
		if(isset($this->_xpathResultValue['sqlconditions']) && !empty($this->_xpathResultValue['sqlconditions']))
		foreach($this->_xpathResultValue['sqlconditions'] as $condition){
			$sql=$sql." AND parent.".$condition;
		}
		if($search==true){
			//print_r($this->_sqlParams);
			if($this->_sqlSearchCondition){
				$param=0;
			foreach($this->_sqlSearchCondition as $condition) {
				if(!empty($this->_sqlParams[$param])){
					$check=$this->_checkAsterix($this->_sqlParams[$param]);
					$this->_decodeSQLConditionCodes($condition,$this->_sqlParams[$param],$check);
					$searchCondition = $searchCondition.$condition;
				}
			    $param++;
			}
			$sql=$sql.$searchCondition; }
		}
		if($order==true){
			$this->sqlOrderByCondition();
			$sql=$sql.$this->_orderByCondition; }
		if($limit==true) $sql=$sql.$this->_fetchLimitValue;
		$this->_htmlSpecialCodeDecorder($sql);

		//echo $sql;
		//die;

		return $sql;
	}

	function _decodeSQLConditionCodes(&$condition,&$value=null,$check=false)
	{
		if($check==true){
			$value=str_replace('*','%',$value);
			$condition=str_replace('@PATTERN@','LIKE',$condition);}
		$condition=str_replace('@PATTERN@','=',$condition);
		$condition=str_replace('@EQUAL@','=',$condition);
		$condition=str_replace('@NOTEQUAL@','<>',$condition);
		$condition=str_replace('@LIKE@','LIKE',$condition);
		$condition=str_replace('@NOTLIKE@','NOT LIKE',$condition);
		$condition=str_replace('@GREATER@','>',$condition);
		$condition=str_replace('@GREATEREQUAL@','>=',$condition);
		$condition=str_replace('@LESS@','<',$condition);
		$condition=str_replace('@LESSEQUAL@','<=',$condition);
	}

	function _htmlSpecialCodeDecorder(&$sql)
	{
		$sql=str_replace('@HTML:BR@','<BR>',$sql);
	}

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

}
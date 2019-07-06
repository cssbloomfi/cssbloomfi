<?php
class Applibrary_XlsUrlHelper extends Bloomfi_SqlUtil
{

	public function createXlsUrlOnResult(&$class,$function,$url=null,$linkName='Xls File',$params=null, $rows=5000,$run=null)
	{
		$params=$this->_convertAsterixInArray($params);
		$link=null;
		if(!$run) $run=500;
		for($i=1;$i<=$run;$i++) {
			if($i!=1) $start=$start+$rows;
			else $start=0;
			$data = array($start,$rows);
			if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//	print_r($data);
			$result=$class->$function($data);
			if(isset($result['result']))
				$result=$result['result'];
			if($result){
				$link[$i]['url_name']="$linkName - $i";
				$link[$i]['url'] = $url.'/file/'.$i.'/start/'.$start.'/rows/'.$rows; }
			else {
				break;
			}
		}
		return $link;
	}

	public function createSqlXlsUrlOnResult($sqlbundle,$url=null,$linkName='Xls File',$params=null, $rows=5000,$run=null)
	{
		$params=$this->_convertAsterixInArray($params);
		$link=null;
		if(!$run) $run=500;
		for($i=1;$i<=$run;$i++) {
			if($i!=1) $start=$start+$rows;
			else $start=0;
			//print_r($data);
			//print_r($result);
			if($params)
				$sqlQuery=$this->bindSqlParams($sqlbundle['sql'],$sqlbundle['params'],$params,true);
			$sqlQuery=$sqlQuery." LIMIT ".$start.",".$rows;
			//echo $sqlQuery;
			$result=$this->fireSqlFetchAll($sqlQuery,'createSqlXlsUrlOnResult');
			if($result){
				$link[$i]['url_name']="$linkName - $i";
				$link[$i]['url'] = $url.'/file/'.$i.'/start/'.$start.'/rows/'.$rows; }
			else break;
		}
		return $link;
	}

	public function createXlsUrlOnResultArray(&$class,$function,$url=null,$linkName='Xls File',$params=null,$rows=null,$run=null,$asterix=true)
	{
		$links=$this->createUrlOnResultArray($class,$function,$url,$linkName,$params,$rows,$run,$asterix);
		return $links;
	}

	public function createPdfUrlOnResultArray(&$class,$function,$url=null,$linkName='Xls File',$params=null,$rows=null,$run=null,$asterix=true)
	{
		$links=$this->createUrlOnResultArray($class,$function,$url,$linkName,$params,$rows,$run,$asterix);
		return $links;
	}

	public function createUrlOnResultArray(&$class,$function,$url=null,$linkName='Xls File',$params=null,$rows=null,$run=null,$asterix=true)
	{
		if($asterix==true) $params=$this->_convertAsterixInArray($params);
		//print_r($params);
		$link=null;
		if(!$rows)$rows=5000;
		if(!$run) $run=500;
		for($i=1;$i<=$run;$i++) {
			if($i!=1) $start=$start+$rows;
			else $start=0;
			$data = array($start,$rows);
			if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
			//print_r($data);
			$result=$class->$function($data);
			//print_r($result['result']);
			if($result['result']){ $link[$i]['url_name']="$linkName - $i";
				$link[$i]['url'] = $url.'/file/'.$i.'/start/'.$start.'/rows/'.$rows;
				}
			else break;
		}
		return $link;
	}

	function _convertAsterixInArray($params)
	{
		foreach($params as $key=>$param)
		{
			$params[$key]=str_replace('*','%',$param);
		}

		return $params;
	}

}
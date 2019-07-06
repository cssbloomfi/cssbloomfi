<?php
/*
*Author  : Smritiman Baraua
*Purpose : To support Excel class
*Utility : Can be used by other class
*/

class Bloomfi_Excel_XtrTools
{
	public function removeComma($string)
	{
		$data=explode(',',$string);
		$data=join('',$data);
		return $data;
	}

	public function isEmptyRow($data)
	{
		$flag=null;
		foreach($data as $value){
			$val=trim($value);
			if($val!='') $flag=1;}
		return $flag;
	}

	public function convertDateToDate($date,$separetor='/',$sequence='d,m,y',$newDtformat='Y-m-d', $timeZone='Europe/London',$seperatorsFormat=array('/','.','-'))
	{
		$isIsoDate=$this->isIsoDate($date);
		if(!$isIsoDate)
		{
			$format=null;
			date_default_timezone_set($timeZone);
			$dt=explode($separetor,$date);
			if(!isset($dt[1]) && !isset($dt[2])){
			foreach($seperatorsFormat as $sepa){
				if($sepa!=$separetor) {
				$dt=explode($sepa,$date);
				if(isset($dt[1]) && isset($dt[2]))
					break;}}}
			$format=explode(',',strtolower($sequence));
			if(!isset($format[1]) && !isset($format[2])){
			foreach($seperatorsFormat as $sepa){
				$format=explode($sepa,strtolower($sequence));
				if(isset($format[1]) && isset($format[2]))
					break;}}
			while($data = current($format)){
				switch($data){
					case 'd':
						$cdate['d'] = $dt[key($format)];
						break;
					case 'm':
						$cdate['m'] = $dt[key($format)];
						break;
					case 'y':
						$cdate['y'] = $dt[key($format)];
						break;
				}
				next($format);
			}
			if(isset($cdate['d']) && isset($cdate['m']) && isset($cdate['y'])){
			if( checkdate($cdate['m'],$cdate['d'],$cdate['y']) ){
				$datetime = new DateTime();
				$datetime->setDate($cdate['y'], $cdate['m'], $cdate['d']);
				$newdate = date_format($datetime, $newDtformat);
				return $newdate;
			}}
			else{
			   return null;
			}	
		}
		else
			return $date;
	}

	public function isIsoDate($date)
	{
		if($date)
		{
			$dateValues=explode('-',$date);
			if(isset($dateValues[0]) && isset($dateValues[1]) && isset($dateValues[2])){
				if( checkdate($dateValues[1],$dateValues[2],$dateValues[0]) )
				   return $date;
			    else return null;
			}
			else return null;
		}
		else return null;
	}
}
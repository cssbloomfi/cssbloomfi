<?php

class Bloomfi_App_UHtmlElement extends Bloomfi_App_Messages_Message
{
	protected $_msg;
	protected $_selectOption=null;

	public function __construct()
	{
		$this->_msg = $this->getValidationMessages('validation');
	}

	public function createSelect($name=null,$datas=null,$selectedKey=null,$defaultVal=null,$add=null)
	{
		if($defaultVal==null)$defaultVal='Select';
		if($selectedKey==null)$selectedKey='default';
	    $selectHead='<select name="'.$name.'" '.$add.'>';
		$selectOptions='<option value="default">'.$defaultVal.'</option>';
		if($datas!=null)
		foreach($datas as $row){
			if ( key($datas) == $selectedKey )
			$selectOptions=$selectOptions.'<option value="'.key($datas).'" selected>'.$row.'</option>';
			else
			$selectOptions=$selectOptions.'<option value="'.key($datas).'" >'.$row.'</option>';
			next($datas);
		}
		$selectFoot="</select>";
		$select=$selectHead.$selectOptions.$selectFoot;
		return $select;
	}

	public function createSelectDb($name=null,$datas=null,$key=null,$value=null,$selectedKey=null,$defaultKey=null,$defaultVal=null,$add=null)
	{
		if($defaultVal==null)$defaultVal='Select';
		if($defaultKey==null)$defaultKey='default';
		else{ $defaultKey=strtoupper($defaultKey);
			if($defaultKey=='NOT') $defaultKey='';}
		if($selectedKey==null && $defaultKey!='')$selectedKey='default';
		elseif($selectedKey==null && $defaultKey=='')$selectedKey='';
	    $selectHead='<select name="'.$name.'" '.$add.'>';
		$selectOptions='<option value="'.$defaultKey.'">'.$defaultVal.'</option>';
		if($datas!=null)
		foreach($datas as $row){
		  if ( $row->$key==$selectedKey) {
			$selectOptions=$selectOptions.'<option value="'.$row->$key.'" selected>';
			if(is_array($value)) {
				$seperator=$str=null;
				$i=0;
				foreach( $value as $key_value) {
					if($i==1)
						$seperator = ' , ';
					$str=$str.$seperator.$row->$key_value;
					$i++;
				}
			}
			else $str=$row->$value ;
			$this->_selectOptionValue=$str;
			$selectOptions=$selectOptions.$str.'</option>';

		  }
		  else
			$selectOptions=$selectOptions.'<option value="'.$row->$key.'" >'.$row->$value.'</option>';}
		$selectFoot="</select>";
		$select=$selectHead.$selectOptions.$selectFoot;
		return $select;
	}

	public function createRadio($name=null,$data=null,$selectedKey=null,$add=null)
	{
		$radio=null;
		$i=0;
		foreach($data as $key=>$value){
			$checked=null;
			if($selectedKey){ if($key==$selectedKey) $checked='checked'; }
			else {
			if( $i==0 ) $checked='checked';
			$i++;
			}
			$radio=$radio.'<input type="radio" name="'.$name.'" value="'.$key.'" '.$checked.'>'.' '.$value;
		}
		return $radio;
	}

	public function createRadioDb($name=null,$data=null,$valueCol,$labelCol,$selectedKey=null,$add=null)
	{
		$radio=null;
		$i=0;
		foreach($data as $key=>$obj){
			$checked=null;
			if($selectedKey){ if($obj->$valueCol==$selectedKey) $checked='checked'; }
			else {
			if( $i==0 ) $checked='checked';
			$i++;
			}
			$radio=$radio.'<input type="radio" name="'.$name.'" value="'.$obj->$valueCol.'" '.$checked.' ' .$add.'>'.' '.$obj->$labelCol.' ';
		}
		return $radio;
	}

	public function getSelectOptionValue()
	{
		return $this->_selectOptionValue;
	}

	public function checkElementAlpha($name=null,&$value,$maxl=0,$minl=0)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				if( ($length<$minl || $length>$maxl) && $length>0 )
				$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['length']." ".$minl." ".$this->_msg['or']." ".$maxl;

			    else{
				$msg = '"<b>'.$name.'</b>" '.$this->_msg['alpha'];
				preg_match('/^[a-zA-Z'.' '.']+$/', $value) ? trim($value) : $error_msg = $msg;
			}
		}

		return $error_msg;
	}

	public function checkElementNum($name=null,&$value,$maxl=0,$minl=0)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				if( ($length<$minl || $length>$maxl) && $length>0 )
				$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['length']." ".$minl." ".$this->_msg['or']." ".$maxl;

				else{
				$msg = '"<b>'.$name.'</b>" '.$this->_msg['numeric'];
				is_numeric($value) ? trim($value) : $error_msg = $msg;
				}
			}

		return $error_msg;
	}


	public function checkElement($name=null,&$value,$maxl=0,$minl=0)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				if( ($length<$minl || $length>$maxl) && $length>0 )
				$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['length']." ".$minl." ".$this->_msg['or']." ".$maxl;
			}

		return $error_msg;
	}

	public function checkElementSpace($name=null,&$value,$maxl=0,$minl=0)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				if( ($length<$minl || $length>$maxl) && $length>0 )
				$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['length']." ".$minl." ".$this->_msg['or']." ".$maxl;
				else{
					if(strstr($value, " "))
						$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['spaceExist'];
				}
			}
		$error_msg=str_replace('@s@','(s)',$error_msg);
		return $error_msg;
	}

	public function checkElementFloatComp($name=null,$value1=null,$value2=null,$msg='Value Matched')
	{
		$error_msg=null;
		$value1=(float)$value1;
		$value2=(float)$value2;
		if( $value1 == $value2 )
			$error_msg = $msg.' for "<b>'.$name.'</b>"';
		return $error_msg;
	}

	public function checkElementDate($name=null,$value=null)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				$date_values=explode('-',$value);
				if(!isset($date_values[0])) $date_values[0]=0;
				if(!isset($date_values[1])) $date_values[1]=0;
				if(!isset($date_values[2])) $date_values[2]=0;
				$status=checkdate(trim($date_values[1]),trim($date_values[2]),trim($date_values[0]));
				if(!$status)
				  $error_msg = '"<b>'.$name.'</b>" '.$this->_msg['date'];
			}

		return $error_msg;
	}

	public function checkElementEmail($name=null, &$value ,$maxl=0,$minl=0)
	{
		$error_msg=null;
		$length=strlen(trim($value));
			if($length == 0)
				$error_msg='"<b>'.$name.'</b>" '.$this->_msg['empty'];
			else{
				if( ($length<$minl || $length>$maxl) && $length>0 )
				$error_msg='"<b>'.$name.'</b>"  '.$this->_msg['length']." ".$minl." ".$this->_msg['or']." ".$maxl;

			    else{
				$msg = '"<b>'.$name.'</b>" '.$this->_msg['email'];
				$pattern = '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/';
				preg_match($pattern, $value) ? trim($value) : $error_msg = $msg;
			}
		}

		return $error_msg;
	}

	//Function for check a value into a array
	public function isExist($value=null,$array=null)
	{
		$i=0;
		$flag=0;
		$value=strtolower($value);
		$keyNames = array_keys($array);
		foreach ($keyNames as $key){
			if($array[$key]==$value || $array[$key]==null ){
				$flag=1;
				$data[$i++] = $this->_msg['select'].' "<b>'.$key.'</b>"';}}
		if($flag==1)
			return $data;
		else
			return null;
	}

	//Function for check a select box
	public function checkElementSelect($defvalue=null,$label=null,$value=null)
	{
		if(!is_array($defvalue))$defvalue=strtolower($defvalue);
		else $defvalue=strtolower($defvalue[0]);
		if(!is_array($value))$value=strtolower($value);
		else $value=strtolower($value[0]);
		if($defvalue==$value || $value==null )
			return '"<b>'.$label.'</b>" '.$this->_msg['select'];
		else
			return null;
	}

	function  stripExtension($filename  = null) {
		if ($filename!=null) {
			$filename = strtolower($filename);
			$extArray = preg_split('/\./', $filename, -1);
			$p = count($extArray);
			$p--;
			 $extension = $extArray[$p];
			return $extension;
		} else {
			return false;
		}
	}

}

?>
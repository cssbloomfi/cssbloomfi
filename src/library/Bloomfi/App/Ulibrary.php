<?php
require_once 'Config/Ini.php';
class Bloomfi_App_Ulibrary extends Bloomfi_App_Ulibrary_ProcessTime
{
	// Function binds the value to sql query
	public function bindSqlParams ( $sql,$params,$values,$root=false )
	{
		//echo $sql;
		//print_r($params); die();
		if (is_array($values)){
			$i=0;
			if($root==false){
				if(isset($params->param))
				 foreach ($params->param as $parameter ){
					 if(!isset($values[$i])) $values[$i]=null;
						$sql=str_replace($parameter ,$values[$i++], $sql );
				}
			}
			else{
				foreach ($params as $parameter ) {
					 if(!isset($values[$i])) $values[$i]=null;
							$sql=str_replace($parameter ,$values[$i++], $sql );
				}
			}
		}
		else{
			if($root==false) $sql=str_replace($params->param,$values,$sql );
			else $sql=str_replace($params,$values,$sql );
		}
		$this->convertSpecialCodes($sql);
		return $sql;
	}

	public function bindSqlParamsSpecial( $sql,$params,$values=null,$root=false )
	{
		//echo $sql;
		//print_r($params); die();
		if (is_array($values)){
			$i=0;
			if($root==false){
				if(isset($params->param))
				 foreach ($params->param as $parameter )
					$sql=str_replace($parameter ,$values[$i++], $sql );
			}
			else{
				foreach ($params as $parameter )
					$sql=str_replace($parameter ,$values[$i++], $sql );
			}
		}
		else{
			if($root==false) {
				if($params) $sql=str_replace($params->param,$values,$sql );
			}
			else $sql=str_replace($params,$values,$sql );
		}
		$this->convertSpecialCodes($sql);
		return $sql;
	}

	public function convertSpecialCodes(&$sql)
	{
		$sql=str_replace('@GT@','>',$sql );
		$sql=str_replace('@LT@','<',$sql );
		$sql=str_replace('@GTEQ@','>=',$sql );
		$sql=str_replace('@LTEQ@','<=',$sql );
		$sql=str_replace('@NOTEQ@','<>',$sql );
		$sql=str_replace('@BR@','<BR>',$sql);
	}

	//Function loads form labels from Ini File and returns result as an array
	public function getIniParameters($path,$key,$paramKey='param')
	{
		$config=new Zend_Config_Ini($path,$key);
		$data=$config->toArray($config);
		if($data){
		$keyNames = array_keys($data[$paramKey]);
		$i=0;
		foreach($config->$paramKey as $value){
			$params[$keyNames[$i]]=$value;
			$i++;}
		return $params;}
		else return null;
	}


	//Function loads form labels from Ini File and returns result as an array
	public function getIniLabels($path,$key)
	{
		$config=new Zend_Config_Ini($path,$key);
		$data=$config->toArray($config);
		if($data){
		$keyNames = array_keys($data['label']);
		$i=0;
		foreach($config->label as $value){
			$labels[$keyNames[$i]]=$value;
			$i++;}
		return $labels;}
		else return null;
	}

	//Function loads Messages from Ini File and returns result as an array
	public function getIniMessages($path,$key)
	{
		$config=new Zend_Config_Ini($path,$key);
		$data=$config->toArray($config);
		if($data){
		$keyNames = array_keys($data['msg']);
		$i=0;
		foreach($config->msg as $value){
			$messages[$keyNames[$i]]=$value;
			$i++;}
		return $messages; }
		return null;
	}

	//Function loads values from Ini File and returns result as an array
	public function getIniValues($path,$key)
	{
		$config=new Zend_Config_Ini($path,$key);
		$data=$config->toArray($config);
		if($data){
		$keyNames = array_keys($data['value']);
		$i=0;
		foreach($config->value as $value){
			$Values[$keyNames[$i]]=$value;
			$i++;}
		return $Values; }
		return null;
	}

	/*
	//Function loads values from Ini File and returns result as an array
	public function getIniValues($path,$key,$ini_element_key='label')
	{
		$config=new Zend_Config_Ini($path,$key);
		$data=$config->toArray($config);
		if($data){
		$keyNames = array_keys($data[$ini_element_key]);
		$i=0;
		foreach($config->$ini_element_key as $value){
			$Values[$keyNames[$i]]=$value;
			$i++;}
		return $Values; }
		return null;
	}

*/


	//Function for generating a array with different keys and their values to oraginze db datas
	public function dbBaseArray($key,$value,$data,$default=null)
	{
		if($default!=null)
		$array['default'] = $default;
		foreach($data as $row){
			$array[$row->$key]=$row->$value;}
		return $array ;
	}

	//Function to create a one value array or to merge a value to a array
	public function mergeValueToArray($array=null,$key=null,$value=null)
	{
		if(is_array($array)){
		if($value && $key)
		$array=array_merge($array,array($key=>$value));
		else if ( is_array($key))
		$array=array_merge($array,$key);
		}
		else{if(!$array && $key && $value )
		$array=array($key=>$value);}
		return $array;
	}

	//Function converts an object to an array
	function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
            return $object;
        if( is_object( $object ) )
            $object = get_object_vars( $object );
        return array_map( null, $object );
    }


	public function imageUpload($imageFile,$nwimagename,$thmbtarget,$newheight=null,$newwidth=null)
	{
		$image =$imageFile ;
		$src=imagecreatefromjpeg($image);
		list($width,$height)=getimagesize($image);
		if($newwidth==null)$newwidth=103;
		if($newheight==null)$newheight=92;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$thmbtarget = $thmbtarget.'/'.$nwimagename;
		imagejpeg($tmp,$thmbtarget,100);
		imagedestroy($src);
		imagedestroy($tmp);
	}

	public function crtHtolSortedFilesInfo($files,$fileExtention='log')
	{
		$file_no=null;
		if($files) {
		$i=0;
		foreach($files as $filename) {
		$lstatime = date("d-m-Y H:i:s.", fileatime($filename));
		$filename=basename($filename);
		$file=explode('_',$filename);
		if(!empty($file[3])) $file_no=basename($file[3],".$fileExtention");
		else $file_no=$i++;
		$allfilename[$file_no]['id']=$file_no;
		$allfilename[$file_no]['filename']=$filename;
		$allfilename[$file_no]['lstatime']=$lstatime;}
		krsort($allfilename);
		return $allfilename; }
	}


}
?>
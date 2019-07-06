<?php
class BinaryBl_GenerateReportTable extends Bloomfi_NumericFormat
{
	protected $_session;

	//This class call the child class depending on tableStyle
	// Currently only tableStyle = 'htmltable' supported
	public function __construct()
	{
	}

    public function generateDataTable($tableReqElements,$result,$windowData=null,$class=null,$tableStyle='htmltable') {
		if($tableStyle!='htmltable')
			return 'Style : '.$tableStyle.' not supported !';

		if($tableStyle=='htmltable')
			{
			$returnTable=$this->generateHtmlTableData($tableReqElements,$result,$windowData,$class);
			return $returnTable;
			}

		return $tableContent;
	}

	// Generate Html style of date using <tr><td>

	public function generateHtmlTableData($tableReqElements,$result,$windowData,$class=null)
	{
		$addClass=$columns=$divs=null;
		$script="<script type='text/javascript'>
					$.fx.speeds._default = 1000;
					$(function() {";
		if($class)$addClass='class="'.$class.'"';
		$tableContent= "<table $addClass >";
		if(isset($result[0]))
		$sqlKeys=array_keys($this->objectToArray($result[0]));
	//	print_r($sqlKeys);
		if(isset($tableReqElements['html']))
		{
			$i=1;
			$labels=array();

			foreach($tableReqElements['labels'] as $label)
			{
				$key='@FLABEL'.$i.'@';
				$labels=array_merge($labels,array($key=>(string)$label));
				$i++;
			}
			if($result)
			foreach($result as $resultRow)
			{
				$values=array();
				$i=1;
				$html=$tableReqElements['html'];
				foreach($tableReqElements['values'] as $value)
				{
					$key='@FVALUE'.$i.'@';
					$data=$resultRow->$value;
						if(is_float($data))  $data=$this->numFormat($data);
						if(is_numeric($data)) {  $numView=explode('.',$data);
						if(isset($numView[1])) $data=$this->numFormat($data);  }
					$values=array_merge($values,array($key=>$data));
					$i++;
				}
				$tableContent.= "<tr>";
				$tableContent.='<td>';
					foreach($labels as $key=>$lab)
					{
						$html=str_replace($key,$lab,$html);
					}
					foreach($values as $key=>$val)
					{
						$html=str_replace($key,$val,$html);
					}
				$tableContent.=$html.'</td>';
				$tableContent.= "</tr>";
			}
		}
		else if(isset($tableReqElements->row)){
			if($result)
			foreach($result as $resultRow)
			{
				$tableContent.= "<tr><td cell-spacing=20>";
				$queryCol=$sqlKeys;
					foreach($tableReqElements->row as $row){
						$tableContent.= "<div><table>";
						foreach($row as $data){
							$tableContent.='<tr>';
							$i=0;
							foreach($data as $col){
								$tableContent.="<td style='background:#C7C7C7;font-size:13px;padding:0 3px 0 3px;text-align:center;'>".$col."</td>";
								$i++;
							}
							$tableContent.='</tr><tr>';
							for($j=0;$j<$i;$j++)
							{
								$col=current($queryCol);
								$tableContent.="<td style='font-size:12px;'>".$resultRow->$col."</td>";
								next($queryCol);
							}
							$tableContent.='</tr>';
						}
						$tableContent.= "</table></div>";
					}
				$tableContent.= "</tr></td>";
			}}
		else{
			$id=array();
			foreach($tableReqElements['values'] as $row){
				if(isset($row['type'])){
					$id=array_merge($id,array((string)$row=>0));
				}
			}
			$tableContent.= "<tr>";
			foreach($tableReqElements['labels'] as $row)
			{
				$flag=false;
				if($windowData)
				foreach($windowData->label as $label){
					if(trim($label)==trim($row)){
						$flag=true;
						break;
					}
				}
				if($flag==false){
					if(!isset($row['type']))
					$tableContent.='<th>'.$row.'</th>';
				}
			}
			$tableContent.= "</tr>";
			if($result)
			foreach($result as $resultRow)
			{

					$tableContent.= "<tr>";
					$i=0;
					foreach($tableReqElements['values'] as $key=>$row)
					{
						$flag=false;
						if($windowData)
						foreach($windowData->item as $item)
						{
							if($item==$row){
								$flag=true;
								break;
							}
						}

						if($flag==false)
						{
							$data=$resultRow->$row;
							if(is_float($data))  $data=$this->numFormat($data);
							if(is_numeric($data)) {  $numView=explode('.',$data);
							if(isset($numView[1])) $data=$this->numFormat($data);  }

							if(!isset($row['type'])){
								$tableContent.='<td>'.$data.'</td>';
							}else
							{
								$openerId=$row['id'].'-opener'.$id[(string)$row];
								$divId=$row['id'].$id[(string)$row]++;
								$divs.='<div id="'.$divId.'" title="'.'Details'.'">'.$data. '</div>';
								$script.="
								$('#".$divId."').dialog({
									autoOpen: false,
									height:450,
									/*show: 'blind',
									hide: 'blind'*/
								});
								$('#".$openerId."').click(function() {
										$('#".$divId."').dialog('open');
										return false;
									});";
								$tableContent.='<td><button class="table_icon1" id="'.$openerId.'"></button></td>';
							}
						}
						$i++;
					}
					$tableContent.= "</tr>";
			}
		}
		//print_r($columns);
		$tableContent.="</table>";
		$script.="});</script>";
		$table['table']=$tableContent;
		$table['divs']=$divs;
		$table['script']=$script;

		return $table;
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

	// Generate Div Html style of date using <div>
	public function generateHtmlDivData()
	{
		// TODO : to be implemented
	}

}
?>
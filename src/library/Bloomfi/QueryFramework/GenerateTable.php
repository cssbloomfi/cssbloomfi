<?php
class Bloomfi_QueryFramework_GenerateTable extends Bloomfi_NumericFormat
{

	//This class call the child class depending on tableStyle
	// Currently only tableStyle = 'htmltable' supported
    public function generateDataTable($header,$result,$class=null,$sumColumn=null,$tableStyle='htmltable') {
		if($tableStyle!='htmltable')
			return 'Style : '.$tableStyle.' not supported !';

		if($tableStyle=='htmltable')
			{
			$returnTable=$this->generateHtmlTableData($header,$result,$class,$sumColumn);
			return $returnTable;
			}

		return $tableContent;
	}

	// Generate Html style of date using <tr><td>

	public function generateHtmlTableData($header,$result,$class=null,$sumColumn=null)
	{
		$addClass=$columns=null;
		if($class)$addClass='class="'.$class.'"';
		$tableContent= "<table $addClass >";
		$tableContent=$tableContent."<tr>";
				foreach($header as $title)
				   $tableContent=$tableContent. "<th> $title </th>";
		$tableContent=$tableContent."</tr>";
		if($result){ $i=0;
			    foreach($result as $row) {
					if($i==0){$columns=array_keys($this->objectToArray($row));$i++;}
				  $tableContent=$tableContent."<tr>";
			      foreach ( $row as $key=>$data) {
					    if(is_float($data))  $data=$this->numFormat($data);
						if(is_numeric($data)) {  $numView=explode('.',$data);
							if(isset($numView[1])) $data=$this->numFormat($data);  }
						$tableContent=$tableContent."<td>$data</td>";  }
				$tableContent=$tableContent."</tr>";  }}
		if($sumColumn)
		{
			if($columns){
			$tableContent=$tableContent."<tr>";

			foreach($columns as $dataColumn){
				$total=$tddata=null;
				foreach( $sumColumn as $column)
					if($column==$dataColumn){
						$total=(float)0;
						foreach($result as $row){
							$value=(float)$row->$column;
							$total=$total+$value;
						}
				}
			  if($total)
				$tddata="<b>".$this->numFormat($total)."</b>";
			  $tableContent=$tableContent."<td style='color:#FF0000;'>".$tddata."</td>";
			}
			$tableContent=$tableContent."</tr>"; }
		}
		//print_r($columns);
		$tableContent=$tableContent."</table>";

		return $tableContent;
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
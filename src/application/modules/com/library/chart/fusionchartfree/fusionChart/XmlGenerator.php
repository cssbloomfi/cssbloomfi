<?php
class modules_com_library_chart_fusionchartfree_fusionChart_XmlGenerator
{
	protected $_color;

	public function __construct()
	{
		$this->_color[0] = "1941A5" ;//Dark Blue
		$this->_color[1] = "AFD8F8";
		$this->_color[2] = "F6BD0F";
		$this->_color[3] = "8BBA00";
		$this->_color[4] = "A66EDD";
		$this->_color[5] = "F984A1" ;
		$this->_color[6] = "CCCC00" ;//Chrome Yellow+Green
		$this->_color[7] = "999999" ;//Grey
		$this->_color[8] = "0099CC" ;//Blue Shade
		$this->_color[9] = "FF0000" ;//Bright Red
		$this->_color[10] = "006F00" ;//Dark Green
		$this->_color[11] = "0099FF"; //Blue (Light)
		$this->_color[12] = "FF66CC" ;//Dark Pink
		$this->_color[13] = "669966" ;//Dirty green
		$this->_color[14] = "7C7CB4" ;//Violet shade of blue
		$this->_color[15] = "FF9933" ;//Orange
		$this->_color[16] = "9900FF" ;//Violet
		$this->_color[17] = "99FFCC" ;//Blue+Green Light
		$this->_color[18] = "CCCCFF" ;//Light violet
		$this->_color[19] = "669900" ;//Shade of green
	}

	public function generateXml($result,$caption="No Caption Exists!!!",$labelvalue=array("LABEL", "VALUE"),$color=false)
	{
		$colorCode=null;
		$i=0;
		$strXML = "<graph caption='".$caption."' numberPrefix='' formatNumberScale='0'>";
		if($result)
		{
			foreach($result as $row){
				if($color==true)
				{
					if($i==20) $i=0;
					$colorCode="color='".$this->_color[$i++]."'";
				}
				$strXML .= "<set name='" . $row->$labelvalue[0] . "' value='" . $row->$labelvalue[1] . "' ".$colorCode."/>";
			}
		}
		$strXML .= "</graph>";
		
		return $strXML;
	}

}
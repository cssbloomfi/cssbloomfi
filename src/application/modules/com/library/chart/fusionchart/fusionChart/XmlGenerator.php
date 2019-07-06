<?php

class modules_com_library_chart_fusionchart_fusionChart_XmlGenerator
{
	public function generateXml($result=null,$caption="No Caption Exists!!!",$labelvalue=array("LEBEL", "VALUE"))
	{	
		$strXML = "<chart caption='".$caption."' numberPrefix='' formatNumberScale='0'>";
		if($result)
		{
			foreach($result as $row){
				$strXML .= "<set label='" . $row->$labelvalue[0] . "' value='" . $row->$labelvalue[1] . "' />";
			}
		}
		
		$strXML .= "</chart>";
		return $strXML;
	}

}
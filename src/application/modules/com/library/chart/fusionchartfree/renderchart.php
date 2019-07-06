<?php
include("fusionChart/FusionCharts.php");
class modules_com_library_chart_fusionchartfree_renderchart
{
	protected $_width=270;
	protected $_height=210;

	public function renderColumn3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Column3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderMSColumn3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_MSColumn3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderDoughnut2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Doughnut2D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderPie3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Pie3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderPie2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Pie2D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderArea2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Area2D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderBar2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		return renderChart("/charts/fusionchartfree/FCF_Area2D.swf", "", $strXML, $id, $width, $height, false, false);
	}
}
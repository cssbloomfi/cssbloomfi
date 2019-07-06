<?php
include("fusionChart/FusionCharts.php");
class modules_com_library_chart_fusionchart_renderchart
{
	protected $_width=270;
	protected $_height=210;

	public function renderColumn3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Column3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderMSColumn3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/MSColumn3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderDoughnut3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Doughnut3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderPie3D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Pie3D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderPie2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Pie2D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderArea2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Area2D.swf", "", $strXML, $id, $width, $height, false, false);
	}

	public function renderBar2D($strXML=null,$id=null,$width=null,$height=null)
	{
		if(($width && !is_numeric($width)) || !$width ) $width=$this->_width;
		if(($height && !is_numeric($height)) || !$height ) $height=$this->_height;
		$id=$this->getUniqueTimeBasedId($id);
		return renderChart("/charts/fusionchart/Area2D.swf", "", $strXML, $id, $width, $height, false, false);
	}
	
	function getUniqueTimeBasedId($id)
	{
		$time=microtime();
		$timeIds=explode(' ',$time);
		$num1=explode('.',$timeIds[0]);
		$id.=$num1[1].$timeIds[1];
		return $id;
	}
}
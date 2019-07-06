<?php

class modules_com_transaction_empAndSchmWishPayAndRecp extends
modules_com_transaction_AbstractTransactionComponent
{
	public function __construct()
	{

		parent::__construct();
	}

	public function getEmpAndSchmWishPayAndRecp($id="EmpAndSchmWisePaymentReceipt",$width=null,$height=null)
	{
		$caption=" Month-wise beneficiary entries for current year ";
		$result=$this->_trnModel->getEmpAndSchmWishPayAndRecpQuery();

	/*	$strXML = "<graph caption='$caption' numberPrefix='' formatNumberScale='1' rotateValues='1' placeValuesInside='1' decimals='0' >";

		$strCategories = "<categories>";
		$strDataPymnt = "<dataset seriesName='Total Payment'>";
		$strDataRecp = "<dataset seriesName='Total Receipt'>";

		foreach($result as $row)
			$strCategories .="<category name='$row->EMP_SCHEME' />";
		$strCategories .= "</categories>";

		foreach($result as $row)
			$strDataPymnt .="<set value='$row->TOTAL_PAYMENT' />";
		$strDataPymnt .= "</dataset>";

		foreach($result as $row)
			$strDataRecp .="<set value='$row->TOTAL_RECEIPT' />";
		$strDataRecp .= "</dataset>";


   //Assemble the entire XML now
		$strXML .= $strCategories . $strDataPymnt . $strDataRecp . "</graph>";   */

		$strXML ='<graph xaxisname="Continent" yaxisname="Export" hovercapbg="DEDEBE" hovercapborder="889E6D" rotateNames="0" yAxisMaxValue="100" numdivlines="9" divLineColor="CCCCCC" divLineAlpha="80" decimalPrecision="0" showAlternateHGridColor="1" AlternateHGridAlpha="30" AlternateHGridColor="CCCCCC" caption="Global Export" subcaption="In Millions Tonnes per annum pr Hectare"><categories font="Arial" fontSize="11" fontColor="000000"><category name="N. America" hoverText="North America"/><category name="Asia"/><category name="Europe"/><category name="Australia"/><category name="Africa"/></categories><dataset seriesname="Rice" color="FDC12E"><set value="30"/><set value="26"/><set value="29"/><set value="31"/><set value="34"/></dataset><dataset seriesname="Wheat" color="56B9F9"><set value="67"/><set value="98"/><set value="79"/><set value="73"/><set value="80"/></dataset><dataset seriesname="Grain" color="C9198D"><set value="27"/><set value="25"/><set value="28"/><set value="26"/><set value="10"/></dataset></graph>';

		return $this->_chartModel->renderMSColumn3D($strXML, $id, $width, $height);
	}


	public function destroy()
	{
		unset($this->_trnModel,$this->_chartModel);
	}

}
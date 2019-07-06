<?php

class Bloomfi_NumericFormat 
{
	public function numFormat($number=0,$decimal=2,$thousandSeperator=null,$decimalPoint=null)
	{
		if(!$number) $number=0;
		return number_format($number,$decimal,$decimalPoint,$thousandSeperator);
	}
}

?>
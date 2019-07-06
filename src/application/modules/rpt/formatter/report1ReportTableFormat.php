<?php

/*
  ExternalTableFormat should be Y to refer the external format.
  Each label are mapped with @FLABEL?@
  Each value are mapped with @FVALUE?@

  Following is the map with report XML.

 <externalTableFormat>y</externalTableFormat>
 <tableheader>
	<label>Client Code</label> == @FLABEL1@
	<label>Collector Code</label> == @FLABEL2@
	<label>Project</label> == @FLABEL3@
	<label>Last Pay. Date </label> == @FLABEL4@
 </tableheader>
 <queryheader>
	 <item>CUSTOMER_ID</item> == @FVALUE1@
	 <item>EMPLOYEE_ID</item> == @FVALUE2@
	 <item>SCHEME_ID</item> == @FVALUE3@
	 <item>LAST_RECEIPT_DATE</item> == @FVALUE4@
 </queryheader>

*/

class modules_rpt_formatter_report1ReportTableFormat
{
	function report1()
	{
		$set['css']="
			<style type='text/css'>
				.inside
				{
					border:1px solid;
					padding:5px;
					line-height:20px;
					color:#999999;
					background:#EFEFEF;
				}
				.upper
				{
					margin:0 0 10px 0;
					border:1px solid #828282;
					padding:5px;
					background:#DDFBF8;
				}
			</style>
		";

		$set['js']=null;
		$set['html']="
			<div class='upper'>
				<b>@FLABEL1@</b> - @FVALUE1@ | <b>@FLABEL2@</b> - @FVALUE2@ | <b>@FLABEL3@</b> - @FVALUE3@ </b><br>
				<div class='inside'>
					<b>@FLABEL4@</b> - @FVALUE4@
				</div>
			</div>";

		return $set;
	}
}
?>
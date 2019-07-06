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

class modules_rpt_formatter_dtlcustReportTableFormat
{
	function dtlcust()
	{
		$set['css']="
			<style type='text/css'>
				.top-sec
				{
					margin:0;
					background:#fff;
				}
				.inside
				{
					border:1px solid;
					padding:5px;
					line-height:20px;
					background:#F5F5F5;
					color:#535353;
				}
				.upper
				{
					margin:0 0 10px 0;
					border:1px solid #828282;
					font-size:12px;
					padding:5px;
					background:#ECFDF3;
					color:#535353;
				}
			</style>
		";

		$set['js']=null;
		$set['html']="
			<div class='top-sec'>
			<div class='upper'>
				<b>@FLABEL1@</b> - @FVALUE1@ | <b>@FLABEL2@</b> - @FVALUE2@ | <b>@FLABEL3@</b> - @FVALUE3@
				| <b>@FLABEL4@</b> - @FVALUE4@ | <b>@FLABEL5@</b> - @FVALUE5@ | <b>@FLABEL6@</b> - @FVALUE6@
				<br> <b>@FLABEL7@</b> - @FVALUE7@
				<br>
				<div class='inside'>
					<b>@FLABEL8@</b> - @FVALUE8@ | <b>@FLABEL9@</b> - @FVALUE9@ | <b>@FLABEL10@</b> - @FVALUE10@ | <b>@FLABEL11@</b> - @FVALUE11@ | <br><b>@FLABEL12@</b> - @FVALUE12@ |
					<b>@FLABEL13@</b> - @FVALUE13@ | <b>@FLABEL14@</b> - @FVALUE14@ | <b>@FLABEL15@</b> - @FVALUE15@
				</div>
			</div>
			</div>";

		return $set;
	}
}
?>
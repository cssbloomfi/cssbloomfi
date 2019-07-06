<?php

class modules_rpt_formatter_dtlcust2ReportTableFormat
{
	function dtlcust2()
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
					background:#FBFBFF;
					color:#535353;
				}
				.internal-table
				{
					width:100%;
				}

				.internal-table tr td
				{
					background:#FFFFEA;
				}
			</style>
		";

		$set['js']=null;
		$set['html']="
			<div class='top-sec'>
			<div class='upper'>
				<table class='internal-table'>
					<tr class='normal'>
						<td class='normal'><b>@FLABEL1@</b></td><td>@FVALUE1@</td>
						<td class='normal'><b>@FLABEL2@</b></td><td>@FVALUE2@</td>
						<td class='normal'><b>@FLABEL3@</b></td><td>@FVALUE3@</td>
					</tr>

					<tr class='normal'>
						<td class='normal'><b>@FLABEL4@</b></td><td>@FVALUE4@</td>
						<td class='normal'><b>@FLABEL5@</b></td><td>@FVALUE5@</td>
						<td class='normal'><b>@FLABEL6@</b></td><td>@FVALUE6@</td>
					</tr>
					<tr class='normal'>
						<td class='normal' ><b>@FLABEL7@</b></td><td  colspan=5>@FVALUE7@</td>
					</tr>
				</table>
				<div class='inside'>
				    <h1>Account Details</h1><br>
					<b>@FLABEL8@</b> - @FVALUE8@ <br>
					<b>@FLABEL9@</b> - @FVALUE9@ <br>
					<b>@FLABEL10@</b> - @FVALUE10@ <br>
					<b>@FLABEL11@</b> - @FVALUE11@ <br>
					<b>@FLABEL12@</b> - @FVALUE12@ <br>
					<b>@FLABEL15@</b> - @FVALUE15@  <br>
					<b>@FLABEL13@</b> - @FVALUE13@ <br>
					<b>@FLABEL14@</b> - @FVALUE14@ <br>

				</div>
			</div>
			</div>";

		return $set;
	}
}
?>
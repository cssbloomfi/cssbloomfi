<?php

class modules_rpt_formatter_testReportTableFormat
{
	function test()
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
		$html=<<<HTML
			<div class='top-sec'>
			<div class='upper'>
				<table class='internal-table'>
					<tr class='normal'>

						<?php
						('@FVALUE1@'=='GENDER LOCATION TOTAL')
							{
								echo "'<td class='normal'><b>@FLABEL1@</b></td><td>@FVALUE1@</td>"; 
							}
						else echo "<td class='normal'></td>";
						
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
					<b>@FLABEL8@</b> - @FVALUE8@
					<b>@FLABEL9@</b> - @FVALUE9@
					<b>@FLABEL10@</b> - @FVALUE10@ 
				</div>
			</div>
			</div>
HTML;

		$set['html']=$html;

		return $set;
	}
}
?>
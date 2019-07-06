
<?php
class Zend_View_Helper_ShowXlsDownloadSection {
    function showXlsDownloadSection($result) {
		if($result) {
		echo '<div id="dialog" title="Save Report(s)">';
		echo '<div class="download-area-fix">';
		echo '<table class="zebra3">';
			$i=1;
			foreach($result as $xlsfile){
			  if($i==1) echo "<tr>";
			  $i++;
				echo '<td><a href="'.$xlsfile['url'].'">'.$xlsfile['url_name'].'</a></td>';
			  if($i==4) {
			   echo "</tr>";
			   $i=1;
			   }
			}
			   if($i>1) {	
			   while($i<4){
				echo "<td>&nbsp;</td>";
				$i++;}
			   echo "</tr>";
			   }
		echo '</table>';
		echo '</div></div>';

		$SCRIPT='<script type="text/javascript">
			$.fx.speeds._default = 500;
			$(function() {
				$("#dialog").dialog({
					show:"clip",	
					width:550,
					resizable:false,
					closeOnEscape: true,
					modal: true
				});
			});
			</script>';

		echo $SCRIPT;
		}
	}
}
?>
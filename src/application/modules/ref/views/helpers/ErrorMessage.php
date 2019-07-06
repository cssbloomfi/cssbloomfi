
<?php
class Zend_View_Helper_ErrorMessage {
    function ErrorMessage($error=null) {
		if(isset($error))
		{
			echo "<br><div class='errorbox'>";
			echo '<img src="/images/icons/cross_icon.png" width="10" height="10"> '.$error;
			echo "</div>";
		}
	}
}
?>
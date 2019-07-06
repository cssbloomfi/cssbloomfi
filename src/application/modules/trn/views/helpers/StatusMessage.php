<?php

class Zend_View_Helper_StatusMessage {
    function statusMessage($str) {
		echo "<div class='statusbox'>";
		echo '<br><img src="/images/icons/right_icon.png" width="16" height="16">'.$str;
		echo '</div>';
	}
}
?>
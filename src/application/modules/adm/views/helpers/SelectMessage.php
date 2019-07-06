
<?php
class Zend_View_Helper_SelectMessage {
    function selectMessage($options) {
		foreach($options as $val)
			echo '<br><img src="/images/icons/cross_icon.png" width="16" height="16"> '.$val;  
	}
}
?>
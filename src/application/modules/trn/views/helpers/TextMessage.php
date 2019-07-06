
<?php
class Zend_View_Helper_TextMessage {
    function TextMessage($options) {
		if(is_array($options))
		foreach($options as $val)
			echo '<img src="/images/icons/cross_icon.png" width="16" height="16"> '.$val .'<br>'; 
		else
			echo '<img src="/images/icons/cross_icon.png" width="16" height="16"> '.$options .'<br>'; 
	}
}
?>
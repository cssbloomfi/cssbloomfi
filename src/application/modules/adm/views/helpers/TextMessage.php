
<?php
class Zend_View_Helper_TextMessage {
    function TextMessage($errors) {
		foreach($errors as $error)
			echo '<br><img src="/images/icons/cross_icon.png" width="16" height="16"> '.$error; 
	}
}
?>
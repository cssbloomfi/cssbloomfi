
<?php
class Zend_View_Helper_SuccessMessage {
    function SuccessMessage($option) {
		if(!is_array($option))
			echo '<img src="/images/icons/success_icon.png" width="16" height="16">&nbsp;&nbsp; '.$option; 
		else{
			foreach($option as $msg)
				echo '<img src="/images/icons/success_icon.png" width="16" height="16">&nbsp;&nbsp; '.$msg.'<br>'; 
		}
	}
}
?>
<?php
class Zend_View_Helper_amountMessage {
    function amountMessage($val) {
			echo '<br><img src="/images/icons/cross_icon.png" width="16" height="16"> "'.$val.'" contains not a valid amount'; 
	}
}

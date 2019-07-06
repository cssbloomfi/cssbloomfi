<?php
class Zend_View_Helper_BaseUrl {
    function baseUrl() {
		/*
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
		return $baseUrl;
		*/
		$baseUrl=$_SERVER['HTTP_HOST'];
		return $baseUrl;

    }
}
?>

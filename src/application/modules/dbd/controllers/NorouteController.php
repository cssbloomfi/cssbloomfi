<?php
class NorouteController  extends Zend_Controller_Action 
{
    public function indexAction()
    {
        $content="";
		$content=<<<EOH
<h1>Error! 404</h1>
<p>The page you requested was not found.</p>
EOH;		

        // Clear previous content
        $this->getResponse()->clearBody();

        $this->view->content = $content;
		//$this->view->trace = $errors->message;
		//$this->view->error = $errors;
    }
}



<?php

class CustomerForm extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('Customer');

        $customerid = new Zend_Form_Element_Text('CUSTOMER_ID');
        $customerid->setLabel('Customer Id')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');

        $parentcustomerid = new Zend_Form_Element_Text('PARENT_CUSTOMER_ID');
        $parentcustomerid->setLabel('Parent Customer Id')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');

        $customername = new Zend_Form_Element_Text('CUSTOMER_NAME');
        $customername->setLabel('Customer Name')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');

        $id = new Zend_Form_Element_Hidden('ID');
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('ID', 'submitbutton');

        $this->addElements(array($id,$customerid, $customername, $parentcustomerid , $submit));

    }
}
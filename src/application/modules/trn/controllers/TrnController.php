<?php
class modules_trn_controllers_TrnController extends Zend_Controller_Action
{
	protected $_session;

	function _initialize(){
		$this->_session=Zend_Registry::get('SQL');
		$this->_session->actionHelp=false;
		$this->view->images=$this->_session->images;
		$this->view->theme=$this->_session->theme['activeTheme'];
		$this->view->themePath=$this->_session->theme['themePath'];
		$this->view->roleId=$this->_session->roleId;
		return $this->_session;
	}

	function getSession(){
		return $this->_session;
	}

	function arrangeKeyValue(&$array,$key=null,$value=null)
	{
		if(is_array($array)){
		foreach($array as $row)
			$arr[$row->$key]=$row->$value;
		 $array=$arr;
		}
	}

	function testPrint($data,$die=null)
	{
		echo "<br>---------------------------------<br>";
		print_r($data);
		echo "<br>---------------------------------<br>";
		if($die) die($die);
	}

	public function getDataForXls(&$class,$funtion,$params=null,$rows=5000,$start=0)
	{
		$this->_helper->layout->disableLayout();
		$start=$this->_request->getParam('start');
		$this->view->fileno=$this->_request->getParam('file');
		$rows=5000;
		$data = array($start,$rows);
		if($params && is_array($params)) $data = array_merge((array)$params,(array)$data);
		//print_r($data);
		$result=$class->$funtion($data);
		return $result;
	}

	protected function getReceiptAmountValueSet($recv_types,$amount,$data)
	{
		$total_recept_amount=$total_recept_due=$total_recept_security_depos=$total_recept_donation=$total_recept_fees=0;

		//CAPITAL_RECEIVED
		if($data[0]==$recv_types[0]->VALUE_NAME)
		{
			$total_recept_amount=$data[1]+$amount;
			$total_recept_due=$data[2]-$amount;
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5];
		}

		//BSD_RECEIVED
		if($data[0]==$recv_types[1]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3]+$amount;
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5];
		}

		//DONATION_RECEIVED
		if($data[0]==$recv_types[2]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4]+$amount;
			$total_recept_fees=$data[5];
		}

		//PROCESSING_FEES
		if($data[0]==$recv_types[3]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5]+$amount;
		}

		$amountSet=array($total_recept_amount, $total_recept_due,$total_recept_security_depos, $total_recept_donation, $total_recept_fees);

		return $amountSet;
	}

protected function getRollBackedReceiptAmountValueSet($recv_types,$amount,$data)
	{
		//CAPITAL_RECEIVED
		if($data[0]==$recv_types[0]->VALUE_NAME)
		{
			$total_recept_amount=$data[1]-$amount;
			$total_recept_due=$data[2]+$amount;
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5];
		}

		//BSD_RECEIVED
		if($data[0]==$recv_types[1]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3]-$amount;
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5];
		}

		//DONATION_RECEIVED
		if($data[0]==$recv_types[2]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4]-$amount;
			$total_recept_fees=$data[5];
		}

		//PROCESSING_FEES
		if($data[0]==$recv_types[3]->VALUE_NAME)
		{
			$total_recept_amount=$data[1];
			$total_recept_due=$data[2];
			$total_recept_security_depos=$data[3];
			$total_recept_donation=$data[4];
			$total_recept_fees=$data[5]-$amount;
		}

		$amountSet=array($total_recept_amount, $total_recept_due,$total_recept_security_depos, $total_recept_donation, $total_recept_fees);

		return $amountSet;
	}

	protected function _getUser()
	{
		$auth = Zend_Auth::getInstance();
		$user=$auth->getIdentity();
		return $user->USER_ID;
	}

}

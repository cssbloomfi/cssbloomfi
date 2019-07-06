 <?php
class modules_com_transaction_payRecInDiffTypes extends
modules_com_transaction_AbstractTransactionComponent
{
	public function __construct()
	{

		parent::__construct();
	}

	

	public function payRecInDiffTypes($id="payRecInDiffTypes",$width=null,$height=null)
	{
		$caption="Payment and Receipt in different types";
		$result=$this->_trnModel->getPaymentReceiptInDiffTypesQuery();
		$strXML = "<chart caption='Payment and receipt in different types' numberPrefix='' formatNumberScale='0'>";
			foreach($result as $row){
			$strXML .= "<set label='" . $row->PAYMENT_RECEIPT_TYPE . "' value='" . $row->PAYMENT_RECEIPT_TOTAL . "' />";
			}
		$strXML .= "</chart>";
		$comp['component']=$this->_chartModel->renderColumn3D($strXML, $id, $width, $height);
		$comp['title']=$caption;
		return $comp;

	}


	public function destroy()
	{
		unset($this->_trnModel,$this->_chartModel);
	}

}
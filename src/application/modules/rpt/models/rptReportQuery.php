<?php

require_once "Zend/Db.php";

class modules_rpt_models_rptReportQuery extends Bloomfi_App_Ulibrary
{
	protected  $db;

	public function __construct()
	{
		$this->db =  new Bloomfi_SqlUtil;
		$this->defineReportXmlLibrary();
	}

	public function destroy()
	{
		unset($this->db);
	}

	public function defineReportXmlLibrary()
	{
		//XML Library file for Memo Report ( 1.1 Daily Summary Memo Report )
		if(!defined('DLY_SMRY_MEMO_LIBRARY')) {
			define('DLY_SMRY_MEMO_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dlysmrymemoReportLibrary.xml");
		}

		//XML Library file for Memo Report (1.2 Weekly Summary Memo Report )
		if(!defined('WKLY_SMRY_MEMO_LIBRARY')) {
			define('WKLY_SMRY_MEMO_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/wklysmrymemoReportLibrary.xml");
		}

		//XML Library file for Memo Report (1.3 Monthly Summary Memo Report )
		if(!defined('MNTH_SMRY_MEMO_LIBRARY')) {
			define('MNTH_SMRY_MEMO_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/mnthsmrymemoReportLibrary.xml");
		}

		//XML Library file for Memo Report (1.4 Daily Details Memo Report)
		if(!defined('DLY_DTLS_MEMO_LIBRARY')) {
			define('DLY_DTLS_MEMO_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dlydtlsmemoReportLibrary.xml");
		}

		//XML Library file for Voucher Report (2.1 Daily Summary Voucher Report)
		if(!defined('DLY_SMRY_VCHR_LIBRARY')) {
			define('DLY_SMRY_VCHR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dlysmryvchrReportLibrary.xml");
		}

		//XML Library file for Voucher Report (2.2 Weekly Summary Voucher Report)
		if(!defined('WKLY_SMRY_VCHR_LIBRARY')) {
			define('WKLY_SMRY_VCHR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/wklysmryvchrReportLibrary.xml");
		}

		//XML Library file for Voucher Report (2.3 Monthly Summary Voucher Report)
		if(!defined('MNTH_SMRY_VCHR_LIBRARY')) {
			define('MNTH_SMRY_VCHR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/mnthsmryvchrReportLibrary.xml");
		}

		//XML Library file for Voucher Report (2.4 Daily Details Voucher Report)
		if(!defined('DLY_DTLS_VCHR_LIBRARY')) {
			define('DLY_DTLS_VCHR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dlydtlsvchrReportLibrary.xml");
		}

		//XML Library file for Collector Activity Report (3.1 Collector Summary Activity Reports)
		if(!defined('COLL_SMRY_ACT_LIBRARY')) {
			define('COLL_SMRY_ACT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/collsmryactReportLibrary.xml");
		}

		//XML Library file for Collector Activity Report (3.2 Collector / Location Summary Activity Reports)
		if(!defined('COLL_LOC_SMRY_ACT_LIBRARY')) {
			define('COLL_LOC_SMRY_ACT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/colllocsmryactReportLibrary.xml");
		}

		//XML Library file for Collector Activity Report (3.3 Collector / Location / Gender Summary Activity Reports)
		if(!defined('COLL_LOC_GNDR_SMRY_ACT_LIBRARY')) {
			define('COLL_LOC_GNDR_SMRY_ACT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/colllocgndrsmryactReportLibrary.xml");
		}

		//XML Library file for Collector Activity Report (3.4 Collector / Location / Gender Details Activity Reports)
		if(!defined('COLL_LOC_GNDR_DTLS_ACT_LIBRARY')) {
			define('COLL_LOC_GNDR_DTLS_ACT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/colllocgndrdtlsactReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.1 Collector Top Sheet Reports)
		if(!defined('COLL_TOP_SHT_LIBRARY')) {
			define('COLL_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/colltopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.2 Scheme Top Sheet Reports)
		if(!defined('SCHM_TOP_SHT_LIBRARY')) {
			define('SCHM_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/schmtopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.3 Location Top Sheet Reports)
		if(!defined('LOC_TOP_SHT_LIBRARY')) {
			define('LOC_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/loctopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.4 Week Top Sheet Reports)
		if(!defined('WEEK_TOP_SHT_LIBRARY')) {
			define('WEEK_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/weektopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.5 Month Top Sheet Reports)
		if(!defined('MNTH_TOP_SHT_LIBRARY')) {
			define('MNTH_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/mnthtopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.6 Detailed Top Sheet Reports)
		if(!defined('DTL_TOP_SHT_LIBRARY')) {
			define('DTL_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dtltopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.7 Account Type Top Sheet Reports)
		if(!defined('ACNT_TYP_TOP_SHT_LIBRARY')) {
			define('ACNT_TYP_TOP_SHT_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/acnttyptopshtReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.2 Scheme Top Sheet Reports)
		if(!defined('DTL_CUST_LIBRARY')) {
			define('DTL_CUST_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dtlcustReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.2 Scheme Top Sheet Reports) 2nd
		if(!defined('DTL_CUST2_LIBRARY')) {
			define('DTL_CUST2_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dtlcust2ReportLibrary.xml");
		}

		//XML Library file for Top Sheet Report ( 4.2 Scheme Top Sheet Reports) default
		if(!defined('DTL_CUST3_LIBRARY')) {
			define('DTL_CUST3_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/dtlcust3ReportLibrary.xml");
		}

		//XML Library file for Par Report (7.1 Collector PAR Reports)
		if(!defined('COLL_PAR_LIBRARY')) {
			define('COLL_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/collparReportLibrary.xml");
		}

		//XML Library file for Par Report (7.2 Collector/Scheme PAR Reports)
		if(!defined('COLL_SCHM_PAR_LIBRARY')) {
			define('COLL_SCHM_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/collschmparReportLibrary.xml");
		}

		//XML Library file for Par Report (7.3 Collector/Scheme/Location PAR Reports)
		if(!defined('COLL_SCHM_LOC_PAR_LIBRARY')) {
			define('COLL_SCHM_LOC_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/collschmlocparReportLibrary.xml");
		}

		//XML Library file for Par Report (7.4 Scheme PAR Reports)
		if(!defined('SCHM_PAR_LIBRARY')) {
			define('SCHM_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/schmparReportLibrary.xml");
		}

		//XML Library file for Par Report (7.5 Location PAR Reports)
		if(!defined('LOC_PAR_LIBRARY')) {
			define('LOC_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/locparReportLibrary.xml");
		}

		//XML Library file for Par Report (7.6 Gender PAR Reports)
		if(!defined('GNDR_PAR_LIBRARY')) {
			define('GNDR_PAR_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/gndrparReportLibrary.xml");
		}

		//XML Library file for MIS Report (8.1 Month Wise Payment Receipt)
		if(!defined('MNTH_PYMT_REC_MIS_LIBRARY')) {
			define('MNTH_PYMT_REC_MIS_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/mnthpymtrecmisReportLibrary.xml");
		}

		//XML Library file for MIS Report (8.2 Location Wise Payment Receipt)
		if(!defined('LOC_PYMT_REC_MIS_LIBRARY')) {
			define('LOC_PYMT_REC_MIS_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/locpymtrecmisReportLibrary.xml");
		}

		//XML Library file for MIS Report (8.3 Scheme Wise Payment Receipt)
		if(!defined('SCHM_PYMT_REC_MIS_LIBRARY')) {
			define('SCHM_PYMT_REC_MIS_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/schmpymtrecmisReportLibrary.xml");
		}

		//XML Library file for MIS Report (8.4 Gender Wise Payment Receipt)
		if(!defined('GNDR_PYMT_REC_MIS_LIBRARY')) {
			define('GNDR_PYMT_REC_MIS_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/gndrpymtrecmisReportLibrary.xml");
		}

		//XML Library file for Operetional Report (9.1  BSD)
		if(!defined('BSD_LIBRARY')) {
			define('BSD_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/bsdReportLibrary.xml");
		}

		//XML Library file for Operetional Report (9.2 Collector Payment Recept)
		if(!defined('COLL_PAY_REC_LIBRARY')) {
			define('COLL_PAY_REC_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/collpayrecReportLibrary.xml");
		}

		//XML Library file for Operetional Report ( Test )
		if(!defined('CUST_LOC_LIBRARY')) {
			define('CUST_LOC_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/custlocReportLibrary.xml");
		}
		//XML Library file for future date entry (payment)
		if(!defined('FUTURE_PAY_DATE_LIBRARY')) {
			define('FUTURE_PAY_DATE_LIBRARY', ROOT_DIR . "/application/modules/rpt/models/query/fupaydateReportLibrary.xml");
		}

		//XML Library file for future date entry (receipt)
		if(!defined('FUTURE_REC_DATE_LIBRARY')) {
			define('FUTURE_REC_DATE_LIBRARY', ROOT_DIR .
			"/application/modules/rpt/models/query/furecdateReportLibrary.xml");
		}

		//XML Library file for client details schedule
		if(!defined('CSS_CUST_DTL_SCHEDULE_LIBRARY')) {
			define('CSS_CUST_DTL_SCHEDULE_LIBRARY', ROOT_DIR .
			"/application/modules/rpt/models/query/csscustdtlschdlReportLibrary.xml");
		}
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to print the content of query library
		------------------------------------------------------------------------
	*/
	public  function printQueryLibrary()
    {

	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
	  foreach ($querylibrary->query as $query)
		  {
		  printf("Query Id     : %s\n", $query['id']);
		  printf("Query Title  : %s\n", $query->title);
		  printf("Query Content: %s\n", $query->content);
	      }
       return null;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the content of query
		------------------------------------------------------------------------
	*/
	public  function getQueryContent($queryid)
    {
	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
	  foreach ($querylibrary->query as $query)
		  {
		  if ( $query['id'] == $queryid )
			  {
			  return $query->content;
			  }
	      }
       return null;
	}

    /*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the content of query
		------------------------------------------------------------------------
	*/
	public  function getQueryTitle($queryid)
    {
	  $querylibrary = simplexml_load_file(BSD_QUERY_LIB);
	  foreach ($querylibrary->query as $query)
		  {
		  if ( $query['id'] == $queryid )
			  {
				return $query->title;
			  }
	      }
       return null;
	}

	/*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the parameters of query
		------------------------------------------------------------------------
	*/
	public  function getQueryParams($queryid)
    {
	  $querythisrary = simplexml_load_file(BSD_QUERY_LIB);
	  foreach ($querythisrary->query as $query)
		  if ( $query['id'] == $queryid )
				return $query->params;

       return null;
	}

	/*
		------------------------------------------------------------------------
	    GENERIC FUNCTION
		Function to get the parameters of query
		------------------------------------------------------------------------
	*/
	public  function getQueryTags($xmlfile=null,$queryid)
    {
	  $querylibrary = simplexml_load_file($xmlfile);
	 // print_r($querylibrary);
	  foreach ($querylibrary->query as $query) {
		 // print_r($query);
		  if ( $query['id'] == $queryid )
				return $query;

	  }
       return null;
	}

   /*================================ REPORT FUNCTIONS ============================================*/

	//Function to read XML Library file for Memo Report ( 1.1 Daily Summary Memo Report )
	public function getDlySmryMemoXml()
	{
		$sqlId='dlySmryMemo';
		return $this->getQueryTags(DLY_SMRY_MEMO_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Memo Report ( 1.2 Weekly Summary Memo Report )
	public function getWklySmryMemoXml()
	{
		$sqlId='wklySmryMemo';
		return $this->getQueryTags(WKLY_SMRY_MEMO_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Memo Report ( 1.3 Monthly Summary Memo Report )
	public function getMnthSmryMemoXml()
	{
		$sqlId='mnthSmryMemo';
		return $this->getQueryTags(MNTH_SMRY_MEMO_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Memo Report ( 1.4 Daily Details Memo Report )
	public function getDlyDtlsMemoXml()
	{
		$sqlId='dlyDtlsMemo';
		return $this->getQueryTags(DLY_DTLS_MEMO_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Voucher Report (2.1 Daily Summary Voucher Report)
	public function getDlySmryVchrXml()
	{
		$sqlId='dlySmryVchr';
		return $this->getQueryTags(DLY_SMRY_VCHR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Voucher Report (2.2 Weekly Summary Voucher Report)
	public function getWklySmryVchrXml()
	{
		$sqlId='wklySmryVchr';
		return $this->getQueryTags(WKLY_SMRY_VCHR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Voucher Report (2.3 Monthly Summary Voucher Report)
	public function getMnthSmryVchrXml()
	{
		$sqlId='mnthSmryVchr';
		return $this->getQueryTags(MNTH_SMRY_VCHR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Voucher Report (2.4 Daily Details Voucher Report)
	public function getDlyDtlsVchrXml()
	{
		$sqlId='dlyDtlsVchr';
		return $this->getQueryTags(DLY_DTLS_VCHR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Collector Report (3.1 Collector Summary Activity Reports)
	public function getCollSmryActXml()
	{
		$sqlId='collSmryAct';
		return $this->getQueryTags(COLL_SMRY_ACT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Collector Report (3.2 Collector / Location Summary Activity Reports)
	public function getCollLocSmryActXml()
	{
		$sqlId='collLocSmryAct';
		return $this->getQueryTags(COLL_LOC_SMRY_ACT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Collector Report (3.3 Collector / Location / Gender Summary Activity Reports)
	public function getCollLocGndrSmryActXml()
	{
		$sqlId='collLocGndrSmryAct';
		return $this->getQueryTags(COLL_LOC_GNDR_SMRY_ACT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Collector Report (3.4 Collector / Location / Gender Details Activity Reports)
	public function getCollLocGndrDtlsActXml()
	{
		$sqlId='collLocGndrDtlsAct';
		return $this->getQueryTags(COLL_LOC_GNDR_DTLS_ACT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.1 Collector Top Sheet Reports)
	public function getCollTopShtXml()
	{
		$sqlId='collTopSht';
		return $this->getQueryTags(COLL_TOP_SHT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.2 Scheme Top Sheet Reports)
	public function getSchmTopShtXml()
	{
		$sqlId='schmTopSht';
		return $this->getQueryTags(SCHM_TOP_SHT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.3 Location Top Sheet Reports)
	public function getLocTopShtXml()
	{
		$sqlId='locTopSht';
		return $this->getQueryTags(LOC_TOP_SHT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.4 Week Top Sheet Reports)
	public function getWeekTopShtXml()
	{
		$sqlId='weekTopSht';
		return $this->getQueryTags(WEEK_TOP_SHT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.5 Month Top Sheet Reports)
	public function getMnthTopShtXml()
	{
		$sqlId='mnthTopSht';
		return $this->getQueryTags(MNTH_TOP_SHT_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Top Sheet Report (  4.6 Detailed Top Sheet Reports)
	public function getDtlTopShtXml()
	{
		$sqlId='dtlTopSht';
		return $this->getQueryTags(DTL_TOP_SHT_LIBRARY,$sqlId);
	}

	public function getAcntTypTopShtXml()
	{
		$sqlId='acntTypTopSht';
		return $this->getQueryTags(ACNT_TYP_TOP_SHT_LIBRARY,$sqlId);
	}


	public function getDtlCustXml()
	{
		$sqlId='dtlCust';
		return $this->getQueryTags(DTL_CUST_LIBRARY,$sqlId);
	}

	public function getDtlCust2Xml()
	{
		$sqlId='dtlCust2';
		return $this->getQueryTags(DTL_CUST2_LIBRARY,$sqlId);
	}

	public function getDtlCust3Xml()
	{
		$sqlId='dtlCust3';
		return $this->getQueryTags(DTL_CUST3_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.1 Collector PAR Reports)
	public function getCollParXml()
	{
		$sqlId='collPar';
		return $this->getQueryTags(COLL_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.2 Collector/Scheme PAR Reports)
	public function getCollSchmParXml()
	{
		$sqlId='collSchmPar';
		return $this->getQueryTags(COLL_SCHM_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.3 Collector/Scheme/Location PAR Reports)
	public function getCollSchmLocParXml()
	{
		$sqlId='collSchmLocPar';
		return $this->getQueryTags(COLL_SCHM_LOC_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.4 Scheme PAR Reports)
	public function getSchmParXml()
	{
		$sqlId='schmPar';
		return $this->getQueryTags(SCHM_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.5 Location PAR Reports)
	public function getLocParXml()
	{
		$sqlId='locPar';
		return $this->getQueryTags(LOC_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report (  7.6 Gender PAR Reports)
	public function getGndrParXml()
	{
		$sqlId='gndrPar';
		return $this->getQueryTags(GNDR_PAR_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report ( 8.1 Month Wise Payment Receipt)
	public function getMnthPymtRecMisXml()
	{
		$sqlId='mnthPymtRecMis';
		return $this->getQueryTags(MNTH_PYMT_REC_MIS_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report ( 8.2 Location Wise Payment Receipt)
	public function getLocPymtRecMisXml()
	{
		$sqlId='locPymtRecMis';
		return $this->getQueryTags(LOC_PYMT_REC_MIS_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report ( 8.3 Scheme Wise Payment Receipt)
	public function getSchmPymtRecMisXml()
	{
		$sqlId='schmPymtRecMis';
		return $this->getQueryTags(SCHM_PYMT_REC_MIS_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Par Report ( 8.4 Gender Wise Payment Receipt)
	public function getGndrPymtRecMisXml()
	{
		$sqlId='gndrPymtRecMis';
		return $this->getQueryTags(GNDR_PYMT_REC_MIS_LIBRARY,$sqlId);
	}


	//Function to read XML Library file for Operational Report (9.1 BSD)
	public function getBsdXml()
	{
		$sqlId='bsd';
		return $this->getQueryTags(BSD_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Operational Report (9.2 Collector Payment Recept)
	public function getCollPayRecXml()
	{
		$sqlId='collPayRec';
		return $this->getQueryTags(COLL_PAY_REC_LIBRARY,$sqlId);
	}

	//Function to read XML Library file for Operational Report
	public function getCustLocXml()
	{
		$sqlId='custloc';
		return $this->getQueryTags(CUST_LOC_LIBRARY,$sqlId);
	}

	public function getFuPayDateXml()
	{
		$sqlId='fupaydate';
		return $this->getQueryTags(FUTURE_PAY_DATE_LIBRARY,$sqlId);
	}

	public function getFuRecDateXml()
	{
		$sqlId='furecdate';
		return $this->getQueryTags(FUTURE_REC_DATE_LIBRARY,$sqlId);
	}

	public function getCssCustDtlSchdlXml()
	{
		$sqlId='custDtlSchdl';
		return $this->getQueryTags(CSS_CUST_DTL_SCHEDULE_LIBRARY,$sqlId);
	}

}

-- MySQL dump 10.13  Distrib 8.0.14, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: css_test_clean
-- ------------------------------------------------------
-- Server version	8.0.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ltr_trn_details`
--

DROP TABLE IF EXISTS `ltr_trn_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ltr_trn_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRAN_DETAILS_ID` varchar(20) DEFAULT NULL,
  `TRAN_SUMMARY_ID` varchar(20) DEFAULT NULL,
  `SCHEME_ID` varchar(20) DEFAULT NULL,
  `CUSTOMER_ID` varchar(20) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `BUSINESS_ENTITY_ID` varchar(20) DEFAULT NULL,
  `PAYMENT_RECEIPT_FLAG` varchar(1) DEFAULT NULL,
  `PAYMENT_AMOUNT` double(18,6) DEFAULT '0.000000',
  `PAYMENT_TYPE` varchar(20) DEFAULT NULL,
  `RECEIPT_AMOUNT` double(18,6) DEFAULT '0.000000',
  `RECEIPT_TYPE` varchar(20) DEFAULT NULL,
  `VOUCHER_NO` varchar(40) DEFAULT NULL,
  `MEMO_NO` varchar(40) DEFAULT NULL,
  `TRANSACTION_CCY` double(18,6) DEFAULT '0.000000',
  `REMARKS` mediumtext,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TRANSACTION_DATE` date DEFAULT NULL,
  `CUSTOM_COMMENT1` varchar(40) DEFAULT NULL,
  `CUSTOM_COMMENT2` varchar(40) DEFAULT NULL,
  `CUSTOM_COMMENT3` varchar(40) DEFAULT NULL,
  `CUSTOM_COMMENT4` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_LTD_TRAN_SUMMARY_ID` (`TRAN_SUMMARY_ID`),
  KEY `I_LTD_TRAN_DETAILS_ID` (`TRAN_DETAILS_ID`),
  KEY `I_LTD_VOUCHER` (`VOUCHER_NO`),
  KEY `I_LTD_MEMO` (`MEMO_NO`),
  KEY `I_LTD_CUSTOMER_ID` (`CUSTOMER_ID`),
  KEY `I_LTD_EMPLOYEE_ID` (`EMPLOYEE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=941650 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ltr_trn_details`
--

LOCK TABLES `ltr_trn_details` WRITE;
/*!40000 ALTER TABLE `ltr_trn_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ltr_trn_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ltr_trn_summary`
--

DROP TABLE IF EXISTS `ltr_trn_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ltr_trn_summary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRAN_SUMMARY_ID` varchar(20) DEFAULT NULL,
  `SCHEME_ID` varchar(20) DEFAULT NULL,
  `CUSTOMER_ID` varchar(20) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `BUSINESS_ENTITY_ID` varchar(20) DEFAULT NULL,
  `TOTAL_PAYMENT_PRINCIPAL` double(18,6) DEFAULT '0.000000',
  `TOTAL_PAYMENT_DUE_PRINCIPAL` double(18,6) DEFAULT '0.000000',
  `TOTAL_PAYMENT_INTEREST` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_PRINCIPAL` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_DUE_PRINCIPAL` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_INTEREST` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_DONATION` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_FEES` double(18,6) DEFAULT '0.000000',
  `TOTAL_PAYMENT_SECURITY_DEPOSITE` double(18,6) DEFAULT '0.000000',
  `TOTAL_RECEIPT_SECURITY_DEPOSITE` double(18,6) DEFAULT '0.000000',
  `TRANSACTION_CCY` double(18,6) DEFAULT '0.000000',
  `REMARKS` mediumtext,
  `ACTIVE_STATUS` varchar(20) DEFAULT 'OPEN',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `START_DATE` date DEFAULT NULL,
  `LATEST_DATE` date DEFAULT NULL,
  `TOTAL_DETAILS` int(5) DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `I_LTS_TRAN_SUMMARY_ID` (`TRAN_SUMMARY_ID`),
  KEY `I_LTS_EMPLOYEE_ID` (`EMPLOYEE_ID`),
  KEY `I_LTS_CUSTOMER_ID` (`CUSTOMER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=158550 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ltr_trn_summary`
--

LOCK TABLES `ltr_trn_summary` WRITE;
/*!40000 ALTER TABLE `ltr_trn_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `ltr_trn_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_app_status`
--

DROP TABLE IF EXISTS `mst_app_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `mst_app_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SECTION` varchar(30) DEFAULT NULL,
  `ACTIVITY_STATUS` varchar(20) DEFAULT 'NORMAL',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `START_DATE` date DEFAULT NULL,
  `LATEST_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_app_status`
--

LOCK TABLES `mst_app_status` WRITE;
/*!40000 ALTER TABLE `mst_app_status` DISABLE KEYS */;
INSERT INTO `mst_app_status` VALUES (1,'PAY-SUMMARY','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:55:42',NULL,NULL);
INSERT INTO `mst_app_status` VALUES (2,'PAY-DETAILS','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:55:42',NULL,NULL);
INSERT INTO `mst_app_status` VALUES (3,'BENEFICIARY','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:55:42',NULL,NULL);
INSERT INTO `mst_app_status` VALUES (4,'COLLECTOR','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 00:11:33',NULL,NULL);
INSERT INTO `mst_app_status` VALUES (5,'LOCATION','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 00:11:38',NULL,NULL);
INSERT INTO `mst_app_status` VALUES (6,'SCHEME','NORMAL','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 00:11:50',NULL,NULL);
/*!40000 ALTER TABLE `mst_app_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_access_role_appln_resource`
--

DROP TABLE IF EXISTS `ref_join_access_role_appln_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_access_role_appln_resource` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ACCESS_ROLE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `APPLICATION_RESOURCE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_access_role_appln_resource`
--

LOCK TABLES `ref_join_access_role_appln_resource` WRITE;
/*!40000 ALTER TABLE `ref_join_access_role_appln_resource` DISABLE KEYS */;
INSERT INTO `ref_join_access_role_appln_resource` VALUES (31,'ROLE2','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (32,'ROLE2','ref','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (33,'ROLE2','rpt','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (35,'ROLE2','ref_employee','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (37,'ROLE2','trn','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (38,'ROLE2','trn_payment','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (39,'ROLE2','trn_receive','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (40,'ROLE2','ref_location','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (41,'ROLE2','ref_scheme','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (42,'ROLE6','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (49,'ROLE6','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (50,'ROLE3','ref','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (51,'ROLE3','ref_employee','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (52,'ROLE4','trn_excel','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (53,'ROLE4','trn_receive','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (54,'ROLE4','trn_payment','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (55,'ROLE4','trn','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (56,'ROLE4','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (57,'ROLE3','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (58,'ROLE3','ref_location','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (59,'ROLE3','ref_scheme','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (67,'ROLE5','dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (68,'ROLE2','ref_customer','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (69,'ROLE3','ref_customer','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:21:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (72,'ROLE6','ref_customer','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:47:41');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (73,'ROLE6','ref_employee','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:47:43');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (74,'ROLE6','ref_scheme','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:47:45');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (75,'ROLE6','ref_location','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:47:46');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (76,'ROLE6','trn_payment','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:48:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (77,'ROLE6','trn_receive','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 10:48:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (172,'ROLE6','dbd_chart_comp_U5','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-30 15:26:03');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (177,'ROLE6','dbd_chartmis','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-27 21:28:48');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (297,'','dbd','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (298,'','ref','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (299,'','ref_customer','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (300,'','ref_employee','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (301,'','ref_location','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (302,'','ref_scheme','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (303,'','ref_multicust','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:53');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (304,'','ref_multicoll','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 20:18:54');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (512,'RECEIVE_ENTRY_ROLE','dbd','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:33');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (513,'RECEIVE_ENTRY_ROLE','trn','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (514,'RECEIVE_ENTRY_ROLE','trn_receive','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (515,'RECEIVE_ENTRY_ROLE','trn_multirec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (516,'RECEIVE_ENTRY_ROLE','rpt','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (517,'RECEIVE_ENTRY_ROLE','css_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (518,'RECEIVE_ENTRY_ROLE','rpt_csscustdtlschdl','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:34');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (519,'RECEIVE_ENTRY_ROLE','rpt_custloc','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:35');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (520,'RECEIVE_ENTRY_ROLE','rpt_bsd','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:35');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (521,'RECEIVE_ENTRY_ROLE','operational_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:35');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (522,'RECEIVE_ENTRY_ROLE','rpt_collpayrec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:12:35');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (624,'ROLE1','dbd','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:23');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (625,'ROLE1','ref','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:23');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (626,'ROLE1','ref_customer_group','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:23');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (627,'ROLE1','ref_customer','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:23');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (628,'ROLE1','ref_deleted_customer','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:23');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (629,'ROLE1','ref_collector_group','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (630,'ROLE1','ref_employee','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (631,'ROLE1','ref_location_group','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (632,'ROLE1','ref_location','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (633,'ROLE1','ref_multilocation','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (634,'ROLE1','ref_scheme_group','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (635,'ROLE1','ref_scheme','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (636,'ROLE1','trn','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (637,'ROLE1','trn_payment','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (638,'ROLE1','trn_receive','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (639,'ROLE1','trn_multipaycust','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (640,'ROLE1','trn_multipaycust2','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (641,'ROLE1','trn_multipay','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (642,'ROLE1','trn_multirec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (643,'ROLE1','dbd_index_excelupload','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (644,'ROLE1','ref_customerexcel','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (645,'ROLE1','ref_customerexcel_custexport','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (646,'ROLE1','trn_excel','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (647,'ROLE1','trn_excel_transexport','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (648,'ROLE1','trn_custpayexcel','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:24');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (649,'ROLE1','rpt','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (650,'ROLE1','css_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (651,'ROLE1','rpt_csscustdtlschdl','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (652,'ROLE1','rpt_custloc','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (653,'ROLE1','rpt_bsd','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (654,'ROLE1','rpt_outstandingscdl','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (655,'ROLE1','rpt_cssmislocpayrec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (656,'ROLE1','rpt_cssmisprojpayrec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (657,'ROLE1','operational_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (658,'ROLE1','rpt_collpayrec','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (659,'ROLE1','exception_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (660,'ROLE1','rpt_collexception','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (661,'ROLE1','rpt_fupaydate','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (662,'ROLE1','rpt_furecdate','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (663,'ROLE1','memo_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (664,'ROLE1','rpt_dlysmrymemo','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (665,'ROLE1','rpt_wklysmrymemo','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (666,'ROLE1','rpt_mnthsmrymemo','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (667,'ROLE1','mis_report','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (668,'ROLE1','rpt_mnthpymtrecmis','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (669,'ROLE1','rpt_locpymtrecmis','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:25');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (670,'ROLE1','rpt_schmpymtrecmis','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (671,'ROLE1','rpt_gndrpymtrecmis','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (672,'ROLE1','dbd_index_mgmtinfsys','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (673,'ROLE1','dbd_chartmis','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (674,'ROLE1','adm','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (675,'ROLE1','adm_useraccesscontrol','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (676,'ROLE1','adm_usercreation','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (677,'ROLE1','adm_rolecreation','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (678,'ROLE1','adm_maproletouser','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (679,'ROLE1','adm_mapmenutorole','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (680,'ROLE1','adm_compacc_control','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (681,'ROLE1','adm_compscreen','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (682,'ROLE1','adm_compaccess','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (683,'ROLE1','adm_fin_year','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (684,'ROLE1','adm_finyear','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (685,'ROLE1','adm_logmanagement','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (686,'ROLE1','adm_custxlslogmanagement','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:26');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (687,'ROLE1','adm_tranxlslogmanagement','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:27');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (688,'ROLE1','adm_custpayxlslogmangmnt','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:27');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (689,'ROLE1','adm_logfilemanagement','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:27');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (690,'ROLE1','adm_bkuprecovr','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:27');
INSERT INTO `ref_join_access_role_appln_resource` VALUES (691,'ROLE1','adm_bkuprecovr_1','NORMAL','admin','0000-00-00 00:00:00',NULL,'2013-07-30 02:27:27');
/*!40000 ALTER TABLE `ref_join_access_role_appln_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_access_role_user`
--

DROP TABLE IF EXISTS `ref_join_access_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_access_role_user` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ACCESS_ROLE_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `USER_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_access_role_user`
--

LOCK TABLES `ref_join_access_role_user` WRITE;
/*!40000 ALTER TABLE `ref_join_access_role_user` DISABLE KEYS */;
INSERT INTO `ref_join_access_role_user` VALUES (1,'ROLE1','admin','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (2,'ROLE2','userone','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (3,'ROLE3','usertwo','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (4,'ROLE4','userthree','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (5,'ROLE5','userfour','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (6,'ROLE6','userfive','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 11:02:01');
INSERT INTO `ref_join_access_role_user` VALUES (10,'ROLE6','userro','NORMAL','admin','0000-00-00 00:00:00',NULL,'2010-08-28 14:20:36');
INSERT INTO `ref_join_access_role_user` VALUES (13,'SM ROLE','SM1','NORMAL','admin','0000-00-00 00:00:00',NULL,'2010-10-30 20:19:41');
INSERT INTO `ref_join_access_role_user` VALUES (15,'role10','jalajjha','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-13 19:25:45');
INSERT INTO `ref_join_access_role_user` VALUES (16,'ROLE5','xxxONE','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-14 13:23:02');
INSERT INTO `ref_join_access_role_user` VALUES (17,'TEST_ROLE_ONE','TestUserTest','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-04-14 16:51:44');
INSERT INTO `ref_join_access_role_user` VALUES (18,'RECEIVE_ENTRY_ROLE','biswajit','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:11:28');
/*!40000 ALTER TABLE `ref_join_access_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_business_entity_group`
--

DROP TABLE IF EXISTS `ref_join_business_entity_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_business_entity_group` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `BUSINESS_ENTITY_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BUSINESS_ENTITY_GROUP_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_business_entity_group`
--

LOCK TABLES `ref_join_business_entity_group` WRITE;
/*!40000 ALTER TABLE `ref_join_business_entity_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_join_business_entity_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_comp_dispcomp`
--

DROP TABLE IF EXISTS `ref_join_comp_dispcomp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_comp_dispcomp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMP_DISPLAY_GROUP_ID` varchar(40) DEFAULT NULL,
  `COMP_ID` varchar(40) DEFAULT NULL,
  `DISPLAY_ORDER` int(11) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_comp_dispcomp`
--

LOCK TABLES `ref_join_comp_dispcomp` WRITE;
/*!40000 ALTER TABLE `ref_join_comp_dispcomp` DISABLE KEYS */;
INSERT INTO `ref_join_comp_dispcomp` VALUES (56,'New_Comp1','CUST_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:44:01');
INSERT INTO `ref_join_comp_dispcomp` VALUES (57,'New_Comp1','CUST_COM2',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:44:01');
INSERT INTO `ref_join_comp_dispcomp` VALUES (58,'New_Comp1','TRAN_COM4',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:44:01');
INSERT INTO `ref_join_comp_dispcomp` VALUES (62,'New_Comp2','CUST_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (63,'New_Comp2','CUST_COM2',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (64,'New_Comp2','CUST_COM3',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (65,'New_Comp2','CUST_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (66,'New_Comp2','REF_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (67,'New_Comp2','TRAN_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_join_comp_dispcomp` VALUES (153,'FINAL_TEST_COMP_1','CUST_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (154,'FINAL_TEST_COMP_1','CUST_COM2',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (155,'FINAL_TEST_COMP_1','CUST_COM3',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (156,'FINAL_TEST_COMP_1','TRAN_COM19',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (157,'FINAL_TEST_COMP_1','TRAN_COM20',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (158,'FINAL_TEST_COMP_1','TRAN_COM21',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (159,'FINAL_TEST_COMP_1','TRAN_COM22',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (165,'GROUP_1','CUST_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_join_comp_dispcomp` VALUES (166,'GROUP_1','CUST_COM2',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_join_comp_dispcomp` VALUES (167,'GROUP_1','CUST_COM3',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_join_comp_dispcomp` VALUES (168,'GROUP_1','CUST_COM4',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_join_comp_dispcomp` VALUES (169,'GROUP_1','CUST_COM5',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_join_comp_dispcomp` VALUES (183,'MIDDLE','REF_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-05 03:41:40');
INSERT INTO `ref_join_comp_dispcomp` VALUES (184,'NEW','CUST_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-05 03:43:45');
INSERT INTO `ref_join_comp_dispcomp` VALUES (185,'NEW','TRAN_COM17',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-05 03:43:45');
INSERT INTO `ref_join_comp_dispcomp` VALUES (186,'RIGHT_GROUP','REF_COM1',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (187,'RIGHT_GROUP','CUST_COM6',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (188,'RIGHT_GROUP','TRAN_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_join_comp_dispcomp` VALUES (195,'RIGHT','CUST_COM2',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (196,'RIGHT','CUST_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (197,'RIGHT','CUST_COM6',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (198,'RIGHT','TRAN_COM7',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (199,'RIGHT','TRAN_COM11',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (200,'RIGHT','TRAN_COM12',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_join_comp_dispcomp` VALUES (201,'LEFT','CUST_COM4',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:48:19');
INSERT INTO `ref_join_comp_dispcomp` VALUES (202,'LEFT','TRAN_COM15',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:48:19');
/*!40000 ALTER TABLE `ref_join_comp_dispcomp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_dispcomp_role`
--

DROP TABLE IF EXISTS `ref_join_dispcomp_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_dispcomp_role` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `COMP_DISPLAY_GROUP_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ROLE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_dispcomp_role`
--

LOCK TABLES `ref_join_dispcomp_role` WRITE;
/*!40000 ALTER TABLE `ref_join_dispcomp_role` DISABLE KEYS */;
INSERT INTO `ref_join_dispcomp_role` VALUES (155,'FINAL_TEST_COMP_1','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (156,'FINAL_TEST_COMP_1','ROLE2','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (157,'FINAL_TEST_COMP_1','ROLE3','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (158,'FINAL_TEST_COMP_1','ROLE4','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (159,'FINAL_TEST_COMP_1','ROLE5','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (160,'FINAL_TEST_COMP_1','NO ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (161,'FINAL_TEST_COMP_1','TEST_ROLE_ONE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (162,'FINAL_TEST_COMP_1','RECEIVE_ENTRY_ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (163,'MIDDLE','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (164,'MIDDLE','ROLE2','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (165,'MIDDLE','ROLE3','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (166,'MIDDLE','ROLE4','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:30');
INSERT INTO `ref_join_dispcomp_role` VALUES (167,'MIDDLE','ROLE5','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (168,'MIDDLE','NO ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (169,'MIDDLE','TEST_ROLE_ONE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (170,'MIDDLE','RECEIVE_ENTRY_ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (171,'NEW','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (172,'New_Comp1','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (173,'New_Comp1','ROLE2','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (174,'New_Comp1','NO ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (175,'New_Comp2','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (176,'New_Comp2','ROLE2','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (177,'New_Comp2','NO ROLE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (178,'RIGHT','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (179,'RIGHT','ROLE2','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
INSERT INTO `ref_join_dispcomp_role` VALUES (180,'RIGHT_GROUP','ROLE1','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:49:31');
/*!40000 ALTER TABLE `ref_join_dispcomp_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_entity_group`
--

DROP TABLE IF EXISTS `ref_join_entity_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_entity_group` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ENTITY_GROUP_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_entity_group`
--

LOCK TABLES `ref_join_entity_group` WRITE;
/*!40000 ALTER TABLE `ref_join_entity_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_join_entity_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_join_entity_location`
--

DROP TABLE IF EXISTS `ref_join_entity_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_join_entity_location` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOCATION_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_join_entity_location`
--

LOCK TABLES `ref_join_entity_location` WRITE;
/*!40000 ALTER TABLE `ref_join_entity_location` DISABLE KEYS */;
INSERT INTO `ref_join_entity_location` VALUES (1,'HSB','HASNABAD','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-03 00:50:03');
INSERT INTO `ref_join_entity_location` VALUES (4,'KH','KRISHNANAGAR','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-03 00:52:49');
INSERT INTO `ref_join_entity_location` VALUES (5,'KH','PAYRADANGA','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-03 00:52:49');
/*!40000 ALTER TABLE `ref_join_entity_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_access_privilege`
--

DROP TABLE IF EXISTS `ref_mst_access_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_access_privilege` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `PRIVILEGE_MASTER_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PRIVILEGE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRIVILEGE_NAME` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_MASTER_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ACCESS_ROLE_ID` int(11) DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_access_privilege`
--

LOCK TABLES `ref_mst_access_privilege` WRITE;
/*!40000 ALTER TABLE `ref_mst_access_privilege` DISABLE KEYS */;
INSERT INTO `ref_mst_access_privilege` VALUES (1,'ref_customer_index','index','index','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (8,'dbd_index','index','index','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (9,'rpt_index','index','index','rpt',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (13,'ref_customer_adduser','adduser','adduser','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (15,'ref_index','index','index','ref',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (17,'adm_index','index','index','adm',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (18,'adm_custxlslogmanage','index','index','adm_custxlslogmanagement',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (19,'adm_custxlslogmanage','edit','edit','adm_custxlslogmanagement',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (20,'ref_employee_addempl','addemployee','addemployee','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (21,'trn_index','index','index','trn',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (22,'trn_payment_index','index','index','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (23,'ref_employee_index','index','index','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (24,'ref_customer_suggest','suggestcustnm','suggestcustnm','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (25,'ref_location_add','add','add','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (26,'ref_location_index','index','index','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (27,'ref_employee_suggest','suggestempnm','suggestempnm','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (28,'trn_receive_index','index','index','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (29,'trn_chart','chart','chart','trn',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (30,'trn_payment_suggeste','suggestentnm','suggestentnm','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (31,'trn_payment_suggesti','suggestid','suggestid','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (32,'ref_customer_suggest','suggestcustid','suggestcustid','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (33,'ref_employee_suggest','suggestempid','suggestempid','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (34,'ref_scheme_index','index','index','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (35,'ref_scheme_suggestsc','suggestschm','suggestschm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (36,'trn_payment_suggests','suggestschm','suggestschm','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (37,'trn_payment_suggeste','suggestemp','suggestemp','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (38,'trn_payment_suggestc','suggestcust','suggestcust','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (39,'trn_receive_suggestc','suggestcustonemp','suggestcustonemp','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (40,'trn_receive_suggestt','suggesttrnsoncust','suggesttrnsoncust','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (41,'ref_location_suggest','suggeststate','suggeststate','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (42,'ref_location_suggest','suggestloc','suggestloc','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (44,'ref_customer_suggest','suggestent','suggestent','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (45,'ref_location_edit','edit','edit','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (46,'ref_location_suggest','suggestcountry','suggestcountry','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (47,'ref_customer_edituse','edituser','edituser','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (48,'ref_employee_editemp','editemp','editemp','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (49,'trn_payment_dtlsumma','dtlsummaryid','dtlsummaryid','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (50,'trn_payment_editsumm','editsummary','editsummary','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (51,'trn_payment_addsumma','addsummary','addsummary','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (52,'trn_receive_editdtl','editdtl','editdtl','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (53,'trn_receive_adddetai','adddetails','adddetails','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (54,'trn_receive_summaryd','summarydtlid','summarydtlid','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (56,'trn_excel_index','index','index','trn_excel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (57,'trn_excel_upload','upload','upload','trn_excel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (58,'ref_scheme_addschm','addschm','addschm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (59,'ref_scheme_editschm','editschm','editschm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (60,'ref_scheme_suggestsc','suggestschmnm','suggestschmnm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (61,'ref_scheme_suggestsc','suggestschmid','suggestschmid','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (69,'ref_customer_index','index','index','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (70,'ref_customer_suggest','suggestent','suggestent','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (71,'ref_customer_suggest','suggestcustnm','suggestcustnm','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (72,'ref_customer_suggest','suggestcustid','suggestcustid','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (73,'ref_employee_index','index','index','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (74,'ref_employee_suggest','suggestempid','suggestempid','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (75,'ref_employee_suggest','suggestempnm','suggestempnm','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (76,'ref_scheme_index','index','index','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (77,'ref_scheme_suggestsc','suggestschmnm','suggestschmnm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (78,'ref_scheme_suggestsc','suggestschm','suggestschm','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (79,'ref_location_index','index','index','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (80,'ref_location_suggest','suggestcountry','suggestcountry','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (81,'ref_location_suggest','suggeststate','suggeststate','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (82,'ref_location_suggest','suggestloc','suggestloc','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (83,'trn_payment_index','index','index','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (84,'trn_payment_dtlsumma','dtlsummaryid','dtlsummaryid','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (85,'trn_payment_suggesti','suggestid','suggestid','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (86,'trn_payment_suggeste','suggestentnm','suggestentnm','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (87,'trn_payment_suggestc','suggestcust','suggestcust','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (88,'trn_payment_suggeste','suggestemp','suggestemp','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (89,'trn_payment_suggests','suggestschm','suggestschm','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (90,'trn_receive_index','index','index','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (91,'trn_receive_summaryd','summarydtlid','summarydtlid','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (92,'trn_receive_suggestc','suggestcustonemp','suggestcustonemp','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (93,'trn_receive_suggestt','suggesttrnsoncust','suggesttrnsoncust','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (94,'dbd_index_exceluploa','excelupload','excelupload','dbd_index_excelupload',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (95,'ref_customerexcel_in','index','index','ref_customerexcel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (98,'adm_tranxlslogmanage','index','index','adm_tranxlslogmanagement',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (99,'adm_logfilemanagemen','index','index','adm_logfilemanagement',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (100,'ref_employee_emplocm','emplocmap','emplocmap','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (101,'trn_paymentexcel','paymentexcel','paymentexcel','trn',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (102,'trn_receiveexcel','receiveexcel','receiveexcel','trn',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (103,'ref_customer_custome','customerexcel','customerexcel','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (104,'ref_employee_employe','employeeexcel','employeeexcel','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (105,'ref_location_locatio','locationexcel','locationexcel','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (106,'ref_scheme_schemeexc','schemeexcel','schemeexcel','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (108,'dbd_exceldownload','exceldownload','exceldownload','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (109,'ref_customerexcel_cu','custexport','custexport','ref_customerexcel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (110,'ref_customerexcel_cu','custxls','custxls','ref_customerexcel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (111,'trn_excel_transexpor','transexport','transexport','trn_excel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (112,'trn_excel_transxls','transxls','transxls','trn_excel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (113,'tst_index','index','index','tst',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (114,'dbd_commonexport','commonexport','commonexport','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (117,'tst_test','test','test','tst',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (118,'trn_receive_vouchera','voucherajax','voucherajax','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (119,'trn_payment_pymntdtl','pymntdtlsajax','pymntdtlsajax','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (120,'trn_payment_schmchka','schmchkajax','schmchkajax','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (121,'trn_payment_maxschma','maxschmamntajax','maxschmamntajax','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (122,'trn_receive_trninfoo','trninfooncidajax','trninfooncidajax','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (123,'trn_receive_trninfoo','trninfoonidajax','trninfoonidajax','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (124,'trn_receive_trninfoa','trninfoajax','trninfoajax','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (125,'dbd_mgmtinfsys','mgmtinfsys','mgmtinfsys','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (126,'adm_useraccesscontro','index','index','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 17:12:49');
INSERT INTO `ref_mst_access_privilege` VALUES (127,'adm_useraccesscontro','usercreation','usercreation','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 17:12:48');
INSERT INTO `ref_mst_access_privilege` VALUES (128,'adm_useraccesscontro','rolecreation','rolecreation','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 17:12:47');
INSERT INTO `ref_mst_access_privilege` VALUES (129,'adm_useraccesscontro','mapmenutorole','mapmenutorole','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 17:12:45');
INSERT INTO `ref_mst_access_privilege` VALUES (130,'adm_useraccesscontro','mapusertorole','mapusertorole','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-20 12:07:48');
INSERT INTO `ref_mst_access_privilege` VALUES (131,'adm_usercreation_ind','index','User Creation index','adm_usercreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-23 13:17:12');
INSERT INTO `ref_mst_access_privilege` VALUES (132,'adm_usercreation_add','addappuser','Add Application User','adm_usercreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-24 11:09:20');
INSERT INTO `ref_mst_access_privilege` VALUES (133,'adm_usercreation_edi','editappuser','Edit Application User','adm_usercreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-24 11:09:22');
INSERT INTO `ref_mst_access_privilege` VALUES (134,'adm_maproletouser_in','index','Map User To Role Index ','adm_maproletouser',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:06:08');
INSERT INTO `ref_mst_access_privilege` VALUES (135,'adm_maproletouser_ma','mapuserrole','Roles Mapping To User','adm_maproletouser',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:06:32');
INSERT INTO `ref_mst_access_privilege` VALUES (136,'adm_maproletouser_ed','edituserrolemap','Edit Mapping','adm_maproletouser',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:06:01');
INSERT INTO `ref_mst_access_privilege` VALUES (137,'dbd_index_commonexpo','commonexport1','Common Export Section','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-25 20:30:57');
INSERT INTO `ref_mst_access_privilege` VALUES (138,'adm_index_logmanagem','logmanagement','Log Management','adm',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:16:53');
INSERT INTO `ref_mst_access_privilege` VALUES (139,'adm_useraccesscontro','suggestuserid','User Id Autocomplete','adm_useraccesscontrol',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:16:54');
INSERT INTO `ref_mst_access_privilege` VALUES (140,'adm_mapmenutorole_in','index','Menu & Roles','adm_mapmenutorole',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:16:55');
INSERT INTO `ref_mst_access_privilege` VALUES (141,'adm_mapmenutorole_ma','maprolemenu','Menu Mapping To Role','adm_mapmenutorole',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 14:34:14');
INSERT INTO `ref_mst_access_privilege` VALUES (142,'adm_rolecreation_index','index','Application Roles','adm_rolecreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 16:12:52');
INSERT INTO `ref_mst_access_privilege` VALUES (143,'adm_rolecreation_addrole','addrole','Application Role Add','adm_rolecreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 16:12:53');
INSERT INTO `ref_mst_access_privilege` VALUES (144,'adm_rolecreation_editrole','editrole','Application Role Edit','adm_rolecreation',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 16:12:55');
INSERT INTO `ref_mst_access_privilege` VALUES (145,'dbd_chartmis_index','index','Chart Management','dbd_chartmis',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 17:20:14');
INSERT INTO `ref_mst_access_privilege` VALUES (146,'ref_customer_suggestcssid','suggestcssid','Autocomplete for Css Id','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 19:22:50');
INSERT INTO `ref_mst_access_privilege` VALUES (147,'trn_payment_vchrchkajax','vchrchkajax','Is voucher Exist Ajax','trn_payment',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 19:22:48');
INSERT INTO `ref_mst_access_privilege` VALUES (148,'trn_receive_memochkajax','memochkajax','Is memo Exist Ajax','trn_receive',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 19:22:48');
INSERT INTO `ref_mst_access_privilege` VALUES (150,'ref_customer_custchkajax','custchkajax','Is Customer Id Exist Ajax','ref_customer',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:37');
INSERT INTO `ref_mst_access_privilege` VALUES (151,'ref_employee_empchkajax','empchkajax','Is Empolyee Id Exist Ajax','ref_employee',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:37');
INSERT INTO `ref_mst_access_privilege` VALUES (152,'ref_scheme_schmchkajax','schmchkajax','Is Scheme Id Exist Ajax','ref_scheme',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:36');
INSERT INTO `ref_mst_access_privilege` VALUES (153,'ref_location_locchkajax','locchkajax','Is Location Id Exist Ajax','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:36');
INSERT INTO `ref_mst_access_privilege` VALUES (154,'dbd_createpdf','createpdf',NULL,'dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:35');
INSERT INTO `ref_mst_access_privilege` VALUES (155,'dbd_help','help','Help page','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-23 20:33:47');
INSERT INTO `ref_mst_access_privilege` VALUES (168,'rpt_dlysmrymemo_index','index','Daily Summary Memo','rpt_dlysmrymemo',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:07:56');
INSERT INTO `ref_mst_access_privilege` VALUES (169,'rpt_wklysmrymemo_index','index','Weekly Summary Memo','rpt_wklysmrymemo',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:08:00');
INSERT INTO `ref_mst_access_privilege` VALUES (170,'rpt_mnthsmrymemo_index','index','Monthly Summary Memo','rpt_mnthsmrymemo',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:08:06');
INSERT INTO `ref_mst_access_privilege` VALUES (171,'rpt_dlydtlsmemo_index','index','Daily Details Memo','rpt_dlydtlsmemo',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:08:12');
INSERT INTO `ref_mst_access_privilege` VALUES (172,'rpt_dlysmryvchr_index','index','Daily Summary Voucher','rpt_dlysmryvchr',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:08:19');
INSERT INTO `ref_mst_access_privilege` VALUES (173,'rpt_wklysmryvchr_index','index','Daily Summary Voucher','rpt_wklysmryvchr',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:36:33');
INSERT INTO `ref_mst_access_privilege` VALUES (174,'rpt_mnthsmryvchr_index','index','Monthly Summary Voucher','rpt_mnthsmryvchr',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:36:44');
INSERT INTO `ref_mst_access_privilege` VALUES (175,'rpt_dlydtlsvchr_index','index','Daily Details Voucher ','rpt_dlydtlsvchr',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:36:50');
INSERT INTO `ref_mst_access_privilege` VALUES (176,'rpt_collsmryact_index','index','Collector Summary Activity','rpt_collsmryact',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:38:20');
INSERT INTO `ref_mst_access_privilege` VALUES (177,'rpt_colllocsmryact','index','Collector/Location Summary Activity','rpt_colllocsmryact',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 12:33:29');
INSERT INTO `ref_mst_access_privilege` VALUES (178,'rpt_colllocgndrsmryact','index','Collector/Location/Gender Summary Report','rpt_colllocgndrsmryact',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 16:10:59');
INSERT INTO `ref_mst_access_privilege` VALUES (179,'rpt_colllocgndrdtlsact','index','Collector/Location/Gender Summary Report','rpt_colllocgndrdtlsact',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 17:29:35');
INSERT INTO `ref_mst_access_privilege` VALUES (180,'rpt_colltopsht','index','Collector Top Sheet Report','rpt_colltopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 20:39:47');
INSERT INTO `ref_mst_access_privilege` VALUES (181,'rpt_schmtopsht','index','Scheme Top Sheet Report','rpt_schmtopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-03 19:47:17');
INSERT INTO `ref_mst_access_privilege` VALUES (182,'rpt_dtlcust','index','Client Details Report','rpt_dtlcust',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:02:46');
INSERT INTO `ref_mst_access_privilege` VALUES (184,'rpt_collpar','index','Collector Par Report','rpt_collpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 12:54:38');
INSERT INTO `ref_mst_access_privilege` VALUES (185,'rpt_collschmpar','index','Collector Par Report','rpt_collschmpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 13:14:39');
INSERT INTO `ref_mst_access_privilege` VALUES (186,'rpt_collschmlocpar','index','Collector/Scheme/Location Par Report','rpt_collschmlocpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 13:59:46');
INSERT INTO `ref_mst_access_privilege` VALUES (187,'rpt_schmpar','index','Scheme Par Report','rpt_schmpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 14:00:24');
INSERT INTO `ref_mst_access_privilege` VALUES (188,'rpt_locpar','index','Location Par Report','rpt_locpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 14:01:00');
INSERT INTO `ref_mst_access_privilege` VALUES (189,'rpt_gndrpar','index','Gender Par Report','rpt_gndrpar',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 14:02:32');
INSERT INTO `ref_mst_access_privilege` VALUES (190,'rpt_dtlcust2','index','Client Details Report 2','rpt_dtlcust2',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:03:51');
INSERT INTO `ref_mst_access_privilege` VALUES (191,'rpt_dtlcust3','index','Client Details Report 3','rpt_dtlcust3',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:04:15');
INSERT INTO `ref_mst_access_privilege` VALUES (192,'rpt_schmpymtrecmis_index','index','Scheme Wise Payment Receipt','rpt_schmpymtrecmis',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:50:08');
INSERT INTO `ref_mst_access_privilege` VALUES (193,'rpt_gndrpymtrecmis_index','index','Gender Wise Payment Receipt','rpt_gndrpymtrecmis',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:51:41');
INSERT INTO `ref_mst_access_privilege` VALUES (194,'rpt_mnthpymtrecmis_index','index','Month Wise Payment Receipt','rpt_mnthpymtrecmis',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:20:34');
INSERT INTO `ref_mst_access_privilege` VALUES (195,'rpt_locpymtrecmis_index','index','Location Wise Payment Receipt','rpt_locpymtrecmis',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 20:50:54');
INSERT INTO `ref_mst_access_privilege` VALUES (196,'rpt_bsd_index','index','Bsd Report','rpt_bsd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 13:19:49');
INSERT INTO `ref_mst_access_privilege` VALUES (197,'rpt_weektopsht_index','index','Week Top Sheet Report','rpt_weektopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 14:16:04');
INSERT INTO `ref_mst_access_privilege` VALUES (198,'rpt_loctopsht_index','index','Location Top Sheet Report','rpt_loctopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 15:34:04');
INSERT INTO `ref_mst_access_privilege` VALUES (199,'rpt_mnthtopsht_index','index','Month Top Sheet Report','rpt_mnthtopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 15:34:39');
INSERT INTO `ref_mst_access_privilege` VALUES (200,'rpt_dtltopsht_index','index','Detailed Top Sheet Report','rpt_dtltopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 16:22:57');
INSERT INTO `ref_mst_access_privilege` VALUES (201,'rpt_collpayrec_index','index','Collector Payment Recept Report','rpt_collpayrec',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 19:38:33');
INSERT INTO `ref_mst_access_privilege` VALUES (202,'rpt_acnttyptopsht_index','index','Account Type Top Sheet Report','rpt_acnttyptopsht',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 20:44:15');
INSERT INTO `ref_mst_access_privilege` VALUES (203,'rpt_index_commonrptwindow','commonrptwindow','Common facebox window for report','rpt',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-12 14:53:47');
INSERT INTO `ref_mst_access_privilege` VALUES (204,'dbd_index_custcomp','custcomp','Ajax Compmnent for customer','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-17 21:00:34');
INSERT INTO `ref_mst_access_privilege` VALUES (205,'ref_index_totalinfo','totalinfo','Ajax Compmnent for reference','ref',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-17 21:00:30');
INSERT INTO `ref_mst_access_privilege` VALUES (206,'trn_index_totaltrn','totaltrn','Ajax Compmnent for total transaction','trn',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-17 21:00:51');
INSERT INTO `ref_mst_access_privilege` VALUES (207,'app_index','index','Application Index','app',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-11 13:57:06');
INSERT INTO `ref_mst_access_privilege` VALUES (208,'trn_multirec_index','index','Mutiple receipt insert','trn_multirec',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-21 20:24:19');
INSERT INTO `ref_mst_access_privilege` VALUES (209,'trn_multipay_index','index','Mutiple payment insert','trn_multipay',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-21 20:24:28');
INSERT INTO `ref_mst_access_privilege` VALUES (210,'trn_multipaycust_index','index','Mutiple cust-payment insert','trn_multipaycust',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-01-20 19:11:34');
INSERT INTO `ref_mst_access_privilege` VALUES (211,'rpt_custloc_index','index','Cust Location Report','rpt_custloc',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-08 19:33:27');
INSERT INTO `ref_mst_access_privilege` VALUES (212,'ref_multicust_insertcust','insertcust','Multiple customer entry','ref_multicust',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-13 16:12:42');
INSERT INTO `ref_mst_access_privilege` VALUES (213,'adm_compaccess_index','index','Role Component Index','adm_compaccess',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-15 12:24:09');
INSERT INTO `ref_mst_access_privilege` VALUES (214,'adm_compaccess_entry','entry','Role Component Entry','adm_compaccess',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-15 12:24:12');
INSERT INTO `ref_mst_access_privilege` VALUES (215,'adm_compscreen_index','index','Component Screen Index','adm_compscreen',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-16 21:03:39');
INSERT INTO `ref_mst_access_privilege` VALUES (216,'adm_compscreen_entry','entry','Component Screen Entry','adm_compscreen',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-16 21:03:41');
INSERT INTO `ref_mst_access_privilege` VALUES (217,'adm_compscreen_delcomgrp','delcomgrp','Component Delete Page','adm_compscreen',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-09 13:23:00');
INSERT INTO `ref_mst_access_privilege` VALUES (218,'dbd_xlsexpimp','xlsexpimp','Excel Import-Export','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-09 13:23:01');
INSERT INTO `ref_mst_access_privilege` VALUES (219,'trn_multipaycust2_index','index','Grid Entry for Beneficiary-Payment','trn_multipaycust2',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-09 13:23:02');
INSERT INTO `ref_mst_access_privilege` VALUES (220,'dbd_index_xlsexprtarr','xlsexprtarr','Xls export section for array values','dbd',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 11:50:11');
INSERT INTO `ref_mst_access_privilege` VALUES (221,'trn_custpayexcel_index','index','Cust- Payment Excel Import','trn_custpayexcel',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-16 17:08:27');
INSERT INTO `ref_mst_access_privilege` VALUES (222,'rpt_fupaydate_index','index','Future Entry - Payment','rpt_fupaydate',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 12:06:40');
INSERT INTO `ref_mst_access_privilege` VALUES (223,'rpt_furecdate_index','index','Future Entry - Receipt','rpt_furecdate',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 12:07:14');
INSERT INTO `ref_mst_access_privilege` VALUES (224,'rpt_csscustdtlschdl_index','index','Beneficiery Schedule Report','rpt_csscustdtlschdl',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 17:24:25');
INSERT INTO `ref_mst_access_privilege` VALUES (225,'ref_multicoll_insertcoll','insertcoll','Multiple Collector Entry','ref_multicoll',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-09 17:04:31');
INSERT INTO `ref_mst_access_privilege` VALUES (226,'ref_location_suggest','suggestloc1','Suggest Location','ref_location',0,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-11 13:43:01');
INSERT INTO `ref_mst_access_privilege` VALUES (227,'ref_location_suggest','suggestloc1','suggestloc1','ref_location',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-18 16:32:59');
INSERT INTO `ref_mst_access_privilege` VALUES (228,'ref_multischeme_insertscheme','insertscheme','Multiple Project Entry','ref_multischeme',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-02 15:41:32');
INSERT INTO `ref_mst_access_privilege` VALUES (229,'ref_multilocation_insertlocation','insertlocation','Multiple Location Entry','ref_multilocation',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-03 17:58:34');
INSERT INTO `ref_mst_access_privilege` VALUES (230,'adm_finyear_index','index','Financial Year Setup','adm_finyear',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-05 12:01:43');
INSERT INTO `ref_mst_access_privilege` VALUES (231,'adm_finyear_addfinyear','addfinyear','Add new Financial Year','adm_finyear',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-05 13:47:33');
INSERT INTO `ref_mst_access_privilege` VALUES (232,'adm_finyear_editfinyear','editfinyear','Edit Financial year','adm_finyear',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-05 19:41:03');
INSERT INTO `ref_mst_access_privilege` VALUES (233,'adm_bkuprecovr_index','index','Backup & Recovery','adm_bkuprecovr',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:47:44');
INSERT INTO `ref_mst_access_privilege` VALUES (234,'adm_bkuprecovr_bkup','bkup','Backup','adm_bkuprecovr',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:47:36');
INSERT INTO `ref_mst_access_privilege` VALUES (235,'adm_bkuprecovr_recovr','recovr','Recovery','adm_bkuprecovr',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:48:00');
INSERT INTO `ref_mst_access_privilege` VALUES (236,'adm_custpayxlslogmangmnt_index','index','Beneficiary Payment','adm_custpayxlslogmangmnt',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-31 14:33:25');
INSERT INTO `ref_mst_access_privilege` VALUES (237,'ref_customer_delcusts','delcusts','Deleted Beneficiary','ref_deleted_customer',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-31 15:22:02');
INSERT INTO `ref_mst_access_privilege` VALUES (238,'dbd_commonpdf','commonpdf','Common Pdf Generator','dbd',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-02 10:03:53');
INSERT INTO `ref_mst_access_privilege` VALUES (239,'rpt_outstandingscdl_index','index','Outstanding Schedule','rpt_outstandingscdl',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-07-25 02:49:43');
INSERT INTO `ref_mst_access_privilege` VALUES (240,'rpt_collexception_index','index','Collector Payment Receipt','rpt_collexception',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-07-28 02:43:08');
INSERT INTO `ref_mst_access_privilege` VALUES (241,'rpt_cssmislocpayrec_index','index','CSS MIS Location Pay Rec','rpt_cssmislocpayrec',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-20 01:00:00');
INSERT INTO `ref_mst_access_privilege` VALUES (242,'rpt_cssmisprojpayrec_index','index','CSS MIS Project Pay Rec','rpt_cssmisprojpayrec',NULL,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-20 01:00:00');
/*!40000 ALTER TABLE `ref_mst_access_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_access_role`
--

DROP TABLE IF EXISTS `ref_mst_access_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_access_role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCESS_ROLE_ID` varchar(20) DEFAULT NULL,
  `ACCESS_ROLE_DESC` varchar(100) DEFAULT NULL,
  `ACCESS_ROLE_TYPE` varchar(20) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_access_role`
--

LOCK TABLES `ref_mst_access_role` WRITE;
/*!40000 ALTER TABLE `ref_mst_access_role` DISABLE KEYS */;
INSERT INTO `ref_mst_access_role` VALUES (1,'ROLE1','SUPER USER','SUPER USER','NORMAL','BB','2009-03-03 11:19:13',NULL,'2010-08-25 17:22:13');
INSERT INTO `ref_mst_access_role` VALUES (2,'ROLE2','POWER USER','POWER USER','NORMAL','BB','0000-00-00 00:00:00',NULL,'2010-08-25 17:22:15');
INSERT INTO `ref_mst_access_role` VALUES (3,'ROLE3','REFERENCE USER','POWER USER','NORMAL','BB','0000-00-00 00:00:00',NULL,'2010-08-25 17:22:17');
INSERT INTO `ref_mst_access_role` VALUES (4,'ROLE4','TRANSACTION USER','TRAN USER','NORMAL','BB','0000-00-00 00:00:00',NULL,'2010-08-25 17:22:18');
INSERT INTO `ref_mst_access_role` VALUES (5,'ROLE5','REPORT USER','REPORT USER','NORMAL','BB','0000-00-00 00:00:00',NULL,'2010-08-25 17:22:20');
INSERT INTO `ref_mst_access_role` VALUES (6,'ROLE6','READ ONLY USER','READ ONLY USER','CANCEL','BB','0000-00-00 00:00:00',NULL,'2010-10-30 13:59:11');
INSERT INTO `ref_mst_access_role` VALUES (7,'NO ROLE','NO ROLE','NO ROLE','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-02-28 19:50:15');
INSERT INTO `ref_mst_access_role` VALUES (8,'TEST_ROLE_ONE','test role','Test Role','NORMAL','admin','0000-00-00 00:00:00','admin','2011-04-14 16:51:44');
INSERT INTO `ref_mst_access_role` VALUES (9,'RECEIVE_ENTRY_ROLE','RECEIVE_ENTRY_ROLE','RECEIVE_ENTRY_ROLE','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:10:33');
/*!40000 ALTER TABLE `ref_mst_access_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_address`
--

DROP TABLE IF EXISTS `ref_mst_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_address` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ADDRESS_ID` varchar(20) DEFAULT NULL,
  `ADDRESS` mediumtext,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `I_RMA_ADDRESS_ID` (`ADDRESS_ID`),
  KEY `I_RRI_ADDRESS_ID` (`ADDRESS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=158556 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_address`
--

LOCK TABLES `ref_mst_address` WRITE;
/*!40000 ALTER TABLE `ref_mst_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_application_resource`
--

DROP TABLE IF EXISTS `ref_mst_application_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_application_resource` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `RESOURCE_MASTER_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RESOURCE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RESOURCE_TYPE` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MODULE_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PARENT_ACTION_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `URL_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MENU_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SCREEN_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BATCH_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_NAME` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_DESC` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `RESOURCE_URL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_MASTER_PARENT_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISPLAY_SEQUENCE` int(3) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVE',
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `RESOURCE_MASTER_ID` (`RESOURCE_MASTER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_application_resource`
--

LOCK TABLES `ref_mst_application_resource` WRITE;
/*!40000 ALTER TABLE `ref_mst_application_resource` DISABLE KEYS */;
INSERT INTO `ref_mst_application_resource` VALUES (1,'ref_customer','customer','menu','ref',NULL,NULL,'index',NULL,NULL,'Beneficiary','customer','/ref/customer','ref_customer_group',4,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-05-12 20:29:28');
INSERT INTO `ref_mst_application_resource` VALUES (9,'dbd','index','menu','dbd',NULL,NULL,'index',NULL,NULL,'Dashboard','Dashboard','/dbd','0',-10,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-11-08 22:06:40');
INSERT INTO `ref_mst_application_resource` VALUES (10,'ref','index','menu','ref',NULL,NULL,'index',NULL,NULL,'Reference','Reference','/ref','0',-9,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-11-08 22:06:47');
INSERT INTO `ref_mst_application_resource` VALUES (11,'rpt','index','menu','rpt',NULL,NULL,'index',NULL,NULL,'Reports','Reports','/rpt','0',-6,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-11-08 22:07:44');
INSERT INTO `ref_mst_application_resource` VALUES (13,'ref_employee','employee','menu','ref',NULL,NULL,'index',NULL,NULL,'Collector','employee','/ref/employee','ref_collector_group',12,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-05-12 20:29:38');
INSERT INTO `ref_mst_application_resource` VALUES (15,'adm','index','menu','adm',NULL,NULL,'index',NULL,NULL,'Admin','Admin','#','0',-4,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-20 05:54:16');
INSERT INTO `ref_mst_application_resource` VALUES (16,'adm_custxlslogmanagement','custxlslogmanagement','menu','adm',NULL,NULL,'index',NULL,NULL,'Beneficiary Log','custxlslogmanagement','/adm/custxlslogmanagement','adm_logmanagement',13,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-03-28 19:31:12');
INSERT INTO `ref_mst_application_resource` VALUES (17,'trn','index','menu','trn',NULL,NULL,'index',NULL,NULL,'Transaction','Transaction','/trn','0',-8,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-08 22:07:08');
INSERT INTO `ref_mst_application_resource` VALUES (18,'trn_payment','payment','menu','trn',NULL,NULL,'index',NULL,NULL,'Payment','Payment','/trn/payment','trn',15,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-04 22:20:08');
INSERT INTO `ref_mst_application_resource` VALUES (19,'trn_receive','receive','menu','trn',NULL,NULL,'index',NULL,NULL,'Receive','Receive','/trn/receive','trn',16,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-04 22:20:11');
INSERT INTO `ref_mst_application_resource` VALUES (20,'ref_location','location','menu','ref',NULL,NULL,'index',NULL,NULL,'Location','Location','/ref/location','ref_location_group',17,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-05-12 20:29:52');
INSERT INTO `ref_mst_application_resource` VALUES (21,'ref_scheme','scheme','menu','ref',NULL,NULL,'index',NULL,NULL,'Project','Scheme','/ref/scheme','ref_scheme_group',18,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-05-12 20:30:02');
INSERT INTO `ref_mst_application_resource` VALUES (22,'trn_excel','excel','menu','trn',NULL,NULL,'index',NULL,NULL,'Import: Payment Receipt','Excel Upload','/trn/excel','dbd_index_excelupload',3,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-03-28 19:49:29');
INSERT INTO `ref_mst_application_resource` VALUES (23,'ref_customer_2','customer','dummy','ref',NULL,NULL,'',NULL,NULL,'',NULL,'/ref/customer','ref',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:05');
INSERT INTO `ref_mst_application_resource` VALUES (24,'ref_employee_2','employee','dummy','ref',NULL,NULL,'',NULL,NULL,'',NULL,'/ref/employee','ref',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:13');
INSERT INTO `ref_mst_application_resource` VALUES (25,'ref_scheme_2','scheme','dummy','ref',NULL,NULL,'',NULL,NULL,'',NULL,'/ref/scheme','ref',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:26');
INSERT INTO `ref_mst_application_resource` VALUES (26,'ref_location_2','location','dummy','ref',NULL,NULL,'',NULL,NULL,'',NULL,'/ref/location','ref',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:29');
INSERT INTO `ref_mst_application_resource` VALUES (27,'trn_payment_2','payment','dummy','trn',NULL,NULL,'',NULL,NULL,'',NULL,'/trn/payment','trn',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:31');
INSERT INTO `ref_mst_application_resource` VALUES (28,'trn_receive_2','receive','dummy','trn',NULL,NULL,'',NULL,NULL,'',NULL,'/trn/receive','trn',0,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 13:33:34');
INSERT INTO `ref_mst_application_resource` VALUES (29,'dbd_index_excelupload','index','menu','dbd',NULL,NULL,'excelupload',NULL,NULL,'Import/Export',NULL,'/dbd/index/xlsexpimp','0',-7,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-02-28 18:49:15');
INSERT INTO `ref_mst_application_resource` VALUES (30,'ref_customerexcel','customerexcel','menu','ref',NULL,NULL,'index',NULL,NULL,'Import: Beneficiary',NULL,'/ref/customerexcel','dbd_index_excelupload',1,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-03-28 19:41:01');
INSERT INTO `ref_mst_application_resource` VALUES (32,'adm_tranxlslogmanagement','tranxlslogmanagement','menu','adm',NULL,NULL,'index',NULL,NULL,'Transaction Log','tranxlslogmanagement','/adm/tranxlslogmanagement','adm_logmanagement',14,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-04 22:20:31');
INSERT INTO `ref_mst_application_resource` VALUES (33,'adm_logfilemanagement','logfilemanagement','menu','adm',NULL,NULL,'index',NULL,NULL,'System Log ',NULL,'/adm/logfilemanagement','adm_logmanagement',20,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-11-04 22:20:35');
INSERT INTO `ref_mst_application_resource` VALUES (35,'ref_customerexcel_custexport','customerexcel','menu','ref',NULL,NULL,'custexport',NULL,NULL,'Export: Beneficiary',NULL,'/ref/customerexcel/custexport','dbd_index_excelupload',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:43:00');
INSERT INTO `ref_mst_application_resource` VALUES (36,'trn_excel_transexport','excel','menu','trn',NULL,NULL,'transexport',NULL,NULL,'Export: Payment Receipt',NULL,'/trn/excel/transexport','dbd_index_excelupload',4,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:45:36');
INSERT INTO `ref_mst_application_resource` VALUES (37,'tst','index',NULL,'tst',NULL,NULL,'tst',NULL,NULL,NULL,NULL,'/tst','0',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 10:38:03');
INSERT INTO `ref_mst_application_resource` VALUES (40,'ref_customer_adduser','customer','path','ref',NULL,NULL,'adduser',NULL,NULL,'Add New Beneficiary',NULL,'/ref/customer/adduser','ref_customer',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:10');
INSERT INTO `ref_mst_application_resource` VALUES (41,'ref_customer_edituser','customer','path','ref',NULL,NULL,'edituser',NULL,NULL,'Edit Existing Beneficiary',NULL,'/ref/customer/edituser','ref_customer',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:13');
INSERT INTO `ref_mst_application_resource` VALUES (42,'ref_employee_addemployee','employee','path','ref',NULL,NULL,'addemployee',NULL,NULL,'Add New Collector',NULL,'/ref/employee/addemployee','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 13:34:21');
INSERT INTO `ref_mst_application_resource` VALUES (43,'ref_employee_editemp','employee','path','ref',NULL,NULL,'editemp',NULL,NULL,'Edit Existing Collector',NULL,'/ref/employee/editemp','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 13:34:19');
INSERT INTO `ref_mst_application_resource` VALUES (44,'ref_employee_emplocmap','employee','path','ref',NULL,NULL,'emplocmap',NULL,NULL,'Collector Location Map',NULL,'/ref/employee/emplocmap','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 13:34:18');
INSERT INTO `ref_mst_application_resource` VALUES (45,'ref_location_add','location','path','ref',NULL,NULL,'add',NULL,NULL,'Add New Location',NULL,'/ref/location/add','ref_location',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 13:34:16');
INSERT INTO `ref_mst_application_resource` VALUES (46,'ref_location_edit','location','path','ref',NULL,NULL,'edit',NULL,NULL,'Edit location',NULL,'/ref/location/edit','ref_location',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:45');
INSERT INTO `ref_mst_application_resource` VALUES (47,'ref_scheme_addschm','scheme','path','ref',NULL,NULL,'addschm',NULL,NULL,'Add New Project',NULL,'/ref/scheme/addschm','ref_scheme',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:41');
INSERT INTO `ref_mst_application_resource` VALUES (48,'ref_scheme_editschm','scheme','path','ref',NULL,NULL,'editschm',NULL,NULL,'Edit Project',NULL,'/ref/scheme/editschm','ref_scheme',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:38');
INSERT INTO `ref_mst_application_resource` VALUES (49,'trn_payment_addsummary','payment','path','trn',NULL,NULL,'addsummary',NULL,NULL,'Beneficiary Payment',NULL,'/trn/payment/addsummary','trn_payment',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:53');
INSERT INTO `ref_mst_application_resource` VALUES (50,'trn_payment_editsummary','payment','path','trn','index',NULL,'editsummary',NULL,NULL,'Edit Client Payment',NULL,'/trn/payment/editsummary','trn_payment',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:34:56');
INSERT INTO `ref_mst_application_resource` VALUES (51,'trn_payment_editsummary_2','payment','path','trn','addsummary',NULL,'editsummary',NULL,NULL,'Edit Client Payment',NULL,'/trn/payment/editsummary','trn_payment_addsummary',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:02');
INSERT INTO `ref_mst_application_resource` VALUES (52,'trn_receive_adddetails','receive','path','trn',NULL,NULL,'adddetails',NULL,NULL,'Project Receive ',NULL,'/trn/receive/adddetails','trn_receive',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:06');
INSERT INTO `ref_mst_application_resource` VALUES (53,'trn_receive_editdtl','receive','path','trn','index',NULL,'editdtl',NULL,NULL,'Edit Beneficiary Receipt',NULL,'/trn/receive/editdtl','trn_receive',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:22');
INSERT INTO `ref_mst_application_resource` VALUES (54,'trn_receive_editdtl_2','receive','path','trn','adddetails',NULL,'adddetails',NULL,NULL,'Edit Beneficiary Receipt',NULL,'/trn/receive/editdtl','trn_receive_adddetails',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:29');
INSERT INTO `ref_mst_application_resource` VALUES (55,'dbd_index_mgmtinfsys','index','menu','dbd',NULL,NULL,'mgmtinfsys',NULL,NULL,'Visual Reports',NULL,'/dbd/index/mgmtinfsys','0',-5,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 22:10:39');
INSERT INTO `ref_mst_application_resource` VALUES (56,'adm_useraccesscontrol','useraccesscontrol','menu','adm',NULL,NULL,'index',NULL,NULL,'Access Control',NULL,'/adm/useraccesscontrol','adm',1,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:50:55');
INSERT INTO `ref_mst_application_resource` VALUES (57,'adm_useraccesscontrol_usercreation','useraccesscontrol','dummy','adm',NULL,NULL,'usercreation',NULL,NULL,'User Creation',NULL,'/adm/useraccesscontrol/usercreation','adm_useraccesscontrol',28,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-23 13:18:10');
INSERT INTO `ref_mst_application_resource` VALUES (58,'adm_rolecreation','rolecreation','menu','adm',NULL,NULL,'index',NULL,NULL,'Role Creation',NULL,'/adm/rolecreation','adm_useraccesscontrol',29,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 16:10:17');
INSERT INTO `ref_mst_application_resource` VALUES (59,'adm_useraccesscontrol_mapmenutorole','useraccesscontrol','dummy','adm',NULL,NULL,'mapmenutorole',NULL,NULL,'Map Menu To Role',NULL,'/adm/useraccesscontrol/mapmenutorole','adm_useraccesscontrol',30,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 12:55:16');
INSERT INTO `ref_mst_application_resource` VALUES (60,'adm_useraccesscontrol_mapusertorole','useraccesscontrol','dummy','adm',NULL,NULL,'mapusertorole',NULL,NULL,'Map User To Role',NULL,'/adm/useraccesscontrol/mapusertorole','adm_useraccesscontrol',31,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-25 16:46:21');
INSERT INTO `ref_mst_application_resource` VALUES (61,'adm_usercreation','usercreation','menu','adm',NULL,NULL,'index',NULL,NULL,'User Creation',NULL,'/adm/usercreation','adm_useraccesscontrol',28,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-23 13:14:23');
INSERT INTO `ref_mst_application_resource` VALUES (62,'adm_maproletouser','maproletouser','menu','adm',NULL,NULL,'index',NULL,NULL,'Map Roles To User',NULL,'/adm/maproletouser','adm_useraccesscontrol',29,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:02:29');
INSERT INTO `ref_mst_application_resource` VALUES (63,'adm_logmanagement','index','menu','adm',NULL,NULL,'logmanagement',NULL,NULL,'Log Management',NULL,'/adm/index/logmanagement','adm',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:51:10');
INSERT INTO `ref_mst_application_resource` VALUES (64,'adm_mapmenutorole','mapmenutorole','menu','adm',NULL,NULL,'index',NULL,NULL,'Map Menus To Role',NULL,'/adm/mapmenutorole','adm_useraccesscontrol',32,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:18:37');
INSERT INTO `ref_mst_application_resource` VALUES (65,'dbd_chartmis','chartmis','menu','dbd',NULL,NULL,'index',NULL,NULL,'MIS',NULL,'/dbd/chartmis','dbd_index_mgmtinfsys',33,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 22:05:46');
INSERT INTO `ref_mst_application_resource` VALUES (79,'rpt_dlysmrymemo','dlysmrymemo','menu','rpt',NULL,NULL,'index',NULL,NULL,'Daily Summary',NULL,'/rpt/dlysmrymemo','memo_report',34,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:41:04');
INSERT INTO `ref_mst_application_resource` VALUES (80,'rpt_wklysmrymemo','wklysmrymemo','menu','rpt',NULL,NULL,'index',NULL,NULL,'Weekly Summary ',NULL,'/rpt/wklysmrymemo','memo_report',35,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:41:02');
INSERT INTO `ref_mst_application_resource` VALUES (81,'rpt_mnthsmrymemo','mnthsmrymemo','menu','rpt',NULL,NULL,'index',NULL,NULL,'Monthly Summary',NULL,'/rpt/mnthsmrymemo','memo_report',36,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:41:00');
INSERT INTO `ref_mst_application_resource` VALUES (82,'rpt_dlydtlsmemo','dlydtlsmemo','menu','rpt',NULL,NULL,'index',NULL,NULL,'Daily Details ',NULL,'/rpt/dlydtlsmemo','memo_report',37,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:58');
INSERT INTO `ref_mst_application_resource` VALUES (83,'rpt_dlysmryvchr','dlysmryvchr','menu','rpt',NULL,NULL,'index',NULL,NULL,'Daily Summary ',NULL,'/rpt/dlysmryvchr','voucher_report',38,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:55');
INSERT INTO `ref_mst_application_resource` VALUES (84,'rpt_wklysmryvchr','wklysmryvchr','menu','rpt',NULL,NULL,'index',NULL,NULL,'Weekly Summary',NULL,'/rpt/wklysmryvchr','voucher_report',39,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:50');
INSERT INTO `ref_mst_application_resource` VALUES (85,'rpt_mnthsmryvchr','mnthsmryvchr','menu','rpt',NULL,NULL,'index',NULL,NULL,'Monthly Summary ',NULL,'/rpt/mnthsmryvchr','voucher_report',40,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:47');
INSERT INTO `ref_mst_application_resource` VALUES (86,'rpt_dlydtlsvchr','dlydtlsvchr','menu','rpt',NULL,NULL,'index',NULL,NULL,'Daily Details ',NULL,'/rpt/dlydtlsvchr','voucher_report',41,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:46');
INSERT INTO `ref_mst_application_resource` VALUES (87,'rpt_collsmryact','collsmryact','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector ',NULL,'/rpt/collsmryact','collector_report',42,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:44');
INSERT INTO `ref_mst_application_resource` VALUES (88,'memo_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Memo',NULL,'#','rpt',43,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:43:41');
INSERT INTO `ref_mst_application_resource` VALUES (89,'voucher_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Voucher',NULL,'#','rpt',44,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:43:45');
INSERT INTO `ref_mst_application_resource` VALUES (90,'client_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Beneficiary',NULL,'#','rpt',45,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:30:25');
INSERT INTO `ref_mst_application_resource` VALUES (91,'collector_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Collector',NULL,'#','rpt',46,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:48:55');
INSERT INTO `ref_mst_application_resource` VALUES (92,'topsheet_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Top Sheet',NULL,'#','rpt',47,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-02 11:48:58');
INSERT INTO `ref_mst_application_resource` VALUES (93,'par_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'PAR',NULL,'#','rpt',48,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:38:52');
INSERT INTO `ref_mst_application_resource` VALUES (94,'operational_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Operation',NULL,'#','rpt',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:38:23');
INSERT INTO `ref_mst_application_resource` VALUES (95,'mis_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'MIS',NULL,'#','rpt',50,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-09 13:28:41');
INSERT INTO `ref_mst_application_resource` VALUES (96,'rpt_colllocsmryact','colllocsmryact','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector Location',NULL,'/rpt/colllocsmryact','collector_report',51,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:37:47');
INSERT INTO `ref_mst_application_resource` VALUES (97,'rpt_colllocgndrsmryact','colllocgndrsmryact','menu','rpt',NULL,NULL,'index',NULL,NULL,'Coll Loc Gender Summary ',NULL,'/rpt/colllocgndrsmryact','collector_report',52,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 18:57:01');
INSERT INTO `ref_mst_application_resource` VALUES (98,'rpt_colllocgndrdtlsact','colllocgndrdtlsact','menu','rpt',NULL,NULL,'index',NULL,NULL,'Coll Loc Gender Details',NULL,'/rpt/colllocgndrdtlsact','collector_report',53,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 18:57:10');
INSERT INTO `ref_mst_application_resource` VALUES (99,'rpt_colltopsht','colltopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector',NULL,'/rpt/colltopsht','topsheet_report',54,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:40:30');
INSERT INTO `ref_mst_application_resource` VALUES (100,'rpt_schmtopsht','schmtopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Project',NULL,'/rpt/schmtopsht','topsheet_report',55,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:45');
INSERT INTO `ref_mst_application_resource` VALUES (101,'rpt_dtlcust','dtlcust','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl #1',NULL,'/rpt/dtlcust','client_report',1,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:22:25');
INSERT INTO `ref_mst_application_resource` VALUES (103,'rpt_collpar','collpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector ',NULL,'/rpt/collpar','par_report',57,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:38:06');
INSERT INTO `ref_mst_application_resource` VALUES (104,'rpt_collschmpar','collschmpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector Project ',NULL,'/rpt/collschmpar','par_report',58,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-13 12:14:12');
INSERT INTO `ref_mst_application_resource` VALUES (105,'rpt_collschmlocpar','collschmlocpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector Project Location',NULL,'/rpt/collschmlocpar','par_report',59,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:37:15');
INSERT INTO `ref_mst_application_resource` VALUES (106,'rpt_schmpar','schmpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Project',NULL,'/rpt/schmpar','par_report',60,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:29:49');
INSERT INTO `ref_mst_application_resource` VALUES (107,'rpt_locpar','locpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Location',NULL,'/rpt/locpar','par_report',61,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:37:57');
INSERT INTO `ref_mst_application_resource` VALUES (108,'rpt_gndrpar','gndrpar','menu','rpt',NULL,NULL,'index',NULL,NULL,'Gender',NULL,'/rpt/gndrpar','par_report',62,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-08 19:37:55');
INSERT INTO `ref_mst_application_resource` VALUES (109,'rpt_dtlcust2','dtlcust2','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl #2',NULL,'/rpt/dtlcust2','client_report',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:21:39');
INSERT INTO `ref_mst_application_resource` VALUES (110,'rpt_dtlcust3','dtlcust3','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl #3',NULL,'/rpt/dtlcust3','client_report',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:22:30');
INSERT INTO `ref_mst_application_resource` VALUES (111,'rpt_schmpymtrecmis','schmpymtrecmis','menu','rpt',NULL,NULL,'index',NULL,NULL,'Project Payment Receipt',NULL,'/rpt/schmpymtrecmis','mis_report',65,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:35:55');
INSERT INTO `ref_mst_application_resource` VALUES (112,'rpt_gndrpymtrecmis','gndrpymtrecmis','menu','rpt',NULL,NULL,'index',NULL,NULL,'Gender Payment Receipt',NULL,'/rpt/gndrpymtrecmis','mis_report',66,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 18:58:17');
INSERT INTO `ref_mst_application_resource` VALUES (113,'rpt_mnthpymtrecmis','mnthpymtrecmis','menu','rpt',NULL,NULL,'index',NULL,NULL,'Month Payment Receipt',NULL,'/rpt/mnthpymtrecmis','mis_report',63,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 18:58:15');
INSERT INTO `ref_mst_application_resource` VALUES (114,'rpt_locpymtrecmis','locpymtrecmis','menu','rpt',NULL,NULL,'index',NULL,NULL,'Location Payment Receipt',NULL,'/rpt/locpymtrecmis','mis_report',64,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:36:00');
INSERT INTO `ref_mst_application_resource` VALUES (115,'rpt_bsd','bsd','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Donation (BSD)',NULL,'/rpt/bsd','css_report',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:24:31');
INSERT INTO `ref_mst_application_resource` VALUES (116,'rpt_weektopsht','weektopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Week ',NULL,'/rpt/weektopsht','topsheet_report',67,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 15:33:26');
INSERT INTO `ref_mst_application_resource` VALUES (117,'rpt_loctopsht','loctopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Location',NULL,'/rpt/loctopsht','topsheet_report',66,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 15:33:21');
INSERT INTO `ref_mst_application_resource` VALUES (118,'rpt_mnthtopsht','mnthtopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Month',NULL,'/rpt/mnthtopsht','topsheet_report',68,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 15:33:38');
INSERT INTO `ref_mst_application_resource` VALUES (119,'rpt_dtltopsht','dtltopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Details',NULL,'/rpt/dtltopsht','topsheet_report',69,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 16:21:55');
INSERT INTO `ref_mst_application_resource` VALUES (120,'rpt_collpayrec','collpayrec','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector Payment Receipt',NULL,'/rpt/collpayrec','operational_report',70,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:36:10');
INSERT INTO `ref_mst_application_resource` VALUES (121,'rpt_acnttyptopsht','acnttyptopsht','menu','rpt',NULL,NULL,'index',NULL,NULL,'Account Type ',NULL,'/rpt/acnttyptopsht','topsheet_report',71,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-11-10 20:43:13');
INSERT INTO `ref_mst_application_resource` VALUES (122,'app','index',NULL,'app',NULL,NULL,'index',NULL,NULL,'Application',NULL,'/app/index','',72,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-11 13:51:41');
INSERT INTO `ref_mst_application_resource` VALUES (123,'trn_multirec','multirec','menu','trn',NULL,NULL,'index',NULL,NULL,'Grid: Receipt',NULL,'/trn/multirec','trn',75,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:01:50');
INSERT INTO `ref_mst_application_resource` VALUES (124,'trn_multipay','multipay','menu','trn',NULL,NULL,'index',NULL,NULL,'Grid: Payment',NULL,'/trn/multipay','trn',74,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:01:54');
INSERT INTO `ref_mst_application_resource` VALUES (125,'trn_multipaycust','multipaycust','menu','trn',NULL,NULL,'index',NULL,NULL,'Grid: Beneficiary Pay(Opt)',NULL,'/trn/multipaycust','trn',73,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:02:01');
INSERT INTO `ref_mst_application_resource` VALUES (126,'rpt_custloc','custloc','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Location Gender',NULL,'/rpt/custloc','css_report',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:36:59');
INSERT INTO `ref_mst_application_resource` VALUES (127,'ref_multicust','multicust','menu','ref',NULL,NULL,'insertcust',NULL,NULL,'Grid: Beneficiary',NULL,'/ref/multicust/insertcust','ref_customer_group',5,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:32:06');
INSERT INTO `ref_mst_application_resource` VALUES (128,'adm_compaccess','compaccess','menu','adm',NULL,NULL,'entry',NULL,NULL,'Map Roles to Disp Group',NULL,'/adm/compaccess','adm_compacc_control',79,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-27 10:36:18');
INSERT INTO `ref_mst_application_resource` VALUES (129,'adm_compscreen','compscreen','menu','adm',NULL,NULL,'index',NULL,NULL,'Component Display Group ',NULL,'/adm/compscreen','adm_compacc_control',78,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-27 10:36:22');
INSERT INTO `ref_mst_application_resource` VALUES (130,'adm_compacc_control','','menu','adm',NULL,NULL,NULL,NULL,NULL,'Component Access Control ',NULL,'#','adm',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:52:01');
INSERT INTO `ref_mst_application_resource` VALUES (131,'dbd_screen','dbd','screen',NULL,NULL,NULL,NULL,'dbd',NULL,'Dashboard',NULL,NULL,NULL,79,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 16:04:07');
INSERT INTO `ref_mst_application_resource` VALUES (132,'ref_screen','ref','screen',NULL,NULL,NULL,NULL,'ref',NULL,'Reference',NULL,NULL,NULL,80,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 16:04:09');
INSERT INTO `ref_mst_application_resource` VALUES (133,'trn_screen','trn','screen',NULL,NULL,NULL,NULL,'trn',NULL,'Transaction',NULL,NULL,NULL,81,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 16:04:13');
INSERT INTO `ref_mst_application_resource` VALUES (134,'xls_screen','xls','screen',NULL,NULL,NULL,NULL,'xls',NULL,'Excel Import Export',NULL,NULL,NULL,82,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:36:50');
INSERT INTO `ref_mst_application_resource` VALUES (135,'rpt_screen','rpt','screen',NULL,NULL,NULL,NULL,'rpt',NULL,'Report',NULL,NULL,NULL,83,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 16:04:21');
INSERT INTO `ref_mst_application_resource` VALUES (136,'visrpt_screen','visrpt','screen',NULL,NULL,NULL,NULL,'visrpt',NULL,'Visual Report',NULL,NULL,NULL,84,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-10 16:04:23');
INSERT INTO `ref_mst_application_resource` VALUES (138,'trn_multipaycust2','multipaycust2','menu','trn',NULL,NULL,'index',NULL,NULL,'Grid: Beneficiary Pay(Mand)',NULL,'/trn/multipaycust2','trn',73,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:14:54');
INSERT INTO `ref_mst_application_resource` VALUES (139,'trn_custpayexcel','custpayexcel','menu','trn',NULL,NULL,'index',NULL,NULL,'Import: Beneficiary Payment',NULL,'/trn/custpayexcel','dbd_index_excelupload',5,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:48:57');
INSERT INTO `ref_mst_application_resource` VALUES (140,'exception_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'Exception',NULL,'#','rpt',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:20:57');
INSERT INTO `ref_mst_application_resource` VALUES (141,'rpt_fupaydate','fupaydate','menu','rpt',NULL,NULL,'index',NULL,NULL,'Payment Future Entries',NULL,'/rpt/fupaydate','exception_report',86,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:37:24');
INSERT INTO `ref_mst_application_resource` VALUES (142,'rpt_furecdate','furecdate','menu','rpt',NULL,NULL,'index',NULL,NULL,'Receipt Future Entries',NULL,'/rpt/furecdate','exception_report',87,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:37:31');
INSERT INTO `ref_mst_application_resource` VALUES (143,'css_report','','menu',NULL,NULL,NULL,NULL,NULL,NULL,'CSS Custom',NULL,'#','rpt',1,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:18:08');
INSERT INTO `ref_mst_application_resource` VALUES (144,'rpt_csscustdtlschdl','csscustdtlschdl','menu','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiery Schedule',NULL,'/rpt/csscustdtlschdl','css_report',1,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-03-28 19:23:43');
INSERT INTO `ref_mst_application_resource` VALUES (145,'ref_multicoll','multicoll','menu','ref',NULL,NULL,'insertcoll',NULL,NULL,'Grid: Collector',NULL,'/ref/multicoll/insertcoll','ref_collector_group',13,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:59');
INSERT INTO `ref_mst_application_resource` VALUES (146,'adm_bkuprecovr','bkuprecovr','menu','adm',NULL,NULL,'index',NULL,NULL,'Backup/Recovery',NULL,'#','adm',89,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-11 15:14:32');
INSERT INTO `ref_mst_application_resource` VALUES (147,'adm_bkuprecovr_1','bkuprecovr','menu','adm',NULL,NULL,'bkup',NULL,NULL,'Backup',NULL,'/adm/bkuprecovr/bkup','adm_bkuprecovr',90,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-06 02:39:03');
INSERT INTO `ref_mst_application_resource` VALUES (148,'adm_bkuprecovr_2','bkuprecovr','','adm',NULL,NULL,'recovr',NULL,NULL,'Recovery',NULL,'/adm/bkuprecovr/recovr','adm_bkuprecovr',91,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-31 13:16:36');
INSERT INTO `ref_mst_application_resource` VALUES (149,'ref_multischeme','multischeme','menu','ref',NULL,NULL,'insertscheme',NULL,NULL,'Grid: Project',NULL,'/ref/multischeme/insertscheme','ref_scheme_group',19,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:52');
INSERT INTO `ref_mst_application_resource` VALUES (150,'ref_multilocation','multilocation','menu','ref',NULL,NULL,'insertlocation',NULL,NULL,'Grid: Location',NULL,'/ref/multilocation/insertlocation','ref_location_group',18,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:55');
INSERT INTO `ref_mst_application_resource` VALUES (151,'adm_fin_year','','menu','adm',NULL,NULL,NULL,NULL,NULL,'Financial Year',NULL,'#','adm',2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-05 11:48:24');
INSERT INTO `ref_mst_application_resource` VALUES (152,'adm_finyear','finyear','menu','adm',NULL,NULL,'index',NULL,NULL,'Financial Year Setup',NULL,'/adm/finyear','adm_fin_year',94,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-05 11:49:42');
INSERT INTO `ref_mst_application_resource` VALUES (156,'ref_customer_group','','menu',NULL,NULL,NULL,'index',NULL,NULL,'Beneficiary',NULL,'#','ref',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:39');
INSERT INTO `ref_mst_application_resource` VALUES (157,'ref_collector_group','','menu',NULL,NULL,NULL,'index',NULL,NULL,'Collector',NULL,'#','ref',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:40');
INSERT INTO `ref_mst_application_resource` VALUES (158,'ref_location_group','','menu',NULL,NULL,NULL,'index',NULL,NULL,'Location',NULL,'#','ref',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:40');
INSERT INTO `ref_mst_application_resource` VALUES (159,'ref_scheme_group','','menu',NULL,NULL,NULL,'index',NULL,NULL,'Project',NULL,'#','ref',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 20:31:42');
INSERT INTO `ref_mst_application_resource` VALUES (160,'adm_custpayxlslogmangmnt','custpayxlslogmangmnt','menu','adm',NULL,NULL,'index',NULL,NULL,'Beneficiary Payment Log',NULL,'/adm/custpayxlslogmangmnt','adm_logmanagement',15,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-31 14:31:59');
INSERT INTO `ref_mst_application_resource` VALUES (161,'ref_deleted_customer','customer','menu','ref',NULL,NULL,'delcusts',NULL,NULL,'Deleted Beneficiary',NULL,'/ref/customer/delcusts','ref_customer_group',6,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-31 15:23:32');
INSERT INTO `ref_mst_application_resource` VALUES (162,'rpt_outstandingscdl','outstandingscdl','menu','rpt',NULL,NULL,'index',NULL,NULL,'Outstanding Schedule',NULL,'/rpt/outstandingscdl','css_report',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-07-25 02:48:09');
INSERT INTO `ref_mst_application_resource` VALUES (163,'rpt_collexception','collexception','menu','rpt',NULL,NULL,'index',NULL,NULL,'Collector Payment Receipt',NULL,'/rpt/collexception','exception_report',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-07-28 02:42:35');
INSERT INTO `ref_mst_application_resource` VALUES (164,'rpt_cssmislocpayrec','cssmislocpayrec','menu','rpt',NULL,NULL,'index',NULL,NULL,'CSS MIS Location Pay Rec',NULL,'/rpt/cssmislocpayrec','css_report',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-20 01:00:00');
INSERT INTO `ref_mst_application_resource` VALUES (165,'rpt_cssmisprojpayrec','cssmisprojpayrec','menu','rpt',NULL,NULL,'index',NULL,NULL,'CSS MIS Project Pay Rec',NULL,'/rpt/cssmisprojpayrec','css_report',3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-20 01:00:00');
INSERT INTO `ref_mst_application_resource` VALUES (166,'0','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 13:25:02');
/*!40000 ALTER TABLE `ref_mst_application_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_business_entity`
--

DROP TABLE IF EXISTS `ref_mst_business_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_business_entity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BUSINESS_ENTITY_ID` varchar(20) DEFAULT NULL,
  `PARENT_BUSINESS_ENTITY_ID` varchar(20) DEFAULT NULL,
  `BUSINESS_ENTITY_TYPE` varchar(100) DEFAULT NULL,
  `BUSINESS_ENTITY_NAME` varchar(100) DEFAULT NULL,
  `BUSINESS_ENTITY_DESC` mediumtext,
  `ENTERPRISE_ID` varchar(20) DEFAULT NULL,
  `OFFICE_ID` varchar(20) DEFAULT NULL,
  `BRANCH_ID` varchar(20) DEFAULT NULL,
  `ADDRESS_ID` varchar(20) DEFAULT NULL,
  `PERMANENT_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `MAIL_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_business_entity`
--

LOCK TABLES `ref_mst_business_entity` WRITE;
/*!40000 ALTER TABLE `ref_mst_business_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_business_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_business_entity_group`
--

DROP TABLE IF EXISTS `ref_mst_business_entity_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_business_entity_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BUSINESS_ENTITY_GROUP_ID` varchar(20) DEFAULT NULL,
  `BUSINESS_ENTITY_GROUP_NAME` varchar(40) DEFAULT NULL,
  `BUSINESS_ENTITY_GROUP_DESC` mediumtext,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_business_entity_group`
--

LOCK TABLES `ref_mst_business_entity_group` WRITE;
/*!40000 ALTER TABLE `ref_mst_business_entity_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_business_entity_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_collector`
--

DROP TABLE IF EXISTS `ref_mst_collector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_collector` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` varchar(20) DEFAULT NULL,
  `ENTITY_TYPE` varchar(20) DEFAULT NULL,
  `PARENT_ENTITY_ID` varchar(20) DEFAULT '',
  `ENTITY_UNIQUE_ID` varchar(20) DEFAULT NULL,
  `ENTITY_NAME` varchar(100) DEFAULT NULL,
  `ENTITY_DESC` mediumtext,
  `NAME` varchar(100) DEFAULT NULL,
  `AGE` int(10) DEFAULT NULL,
  `SEX` varchar(1) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `EMPLOYEE_JOIN_DATE` date DEFAULT NULL,
  `EMPLOYEE_EXIT_DATE` date DEFAULT NULL,
  `EMPLOYEE_DESIGNATION` varchar(30) DEFAULT NULL,
  `AGENT_ID` varchar(20) DEFAULT NULL,
  `AGENT_JOIN_DATE` date DEFAULT NULL,
  `AGENT_EXIT_DATE` date DEFAULT NULL,
  `ADDRESS_ID` varchar(20) DEFAULT NULL,
  `PERMANENT_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `MAIL_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LOCATION_ID` varchar(20) DEFAULT NULL,
  `IMAGE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_RMC_ENTITY_ID` (`ENTITY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_collector`
--

LOCK TABLES `ref_mst_collector` WRITE;
/*!40000 ALTER TABLE `ref_mst_collector` DISABLE KEYS */;
INSERT INTO `ref_mst_collector` VALUES (1,'APC','COLLECTOR','','EMP1','ANINDITA PAL CHOWDHURY','','ANINDITA PAL CHOWDHURY',40,'F','APC','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR1',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:32:29',NULL,'1.jpg');
INSERT INTO `ref_mst_collector` VALUES (2,'BS','COLLECTOR','','EMP2','BIPLAB SARKAR','','BIPLAB SARKAR',40,'M','BS','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR2',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:24:44',NULL,'2.jpg');
INSERT INTO `ref_mst_collector` VALUES (3,'DM','COLLECTOR','','EMP3','DINESH CHANDRA MONDAL','','DINESH CHANDRA MONDAL',40,'M','DM','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR3',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:31:46',NULL,'3.jpg');
INSERT INTO `ref_mst_collector` VALUES (4,'DNS','COLLECTOR','','EMP4','DEBENDRANATH SAMANTA','','DEBENDRANATH SAMANTA',40,'M','DNS','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR4',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:58:31',NULL,'4.jpg');
INSERT INTO `ref_mst_collector` VALUES (5,'GB','COLLECTOR','','EMP5','GOURI BISWAS','','GOURI BISWAS',40,'F','GB','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR5',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:39:05',NULL,'5.jpg');
INSERT INTO `ref_mst_collector` VALUES (6,'GG','COLLECTOR','','EMP6','GANESH GANGULY','','GANESH GANGULY',40,'M','GG','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR6',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:05:17',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (7,'LC','COLLECTOR','','EMP7','LILA CHAKRABORTY','','LILA CHAKRABORTY',40,'F','LC','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR7',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:38:50',NULL,'7.jpg');
INSERT INTO `ref_mst_collector` VALUES (8,'MS','COLLECTOR','','EMP8','MITHUN SARKAR','','MITHUN SARKAR',40,'M','MS','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR8',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:05:17',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (9,'ND','COLLECTOR','','EMP9','NARAYAN DEBNATH','','NARAYAN DEBNATH',40,'M','ND','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR9',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:38:23',NULL,'9.jpg');
INSERT INTO `ref_mst_collector` VALUES (10,'RA','COLLECTOR','','EMP10','ROUF ALI','','ROUF ALI',35,'M','RA','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR10',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:38:08',NULL,'10.jpg');
INSERT INTO `ref_mst_collector` VALUES (11,'RS','COLLECTOR','','EMP11','RINA SEN','','RINA SEN',35,'F','RS','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR11',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:05:17',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (12,'SB','COLLECTOR','','EMP12','SAJAL BHATTACHARJEE','','SAJAL BHATTACHARJEE',40,'M','SB','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR12',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:37:44',NULL,'12.jpg');
INSERT INTO `ref_mst_collector` VALUES (13,'SMJ','COLLECTOR','','EMP13','SAMUEL MAJUMDER','','SAMUEL MAJUMDER',40,'M','SMJ','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR13',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:37:33',NULL,'13.jpg');
INSERT INTO `ref_mst_collector` VALUES (14,'SP','COLLECTOR','','EMP14','SANGITA PAUL','','SANGITA PAUL',38,'F','SP','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR14',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-11-12 03:54:35',NULL,'14.jpg');
INSERT INTO `ref_mst_collector` VALUES (15,'ST','COLLECTOR','','EMP15','SAHABUDDIN TARAFDER','','SAHABUDDIN TARAFDER',40,'M','ST','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR15',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-21 01:37:07',NULL,'15.jpg');
INSERT INTO `ref_mst_collector` VALUES (16,'RD','COLLECTOR','','EMP16','RAJU DAS','','RAJU DAS',30,'M','RD','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR16',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (17,'UD','COLLECTOR','','EMP17','UJJAL KR DAS','','UJJAL KR DAS',40,'M','UD','2000-01-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR17',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-11 01:41:35',NULL,'17.jpg');
INSERT INTO `ref_mst_collector` VALUES (18,'TKA','COLLECTOR','','EMP18','TUSHAR KANTI ADHIKARY','DEFAULT','TUSHAR KANTI ADHIKARY',55,'M','TKA','2012-04-30',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR18',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-18 03:08:48',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (19,'KH','COLLECTOR','','EMP19','KHARDAH','','KHARDAH',30,'M','KH','2012-09-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR19',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-09-08 00:49:07',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (20,'HSB','COLLECTOR','','EMP20','HASNABAD','','HASNABAD',30,'M','HSB','2012-11-28',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR20',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-18 03:10:26',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (21,'BAN','COLLECTOR','','EMP21','BANDEL','','BANDEL',0,'M','BAN','2013-02-28',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR21',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-03-04 06:02:44',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (22,'SFY','COLLECTOR','','EMP22','SHEORAPHULI','','SHEORAPHULI',30,'M','SFY','2014-05-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR22',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-05-14 06:51:54',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (23,'RS2','COLLECTOR','','EMP23','RINA SEN NEW','','RINA SEN NEW',45,'F','RS2','2014-04-01',NULL,'COLLECTOR',NULL,NULL,NULL,'EADDR23',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-06-24 05:51:54',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (24,'AMD','COLLECTOR','','EMP24','AMDANGA','','AMDANGA',0,'M','AMD','2015-04-01',NULL,'FIELD OFFICER',NULL,NULL,NULL,'EADDR24',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-04-06 01:39:14',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (25,'MH','COLLECTOR','','EMP25','MOHONPUR','','MOHONPUR',0,'M','MH','2015-04-01',NULL,'FIELD OFFICER',NULL,NULL,NULL,'EADDR25',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-04-06 03:20:32',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (26,'KG','COLLECTOR','','EMP26','KAWGHACHI','','KAWGHACHI',0,'M','KG','2015-04-01',NULL,'FIELD OFFICER',NULL,NULL,NULL,'EADDR26',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-04-06 04:24:25',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (27,'HW','COLLECTOR','','EMP27','HOWRAH','','HOWRAH',0,'F','HW','2015-04-01',NULL,'FIELD OFFICER',NULL,NULL,NULL,'EADDR27',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-04-28 00:05:01',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (28,'EM','COLLECTOR','','EMP28','EAST MEDINAPUR','','EAST MEDINAPUR',0,'F','EM','2015-04-01',NULL,'FIELD OFFICER',NULL,NULL,NULL,'EADDR28',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-04-28 00:06:37',NULL,'');
INSERT INTO `ref_mst_collector` VALUES (29,'SFYA','COLLECTOR','','EMP29','SFYA','DEFAULT','SFYA',0,'M','SFYA','2017-06-12',NULL,'COOLECTOR',NULL,NULL,NULL,'EADDR29',NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2017-07-08 06:30:19',NULL,'');
/*!40000 ALTER TABLE `ref_mst_collector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_component_resource`
--

DROP TABLE IF EXISTS `ref_mst_component_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_component_resource` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMP_ID` varchar(40) DEFAULT NULL,
  `RESOURCE_TYPE` varchar(20) DEFAULT NULL,
  `COMP_GROUP_ID` varchar(40) DEFAULT NULL,
  `COMP_SCREEN_NAME` varchar(100) DEFAULT NULL,
  `COMP_NAME` varchar(40) DEFAULT NULL,
  `MODULE` varchar(40) DEFAULT NULL,
  `CALLER_MODULE_ID` varchar(20) DEFAULT NULL,
  `CALLER_CONTROLLER_ID` varchar(20) DEFAULT NULL,
  `CALLER_ACTION_ID` varchar(20) DEFAULT NULL,
  `MODULE_CONTROLLER` varchar(40) DEFAULT NULL,
  `ACTION` varchar(20) DEFAULT NULL,
  `PARAMETERS` varchar(500) DEFAULT NULL,
  `SCREEN_ID` varchar(20) DEFAULT NULL,
  `DISPLAY_ORDER` int(11) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_component_resource`
--

LOCK TABLES `ref_mst_component_resource` WRITE;
/*!40000 ALTER TABLE `ref_mst_component_resource` DISABLE KEYS */;
INSERT INTO `ref_mst_component_resource` VALUES (1,'CUST_COM1','CHART','customer','Monthwise Beneficiary Entry Of Current Year','monthwiseCustOfCurrentYear','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:35:59');
INSERT INTO `ref_mst_component_resource` VALUES (2,'CUST_COM2','CHART','customer','Project','schmwiseCustPayOfCurntYear','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 13:49:33');
INSERT INTO `ref_mst_component_resource` VALUES (3,'CUST_COM3','CHART','customer','Total Beneficiary Per Collector','totalCustomerPerOfficer','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:50:10');
INSERT INTO `ref_mst_component_resource` VALUES (4,'CUST_COM4','CHART','customer','Total Beneficiary Per Location','totalCustomerPerLocation','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:50:27');
INSERT INTO `ref_mst_component_resource` VALUES (5,'CUST_COM5','CHART','customer','Total Beneficiary vs Payment Disburse','totalCustVsPaymntDisburse','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:50:39');
INSERT INTO `ref_mst_component_resource` VALUES (6,'TRAN_COM1','CHART','transaction','Payment Receipt In Different Types','payRecInDiffTypes','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:50:53');
INSERT INTO `ref_mst_component_resource` VALUES (7,'TRAN_COM2','CHART','transaction','Payment Receipt In Different Types','payRecInDiffTypes','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:37:42');
INSERT INTO `ref_mst_component_resource` VALUES (8,'CUST_COM7','AJAX','customer','Beneficiary Information','customerInfo','ref',NULL,NULL,NULL,'dbd/index','custcomp',NULL,NULL,7,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:37:57');
INSERT INTO `ref_mst_component_resource` VALUES (9,'REF_COM1','AJAX','reference','Total Beneficiary Project Collector Location','totalCustSchmCollLoc','ref',NULL,NULL,NULL,'ref/index','totalinfo',NULL,NULL,8,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:38:18');
INSERT INTO `ref_mst_component_resource` VALUES (10,'CUST_COM6','CHART','customer','Collector Due Payment','colDuePymt','ref',NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:38:26');
INSERT INTO `ref_mst_component_resource` VALUES (11,'TRAN_COM3','CHART','transaction','Payment Of Last 3 Months','pymtLstThreeMnth','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,10,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:38:38');
INSERT INTO `ref_mst_component_resource` VALUES (12,'TRAN_COM4','CHART','transaction','Payment Of Last 3 Years','pymtLstThreeYrs','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:38:49');
INSERT INTO `ref_mst_component_resource` VALUES (13,'TRAN_COM5','CHART','transaction','Project Wise Total Receipt','schmWiseTotalRec','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:39:05');
INSERT INTO `ref_mst_component_resource` VALUES (14,'TRAN_COM6','CHART','transaction','Project Wise Total Due','schmWiseTotalDue','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:39:23');
INSERT INTO `ref_mst_component_resource` VALUES (15,'TRAN_COM7','CHART','transaction','Top 10 Payment Location','topTenPymtLoc','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:39:33');
INSERT INTO `ref_mst_component_resource` VALUES (16,'TRAN_COM8','CHART','transaction','Project Type Based Total Loan','schmTypTotalLoan','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:39:48');
INSERT INTO `ref_mst_component_resource` VALUES (17,'TRAN_COM9','CHART','transaction','Collector Wise During The Year Total Payment','collWiseTotalPayCurrentYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,16,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-21 13:56:47');
INSERT INTO `ref_mst_component_resource` VALUES (18,'TRAN_COM10','CHART','customer','Project Wise Total Beneficiary Of Current Year','schmWiseTotalCustCurrentYear',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:40:38');
INSERT INTO `ref_mst_component_resource` VALUES (19,'TRAN_COM11','CHART','transaction','Payment Recept And Due Of Current Year','payReceptDueCurrentYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:41:01');
INSERT INTO `ref_mst_component_resource` VALUES (20,'TRAN_COM12','CHART','transaction','Project Type Wise Total Receipt Of Current Year','schmTypeWiseTotalReceptCurrYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:41:44');
INSERT INTO `ref_mst_component_resource` VALUES (21,'TRAN_COM13','CHART','transaction','Top 10 Location With Maximum Receipt','topTenReceptLocCurrYear',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:52:21');
INSERT INTO `ref_mst_component_resource` VALUES (22,'TRAN_COM14','CHART','transaction','Payment And Recept Of Current Week','payReceptCurrentWeek',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:43:00');
INSERT INTO `ref_mst_component_resource` VALUES (23,'TRAN_COM15','CHART','transaction','Top 10 Location With Maximum Due','topTenDueLocCurrYear',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:52:38');
INSERT INTO `ref_mst_component_resource` VALUES (24,'TRAN_COM16','CHART','transaction','Month Wise Payment Of Current Year','monthWisePaymentCurrYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,23,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:43:36');
INSERT INTO `ref_mst_component_resource` VALUES (25,'TRAN_COM17','CHART','transaction','Month Wise Recept Of Current Year','monthWiseReceptCurrYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,24,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 19:44:01');
INSERT INTO `ref_mst_component_resource` VALUES (26,'TRAN_COM18','CHART','transaction','Project Wise During The Year Total Payment','schmWisePaymentCurrYear','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,25,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-21 13:54:52');
INSERT INTO `ref_mst_component_resource` VALUES (27,'TRAN_COM19','CHART','transaction','Last Month Project Wise Total Payment','lstMnthSchmWisePayment','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,26,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-21 16:36:22');
INSERT INTO `ref_mst_component_resource` VALUES (28,'TRAN_COM20','CHART','transaction','Last Month Collector Wise Total Payment','lstMnthCollWisePayment','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,27,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-21 17:17:06');
INSERT INTO `ref_mst_component_resource` VALUES (29,'TRAN_COM21','CHART','transaction','Last Month Collector Wise Total Installment','lstMnthCollWiseRecept','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,28,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-23 12:22:54');
INSERT INTO `ref_mst_component_resource` VALUES (30,'TRAN_COM22','CHART','transaction','Last Month Project Wise Total Installment','lstMnthSchmWiseReceipt','trn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,29,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-23 12:35:02');
/*!40000 ALTER TABLE `ref_mst_component_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_disp_comp_group`
--

DROP TABLE IF EXISTS `ref_mst_disp_comp_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_disp_comp_group` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ENTERPRISE_ID` varchar(40) DEFAULT NULL,
  `COMP_DISPLAY_GROUP_ID` varchar(20) DEFAULT NULL,
  `COMP_DISPLAY_GROUP_NAME` varchar(20) DEFAULT NULL,
  `DISPLAY_NAME` varchar(20) DEFAULT NULL,
  `ASSOC_SCREEN_ID` varchar(20) DEFAULT NULL,
  `SCREEN_POSITION` varchar(20) DEFAULT NULL,
  `DISPLAY_ORDER` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_disp_comp_group`
--

LOCK TABLES `ref_mst_disp_comp_group` WRITE;
/*!40000 ALTER TABLE `ref_mst_disp_comp_group` DISABLE KEYS */;
INSERT INTO `ref_mst_disp_comp_group` VALUES (26,NULL,'New_Comp1','New Comp1','New Comp1','ref','Center',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:44:01');
INSERT INTO `ref_mst_disp_comp_group` VALUES (27,NULL,'New_Comp1','New Comp1','New Comp1','trn','Center',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:44:01');
INSERT INTO `ref_mst_disp_comp_group` VALUES (29,NULL,'New_Comp2','New Comp2','New Comp2','trn','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_mst_disp_comp_group` VALUES (30,NULL,'New_Comp2','New Comp2','New Comp2','visrpt','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 20:03:59');
INSERT INTO `ref_mst_disp_comp_group` VALUES (53,NULL,'FINAL_TEST_COMP_1','FINAL TEST COMP 1','FINAL TEST COMP 1','xls','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-25 15:13:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (55,NULL,'GROUP_1','GROUP 1','GROUP 1','dbd','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:31');
INSERT INTO `ref_mst_disp_comp_group` VALUES (56,NULL,'GROUP_1','GROUP 1','GROUP 1','ref','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-06-16 06:21:32');
INSERT INTO `ref_mst_disp_comp_group` VALUES (64,NULL,'MIDDLE','MIDDLE','MIDDLE','dbd','Center',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-05 03:41:40');
INSERT INTO `ref_mst_disp_comp_group` VALUES (65,NULL,'NEW','NEW','NEW','dbd','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-05 03:43:45');
INSERT INTO `ref_mst_disp_comp_group` VALUES (66,NULL,'RIGHT_GROUP','RIGHT_GROUP','RIGHT_GROUP','ref','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (67,NULL,'RIGHT_GROUP','RIGHT_GROUP','RIGHT_GROUP','trn','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (68,NULL,'RIGHT_GROUP','RIGHT_GROUP','RIGHT_GROUP','xls','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (69,NULL,'RIGHT_GROUP','RIGHT_GROUP','RIGHT_GROUP','rpt','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (70,NULL,'RIGHT_GROUP','RIGHT_GROUP','RIGHT_GROUP','visrpt','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:42:04');
INSERT INTO `ref_mst_disp_comp_group` VALUES (72,NULL,'RIGHT','RIGHT','RIGHT','dbd','Right',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:46:52');
INSERT INTO `ref_mst_disp_comp_group` VALUES (73,NULL,'LEFT','LEFT','LEFT','dbd','Left',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-09-05 05:48:19');
/*!40000 ALTER TABLE `ref_mst_disp_comp_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_entity`
--

DROP TABLE IF EXISTS `ref_mst_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_entity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` varchar(20) DEFAULT NULL,
  `ENTITY_TYPE` varchar(20) DEFAULT NULL,
  `PARENT_ENTITY_ID` varchar(20) DEFAULT '',
  `ENTITY_UNIQUE_ID` varchar(20) DEFAULT NULL,
  `ENTITY_NAME` varchar(100) DEFAULT NULL,
  `ENTITY_DESC` mediumtext,
  `NAME` varchar(100) DEFAULT NULL,
  `AGE` int(10) DEFAULT NULL,
  `SEX` varchar(1) DEFAULT NULL,
  `CUSTOMER_ID` varchar(20) DEFAULT NULL,
  `CUSTOMER_APPLN_ID` varchar(20) DEFAULT NULL,
  `CUSTOMER_UNIQUE_ID` varchar(20) DEFAULT NULL,
  `CUSTOMER_ENTRY_DATE` date DEFAULT NULL,
  `CUSTOMER_EXIT_DATE` date DEFAULT NULL,
  `SCHEME_ID` varchar(10) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `EMPLOYEE_JOIN_DATE` date DEFAULT NULL,
  `EMPLOYEE_EXIT_DATE` date DEFAULT NULL,
  `EMPLOYEE_DESIGNATION` varchar(30) DEFAULT NULL,
  `AGENT_ID` varchar(20) DEFAULT NULL,
  `AGENT_JOIN_DATE` date DEFAULT NULL,
  `AGENT_EXIT_DATE` date DEFAULT NULL,
  `ADDRESS_ID` varchar(20) DEFAULT NULL,
  `PERMANENT_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `MAIL_ADDRESS_ID` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CUSTOMER_SCHEME_ID` varchar(20) DEFAULT NULL,
  `LOCATION_ID` varchar(20) DEFAULT NULL,
  `IMAGE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `I_RME_ENTITY_ID` (`ENTITY_ID`,`ID`),
  UNIQUE KEY `I_RME_ADDRESS_ID` (`ADDRESS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=158527 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_entity`
--

LOCK TABLES `ref_mst_entity` WRITE;
/*!40000 ALTER TABLE `ref_mst_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_entity_group`
--

DROP TABLE IF EXISTS `ref_mst_entity_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_entity_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_GROUP_ID` varchar(20) DEFAULT NULL,
  `ENTITY_GROUP_NAME` varchar(40) DEFAULT NULL,
  `ENTITY_GROUP_DESC` mediumtext,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_entity_group`
--

LOCK TABLES `ref_mst_entity_group` WRITE;
/*!40000 ALTER TABLE `ref_mst_entity_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_entity_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_fin_year_info`
--

DROP TABLE IF EXISTS `ref_mst_fin_year_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_fin_year_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIN_YEAR_START_DAY` int(20) DEFAULT NULL,
  `FIN_YEAR_START_MONTH` int(20) DEFAULT NULL,
  `FIN_YEAR_START` int(20) DEFAULT NULL,
  `FIN_YEAR_END_DAY` int(20) DEFAULT NULL,
  `FIN_YEAR_END_MONTH` int(20) DEFAULT NULL,
  `FIN_YEAR_END` int(20) DEFAULT NULL,
  `DESCRIPTION` mediumtext,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'DEACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_fin_year_info`
--

LOCK TABLES `ref_mst_fin_year_info` WRITE;
/*!40000 ALTER TABLE `ref_mst_fin_year_info` DISABLE KEYS */;
INSERT INTO `ref_mst_fin_year_info` VALUES (1,1,4,2011,31,3,2012,'Previous Current Year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-08-28 00:33:41');
INSERT INTO `ref_mst_fin_year_info` VALUES (2,1,4,2010,31,3,2011,'Previous Year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-06-16 02:07:46');
INSERT INTO `ref_mst_fin_year_info` VALUES (3,1,4,2012,31,3,2013,'previous year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-07-23 07:09:01');
INSERT INTO `ref_mst_fin_year_info` VALUES (4,1,4,2013,31,3,2014,'current year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-12-19 03:53:53');
INSERT INTO `ref_mst_fin_year_info` VALUES (5,1,4,2014,31,3,2015,'Current Year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2018-01-11 07:26:35');
INSERT INTO `ref_mst_fin_year_info` VALUES (6,1,4,2015,31,3,2016,'current year','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2018-01-11 07:26:35');
INSERT INTO `ref_mst_fin_year_info` VALUES (7,1,4,2016,31,3,2017,'current year','DEACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2018-01-11 04:38:47');
/*!40000 ALTER TABLE `ref_mst_fin_year_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_hierarchy_resource`
--

DROP TABLE IF EXISTS `ref_mst_hierarchy_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_hierarchy_resource` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `RESOURCE_MASTER_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RESOURCE_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `RESOURCE_TYPE` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MODULE_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PARENT_ACTION_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `URL_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MENU_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SCREEN_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BATCH_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_NAME` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_DESC` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `RESOURCE_URL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESOURCE_MASTER_PARENT_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISPLAY_SEQUENCE` int(3) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVE',
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `RESOURCE_MASTER_ID` (`RESOURCE_MASTER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_hierarchy_resource`
--

LOCK TABLES `ref_mst_hierarchy_resource` WRITE;
/*!40000 ALTER TABLE `ref_mst_hierarchy_resource` DISABLE KEYS */;
INSERT INTO `ref_mst_hierarchy_resource` VALUES (1,'ROOT','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:11:49');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (2,'ref_customer','customer','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Beneficiary','customer','/ref/customer','ref',4,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 19:42:21');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (3,'rpt_investsummary','investsummary','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Investment Summary','investsummary','/rpt/investsummary','rpt',5,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:12:32');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (4,'rpt_report1','report1','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Customer','report1','/rpt/report1','rpt',6,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (5,'rpt_report2','report2','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Collection Agent','report2','/rpt/report2','rpt',7,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (6,'rpt_report3','report3','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Project Based Collection','report3','/rpt/report3','rpt',8,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (7,'rpt_report4','report4','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Date Base Collection','report4','/rpt/report4','rpt',9,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (8,'rpt_report5','report5','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Amount Distribution','report5','/rpt/report5','rpt',10,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (9,'dbd','index','breadcrumb','dbd',NULL,NULL,'index',NULL,NULL,'Dashboard','Dashboard','/dbd','ROOT',1,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (10,'ref','index','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Reference','Reference','/ref','ROOT',2,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (11,'rpt','index','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Reports','Reports','/rpt','ROOT',3,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (12,'rpt_report6','report6','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Field Collection','report6','/rpt/report6','rpt',11,'ACTIVE','NORMAL','BB','2009-03-04 01:17:30','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (13,'ref_employee','employee','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Collector','employee','/ref/employee','ref',12,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 19:50:37');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (15,'adm','index','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Admin','Admin','/adm','ROOT',4,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (16,'adm_custxlslogmanagement','custxlslogmanagement','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Beneficiary Log','custxlslogmanagement','/adm/custxlslogmanagement','adm_logmanagement',13,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (17,'trn','index','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Transaction','Transaction','/trn','ROOT',14,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (18,'trn_payment','payment','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Payment','Payment','/trn/payment','trn',15,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (19,'trn_receive','receive','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Receive','Receive','/trn/receive','trn',16,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (20,'ref_location','location','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Location','Location','/ref/location','ref',17,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 19:50:41');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (21,'ref_scheme','scheme','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Project','Scheme','/ref/scheme','ref',18,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 19:52:34');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (22,'trn_excel','excel','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Import: Payment Receipt','Excel Upload','/trn/excel','dbd_index_excelupload',18,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (29,'dbd_index_excelupload','index','breadcrumb','dbd',NULL,NULL,'xlsexpimp',NULL,NULL,'Import/Export','Import/Export','/dbd/index/xlsexpimp','ROOT',19,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-05 12:14:00');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (30,'ref_customerexcel','customerexcel','breadcrumb','ref',NULL,NULL,'index',NULL,NULL,'Import: Beneficiary',NULL,'/ref/customerexcel','dbd_index_excelupload',1,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 19:57:31');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (31,'rpt_customer','customer','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Customer',NULL,'/rpt/customer','rpt',1,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (32,'adm_tranxlslogmanagement','tranxlslogmanagement','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Transaction Log','tranxlslogmanagement','/adm/tranxlslogmanagement','adm_logmanagement',14,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (33,'adm_logfilemanagement','logfilemanagement','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'System Log',NULL,'/adm/logfilemanagement','adm_logmanagement',20,'ACTIVE','NORMAL','BB','0000-00-00 00:00:00','BB','2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (35,'ref_customerexcel_custexport','customerexcel','breadcrumb','ref',NULL,NULL,'custexport',NULL,NULL,'Export: Beneficiary',NULL,'/ref/customerexcel/custexport','dbd_index_excelupload',22,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 19:59:39');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (36,'trn_excel_transexport','excel','breadcrumb','trn',NULL,NULL,'transexport',NULL,NULL,'Export: Payment Receipt',NULL,'/trn/excel/transexport','dbd_index_excelupload',23,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (38,'rpt_report8','report8','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Entity Report 8 ',NULL,'/rpt/report8','rpt',25,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (39,'rpt_report7','report7','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Entity Report 7 ',NULL,'/rpt/report7','rpt',24,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (40,'ref_customer_adduser','customer','breadcrumb','ref',NULL,NULL,'adduser',NULL,NULL,'Add New Beneficiary',NULL,'/ref/customer/adduser','ref_customer',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (41,'ref_customer_edituser','customer','breadcrumb','ref',NULL,NULL,'edituser',NULL,NULL,'Edit Existing Beneficiary',NULL,'/ref/customer/edituser','ref_customer',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (42,'ref_employee_addemployee','employee','breadcrumb','ref',NULL,NULL,'addemployee',NULL,NULL,'Add New Collector',NULL,'/ref/employee/addemployee','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (43,'ref_employee_editemp','employee','breadcrumb','ref',NULL,NULL,'editemp',NULL,NULL,'Edit Existing Collector',NULL,'/ref/employee/editemp','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (44,'ref_employee_emplocmap','employee','breadcrumb','ref',NULL,NULL,'emplocmap',NULL,NULL,'Collector Location Map',NULL,'/ref/employee/emplocmap','ref_employee',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (45,'ref_location_add','location','breadcrumb','ref',NULL,NULL,'add',NULL,NULL,'Add New Location',NULL,'/ref/location/add','ref_location',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (46,'ref_location_edit','location','breadcrumb','ref',NULL,NULL,'edit',NULL,NULL,'Edit Existing location',NULL,'/ref/location/edit','ref_location',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (47,'ref_scheme_addschm','scheme','breadcrumb','ref',NULL,NULL,'addschm',NULL,NULL,'Add New Project',NULL,'/ref/scheme/addschm','ref_scheme',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (48,'ref_scheme_editschm','scheme','breadcrumb','ref',NULL,NULL,'editschm',NULL,NULL,'Edit Existing Project',NULL,'/ref/scheme/editschm','ref_scheme',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (49,'trn_payment_addsummary','payment','breadcrumb','trn',NULL,NULL,'addsummary',NULL,NULL,'Beneficiary Payment',NULL,'/trn/payment/addsummary','trn_payment',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 17:19:58');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (50,'trn_payment_editsummary','payment','breadcrumb','trn','index',NULL,'editsummary',NULL,NULL,'Edit Existing Beneficiary Payment',NULL,'/trn/payment/editsummary','trn_payment',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (51,'trn_payment_editsummary_2','payment','breadcrumb','trn','addsummary',NULL,'editsummary',NULL,NULL,'Edit Existing Beneficiary Payment',NULL,'/trn/payment/editsummary','trn_payment_addsummary',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (52,'trn_receive_adddetails','receive','breadcrumb','trn',NULL,NULL,'adddetails',NULL,NULL,'Beneficiary Receive',NULL,'/trn/receive/adddetails','trn_receive',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 17:20:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (53,'trn_receive_editdtl','receive','breadcrumb','trn','index',NULL,'editdtl',NULL,NULL,'Edit Existing Beneficiary Receipt',NULL,'/trn/receive/editdtl','trn_receive',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (54,'trn_receive_editdtl_2','receive','breadcrumb','trn','adddetails',NULL,'editdtl',NULL,NULL,'Edit Existing Beneficiary Receipt',NULL,'/trn/receive/editdtl','trn_receive_adddetails',NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (55,'dbd_index_mgmtinfsys','index','breadcrumb','dbd',NULL,NULL,'mgmtinfsys',NULL,NULL,'Visual Reports',NULL,'/dbd/index/mgmtinfsys','ROOT',26,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:29:47');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (56,'adm_useraccesscontrol','useraccesscontrol','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Access Control',NULL,'/adm/useraccesscontrol','adm',27,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (57,'adm_useraccesscontrol_usercreation','useraccesscontrol','','adm',NULL,NULL,'usercreation',NULL,NULL,'User Creation',NULL,'/adm/useraccesscontrol/usercreation','adm_useraccesscontrol',28,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-23 13:23:09');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (58,'adm_useraccesscontrol_rolecreation','useraccesscontrol','breadcrumb','adm',NULL,NULL,'rolecreation',NULL,NULL,'Role Creation',NULL,'/adm/useraccesscontrol/rolecreation','adm_useraccesscontrol',29,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (59,'adm_useraccesscontrol_mapmenutorole1','useraccesscontrol','breadcrumb','adm',NULL,NULL,'mapmenutorole',NULL,NULL,'Map Menu To Role',NULL,'/adm/useraccesscontrol/mapmenutorole','adm_useraccesscontrol',30,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-21 16:08:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (60,'adm_maproletouser','maproletouser','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Map Roles To Users',NULL,'/adm/maproletouser/index','adm_useraccesscontrol',31,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-04 20:47:51');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (61,'adm_usercreation','usercreation','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'User Creation',NULL,'/adm/usercreation','adm_useraccesscontrol',28,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-23 13:23:44');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (62,'adm_usercreation2','usercreation','breadcrumb','adm',NULL,NULL,'addappuser',NULL,NULL,'Add New User',NULL,'/adm/usercreation/addappuser','adm_usercreation',33,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-24 11:42:32');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (63,'adm_usercreation3','usercreation','breadcrumb','adm',NULL,NULL,'editappuser',NULL,NULL,'Edit User',NULL,'/adm/usercreation/editappuser','adm_usercreation',34,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-24 12:21:43');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (64,'adm_logmanagement','index','breadcrumb','adm',NULL,NULL,'logmanagement',NULL,NULL,NULL,NULL,'/adm/index/logmanagement','adm',29,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-25 20:22:31');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (65,'adm_maproletouser_mapuserrole','maproletouser','breadcrumb','adm',NULL,NULL,'mapuserrole',NULL,NULL,'Map Roles To User',NULL,'/adm/maproletouser/mapuserrole','adm_maproletouser',35,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:10:13');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (66,'adm_maproletouser_editmapuserrole','maproletouser','','adm',NULL,NULL,'editmapuserrole',NULL,NULL,'Edit Roles Mapping To User',NULL,'/adm/maproletouser/editmapuserrole','adm_maproletouser',36,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-27 13:10:40');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (67,'dbd_error','error','breadcrumb','dbd',NULL,NULL,'error',NULL,NULL,'Error',NULL,'','ROOT',37,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-25 20:41:59');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (68,'adm_rolecreation','rolecreation','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Role Creation',NULL,'/adm/rolecreation','adm_useraccesscontrol',38,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 17:23:01');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (69,'adm_rolecreation_addrole','rolecreation','breadcrumb','adm',NULL,NULL,'addrole',NULL,NULL,'Add New Role',NULL,'/adm/rolecreation/addrole','adm_rolecreation',39,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 18:09:06');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (70,'adm_rolecreation_editrole','rolecreation','breadcrumb','adm',NULL,NULL,'editrole',NULL,NULL,'Edit Application Role',NULL,'/adm/rolecreation/editrole','adm_rolecreation',40,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 17:27:19');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (71,'adm_mapmenutorole','mapmenutorole','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Map Menus To Role',NULL,'/adm/mapmenutorole','adm_useraccesscontrol',41,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 17:34:15');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (72,'adm_mapmenutorole_maprolemenu','mapmenutorole','breadcrumb','adm',NULL,NULL,'maprolemenu',NULL,NULL,'Edit Menu Mapping To Role',NULL,'/adm/mapmenutorole/maprolemenu','adm_mapmenutorole',42,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-28 17:35:32');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (73,'dbd_chartmis','chartmis','breadcrumb','dbd',NULL,NULL,'index',NULL,NULL,'MIS',NULL,'/dbd/chartmis','dbd_index_mgmtinfsys',43,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:29:47');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (74,'rpt_report9','report9','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'[Report] Coll. Sch. Summary',NULL,'/rpt/report9','rpt',44,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-04 20:18:30');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (75,'memo_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Memo',NULL,'#','rpt',45,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 12:47:54');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (76,'rpt_dlysmrymemo','dlysmrymemo','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Daily Summary',NULL,'/rpt/dlysmrymemo','memo_report',46,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 12:52:00');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (77,'rpt_wklysmrymemo','wklysmrymemo','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Weekly Summary',NULL,'/rpt/wklysmrymemo','memo_report',47,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:04:53');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (78,'rpt_mnthsmrymemo','mnthsmrymemo','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Monthly Summary',NULL,'/rpt/mnthsmrymemo','memo_report',48,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:09:02');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (79,'rpt_dlydtlsmemo','dlydtlsmemo','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Daily Details',NULL,'/rpt/dlydtlsmemo','memo_report',49,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:13:21');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (80,'voucher_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Voucher',NULL,'#','rpt',50,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:22:30');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (81,'rpt_dlysmryvchr','dlysmryvchr','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Daily Summary',NULL,'/rpt/dlysmryvchr','voucher_report',51,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:25:52');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (82,'rpt_wklysmryvchr','wklysmryvchr','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Weekly Summary',NULL,'/rpt/wklysmryvchr','voucher_report',52,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:28:07');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (83,'rpt_mnthsmryvchr','mnthsmryvchr','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Monthly Summary',NULL,'/rpt/mnthsmryvchr','voucher_report',53,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:29:45');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (84,'rpt_dlydtlsvchr','dlydtlsvchr','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Daily Details',NULL,'/rpt/dlydtlsvchr','voucher_report',54,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 13:31:26');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (85,'client_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Beneficiary',NULL,'#','rpt',55,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (86,'rpt_dtlcust','dtlcust','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl#1',NULL,'/rpt/dtlcust','Client_report',56,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (87,'rpt_dtlcust2','dtlcust2','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl#2',NULL,'/rpt/dtlcust2','client_report',57,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (88,'rpt_dtlcust3','dtlcust3','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Dtl#3',NULL,'/rpt/dtlcust3','client_report',58,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (89,'collector_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Collector',NULL,'#','rpt',59,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:04:00');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (90,'rpt_collsmryact','collsmryact','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector',NULL,'/rpt/collsmryact','collector_report',60,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:16:28');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (91,'rpt_colllocsmryact','colllocsmryact','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector Location',NULL,'/rpt/colllocsmryact','collector_report',61,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (92,'rpt_colllocgndrsmryact','colllocgndrsmryact','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Coll Loc Gender Summary',NULL,'/rpt/colllocgndrsmryact','collector_report',62,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (93,'rpt_colllocgndrdtlsact','colllocgndrdtlsact','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Coll Loc Gender Details',NULL,'/rpt/colllocgndrdtlsact','collector_report',63,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (94,'topsheet_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Topsheet',NULL,'#','rpt',64,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:25:00');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (95,'rpt_colltopsht','colltopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector',NULL,'/rpt/colltopsht','topsheet_report',65,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:24:52');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (96,'rpt_schmtopsht','schmtopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Project',NULL,'/rpt/schmtopsht','topsheet_report',66,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (97,'rpt_weektopsht','weektopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Week',NULL,'/rpt/weektopsht','topsheet_report',67,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:34:21');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (98,'rpt_loctopsht','loctopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Location',NULL,'/rpt/loctopsht','topsheet_report',68,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:35:22');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (99,'rpt_mnthtopsht','mnthtopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Month',NULL,'/rpt/mnthtopsht','topsheet_report',69,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:36:40');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (100,'rpt_dtltopsht','dtltopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Details',NULL,'/rpt/dtltopsht','topsheet_report',70,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:38:14');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (101,'rpt_acnttyptopsht','acnttyptopsht','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Account Type',NULL,'/rpt/acnttyptopsht','topsheet_report',71,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 14:40:32');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (102,'par_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'PAR',NULL,'#','rpt',72,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (103,'rpt_collpar','collpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector',NULL,'/rpt/collpar','par_report',73,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 15:23:19');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (104,'rpt_collschmpar','collschmpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector Project',NULL,'/rpt/collschmpar','par_report',74,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (105,'rpt_collschmlocpar','collschmlocpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector Project Location',NULL,'/rpt/collschmlocpar','par_report',75,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (106,'rpt_schmpar','schmpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Project',NULL,'/rpt/schmpar','par_report',76,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (107,'rpt_locpar','locpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Location',NULL,'/rpt/locpar','par_report',77,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 15:27:52');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (108,'rpt_gndrpar','gndrpar','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Gender',NULL,'/rpt/gndrpar','par_report',78,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 15:29:17');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (109,'operational_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Operation',NULL,'#','rpt',79,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (110,'rpt_bsd','bsd','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Donation(BSD)',NULL,'/rpt/bsd','css_report',80,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:30:47');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (111,'rpt_collpayrec','collpayrec','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Collector Payment Recept',NULL,'/rpt/collpayrec','operational_report',81,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (112,'mis_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'MIS',NULL,'#','rpt',82,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-12-01 15:37:18');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (113,'rpt_schmpymtrecmis','schmpymtrecmis','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Project Payment Receipt',NULL,'/rpt/schmpymtrecmis','mis_report',83,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (114,'rpt_gndrpymtrecmis','gndrpymtrecmis','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Gender Payment Receipt',NULL,'/rpt/gndrpymtrecmis','mis_report',84,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (115,'rpt_mnthpymtrecmis','mnthpymtrecmis','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Month Payment Receipt',NULL,'/rpt/mnthpymtrecmis','mis_report',85,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (116,'rpt_locpymtrecmis','locpymtrecmis','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Location Payment Receipt',NULL,'/rpt/locpymtrecmis','mis_report',86,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:18:48');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (118,'trn_multipay','multipay','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Grid: Payment',NULL,'/trn/multipay','trn',88,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (119,'trn_multirec','multirec','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Grid: Receipt',NULL,'/trn/multirec','trn',89,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:56:50');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (120,'trn_multipaycust','multipaycust','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Grid: Beneficiary Pay(opt)',NULL,'/trn/multipaycust','trn',90,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 12:12:03');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (121,'trn_multipaycust2','multipaycust2','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Grid: Beneficiary Pay(Mand)',NULL,'/trn/multipaycust2','trn',91,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 12:12:03');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (122,'trn_custpayexcel','custpayexcel','breadcrumb','trn',NULL,NULL,'index',NULL,NULL,'Import: Beneficiary Payment',NULL,'/trn/custpayexcel','dbd_index_excelupload',92,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 12:17:46');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (123,'css_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'CSS Custom',NULL,'#','rpt',93,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:20:56');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (124,'rpt_csscustdtlschdl','csscustdtlschdl','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Schedule',NULL,'/rpt/csscustdtlschdl','css_report',94,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:24:53');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (125,'rpt_custloc','custloc','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Beneficiary Location Gender',NULL,'/rpt/custloc','css_report',95,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:27:06');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (127,'exception_report','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Exception',NULL,'#','rpt',96,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:48:14');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (128,'rpt_fupaydate','fupaydate','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Payment Future Entries',NULL,'/rpt/fupaydate','exception_report',97,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 13:58:56');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (129,'rpt_furecdate','furecdate','breadcrumb','rpt',NULL,NULL,'index',NULL,NULL,'Receipt Future Entries',NULL,'/rpt/furecdate','exception_report',98,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:48:20');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (130,'adm_compacc_control','','breadcrumb',NULL,NULL,NULL,NULL,NULL,NULL,'Component Access Control',NULL,'#','adm',99,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:48:53');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (131,'adm_compscreen','compscreen','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Component Display Group',NULL,'/adm/compscreen','adm_compacc_control',100,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:53:41');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (132,'adm_compaccess','compaccess','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Map Roles to Disp Groups',NULL,'/adm/compaccess','adm_compacc_control',101,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 16:57:22');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (133,'adm_compscreen_entry','compscreen','breadcrumb','adm',NULL,NULL,'entry',NULL,NULL,'New Component Group',NULL,'/adm/compscreen/entry','adm_compscreen',102,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 17:10:03');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (134,'adm_compaccess_entry','compaccess','breadcrumb','adm',NULL,NULL,'entry',NULL,NULL,'Map Component Groups to Roles',NULL,'/adm/compaccess/entry','adm_compaccess',103,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-05 17:15:04');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (135,'ref_multicust_insertcust','multicust','breadcrumb','ref',NULL,NULL,'insertcust',NULL,NULL,'Grid: Beneficiary',NULL,'/ref/multicust/insertcust','ref',104,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-08 15:38:13');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (136,'adm_fin_year','','breadcrumb','adm',NULL,NULL,NULL,NULL,NULL,'Financial Period',NULL,'#','adm',105,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 11:35:56');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (137,'adm_finyear','finyear','breadcrumb','adm',NULL,NULL,'index',NULL,NULL,'Financial Period Setup',NULL,'/adm/finyear','adm_fin_year',106,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 11:35:56');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (138,'adm_finyear_addfinyear','finyear','breadcrumb','adm',NULL,NULL,'addfinyear',NULL,NULL,'Add New Financial Period',NULL,'/adm/finyear/addfinyear','adm_finyear',107,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 11:35:56');
INSERT INTO `ref_mst_hierarchy_resource` VALUES (139,'adm_finyear_editfinyear','finyear','breadcrumb','adm',NULL,NULL,'editfinyear',NULL,NULL,'Edit Existing Financial Period',NULL,'/adm/finyear/editfinyear','adm_finyear',108,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-12 11:35:56');
/*!40000 ALTER TABLE `ref_mst_hierarchy_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_location`
--

DROP TABLE IF EXISTS `ref_mst_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOCATION_ID` varchar(20) DEFAULT NULL,
  `PARENT_LOCATION_ID` varchar(20) DEFAULT NULL,
  `LOCATION_NAME` varchar(250) DEFAULT NULL,
  `LOCATION_DESC` mediumtext,
  `LOCATION_TYPE` varchar(20) DEFAULT NULL,
  `LOCATION_LEVEL` int(10) DEFAULT NULL,
  `ADDRESS_ID` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_location`
--

LOCK TABLES `ref_mst_location` WRITE;
/*!40000 ALTER TABLE `ref_mst_location` DISABLE KEYS */;
INSERT INTO `ref_mst_location` VALUES (1,'WORLD','','WORLD','WORLD','1',1,'1','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-13 12:26:59');
INSERT INTO `ref_mst_location` VALUES (9,'WEST BENGAL','WORLD','WEST BENGAL','WEST BENGAL','3',2,'9','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:38:33');
INSERT INTO `ref_mst_location` VALUES (10,'HOWRAH','WEST BENGAL','HOWRAH','HOWRAH','4',3,'10','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:11:24');
INSERT INTO `ref_mst_location` VALUES (11,'HOOGLY','WEST BENGAL','HOOGLY','HOOGLY','4',3,'11','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:11:24');
INSERT INTO `ref_mst_location` VALUES (12,'NADIA','WEST BENGAL','NADIA','NADIA','4',3,'12','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:11:24');
INSERT INTO `ref_mst_location` VALUES (13,'NORTH 24 PARGANAS','WEST BENGAL','NORTH 24 PARGANAS','NORTH 24 PARGANAS','4',1,'13','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:11:24');
INSERT INTO `ref_mst_location` VALUES (14,'asdsadsa','WEST BENGAL','assad','sasadasd','2',3,'14','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:49:50');
INSERT INTO `ref_mst_location` VALUES (15,'DAAS','WEST BENGAL','SAS','DAAS','4',3,'15','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:49:50');
INSERT INTO `ref_mst_location` VALUES (16,'DAAS1','WEST BENGAL','SAS','DAAS','4',3,'16','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:49:50');
INSERT INTO `ref_mst_location` VALUES (17,'AMI','WEST BENGAL','AMI','AMI','4',3,'17','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:49:50');
INSERT INTO `ref_mst_location` VALUES (18,'TUMI','WEST BENGAL','TUMI','TUMI','4',3,'18','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 03:49:50');
INSERT INTO `ref_mst_location` VALUES (19,'NORTH 24 PARGANAS','WEST BENGAL','NORTH 24 PARGANAS','NORTH 24 PARGANAS','4',3,'19','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:12:58');
INSERT INTO `ref_mst_location` VALUES (20,'HOOGLY','WEST BENGAL','HOOGLY','HOOGLY','4',3,'20','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:12:58');
INSERT INTO `ref_mst_location` VALUES (21,'HOWRAH','WEST BENGAL','HOWRAH','HOWRAH','4',3,'21','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:13:23');
INSERT INTO `ref_mst_location` VALUES (22,'NADIA','WEST BENGAL','NADIA','NADIA','4',3,'22','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:13:23');
INSERT INTO `ref_mst_location` VALUES (23,'BAGHATI','NORTH 24 PARGANAS','BAGHATI','BAGHATI','8',4,'23','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-11-02 03:37:19');
INSERT INTO `ref_mst_location` VALUES (24,'BELLEY','NORTH 24 PARGANAS','BELLEY','BELLEY','8',4,'24','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:20');
INSERT INTO `ref_mst_location` VALUES (25,'BIJNA','NORTH 24 PARGANAS','BIJNA','BIJNA','8',4,'25','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:20');
INSERT INTO `ref_mst_location` VALUES (26,'HARISHPUR','NORTH 24 PARGANAS','HARISHPUR','HARISHPUR','8',4,'26','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:20');
INSERT INTO `ref_mst_location` VALUES (27,'PANPUR','NORTH 24 PARGANAS','PANPUR','PANPUR','8',4,'27','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:20');
INSERT INTO `ref_mst_location` VALUES (28,'SANKARPUR','NORTH 24 PARGANAS','SANKARPUR','SANKARPUR','8',4,'28','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:21');
INSERT INTO `ref_mst_location` VALUES (29,'TETULIA','NORTH 24 PARGANAS','TETULIA','TETULIA','8',4,'29','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:21:34');
INSERT INTO `ref_mst_location` VALUES (30,'ALAMPUR','HOWRAH','ALAMPUR','ALAMPUR','8',4,'30','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (31,'AMTA','HOWRAH','AMTA','AMTA','8',4,'31','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (32,'BANNAPARA','HOWRAH','BANNAPARA','BANNAPARA','8',4,'32','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (33,'BOURIYA','HOWRAH','BOURIYA','BOURIYA','8',4,'33','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (34,'CHAMPATALA','HOWRAH','CHAMPATALA','CHAMPATALA','8',4,'34','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (35,'DAXINBARI','HOWRAH','DAXINBARI','DAXINBARI','8',4,'35','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (36,'DHUMKI','HOWRAH','DHUMKI','DHUMKI','8',4,'36','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (37,'HANTAL','HOWRAH','HANTAL','HANTAL','8',4,'37','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (38,'JAGATBALLABPUR','HOWRAH','JAGATBALLABPUR','JAGATBALLABPUR','8',4,'38','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:10');
INSERT INTO `ref_mst_location` VALUES (39,'JANGIPARA','HOWRAH','JANGIPARA','JANGIPARA','8',4,'39','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:05:11');
INSERT INTO `ref_mst_location` VALUES (40,'JUJURSHA','HOWRAH','JUJURSHA','JUJURSHA','8',4,'40','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (41,'MAJU','HOWRAH','MAJU','MAJU','8',4,'41','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (42,'MASHILA','HOWRAH','MASHILA','MASHILA','8',4,'42','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (43,'MUNSHIRHAT','HOWRAH','MUNSHIRHAT','MUNSHIRHAT','8',4,'43','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:27:17');
INSERT INTO `ref_mst_location` VALUES (44,'NABGHARA','HOWRAH','NABGHARA','NABGHARA','8',4,'44','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (45,'NALPUR','HOWRAH','NALPUR','NALPUR','8',4,'45','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (46,'NANDIR BAGAN','HOWRAH','NANDIR BAGAN','NANDIR BAGAN','8',4,'46','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (47,'PANCHLA','HOWRAH','PANCHLA','PANCHLA','8',4,'47','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (48,'RAJGANG','HOWRAH','RAJGANG','RAJGANG','8',4,'48','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (49,'SAKARIDAHA','HOWRAH','SAKARIDAHA','SAKARIDAHA','8',4,'49','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:10:07');
INSERT INTO `ref_mst_location` VALUES (50,'SAKRAIL','HOWRAH','SAKRAIL','SAKRAIL','8',4,'50','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:16:29');
INSERT INTO `ref_mst_location` VALUES (51,'SANTOSHPUR','HOWRAH','SANTOSHPUR','SANTOSHPUR','8',4,'51','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:16:29');
INSERT INTO `ref_mst_location` VALUES (52,'UNSANI','HOWRAH','UNSANI','UNSANI','8',4,'52','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:16:29');
INSERT INTO `ref_mst_location` VALUES (53,'ULUBERIA','HOWRAH','ULUBERIA','ULUBERIA','8',4,'53','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:16:29');
INSERT INTO `ref_mst_location` VALUES (54,'EAST MEDINIPUR','WEST BENGAL','EAST MEDINIPUR','EAST MEDINIPUR','4',3,'54','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:17:48');
INSERT INTO `ref_mst_location` VALUES (55,'MECHEDA','EAST MEDINIPUR','MECHEDA','MECHEDA','8',4,'55','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:18:54');
INSERT INTO `ref_mst_location` VALUES (56,'BANKRA','NORTH 24 PARGANAS','BANKRA','BANKRA','8',4,'56','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:05');
INSERT INTO `ref_mst_location` VALUES (57,'DIGHA','NORTH 24 PARGANAS','DIGHA','DIGHA','8',4,'57','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:05');
INSERT INTO `ref_mst_location` VALUES (58,'LEBUTALA','NORTH 24 PARGANAS','LEBUTALA','LEBUTALA','8',4,'58','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:05');
INSERT INTO `ref_mst_location` VALUES (59,'MADHYAMGRAM','NORTH 24 PARGANAS','MADHYAMGRAM','MADHYAMGRAM','8',4,'59','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:05');
INSERT INTO `ref_mst_location` VALUES (60,'MAYNA','NORTH 24 PARGANAS','MAYNA','MAYNA','8',4,'60','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-24 01:03:19');
INSERT INTO `ref_mst_location` VALUES (61,'SIKDESHPUKURIA','NORTH 24 PARGANAS','SIKDESHPUKURIA','SIKDESHPUKURIA','8',4,'61','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:05');
INSERT INTO `ref_mst_location` VALUES (62,'SUBHASHPALLY','NORTH 24 PARGANAS','SUBHASHPALLY','SUBHASHPALLY','8',4,'62','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:06');
INSERT INTO `ref_mst_location` VALUES (63,'JALESWAR','NORTH 24 PARGANAS','JALESWAR','JALESWAR','8',4,'63','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:06');
INSERT INTO `ref_mst_location` VALUES (64,'NADIA(SMJ)','NADIA','NADIA(SMJ)','NADIA(SMJ)','8',4,'64','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:39:06');
INSERT INTO `ref_mst_location` VALUES (65,'BALUGACHI','NORTH 24 PARGANAS','BALUGACHI','BALUGACHI','8',4,'65','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (66,'DUTTAPUKUR','NORTH 24 PARGANAS','DUTTAPUKUR','DUTTAPUKUR','8',4,'66','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (67,'GUMA','NORTH 24 PARGANAS','GUMA','GUMA','8',4,'67','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (68,'KHARKI','NORTH 24 PARGANAS','KHARKI','KHARKI','8',4,'68','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (69,'PIRGACHA','NORTH 24 PARGANAS','PIRGACHA','PIRGACHA','8',4,'69','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (70,'RAMKRISHNAPALLY','NORTH 24 PARGANAS','RAMKRISHNAPALLY','RAMKRISHNAPALLY','8',4,'70','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:18');
INSERT INTO `ref_mst_location` VALUES (71,'SARADAPALLY','NORTH 24 PARGANAS','SARADAPALLY','SARADAPALLY','8',4,'71','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:19');
INSERT INTO `ref_mst_location` VALUES (72,'LAXMIPOL','NORTH 24 PARGANAS','LAXMIPOL','LAXMIPOL','8',4,'72','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:19');
INSERT INTO `ref_mst_location` VALUES (73,'KALACHANDPARA','NORTH 24 PARGANAS','KALACHANDPARA','KALACHANDPARA','8',4,'73','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:19');
INSERT INTO `ref_mst_location` VALUES (74,'CHALTABERIA','NORTH 24 PARGANAS','CHALTABERIA','CHALTABERIA','8',4,'74','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 06:45:19');
INSERT INTO `ref_mst_location` VALUES (75,'DARIASUDY','NORTH 24 PARGANAS','DARIASUDY','DARIASUDY','8',4,'75','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:43');
INSERT INTO `ref_mst_location` VALUES (76,'DEBIPUR','NORTH 24 PARGANAS','DEBIPUR','DEBIPUR','8',4,'76','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:43');
INSERT INTO `ref_mst_location` VALUES (77,'NAKSHA','NORTH 24 PARGANAS','NAKSHA','NAKSHA','8',4,'77','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (78,'BHABAGACHI','NORTH 24 PARGANAS','BHABAGACHI','BHABAGACHI','8',4,'78','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (79,'DEBAK','NORTH 24 PARGANAS','DEBAK','DEBAK','8',4,'79','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (80,'KAPA','NORTH 24 PARGANAS','KAPA','KAPA','8',4,'80','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (81,'KULIAGARH','NORTH 24 PARGANAS','KULIAGARH','KULIAGARH','8',4,'81','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (82,'NAIHATI','NORTH 24 PARGANAS','NAIHATI','NAIHATI','8',4,'82','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (83,'PALTAPARA','NORTH 24 PARGANAS','PALTAPARA','PALTAPARA','8',4,'83','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (84,'RAMCHANDRAPUR','NORTH 24 PARGANAS','RAMCHANDRAPUR','RAMCHANDRAPUR','8',4,'84','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (85,'UCHHEGAR','NORTH 24 PARGANAS','UCHHEGAR','UCHHEGAR','8',4,'85','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (86,'ARPATNA','NORTH 24 PARGANAS','ARPATNA','ARPATNA','8',4,'86','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (87,'BANDIPUR','NORTH 24 PARGANAS','BANDIPUR','BANDIPUR','8',4,'87','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (88,'DANGADIGLA','NORTH 24 PARGANAS','DANGADIGLA','DANGADIGLA','8',4,'88','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (89,'DOPERIA(GB)','NORTH 24 PARGANAS','DOPERIA(GB)','DOPERIA(GB)','8',4,'89','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (90,'PATULIA','NORTH 24 PARGANAS','PATULIA','PATULIA','8',4,'90','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:44');
INSERT INTO `ref_mst_location` VALUES (91,'RUIA','NORTH 24 PARGANAS','RUIA','RUIA','8',4,'91','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (92,'DOPERIA(SP)','NORTH 24 PARGANAS','DOPERIA(SP)','DOPERIA(SP)','8',4,'92','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (93,'HOOGLY(SP)','HOOGLY','HOOGLY(SP)','HOOGLY(SP)','8',4,'93','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (94,'MOROLPARA','NORTH 24 PARGANAS','MOROLPARA','MOROLPARA','8',4,'94','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (95,'NATAGAR','NORTH 24 PARGANAS','NATAGAR','NATAGAR','8',4,'95','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (96,'BARASAT','NORTH 24 PARGANAS','BARASAT','BARASAT','8',4,'96','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (97,'NILGANJ','NORTH 24 PARGANAS','NILGANJ','NILGANJ','8',4,'97','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (98,'GIDAH','NORTH 24 PARGANAS','GIDAH','GIDAH','8',4,'98','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (99,'JAFARPUR','NORTH 24 PARGANAS','JAFARPUR','JAFARPUR','8',4,'99','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (100,'MOHONPUR','NORTH 24 PARGANAS','MOHONPUR','MOHONPUR','8',4,'100','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (101,'SEWLI','NORTH 24 PARGANAS','SEWLI','SEWLI','8',4,'101','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (102,'BAROKATHALIA','NORTH 24 PARGANAS','BAROKATHALIA','BAROKATHALIA','8',4,'102','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:06:45');
INSERT INTO `ref_mst_location` VALUES (103,'NARAYANKATHI','NORTH 24 PARGANAS','NARAYANKATHI','NARAYANKATHI','8',4,'103','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:08:00');
INSERT INTO `ref_mst_location` VALUES (104,'KEUTIA','NORTH 24 PARGANAS','KEUTIA','KEUTIA','8',4,'104','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:08:00');
INSERT INTO `ref_mst_location` VALUES (105,'DIGNAGAR','NADIA','DIGNAGAR','DIGNAGAR','8',4,'105','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:25');
INSERT INTO `ref_mst_location` VALUES (106,'JOYGOPALPUR','NADIA','JOYGOPALPUR','JOYGOPALPUR','8',4,'106','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:25');
INSERT INTO `ref_mst_location` VALUES (107,'KALINARAYANPUR','NADIA','KALINARAYANPUR','KALINARAYANPUR','8',4,'107','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:25');
INSERT INTO `ref_mst_location` VALUES (108,'RAMNAGAR','NADIA','RAMNAGAR','RAMNAGAR','8',4,'108','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:25');
INSERT INTO `ref_mst_location` VALUES (109,'RANAGHAT','NADIA','RANAGHAT','RANAGHAT','8',4,'109','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (110,'SHANTIPUR','NADIA','SHANTIPUR','SHANTIPUR','8',4,'110','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (111,'AMDANGA','NORTH 24 PARGANAS','AMDANGA','AMDANGA','8',4,'111','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (112,'ARKHALI','NORTH 24 PARGANAS','ARKHALI','ARKHALI','8',4,'112','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (113,'BALISA','NORTH 24 PARGANAS','BALISA','BALISA','8',4,'113','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (114,'BATHANIA','NORTH 24 PARGANAS','BATHANIA','BATHANIA','8',4,'114','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-01 02:37:44');
INSERT INTO `ref_mst_location` VALUES (115,'KATHPUR','NORTH 24 PARGANAS','KATHPUR','KATHPUR','8',4,'115','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (116,'PADMALOVPUR','NORTH 24 PARGANAS','PADMALOVPUR','PADMALOVPUR','8',4,'116','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (117,'TALSA','NORTH 24 PARGANAS','TALSA','TALSA','8',4,'117','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (118,'ULUDANGA','NORTH 24 PARGANAS','ULUDANGA','ULUDANGA','8',4,'118','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (119,'WEST NARAYANPUR','NORTH 24 PARGANAS','WEST NARAYANPUR','WEST NARAYANPUR','8',4,'119','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (120,'MOYNA','NORTH 24 PARGANAS','MOYNA','MOYNA','8',4,'120','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-12 02:31:23');
INSERT INTO `ref_mst_location` VALUES (121,'ROFIPUR','NORTH 24 PARGANAS','ROFIPUR','ROFIPUR','8',4,'121','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:26');
INSERT INTO `ref_mst_location` VALUES (122,'KUCHIAPARA','NORTH 24 PARGANAS','KUCHIAPARA','KUCHIAPARA','8',4,'122','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (123,'ADHATA','NORTH 24 PARGANAS','ADHATA','ADHATA','8',4,'123','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (124,'AWALSIDDHI','NORTH 24 PARGANAS','AWALSIDDHI','AWALSIDDHI','8',4,'124','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (125,'BAGPUL','NORTH 24 PARGANAS','BAGPUL','BAGPUL','8',4,'125','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (126,'DATARI','NORTH 24 PARGANAS','DATARI','DATARI','8',4,'126','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (127,'HISABI','NORTH 24 PARGANAS','HISABI','HISABI','8',4,'127','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (128,'HORBATI','NORTH 24 PARGANAS','HORBATI','HORBATI','8',4,'128','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (129,'JAGULIA','NORTH 24 PARGANAS','JAGULIA','JAGULIA','8',4,'129','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (130,'JIRAT','NORTH 24 PARGANAS','JIRAT','JIRAT','8',4,'130','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (131,'JOYPUR','NORTH 24 PARGANAS','JOYPUR','JOYPUR','8',4,'131','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (132,'KAIPUKUR','NORTH 24 PARGANAS','KAIPUKUR','KAIPUKUR','8',4,'132','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (133,'MAGURKHALI','NORTH 24 PARGANAS','MAGURKHALI','MAGURKHALI','8',4,'133','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:27');
INSERT INTO `ref_mst_location` VALUES (134,'NADIA(UD)','NADIA','NADIA(UD)','NADIA(UD)','8',4,'134','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:30:28');
INSERT INTO `ref_mst_location` VALUES (135,'WEST DHANIA','NORTH 24 PARGANAS','WEST DHANIA','WEST DHANIA','8',4,'135','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (136,'BABPUR','NORTH 24 PARGANAS','BABPUR','BABPUR','8',4,'136','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (137,'CHAPAGACHI','NORTH 24 PARGANAS','CHAPAGACHI','CHAPAGACHI','8',4,'137','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (138,'DEYPARA','NORTH 24 PARGANAS','DEYPARA','DEYPARA','8',4,'138','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (139,'HORPUR','NORTH 24 PARGANAS','HORPUR','HORPUR','8',4,'139','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (140,'KANCHIARA','NORTH 24 PARGANAS','KANCHIARA','KANCHIARA','8',4,'140','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (141,'KHELIA','NORTH 24 PARGANAS','KHELIA','KHELIA','8',4,'141','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (142,'KHILKAPUR','NORTH 24 PARGANAS','KHILKAPUR','KHILKAPUR','8',4,'142','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (143,'MADHABPUR','NORTH 24 PARGANAS','MADHABPUR','MADHABPUR','8',4,'143','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:41:09');
INSERT INTO `ref_mst_location` VALUES (144,'MIRHATI','NORTH 24 PARGANAS','MIRHATI','MIRHATI','8',4,'144','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:43:42');
INSERT INTO `ref_mst_location` VALUES (145,'NATUNGRAM','NORTH 24 PARGANAS','NATUNGRAM','NATUN GRAM','8',4,'145','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-24 01:19:19');
INSERT INTO `ref_mst_location` VALUES (146,'SONADANGA','NORTH 24 PARGANAS','SONADANGA','SONADANGA','8',4,'146','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:43:42');
INSERT INTO `ref_mst_location` VALUES (147,'RANDHANGACHA','NORTH 24 PARGANAS','RANDHANGACHA','RANDHANGACHA','8',4,'147','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:43:42');
INSERT INTO `ref_mst_location` VALUES (148,'BOSEGACHA','NORTH 24 PARGANAS','BOSEGACHA','BOSEGACHA','8',4,'148','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:43:43');
INSERT INTO `ref_mst_location` VALUES (149,'AHIRA','NORTH 24 PARGANAS','AHIRA','AHIRA','8',4,'149','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (150,'ANANDAPALLY','NORTH 24 PARGANAS','ANANDAPALLY','ANANDAPALLY','8',4,'150','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (151,'ASUTOSHPALLY','NORTH 24 PARGANAS','ASUTOSHPALLY','ASUTOSHPALLY','8',4,'151','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (152,'BAROFINGA','NORTH 24 PARGANAS','BAROFINGA','BAROFINGA','8',4,'152','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (153,'FATULLAPUR','NORTH 24 PARGANAS','FATULLAPUR','FATULLAPUR','8',4,'153','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (154,'GARPARA','NORTH 24 PARGANAS','GARPARA','GARPARA','8',4,'154','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (155,'KAPASIA','NORTH 24 PARGANAS','KAPASIA','KAPASIA','8',4,'155','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (156,'KRISHNAPALLY','NORTH 24 PARGANAS','KRISHNAPALLY','KRISHNAPALLY','8',4,'156','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (157,'MAJHERPARA','NORTH 24 PARGANAS','MAJHERPARA','MAJHERPARA','8',4,'157','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (158,'MUDIPARA','NORTH 24 PARGANAS','MUDIPARA','MUDIPARA','8',4,'158','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (159,'NARAYANPUR','NORTH 24 PARGANAS','NARAYANPUR','NARAYANPUR','8',4,'159','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-01 20:51:33');
INSERT INTO `ref_mst_location` VALUES (160,'PRATAPGARH','NORTH 24 PARGANAS','PRATAPGARH','PRATAPGARH','8',4,'160','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:26');
INSERT INTO `ref_mst_location` VALUES (161,'SAHEB BAGAN','NORTH 24 PARGANAS','SAHEB BAGAN','SAHEB BAGAN','8',4,'161','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:27');
INSERT INTO `ref_mst_location` VALUES (162,'SUBHASHNAGAR','NORTH 24 PARGANAS','SUBHASHNAGAR','SUBHASHNAGAR','8',4,'162','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:27');
INSERT INTO `ref_mst_location` VALUES (163,'TALDHERIA','NORTH 24 PARGANAS','TALDHERIA','TALDHERIA','8',4,'163','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:26:27');
INSERT INTO `ref_mst_location` VALUES (164,'DOGACHIA','NORTH 24 PARGANAS','DOGACHIA','','8',4,'164','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-01 03:24:30');
INSERT INTO `ref_mst_location` VALUES (165,'MONDALPARA','NORTH 24 PARGANAS','MONDALPARA','','8',4,'165','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-04-01 04:57:18');
INSERT INTO `ref_mst_location` VALUES (166,'BAIDYAPUR','NORTH 24 PARGANAS','BAIDYAPUR','','8',4,'166','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-09 01:17:10');
INSERT INTO `ref_mst_location` VALUES (167,'TUNTBAGAN','NADIA','TUNTBAGAN','','8',4,'167','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-12 02:36:24');
INSERT INTO `ref_mst_location` VALUES (168,'DURLAVPUR','NORTH 24 PARGANAS','DURLAVPUR','','8',4,'168','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-08-09 02:32:49');
INSERT INTO `ref_mst_location` VALUES (169,'TARABERIA','NORTH 24 PARGANAS','TARABERIA','','8',4,'169','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-02-09 00:20:39');
INSERT INTO `ref_mst_location` VALUES (170,'PANPARA','NORTH 24 PARGANAS','PANPARA','DEFAULT','8',4,'170','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-04-10 23:50:22');
INSERT INTO `ref_mst_location` VALUES (171,'MALICKBERIA','NORTH 24 PARGANAS','MALICKBERIA','DEFAULT','8',4,'171','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-02-19 05:20:30');
INSERT INTO `ref_mst_location` VALUES (172,'BILPARA','NORTH 24 PARGANAS','BILPARA','THE LOCATION GOES TO MRS GOURI BISWAS.','8',4,'172','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-04-28 05:37:05');
INSERT INTO `ref_mst_location` VALUES (173,'KOLAGHAT','EAST MEDINIPUR','KOLAGHAT','','8',4,'173','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-03 00:59:24');
INSERT INTO `ref_mst_location` VALUES (174,'MOTI','EAST MEDINIPUR','MOTIMALA','','8',4,'174','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2012-06-02 05:46:25');
INSERT INTO `ref_mst_location` VALUES (175,'PAYRADANGA','NADIA','PAYRADANGA','','8',4,'175','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-03 00:48:48');
INSERT INTO `ref_mst_location` VALUES (176,'HASNABAD','NORTH 24 PARGANAS','HASNABAD','','8',4,'176','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-12-01 02:12:17');
INSERT INTO `ref_mst_location` VALUES (177,'KRISHNANAGAR','NADIA','KRISHNANAGAR','DEFAULT','8',4,'177','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-01-02 03:09:28');
INSERT INTO `ref_mst_location` VALUES (178,'BANDEL','HOOGLY','BANDEL','','8',4,'178','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-03-04 06:15:39');
INSERT INTO `ref_mst_location` VALUES (179,'BIRPUR','NORTH 24 PARGANAS','BIRPUR','','8',4,'179','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2013-04-17 02:37:34');
INSERT INTO `ref_mst_location` VALUES (180,'KRISHNAMATI','NORTH 24 PARGANAS','KRISHNAMATI','','8',4,'180','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-04-17 04:40:27');
INSERT INTO `ref_mst_location` VALUES (181,'BIRSHIBPUR','HOWRAH','BIRSHIBPUR','','8',4,'181','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-04-20 05:09:21');
INSERT INTO `ref_mst_location` VALUES (182,'BURDWAN','HOOGLY','BURDWAN','','8',4,'182','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-07-01 05:01:44');
INSERT INTO `ref_mst_location` VALUES (183,'JADUBERIA','HOWRAH','JADUBERIA','DEFAULT','8',4,'183','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2013-07-16 02:22:50');
INSERT INTO `ref_mst_location` VALUES (184,'JADU','HOWRAH','JADUBERIA','','8',4,'184','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2013-07-16 02:22:50');
INSERT INTO `ref_mst_location` VALUES (185,'JAD','HOWRAH','JADUBERIA','ADVANCE GIVEN','8',4,'185','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2013-07-16 02:22:50');
INSERT INTO `ref_mst_location` VALUES (186,'JADUBERIA','HOWRAH','JADUBERIA','','8',4,'186','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-02-07 01:57:23');
INSERT INTO `ref_mst_location` VALUES (187,'KIRTIPUR','NORTH 24 PARGANAS','KIRTIPUR','','8',4,'187','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-12-16 00:20:40');
INSERT INTO `ref_mst_location` VALUES (188,'KATWA','BURDWAN','KATWA','','8',5,'188','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2013-12-31 00:12:15');
INSERT INTO `ref_mst_location` VALUES (189,'BAGNAN','EAST MEDINIPUR','BAGNAN','','8',4,'189','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-01-14 06:26:49');
INSERT INTO `ref_mst_location` VALUES (190,'GEDE','NADIA','GEDE','','8',4,'190','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-03-18 05:29:32');
INSERT INTO `ref_mst_location` VALUES (191,'SHEORAPHULY','HOOGLY','SHEORAPHULY','THIS VILLAGE START FROM MAY 2014.','8',4,'191','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-05-14 06:50:20');
INSERT INTO `ref_mst_location` VALUES (192,'HOOGLY(APC)','HOOGLY','HOOGLY(APC)','START FROM 12-5-14','8',4,'192','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-05-19 04:09:12');
INSERT INTO `ref_mst_location` VALUES (193,'BOALIA','HOWRAH','BOALIA','START FROM 17-5-14 UNDER APC','8',4,'193','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-05-27 02:02:41');
INSERT INTO `ref_mst_location` VALUES (194,'RAHARA','NORTH 24 PARGANAS','RAHARA','','8',4,'194','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-08-06 03:34:23');
INSERT INTO `ref_mst_location` VALUES (195,'BANGAON','NADIA','BANGAON','START FROM 16-07-2014 ','8',4,'195','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-08-20 05:08:07');
INSERT INTO `ref_mst_location` VALUES (196,'KOWGACHI','NORTH 24 PARGANAS','KOWGACHI','','8',4,'196','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-11-19 00:25:17');
INSERT INTO `ref_mst_location` VALUES (197,'PARTHAPUR','NORTH 24 PARGANAS','PARTHAPUR','','8',4,'197','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-11-25 02:10:17');
INSERT INTO `ref_mst_location` VALUES (198,'APURBANAGAR','NORTH 24 PARGANAS','APURBANAGAR','\r\n','8',4,'198','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-11-25 02:13:48');
INSERT INTO `ref_mst_location` VALUES (199,'TARUNPALLY','NORTH 24 PARGANAS','TARUNPALLY','','8',4,'199','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-11-25 02:14:29');
INSERT INTO `ref_mst_location` VALUES (200,'GHOLA','NORTH 24 PARGANAS','GHOLA','','8',4,'200','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-11-26 03:54:56');
INSERT INTO `ref_mst_location` VALUES (201,'MOHISPOTA','NORTH 24 PARGANAS','MOHISPOTA','','8',4,'201','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2014-12-01 01:35:30');
INSERT INTO `ref_mst_location` VALUES (202,'TULSIBERIA','HOWRAH','TULSIBERIA','','8',4,'202','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-02-04 00:16:44');
INSERT INTO `ref_mst_location` VALUES (203,'CHOUMUHA','NORTH 24 PARGANAS','CHOUMUHA','','8',4,'203','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-07-06 03:36:51');
INSERT INTO `ref_mst_location` VALUES (204,'BURDWAN 1','BURDWAN','BURDWAN 1','','8',5,'204','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2015-10-19 03:52:00');
INSERT INTO `ref_mst_location` VALUES (205,'SONADANGA(KG)','NORTH 24 PARGANAS','SONADANGA(KG)','','8',4,'205','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2017-04-29 01:29:15');
INSERT INTO `ref_mst_location` VALUES (206,'SONADANGA(DNS)','NORTH 24 PARGANAS','SONADANGA(DNS)','','8',4,'206','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2017-04-29 01:36:36');
/*!40000 ALTER TABLE `ref_mst_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_module`
--

DROP TABLE IF EXISTS `ref_mst_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_module` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Module ID',
  `MODULE_ID` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Module Name',
  `STATUS` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ACL Modules';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_module`
--

LOCK TABLES `ref_mst_module` WRITE;
/*!40000 ALTER TABLE `ref_mst_module` DISABLE KEYS */;
INSERT INTO `ref_mst_module` VALUES (1,'dbd','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-01-03 00:44:52');
INSERT INTO `ref_mst_module` VALUES (2,'ref','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2009-03-03 12:12:36');
INSERT INTO `ref_mst_module` VALUES (3,'rpt','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2009-03-03 12:12:36');
INSERT INTO `ref_mst_module` VALUES (4,'adm','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2009-04-06 08:23:14');
INSERT INTO `ref_mst_module` VALUES (5,'trn','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-01-24 20:45:48');
INSERT INTO `ref_mst_module` VALUES (6,'tst','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-07-23 21:05:45');
/*!40000 ALTER TABLE `ref_mst_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_organisation`
--

DROP TABLE IF EXISTS `ref_mst_organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_organisation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STARTING_DAY` int(11) DEFAULT NULL,
  `ENDING_DAY` int(11) DEFAULT NULL,
  `STARTING_MONTH` int(11) DEFAULT NULL,
  `ENDING_MONTH` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT 'NORMAL',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_organisation`
--

LOCK TABLES `ref_mst_organisation` WRITE;
/*!40000 ALTER TABLE `ref_mst_organisation` DISABLE KEYS */;
INSERT INTO `ref_mst_organisation` VALUES (1,1,NULL,4,NULL,'NORMAL');
/*!40000 ALTER TABLE `ref_mst_organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_schedule`
--

DROP TABLE IF EXISTS `ref_mst_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_schedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCHEME_ID` varchar(20) DEFAULT NULL,
  `SCHEDULE_SEQUENCE_ID` int(4) DEFAULT '0',
  `PAYMENT_RECEIPT_FLAG` varchar(1) DEFAULT NULL,
  `PRINCIPAL_PAYMENT` double(18,6) DEFAULT '0.000000',
  `INTEREST_PAYMENT` double(18,6) DEFAULT '0.000000',
  `PRINCIPAL_RECEIPT` double(18,6) DEFAULT '0.000000',
  `INTEREST_RECEIPT` double(18,6) DEFAULT '0.000000',
  `DONATION_RECEIPT` double(18,6) DEFAULT '0.000000',
  `FEES_RECEIPT` double(18,6) DEFAULT '0.000000',
  `RECEIPT_DUE` double(18,6) DEFAULT '0.000000',
  `NEXT_DAY_INTERVAL` int(3) DEFAULT '0',
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_schedule`
--

LOCK TABLES `ref_mst_schedule` WRITE;
/*!40000 ALTER TABLE `ref_mst_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_mst_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_scheme`
--

DROP TABLE IF EXISTS `ref_mst_scheme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_scheme` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCHEME_ID` varchar(20) DEFAULT NULL,
  `SCHEME_NAME` varchar(100) DEFAULT NULL,
  `SCHEME_TYPE` varchar(30) DEFAULT NULL,
  `SCHEME_DESC` mediumtext,
  `LOAN_INVESTMENT_SCHEME` varchar(1) DEFAULT NULL,
  `SCHEME_START_DATE` date DEFAULT NULL,
  `SCHEME_END_DATE` date DEFAULT NULL,
  `SCHEME_AMT_LIMIT` double(18,6) DEFAULT '0.000000',
  `SCHEME_PAY_FREQ` int(3) DEFAULT '0',
  `SCHEME_CCY_ID` varchar(20) DEFAULT NULL,
  `SCHEDULE_TYPE` varchar(10) DEFAULT 'WEEKLY',
  `SCHEDULE_WEEK` int(2) DEFAULT '0',
  `SCHEDULE_DAY` int(2) DEFAULT '0',
  `SCHEDULE_MONTH` int(2) DEFAULT '0',
  `MAX_DAY_DEALY_ALLOW` int(4) DEFAULT '0',
  `DAY_INTERVAL` int(4) DEFAULT '0',
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `I_RMS_SCHEME_ID` (`SCHEME_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_scheme`
--

LOCK TABLES `ref_mst_scheme` WRITE;
/*!40000 ALTER TABLE `ref_mst_scheme` DISABLE KEYS */;
INSERT INTO `ref_mst_scheme` VALUES (1,'SBA','SMALL BUSINESS ADVANCE','FOREIGN','SBA',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:59:18');
INSERT INTO `ref_mst_scheme` VALUES (2,'AH','ANIMAL HUSBANDUARY','FOREIGN','AH',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:43:44');
INSERT INTO `ref_mst_scheme` VALUES (3,'VH','VENDORS AND HAWKERS','FOREIGN','VH',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:43:44');
INSERT INTO `ref_mst_scheme` VALUES (4,'SB','SMALL BUSINESS','FOREIGN','SB',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:43:44');
INSERT INTO `ref_mst_scheme` VALUES (5,'AG','AGRICULTURE','FOREIGN','AG',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 04:43:57');
INSERT INTO `ref_mst_scheme` VALUES (6,'MC','MICRO CREDIT','LOCAL','MC',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:24:21');
INSERT INTO `ref_mst_scheme` VALUES (7,'MF','MICRO FINANCE','FOREIGN','MF',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-16 07:24:22');
INSERT INTO `ref_mst_scheme` VALUES (8,'VR','VAN RIKSHAW','FOREIGN','VR',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:19:13');
INSERT INTO `ref_mst_scheme` VALUES (9,'SM','SEWING MACHINE','FOREIGN','SM',NULL,'2000-01-01','2050-03-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-05-17 00:19:13');
INSERT INTO `ref_mst_scheme` VALUES (10,'PS','PEER SERVANTS','FOREIGN','PS',NULL,'2012-01-07','2025-12-31',10000.000000,0,NULL,'WEEKLY',0,0,0,0,0,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2012-01-07 03:32:53');
/*!40000 ALTER TABLE `ref_mst_scheme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_tbl_rows_count`
--

DROP TABLE IF EXISTS `ref_mst_tbl_rows_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_tbl_rows_count` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `TABLE_ID` varchar(30) DEFAULT NULL,
  `TABLE_NAME` varchar(30) DEFAULT NULL,
  `TOTAL_ROWS` int(30) DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_tbl_rows_count`
--

LOCK TABLES `ref_mst_tbl_rows_count` WRITE;
/*!40000 ALTER TABLE `ref_mst_tbl_rows_count` DISABLE KEYS */;
INSERT INTO `ref_mst_tbl_rows_count` VALUES (1,'DETAILS','ltr_trn_details',1);
INSERT INTO `ref_mst_tbl_rows_count` VALUES (2,'SUMMARY','ltr_trn_summary',1);
INSERT INTO `ref_mst_tbl_rows_count` VALUES (3,'ENTITY','ref_mst_entity',16264);
INSERT INTO `ref_mst_tbl_rows_count` VALUES (4,'LOCATION','ref_mst_location',157);
INSERT INTO `ref_mst_tbl_rows_count` VALUES (5,'SCHEME','ref_mst_scheme',4);
/*!40000 ALTER TABLE `ref_mst_tbl_rows_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_mst_user`
--

DROP TABLE IF EXISTS `ref_mst_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_mst_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(20) DEFAULT NULL,
  `USER_PASSWORD` varchar(20) DEFAULT NULL,
  `USER_TYPE` varchar(20) DEFAULT NULL,
  `USER_NAME` varchar(40) DEFAULT NULL,
  `ASSOC_FILED_AGENT_ID` varchar(20) DEFAULT NULL,
  `ASSOC_EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `ASSOC_CUSTOMER_ID` varchar(20) DEFAULT NULL,
  `ASSOC_OFFICE_ID` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_mst_user`
--

LOCK TABLES `ref_mst_user` WRITE;
/*!40000 ALTER TABLE `ref_mst_user` DISABLE KEYS */;
INSERT INTO `ref_mst_user` VALUES (1,'admin','admin1',NULL,'Adminstrator',NULL,'','','','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00','admin','2010-10-31 19:23:05');
INSERT INTO `ref_mst_user` VALUES (2,'userone','userone','normal user','userone',NULL,'','','','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00','admin','2015-09-05 05:44:10');
INSERT INTO `ref_mst_user` VALUES (3,'usertwo','user02',NULL,'',NULL,'','','','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-31 19:22:41');
INSERT INTO `ref_mst_user` VALUES (4,'userthree','user03',NULL,'',NULL,'','','','ACTIVE','CANCEL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-02 16:09:03');
INSERT INTO `ref_mst_user` VALUES (5,'userfour','user04',NULL,'',NULL,'','','','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-31 19:22:41');
INSERT INTO `ref_mst_user` VALUES (6,'userfive','user05',NULL,'',NULL,'','','','ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-31 19:22:41');
INSERT INTO `ref_mst_user` VALUES (7,'userro','userro',NULL,NULL,NULL,NULL,NULL,NULL,'ACTIVE','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-31 19:22:41');
INSERT INTO `ref_mst_user` VALUES (8,'Test User','testuser',NULL,'Test Application User',NULL,NULL,NULL,NULL,'ACTIVE','CANCEL','admin','0000-00-00 00:00:00',NULL,'2012-02-17 02:07:59');
INSERT INTO `ref_mst_user` VALUES (9,'SM1','smritiman',NULL,'Smritiman',NULL,NULL,NULL,NULL,'ACTIVE','CANCEL','admin','0000-00-00 00:00:00',NULL,'2010-10-31 19:23:05');
INSERT INTO `ref_mst_user` VALUES (10,'xxxONE','xxxxxx','Test','xxx1',NULL,NULL,NULL,NULL,'ACTIVE','CANCEL','admin','0000-00-00 00:00:00','admin','2012-02-17 02:07:47');
INSERT INTO `ref_mst_user` VALUES (11,'jalajj','jalajj','normal user','jalaj jha',NULL,NULL,NULL,NULL,'ACTIVE','CANCEL','admin','0000-00-00 00:00:00','admin','2011-04-10 13:43:54');
INSERT INTO `ref_mst_user` VALUES (12,'Subho','00000000','normal','Subhajit Ghosh',NULL,NULL,NULL,NULL,'ACTIVE','NORMAL','admin','0000-00-00 00:00:00','admin','2014-02-14 23:29:55');
INSERT INTO `ref_mst_user` VALUES (13,'jalajjha','jalajjha','normal','jalaj jha',NULL,NULL,NULL,NULL,'ACTIVE','NORMAL','admin','0000-00-00 00:00:00','admin','2011-04-13 19:08:25');
INSERT INTO `ref_mst_user` VALUES (14,'TestUserTest','testuser','Test user','TEST USER',NULL,NULL,NULL,NULL,'ACTIVE','CANCEL','admin','0000-00-00 00:00:00','admin','2012-02-17 02:08:17');
INSERT INTO `ref_mst_user` VALUES (15,'biswajit','biswajit','standard','biswajit',NULL,NULL,NULL,NULL,'ACTIVE','NORMAL','admin','0000-00-00 00:00:00',NULL,'2011-07-17 05:09:23');
/*!40000 ALTER TABLE `ref_mst_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_reference_info`
--

DROP TABLE IF EXISTS `ref_reference_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_reference_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TABLE_NAME` varchar(30) DEFAULT NULL,
  `COLUMN_NAME` varchar(30) DEFAULT NULL,
  `COLUMN_VALUE` varchar(50) DEFAULT NULL,
  `ID_VALUE` int(11) DEFAULT NULL,
  `REFERENCE_TYPE` varchar(30) DEFAULT NULL,
  `REFERENCE_VALUE` varchar(30) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TRANSACTION_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_RRI_COLUMN_VALUE` (`COLUMN_VALUE`),
  KEY `I_RRI_COLUMN_REFERENCE_STATUS` (`TABLE_NAME`,`COLUMN_NAME`,`COLUMN_VALUE`,`REFERENCE_VALUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_reference_info`
--

LOCK TABLES `ref_reference_info` WRITE;
/*!40000 ALTER TABLE `ref_reference_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_reference_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_rul_prefix_postfix`
--

DROP TABLE IF EXISTS `ref_rul_prefix_postfix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_rul_prefix_postfix` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PREFIX_POSTFIX_ID` varchar(20) DEFAULT NULL,
  `PREFIX_POSTFIX_DESC` varchar(100) DEFAULT NULL,
  `PREFIX_POSTFIX_TYPE` varchar(20) DEFAULT NULL,
  `PREFIX_VALUE` varchar(20) DEFAULT NULL,
  `POSTFIX_VALUE` varchar(20) DEFAULT NULL,
  `MAP_TABLE_NAME` varchar(100) DEFAULT NULL,
  `MAP_COLUMN_NAME` varchar(100) DEFAULT NULL,
  `FETCH_CONDITION` varchar(100) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_rul_prefix_postfix`
--

LOCK TABLES `ref_rul_prefix_postfix` WRITE;
/*!40000 ALTER TABLE `ref_rul_prefix_postfix` DISABLE KEYS */;
INSERT INTO `ref_rul_prefix_postfix` VALUES (1,'RULE1','Employee Prefix','PREFIX','EMP','','ref_mst_entity','ENTITY_ID','REF_MST_ENTITY.ENTITY_TYPE = \'Officer\'','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:28:24');
INSERT INTO `ref_rul_prefix_postfix` VALUES (2,'RULE2','Customer Prefix','PREFIX','CUST','','ref_mst_entity','ENTITY_ID','REF_MST_ENTITY.ENTITY_TYPE = \'Customer\'','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:28:16');
INSERT INTO `ref_rul_prefix_postfix` VALUES (3,'RULE3','Customer Prefix Specific Rule','PREFIX','SB','','ref_mst_entity','ENTITY_ID','REF_MST_ENTITY.ENTITY_TYPE = \'Customer\' AND REF_MST_ENTITY.CUSTOMER_SCHEME_ID like \'SB%\'','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:28:15');
INSERT INTO `ref_rul_prefix_postfix` VALUES (4,'RULE2','Customer Application  prefix','PREFIX','APPL','','ref_mst_entity','CUSTOMER_APPLN_ID','','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:28:38');
INSERT INTO `ref_rul_prefix_postfix` VALUES (5,'RULE2','Customer Address Prefix','PREFIX','ADDR','','ref_mst_entity','ADDRESS_ID','','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:28:35');
INSERT INTO `ref_rul_prefix_postfix` VALUES (6,'RULE1','Employee Address Prefix','PREFIX','EADDR','','ref_mst_entity','ADDRESS_ID','','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 16:27:38');
INSERT INTO `ref_rul_prefix_postfix` VALUES (7,'RULE4','Transaction Summary Prefix','PREFIX','TS','','','','','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-23 23:52:24');
INSERT INTO `ref_rul_prefix_postfix` VALUES (8,'RULE5','Transaction Detail Prefix','PREFIX','TD','','','','','NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-11 04:13:38');
/*!40000 ALTER TABLE `ref_rul_prefix_postfix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_sta_currency`
--

DROP TABLE IF EXISTS `ref_sta_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_sta_currency` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `CCY_ID` varchar(20) DEFAULT NULL,
  `CCY_NAME` varchar(40) DEFAULT NULL,
  `LOCATION_ID` varchar(20) DEFAULT NULL,
  `LOCATION_TYPE` varchar(20) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(10) DEFAULT 'ACTIVE',
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_sta_currency`
--

LOCK TABLES `ref_sta_currency` WRITE;
/*!40000 ALTER TABLE `ref_sta_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_sta_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_sta_key_value`
--

DROP TABLE IF EXISTS `ref_sta_key_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_sta_key_value` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KEY_ID` varchar(20) DEFAULT NULL,
  `VALUE_ID` varchar(20) DEFAULT NULL,
  `KEY_NAME` varchar(100) DEFAULT NULL,
  `VALUE_NAME` varchar(100) DEFAULT NULL,
  `DISPLAY_SEQUENCE` int(3) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_sta_key_value`
--

LOCK TABLES `ref_sta_key_value` WRITE;
/*!40000 ALTER TABLE `ref_sta_key_value` DISABLE KEYS */;
INSERT INTO `ref_sta_key_value` VALUES (3,'key1','LEVEL1','1','LEVEL1',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:47:20');
INSERT INTO `ref_sta_key_value` VALUES (4,'key1','LEVEL2','2','LEVEL2',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:47:30');
INSERT INTO `ref_sta_key_value` VALUES (5,'key1','LEVEL3','3','LEVEL3',3,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:30');
INSERT INTO `ref_sta_key_value` VALUES (6,'key1','LEVEL4','4','LEVEL4',4,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:27');
INSERT INTO `ref_sta_key_value` VALUES (7,'key1','LEVEL5','5','LEVEL5',5,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:24');
INSERT INTO `ref_sta_key_value` VALUES (8,'key1','LEVEL6','6','LEVEL6',6,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:21');
INSERT INTO `ref_sta_key_value` VALUES (9,'key1','LEVEL7','7','LEVEL7',7,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:17');
INSERT INTO `ref_sta_key_value` VALUES (10,'key1','LEVEL8','8','LEVEL8',8,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:48:05');
INSERT INTO `ref_sta_key_value` VALUES (12,'key2','WORLD','1','WORLD',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:45:55');
INSERT INTO `ref_sta_key_value` VALUES (13,'key2','COUNTRY','2','COUNTRY',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:04');
INSERT INTO `ref_sta_key_value` VALUES (14,'key2','STATE','3','STATE',3,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:10');
INSERT INTO `ref_sta_key_value` VALUES (15,'key2','DISTRICT','4','DISTRICT',4,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:21');
INSERT INTO `ref_sta_key_value` VALUES (16,'key2','DIVISION','5','DIVISION',5,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:30');
INSERT INTO `ref_sta_key_value` VALUES (17,'key2','RANGE','6','RANGE',6,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:38');
INSERT INTO `ref_sta_key_value` VALUES (18,'key2','CITY','7','CITY',7,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:47');
INSERT INTO `ref_sta_key_value` VALUES (19,'key2','VILLAGE','8','VILLAGE',8,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:46:55');
INSERT INTO `ref_sta_key_value` VALUES (20,'key2','AREA','9','AREA',9,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:47:00');
INSERT INTO `ref_sta_key_value` VALUES (21,'key2','BLOCK','10','BLOCK',10,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-05-16 23:47:10');
INSERT INTO `ref_sta_key_value` VALUES (22,'Gender','M','1','Male',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-07-24 16:47:30');
INSERT INTO `ref_sta_key_value` VALUES (23,'Gender','F','2','Female',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-07-24 16:47:34');
INSERT INTO `ref_sta_key_value` VALUES (24,'EntityType1','Customer','1','Customer',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-03-05 00:15:39');
INSERT INTO `ref_sta_key_value` VALUES (25,'EntityType2','Employee','1','COLLECTOR',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-09-02 16:27:00');
INSERT INTO `ref_sta_key_value` VALUES (26,'PaymentType','CAPITAL','1','CAPITAL_PAID',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 21:14:03');
INSERT INTO `ref_sta_key_value` VALUES (27,'PaymentType','BSD','2','BSD_PAID',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 21:14:06');
INSERT INTO `ref_sta_key_value` VALUES (28,'ReceiveType','CAPITAL','1','CAPITAL_RECEIVED',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 22:49:41');
INSERT INTO `ref_sta_key_value` VALUES (29,'ReceiveType','BSD','2','BSD_RECEIVED',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 22:49:37');
INSERT INTO `ref_sta_key_value` VALUES (30,'ReceiveType','DONATION','3','DONATION_RECEIVED',3,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 22:49:35');
INSERT INTO `ref_sta_key_value` VALUES (31,'ReceiveType','PROCESSING FEES','4','PROCESSING_FEES',4,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-22 21:14:22');
INSERT INTO `ref_sta_key_value` VALUES (32,'CustomerAgeLimit','START AGE','1','1',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-20 06:08:08');
INSERT INTO `ref_sta_key_value` VALUES (33,'CustomerAgeLimit','END AGE','2','999',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-04-20 06:03:10');
INSERT INTO `ref_sta_key_value` VALUES (34,'SchemeType','FOREIGN','1','FOREIGN',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-16 20:03:24');
INSERT INTO `ref_sta_key_value` VALUES (35,'SchemeType','LOCAL','2','LOCAL',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-08-16 20:03:28');
INSERT INTO `ref_sta_key_value` VALUES (36,'AccountStatus','OPEN','1','OPEN',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-29 15:23:21');
INSERT INTO `ref_sta_key_value` VALUES (37,'AccountStatus','CLOSE','2','CLOSE',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2010-10-29 15:23:34');
INSERT INTO `ref_sta_key_value` VALUES (38,'Component Screen','dbd_left_comp','1','Dashboard Left',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:53:01');
INSERT INTO `ref_sta_key_value` VALUES (39,'Component Screen','dbd_right_comp','2','Dashboard Right',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:53:02');
INSERT INTO `ref_sta_key_value` VALUES (40,'Component Screen','ref_left_comp','3','Reference Left',3,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:53:03');
INSERT INTO `ref_sta_key_value` VALUES (41,'Component Screen','ref_right_comp','4','Reference Right',4,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:53:05');
INSERT INTO `ref_sta_key_value` VALUES (42,'Component Screen','trn_left_comp','5','Transaction Left',5,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:53:38');
INSERT INTO `ref_sta_key_value` VALUES (43,'Component Screen','trn_right_comp','6','Transaction Right',6,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-19 11:54:08');
INSERT INTO `ref_sta_key_value` VALUES (44,'ScreenPosition','Left','1','Left',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 15:09:03');
INSERT INTO `ref_sta_key_value` VALUES (45,'ScreenPosition','Right','2','Right',2,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 15:09:04');
INSERT INTO `ref_sta_key_value` VALUES (46,'ScreenPosition1','Top_Left','3','Top-Left',3,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 20:53:25');
INSERT INTO `ref_sta_key_value` VALUES (47,'ScreenPosition1','Top_Right','4','Top-Right',4,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 20:53:40');
INSERT INTO `ref_sta_key_value` VALUES (48,'ScreenPosition1','Bottom_Left','5','Bottom-Left',5,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 20:53:36');
INSERT INTO `ref_sta_key_value` VALUES (49,'ScreenPosition1','Bottom_Right','6','Bottom-Right',6,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-21 20:53:33');
INSERT INTO `ref_sta_key_value` VALUES (50,'ScreenPosition','Center','7','Center',1,'NORMAL',NULL,'0000-00-00 00:00:00',NULL,'2011-02-28 14:42:47');
/*!40000 ALTER TABLE `ref_sta_key_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_sta_location_type`
--

DROP TABLE IF EXISTS `ref_sta_location_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ref_sta_location_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOCATION_TYPE_ID` varchar(20) DEFAULT NULL,
  `LOCATION_TYPE_NAME` varchar(100) DEFAULT NULL,
  `LOCATION_TYPE_DESC` varchar(100) DEFAULT NULL,
  `LOCATION_TYPE_LEVEL` int(3) DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT 'NORMAL',
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_BY` varchar(20) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_sta_location_type`
--

LOCK TABLES `ref_sta_location_type` WRITE;
/*!40000 ALTER TABLE `ref_sta_location_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_sta_location_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-21 18:18:26

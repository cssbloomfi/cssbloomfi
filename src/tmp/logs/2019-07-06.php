<2019-07-06T05:51:42+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-07-06T05:51:42+01:00 INFO (6)>:: Chart path initialized
<2019-07-06T05:51:43+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:43+01:00 INFO (6)>:: 
		SELECT
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_id, 
		ref_mst_application_resource.MODULE_ID acl_module_name,
		ref_mst_application_resource.RESOURCE_ID acl_resource_name,
		ref_mst_access_privilege.PRIVILEGE_ID acl_privilege_name,
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_name,
		ref_mst_user.ID acl_user_id,
		ref_mst_user.USER_ID acl_user_name
		FROM ref_mst_user
		INNER JOIN ref_join_access_role_user
		ON ref_join_access_role_user.USER_ID = ref_mst_user.USER_ID
		INNER JOIN ref_mst_access_role
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_mst_access_role.ACCESS_ROLE_ID
		INNER JOIN ref_join_access_role_appln_resource
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_join_access_role_appln_resource.ACCESS_ROLE_ID
		INNER JOIN ref_mst_application_resource
		ON ref_join_access_role_appln_resource.APPLICATION_RESOURCE_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
		INNER JOIN ref_mst_access_privilege
		ON  ref_mst_access_privilege.RESOURCE_MASTER_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
     
<2019-07-06T05:51:44+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:44+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:44+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-07-06T05:51:44+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:45+01:00 INFO (6)>:: 
		SELECT c.ROLE_ID AS 'ACCESS_ROLE_ID', e.COMP_SCREEN_NAME, b.COMP_DISPLAY_GROUP_ID, d.ASSOC_SCREEN_ID, d.SCREEN_POSITION, a.MODULE, 
		a.RESOURCE_TYPE, a.COMP_GROUP_ID, a.COMP_NAME, a.CALLER_MODULE_ID, a.CALLER_ACTION_ID, 
		a.MODULE_CONTROLLER , a.ACTION ,a.PARAMETERS , a.STATUS 
FROM ref_mst_component_resource AS a
		
INNER JOIN	
		ref_join_comp_dispcomp AS b
		ON a.COMP_ID=b.COMP_ID
		INNER JOIN ref_join_dispcomp_role AS c
		ON b.COMP_DISPLAY_GROUP_ID=c.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_disp_comp_group AS d
		ON d.COMP_DISPLAY_GROUP_ID=b.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_component_resource AS e
		ON e.COMP_ID = a.COMP_ID
		WHERE d.ASSOC_SCREEN_ID='dbd' AND d.SCREEN_POSITION='Left'
		AND c.ROLE_ID = 'ROLE1'
		GROUP BY a.COMP_GROUP_ID, a.COMP_NAME
     
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:45+01:00 INFO (6)>:: 
		SELECT c.ROLE_ID AS 'ACCESS_ROLE_ID', e.COMP_SCREEN_NAME, b.COMP_DISPLAY_GROUP_ID, d.ASSOC_SCREEN_ID, d.SCREEN_POSITION, a.MODULE, 
		a.RESOURCE_TYPE, a.COMP_GROUP_ID, a.COMP_NAME, a.CALLER_MODULE_ID, a.CALLER_ACTION_ID, 
		a.MODULE_CONTROLLER , a.ACTION ,a.PARAMETERS , a.STATUS 
FROM ref_mst_component_resource AS a
		
INNER JOIN	
		ref_join_comp_dispcomp AS b
		ON a.COMP_ID=b.COMP_ID
		INNER JOIN ref_join_dispcomp_role AS c
		ON b.COMP_DISPLAY_GROUP_ID=c.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_disp_comp_group AS d
		ON d.COMP_DISPLAY_GROUP_ID=b.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_component_resource AS e
		ON e.COMP_ID = a.COMP_ID
		WHERE d.ASSOC_SCREEN_ID='dbd' AND d.SCREEN_POSITION='Center'
		AND c.ROLE_ID = 'ROLE1'
		GROUP BY a.COMP_GROUP_ID, a.COMP_NAME
     
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:45+01:00 INFO (6)>:: 
		SELECT c.ROLE_ID AS 'ACCESS_ROLE_ID', e.COMP_SCREEN_NAME, b.COMP_DISPLAY_GROUP_ID, d.ASSOC_SCREEN_ID, d.SCREEN_POSITION, a.MODULE, 
		a.RESOURCE_TYPE, a.COMP_GROUP_ID, a.COMP_NAME, a.CALLER_MODULE_ID, a.CALLER_ACTION_ID, 
		a.MODULE_CONTROLLER , a.ACTION ,a.PARAMETERS , a.STATUS 
FROM ref_mst_component_resource AS a
		
INNER JOIN	
		ref_join_comp_dispcomp AS b
		ON a.COMP_ID=b.COMP_ID
		INNER JOIN ref_join_dispcomp_role AS c
		ON b.COMP_DISPLAY_GROUP_ID=c.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_disp_comp_group AS d
		ON d.COMP_DISPLAY_GROUP_ID=b.COMP_DISPLAY_GROUP_ID
		INNER JOIN ref_mst_component_resource AS e
		ON e.COMP_ID = a.COMP_ID
		WHERE d.ASSOC_SCREEN_ID='dbd' AND d.SCREEN_POSITION='Right'
		AND c.ROLE_ID = 'ROLE1'
		GROUP BY a.COMP_GROUP_ID, a.COMP_NAME
     
<2019-07-06T05:51:45+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:46+01:00 INFO (6)>:: <[monthWiseReceptCurrYear] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:46+01:00 INFO (6)>:: 
				select sum(a.TOTAL_RECEIPT_PRINCIPAL) as RECEPT, a.START_DATE,monthname(a.START_DATE) as MONTH,
				concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY) AS 'DATE_B'
				from ltr_trn_summary as a 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
				where a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE' and
				a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY))
				and a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
				group by MONTH

		
<2019-07-06T05:51:51+01:00 INFO (6)>:: <[monthWiseReceptCurrYear] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:52+01:00 INFO (6)>:: <[colDuePymtQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:52+01:00 INFO (6)>:: 
				SELECT SUM(TOTAL_RECEIPT_DUE_PRINCIPAL) AS TOTAL ,EMPLOYEE_ID AS CUSTOMER
				FROM ltr_trn_summary 
				WHERE STATUS='NORMAL'
				GROUP BY EMPLOYEE_ID
			
<2019-07-06T05:51:58+01:00 INFO (6)>:: <[colDuePymtQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:58+01:00 INFO (6)>:: <[schemewiseCustPaymentOfYearQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:58+01:00 INFO (6)>:: 
			select COUNT(a.CUSTOMER_ID) as CUSTOMERS , a.SCHEME_ID as SCHEME_ID,  date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY)) as 'YEAR_START_DATE',
			date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY)) as 'YEAR_END_DATE'
			from ltr_trn_summary as a
			join 
			( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
			where a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY)) and 
			a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
			and a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE'
			group by SCHEME_ID
			order by CUSTOMERS desc
		
<2019-07-06T05:51:58+01:00 INFO (6)>:: <[schemewiseCustPaymentOfYearQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:58+01:00 INFO (6)>:: <[payReceptDueCurrentYear] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:58+01:00 INFO (6)>:: 
				select sum(a.TOTAL_PAYMENT_PRINCIPAL) AS SUM_COLUMN, 'PAYMENT' as AMOUNT,
				concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY) AS 'DATE_B'
				from ltr_trn_summary as a 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
				where a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE'
				and
				a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY)) and 
				a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
				group by 1=1
				union
				select sum(a.TOTAL_RECEIPT_PRINCIPAL) AS SUM_COLUMN, 'RECEIPT' as AMOUNT,
				concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY) AS 'DATE_B'
				from ltr_trn_summary as a 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
				where a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE'
				and
				a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY)) and 
				a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
				group by 1=1
				union
				select sum(a.TOTAL_RECEIPT_DUE_PRINCIPAL) AS SUM_COLUMN, 'DUE' as AMOUNT,
				concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY) AS 'DATE_B'
				from ltr_trn_summary as a 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
				where a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE'
				and
				a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY)) and 
				a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
				group by 1=1
		
<2019-07-06T05:51:59+01:00 INFO (6)>:: <[payReceptDueCurrentYear] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:51:59+01:00 INFO (6)>:: <[schmTypeWiseTotalReceptCurrYear] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:51:59+01:00 INFO (6)>:: 
				SELECT rms.SCHEME_TYPE as SCHEME_TYPE ,SUM(ltd.RECEIPT_AMOUNT) as Recept,
				concat(c.FIN_YEAR_START,'-',c.FIN_YEAR_START_MONTH,'-',c.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(c.FIN_YEAR_END,'-',c.FIN_YEAR_END_MONTH,'-',c.FIN_YEAR_END_DAY) AS 'DATE_B'
				FROM ref_mst_scheme AS rms
				LEFT OUTER JOIN ltr_trn_details AS ltd
				ON rms.SCHEME_ID=ltd.SCHEME_ID
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as c
				WHERE ltd.STATUS='NORMAL' and c.ACTIVE_STATUS='ACTIVE' and
				ltd.TRANSACTION_DATE>=date(concat(c.FIN_YEAR_START,'-',c.FIN_YEAR_START_MONTH,'-',c.FIN_YEAR_START_DAY))
				and ltd.TRANSACTION_DATE<=date(concat(c.FIN_YEAR_END,'-',c.FIN_YEAR_END_MONTH,'-',c.FIN_YEAR_END_DAY))
				GROUP BY SCHEME_TYPE
		
<2019-07-06T05:52:05+01:00 INFO (6)>:: <[schmTypeWiseTotalReceptCurrYear] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:05+01:00 INFO (6)>:: <[topTenPymtLocQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:05+01:00 INFO (6)>:: 
				SELECT SUM(a.TOTAL_PAYMENT_PRINCIPAL) AS LOAN, b.LOCATION_ID as LOCATION , 
				concat(c.FIN_YEAR_START,'-',c.FIN_YEAR_START_MONTH,'-',c.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(c.FIN_YEAR_END,'-',c.FIN_YEAR_END_MONTH,'-',c.FIN_YEAR_END_DAY) AS 'DATE_B'
				FROM ltr_trn_summary AS a
				RIGHT OUTER JOIN ref_mst_entity AS b
				ON a.CUSTOMER_ID=b.CUSTOMER_ID 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as c
				WHERE a.STATUS='NORMAL' and c.ACTIVE_STATUS='ACTIVE'
				and a.START_DATE>=date(concat(c.FIN_YEAR_START,'-',c.FIN_YEAR_START_MONTH,'-',c.FIN_YEAR_START_DAY))
				and a.START_DATE<=date(concat(c.FIN_YEAR_END,'-',c.FIN_YEAR_END_MONTH,'-',c.FIN_YEAR_END_DAY))
				GROUP BY LOCATION
				ORDER BY LOAN DESC
				LIMIT 10
		
<2019-07-06T05:52:14+01:00 INFO (6)>:: <[topTenPymtLocQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:17+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-07-06T05:52:17+01:00 INFO (6)>:: Chart path initialized
<2019-07-06T05:52:17+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:17+01:00 INFO (6)>:: 
		SELECT
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_id, 
		ref_mst_application_resource.MODULE_ID acl_module_name,
		ref_mst_application_resource.RESOURCE_ID acl_resource_name,
		ref_mst_access_privilege.PRIVILEGE_ID acl_privilege_name,
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_name,
		ref_mst_user.ID acl_user_id,
		ref_mst_user.USER_ID acl_user_name
		FROM ref_mst_user
		INNER JOIN ref_join_access_role_user
		ON ref_join_access_role_user.USER_ID = ref_mst_user.USER_ID
		INNER JOIN ref_mst_access_role
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_mst_access_role.ACCESS_ROLE_ID
		INNER JOIN ref_join_access_role_appln_resource
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_join_access_role_appln_resource.ACCESS_ROLE_ID
		INNER JOIN ref_mst_application_resource
		ON ref_join_access_role_appln_resource.APPLICATION_RESOURCE_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
		INNER JOIN ref_mst_access_privilege
		ON  ref_mst_access_privilege.RESOURCE_MASTER_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
     
<2019-07-06T05:52:17+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:17+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:17+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-07-06T05:52:17+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:18+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:18+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER 
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL'
		
<2019-07-06T05:52:18+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:18+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:18+01:00 INFO (6)>:: 
			SELECT COUNT(ID) AS TOTAL_LOAN_CUSTOMER 
			FROM ltr_trn_summary
			WHERE STATUS='NORMAL' AND ACTIVE_STATUS='OPEN'
		
<2019-07-06T05:52:20+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:20+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-07-06T05:52:20+01:00 INFO (6)>:: Chart path initialized
<2019-07-06T05:52:20+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:20+01:00 INFO (6)>:: 
		SELECT
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_id, 
		ref_mst_application_resource.MODULE_ID acl_module_name,
		ref_mst_application_resource.RESOURCE_ID acl_resource_name,
		ref_mst_access_privilege.PRIVILEGE_ID acl_privilege_name,
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_name,
		ref_mst_user.ID acl_user_id,
		ref_mst_user.USER_ID acl_user_name
		FROM ref_mst_user
		INNER JOIN ref_join_access_role_user
		ON ref_join_access_role_user.USER_ID = ref_mst_user.USER_ID
		INNER JOIN ref_mst_access_role
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_mst_access_role.ACCESS_ROLE_ID
		INNER JOIN ref_join_access_role_appln_resource
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_join_access_role_appln_resource.ACCESS_ROLE_ID
		INNER JOIN ref_mst_application_resource
		ON ref_join_access_role_appln_resource.APPLICATION_RESOURCE_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
		INNER JOIN ref_mst_access_privilege
		ON  ref_mst_access_privilege.RESOURCE_MASTER_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
     
<2019-07-06T05:52:20+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:20+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:20+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-07-06T05:52:20+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:21+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:21+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL' 
		
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
			SELECT COUNT(SCHEME_ID) AS TOTAL_SCHEME
			FROM ref_mst_scheme
			WHERE STATUS='NORMAL'
		
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_COLLECTOR
			FROM ref_mst_collector
			WHERE STATUS='NORMAL'
		
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
			SELECT COUNT(LOCATION_ID) AS TOTAL_LOCATION
			FROM ref_mst_location 
			WHERE STATUS='NORMAL'
		
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-07-06T05:52:23+01:00 INFO (6)>:: Chart path initialized
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
		SELECT
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_id, 
		ref_mst_application_resource.MODULE_ID acl_module_name,
		ref_mst_application_resource.RESOURCE_ID acl_resource_name,
		ref_mst_access_privilege.PRIVILEGE_ID acl_privilege_name,
		ref_mst_access_role.ACCESS_ROLE_ID acl_role_name,
		ref_mst_user.ID acl_user_id,
		ref_mst_user.USER_ID acl_user_name
		FROM ref_mst_user
		INNER JOIN ref_join_access_role_user
		ON ref_join_access_role_user.USER_ID = ref_mst_user.USER_ID
		INNER JOIN ref_mst_access_role
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_mst_access_role.ACCESS_ROLE_ID
		INNER JOIN ref_join_access_role_appln_resource
		ON ref_join_access_role_user.ACCESS_ROLE_ID = ref_join_access_role_appln_resource.ACCESS_ROLE_ID
		INNER JOIN ref_mst_application_resource
		ON ref_join_access_role_appln_resource.APPLICATION_RESOURCE_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
		INNER JOIN ref_mst_access_privilege
		ON  ref_mst_access_privilege.RESOURCE_MASTER_ID = ref_mst_application_resource.RESOURCE_MASTER_ID
     
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:23+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:23+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER 
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL'
		
<2019-07-06T05:52:24+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-07-06T05:52:24+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-07-06T05:52:24+01:00 INFO (6)>:: 
			SELECT COUNT(ID) AS TOTAL_LOAN_CUSTOMER 
			FROM ltr_trn_summary
			WHERE STATUS='NORMAL' AND ACTIVE_STATUS='OPEN'
		
<2019-07-06T05:52:26+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 

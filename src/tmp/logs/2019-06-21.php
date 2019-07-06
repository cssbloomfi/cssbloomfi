<2019-06-21T14:59:10+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:10+01:00 INFO (6)>:: Theme path initialized
<2019-06-21T14:59:10+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:11+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:11+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:11+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:25+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:25+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:26+01:00 INFO (6)>:: <[userRoleOnUserId] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:26+01:00 INFO (6)>:: 
		SELECT ACCESS_ROLE_ID, USER_ID FROM
		ref_join_access_role_user
		WHERE USER_ID='admin'
	     
<2019-06-21T14:59:26+01:00 INFO (6)>:: <[userRoleOnUserId] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:26+01:00 INFO (6)>:: <[AllMenuQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:26+01:00 INFO (6)>:: 
	SELECT * FROM ref_mst_application_resource  as a
	left outer join ref_join_access_role_appln_resource as b
	on a.RESOURCE_MASTER_ID=b.APPLICATION_RESOURCE_ID
	where a.RESOURCE_TYPE = 'menu' AND b.ACCESS_ROLE_ID LIKE 'ROLE1'
	GROUP BY a.ID
	ORDER BY a.RESOURCE_MASTER_PARENT_ID, a.DISPLAY_SEQUENCE
     
<2019-06-21T14:59:26+01:00 INFO (6)>:: <[AllMenuQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:26+01:00 INFO (6)>::  ** Treeutils Instance Creating .....
<2019-06-21T14:59:26+01:00 INFO (6)>::  ** Treeutils Instance Created >>>>>>>>
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> 0
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = '0' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = '0' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> tst
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'tst' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'tst' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> dbd
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customer_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_employee_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_scheme_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_location_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customer_group
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customer
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customer_adduser
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_adduser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_adduser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customer_edituser
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_edituser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customer_edituser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_multicust
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multicust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multicust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_deleted_customer
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_deleted_customer' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_deleted_customer' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_collector_group
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_collector_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_collector_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_employee
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_employee_addemployee
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_addemployee' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_addemployee' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_employee_editemp
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_editemp' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_editemp' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_employee_emplocmap
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_emplocmap' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_employee_emplocmap' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_multicoll
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multicoll' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multicoll' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_location_group
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_location
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_location_add
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_add' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_add' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_location_edit
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_edit' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_location_edit' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_multilocation
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multilocation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multilocation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_scheme_group
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_group' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_scheme
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_scheme_addschm
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_addschm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_addschm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_scheme_editschm
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_editschm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_scheme_editschm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_multischeme
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multischeme' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_multischeme' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_payment_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_receive_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_payment
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_payment_addsummary
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_addsummary' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_addsummary' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_payment_editsummary_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_editsummary_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_editsummary_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_payment_editsummary
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_editsummary' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_payment_editsummary' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_receive
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_receive_adddetails
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_adddetails' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_adddetails' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_receive_editdtl_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_editdtl_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_editdtl_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_receive_editdtl
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_editdtl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_receive_editdtl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_multipaycust
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipaycust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipaycust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_multipaycust2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipaycust2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipaycust2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_multipay
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipay' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multipay' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_multirec
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multirec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_multirec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> dbd_index_excelupload
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_index_excelupload' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_index_excelupload' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customerexcel
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customerexcel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customerexcel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> ref_customerexcel_custexport
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customerexcel_custexport' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'ref_customerexcel_custexport' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_excel
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_excel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_excel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_excel_transexport
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_excel_transexport' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_excel_transexport' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> trn_custpayexcel
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_custpayexcel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'trn_custpayexcel' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> css_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'css_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'css_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_csscustdtlschdl
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_csscustdtlschdl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_csscustdtlschdl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_custloc
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_custloc' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_custloc' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_bsd
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_bsd' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_bsd' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_outstandingscdl
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_outstandingscdl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_outstandingscdl' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_cssmislocpayrec
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_cssmislocpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_cssmislocpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_cssmisprojpayrec
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_cssmisprojpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_cssmisprojpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> operational_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'operational_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'operational_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collpayrec
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collpayrec' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> exception_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'exception_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'exception_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collexception
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collexception' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collexception' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_fupaydate
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_fupaydate' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_fupaydate' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_furecdate
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_furecdate' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_furecdate' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> memo_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'memo_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'memo_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dlysmrymemo
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlysmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlysmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_wklysmrymemo
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_wklysmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_wklysmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_mnthsmrymemo
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthsmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthsmrymemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dlydtlsmemo
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlydtlsmemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlydtlsmemo' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> voucher_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'voucher_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'voucher_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dlysmryvchr
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlysmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlysmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_wklysmryvchr
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_wklysmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_wklysmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_mnthsmryvchr
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthsmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthsmryvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dlydtlsvchr
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlydtlsvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dlydtlsvchr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> client_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'client_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'client_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dtlcust
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dtlcust2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dtlcust3
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust3' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtlcust3' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> collector_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'collector_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'collector_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collsmryact
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_colllocsmryact
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_colllocgndrsmryact
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocgndrsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocgndrsmryact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_colllocgndrdtlsact
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocgndrdtlsact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colllocgndrdtlsact' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> topsheet_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'topsheet_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'topsheet_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_colltopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colltopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_colltopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_schmtopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmtopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmtopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_loctopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_loctopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_loctopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_weektopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_weektopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_weektopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_mnthtopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthtopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthtopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_dtltopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtltopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_dtltopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_acnttyptopsht
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_acnttyptopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_acnttyptopsht' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> par_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'par_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'par_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collschmpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collschmpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collschmpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_collschmlocpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collschmlocpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_collschmlocpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_schmpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_locpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_locpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_locpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_gndrpar
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_gndrpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_gndrpar' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> mis_report
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'mis_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'mis_report' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_mnthpymtrecmis
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_mnthpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_locpymtrecmis
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_locpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_locpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_schmpymtrecmis
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_schmpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> rpt_gndrpymtrecmis
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_gndrpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'rpt_gndrpymtrecmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> dbd_index_mgmtinfsys
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_index_mgmtinfsys' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_index_mgmtinfsys' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> dbd_chartmis
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_chartmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'dbd_chartmis' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_useraccesscontrol
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_useraccesscontrol_usercreation
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_usercreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_usercreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_usercreation
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_usercreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_usercreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_rolecreation
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_rolecreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_rolecreation' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_maproletouser
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_maproletouser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_maproletouser' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_useraccesscontrol_mapmenutorole
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_mapmenutorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_mapmenutorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_useraccesscontrol_mapusertorole
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_mapusertorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_useraccesscontrol_mapusertorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_mapmenutorole
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_mapmenutorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_mapmenutorole' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_compacc_control
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compacc_control' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compacc_control' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_compscreen
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compscreen' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compscreen' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_compaccess
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compaccess' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_compaccess' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_fin_year
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_fin_year' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_fin_year' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_finyear
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_finyear' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_finyear' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_logmanagement
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_logmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_logmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_custxlslogmanagement
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_custxlslogmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_custxlslogmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_tranxlslogmanagement
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_tranxlslogmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_tranxlslogmanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_custpayxlslogmangmnt
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_custpayxlslogmangmnt' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_custpayxlslogmangmnt' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_logfilemanagement
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_logfilemanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_logfilemanagement' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_bkuprecovr
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_bkuprecovr_1
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr_1' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr_1' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo ParentID supplied to getTree=>> adm_bkuprecovr_2
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>:: oooooo SQL executed Successfully ::> SELECT * FROM ref_mst_application_resource WHERE RESOURCE_MASTER_PARENT_ID = 'adm_bkuprecovr_2' order by display_sequence
<2019-06-21T14:59:26+01:00 INFO (6)>::  ** Treeutils Instance Returned TreeArray +++++++++
<2019-06-21T14:59:27+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:27+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[chartComponentOfScreenId] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:27+01:00 INFO (6)>:: <[monthWiseReceptCurrYear] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:27+01:00 INFO (6)>:: 
				select sum(a.TOTAL_RECEIPT_PRINCIPAL) as RECEPT, a.START_DATE,monthname(a.START_DATE) as MONTH,
				concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY) AS 'DATE_A', 
				concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY) AS 'DATE_B'
				from ltr_trn_summary as a 
				join ( SELECT * FROM ref_mst_fin_year_info WHERE ACTIVE_STATUS='ACTIVE' AND STATUS='NORMAL') as b
				where a.STATUS='NORMAL' and b.ACTIVE_STATUS='ACTIVE' and
				a.START_DATE>=date(concat(b.FIN_YEAR_START,'-',b.FIN_YEAR_START_MONTH,'-',b.FIN_YEAR_START_DAY))
				and a.START_DATE<=date(concat(b.FIN_YEAR_END,'-',b.FIN_YEAR_END_MONTH,'-',b.FIN_YEAR_END_DAY))
				group by MONTH

		
<2019-06-21T14:59:28+01:00 INFO (6)>:: <[monthWiseReceptCurrYear] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:28+01:00 INFO (6)>:: <[colDuePymtQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:28+01:00 INFO (6)>:: 
				SELECT SUM(TOTAL_RECEIPT_DUE_PRINCIPAL) AS TOTAL ,EMPLOYEE_ID AS CUSTOMER
				FROM ltr_trn_summary 
				WHERE STATUS='NORMAL'
				GROUP BY EMPLOYEE_ID
			
<2019-06-21T14:59:29+01:00 INFO (6)>:: <[colDuePymtQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:29+01:00 INFO (6)>:: <[schemewiseCustPaymentOfYearQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:29+01:00 INFO (6)>:: 
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
		
<2019-06-21T14:59:29+01:00 INFO (6)>:: <[schemewiseCustPaymentOfYearQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:29+01:00 INFO (6)>:: <[payReceptDueCurrentYear] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:29+01:00 INFO (6)>:: 
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
		
<2019-06-21T14:59:29+01:00 INFO (6)>:: <[payReceptDueCurrentYear] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:30+01:00 INFO (6)>:: <[schmTypeWiseTotalReceptCurrYear] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:30+01:00 INFO (6)>:: 
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
		
<2019-06-21T14:59:33+01:00 INFO (6)>:: <[schmTypeWiseTotalReceptCurrYear] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:34+01:00 INFO (6)>:: <[topTenPymtLocQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:34+01:00 INFO (6)>:: 
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
		
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[topTenPymtLocQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[maxResourceIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT MAX(ID) AS MAX_ID FROM ref_mst_hierarchy_resource
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[maxResourceIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 0
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 1
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:36+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:36+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 2
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_customer' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_customer' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_customer' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 3
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_investsummary' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 4
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report1' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 5
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report2' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 6
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report3' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 7
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report4' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 8
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report5' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 9
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='dbd' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 10
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 11
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 12
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report6' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 13
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_employee' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_employee' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_employee' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_employee' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 14
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 15
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 16
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_custxlslogmanagement' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 17
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 18
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_payment' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_payment' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_payment' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 19
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_receive' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_receive' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_receive' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 20
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_location' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_location' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_location' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 21
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_scheme' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_scheme' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:37+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref_scheme' ORDER BY ID
     
<2019-06-21T14:59:37+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ref' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 22
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_excel' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 23
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 24
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 25
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 26
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 27
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 28
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 29
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_excelupload' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 30
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_customerexcel' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 31
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_customer' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 32
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_tranxlslogmanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 33
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_logfilemanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 34
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 35
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_customerexcel_custexport' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 36
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_excel_transexport' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 37
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 38
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report8' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 39
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report7' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 40
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_customer_adduser' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 41
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_customer_edituser' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 42
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_employee_addemployee' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 43
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_employee_editemp' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 44
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_employee_emplocmap' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 45
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_location_add' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 46
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_location_edit' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 47
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_scheme_addschm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 48
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_scheme_editschm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 49
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_payment_addsummary' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_payment_addsummary' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_payment' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 50
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_payment_editsummary' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 51
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_payment_editsummary_2' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 52
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_receive_adddetails' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_receive_adddetails' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn_receive' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='trn' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 53
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_receive_editdtl' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 54
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_receive_editdtl_2' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 55
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='dbd_index_mgmtinfsys' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='dbd_index_mgmtinfsys' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 56
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 57
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_useraccesscontrol_usercreation' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 58
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_useraccesscontrol_rolecreation' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 59
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_useraccesscontrol_mapmenutorole1' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 60
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_maproletouser' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_maproletouser' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 61
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_usercreation' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_usercreation' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_usercreation' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 62
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_usercreation2' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 63
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_usercreation3' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 64
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_logmanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_logmanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_logmanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_logmanagement' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:38+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:38+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 65
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_maproletouser_mapuserrole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 66
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_maproletouser_editmapuserrole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 67
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='dbd_error' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 68
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_rolecreation' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_rolecreation' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_rolecreation' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 69
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_rolecreation_addrole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 70
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_rolecreation_editrole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 71
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_mapmenutorole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_mapmenutorole' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_useraccesscontrol' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 72
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_mapmenutorole_maprolemenu' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 73
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='dbd_chartmis' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 74
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_report9' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 75
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='memo_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='memo_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='memo_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='memo_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='memo_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 76
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dlysmrymemo' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 77
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_wklysmrymemo' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 78
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_mnthsmrymemo' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 79
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dlydtlsmemo' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 80
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='voucher_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='voucher_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='voucher_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='voucher_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='voucher_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 81
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dlysmryvchr' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 82
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_wklysmryvchr' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 83
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_mnthsmryvchr' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 84
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dlydtlsvchr' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 85
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='client_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='Client_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='client_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='client_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 86
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dtlcust' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 87
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dtlcust2' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 88
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dtlcust3' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 89
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='collector_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='collector_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='collector_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='collector_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='collector_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 90
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_collsmryact' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 91
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_colllocsmryact' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 92
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_colllocgndrsmryact' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 93
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_colllocgndrdtlsact' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 94
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='topsheet_report' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 95
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_colltopsht' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 96
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_schmtopsht' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 97
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_weektopsht' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 98
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_loctopsht' ORDER BY ID
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:39+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 99
     
<2019-06-21T14:59:39+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_mnthtopsht' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 100
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_dtltopsht' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 101
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_acnttyptopsht' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 102
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='par_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 103
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_collpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 104
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_collschmpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 105
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_collschmlocpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 106
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_schmpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 107
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_locpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 108
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_gndrpar' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 109
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='operational_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='operational_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 110
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_bsd' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 111
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_collpayrec' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 112
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='mis_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='mis_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='mis_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='mis_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='mis_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 113
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_schmpymtrecmis' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 114
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_gndrpymtrecmis' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 115
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_mnthpymtrecmis' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 116
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_locpymtrecmis' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 117
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 118
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_multipay' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 119
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_multirec' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 120
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_multipaycust' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 121
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_multipaycust2' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 122
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='trn_custpayexcel' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 123
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='css_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='css_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='css_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='css_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 124
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_csscustdtlschdl' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 125
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_custloc' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 126
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 127
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='exception_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='exception_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='exception_report' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='rpt' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 128
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_fupaydate' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 129
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='rpt_furecdate' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 130
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_compacc_control' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compacc_control' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compacc_control' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 131
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_compscreen' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compscreen' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compacc_control' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 132
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_compaccess' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compaccess' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_compacc_control' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 133
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_compscreen_entry' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 134
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_compaccess_entry' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 135
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='ref_multicust_insertcust' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 136
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_fin_year' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_fin_year' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 137
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_finyear' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_finyear' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_fin_year' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_finyear' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm_fin_year' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='adm' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT ID, RESOURCE_MASTER_ID, RESOURCE_NAME, RESOURCE_URL, RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource WHERE RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_ID='ROOT' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 138
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_finyear_addfinyear' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
		SELECT RESOURCE_MASTER_ID FROM ref_mst_hierarchy_resource
		WHERE ID = 139
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceMasterIdonIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:40+01:00 INFO (6)>:: 
	     SELECT ID,  RESOURCE_MASTER_ID,MODULE_ID, RESOURCE_ID, MENU_ID, PARENT_ACTION_ID, RESOURCE_NAME, RESOURCE_URL,  RESOURCE_MASTER_PARENT_ID FROM ref_mst_hierarchy_resource where RESOURCE_TYPE= 'breadcrumb' AND RESOURCE_MASTER_PARENT_ID='adm_finyear_editfinyear' ORDER BY ID
     
<2019-06-21T14:59:40+01:00 INFO (6)>:: <[resourceByParentIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:42+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:42+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:42+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:42+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL' 
		
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
			SELECT COUNT(SCHEME_ID) AS TOTAL_SCHEME
			FROM ref_mst_scheme
			WHERE STATUS='NORMAL'
		
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_COLLECTOR
			FROM ref_mst_collector
			WHERE STATUS='NORMAL'
		
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
			SELECT COUNT(LOCATION_ID) AS TOTAL_LOCATION
			FROM ref_mst_location 
			WHERE STATUS='NORMAL'
		
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:43+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:43+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:43+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:43+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:44+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:44+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER 
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL'
		
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:44+01:00 INFO (6)>:: 
			SELECT COUNT(ID) AS TOTAL_LOAN_CUSTOMER 
			FROM ltr_trn_summary
			WHERE STATUS='NORMAL' AND ACTIVE_STATUS='OPEN'
		
<2019-06-21T14:59:44+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:45+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T14:59:45+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:45+01:00 INFO (6)>:: 
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
     
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:45+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:45+01:00 INFO (6)>:: 
			SELECT COUNT(ENTITY_ID) AS TOTAL_CUSTOMER 
			FROM ref_mst_entity
			WHERE ENTITY_TYPE='Customer' AND STATUS='NORMAL'
		
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T14:59:45+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'Execution Started'>
<2019-06-21T14:59:45+01:00 INFO (6)>:: 
			SELECT COUNT(ID) AS TOTAL_LOAN_CUSTOMER 
			FROM ltr_trn_summary
			WHERE STATUS='NORMAL' AND ACTIVE_STATUS='OPEN'
		
<2019-06-21T14:59:46+01:00 INFO (6)>:: <[Function] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:01:53+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:01:53+01:00 INFO (6)>:: Theme path initialized
<2019-06-21T15:01:53+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:01:53+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:01:53+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:01:53+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:29:00+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:29:00+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:29:00+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:29:00+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:29:00+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:29:00+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:29:00+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:29:00+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:29:01+01:00 INFO (6)>:: <[getAllReceiveTypesQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:29:01+01:00 INFO (6)>:: 
			SELECT KEY_ID, VALUE_ID, KEY_NAME, VALUE_NAME FROM ref_sta_key_value 
			WHERE KEY_ID='ReceiveType' AND STATUS='NORMAL'
		
<2019-06-21T15:29:01+01:00 INFO (6)>:: <[getAllReceiveTypesQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:29:01+01:00 INFO (6)>:: <[AllTransactionDetailQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:29:01+01:00 INFO (6)>:: 
			SELECT Trndtl.ID, Trndtl.TRAN_DETAILS_ID, Trndtl.MEMO_NO, TrnDtl_1.VOUCHER_NO, Trndtl.TRAN_SUMMARY_ID, Trndtl.SCHEME_ID, MSchem.SCHEME_TYPE, 
			concat( TrnDtl_1.CUSTOM_COMMENT1,' (',TrnDtl_1.CUSTOM_COMMENT2,')' ) AS 'CUSTOMER_NAME', Trndtl.EMPLOYEE_ID, Trndtl.RECEIPT_AMOUNT, Trndtl.RECEIPT_TYPE, 
			Trndtl.TRANSACTION_DATE
			FROM ltr_trn_details AS Trndtl
			INNER JOIN (
			SELECT TRAN_SUMMARY_ID, PAYMENT_TYPE, VOUCHER_NO, CUSTOM_COMMENT1, CUSTOM_COMMENT2
			FROM ltr_trn_details
			WHERE PAYMENT_TYPE = 'CAPITAL_PAID'
			) AS TrnDtl_1 ON Trndtl.TRAN_SUMMARY_ID = TrnDtl_1.TRAN_SUMMARY_ID
			LEFT OUTER JOIN (
			SELECT SCHEME_ID, SCHEME_TYPE
			FROM ref_mst_scheme
			WHERE STATUS = 'NORMAL'
			) AS MSchem ON MSchem.SCHEME_ID = Trndtl.SCHEME_ID
			WHERE STATUS = 'NORMAL'
			AND Trndtl.PAYMENT_TYPE IS NULL
			ORDER BY Trndtl.ID DESC
			LIMIT 0, 100
		
<2019-06-21T15:30:41+01:00 INFO (6)>:: <[AllTransactionDetailQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:30:41+01:00 INFO (6)>:: <[allSchemeTypesQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:30:41+01:00 INFO (6)>:: 
			SELECT KEY_ID, VALUE_ID, KEY_NAME, VALUE_NAME
			FROM ref_sta_key_value WHERE KEY_ID='SchemeType'
		
<2019-06-21T15:30:41+01:00 INFO (6)>:: <[allSchemeTypesQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:56+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:34:56+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:34:56+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:56+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:34:56+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:56+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:56+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:34:56+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:56+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:56+01:00 INFO (6)>:: 
			SELECT CUSTOMER_ID FROM ref_mst_entity 
			WHERE ENTITY_TYPE = 'Customer' AND CUSTOMER_ID LIKE 'aa%' AND STATUS='NORMAL' LIMIT 20
		
<2019-06-21T15:34:57+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:58+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:34:58+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:58+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:58+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:34:58+01:00 INFO (6)>:: 
			SELECT CUSTOMER_ID FROM ref_mst_entity 
			WHERE ENTITY_TYPE = 'Customer' AND CUSTOMER_ID LIKE 'aaaaa%' AND STATUS='NORMAL' LIMIT 20
		
<2019-06-21T15:34:58+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:00+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:35:00+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:35:00+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:00+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:35:00+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:00+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:00+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:35:00+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:01+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:01+01:00 INFO (6)>:: 
			SELECT CUSTOMER_ID FROM ref_mst_entity 
			WHERE ENTITY_TYPE = 'Customer' AND CUSTOMER_ID LIKE '%' AND STATUS='NORMAL' LIMIT 20
		
<2019-06-21T15:35:01+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:02+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:35:02+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:35:02+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:02+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:35:02+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:02+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:02+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:35:02+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:03+01:00 INFO (6)>:: 
			SELECT CUSTOMER_ID FROM ref_mst_entity 
			WHERE ENTITY_TYPE = 'Customer' AND CUSTOMER_ID LIKE '12588%' AND STATUS='NORMAL' LIMIT 20
		
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:03+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-21T15:35:03+01:00 INFO (6)>:: Chart path initialized
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:03+01:00 INFO (6)>:: 
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
     
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:03+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-21T15:35:03+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'Execution Started'>
<2019-06-21T15:35:03+01:00 INFO (6)>:: 
			SELECT CUSTOMER_ID FROM ref_mst_entity 
			WHERE ENTITY_TYPE = 'Customer' AND CUSTOMER_ID LIKE '1258%' AND STATUS='NORMAL' LIMIT 20
		
<2019-06-21T15:35:04+01:00 INFO (6)>:: <[SuggestCustomersIdQuery] SQL(query for exception) 'executed successfully'> 

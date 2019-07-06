<2019-06-24T05:54:03+01:00 INFO (6)>:: Bootstrap Sessions setup finished!
<2019-06-24T05:54:03+01:00 INFO (6)>:: Chart path initialized
<2019-06-24T05:54:04+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'Execution Started'>
<2019-06-24T05:54:04+01:00 INFO (6)>:: 
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
     
<2019-06-24T05:54:04+01:00 INFO (6)>:: <[UserRoleAccessQuery] SQL(query for exception) 'executed successfully'> 
<2019-06-24T05:54:04+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'Execution Started'>
<2019-06-24T05:54:04+01:00 INFO (6)>:: 
	SELECT a.ID ID, a.ACCESS_ROLE_DESC ROLE_NAME, b.USER_ID USER_ID,b.ACCESS_ROLE_ID ACCESS_ROLE_ID, 
	c.USER_ID  USER_ID 
	FROM ref_mst_user c,
	ref_join_access_role_user b, 
	ref_mst_access_role a 
	WHERE a.ACCESS_ROLE_ID=b.ACCESS_ROLE_ID AND c.USER_ID=b.USER_ID AND c.USER_ID='admin'
     
<2019-06-24T05:54:04+01:00 INFO (6)>:: <[UserRoleIdInfoQuery] SQL(query for exception) 'executed successfully'> 

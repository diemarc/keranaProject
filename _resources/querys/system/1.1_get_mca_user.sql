SELECT A.*,B.module,C.controller,D.action_name
FROM sys_acl_user_action A
INNER JOIN sys_modules B ON (A.id_module = B.id_module)
INNER JOIN sys_controllers C ON (A.id_controller = C.id_controller)
INNER JOIN sys_actions D ON (A.id_action = D.id_action)
WHERE A.id_user = 3
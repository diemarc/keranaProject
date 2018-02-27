SELECT A.*,B.module,C.controller,D.action_name
FROM sys_actions_controllers A
INNER JOIN sys_modules B ON (A.id_module = B.id_module)
INNER JOIN sys_controllers C ON (A.id_controller = C.id_controller)
INNER JOIN sys_actions D ON (A.id_action = D.id_action)
WHERE A.id_module NOT IN
						(
							SELECT X.id_module
                            FROM sys_acl_user_action X
                            WHERE X.id_controller = A.id_controller
                            AND X.id_action = A.id_action
                            AND X.id_user = 7
                        )
ORDER BY A.id_module,A.id_controller,A.id_action
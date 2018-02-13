<?php

namespace Kerana\acl;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class AclUserModel
  |-----------------------------------------------------------------------------
  |
 */

class AclControllerUserActionModel extends \kerana\Ada
{

    public
    /** @var int(11), id_user  */
            $id_user,
            /** @var int(11), id_module  */
            $id_module,
            /** @var int(11), id_controller  */
            $id_controller,
            /** @var int(11), id_action  */
            $id_action,
            /** @string, string, module name */
            $module_name,
            /** @string , controller name  */
            $controller_name,
            /** @string, action name  */
            $action_name;
    private
    /** @mixed, master query for acl */
            $_mq_acl;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_acl_user_action';
        $this->table_id = 'id_user';
    }

    /**
     * -------------------------------------------------------------------------
     * Set the masterQuery for acl
     * -------------------------------------------------------------------------
     */
    private function _setMqAcl()
    {
        $this->_setQuery(' SELECT A.id_user FROM ' . $this->table_name . ' A '
                . ' INNER JOIN sys_modules B ON (A.id_module = B.id_module)'
                . ' INNER JOIN sys_controllers C ON (A.id_controller = C.id_controller)'
                . ' INNER JOIN sys_actions D ON (A.id_action = D.id_action)'
                . ' WHERE A.id_user = :id_user');
        $this->_binds = [
            ':id_user' => $this->id_user
        ];
    }

    /**
     * -------------------------------------------------------------------------
     * Get Asociation id_user with id_module, only for restricted modules.
     * -------------------------------------------------------------------------
     * @return @object
     */
    public function getMcaPetitionForUser()
    {

        $this->_setMqAcl();
        $this->_setQuery($this->_query
                . ' AND B.module = :module'
                . ' AND C.controller = :controller '
                . ' AND D.action_name = :action'
                . ' LIMIT 1 ');

        $this->_binds[':module'] = $this->module_name;
        $this->_binds[':controller'] = $this->controller_name;
        $this->_binds[':action'] = $this->action_name;

        return $this->getQuery('one');
    }

    /**
     * -------------------------------------------------------------------------
     * Get MCA's for user
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getMcaUser()
    {
        $this->_setMqAcl();
        return $this->getQuery();
    }

}

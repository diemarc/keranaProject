<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class AclUserModel
  |-----------------------------------------------------------------------------
  |
 */

class UserPermissionModel extends \kerana\Ada
{

    protected
    /** @var int(11), id_user  */
            $_id_user,
            /** @var int(11), id_module  */
            $_id_module,
            /** @var int(11), id_controller  */
            $_id_controller,
            /** @var int(11), id_action  */
            $_id_action,
            /** @string, string, module name */
            $_module_name,
            /** @string , controller name  */
            $_controller_name,
            /** @string, action name  */
            $_action_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_acl_user_action';
        $this->table_id = 'id_user';
    }


    /*
      |--------------------------------------------------------------------------
      | SETTERS
      |--------------------------------------------------------------------------
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Set id_user
     * -------------------------------------------------------------------------
     * @param type $id_user
     */
    public function setUserPermission($id_user = '')
    {
        $this->_id_user = \helpers\Validator::valInt('id_user',$id_user);
    }

    /**
     * Set the id module
     * @param int $id_module
     */
    public function setModulePermission($id_module = '')
    {
        $this->_id_module = \helpers\Validator::valInt('id_module',$id_module);
    }

    /**
     * Set the id controller
     * @param int $id_controller
     */
    public function setControllerPermission($id_controller = '')
    {
        $this->_id_controller = \helpers\Validator::valInt('id_controller',$id_controller);
    }

    /**
     * Set the id action
     * @param int $id_action
     */
    public function setActionPermission($id_action = '')
    {
        $this->_id_action = \helpers\Validator::valInt('id_action',$id_action);
    }

    /**
     * get the id_user
     * @return type
     */
    public function getUserPermission()
    {
        return $this->_id_user;
    }

    public function getAction(){
        return $this->_id_action;
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
                . ' WHERE A.id_module IS NOT NULL ');
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
                . ' AND A.id_user = :id_user '
                . ' AND B.module = :module'
                . ' AND C.controller = :controller '
                . ' AND D.action_name = :action'
                . ' LIMIT 1 ');

        $this->_binds[':id_user'] = $this->_id_user;
        $this->_binds[':module'] = $this->_module_name;
        $this->_binds[':controller'] = $this->_controller_name;
        $this->_binds[':action'] = $this->_action_name;

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

    
    /**
     * Insert the Mca asocciation for the user
     * @return type
     */
    public function saveMca()
            
    {
        $data = [
            'id_user' => $this->_id_user,
            'id_action' => $this->_id_action,
            'id_controller' => $this->_id_controller,
            'id_module' => $this->_id_module
        ];
        
        return $this->insert($data);
        
    }

}

<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ActionControllerModel
  |-----------------------------------------------------------------------------
  |
  | Actions for controllers, used by ACL MCA
  | @author kerana,
  | @date 16-02-2018 05:56:01,
  |
 */

class ActionControllerModel extends \kerana\Ada
{

    public
    /** @var int(11), id_action  */
            $id_action,
            /** @var int(11), id_controller  */
            $id_controller,
            /** @var int(11), id_module  */
            $id_module;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_actions_controllers';
        $this->table_id = 'id_action';
    }

    
    /**
     * -------------------------------------------------------------------------
     * Set the master query
     * -------------------------------------------------------------------------
     */
    protected function _setMqAction()
    {

        $this->_query = ' SELECT A.*,B.action_name,B.sw_system_action,C.controller,'
                . ' D.module '
                . ' FROM '.$this->table_name.' A '
                . ' INNER JOIN sys_actions B ON (A.id_action = B.id_action)'
                . ' INNER JOIN sys_controllers C ON (A.id_controller = C.id_controller)'
                . ' INNER JOIN sys_modules D ON (A.id_module = D.id_module)'
                . ' WHERE A.id_action IS NOT NULL';
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Get actions for controller-models
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getMcaAvaibleForUser(){
        
        $this->_setMqAction();
        $this->_query .= ' ORDER BY A.id_module,A.id_controller,A.id_action ';
        return $this->getQuery();
        
    }
    

}

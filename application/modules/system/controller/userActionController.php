<?php

namespace application\modules\system\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class UserActionController
  |-----------------------------------------------------------------------------
  |
  | Action assigned to a user.
  | @author kerana,
  | @date 21-02-2018 06:04:39,
  |
 */

class UserActionController extends \kerana\Kerana 
{

    protected

    /** @object user_action permission model */
            $_user_permission,
            /** @object action_controller model */
            $_action_controller;

    public function __construct()
    {
        parent::__construct();
        $this->_user_permission = new \application\modules\system\model\UserPermissionModel;
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index()
    {

        die();
    }

    /**
     * -------------------------------------------------------------------------
     * Add new permission action for $id_user
     * 
     * -------------------------------------------------------------------------
     */
    public function add($id_user)
    {
        $this->_user_permission->setUserPermission($id_user);
        $this->_action_controller = new \application\modules\system\model\ActionControllerModel();
        $params = [
            'id_user' => $id_user,
            'rsActions' => $this->_action_controller->getMcaAvaibleForUser()
        ];
        \kerana\View::showForm($this->_current_module, 'users/partials/add_mca',$params,false,false);
    }

    /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        $this->_user_permission->setActionPermission();
        $this->_user_permission->setUserPermission();
        $this->_user_permission->setModulePermission();
        $this->_user_permission->setControllerPermission();
        
        
        $this->_user_permission->saveMca();
    }

    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {

        $this->_->_setIdTableValue($id);
        $params['rs'] = $this->_->getRecord();
        \kerana\View::showView($this->_current_module, 'detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function edit($id)
    {
        $this->_->_setIdTableValue($id);
        $params['rs'] = $this->_->getRecord();
        \kerana\View::showForm($this->_current_module, 'detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_->_setIdTableValue($id);
        ($this->_->save()) ? \helpers\Redirect::to('/system/userAction/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        $this->_->_setIdTableValue($id);
        ($this->_->delete()) ? \helpers\Redirect::to('/system/userAction/index') : '';
    }

}

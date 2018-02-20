<?php

namespace application\modules\system\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class GroupController
  |-----------------------------------------------------------------------------
  |
  |
  | @author kerana,
  | @date 07-02-2018 05:41:20,
  |
 */

class GroupController extends \kerana\Kerana implements \kerana\KeranaInterface
{

    protected $_group;

    public function __construct()
    {
        parent::__construct();
        $this->_group = New \application\modules\system\model\GroupModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index()
    {

        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_group;
        \kerana\View::showView($this->_current_module, 'groups/index', ['rsGroups' => $this->_group->getAll()]);
    }

    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    public function add()
    {

        $params = [];
        \kerana\View::showForm($this->_current_module, 'groups/add', $params, $this->_group);
    }

    /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_group->save()) ? \helpers\Redirect::to('/system/group/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {

        $this->_group->_setIdTableValue($id);
        $params['rsGroup'] = $this->_group->getRecord();
        \kerana\View::showView($this->_current_module, 'groups/detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function edit($id)
    {
        $this->_group->_setIdTableValue($id);
        $params['rsGroup'] = $this->_group->getRecord();
        \kerana\View::showForm($this->_current_module, 'groups/edit', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_group->_setIdTableValue($id);
        ($this->_group->save()) ? \helpers\Redirect::to('/system/group/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        $this->_group->_setIdTableValue($id);
        ($this->_group->delete()) ? \helpers\Redirect::to('/system/group/index') : '';
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Get all groups in Json
     * -------------------------------------------------------------------------
     */
    public function getGroups(){
        echo json_encode($this->_group->getAll());
    }

}

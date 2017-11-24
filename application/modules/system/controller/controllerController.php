<?php

namespace application\modules\system\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | Class Controller controller
  |--------------------------------------------------------------------------
  |
  | Handle the creation of controllers for kerana
  |
 */

class ControllerController extends modelController implements \kerana\KeranaInterface
{

    protected
    /** @object, controller model */
            $_controllers;

    public function __construct()
    {
        parent::__construct();
        $this->_controllers = new \application\modules\system\model\ControllerModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show a list of all controllers
     * -------------------------------------------------------------------------
     */
    public function index()
    {
        \kerana\View::showView($this->_current_module, 'controllers/index', ['rsControllers' => $this->_controllers->getAllControllers()]);
    }

    /**
     * -------------------------------------------------------------------------
     * Add a new controller
     * -------------------------------------------------------------------------
     */
    public function add()
    {
        // select all modules available to associate a new controller
        $params['rsModules'] = $this->_module->getAll();
        $params['rsModels'] = $this->_model->getAll();
        \kerana\View::showForm($this->_current_module, 'controllers/add', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Save a new controller
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_controllers->createController()) ? \helpers\Redirect::to('/system/controller/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Show a controller detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {
        $this->_controllers->_setIdTableValue($id);
        $params['rsController'] = $this->_controllers->getController();
        \kerana\View::showView($this->_current_module, 'controllers/detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Edit a controller item
     * -------------------------------------------------------------------------
     * @param type $id
     */
    public function edit($id)
    {
        $this->_controllers->_setIdTableValue($id);
        $params['rsController'] = $this->_controllers->getController();
        \kerana\View::showView($this->_current_module, 'controllers/edit', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Update a controller
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_controllers->_setIdTableValue($id);
        ($this->_controllers->save()) ? \helpers\Redirect::to('/system/controller/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Delete a controller
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {

        $this->_controllers->_setIdTableValue($id);
        ($this->_controllers->delete()) ? \helpers\Redirect::to('/system/controller/index') : '';
    }
    

}

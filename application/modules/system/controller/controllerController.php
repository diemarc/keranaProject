<?php
/*
 * This file is part of keranaProject
 * Copyright (C) 2017-2018  diemarc  diemarc@protonmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
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

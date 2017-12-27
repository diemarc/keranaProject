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
  | ModuleControllerClass
  |--------------------------------------------------------------------------
  |
  | Handler the modules creations
 */

class ModuleController extends systemController implements \kerana\KeranaInterface
{

    protected
    /** @object , object model for modules */
            $_module;

    public function __construct()
    {
        parent::__construct();
        $this->_module = new \application\modules\system\model\ModuleModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Set the id_module
     * -------------------------------------------------------------------------
     * @param avoid
     */
    protected function _setIdModule($id = '')
    {
        if (!empty($id)) {
            $id_key = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        } else {
            $id_key = FILTER_INPUT(INPUT_POST, 'id_modulo', FILTER_SANITIZE_NUMBER_INT);
        }
        $this->_module->_setIdTableValue($id_key);
    }

    /**
     * -------------------------------------------------------------------------
     * Show all modules in a html view
     * -------------------------------------------------------------------------
     */
    public function index()
    {
        \kerana\View::showView($this->_current_module, 'modules/index', ['rsModules' => $this->_module->getAll()]);
    }

    /**
     * -------------------------------------------------------------------------
     * Show module detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {
        $this->_setIdModule($id);
        \kerana\View::showView($this->_current_module, 'modules/detail', [
            'rsModulo' => $this->_module->getRecord()
                ]
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Add a new module
     * -------------------------------------------------------------------------
     */
    public function add()
    {
        \kerana\View::showForm($this->_current_module, 'modules/add');
    }

    /**
     * -------------------------------------------------------------------------
     * Save a new module
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_module->create())?\helpers\Redirect::to('/system/module/index'):'';
    }

    /**
     * --------------------------------------------------------------------------
     * Edit a module
     * --------------------------------------------------------------------------
     * @param int $id ,
     */
    public function edit($id)
    {
        
    }

    /**
     * -------------------------------------------------------------------------
     * Update un modulo
     * --------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        
    }

    /**
     * -------------------------------------------------------------------------
     * Delete a module
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        try {
            $this->_setIdModule($id);
            if ($this->_module->delete() == false) {
                throw new \Exception('Failed to try to delete a module');
            }
        } catch (Exception $ex) {
            \kerana\Exceptions::showError('Failed to delete', $ex);
        }

        \helpers\Redirect::to('/system/module/index');
    }

}

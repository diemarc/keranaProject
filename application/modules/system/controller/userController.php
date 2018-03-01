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
  | ControllerClass for users
  |--------------------------------------------------------------------------
  |
 */

class UserController extends \kerana\Kerana implements \kerana\KeranaInterface
{

    protected $_user;

    public function __construct()
    {
        parent::__construct();
        $this->_user = New \application\modules\system\model\UserModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index()
    {
        \kerana\View::$model = $this->_user;
        \kerana\View::showView($this->_current_module, 'users/index', ['rsUsers' => $this->_user->getAll()]);
    }

    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    public function add()
    {

        $params = [];
        \kerana\View::showForm($this->_current_module, 'users/add', $params, $this->_user);
    }

    /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_user->saveUser()) ? \helpers\Redirect::to('/system/user/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {
        $this->_user->_setIdTableValue($id);
        $params['rsUser'] = $this->_user->getRecord();
        \kerana\View::showView($this->_current_module, 'users/detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function edit($id)
    {
        $this->_user->_setIdTableValue($id);
        $params['rs'] = $this->_user->getRecord();
        \kerana\View::showForm($this->_current_module, 'users/edit', $params, $this->_user);
    }

    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_user->_setIdTableValue($id);
        ($this->_user->save()) ? \helpers\Redirect::to('/system/user/index') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        $this->_user->_setIdTableValue($id);
        ($this->_user->delete()) ? \helpers\Redirect::to('/system/user/index') : '';
    }

}

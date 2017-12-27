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

/**
 * -----------------------------------------------------------------------------
 * ModelController
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class ModelController extends moduleController implements \kerana\KeranaInterface
{

    protected
    /** @object , model object of table models */
            $_model;

    public function __construct()
    {
        parent::__construct();
        $this->_model = new \application\modules\system\model\DataModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show all models
     * -------------------------------------------------------------------------
     */
    public function index()
    {
        $params['rsModelos'] = $this->_model->getAllModel();
        \kerana\View::showView($this->_current_module, 'models/index',$params);
    }

    /**
     * -------------------------------------------------------------------------
     * Load new model form
     * -------------------------------------------------------------------------
     */
    public function add()
    {
        $params = [
            'rsTables' => $this->_model->getTablesDB(),
            'rsModules' => $this->_module->getAll()
        ];
        
        \kerana\View::showForm($this->_current_module, 'models/add', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Save a model
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_model->createModel())?\helpers\Redirect::to('/system/model/index'):'';
    }

    /**
     * -------------------------------------------------------------------------
     * Show a model detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {

        $this->_model->_setIdTableValue($id);
        $params['rsModel'] = $this->_model->getRecord();
        \kerana\View::showView($this->_current_module, 'models/detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Show a edit form for a model
     * -------------------------------------------------------------------------
     * @param type $id
     */
    public function edit($id){
        
        $this->_model->_setIdTableValue($id);
        $params['rsModel'] = $this->_model->getRecord();
        \kerana\View::showView($this->_current_module, 'models/edit', $params);
        
    }
    /**
     * -------------------------------------------------------------------------
     * Update a model
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_model->_setIdTableValue($id);
        ($this->_model->save()) ? \helpers\Redirect::to('/system/model/index') : '';
        
    }
    /**
     * -------------------------------------------------------------------------
     * Delete a model
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        $this->_model->_setIdTableValue($id);
        ($this->_model->delete()) ? \helpers\Redirect::to('/system/model/index') : '';
        
    }
    

}

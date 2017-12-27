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

namespace application\modules\system\model;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este arhivo') : '';

/**
 * -----------------------------------------------------------------------------
 * Data Class, modelo que gestiona los modelos del sistema
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class DataModel extends \kerana\Ada
{

    private
    /** @var int, module id */
            $module_id,
            /** @var string, module name */
            $module_name,
            /** @var string, model name */
            $model_name,
            /** @var string, model path */
            $model_path,
            /** @var mixed, the database table to handled the new model */
            $model_table,
            
            /** @var mixed, description model, used to put into a comment */
            $model_description;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_model';
        $this->table_id = 'id_model';
    }

    /**
     * -------------------------------------------------------------------------
     * Model master query
     * -------------------------------------------------------------------------
     */
    private function _setQueryModel()
    {

        $this->_query = ' SELECT A.id_model,A.id_module,A.model,A.table_reference, '
                . ' A.model_description,B.module '
                . ' FROM ' . $this->table_name . ' A '
                . ' INNER JOIN sys_module B ON (A.id_module = B.id_module)'
                . ' WHERE A.id_model IS NOT NULL';
    }

    /**
     * -------------------------------------------------------------------------
     * Fetch all model from master query model
     * -------------------------------------------------------------------------
     * @return rs
     */
    public function getAllModel()
    {
        $this->_setQueryModel();
        return $this->getQuery();
    }

    /*
      |--------------------------------------------------------------------------
      | MODELS CREATION METHODS
      |--------------------------------------------------------------------------
      |
     */

    
    /**
     * -------------------------------------------------------------------------
     * Setup some atributes  
     * -------------------------------------------------------------------------
     */
    private function _setupNewModel()
    {
        $this->module_id = filter_input(INPUT_POST, 'f_id_module', FILTER_VALIDATE_INT);
        $this->model_name = ucwords(filter_input(INPUT_POST, 'f_model', FILTER_SANITIZE_SPECIAL_CHARS));
        $this->model_table = filter_input(INPUT_POST, 'f_table_reference', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->model_description = filter_input(INPUT_POST, 'f_model_description', FILTER_SANITIZE_SPECIAL_CHARS);

        // setup the model path
        $this->_setPathModel();
    }

    /**
     * --------------------------------------------------------------------------
     * Set the model path
     * ------------------------------------------------------------------------- 
     * @param type $path
     */
    private function _setPathModel()
    {
        // get the id_module data
        $module = new ModuleModel();
        $module->_setIdTableValue($this->module_id);
        $module_data = $module->getRecord();
        $this->module_name = $module_data->module;

        $this->model_path = __MODULEFOLDER__ . '/' . $this->module_name . '/model/';

    }

    /**
     * -------------------------------------------------------------------------
     * Insert a model record into database, and create model file
     * -------------------------------------------------------------------------
     */
    public function createModel()
    {
        // first set the model attributes
        $this->_setupNewModel();
        
        //create a model record
        $data_model = [
            'id_module' => $this->module_id,
            'model' => $this->model_name.'Model',
            'table_reference' =>  $this->model_table,
            'model_description' => $this->model_description,
            'time_creation' => time()
        ];
        
        if($this->insert($data_model)){
            return $this->_createModelClass();
        }
        
    }
    
    
     /**
     * -------------------------------------------------------------------------
     * Make the model class file
     * -------------------------------------------------------------------------
     */
    protected function _createModelClass()
    {

        try {
            fopen($this->model_path . $this->model_name . 'Model.php', 'w');
            $this->_makeCodeModelClass();
        } catch (Exception $ex) {
            $descripcion = 'Model file cant be created, resolve this, and go back!! MDF ' . $ex;
            \kerana\Exceptions::showError('Creator', $descripcion);
        }
    }

    
    /**
     * -------------------------------------------------------------------------
     * Create the code for a model class, using a template and replace
     * the code inside.
     * -------------------------------------------------------------------------
     */
    private function _makeCodeModelClass(){
        
       // load the creator-template to a model class 
       $path_tpl = realpath(__DOCUMENTROOT__.'/../templates/creator/tpl_model.ker');
       
       // path to the new model created
       $path_tpl_1 = realpath($this->model_path . $this->model_name . 'Model.php');
       $file_contents = file_get_contents($path_tpl);
       
       // replacement parse file
       $code_replace = [
           '[{model_name}]' => $this->model_name.'Model',
           '[{module_name}]' => $this->module_name,
           '[{model_description}]' => $this->model_description,
           '[{model_date}]' => date('d-m-Y H:i:s'),
           '[{model_table}]' => $this->model_table,
           '[{model_table_id}]' => $this->getPrimaryKeyTable($this->model_table),
           
       ];
       $file_new_contents = strtr($file_contents,$code_replace);
       // put the replacement into a model class
       file_put_contents($path_tpl_1, $file_new_contents);
        
        
    }
    
}

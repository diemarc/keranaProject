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
            $_module_id,
            /** @var string, module name */
            $_module_name,
            /** @var string, model name */
            $_model_name,
            /** @var string, model path */
            $_model_path,
            /** @var mixed, the database table to handled the new model */
            $_model_table,
            /**  @var boolean, need controller for the new model? */
            $_need_controller,
            /** @var mixed, description model, used to put into a comment */
            $_model_description,
            /** @var array, contains attributes matched with the field of the table */
            $_model_attributes;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_models';
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
        $this->_module_id = filter_input(INPUT_POST, 'f_id_module', FILTER_VALIDATE_INT);
        $this->_model_name = ucwords(filter_input(INPUT_POST, 'f_model', FILTER_SANITIZE_SPECIAL_CHARS));
        $this->_model_table = filter_input(INPUT_POST, 'f_table_reference', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->_model_description = filter_input(INPUT_POST, 'f_model_description', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->_need_controller = filter_input(INPUT_POST, 'f_sw_controller', FILTER_VALIDATE_INT);

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
        $module->_setIdTableValue($this->_module_id);
        $module_data = $module->getRecord();
        $this->_module_name = $module_data->module;

        $this->_model_path = __MODULEFOLDER__ . '/' . $this->_module_name . '/model/';
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
            'id_module' => $this->_module_id,
            'model' => $this->_model_name . 'Model',
            'table_reference' => $this->_model_table,
            'model_description' => $this->_model_description,
            'time_creation' => time()
        ];

        if ($this->insert($data_model)) {
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
            fopen($this->_model_path . $this->_model_name . 'Model.php', 'w');
            return $this->_makeCodeModelClass();
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
    private function _makeCodeModelClass()
    {

        // load the creator-template to a model class 
        $path_tpl = realpath(__DOCUMENTROOT__ . '/../templates/creator/tpl_model.ker');

        // path to the new model created
        $path_model_file = realpath($this->_model_path . $this->_model_name . 'Model.php');
        $file_contents = file_get_contents($path_tpl);

        $this->_parseFieldsTableToAttributes();
        
        // replacement parse file
        $code_replace = [
            '[{model_name}]' => $this->_model_name . 'Model',
            '[{module_name}]' => $this->_module_name,
            '[{model_description}]' => $this->_model_description,
            '[{model_date}]' => date('d-m-Y H:i:s'),
            '[{model_table}]' => $this->_model_table,
            '[{properties}]' => $this->_model_attributes,
            '[{model_table_id}]' => $this->getPrimaryKeyTable($this->_model_table),
        ];
        $file_new_contents = strtr($file_contents, $code_replace);

        // put the replacement into a model class
        file_put_contents($path_model_file, $file_new_contents);

        // need create a controller for this model?
        ($this->_need_controller) ? $this->_createControllerModel() : '';

        return true;
    }

    /**
     * -------------------------------------------------------------------------
     * COnvert each field from the table in object properties
     * -------------------------------------------------------------------------
     */
    private function _parseFieldsTableToAttributes()
    {

        $rsInfoTable = $this->descTable($this->_model_table);
        foreach ($rsInfoTable AS $info_table):
            $ex = preg_split("/[\()s]+/", $info_table->Type);
            $field_type = $ex[0];
            $field_lenght = $ex[1];
            if($this->_model_attributes !=''){
                $this->_model_attributes .= ", \n";
            }else{
                $this->_model_attributes .= "";
            }
            $this->_model_attributes .= "/** @var $field_type($field_lenght), $info_table->Field  */ \n".'$'.$info_table->Field;
            


        endforeach;
    }

    /**
     * -------------------------------------------------------------------------
     * Create a new controller for handle this model, only if _need_controller
     * is true
     * -------------------------------------------------------------------------
     */
    private function _createControllerModel()
    {


        $model_controller = new \application\modules\system\model\ControllerModel();
        $model_module = new \application\modules\system\model\ModuleModel();

        // lets set the controller params
        $model_controller->controller_description = 'Controller created automatically '
                . ' from model';
        $model_controller->controller_model_id = $this->_id_value;
        $model_controller->controller_name = $this->_model_name;
        $model_controller->controller_module = $model_module->find('module', ['id_module' => $this->_module_id], 'one')->module;
        $model_controller->controller_path = __MODULEFOLDER__ . '/' . $model_controller->controller_module . '/controller/';

        //create a new controller for this model
        $model_controller->createController();
    }

}

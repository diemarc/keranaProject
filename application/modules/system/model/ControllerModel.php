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

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | Class ControllerModel
  |--------------------------------------------------------------------------
  |
  | Make the controller file, with auto code, compatible with kerana interface
  |
 */

class ControllerModel extends \kerana\Ada
{

    private

    /** @var mixed, module name */
            $controller_module,
            /** @var mixed, controller name */
            $controller_name,
            /** @var int, controller model */
            $controller_model_id,
            /** @var mixed, controller description */
            $controller_description,
            /** @var mixed, controller path */
            $controller_path;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_controller';
        $this->table_id = 'id_controller';
    }

    /**
     * -------------------------------------------------------------------------
     * Master query for controllers
     * -------------------------------------------------------------------------
     */
    private function _setQueryController()
    {
        $this->_query = ' SELECT A.id_controller,A.controller,A.controller_module,'
                . ' A.controller_description '
                . ' FROM ' . $this->table_name . ' A '
                . ' WHERE A.id_controller IS NOT NULL';
    }

    /**
     * -------------------------------------------------------------------------
     * Get all controllers
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getAllControllers()
    {
        $this->_setQueryController();
        $this->_query .= ' ORDER BY A.id_controller DESC ';
        return $this->getQuery();
    }

    /**
     * -------------------------------------------------------------------------
     * Get one controller
     * -------------------------------------------------------------------------
     */
    public function getController()
    {

        $this->_setQueryController();
        $this->_query .= ' AND A.id_controller = :id_controller '
                . ' LIMIT 1';
        $this->_binds[':id_controller'] = $this->_id_value;

        return $this->getQuery('one');
    }

    /**
     * -------------------------------------------------------------------------
     * Setup the attr for a new controller
     * -------------------------------------------------------------------------
     */
    private function _setupNewController()
    {

        $this->controller_module = filter_input(INPUT_POST, 'sw_module', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->controller_model_id = filter_input(INPUT_POST, 'sw_id_model', FILTER_VALIDATE_INT);
        $this->controller_name = filter_input(INPUT_POST, 'f_controller', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->controller_description = filter_input(INPUT_POST, 'f_controller_description', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->controller_path = __MODULEFOLDER__ . '/' . filter_input(INPUT_POST, 'sw_module', FILTER_SANITIZE_SPECIAL_CHARS) . '/controller/';
    }

    /**
     * -------------------------------------------------------------------------
     * Crete a controller
     * Insert a record into the database and make the file controller
     * -------------------------------------------------------------------------
     * @return type
     */
    public function createController()
    {
        $this->_setupNewController();

        $controller_attr = [
            'controller' => $this->controller_name,
            'controller_description' => 'Creator controller',
            'controller_module' => $this->controller_module,
            'time_creation' => time()
        ];

        if ($this->insert($controller_attr)) {
            return $this->_createControllerFile();
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Make the controller file
     * -------------------------------------------------------------------------
     */
    protected function _createControllerFile()
    {
        try {
            fopen($this->controller_path . $this->controller_name . 'Controller.php', 'w');
            $this->_makeCodeControllerClass();
        } catch (Exception $ex) {
            $descripcion = 'Imposible to find the controller file to write ' . $ex;
            \kerana\Exceptions::showError('Creator', $descripcion);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Create the code for a controller class, using a template and replace
     * the code inside.
     * -------------------------------------------------------------------------
     */
    private function _makeCodeControllerClass()
    {

        // load the creator-template to a controller class 
        $path_tpl = realpath(__DOCUMENTROOT__ . '/../templates/creator/tpl_controller.ker');

        // path to the new controller created
        $path_controller = realpath($this->controller_path . $this->controller_name . 'Controller.php');
        $file_contents = file_get_contents($path_tpl);

        // lets check if model object is necessary
        if ($this->controller_model_id > 0) {

            // create a model object to fetch model data
            $model_for_controller = new DataModel();
            $model_for_controller->_setIdTableValue($this->controller_model_id);
            $rsModel = $model_for_controller->getRecord();
            $model_name = $rsModel->model;
            $model_attribute_name = strtolower(substr($model_name, 0, -5));
            $model_resultset = ucwords($model_attribute_name);
            $model_object_to_create = ' $this->_' . $model_attribute_name . '= New \\application\\modules\\' .
                    $this->controller_module . '\\model\\' . $model_name . '();';
        }

        // replacement parse file
        $code_replace = [
            '[{controller_name}]' => ucwords($this->controller_name) . 'Controller',
            '[{controller}]' => $this->controller_name,
            '[{module_name}]' => $this->controller_module,
            '[{controller_description}]' => $this->controller_description,
            '[{controller_date}]' => date('d-m-Y H:i:s'),
            '[{controller_implements}]' => ($this->controller_model_id > 0) ? 'implements \\kerana\\KeranaInterface' : '',
            '[{controller_model}]' => ($this->controller_model_id > 0) ? 'protected $_' . $model_attribute_name . ';' : '',
            '[{model_object}]' => ($this->controller_model_id > 0) ? $model_object_to_create : '',
            '[{model_name}]'=> '$this->_'.$model_attribute_name, 
            '[{model_rs}]' => ($this->controller_model_id > 0) ? $model_resultset : '',
        ];
        $file_new_contents = strtr($file_contents, $code_replace);
        // put the replacement into a model class
        file_put_contents($path_controller, $file_new_contents);
    }

}

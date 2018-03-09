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
  |-----------------------------------------------------------------------------
  | Module Model class
  |-----------------------------------------------------------------------------
  |
 */

class ModuleModel extends \Kerana\Ada
{

    private
    /** @var mixed, new module name */
            $_module_name,
            /** @var mixed, path where module will be create */
            $_module_path,
            /** @array, reserved modules */
            $_arr_reserved_modules = ['system', 'welcome', 'web'];

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_modules';
        $this->table_id = 'id_module';
        
        
    }

    /**
     * -------------------------------------------------------------------------
     * Check if application is writeable
     * -------------------------------------------------------------------------
     * @return type
     */
    private function _checkApplicationFolderPermission(){
        return (!is_writable(dirname($this->_module_path))) ? \kerana\Exceptions::showError('PermissionError',''
                . 'The application folder is not writeable, fix it!!.<br>'
                . '<br><strong>Posibles solutions</strong>'
                . '<ul>'
                . ' <li>[localhost_only]Change the apache user-group(/etc/apache2/ennvars) '
                . 'matching the apache-user with you user-machine</li>'
                . '<li>'
                . '[any_scenario]Search in https://duckduckgo.com'
                . '</li>'
                . '</ul>') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Set the path and module name
     * -------------------------------------------------------------------------
     */
    private function _setPathAndModuleName()
    {
        $this->_module_name = strtolower(\helpers\Request::varchar('f_module'));
        $this->_module_path = __MODULEFOLDER__ . '/' . $this->_module_name;
        
        // check permission
        $this->_checkApplicationFolderPermission();
    }

    /**
     * -------------------------------------------------------------------------
     * Create a new module
     * -------------------------------------------------------------------------
     */
    public function create()
    {

        $this->_setPathAndModuleName();

        // first at all, check if the new module name, is a reserved module
        if (!in_array($this->_module_name, $this->_arr_reserved_modules)) {

            // will check if not existe another module with the same name
            $rsFindModulo = $this->find('module', ['module' => $this->_module_name]
                    , 'one');

            // if dont exists, then create a new module
            if (!$rsFindModulo) {

                // insert to a database table
                $this->insert();

                // create a fodler module
                $this->_createModuleFolder();

                return true;
            } else {
                \kerana\Exceptions::showError('Creator', 'Module already exists');
            }
        } else {
            \kerana\Exceptions::showError('Creator', 'Module is reserved by kerana.');
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Make the module structura folder
     * -------------------------------------------------------------------------
     */
    protected function _createModuleFolder()
    {

        try {

            // first create a module folder in application/module path
            mkdir($this->_module_path, 0777, true); 
                // controllers folder
                mkdir($this->_module_path . '/controller', 0777, true);
                // models folder
                mkdir($this->_module_path . '/model', 0777, true);
                // table-models folder
                mkdir($this->_module_path . '/model/tables', 0777, true);
                // view folder
                mkdir($this->_module_path . '/view', 0777, true);
            
        } catch (\Exception $ex) {
            \kerana\Exceptions::ShowException('CreateModuleDirectory', $ex);
        }
    }

}

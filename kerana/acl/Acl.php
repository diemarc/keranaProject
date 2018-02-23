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

namespace Kerana\acl;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | ACL Helper
  |--------------------------------------------------------------------------
  |
  | Check if user was granted to execute some module/controller/action
  |
 */

class Acl
{

    private

    /** @object, model acl user-module-controller-action, 
     * referenced by table  sys_acl_user_action */
            $_model_acl_user;

    /**
     * -------------------------------------------------------------------------
     * Acl Construct
     * -------------------------------------------------------------------------
     * @param string $module
     * @param string $controller
     * @param string $action
     */
    public function __construct($module, $controller, $action)
    {
        $this->_model_acl_user = New \kerana\acl\UserPermissionModel();
        $this->_model_acl_user->module_name = \helpers\Validator::varchar($module);
        $this->_model_acl_user->controller_name = \helpers\Validator::varchar($controller);
        $this->_model_acl_user->action_name = \helpers\Validator::varchar($action);
        $this->_model_acl_user->id_user = \helpers\Validator::int($_SESSION['id_user']);
        $this->_checkUserPetition();
    }

    /**
     * -------------------------------------------------------------------------
     * check if user id is granted to acces to he module requested
     * -------------------------------------------------------------------------
     * @param type $module_name
     */
    private function _checkUserPetition()
    {
        $obj_user_module = $this->_model_acl_user->getMcaPetitionForUser();
        (!is_object($obj_user_module)) ? \kerana\Exceptions::showError('AccessControlList', 
                'You <strong>(' . $this->_model_acl_user->id_user . ')</strong>'
                                . ' dont have privileges to run this ') : '';
    }

}

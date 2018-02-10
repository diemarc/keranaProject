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
            /** @object, model acl, referenc from sys_acl_user_action */
            $_model_acl_action,
            /** @object, model acl user-module, referenc from sys_acl_user_module */
            $_model_acl_module;
            

    public function __construct()
    {
        $this->_model_acl_action = load::Model('sistema', 'permiso_usuario');
        Auth::checkAuthentication();
    }

    /**
     * -------------------------------------------------------------------------
     * Verifica si el usuario puede ejecutar el controlador que desea ejecutar
     * -------------------------------------------------------------------------
     * @param type $controller
     */
    public function checkUserRequestControllerAccess($controller)
    {
        if(!$this->_model_acl->selectUserPermissionRequest(Session::get('user_id'),$controller)){
            $descripcion = Session::get('user_name').
                    " , <strong>NO</strong> tienes permiso suficiente para ejecutar esta petici&oacute;n.";
            Exceptions::showError('Error de permiso de controlador', $descripcion);
        }
    }

}

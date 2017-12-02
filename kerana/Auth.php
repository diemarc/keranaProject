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

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";

/*
  |--------------------------------------------------------------------------
  | AUTH CLASS
  |--------------------------------------------------------------------------
  |
  | Controla las autentificaciones del usuario
  |
 */

class Auth
{

    public $ka_session;

    /**
     * -------------------------------------------------------------------------
     * Comprueba que el usuario este logado
     * -------------------------------------------------------------------------
     */
    public static function checkAuthentication()
    {
        // iniciliazamos las sesiones
        $ka_session = New \kerana\SessionHandler();
        $ka_session->startSession();
        
        // cargamos el modelo de login
        $login = New \application\modules\system\model\LoginModel();

        // comprobamos si existe un login valido
        if ($login->checkAccessUser() == false) {
            
            $ka_session->cleanSession();
            \helpers\Redirect::to('/welcome/login/introduceMySelf');
            exit();
        }
    }
    
    
    
    

}

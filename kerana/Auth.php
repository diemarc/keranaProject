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

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | AUTH CLASS
  |--------------------------------------------------------------------------
  |
  | Handler the user-login stuff
  |
 */

class Auth
{

    /** @object , session handler */
    public $ka_session;

    /**
     * -------------------------------------------------------------------------
     * Check if user is logged
     * -------------------------------------------------------------------------
     */
    public static function checkAuthentication()
    {
        // start a new session
        $ka_session = New \kerana\SessionHandler();
        $ka_session->startSession();
        
        /** @object, login model */
        $login = New \application\modules\system\model\LoginModel();

        // if login is false, redirect to the login page
        if ($login->checkAccessUser() == false) {
            $ka_session->cleanSession();
            \helpers\Redirect::to('/welcome/login/introduceMySelf');
            exit();
        }else{
            return true;
        }
    }
    
    
    
    

}

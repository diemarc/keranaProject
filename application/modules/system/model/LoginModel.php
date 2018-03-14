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
  | Class LoginModel
  |-----------------------------------------------------------------------------
  | do the login stuff
 */

class LoginModel extends \application\modules\system\model\UserModel
{

    public
    /** @object , user */
            $user,
            /** @object, bad login, handler for login errors */
            $bl;

    public function __construct()
    {
        parent::__construct();
        $this->bl = New \application\modules\system\model\BadLoginModel;
    }

    /**
     * -------------------------------------------------------------------------
     * Start the login system,
     * -------------------------------------------------------------------------
     * Set the username and password
     * Create a user_object if the user exists
     * -------------------------------------------------------------------------
     */
    private function _init()
    {

        try {
            $this->username = filter_input(INPUT_POST, 'f_username', FILTER_SANITIZE_SPECIAL_CHARS);
            $this->password = filter_input(INPUT_POST, 'f_password', FILTER_SANITIZE_SPECIAL_CHARS);

            if ((empty($this->username)) OR ( empty($this->password))) {
                throw new \Exception('Username & password is empty, fix it!!!!');
            }
            // veerificamos si existe un user activo con username y creamos
            // un objeto con el resultado.
            $this->user = $this->_checkAndGetUserActive();
        } catch (\Exception $ex) {
            \kerana\Exceptions::showError('LoginError', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Proccess the login
     * -------------------------------------------------------------------------
     */
    public function doLogin()
    {

        $this->_init();
        // if user object not exists
        if ($this->user == false) {

            // register a badLogin 
            $this->bl->registerBadLogin('User not exists ' . $this->username);
            \kerana\Exceptions::showError('LoginError', 'Username & password is empty');
        } else {

            // check login attempts in badLogins
            $this->bl->checkBadLogin($this->user->id_user);

            // check the password sent from the form
            $password_received = password_hash($this->password, PASSWORD_BCRYPT, ['salt' => $this->user->salt]);
            if ($password_received === $this->user->password) {

                // if passwords matchs, create a session secure
                $this->_createSessionSucces();
            } else {
                $string = 'Wrong Password for ' . $this->username . ' [' . $this->password . ']';
                $this->bl->registerBadLogin($string, $this->user->id_user);
                \kerana\Exceptions::showError('LoginError', 'Username & password not match');
            }
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Create a secure session
     * -------------------------------------------------------------------------
     */
    private function _createSessionSucces()
    {

        try {
            // get the ip, and the user_agent(browser)
            $user_browser = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
            $user_name = preg_replace('/[^a-zA-Z0-9_\-]+/', '', $this->username);
            $user_id = preg_replace('/[^0-9]/', '', $this->user->id_user);

            // start a secure session
            $ka_session = New \kerana\SessionHandler();
            $ka_session->startSession();


            // create a session data
            $_SESSION['id_user'] = $user_id;
            $_SESSION['username'] = $user_name;

            // to prevent session-hijack, create a hash from concat(user_agent, user_password_salt)
            // and store in session_data "login_string"
            // this will check in a restore session method
            $_SESSION['login_string'] = hash('sha512', $user_browser . $this->user->salt);

            // register the access
            $access = new \application\modules\system\model\AccessLogin();
            $access->registerAccessUser($user_id);
            
            // redirect user to a landing page
            $this->_landUserLogin();
            
        } catch (Exception $ex) {
            \kerana\Exceptions::showError('SessionLoginError', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Redirect user logged, to his group landing page
     * -------------------------------------------------------------------------
     */
    private function _landUserLogin()
    {

        // user-group model
        $objUserGroup = new \application\modules\system\model\UserGrupModel();
        $objUserGroup->set_id_user($_SESSION['id_user']);
        $infoLanding = $objUserGroup->getPrincipalGroupForUser();

        if (!$infoLanding) {
            \kerana\Exceptions::showError('LoginIncomplete::', 'You dont have a valid landing page');
        } else {
            // start a secure session
            $ka_session = New \kerana\SessionHandler();
            $ka_session->startSession();
            $_SESSION['layout'] = $infoLanding->layout;
            \helpers\Redirect::to($infoLanding->landing_mca);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Check if user is logged in
     * -------------------------------------------------------------------------
     */
    public function checkAccessUser()
    {

        try {

            // first check if session user is setted
            if (isset($_SESSION['id_user'], $_SESSION['username'], $_SESSION['login_string'])) {
                $user_id = $_SESSION['id_user'];

                // contains the concat(user_agent + user_password_salt)
                $login_string = $_SESSION['login_string'];

                // get the current user agent(browser)
                $user_agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);

                // check if the id_user stored in the session_data, match with
                // the user stored in table
                $this->_setIdTableValue($user_id);

                // if user exists
                if ($this->user = $this->getRecord(false)) {

                    // create a new concat(user_agent+ user_password_salt, with data obtaind from the 
                    // database query)
                    $login_check = hash('sha512', $user_agent . $this->user->salt);

                    // check if login_string stored in session_data match with $login_check
                    return ($login_check == $login_string) ? true : false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $ex) {
            \kerana\Exceptions::showError('RestoreSession', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Close session
     * -------------------------------------------------------------------------
     */
    public function closeSession()
    {
        $ka_session = New \kerana\SessionHandler();
        $ka_session->startSession();
        $ka_session->cleanSession();
    }

}

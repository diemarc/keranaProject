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
     * Start the login system,ç
     * -------------------------------------------------------------------------
     * Setea los nombres de usuario y contraseña recibidas por el form
     * y si existe usuario crea un objeto user
     * -------------------------------------------------------------------------
     */
    private function _init()
    {

        try {
            $this->username = filter_input(INPUT_POST, 'f_username', FILTER_SANITIZE_SPECIAL_CHARS);
            $this->password = filter_input(INPUT_POST, 'f_password', FILTER_SANITIZE_SPECIAL_CHARS);

            if ((empty($this->username)) OR ( empty($this->password))) {
                throw new \Exception('No se ha recibido Usuario y password');
            }
            // veerificamos si existe un usuario activo con username y creamos
            // un objeto con el resultado.
            $this->user = $this->_checkAndGetUserActive();
        } catch (\Exception $ex) {
            \kerana\Exceptions::showError('Error de login', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Procesa el login
     * -------------------------------------------------------------------------
     */
    public function doLogin()
    {

        $this->_init();

        // si el usuario no existe
        if ($this->user == false) {

            // registramos un bl(badLogin) con la ip ya que no tenemos el id_usuario
            $this->bl->registerBadLogin('Usuario no existe ' . $this->username);
            \kerana\Exceptions::showError('Error de login', 'Usuario/password incorrecto');
        } else {

            // comprobacion de intentos de inicio de sesion en bl
            $this->bl->checkBadLogin($this->user->id_usuario);

            // comprobamos si coincide la constraseña enviada por form y la
            // guardada en tabla
            $password_received = password_hash($this->password, PASSWORD_BCRYPT, ['salt' => $this->user->salt]);
            if ($password_received === $this->user->password) {

                // creamos la sesion
                $this->_createSessionSucces();
            } else {
                $string = 'El password de ' . $this->username . ' es incorrecto ';
                $this->bl->registerBadLogin($string, $this->user->id_usuario);
                \kerana\Exceptions::showError('Error de login', 'Usuario/password incorrecto');
            }
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Crea una sesion de login
     * -------------------------------------------------------------------------
     */
    private function _createSessionSucces()
    {

        try {
            // obtenemos la ip y el agente del usuario
            $user_browser = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
            $user_name = preg_replace('/[^a-zA-Z0-9_\-]+/', '', $this->username);
            $user_id = preg_replace('/[^0-9]/', '', $this->user->id_usuario);

            // iniciamos la sesion segura
            $ka_session = New \kerana\SessionHandler();
            $ka_session->startSession();


            // creamos la sesion
            $_SESSION['id_usuario'] = $user_id;
            $_SESSION['username'] = $user_name;
            // creamos un string con hash para establecer el login
            // estoy hay que comprobar en cada restore session, esto evita
            // session_hijack
            $_SESSION['login_string'] = hash('sha512', $user_browser . $this->user->salt);

            //registramos el acceso
            $access = new \application\modules\system\model\AccessLogin();
            $access->registerAccessUser($user_id);

            // redirigimos
            \helpers\Redirect::to('/system/module/index');
        } catch (Exception $ex) {
            \kerana\Exceptions::showError('Error al crear una sesion de acceso', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Comprueba si existe sesion d elogin
     * -------------------------------------------------------------------------
     */
    public function checkAccessUser()
    {


        try {

            // primero comprobamos que las variables de sesion estan seteados
            if (isset($_SESSION['id_usuario'], $_SESSION['username'], $_SESSION['login_string'])) {
                $user_id = $_SESSION['id_usuario'];
                $login_string = $_SESSION['login_string'];

                // obtenemos los valores a comprobar (Agent)
                $user_agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);

                //comprobamos que exista el usuario de la session
                $this->_setIdTableValue($user_id);
                if ($this->user = $this->getRecord(false)) {

                    // creamos un hash con los datos obtenidos de la sesion que se
                    // desea restaurar  + el user_agent + sal user
                    $login_check = hash('sha512', $user_agent . $this->user->salt);

                    return ($login_check == $login_string) ? true : false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $ex) {
            \kerana\Exceptions::showError('Error al restore session', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Cierra una sesion
     * -------------------------------------------------------------------------
     */
    public function closeSession()
    {
        // iniciamos la sesion segura
        $ka_session = New \kerana\SessionHandler();
        $ka_session->startSession();
        $ka_session->cleanSession();
    }

}

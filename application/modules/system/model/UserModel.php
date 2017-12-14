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

use helpers\Request AS Request;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | ModelClass for users
  |--------------------------------------------------------------------------
  |
 */

class UserModel extends \kerana\Ada
{

    public
    /** @var int, id_user */
            $id_user,
            /** @var mixed , username */
            $username,
            /** @var mixed , user password */
            $password,
            /** @var mixed, email */
            $email,
            /** @var name, email */
            $name,
            /** @var lastname, email */
            $lastname;
    private
    /** @var password salt */
            $_salt;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_usuario';
        $this->table_id = 'id_usuario';
    }

    /**
     * -------------------------------------------------------------------------
     * Get user active data
     * -------------------------------------------------------------------------
     */
    public function _checkAndGetUserActive()
    {
        return $this->find('id_usuario,nombres,apellidos,email,salt,password', [
                    'username' => $this->username,
                    'sw_activo' => 1
        ]);
    }

    /**
     * -------------------------------------------------------------------------
     * Check all user fileds 
     * -------------------------------------------------------------------------
     */
    private function _initUser()
    {
        $this->username = Request::varchar('f_username',true);
        $this->password = Request::varchar('f_password');
        $this->name = Request::varchar('f_nombres', true);
        $this->email = Request::email();
    }

    /**
     * -------------------------------------------------------------------------
     * Save a new user
     * -------------------------------------------------------------------------
     */
    public function saveUser()
    {
        $this->_initUser();

        $this->generateSecurePassword();

        return $this->save(
                        [
                            'username' => $this->username,
                            'password' => $this->password,
                            'salt' => $this->_salt,
                            'email' => $this->email,
                            'nombres' => $this->name,
                            'apellidos' => $this->lastname,
                            'sw_activo' => 1
                        ],true
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Generate password salt and store into a table
     * -------------------------------------------------------------------------
     * @return type
     */
    public function generateSecurePassword()
    {

        try {
            // lets do generate the random salt, 
            // replace byte por byte for utf8 support
            $this->_salt = strtr(base64_encode(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)), '+', '.');

            // generate the password with the salt
            $this->password = password_hash($this->password, PASSWORD_BCRYPT, ['salt' => $this->_salt]);
        } catch (\Exception $ex) {
            \kerana\Exceptions::showError('LOGIN ERROR', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Set inactive one user
     * -------------------------------------------------------------------------
     * @param int $id_usuario
     * @return boolean
     */
    public function blockUserAccount($id_usuario)
    {
        $this->_setIdTableValue($id_usuario);
        return $this->update(
                        [
                            'sw_activo' => 0
                        ]
        );
    }

}

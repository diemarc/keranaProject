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
  | ModelClass for users
  |--------------------------------------------------------------------------
  |
 */

class UserModel extends \kerana\Ada
{

    public
    /** @var mixed , username */
            $username,
            /** @var mixed , user password */
            $password,
            /** @var mixed, email */
            $email,
            /** @var password salt */
            $salt;

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
     * Generate password salt and store into a table
     * -------------------------------------------------------------------------
     * @return type
     */
    public function generatePasswordUser()
    {

        try {
            // lets do generate the random salt, 
            // replace byte por byte for utf8 support
            $salt_created = strtr(base64_encode(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)), '+', '.');

            // generate the password with the salt
            $password = password_hash($this->password, PASSWORD_BCRYPT, ['salt' => $salt_created]);

            // update the user data
            return $this->save(
                            [
                                'password' => $password,
                                'salt' => $salt_created
                            ]
            );
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

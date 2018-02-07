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
  | Handle the AccessLogin of Kerana
  |--------------------------------------------------------------------------
  |
 */

class AccessLogin extends \Kerana\Ada
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_access_log';
        $this->table_id = 'id_access_log';
    }

    /**
     * -------------------------------------------------------------------------
     * Save a new loginLogAccess
     * -------------------------------------------------------------------------
     * @param int $id_user
     */
    public function registerAccessUser($id_user)
    {

        $this->_query = ' INSERT INTO ' . $this->table_name . ' '
                . ' (id_user,remote_address_access,time_access)'
                . ' VALUES'
                . ' (:id_user,INET_ATON(:ip),:time) ';

        $this->_binds = [
            ':id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT),
            ':ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            ':time' => time()
        ];

        return $this->runQuery();
    }

}

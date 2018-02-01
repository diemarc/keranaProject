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

/**
 * -----------------------------------------------------------------------------
 * class badLoginModel, badLogins hanlders
 * -----------------------------------------------------------------------------
 * @author diemarc
 */

class BadLoginModel extends \Kerana\Ada
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_bad_login';
        $this->table_id = 'id_bad_login';
    }

    
    /**
     * -------------------------------------------------------------------------
     * If the user has 4 failed attempts, block the user account
     * -------------------------------------------------------------------------
     * @param int $id_user
     */
    public function checkBadLogin($id_user){
        
        // get the user badLogins
        $rsBadLoginsUser = $this->getBadLoginForUser($id_user);
        $n_bl = count($rsBadLoginsUser);
        
        // had 4 or more failed attemps?
        if($n_bl > 4){
            
            /** @object , userModel Object */
            $objUser = new \application\modules\system\model\UserModel();
            
            // block the user account
            $objUser->blockUserAccount($id_user);
            
            \kerana\Exceptions::showError('LoginError', 
                    'To many failed attempts in login (>4)');
            
        }
   
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Get the badLogin list for a user
     * -------------------------------------------------------------------------
     * @param int $id_user
     * @return rs
     */
    public function getBadLoginForUser($id_user)
    {

        return $this->find('time', [
                    'id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT)
                        ],'all'
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Register a new badLogin
     * -------------------------------------------------------------------------
     * @param string $string , error description
     * @param int $id_user
     * @return boolean
     */
    public function registerBadLogin($string, $id_user = 0)
    {
        
        $this->_query = ' INSERT INTO ' . $this->table_name
                . '(id_user,remote_address,time,string_attempt)'
                . ' VALUES '
                . ' (:id_user,INET_ATON(:ip),:time,:string_attemp)';

        // seteamos los bins
        $this->_binds = [
            ':id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT),
            ':ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            ':time' => time(),
            ':string_attemp' => filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        return $this->runQuery();
    }

}

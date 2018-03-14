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
 * UserGrupModel
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class UserGrupModel extends \kerana\Ada
{
    
    public 
            /** @var int, user id */
            $id_user;


    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_user_group';
        $this->table_id = 'id_user';
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Get the landing page for user , bases on his principal group 
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getPrincipalGroupForUser(){
        
        $this->_query = ' SELECT B.landing_mca,B.group_name,B.layout '
                . ' FROM '.$this->table_name.' A '
                . ' INNER JOIN sys_group B ON (A.id_group = B.id_group)'
                . ' WHERE A.id_user = :id_user '
                . ' AND A.is_principal = 1'
                . ' LIMIT 1';
        
        $this->_binds = [':id_user' => $this->id_user];
        return $this->getQuery('one');
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Setter for user id
     * -------------------------------------------------------------------------
     * @param type $id_user
     */
    public function set_id_user($id_user = ''){
        $this->id_user = \helpers\Validator::valInt('id_user',$id_user,true);
    }
    
    
}

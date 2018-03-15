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

namespace application\modules\configuracion\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class UserContratanteModel
  |-----------------------------------------------------------------------------
  | Buisiness logic (rules) for UserContratanteTable
  | User contratante asso
  | @author kerana,
  | @date 14-03-2018 06:03:22,
  |
 */

class UserContratanteModel extends tables\UserContratanteTable
{

    public
            
    /** @object ContratanteModel  */
            $objContratanteModel,
            /** @object UserModel  */
            $objUserModel;

    public function __construct()
    {
        parent::__construct();
        $this->objContratanteModel = new \application\modules\base\model\ContratanteModel();
        $this->objUserModel = new \application\modules\system\model\UserModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Get all contratantes-user
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getContratantesUser(){
        
       return $this->find('*', ['id_user' => $this->_id_user],'all');
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Save post data
     * -------------------------------------------------------------------------
     */
    public function savePost()
    {
        $this->set_id_user();
        $this->set_id_contratante();

        return parent::saveUserContratante();
    }

}

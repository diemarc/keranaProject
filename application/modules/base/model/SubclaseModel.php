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

namespace application\modules\base\model;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class SubclaseModel
  |-----------------------------------------------------------------------------
  | Buisiness logic (rules) for SubclaseTable 
  | 
  | @author kerana,
  | @date 16-03-2018 06:21:31,
  |
 */

class SubclaseModel extends tables\SubclaseTable {

    public 
 /** @object ClaseModel  */ 
 $objClaseModel;
    
     public function __construct()
    {
        parent::__construct();
         $this->objClaseModel= new \application\modules\base\model\ClaseModel(); 

        
    }

    /**
     * -------------------------------------------------------------------------
     * Save post data
     * -------------------------------------------------------------------------
     */
    public function savePost(){
        $this->set_id_clases();
$this->set_subclase();

        return parent::saveSubclase();
    }
    
    

}
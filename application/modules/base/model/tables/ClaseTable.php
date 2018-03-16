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

namespace application\modules\base\model\tables;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ClaseTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for aux_clases
  | @author kerana,
  | @date 16-03-2018 06:20:17,
  |
 */

abstract class ClaseTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_clases  */ 
$_id_clases, 
/** @var varchar(45), $clase  */ 
$_clase,
            
            /** Master query for clase */
            $_query_clase;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_clase;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'aux_clases';
        $this->table_id = 'id_clases';
        
        $this->pks = [
          'id_clases'=> $this->_id_clases,
  
        ];
        
        $this->_query = ' SELECT A.id_clases,A.clase' 
.' FROM aux_clases A '
 .' WHERE A.id_clases IS NOT NULL ';  
    }

    
    /*
      |-------------------------------------------------------------------------
      | SELECT-METHODS
      |-------------------------------------------------------------------------
      |
     */

    
    
    /*
     |-------------------------------------------------------------------------
     | INSERT-UPDATE-METHODS
     |-------------------------------------------------------------------------
     |
    */


    /**
     * -------------------------------------------------------------------------
     * Insert/update new record into aux_clases
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveClase(){
        
        $data_insert =  [
            'clase' =>$this->_clase,
  
        ];
          return parent::save($data_insert);
        
    }
    
    
    
    
 /*
  |-------------------------------------------------------------------------
  | SETTERS
  |-------------------------------------------------------------------------
  | 
 */

 /** 
* ------------------------------------------------------------------------- 
* Setter for id_clases
* ------------------------------------------------------------------------- 
* @param int $value the id_clases value 
*/ 
 public function set_id_clases($value = ""){ 
 $this->_id_clases= \helpers\Validator::valInt('f_id_clases',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for clase
* ------------------------------------------------------------------------- 
* @param varchar $value the clase value 
*/ 
 public function set_clase($value = ""){ 
 $this->_clase= \helpers\Validator::valVarchar('f_clase',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_clases
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_clases(){ 
 return (isset($this->_id_clases)) ? $this->_id_clases: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for clase
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_clase(){ 
 return (isset($this->_clase)) ? $this->_clase: null;
}

}
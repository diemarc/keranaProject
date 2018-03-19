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
  | Class TipoTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for f_tipo
  | @author kerana,
  | @date 16-03-2018 06:28:16,
  |
 */

abstract class TipoTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_tipo  */ 
$_id_tipo, 
/** @var varchar(45), $tipo  */ 
$_tipo,
            
            /** Master query for tipo */
            $_query_tipo;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_tipo;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'f_tipo';
        $this->table_id = 'id_tipo';
        
        $this->pks = [
          'id_tipo'=> $this->_id_tipo,
  
        ];
        
        $this->_query = ' SELECT A.id_tipo,A.tipo' 
.' FROM f_tipo A '
 .' WHERE A.id_tipo IS NOT NULL ';  
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
     * Insert/update new record into f_tipo
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveTipo(){
        
        $data_insert =  [
            'tipo' =>$this->_tipo,
  
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
* Setter for id_tipo
* ------------------------------------------------------------------------- 
* @param int $value the id_tipo value 
*/ 
 public function set_id_tipo($value = ""){ 
 $this->_id_tipo= \helpers\Validator::valInt('f_id_tipo',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for tipo
* ------------------------------------------------------------------------- 
* @param varchar $value the tipo value 
*/ 
 public function set_tipo($value = ""){ 
 $this->_tipo= \helpers\Validator::valVarchar('f_tipo',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_tipo
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_tipo(){ 
 return (isset($this->_id_tipo)) ? $this->_id_tipo: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for tipo
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_tipo(){ 
 return (isset($this->_tipo)) ? $this->_tipo: null;
}

}
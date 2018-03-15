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
  | Class EstadoTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for aux_estados
  | @author kerana,
  | @date 09-03-2018 06:03:06,
  |
 */

abstract class EstadoTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_estado  */ 
$_id_estado, 
/** @var varchar(45), $estado  */ 
$_estado,
            
            /** Master query for estado */
            $_query_estado;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_estado;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'aux_estados';
        $this->table_id = 'id_estado';
        
        $this->pks = [
          'id_estado'=> $this->_id_estado,
  
        ];
        
        $this->_query = ' SELECT A.id_estado,A.estado' 
.' FROM aux_estados A '
 .' WHERE A.id_estado IS NOT NULL ';  
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
     * Insert/update new record into aux_estados
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveEstado(){
        
        $data_insert =  [
            'estado' =>$this->_estado,
  
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
* Setter for id_estado
* ------------------------------------------------------------------------- 
* @param int $value the id_estado value 
*/ 
 public function set_id_estado($value = ""){ 
 $this->_id_estado= \helpers\Validator::valInt('f_id_estado',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for estado
* ------------------------------------------------------------------------- 
* @param varchar $value the estado value 
*/ 
 public function set_estado($value = ""){ 
 $this->_estado= \helpers\Validator::valVarchar('f_estado',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_estado
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_estado(){ 
 return (isset($this->_id_estado)) ? $this->_id_estado: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for estado
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_estado(){ 
 return (isset($this->_estado)) ? $this->_estado: null;
}

}
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
  | Class TaxaTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for aux_tasas
  | @author kerana,
  | @date 16-03-2018 06:12:45,
  |
 */

abstract class TaxaTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_tasa  */ 
$_id_tasa, 
/** @var varchar(45), $tasa  */ 
$_tasa, 
/** @var decimal(10,2), $porcentaje  */ 
$_porcentaje,
            
            /** Master query for taxa */
            $_query_taxa;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_taxa;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'aux_tasas';
        $this->table_id = 'id_tasa';
        
        $this->pks = [
          'id_tasa'=> $this->_id_tasa,
  
        ];
        
        $this->_query = ' SELECT A.id_tasa,A.tasa,A.porcentaje' 
.' FROM aux_tasas A '
 .' WHERE A.id_tasa IS NOT NULL ';  
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
     * Insert/update new record into aux_tasas
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveTaxa(){
        
        $data_insert =  [
            'tasa' =>$this->_tasa,
'porcentaje' =>$this->_porcentaje,
  
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
* Setter for id_tasa
* ------------------------------------------------------------------------- 
* @param int $value the id_tasa value 
*/ 
 public function set_id_tasa($value = ""){ 
 $this->_id_tasa= \helpers\Validator::valInt('f_id_tasa',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for tasa
* ------------------------------------------------------------------------- 
* @param varchar $value the tasa value 
*/ 
 public function set_tasa($value = ""){ 
 $this->_tasa= \helpers\Validator::valVarchar('f_tasa',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for porcentaje
* ------------------------------------------------------------------------- 
* @param decimal $value the porcentaje value 
*/ 
 public function set_porcentaje($value = ""){ 
 $this->_porcentaje= \helpers\Validator::valDecimal('f_porcentaje',$value,TRUE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_tasa
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_tasa(){ 
 return (isset($this->_id_tasa)) ? $this->_id_tasa: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for tasa
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_tasa(){ 
 return (isset($this->_tasa)) ? $this->_tasa: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for porcentaje
* ------------------------------------------------------------------------- 
* @return decimal $value  
*/ 
 public function get_porcentaje(){ 
 return (isset($this->_porcentaje)) ? $this->_porcentaje: null;
}

}
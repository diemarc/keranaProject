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
  | Class PoblacionTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for aux_poblaciones
  | @author kerana,
  | @date 09-03-2018 06:03:24,
  |
 */

abstract class PoblacionTable extends \kerana\Ada {

    protected
    /** @var int(6), $id_poblacion  */ 
$_id_poblacion, 
/** @var varchar(45), $poblacion  */ 
$_poblacion, 
/** @var varchar(45), $provincia  */ 
$_provincia, 
/** @var varchar(45), $ccaa  */ 
$_ccaa, 
/** @var int(2), $cod_provincia  */ 
$_cod_provincia, 
/** @var int(2), $cod_ccaa  */ 
$_cod_ccaa,
            
            /** Master query for poblacion */
            $_query_poblacion;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_poblacion;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'aux_poblaciones';
        $this->table_id = 'id_poblacion';
        
        $this->pks = [
          'id_poblacion'=> $this->_id_poblacion,
  
        ];
        
        $this->_query = ' SELECT A.id_poblacion,A.poblacion,A.provincia,A.ccaa,A.cod_provincia,A.cod_ccaa' 
.' FROM aux_poblaciones A '
 .' WHERE A.id_poblacion IS NOT NULL ';  
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
     * Insert/update new record into aux_poblaciones
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function savePoblacion(){
        
        $data_insert =  [
            'poblacion' =>$this->_poblacion,
'provincia' =>$this->_provincia,
'ccaa' =>$this->_ccaa,
'cod_provincia' =>$this->_cod_provincia,
'cod_ccaa' =>$this->_cod_ccaa,
  
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
* Setter for id_poblacion
* ------------------------------------------------------------------------- 
* @param int $value the id_poblacion value 
*/ 
 public function set_id_poblacion($value = ""){ 
 $this->_id_poblacion= \helpers\Validator::valInt('f_id_poblacion',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for poblacion
* ------------------------------------------------------------------------- 
* @param varchar $value the poblacion value 
*/ 
 public function set_poblacion($value = ""){ 
 $this->_poblacion= \helpers\Validator::valVarchar('f_poblacion',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for provincia
* ------------------------------------------------------------------------- 
* @param varchar $value the provincia value 
*/ 
 public function set_provincia($value = ""){ 
 $this->_provincia= \helpers\Validator::valVarchar('f_provincia',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for ccaa
* ------------------------------------------------------------------------- 
* @param varchar $value the ccaa value 
*/ 
 public function set_ccaa($value = ""){ 
 $this->_ccaa= \helpers\Validator::valVarchar('f_ccaa',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for cod_provincia
* ------------------------------------------------------------------------- 
* @param int $value the cod_provincia value 
*/ 
 public function set_cod_provincia($value = ""){ 
 $this->_cod_provincia= \helpers\Validator::valInt('f_cod_provincia',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for cod_ccaa
* ------------------------------------------------------------------------- 
* @param int $value the cod_ccaa value 
*/ 
 public function set_cod_ccaa($value = ""){ 
 $this->_cod_ccaa= \helpers\Validator::valInt('f_cod_ccaa',$value,TRUE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_poblacion
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_poblacion(){ 
 return (isset($this->_id_poblacion)) ? $this->_id_poblacion: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for poblacion
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_poblacion(){ 
 return (isset($this->_poblacion)) ? $this->_poblacion: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for provincia
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_provincia(){ 
 return (isset($this->_provincia)) ? $this->_provincia: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for ccaa
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_ccaa(){ 
 return (isset($this->_ccaa)) ? $this->_ccaa: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for cod_provincia
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_cod_provincia(){ 
 return (isset($this->_cod_provincia)) ? $this->_cod_provincia: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for cod_ccaa
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_cod_ccaa(){ 
 return (isset($this->_cod_ccaa)) ? $this->_cod_ccaa: null;
}

}
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

namespace application\modules\fac2fast\model\tables;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ServicioTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for f_servicios
  | @author kerana,
  | @date 16-03-2018 07:25:28,
  |
 */

abstract class ServicioTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_servicio  */ 
$_id_servicio, 
/** @var int(11), $id_subclase  */ 
$_id_subclase, 
/** @var varchar(45), $servicio  */ 
$_servicio, 
/** @var text(), $descripcion  */ 
$_descripcion, 
/** @var decimal(10,2), $precio  */ 
$_precio, 
/** @var time(tamp), $created_at  */ 
$_created_at, 
/** @var varchar(45), $created_by  */ 
$_created_by,
            
            /** Master query for servicio */
            $_query_servicio;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_servicio;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'f_servicios';
        $this->table_id = 'id_servicio';
        
        $this->pks = [
          'id_servicio'=> $this->_id_servicio,
  
        ];
        
        $this->_query = ' SELECT A.id_servicio,A.id_subclase,A.servicio,A.descripcion,A.precio,A.created_at,A.created_by,B.subclase,B2.clase' 
.' FROM f_servicios A '
 .' INNER JOIN aux_subclases B ON (B.id_subclase = A.id_subclase) ' 
.' INNER JOIN aux_clases B2 ON (B2.id_clases = B.id_clases) ' 

 .' WHERE A.id_servicio IS NOT NULL ';  
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
     * Insert/update new record into f_servicios
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveServicio(){
        
        $data_insert =  [
            'id_subclase' =>$this->_id_subclase,
'servicio' =>$this->_servicio,
'descripcion' =>$this->_descripcion,
'precio' =>$this->_precio,
'created_at' =>$this->_created_at,
'created_by' =>$this->_created_by,
  
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
* Setter for id_servicio
* ------------------------------------------------------------------------- 
* @param int $value the id_servicio value 
*/ 
 public function set_id_servicio($value = ""){ 
 $this->_id_servicio= \helpers\Validator::valInt('f_id_servicio',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for id_subclase
* ------------------------------------------------------------------------- 
* @param int $value the id_subclase value 
*/ 
 public function set_id_subclase($value = ""){ 
 $this->_id_subclase= \helpers\Validator::valInt('f_id_subclase',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for servicio
* ------------------------------------------------------------------------- 
* @param varchar $value the servicio value 
*/ 
 public function set_servicio($value = ""){ 
 $this->_servicio= \helpers\Validator::valVarchar('f_servicio',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for descripcion
* ------------------------------------------------------------------------- 
* @param text $value the descripcion value 
*/ 
 public function set_descripcion($value = ""){ 
 $this->_descripcion= \helpers\Validator::valText('f_descripcion',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for precio
* ------------------------------------------------------------------------- 
* @param decimal $value the precio value 
*/ 
 public function set_precio($value = ""){ 
 $this->_precio= \helpers\Validator::valDecimal('f_precio',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for created_at
* ------------------------------------------------------------------------- 
* @param time $value the created_at value 
*/ 
 public function set_created_at($value = ""){ 
 $this->_created_at= \helpers\Validator::valTime('f_created_at',$value,FALSE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for created_by
* ------------------------------------------------------------------------- 
* @param varchar $value the created_by value 
*/ 
 public function set_created_by($value = ""){ 
 $this->_created_by= \helpers\Validator::valVarchar('f_created_by',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_servicio
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_servicio(){ 
 return (isset($this->_id_servicio)) ? $this->_id_servicio: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for id_subclase
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_subclase(){ 
 return (isset($this->_id_subclase)) ? $this->_id_subclase: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for servicio
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_servicio(){ 
 return (isset($this->_servicio)) ? $this->_servicio: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for descripcion
* ------------------------------------------------------------------------- 
* @return text $value  
*/ 
 public function get_descripcion(){ 
 return (isset($this->_descripcion)) ? $this->_descripcion: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for precio
* ------------------------------------------------------------------------- 
* @return decimal $value  
*/ 
 public function get_precio(){ 
 return (isset($this->_precio)) ? $this->_precio: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for created_at
* ------------------------------------------------------------------------- 
* @return time $value  
*/ 
 public function get_created_at(){ 
 return (isset($this->_created_at)) ? $this->_created_at: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for created_by
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_created_by(){ 
 return (isset($this->_created_by)) ? $this->_created_by: null;
}

}
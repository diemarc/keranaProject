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
  | Class SubclaseTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for aux_subclases
  | @author kerana,
  | @date 16-03-2018 06:21:30,
  |
 */

abstract class SubclaseTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_subclase  */ 
$_id_subclase, 
/** @var int(11), $id_clases  */ 
$_id_clases, 
/** @var varchar(45), $subclase  */ 
$_subclase,
            
            /** Master query for subclase */
            $_query_subclase;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_subclase;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'aux_subclases';
        $this->table_id = 'id_subclase';
        
        $this->pks = [
          'id_subclase'=> $this->_id_subclase,
'id_clases'=> $this->_id_clases,
  
        ];
        
        $this->_query = ' SELECT A.id_subclase,A.id_clases,A.subclase,B.clase' 
.' FROM aux_subclases A '
 .' INNER JOIN aux_clases B ON (B.id_clases = A.id_clases) ' 

 .' WHERE A.id_subclase IS NOT NULL ';  
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
     * Insert/update new record into aux_subclases
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveSubclase(){
        
        $data_insert =  [
            'id_clases' =>$this->_id_clases,
'subclase' =>$this->_subclase,
  
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
* Setter for id_subclase
* ------------------------------------------------------------------------- 
* @param int $value the id_subclase value 
*/ 
 public function set_id_subclase($value = ""){ 
 $this->_id_subclase= \helpers\Validator::valInt('f_id_subclase',$value,TRUE);
}
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
* Setter for subclase
* ------------------------------------------------------------------------- 
* @param varchar $value the subclase value 
*/ 
 public function set_subclase($value = ""){ 
 $this->_subclase= \helpers\Validator::valVarchar('f_subclase',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
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
* Getter for id_clases
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_clases(){ 
 return (isset($this->_id_clases)) ? $this->_id_clases: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for subclase
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_subclase(){ 
 return (isset($this->_subclase)) ? $this->_subclase: null;
}

}
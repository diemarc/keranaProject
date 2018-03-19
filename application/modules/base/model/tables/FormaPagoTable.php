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
  | Class FormaPagoTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for f_formas_pago
  | @author kerana,
  | @date 16-03-2018 06:14:36,
  |
 */

abstract class FormaPagoTable extends \kerana\Ada {

    protected
    /** @var int(11), $id_pago  */ 
$_id_pago, 
/** @var varchar(150), $formapago  */ 
$_formapago,
            
            /** Master query for formapago */
            $_query_formapago;
    
    

    public 
            /** @array data matching attributes with table field */
            $data_formapago;
    
     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'f_formas_pago';
        $this->table_id = 'id_pago';
        
        $this->pks = [
          'id_pago'=> $this->_id_pago,
  
        ];
        
        $this->_query = ' SELECT A.id_pago,A.formapago' 
.' FROM f_formas_pago A '
 .' WHERE A.id_pago IS NOT NULL ';  
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
     * Insert/update new record into f_formas_pago
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveFormaPago(){
        
        $data_insert =  [
            'formapago' =>$this->_formapago,
  
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
* Setter for id_pago
* ------------------------------------------------------------------------- 
* @param int $value the id_pago value 
*/ 
 public function set_id_pago($value = ""){ 
 $this->_id_pago= \helpers\Validator::valInt('f_id_pago',$value,TRUE);
}
/** 
* ------------------------------------------------------------------------- 
* Setter for formapago
* ------------------------------------------------------------------------- 
* @param varchar $value the formapago value 
*/ 
 public function set_formapago($value = ""){ 
 $this->_formapago= \helpers\Validator::valVarchar('f_formapago',$value,FALSE);
}

    
    
 
 /*
  |-------------------------------------------------------------------------
  | GETTERS
  |-------------------------------------------------------------------------
  | 
 */
 /** 
* ------------------------------------------------------------------------- 
* Getter for id_pago
* ------------------------------------------------------------------------- 
* @return int $value  
*/ 
 public function get_id_pago(){ 
 return (isset($this->_id_pago)) ? $this->_id_pago: null;
}
/** 
* ------------------------------------------------------------------------- 
* Getter for formapago
* ------------------------------------------------------------------------- 
* @return varchar $value  
*/ 
 public function get_formapago(){ 
 return (isset($this->_formapago)) ? $this->_formapago: null;
}

}
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

namespace application\modules\configuracion\model\tables;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class UserContratanteTable
  |-----------------------------------------------------------------------------
  |
  | Persistance layer for user_contratante
  | @author kerana,
  | @date 14-03-2018 06:03:22,
  |
 */

abstract class UserContratanteTable extends \kerana\Ada
{

    protected
    /** @var int(11), $id_user  */
            $_id_user,
            /** @var int(11), $id_contratante  */
            $_id_contratante,
            /** Master query for usercontratante */
            $_query_usercontratante;
    public
    /** @array data matching attributes with table field */
            $data_usercontratante;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'user_contratante';
        $this->table_id = 'id_user';

        $this->pks = [
            'id_user' => $this->_id_user,
            'id_contratante' => $this->_id_contratante,
        ];

        $this->_query = ' SELECT A.id_user,A.id_contratante,B.contratante,B.cif,B.razon_social,'
                . ' B.id_poblacion,B.direccion,B.telefono,B.email,B.contacto,B.cta_bancaria,'
                . ' B.path_logo,B.observacion,B.created_at,B.created_by,B.aux_estados_id_estado,'
                . ' B2.estado,B3.poblacion,B3.provincia,B3.ccaa,B3.cod_provincia,'
                . ' B3.cod_ccaa,B3.cod_poblacion,C.username,'
                .  'C.name,C.lastname,C.sw_active'
                . ' FROM user_contratante A '
                . ' INNER JOIN a_contratantes B ON (B.id_contratante = A.id_contratante) '
                . ' INNER JOIN aux_estados B2 ON (B2.id_estado = B.aux_estados_id_estado) '
                . ' INNER JOIN aux_poblaciones B3 ON (B3.id_poblacion = B.id_poblacion) '
                . ' INNER JOIN sys_user C ON (C.id_user = A.id_user) '
                . ' WHERE A.id_user IS NOT NULL ';
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
     * Insert/update new record into user_contratante
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveUserContratante()
    {

        $data_insert = [
            'id_user' => $this->_id_user,
            'id_contratante' => $this->_id_contratante,
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
     * Setter for id_user
     * ------------------------------------------------------------------------- 
     * @param int $value the id_user value 
     */
    public function set_id_user($value = "")
    {
        $this->_id_user = \helpers\Validator::valInt('f_id_user', $value, TRUE);
    }

    /**
     * ------------------------------------------------------------------------- 
     * Setter for id_contratante
     * ------------------------------------------------------------------------- 
     * @param int $value the id_contratante value 
     */
    public function set_id_contratante($value = "")
    {
        $this->_id_contratante = \helpers\Validator::valInt('f_id_contratante', $value, TRUE);
    }

    /*
      |-------------------------------------------------------------------------
      | GETTERS
      |-------------------------------------------------------------------------
      |
     */

    /**
     * ------------------------------------------------------------------------- 
     * Getter for id_user
     * ------------------------------------------------------------------------- 
     * @return int $value  
     */
    public function get_id_user()
    {
        return (isset($this->_id_user)) ? $this->_id_user : null;
    }

    /**
     * ------------------------------------------------------------------------- 
     * Getter for id_contratante
     * ------------------------------------------------------------------------- 
     * @return int $value  
     */
    public function get_id_contratante()
    {
        return (isset($this->_id_contratante)) ? $this->_id_contratante : null;
    }

}

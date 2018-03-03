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

namespace application\modules\cliente\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class PriceModel
  |-----------------------------------------------------------------------------
  | Buisiness logic (rules) for PriceTable
  |
  | @author kerana,
  | @date 03-03-2018 06:18:35,
  |
 */

class PriceModel extends PriceTable
{

    public
    /** @object EstadoModel  */
            $objEstadoModel,
            /** @object PoblacionModel  */
            $objPoblacionModel;

    public function __construct()
    {
        parent::__construct();
        $this->objEstadoModel = new \application\modules\repo\model\EstadoModel();
        $this->objPoblacionModel = new \application\modules\repo\model\PoblacionModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Save post data
     * -------------------------------------------------------------------------
     */
    public function savePost()
    {
        $this->set_cif();
        $this->set_razon_social();
        $this->set_direccion();
        $this->set_id_poblacion();
        $this->set_telefono();
        $this->set_email();
        $this->set_contacto();
        $this->set_cta_bancaria();
        $this->set_path_logo();
        $this->set_observacion();
        $this->set_created_at();
        $this->set_created_by();
        $this->set_aux_estados_id_estado();

        return parent::savePrice();
    }

}

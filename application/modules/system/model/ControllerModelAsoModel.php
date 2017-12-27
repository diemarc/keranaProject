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
namespace application\modules\system\model;

/**
 * -----------------------------------------------------------------------------
 * ControllerModelAsoModel
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class ControllerModelAsoModel extends \kerana\Ada
{

    public
    /** @var int */
            $id_model,
            /** @var int */
            $id_module,
            /** @var int */
            $id_controller;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_controller_model';
    }

    /**
     * -------------------------------------------------------------------------
     * Save link table controller,model,module
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveControllerModel()
    {

        $data = [
            'id_model' => $this->id_model,
            'id_module' => $this->id_module,
            'id_controller' => $this->id_controller
        ];

        return $this->insert($data);
    }

}

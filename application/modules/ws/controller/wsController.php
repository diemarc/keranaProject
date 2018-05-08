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

namespace application\modules\ws\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | Class Controller controller
  |--------------------------------------------------------------------------
  |
  | Handle the creation of controllers for kerana
  |
 */

class WsController extends \kerana\Kerana
{

    private
            $objWs;

    public function __construct()
    {
        parent::__construct();
        $this->objWs = new \application\modules\ws\model\WsModel();
    }

    public function server()
    {

        $server = new \SoapServer(null, array('uri' => 'urn:webservices','user' => 'root' ,'pass' => '12345'));

// Asignamos la Clase
        $server->setObject($this->objWs);

// Atendemos las peticiones
        $server->handle();
    }

}

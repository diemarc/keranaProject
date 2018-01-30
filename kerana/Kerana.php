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

namespace kerana;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * KERANA CLASS
 * ------------------------------------------------------------------------------
 * Main controller
 * @author diemarc
 * @abstract
 */
abstract class Kerana 
{

    protected
    /** @var object, instancia de la clase view */
            $_view,
            /** @var mixed, configuration file */
            $_config,
            /** @var mixed, concatena el modulo/controller/action  */
            $_current_module_controller_action,
            /** @var mixed, modulo eactual */
            $_current_module,
            /** @var mixed, controlador actual */
            $_current_controller,
            /** @var mixed, action actual */
            $_current_action,
            /** @var mixed, session handler para usar las sesiones seguras */
            $_session_kerana;

    public function __construct()
    {
        $this->_config = \kerana\Configuration::singleton();
        $this->_setCurrentLocation();
        $this->_session_kerana = new \kerana\SessionHandler;
    }

    /**
     * -------------------------------------------------------------------------
     * Setea la peticion actual, para saber en que modulo y controlador estamos
     * @TODO , este codigo se repite en kerana\system, futuras modificaciones
     * -------------------------------------------------------------------------
     */
    protected function _setCurrentLocation()
    {
        
            $this->_current_module = \helpers\Url::getModule();
            $this->_current_controller = \helpers\Url::getController();
            $this->_current_action = \helpers\Url::getAction();

            $this->_current_module_controller_action = $this->_current_module . '\\' .
                    $this->_current_controller . '\\' . $this->_current_action;
        
    }

}
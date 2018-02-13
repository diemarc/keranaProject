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
/*
  |--------------------------------------------------------------------------
  | SYSTEM
  |--------------------------------------------------------------------------
  | @author = diem@rc;
  | @date 24/08/2017
  | Front controller implementation
 */

class System
{

    private
    /** @var mixed, full namespace  */
            $_namespace,
            /** @var mixed, module to load */
            $_module,
            /** @var mixed, controller to use */
            $_controller,
            /** @var mixed, object controller */
            $_object_controller,
            /** @var mixed, method to call */
            $_action,
            /** @var array, url parameters passed via GET */
            $_parameters;
    public
            $config;

    /**
     * -------------------------------------------------------------------------
     * Start the applicaction
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function __construct()
    {

        // load the configuration file depending on environment value constant
        require_once(__APPFOLDER__ . '/../config/conf.' . __ENVIRONMENT__ . '.php');

        //load kerana confguration file.
        $this->config = \kerana\Configuration::singleton();

        // segment url, and store parameters
        $this->_segmentUrlAndStoreParameters();
        $this->_setAndCheckNamespace();

        // if kerana is not running in CLI mode, check access
        (!defined('__ISCLI__')) ? $this->_checkAccessPetition() : '';

        // object controller is created now
        $this->_object_controller = new $this->_namespace;

        // if exists some parameters will stored in a array 
        // ej: indexController->index($i,$y)
        if (!empty($this->_parameters)) {

            // call the method and pass the parameters
            call_user_func_array([$this->_object_controller, $this->_action], $this->_parameters);
        } else {

            // if not parameters , the call the method
            $this->_object_controller->{$this->_action}();
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Build the module,controller,action,parameters from a friendly url
     * -------------------------------------------------------------------------
     * ej: http://keranaproject/comercial/empresa/editar/10054
     * modulo = comercial
     * controlador = empresa
     * action = editar
     * par1 = 10054
     * -------------------------------------------------------------------------
     */
    private function _segmentUrlAndStoreParameters()
    {

        $this->_module = \helpers\Url::getModule();
        $this->_controller = \helpers\Url::getController();
        $this->_action = \helpers\Url::getAction();
        $this->_parameters = \helpers\Url::getParameters();
    }

    /**
     * -------------------------------------------------------------------------
     * Check the namespace, create the url to run
     * -------------------------------------------------------------------------
     * @return boolean
     */
    private function _setAndCheckNamespace()
    {
        $this->_module = (!$this->_module) ? _DEFAULT_MODULE_ : $this->_module;
        $this->_controller = (!$this->_controller) ? _DEFAULT_CONTROLLER_ : $this->_controller;
        $this->_action = (!$this->_action) ? _DEFAULT_ACTION_ : $this->_action;

        // setamos el namespace
        $this->_namespace = '\\application\\modules\\' . $this->_module . '\\controller\\' . $this->_controller . 'Controller';

        // Si no existe la clase y la accion
        if (is_callable(array($this->_namespace, $this->_action)) == false) {

            $descripcion = "<strong>The method is not available for use :</strong><hr> "
                    . " module= <b>$this->_module</b> <br> "
                    . " controller= <b>$this->_controller</b> <br> "
                    . " method = <b> $this->_action</b><br>"
                    . "full_namespace =<b> $this->_namespace'</b><br>";
            \kerana\Exceptions::showError('RequestPetitionError', $descripcion);
            return false;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Check Access Petition
     * -------------------------------------------------------------------------
     * Check if the module requested is not a public module, specified in conf file,
     * If false, check user autentification.
     * If user user is autentificated, then check ACL if this is activated in conf file
     */
    private function _checkAccessPetition()
    {

        if (!in_array($this->_module, $this->config->get('_public_modules_'))) {
            // run ACL , only if is activated in conf file (_acl_active_)
            ($this->config->get('_acl_active_')) ?
                            (\kerana\Auth::checkAuthentication()) ?
                                    New \kerana\acl\Acl($this->_module, $this->_controller, $this->_action) : '' :
                            \kerana\Auth::checkAuthentication();
        }
    }

}

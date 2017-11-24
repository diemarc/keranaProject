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

namespace kerana; // siempre en minusculas

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a estde archivo') : '';
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
            /** @var mixed, full namespace para crear objetos y autoload */
            $_namespace,
            /** @var mixed, nombre del modulo a cargar */
            $_module,
            /** @var mixed, controlador a utilizar */
            $_controller,
            /** @var mixed, instancia del controller a utilizar */
            $_object_controller,
            /** @var mixed, metodo a ejecutar del controlador */
            $_action,
            /** @var array, almacena los parametros pasados por URL GET */
            $_parameters;
    public
            $config;

    /**
     * -------------------------------------------------------------------------
     * Inicializa la aplicacion
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function __construct()
    {

        require_once(__APPFOLDER__ . '/../config/conf.php');

        //cargamos la configuracion del sistema.
        $this->config = \kerana\Configuration::singleton();

        // se obtiene las partes de la url y se almacena parametros
        $this->_segmentUrlAndStoreParameters();

        // seteamos el namespace
        $this->_setAndCheckNamespace();

        // se comprueba si el modulo necesita autentificacion, 
        // solo si no es de cli
        (!defined('__ISCLI__')) ? $this->_checkAccessPetition() :'';

        // creamos un ojbjeto del controlador
        $this->_object_controller = new $this->_namespace;

        // si hay parametros almacenados pasamos el namespace y el metodo 
        // con los parametros
        // ej: indexController->index($i,$y)
        if (!empty($this->_parameters)) {
            call_user_func_array([$this->_object_controller, $this->_action], $this->_parameters);
        } else {
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
     * Comprueba si esta seteado las partes de mod,controller,action, sino es asi
     * asigna los valores por defecto seteados en config/conf.php
     *
     * Setea el full namespace y comprueba que exista y pueda ser llamado.
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

            $descripcion = "<strong>El metodo no existen o no puede ser llamado :</strong><hr> "
                    . " modulo= <b>$this->_module</b> <br> "
                    . " controlador= <b>$this->_controller</b> <br> "
                    . " metodo = <b> $this->_action</b><br>"
                    . "full_namespace =<b> $this->_namespace'</b><br>";
            \kerana\Exceptions::showError('Error en resolver la peticion', $descripcion);
            return false;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Comprueba si el modulo necesita autentificacion
     * -------------------------------------------------------------------------
     */
    private function _checkAccessPetition()
    {
        
        //comprobamos si el modulo necesita una autentificacion
        if (!in_array($this->_module, $this->config->get('_public_modules_'))) {
            \kerana\Auth::checkAuthentication();
        }
    }

}

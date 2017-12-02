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

namespace Kerana;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | VIEW CLASS
  |--------------------------------------------------------------------------
  | load views, simply
  |
 */

class View
{

    public static
            $_model;

    /**
     * -------------------------------------------------------------------------
     * Show a view
     * -------------------------------------------------------------------------
     * @param string $module , el modulo donde se encuentra la vista a cargar
     * @param string $template , el html
     * @param array $params , parametros para pasar a la vista
     * @param boolean $save , si queremos usar partials views
     * @param boolean $load_header , para cargar los encabezados html
     */
    public static function showView($module = '', $template = '', $params = '', $save = false, $load_header = true)
    {

        $template_path = $module . '/view/' . $template . '.php';
        $full_path_template = __MODULEFOLDER__ . '/' . $template_path;

        // verificamos si existe la ruta
        (!file_exists($full_path_template)) ? \helpers\ViewMaker::createView($module, $template, $params, self::$_model) : '';

        // procesamos los parametros que usara la vista
        if (is_array($params)) {
            // limpiamos las variables a mostrar

            foreach ($params as $key => $valor) {
                $$key = $valor;
            }
        }

        // si se quiere guardar la vista para usarlo como partial view
        if ($save) {
            ob_start(); # apertura de bufer
            include($full_path_template );
            $var_view = ob_get_contents();
            ob_end_clean(); # cierre de bufer
            return $var_view;
        }

        // si queremos cargar el encabezado html
        ($load_header) ? require_once(__DOCUMENTROOT__ . '/_layouts/default/_htmlHeader.php') : '';

        // inlcuimos la plantilla
        include($full_path_template);

        // si queremos cargar el encabezado html tambien cargamos el footer
        ($load_header) ? require_once(__DOCUMENTROOT__ . '/_layouts/default/_htmlFooter.php') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Load form with CSRF token security
     * -------------------------------------------------------------------------
     * @param mixed $module
     * @param mixed $template
     * @param array $params
     * @param object $model , object of model to create a html form
     */
    public static function showForm($module, $template, $params = '', $model = false)
    {

        //$token_string = \kerana\Security::csrfGetTokenId();
        $token_value = \kerana\Security::csrfGetTokenValue();
        ($model != false) ? self::$_model = $model : '';

        $params['kerana_token'] = '<input type="hidden" name="_kerana_token_" value="' . $token_value . '">';

        self::showView($module, $template, $params);
    }

}

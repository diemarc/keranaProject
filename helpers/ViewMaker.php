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

namespace helpers;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |-----------------------------------------------------------------------------
  | View maker class
  |-----------------------------------------------------------------------------
  |
  | Create views,form
 */

class ViewMaker
{

    public static
            $model_view,
            $controller,
            /** @var mixed $path_view_file, where you want to save the new view-file */
            $path_view_file;

    /**
     * -------------------------------------------------------------------------
     * Check if exists method to create a view, if not throw kerana exception,
     * otherwise call the method
     * -------------------------------------------------------------------------
     * @param mixed $tpl , the view template
     * @param array $params , params
     */
    public static function makeView($tpl, $params, $model = false)
    {
        self::setPathView();
        $method_trigger = substr(strrchr($tpl, '/'), 1);

        $method_name = 'make' . ucwords(($method_trigger == false) ? $tpl : $method_trigger);

        ($model != false) ? self::$model_view = $model : '';

        return (method_exists(__CLASS__, $method_name)) ? self::$method_name($params) :
                \kerana\Exceptions::showError('ViewMaker', 'ViewMaker cant create this view , method-> ' . $method_name);
    }

    /**
     * -------------------------------------------------------------------------
     * Set the path will be stored the new view file
     * -------------------------------------------------------------------------
     */
    public static function setPathView()
    {

        $base_path_view = __MODULEFOLDER__ . '/' . \helpers\Url::getModule() . '/view/' . \helpers\Url::getController();

        if (!is_dir($base_path_view)) {
            mkdir($base_path_view, 0777, true);
            //self::$path_view_file = realpath($base_path_view);
        }

        return self::$path_view_file = realpath($base_path_view);
    }

    /**
     * -------------------------------------------------------------------------
     * Create a form for add a new record
     * -------------------------------------------------------------------------
     * @param type $module
     * @param type $rs
     */
    public static function makeAdd()
    {
        if (isset(self::$model_view) AND ! empty(self::$model_view)) {
            $kerana_form = New \helpers\KeranaForm(self::$model_view, 1, self::$path_view_file);
            $kerana_form = null;
        } else {
            \kerana\Exceptions::showError('ViewMaker', 'Model not found,can`t create a form without a model object');
        }
    }

    /**
     * --------------------------------------------------------------------------
     * Create a edit form 
     * ------------------------------------------------------------------------- 
     */
    public static function makeEdit()
    {
        if (isset(self::$model_view) AND ! empty(self::$model_view)) {
            $kerana_form = New \helpers\KeranaForm(self::$model_view, 2, self::$path_view_file);
            $kerana_form = null;
        } else {
            \kerana\Exceptions::showError('ViewMaker', 'Model not found,can`t create a edit/form without a model object');
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Create a index page
     * -------------------------------------------------------------------------
     * @param array $params
     */
    public static function makeIndex($params)
    {
        if (isset(self::$model_view) AND ! empty(self::$model_view)) {

            // current controller
            $controller = \helpers\Url::getController();
            $module = \helpers\Url::getModule();

            // load the index template
            $path_tpl_index = realpath(__DOCUMENTROOT__ . '/../templates/creator/view/tpl_index.ker');


            // load index tpl
            $index_tpl_content = file_get_contents($path_tpl_index);

            // resultset array 
            $rs = $params['rs' . ucwords($controller) . 's'];
            $array = json_decode(json_encode($rs), TRUE);
            $keys = array_keys($array[0]);

            // parse the table for rs
            $table_title = '';
            foreach ($keys AS $key):
                $table_title .= "<th>" . $key . "</th> \n";
            endforeach;
            $table_title .= "<th>Options</th> \n";

            // parse the table content
            $table_content = '<?php foreach($rs' . ucwords($controller) . 's AS $' . $controller . '):?>' . "\n";
            $table_content .= "<tr> \n";
            foreach ($keys AS $k_table) {
                $table_content .= "<td><?php echo $$controller->$k_table; ?></td> \n";
            }
            $url_edit = '/' . $module . '/' . $controller . '/edit/<?php echo $' . $controller . '->' . self::$model_view->table_id . '; ?>';
            $url_delete = '/' . $module . '/' . $controller . '/delete/<?php echo $' . $controller . '->' . self::$model_view->table_id . '; ?>';
            $table_content .= "<td> \n "
                    . "<a href='$url_edit' \n class='btn btn-default btn-xs' title='Edit'>\n<i class='fa fa-edit'></i>\n</a> \n"
                    . "<a href='$url_delete' \n class='btn btn-danger btn-xs' title='Delete'>\n<i class='fa fa-trash'></i></a> \n "
                    . "</td> \n";
            $table_content .= "</tr> \n";
            $table_content .= "<?php endforeach;?>";

            // inject the code
            $code_to_inject = [
                '[{title}]' => $module . '/' . $controller . '/index',
                '[{url_add}]' => __URL__ . '/' . $module . '/' . $controller . '/add',
                '[{lists}]' => ucwords($controller) . 's',
                '[{controller}]' => $controller,
                '[{table_titles}]' => $table_title,
                '[{table_content}]' => $table_content
            ];

            // create the index view.
            fopen(self::$path_view_file . '/index.php', 'w');

            // inject the code 
            $index_code_content = strtr($index_tpl_content, $code_to_inject);
            file_put_contents(self::$path_view_file . '/index.php', $index_code_content);
        } else {
            \kerana\Exceptions::showError('ViewMaker', 'Model not found,can`t create a index without a model object');
        }
    }

}

<?php

namespace Kerana;

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
            $_model_view,
            $controller;

    /**
     * -------------------------------------------------------------------------
     * Check if exists method to create a view, if not throw kerana exception,
     * otherwise call the method
     * -------------------------------------------------------------------------
     * @param mixed $module , module path view
     * @param mixed $tpl , the view template
     * @param array $params , params
     */
    public static function createView($module, $tpl, $params, $model = false)
    {
        $method_name = 'create' . ucwords($tpl);
        ($model != false) ? self::$_model_view = $model : '';

        return (method_exists(__CLASS__, $method_name)) ? self::$method_name($module, $params) :
                \kerana\Exceptions::showError('ViewMaker', 'View template not found ' . $method_name);
    }

    /**
     * -------------------------------------------------------------------------
     * Create a form for add a new record
     * -------------------------------------------------------------------------
     * @param type $module
     * @param type $params
     */
    public static function createAdd($module, $params)
    {
        if (isset(self::$_model_view) AND ! empty(self::$_model_view)) {
            $kerana_form = New \helpers\KeranaForm(self::$_model_view);
            $kerana_form->createForm();
            $form_created = $kerana_form->form_elements;

            // current controller
           $controller = \helpers\Url::getController();
           $path_tpl_form = realpath(__DOCUMENTROOT__ . '/../templates/creator/view/tpl_form_add.ker');
           $path_add_file = realpath(__MODULEFOLDER__ . '/' . $module . '/view/');
            
            
            // load the form template
            $tpl_form_content = file_get_contents($path_tpl_form);

            // form elements
            $form_elements = '';
            foreach ($form_created AS $v):
                $form_elements .= "<div class='form-group form-group-sm'> \n"
                        . "".$v." \n"
                        . "</div> \n";
            endforeach;

            // inject the code
            $code_to_inject = [
                '[{title}]' => $module . '/New record',
                '[{url_save}]' => __URL__ . '/' . $module . '/' . $controller . '/save',
                '[{url_goback}]' => __URL__ . '/' . $module . '/' . $controller . '/index',
                '[{form}]' => $form_elements
            ];

            // create the form view.
            fopen($path_add_file . '/add.php', 'w');

            // inject the code 
            $formadd_code_content = strtr($tpl_form_content, $code_to_inject);
            file_put_contents($path_add_file . '/add.php', $formadd_code_content);
        }
        else {
            \kerana\Exceptions::showError('ViewMaker', 'Model not found,can`t create a form without a model object');
        }

    }

    /**
     * -------------------------------------------------------------------------
     * Create a index page
     * -------------------------------------------------------------------------
     * @param mixed $module
     * @param array $params
     */
    public static function createIndex($module, $params)
    {

        // load the index template
        $path_tpl_index = realpath(__DOCUMENTROOT__ . '/../templates/creator/view/tpl_index.ker');
        $path_index_file = realpath(__MODULEFOLDER__ . '/' . $module . '/view/');

        // load index tpl
        $index_tpl_content = file_get_contents($path_tpl_index);

        // current controller
        $controller = \helpers\Url::getController();

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
        $table_content .= "<td> </td> \n";
        $table_content .= "</tr> \n";
        $table_content .= "<?php endforeach;?>";

        // inject the code
        $code_to_inject = [
            '[{title}]' => $module . '/index',
            '[{url_add}]' => __URL__ . '/' . $module . '/' . $controller . '/add',
            '[{lists}]' => ucwords($controller) . 's',
            '[{controller}]' => $controller,
            '[{table_titles}]' => $table_title,
            '[{table_content}]' => $table_content
        ];

        // create the index view.
        fopen($path_index_file . '/index.php', 'w');

        // inject the code 
        $index_code_content = strtr($index_tpl_content, $code_to_inject);
        file_put_contents($path_index_file . '/index.php', $index_code_content);
    }

}

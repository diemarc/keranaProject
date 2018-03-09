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

/**
 * -----------------------------------------------------------------------------
 * KeranaForm Class
 * -----------------------------------------------------------------------------
 * Creates forms from a mysql structure table.
 */
class KeranaForm
{

    protected
    /** @object , model to create form \kerana\Ada */
            $_object_table,
            /** @var int, form type to create, 1(add),2(edit) */
            $_form_type,
            /** @var mixed, form title */
            $_form_title,
            /** @var mixed, form action button submit */
            $_form_action,
            /** @var mixed, form file name */
            $_form_file,
            /** @var mixed, form path file  */
            $_form_path_file,
            /** @var mixed, resultset object to edit forms */
            $_form_rs,
            /** @var mixed, form controller */
            $_form_controller,
            /** @var mixed, form module */
            $_form_module,
            /** @var mixed, form controller */
            $_form_elements,
            /** @var mixed, form template content */
            $_form_template_content,
            /** @array, contains the html form tags  */
            $_form_tags = [],
            /** @array, keywords to avoid creation of element form tags */
            $_field_names_avoid = ['created_by', 'created_at'];

    /**
     * 
     * @param \kerana\Ada $objectTable
     * @param type $type
     * @param type $path
     */
    public function __construct(\kerana\Ada $objectTable, $type, $path)
    {
        $this->_object_table = $objectTable;
        $this->setFormType($type);
        $this->_form_path_file = $path;
        $this->createKeranaForm();
    }

    /*
      |--------------------------------------------------------------------------
      | GETTERS SETTERS
      |--------------------------------------------------------------------------
      |
     */

    public function __set($property, $value)
    {
        $this->$property = (property_exists(__CLASS__, $property)) ?
                filter_var($value, FILTER_SANITIZE_STRING) :
                \kerana\Exceptions::ShowError('Not exists', 'Property "' . $property . '" not exists in this class');
    }

    /**
     * -------------------------------------------------------------------------
     * Set the form type to create
     * -------------------------------------------------------------------------
     * @param type $type
     */
    public function setFormType($type)
    {
        $this->_form_type = \helpers\Validator::valInt('type_form', $type);

        switch ($this->_form_type) {

            // new record form
            case 1;
                $this->_form_title = 'New record';
                $this->_form_action = 'save';
                $this->_form_file = 'add';
                $this->_form_rs = false;
                break;

            // edit record form
            case 2;
                $this->_form_title = 'Edit record';
                $this->_form_action = 'update/<?php echo $rs->' . $this->_object_table->table_id . '; ?>';
                $this->_form_file = 'edit';
                $this->_form_rs = '$rs';
                break;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Describe the table and for each field create a form element
     * -------------------------------------------------------------------------
     */
    private function _extractModelFields()
    {
        $rs = $this->_object_table->descTable();
        foreach ($rs AS $desc):

            $ex = preg_split("/[\()s]+/", $desc->Type);
            $field_type = $ex[0];
            $field_lenght = $ex[1];
            (($desc->Extra != 'auto_increment') AND ( !in_array($desc->Field, $this->_field_names_avoid))) ?
                            $this->_parseField($desc->Field, $field_type, $field_lenght, $desc->Null) : '';
        endforeach;
        //exit();
    }

    /**
     * -------------------------------------------------------------------------
     * Parse the table fields to a form element
     * -------------------------------------------------------------------------
     * @param mixed $field_name
     * @param string $field_type
     * @param int $length
     * @return avoid
     */
    private function _parseField($field_name, $field_type, $length = '', $null = 'NO')
    {

        $label = "<label for='f_$field_name' class='col-sm-2 control-label'>" . ucwords($field_name) . "</label> \n";
        $divput = "<div class='col-sm-6'> \n <div class='input-group col-sm-8'> \n";
        $required = ($null == 'NO') ? 'required' : '';
        $value = ($this->_form_rs != false) ? ' value="<?php echo $rs->' . $field_name . ';?>"' : '';

        // letst chec field type
        $is_email = strpos($field_name, 'email');
        $is_pass = strpos($field_name, 'password');
        $is_phone = strpos($field_name, 'telefono');

        switch ($field_type) {

            // inputs type text
            case 'varchar';


                if ($is_email !== false) {
                    $type = 'email';
                } else if ($is_pass !== false) {
                    $type = 'password';
                } else if ($is_phone !== false) {
                    $type = 'tel';
                } else {
                    $type = 'text';
                }
                //no create elements with some pattenr in field title
                if (!in_array($field_name, $this->_field_names_avoid)) {
                    $element = '<input type="' . $type . '" id="f_' . $field_name . '" name="f_'
                            . '' . $field_name . '" class="form-control"  maxlength="' . $length . '" ' . $required . $value . '  />';
                }
                break;

            // inputs type number
            case 'int';

                // get table-field dependency
                $rsDependency = $this->_object_table->getTableDependencys('', $field_name);

                // if field has a dependency, then create select code
                if ($rsDependency) {

                    foreach ($rsDependency AS $dependency):

                        $rs_name = strtolower(substr($dependency->model, 0, -5));

                        $element = '<select class="form-control" name="f_' . $field_name . '" id="f_' . $field_name . '" required>' . " \n"
                                . ' <option value="">--Select a option --</option>'
                                . '<?php foreach($rs' . ucwords($rs_name) . 's AS $' . $rs_name . '): ?> ' . " \n "
                                . ' <option value="<?php echo $' . $rs_name . '->' . $dependency->referenced_column_name . ';?>">'
                                . ' <?php echo $' . $rs_name . '->' . $rs_name . '; ?>'
                                . '</option>' . " \n"
                                . '<?php endforeach;?> ' . " \n"
                                . '</select>' . " \n";

                    endforeach;
                }else {
                    $element = '<input type="number" id="f_' . $field_name . '" name="f_'
                            . '' . $field_name . '" class="form-control" maxlength="' . $length . '" ' . $required . $value . ' />';
                }
                break;

            // textareas
            case 'text';
                $value_text = ($this->_form_rs != false) ? '<?php echo $rs->' . $field_name . ';?>' : '';
                $element = '<textarea id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control">' . $value_text . '</textarea>';
                break;
            // checkbox
            case 'tinyint';
                // if is boolean (tinyint 1)
                if ($length == 1) {
                    $element = '<input type="radio" id="f_' . $field_name . '" name="f_'
                            . '' . $field_name . '" class="radio_inline" value="1">Yes';
                    $element .= ' <input type="radio" id="f_' . $field_name . '" name="f_'
                            . '' . $field_name . '" class="radio_inline" value="0">No';
                    break;
                }

            // inputs type text
            case 'decimal';

                $element = '<input type="number" step="0.01" id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control"  maxlength="' . $length . '" ' . $required . $value . '  />';
                break;
        }
        array_push($this->_form_tags, $label . $divput . $element . "\n </div> \n </div>");
    }

    /**
     * -------------------------------------------------------------------------
     * Create a form 
     * -------------------------------------------------------------------------
     */
    public function createKeranaForm()
    {
        $this->_initKeranaForm();

        // form elements
        $form_elements = '';
        foreach ($this->_form_tags AS $v):
            $form_elements .= "<div class='form-group form-group-sm'> \n"
                    . "" . $v . " \n"
                    . "</div> \n";
        endforeach;

        // inject the code
        $code_to_inject = [
            '[{title}]' => $this->_form_module . '/' . $this->_form_controller . '/' . $this->_form_title,
            '[{url_save}]' => __URL__ . '/' . $this->_form_module . '/' . $this->_form_controller . '/' . $this->_form_action,
            '[{url_goback}]' => __URL__ . '/' . $this->_form_module . '/' . $this->_form_controller . '/index',
            '[{form}]' => $form_elements
        ];

        // create the form view.
        fopen($this->_form_path_file . '/' . $this->_form_file . '.php', 'w');

        // inject the code 
        $formadd_code_content = strtr($this->_form_template_content, $code_to_inject);
        file_put_contents($this->_form_path_file . '/' . $this->_form_file . '.php', $formadd_code_content);
    }

    /**
     * -------------------------------------------------------------------------
     * Setup kerana form
     * -------------------------------------------------------------------------
     */
    private function _initKeranaForm()
    {


        $this->_form_module = (!isset($this->_form_module) AND empty($this->_form_module)) ?
                \helpers\Url::getModule() : $this->_form_module;
        $this->_form_controller = (!isset($this->_form_controller) AND empty($this->_form_controller)) ?
                \helpers\Url::getController() : $this->_form_controller;

        $this->_loadTemplateForm();
        $this->_extractModelFields();
    }

    /**
     * -------------------------------------------------------------------------
     * Load the template form content
     * -------------------------------------------------------------------------
     */
    private function _loadTemplateForm()
    {
        // template form file
        $tpl_form = realpath(__DOCUMENTROOT__ . '/../templates/creator/view/tpl_form.ker');
        $this->_form_template_content = file_get_contents($tpl_form);
    }

}

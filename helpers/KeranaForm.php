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

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : '';

/**
 * -----------------------------------------------------------------------------
 * KeranaForm Class
 * -----------------------------------------------------------------------------
 * Creates forms from a mysql structure table.
 */
class KeranaForm
{

    public
    /** @array, contains the form elements  */
            $form_elements = [];
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
            $_form_file;

    public function __construct(\kerana\Ada $objectTable)
    {
        $this->_object_table = $objectTable;
    }

    /**
     * -------------------------------------------------------------------------
     * Set the form type to create
     * -------------------------------------------------------------------------
     * @param type $type
     */
    public function setFormType($type)
    {
        $this->_form_type = \helpers\Validator::int($type);

        switch ($this->_form_type) {

            // new record form
            case 1;
                $this->_form_title = 'New record';
                $this->_form_action = 'save';
                $this->_form_file = 'add';
                break;

            // edit record form
            case 2;
                $this->_form_title = 'Edit record';
                $this->_form_action = 'update';
                $this->_form_file = 'edit';
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
            ($desc->Key != 'PRI') ? $this->parseField($desc->Field, $field_type, $field_lenght, $desc->Null) : '';
        endforeach;
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
    private function parseField($field_name, $field_type, $length = '', $null = 'NO', $rs = false)
    {

        $label = "<label for='f_$field_name' class='col-sm-2 control-label'>$field_name</label> \n";
        $divput = "<div class='col-sm-6'> \n <div class='input-group col-sm-8'> \n";
        $required = ($null == 'NO') ? 'required' : '';
        $value = ($rs != false) ? "value='" . $rs->$field_name . "'" : '';

        switch ($field_type) {

            // inputs type text
            case 'varchar';
                $element = '<input type="text" id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control" maxlength="' . $length . '" ' . $required . $value . '  />';
                break;

            // inputs type number
            case 'int';
                $element = '<input type="number" id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control" maxlength="' . $length . '" ' . $required . $value . ' />';
                break;

            // textareas
            case 'text';
                $element = '<textarea id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control">' . $value . '</textarea>';
                break;
        }
        array_push($this->form_elements, $label . $divput . $element . "\n </div> \n </div>");
    }

    
    /**
     * -------------------------------------------------------------------------
     * Create a form 
     * -------------------------------------------------------------------------
     */
    public function createKeranaForm()
    {

        $this->_extractModelFields();

        // get the current controller and module
        $controller = \helpers\Url::getController();
        $module = \helpers\Url::getModule();

        // template form file
        $tpl_form = realpath(__DOCUMENTROOT__ . '/../templates/creator/view/tpl_form_add.ker');

        // path to save the new form
        $path_form_file = realpath(__MODULEFOLDER__ . '/' . $module . '/view/'.$controller.'s/');

        // load the form template
        $tpl_form_content = file_get_contents($tpl_form);

        // form elements
        $form_elements = '';
        foreach ($this->form_elements AS $v):
            $form_elements .= "<div class='form-group form-group-sm'> \n"
                    . "" . $v . " \n"
                    . "</div> \n";
        endforeach;

        // inject the code
        $code_to_inject = [
            '[{title}]' => $module . '/'.$this->_form_title,
            '[{url_save}]' => __URL__ . '/' . $module . '/' . $controller . '/'.$this->_form_action,
            '[{url_goback}]' => __URL__ . '/' . $module . '/' . $controller . '/index',
            '[{form}]' => $form_elements
        ];

        // create the form view.
        fopen($path_form_file . '/'.$this->_form_file.'.php', 'w');

        // inject the code 
        $formadd_code_content = strtr($tpl_form_content, $code_to_inject);
        file_put_contents($path_form_file . '/'.$this->_form_file.'.php', $formadd_code_content);
    }

}

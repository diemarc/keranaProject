<?php

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
            $_object_table;
           

    public function __construct(\kerana\Ada $objectTable)
    {
        $this->_object_table = $objectTable;
    }

    /**
     * -------------------------------------------------------------------------
     * Describe the table and for each field create a form element
     * -------------------------------------------------------------------------
     */
    public function createForm()
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
     * Parsea los campos de la tabla a campos de form html
     * -------------------------------------------------------------------------
     * @param type $field_name
     * @param type $field_type
     * @param type $length
     * @return type
     */
    public function parseField($field_name, $field_type, $length = '', $null = 'NO')
    {

        $label = "<label for='f_$field_name' class='col-sm-2 control-label'>$field_name</label> \n";
        $divput = "<div class='col-sm-6'> \n <div class='input-group col-sm-8'> \n";
        $required = ($null == 'NO') ? 'required' : '';
        switch ($field_type) {
            
            // inputs type text
            case 'varchar';
                $element = '<input type="text" id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control" maxlength="' . $length . '" ' . $required . ' />';
                break;
            
            // inputs type number
            case 'int';
                $element = '<input type="number" id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control" maxlength="' . $length . '" ' . $required . ' />';
                break;
            
            // textareas
            case 'text';
                $element = '<textarea id="f_' . $field_name . '" name="f_'
                        . '' . $field_name . '" class="form-control"></textarea>';
                break;
            
           
        }
         array_push($this->form_elements,$label.$divput.$element."\n </div> \n </div>");
    }
    
    
    public function validateForm(){
        
    }

}

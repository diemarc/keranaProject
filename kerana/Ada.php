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
  | Abstract model class
  |--------------------------------------------------------------------------
  | Abtraction layer for a mysql database
  | Uses a PDO implementation
  | With singleton conection to a db mysql
 */

abstract class Ada
{

    protected
    /** @object singleton instance of conection to db */
            $_db,
            /** @var mixed , table fields */
            $_fields,
            /** @var mixed, field values */
            $_values,
            /** @array , query conditions */
            $_conditions,
            /** @array, binds for prepare statetment */
            $_binds;
    public
    /** @var mixed, el nombre de la tabla */
            $table_name,
            /** @mixed , el indice de la tabla */
            $table_id,
            /**  @mixed, el valor del indice */
            $_id_value,
            /**  @mixed, la query */
            $_query,
            /** @mixed, table pks */
            $pks;
    private
            $_config;

    public function __construct()
    {
        $this->_db = \kerana\Epdo::singleton();
        $this->_config = \kerana\Configuration::singleton();
    }

    /*
      |=========================================================================
      | SETTERs, y auxiliares
      |=========================================================================
      |
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Set the PK value of the table
     * -------------------------------------------------------------------------
     * By default, all the primary key of table is int
     * @param type $id_key , table pk
     * @param type $validate , if is false not validate like INT
     * @throws \Exception
     */
    public function _setIdTableValue($id_key, $validate = true)
    {
        if (!empty($id_key)) {
            $this->_id_value = ($validate) ?
                    (filter_var($id_key, FILTER_VALIDATE_INT) == false) ?
                            \kerana\Exceptions::showError('Incorrect value type', 'INT type is required') : $id_key : $id_key;
        } else {
            throw new \Exception('id_key is empty!');
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Set the query to run
     * -------------------------------------------------------------------------
     * @param type $query
     */
    public function _setQuery($query)
    {
        if (!empty($query)) {
            $this->_query = $query;
        } else {
            throw New Exception('Query is empty!');
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Prepara un array con formato para actualizar en mysql
     * -------------------------------------------------------------------------
     * @param type $array
     */
    private function _setFieldsToUpdateByArray($array)
    {

        $this->_fields = '';
        foreach ($array as $f => $v) {
            if ($this->_fields != '') {
                $this->_fields .= ', ';
            }
            $this->_fields .= $f . ' = :' . $f . '';
            $this->_binds[':' . $f] = $v;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Setea los campos y binds  a insertar desde un array
     * -------------------------------------------------------------------------
     * @param type $array
     *      
     */
    private function _setFieldsToInsertByArray($array)
    {

        $this->_fields = '';
        foreach ($array AS $k => $v) {
            if ($this->_fields != '') {
                $this->_fields .= ', ';
                $this->_values .= ', ';
            }
            $this->_values .= ':' . $k;
            $this->_fields .= $k;
            $this->_binds[':' . $k] = $v;
        }

        $this->_fields = ' (' . $this->_fields . ') VALUES (' . $this->_values . ')';
    }

    /**
     * -------------------------------------------------------------------------
     * Parsea requests de formularios para insertar
     * -------------------------------------------------------------------------
     */
    private function _setFieldsToInsertByRequest()
    {

        $this->_fields = '';
        foreach ($_POST as $f => $v) {
            if ((substr($f, 0, 2) == 'f_')) {
                if ($this->_fields != '') {
                    $this->_fields .= ', ';
                    $this->_values .= ', ';
                }
                $this->_fields .= substr($f, 2);
                $this->_values .= ':' . $f;
                $this->_binds[':' . $f] = filter_var($v, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        $this->_fields = '(' . $this->_fields . ') VALUES (' . $this->_values . ')';
    }

    /**
     * -------------------------------------------------------------------------
     * Prepara los post de un formulario para actualizar una tabla
     * -------------------------------------------------------------------------
     * @return string
     */
    private function _setFieldToUpdateByRequest()
    {

        $this->_fields = '';
        foreach ($_POST as $f => $v) {
            if ($v != '') {
                if ((substr($f, 0, 2) == 'f_') OR ( substr($f, 0, 2) == 'd_')) {
                    if ($this->_fields != '') {
                        $this->_fields .= ', ';
                    }
                    $this->_fields .= substr($f, 2) . ' = :' . substr($f, 2);
                    $this->_binds[':' . substr($f, 2)] = filter_var($v, FILTER_SANITIZE_STRING);
                }
            }
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Forma las sentencias wheres para una query
     * -------------------------------------------------------------------------
     * @param array $conditions 
     */
    public function _setConditions($conditions)
    {
        if (is_array($conditions)):
            foreach ($conditions AS $field => $search) :
                $this->_query .= ' AND ' . $field . ' = :' . $field . '';
                $this->_binds[':' . $field] = $search;
            endforeach;
        endif;
    }

    /*
      |=========================================================================
      | SELECTS
      |=========================================================================
      |
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Prepara y ejecuta una consulta, preparada para operaciones, de insert,
     * update, sp, operaciones que no devuelvan resultados.
     * -------------------------------------------------------------------------
     * @return type
     */
    public function runQuery()
    {
        try {
            $rs = $this->_db->prepare($this->_query);
            $rs->execute($this->_binds);
            return true;
        } catch (\PDOException $e) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($e), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Prepara una consulta y devuelve el resultado
     * -------------------------------------------------------------------------
     * @param type $get_mode
     * @return boolean 
     */
    public function getQuery($get_mode = 'all')
    {

        try {
            $rs = $this->_db->prepare($this->_query);
            $rs->execute($this->_binds);


            switch ($get_mode) {
                case 'all':
                    return $rs->fetchAll();

                case 'one':
                    $result = $rs->fetch(\PDO::FETCH_OBJ);
                    return $result;

                case 'onecheck':
                    $result = $rs->fetch(\PDO::FETCH_OBJ);
                    return (is_object($result)) ? $result : \kerana\Exceptions::showError('ooPs', 'No record found!!');

                case 'count':
                    return $rs->rowCount();
            }
        } catch (\PDOException $e) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($e), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Find a row from a $_query, or from  base table
     * -------------------------------------------------------------------------
     * @param string $fields , fields to select, default: *
     * @param string $conditions , where conditions 
     * @param string $mode , 
     * @return rs
     */
    public function find($fields = '*', $conditions = false, $mode = 'one')
    {

        $this->_fields = $fields;

        // if not _query is not setted, then use the base table
        if (!isset($this->_query) AND empty($this->_query)) {
            $this->_query = 'SELECT ' . $this->_fields
                    . ' FROM ' . $this->table_name
                    . ' WHERE ' . $this->table_id . ' IS NOT NULL ';
        } else {
            $this->_query = ' SELECT A.* FROM (' . $this->_query . ') A '
                    . ' WHERE 1=1 ';
        }
        //  parse each conditions
        $this->_setConditions($conditions);
        return $this->getQuery($mode);
    }

    /**
     * -------------------------------------------------------------------------
     * Selecciona un registro por el indice de la tabla
     * -------------------------------------------------------------------------
     * @param type $check , si es 1 verifica que el registro exista y devuelve
     * un kerana::exception
     * @return type
     */
    public function getRecord($check = true)
    {
        if (isset($this->_id_value) AND ( !empty($this->_id_value))) {

            // if not _query is not setted, then use the base table
            if (!isset($this->_query) AND empty($this->_query)) {
                $this->_query = ' SELECT * FROM  ' . $this->table_name
                        . ' WHERE ' . $this->table_id . ' = :id_key LIMIT 1';
            } else {
                $this->_query = ' SELECT A.* FROM (' . $this->_query . ') A '
                        . ' WHERE A.' . $this->table_id . ' = :id_key LIMIT 1 ';
            }

            $this->_binds[':id_key'] = $this->_id_value;
            $result = $this->getQuery('one');
            if ($check) {
                return ($result) ? $result : Exceptions::showError('NoRecordFound', 'There is nothing here');
            } else {
                return $result;
            }
        } else {
            $error = ' ' . $this->table_id . ' IS NULL ';
            Exceptions::showError('Error en ' . __CLASS__ . ' metodo: ' . __FUNCTION__, $error);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Selecciona todos los registros de una tabla
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getAll($order_by = '')
    {
        $order = (empty($order_by)) ? $this->table_id . ' DESC ' : $order_by;
        if (!isset($this->_query) AND empty($this->_query)) {
            $this->_query = ' SELECT * FROM ' . $this->table_name
                    . ' WHERE ' . $this->table_id . ' IS NOT NULL '
                    . ' ORDER BY :order DESC ';
        }else{
             $this->_query = ' SELECT A.* FROM (' . $this->_query . ') A '
                        . ' WHERE A.' . $this->table_id . ' IS NOT NULL'
                     . ' ORDER BY :order DESC ';
        }

        $this->_binds[':order'] = $order;
        return $this->getQuery();
    }

    /*
      |=========================================================================
      | INSERTS,UPDATES
      |=========================================================================
      |
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Si esta seteado el valor de id_tabla, entonces update, sino insert,
     * por defecto comprobara un token CSRF  a no ser que se especificque
     * false a $csrf_protected
     * -------------------------------------------------------------------------
     * @param type $array contiene los datos a insertar/update si es vacio, procesa
     * los post
     * @param boolean $csrf_protected , verificacion de token 
     */
    public function save($array = '', $csrf_protected = true)
    {
        ($csrf_protected) ? \helpers\Security::csrfCheckToken() : '';
        return (!isset($this->_id_value)) ? $this->insert($array) : $this->update($array);
    }

    /**
     * -------------------------------------------------------------------------
     * Inserta registros que pueden venir desde un input_post, que origina un
     * formulario o un array asociativo
     * -------------------------------------------------------------------------
     * @param array $array opcional que contiene los campos con sus valores
     *  a insertar
     * Si se inserta correctamente aisgna a id_table value el nuevo id_insertado
     */
    public function insert($array = '')
    {

        // vaciamos los binds instanciados previamente
        unset($this->_binds);

        (!empty($array)) ? $this->_setFieldsToInsertByArray($array) : $this->_setFieldsToInsertByRequest();

        $this->_query = 'INSERT INTO ' . $this->table_name . $this->_fields;

        try {
            $rs = $this->_db->prepare($this->_query);
            $rs->execute($this->_binds);
            $this->_id_value = $this->_db->lastInsertId();
            return true;
        } catch (\PDOException $e) {
            $error = 'Error in' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($e), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Actualiza un registro
     * -------------------------------------------------------------------------
     * @param type $array
     */
    public function update($array = '')
    {

        (!empty($array)) ? $this->_setFieldsToUpdateByArray($array) : $this->_setFieldToUpdateByRequest();

        $this->_query = 'UPDATE ' . $this->table_name . ' SET ' . $this->_fields
                . ' WHERE ' . $this->table_id . ' = :id_table ';

        $this->_binds[':id_table'] = $this->_id_value;
        return $this->runQuery();
    }

    /**
     * -------------------------------------------------------------------------
     * Elimina un registro por su llave
     * -------------------------------------------------------------------------
     * @param type $conditions
     * @param type $limit
     * @return type
     */
    public function delete()
    {
        try {
            $this->_query = ' DELETE FROM ' . $this->table_name
                    . ' WHERE ' . $this->table_id . '= :id_key LIMIT 1 ';

            $this->_binds = [
                ':id_key' => $this->_id_value
            ];
            return $this->runQuery();
        } catch (\Exception $ex) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($ex), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Remove records with a criteria
     * -------------------------------------------------------------------------
     * @param array $conditions to apply to delete steatment
     * @return boolean
     */
    public function remove($conditions)
    {

        try {
            $this->_query = ' DELETE FROM ' . $this->table_name
                    . ' WHERE ' . $this->table_id . ' IS NOT NULL ';

            $this->_setConditions($conditions);
            return $this->runQuery();
        } catch (\Exception $ex) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($ex), $this->_query, $this->_binds);
        }
    }

    /*
      |--------------------------------------------------------------------------
      | SCHEMA.INFORMATION METHODS
      |--------------------------------------------------------------------------
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Get all tables from a database
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getTablesDB()
    {

        $this->_query = ' SELECT table_name FROM information_schema.tables'
                . ' WHERE table_schema = :schema ';

        try {
            $rs = $this->_db->prepare($this->_query);
            $rs->execute(['schema' => $this->_config->get('_dbname_')]);
            return $rs->fetchAll();
        } catch (\PDOException $e) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($e), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Get the table primary key index 1
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getPrimaryKeyTable($table_name = '')
    {
        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_query = 'SHOW KEYS FROM ' . $table . ' WHERE key_name = "Primary" '
                . 'AND seq_in_index = 1';
        $rs = $this->getQuery('one');
        return $rs->Column_name;
    }

    /**
     * -------------------------------------------------------------------------
     * Get all primary keys for a table
     * -------------------------------------------------------------------------
     * @param type $table_name
     * @return type
     */
    public function getAllTableKeys($table_name = '', $where = 'Primary')
    {
        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_query = 'SHOW INDEX FROM ' . $table;

        $this->_query .= (!empty($where) AND $where == 'Primary') ? ' WHERE key_name = "Primary" ' : '';
        return $this->getQuery();
    }

    /**
     * -------------------------------------------------------------------------
     * Get all tables referenced for a table
     * -------------------------------------------------------------------------
     * @param type $table_name
     * @return type
     */
    public function getTablesReferences($table_name = '')
    {
        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_query = 'SELECT table_name,column_name,constraint_name, '
                . ' referenced_table_name,referenced_column_name '
                . ' FROM '
                . ' INFORMATION_SCHEMA.KEY_COLUMN_USAGE '
                . ' WHERE referenced_table_name = :table ';

        $this->_binds = null;
        $this->_binds[':table'] = $table;

        return $this->getQuery();
    }

    /**
     * -------------------------------------------------------------------------
     * Describe a table
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function descTable($table_name = '')
    {

        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->_query = ' DESC ' . $table;

        try {
            $rs = $this->_db->prepare($this->_query);
            $rs->execute();
            return $rs->fetchAll();
        } catch (\PDOException $e) {
            $error = 'Error en ' . __CLASS__ . '->' . __FUNCTION__;
            \kerana\Exceptions::ShowException($error, New \Exception($e), $this->_query, $this->_binds);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Get table information
     * -------------------------------------------------------------------------
     * @param type $table_name
     * @return type
     */
    public function getTableStatus($table_name = '')
    {
        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_query = ' SHOW TABLE STATUS FROM ' . $this->_config->get('_dbname_')
                . ' WHERE NAME = :table ';

        $this->_binds = null;
        $this->_binds[':table'] = $table;

        return $this->getQuery('one');
    }

    /**
     * -------------------------------------------------------------------------
     * Get table dependencys, 
     * -------------------------------------------------------------------------
     * @param string $table_name the table
     * @param string $field_name table_name column to scan in with table has
     * dependency
     * @return rs
     */
    public function getTableDependencys($table_name = '', $field_name = '', $table_uniques = false)
    {
        $this->_binds = null;

        $table = (empty($table_name)) ? $this->table_name : filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_query = ' SELECT A.table_name,A.column_name,A.referenced_table_name,'
                . ' A.referenced_column_name,'
                . ' B.model,D.module,B.id_model'
                . ' FROM information_schema.key_column_usage A '
                . ' LEFT JOIN ' . $this->_config->get('_dbname_') . '.sys_models B ON (A.referenced_table_name = B.table_reference)'
                . ' LEFT JOIN ' . $this->_config->get('_dbname_') . '.sys_models_controllers C ON (B.id_model = C.id_model)'
                . ' LEFT JOIN ' . $this->_config->get('_dbname_') . '.sys_modules D ON (C.id_module = D.id_module)'
                . ' WHERE A.table_name = :table '
                . ' AND A.referenced_table_name IS NOT NULL ';

        if (!empty($field_name)) {
            $this->_query .= ' AND A.column_name = :field_name ';
            $this->_binds[':field_name'] = filter_var($field_name, FILTER_SANITIZE_STRING);
        }
        if ($table_uniques) {
            $this->_query .= ' GROUP BY A.referenced_table_name';
        }
        $this->_binds[':table'] = $table;

        return $this->getQuery();
    }

}

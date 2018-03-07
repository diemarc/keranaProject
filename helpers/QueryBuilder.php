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
 * QueryBuilder
 * ------------------------------------------------------------------------------
 * build a query based on schema information about fields, constraints
 * @author diemarc
 */
class QueryBuilder
{

    protected

    /** @object mixed, object DI */
            $_object_table,
            /** @var string table primary for build a query */
            $_table_to_build,
            /** @var mixed, joins involved in a master query */
            $_joins,
            /** @var mixed, fields for a master query */
            $_query_fields,
            /** @var mixed the master query formed */
            $_master_query;

    public function __construct(\kerana\Ada $object_table)
    {
        $this->_object_table = $object_table;
        // $this->buildMasterQuery();
    }

    /**
     * -------------------------------------------------------------------------
     * Set the table 
     * -------------------------------------------------------------------------
     * @param type $table
     */
    public function setTable($table)
    {
        $this->_table_to_build = filter_var($table, FILTER_SANITIZE_STRING);
    }

    /**
     * -------------------------------------------------------------------------
     * Get the masterquery
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getQuery()
    {
        return $this->_master_query;
    }

    /**
     * -------------------------------------------------------------------------
     * build a master query
     * -------------------------------------------------------------------------
     */
    public function buildMasterQuery()
    {

        // counter for alias tables based in alpha ranges
        $i = 0;

        // $alphas for alias for each table
        $alphas = range('A', 'Z');

        // alpha for primary table
        $alpha_primary = $alphas[$i];

        // get all field for the primary table
        $this->_parseFieldsTable($this->_table_to_build, $alpha_primary);

        // get dependencys for the primary table only unique table,
        // differents field associated to the primary table is ignored
        $rsDependencys = $this->_object_table->getTableDependencys($this->_table_to_build, '', true);

        foreach ($rsDependencys AS $dependency):
            $i++;

            // get fields only if not a primary key for the table dependency
            // send the alias to use in this first level dependency
            $this->_parseFieldsTable($dependency->referenced_table_name, $alphas[$i], true);

            // parse the first level joins
            $this->_joins .="\n .'" . ' INNER JOIN ' .
                    $dependency->referenced_table_name . ' ' . $alphas[$i] .
                    ' ON (' . $alphas[$i] . '.' . $dependency->referenced_column_name . ' = A.'
                    . $dependency->column_name . ')' . " ' \n";

            // parse the down levels joins 
            
            $this->_parseInnerJoinsTablesDependencys($dependency->referenced_table_name, $alphas[$i], $i);

        endforeach;

        $sql_fields = "'" . ' SELECT ' . $this->_query_fields . "' \n";
        $this->_master_query = $sql_fields . ".' FROM " . $this->_table_to_build . " " . $alpha_primary . " '"
                . $this->_joins . "\n .'". ' WHERE ' . $alpha_primary . '.'
                . $this->_object_table->getPrimaryKeyTable($this->_table_to_build) . ' IS NOT NULL ' . "'";
    }

    /**
     * -------------------------------------------------------------------------
     * Parse the inner joins
     * -------------------------------------------------------------------------
     * @param type $table
     * @param type $alias
     * @param type $i
     */
    private function _parseInnerJoinsTablesDependencys($table, $alias, $i)
    {
        
        $rsDependencys = $this->_object_table->getTableDependencys($table, '',true);
        if ($rsDependencys) {
            foreach ($rsDependencys AS $dep):
                $i++;
                $this->_parseFieldsTable($dep->referenced_table_name, $alias . $i, true);
                $this->_joins .=".'" . ' INNER JOIN ' . $dep->referenced_table_name . ' ' . $alias . $i . ''
                        . ' ON (' . $alias . $i . '.' . $dep->referenced_column_name . ' = ' . $alias .
                        '.' . $dep->column_name . ')' . " ' \n";
                $this->_parseInnerJoinsTablesDependencys($dep->referenced_table_name, $alias.$i, $i);

            endforeach;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * parse fields for master query of a table aplying alphas alias for each field
     * -------------------------------------------------------------------------
     * @param string $alpha alias to use for fields
     * @param boolean $restricted , if is true primary keys dont be parsed into 
     * fields array
     */
    private function _parseFieldsTable($table, $alpha, $restricted = false)
    {
        // get table fields
        $rsTableFields = $this->_object_table->descTable($table);

        foreach ($rsTableFields AS $field):

            if ($restricted) {
                if ($field->Key == "PRI") {
                    continue;
                }
            }
            if ($this->_query_fields != '') {
                $this->_query_fields .= ',';
            }

            $this->_query_fields .= $alpha . '.' . $field->Field;

        endforeach;
    }

}

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
/**
 * -----------------------------------------------------------------------------
 * KeranaInterface
 * -----------------------------------------------------------------------------
 * Interface to be implemented in all controllers extended a kerana\Kerana 
 * @author diemarc
 */
interface KeranaInterface
{

    /**
     * -------------------------------------------------------------------------
     * Show a list of record
     * -------------------------------------------------------------------------
     */
    public function index();
    
    /**
     * -------------------------------------------------------------------------
     * Show a viewForm to add new record
     * -------------------------------------------------------------------------
     */
    public function add();
    
    
    /**
     * -------------------------------------------------------------------------
     * Save a new record 
     * -------------------------------------------------------------------------
     */
    public function save();
    
    
    /**
     * -------------------------------------------------------------------------
     * Show a record detail
     * -------------------------------------------------------------------------
     * @param int, id record to display detail
     */
    public function detail($id);
    
    /**
     * -------------------------------------------------------------------------
     * Edit a record 
     * -------------------------------------------------------------------------
     * @param int, id record to edit
     */
    
    public function edit($id);
    
    /**
     * -------------------------------------------------------------------------
     * Edit a record 
     * -------------------------------------------------------------------------
     * * @param int, id record to update
     */
    public function update($id);
    
    
    /**
     * -------------------------------------------------------------------------
     * Delete a record 
     * -------------------------------------------------------------------------
     * * @param int, id record to delete
     */
    public function delete($id);
    
    
    
    
}

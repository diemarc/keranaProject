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

namespace application\modules\fac2fast\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * fac2fastController
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class F2fController extends \kerana\Kerana
{

    public
    /** @object , model fac2fast */
            $f2fModel;

    public function __construct()
    {
        parent::__construct();
        $this->f2fModel = new \application\modules\fac2fast\model\F2FModel();
    }

    public function index()
    {
        \kerana\View::showView($this->_current_module, 'f2f_welcome');
    }

    /**
     * -------------------------------------------------------------------------
     * Request to f2fmodel to change the current contratante (company)
     * -------------------------------------------------------------------------
     * @param int $id_contratante
     * @return type
     */
    public function changeCompany($id_contratante){
        
        $this->f2fModel->changeCurrentCompany($id_contratante);
        \helpers\Redirect::to('/fac2fast/f2f/index');
        
    }
    
}

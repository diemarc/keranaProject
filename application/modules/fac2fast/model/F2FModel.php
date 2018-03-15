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

namespace application\modules\fac2fast\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * Fac2FastModel
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class F2FModel extends \application\modules\configuracion\model\UserContratanteModel
{

    public

    /** @var array, list of all user contratantes */
            $f2f_contratantes_array = [];

    public function __construct()
    {
        parent::__construct();
        $this->checkAndGetAllContratantes2Fac();
    }

    /**
     * -------------------------------------------------------------------------
     * Prepare array for contratantes allowed to a user to do things
     * -------------------------------------------------------------------------
     */
    public function checkAndGetAllContratantes2Fac()
    {

        $this->set_id_user($_SESSION['id_user']);

        // get all contratantes user
        $rsContratantesUser = $this->getContratantesUser();

        // counter for contratantes user
        $num_contra = count($rsContratantesUser);

        // if logged user dosnt have any contratantes, then redirect to new contratante
        // form, for testing purpose for now, the scripts show kerana exception
        if ($num_contra == 0) {
            \kerana\Exceptions::showError('ContratanteUserError', 'no hay aso');
            die();
        }
        // if user have only one contratante, then create a session with this
        // contratante_id
        else if ($num_contra == 1) {
            $_SESSION['f2f_contratante'] = $rsContratantesUser[0]->id_contratante;
        }
        // if have grater tan 1, then create a array wit all the contratantes
        else {
            foreach ($rsContratantesUser AS $contra):
                array_push($this->f2f_contratantes_array, $contra->id_contratante);
            endforeach;
           $_SESSION['f2f_contratantes_array'] = $this->f2f_contratantes_array; 
           
        }
    }

}

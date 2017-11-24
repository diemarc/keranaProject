<?php

namespace kerana;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * -----------------------------------------------------------------------------
 * Request
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class Request
{

    public
            $request_method;

    
    
    
    public function __construct()
    {

        $this->request_method = htmlspecialchars(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING));
        
        
        
        
    }
    
    
    

}

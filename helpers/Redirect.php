<?php
namespace helpers;
/**
 * Class Redirect
 *
 * Abstracion para redireccionar a una pagina de kerana
 */
class Redirect
{

    /**
     * -------------------------------------------------------------------------
     * Redirecciona a la url principal de kerana
     * -------------------------------------------------------------------------
     */
    public static function home()
    {
        header('location: ' . __URL__);
    }

    /**
     * -------------------------------------------------------------------------
     * Redirecciona a una url
     * -------------------------------------------------------------------------
     * @param type $path
     */
    public static function to($path)
    {
        header('location: ' . __URL__ . $path);
    }

}

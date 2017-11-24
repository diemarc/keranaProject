<?php

namespace application\modules\system\model;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : '';

/*
  |--------------------------------------------------------------------------
  | CLASE MODELO PARA USUARIOS
  |--------------------------------------------------------------------------
  |
 */

class UserModel extends \kerana\Ada
{

    public
    /** @var mixed , usuario de origen del post del form */
            $username,
            /** @var mixed , password de origen del post del form */
            $password;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_usuario';
        $this->table_id = 'id_usuario';
    }

    /**
     * -------------------------------------------------------------------------
     * Trae los datos de un username si esta activo
     * -------------------------------------------------------------------------
     */
    public function _checkAndGetUserActive()
    {

        return $this->find('id_usuario,nombres,apellidos,email,salt,password', [
                    'username' => $this->username,
                    'sw_activo' => 1
        ]);
    }

    /**
     * -------------------------------------------------------------------------
     * Genera un SALT y un password para un usuario y lo guarda en tabla
     * -------------------------------------------------------------------------
     * @return type
     */
    public function generatePasswordUser()
    {

        try {
            // generamos la sal aleatoriamente, 
            // reemplazamos byte por byte para ser compatible con utf8 al guardarlo
            // en tabla
            $salt_created = strtr(base64_encode(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)), '+', '.');

            // generamos la contraseña con la sal
            $password = password_hash("invent*497", PASSWORD_BCRYPT, ['salt' => $salt_created]);

            // actualizamos los datos del usuario
            return $this->save(
                            [
                                'password' => $password,
                                'salt' => $salt_created
                            ]
            );
        } catch (\Exception $ex) {
            \kerana\Exceptions::showError('Error de login', $ex);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Bloquea un usuario
     * -------------------------------------------------------------------------
     * @param type $id_usuario
     * @return type
     */
    public function blockUserAccount($id_usuario)
    {
        $this->_setIdTableValue($id_usuario);
        return $this->update(
                        [
                            'sw_activo' => 0
                        ]
        );
    }

}

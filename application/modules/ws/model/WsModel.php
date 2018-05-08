<?php

namespace application\modules\ws\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class GroupModel
  |-----------------------------------------------------------------------------
  |
  |
  | @author kerana,
  | @date 07-02-2018 05:40:57,
  |
 */

final class WsModel
{

    private
            $objUser;

    public function __construct()
    {
        $this->objUser = new \application\modules\system\model\UserModel();
    }

    public function getUser($id_user)
    {
        $this->objUser->_setIdTableValue($id_user);
        return $this->objUser->getRecord();
    }

}

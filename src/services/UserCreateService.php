<?php

namespace app\services;

use app\models\User;
use Yii;
use yii\base\Component;

class UserCreateService
{
    public function __construct()
    {
    }


    public function create(\app\models\Registration $model): User
    {

        $User = new User();
        $User->username = $model->username;
        $User->nickname = $model->nickname;
        $User->email = $model->email;
        $User->setPassword($model->password);
        $User->gender = $model->gender;
        $User->activateHash = md5($model->email);

        $User->activatedAt = null;
        /**
         * статус пользователя - не подтвержден
         */
        $User->status = 1;
        $User->role = User::ROLE_READER;

        return $User;
    }

}
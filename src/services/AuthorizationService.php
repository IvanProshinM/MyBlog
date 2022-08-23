<?php

namespace app\services;

use app\models\loginModel;
use app\models\User;


/**
 * @var loginModel $model;
 */

class AuthorizationService
{

    public function authorization(loginModel $model)
    {
        $user =User::find()
            ->where(['login'=>$model->login])
            ->one();
        if ($user && $model->password === $user->password) {
            return $user;
        }
        return null;
    }


}
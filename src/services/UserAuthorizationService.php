<?php


namespace app\services;

use app\models\Authorization;
use app\models\User;
use Yii;


class UserAuthorizationService
{
    public function authorizate(Authorization $model): ?User
    {
        $currentUser = User::find()
            ->where(['email' => $model->email])
            ->one();
        if ($currentUser && ($currentUser->validatePassword($model->password))) {
            return $currentUser;
        }
        return null;

    }
}
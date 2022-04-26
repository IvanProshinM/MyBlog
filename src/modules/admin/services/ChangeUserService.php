<?php

namespace app\modules\admin\services;

use app\models\User;
use app\modules\admin\models\ChangeUser;
use Yii;
use yii\base\Component;

class ChangeUserService
{
    public function __construct()
    {
    }


    public function change(ChangeUser $model, User $user): User
    {

        $User = $user;
        $User->username = $model->username;
        $User->nickname = $model->nickname;
        $User->email = $model->email;

        if ($model->password !== '') {
            $User->setPassword($model->password);
        } else {
            $User->password = $user->password;
        }

        $User->gender = $model->gender;/*
        $User->activateHash = Yii::$app->security->generatePasswordHash($model->email);
        $User->activatedAt = date("F j, Y, g:i a");*/
        $User->role = $model->role;
        $User->status = $model->status;

        return $User;
    }

}
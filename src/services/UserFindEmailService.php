<?php

namespace app\services;

use app\models\Registration;
use app\models\User;

class UserFindEmailService
{
    public function findMail(Registration $model)
    {
        $user = User::find()
            ->where(['email' => $model->email])
            ->one();
        if ($user) {
            return true;
        } else
        {
        return false;
        }
    }
}
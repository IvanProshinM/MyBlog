<?php

namespace app\modules\api\services;

use app\models\User;

class CreateUserService
{

    public function CreateUser($model)
    {
        $uniqueUser = User::find()
            ->where(['phone' => $model->phone])
            ->one();
        if (!$uniqueUser) {
            /* $user->auth_key = md5($user->first_name);
             $user->password_hash = md5($user->middle_name);*/
            /*$user->phone = $model->phone;*/
            $user = new User();
            $user->sms_code_confirm = 1111;
            $user->sms_code_confirm = (string)$user->sms_code_confirm;
            $user->save();
            return $user;
        }
        $uniqueUser->phone = $model->phone;
        $uniqueUser->sms_code_confirm = 1111;
        $uniqueUser->save();
        return $uniqueUser;
    }

}
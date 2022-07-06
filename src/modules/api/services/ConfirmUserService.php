<?php

namespace app\modules\api\services;

use app\models\User;

class ConfirmUserService
{
    public function ConfirmUser($model)
    {
        $user = User::find()->where(['phone' => $model->phone])->one();
        if ($user === null) {
            return null;
        }
        $user_auth = User::find()->where(['sms_code_confirm' => $model->sms_code_confirm])->one();
        if ($user_auth) {
            $user_auth->auth_key = md5($model->sms_code_confirm);
            $user_auth->first_name = $model->first_name;
            $user_auth->middle_name = $model->middle_name;
            $user_auth->last_name = $model->last_name;
            $user_auth->gender = $model->gender;
            $user_auth->birthday = $model->birthday;
            $user_auth->save();
            return $user_auth;
        } else {
            return null;
        }
    }
}
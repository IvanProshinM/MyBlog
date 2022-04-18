<?php

namespace app\services;

use app\models\User;

class UserRegistrationNotification
{
    public function send(User $user) :void
    {
        \Yii::$app->mailer->compose('registrationLink.php', ['user'=>$user])
            ->setFrom('proshinvanivanoff@yandex.ru')
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации')
            ->send();
    }

}


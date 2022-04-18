<?php


namespace app\services;

use app\models\ChangePassword;
use yii\web\Controller;
use app\models\Recover;
use app\models\User;
use Yii;


class UserRecoverPasswordService
{
    public function reset(Recover $model)
    {
        $session = Yii::$app->session;
        $user = User::find()
            ->where(['email' => $model->email])
            ->one();
        if ($user) {
            $user->resetHash = ($user->activateHash) . (Yii::$app->security->generatePasswordHash($user->email));
            $user->save();
            Yii::$app->mailer->compose('resetLink', ['user' => $user])
                ->setFrom('proshinvanivanoff@yandex.ru')
                ->setTo($user->email)
                ->setSubject('Сброс пароля')
                ->send();
            $session->setFlash('Success', 'Ссылка для сброса пароля отправлена на почту');
            return true;
        } else {
            return false;
        }
    }

    public function changePassword(ChangePassword $model, $resetHash) : User
    {
        $user = User::find()
            ->where(['resetHash' => $resetHash])
            ->one();
        $user->password = Yii::$app->security->generatePasswordHash($model->password) ;
        $user->resetHash = null;
        return $user;
    }
}
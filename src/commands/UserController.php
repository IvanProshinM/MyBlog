<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;


class UserController extends Controller
{
    public function actionChange($attribute)
    {
        $user = User::find()
            ->where(['nickname' => $attribute])
            ->one();
        if (!$user) {
            echo "Возникла проблема!\n";
            return 1;
        }
        $user->role = 2;
        $user->save();
        return 0;
    }
}

<?php

namespace app\components;

use yii\filters\AccessRule;
use app\models\User;

class AccessRuleAdmin extends AccessRule
{
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        return (int)$user->identity->role === User::ROLE_ADMIN;
    }
}
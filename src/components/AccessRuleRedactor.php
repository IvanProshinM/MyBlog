<?php

namespace app\components;

use yii\filters\AccessRule;
use app\models\User;

class AccessRuleRedactor extends AccessRule
{
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        return (int)$user->identity->role === User::ROLE_ADMIN || (int)$user->identity->role === User::ROLE_REDACTOR;

    }
}
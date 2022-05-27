<?php

namespace app\modules\api;

use Yii;

/**
 * admin module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->user->loginUrl = '/auth/login';
    }
}

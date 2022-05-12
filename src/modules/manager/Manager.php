<?php


namespace app\modules\manager;

use Yii;


class Manager extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\manager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->user->loginUrl = '/auth/authorization';
        /*Yii::$app->user->loginUrl = '/auth/authorization';*/
    }
}

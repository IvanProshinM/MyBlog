<?php

namespace app\modules\api;

use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;

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

    private $exceptRoutes = [
        'user/sign-in',
        'user/confirm',

    ];


    public function init()
    {
        parent::init();
        Yii::configure($this, [
            'as contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'as authenticator' => [
                'class' => CompositeAuth::class,
                'except' => $this->exceptRoutes,
                'authMethods' => [
                    HttpBearerAuth::class,
                ]

            ],
            'as access' => [
                'class' => AccessControl::class,
                'except' => $this->exceptRoutes,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ]);
    }
}

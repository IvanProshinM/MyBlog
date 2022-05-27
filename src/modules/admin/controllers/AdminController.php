<?php

namespace app\modules\admin\controllers;


use app\components\AccessRuleAdmin;
use yii\filters\AccessControl;
use yii\web\Controller;



class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRuleAdmin::class,
                ],
                'rules' => [
                    [
                        'allow' => true,
                    ],
                ]
            ],
        ];
    }



    public function actionIndex()
    {


        return ($this->render('adminPage'));
    }



}
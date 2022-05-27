<?php

namespace app\modules\api\controllers;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class UserController extends Controller
{


    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userProvider = new ActiveDataProvider([
            'query'=>User::find()
        ]);
        $user = $userProvider->getModels();
        return $user;
    }

}
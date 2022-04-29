<?php

namespace app\modules\manager\controllers;

use app\modules\manager\models\PostCreate;
use yii\web\Controller;

class ManagerController extends Controller
{
    public function actionManager()
    {

    }

    public function actionManagerCreate()
    {
        $model = new PostCreate();
        return $this->render('PostCreate', ['model' => $model]);
    }


}








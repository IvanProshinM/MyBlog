<?php
namespace app\modules\api\controllers;

use Yii;

class CategoryController extends \yii\web\Controller
{

    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $categoryProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Category::find()
        ]);
        $category = $categoryProvider->getModels();
        return $category;
    }
}

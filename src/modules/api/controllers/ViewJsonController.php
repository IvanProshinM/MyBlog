<?php

namespace app\modules\api\controllers;


use app\models\Category;
use app\models\Post;
use app\models\User;
use app\modules\manager\models\PostProvider;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class ViewJsonController extends Controller
{

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchModel = new PostProvider();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $CategoryProvider = new ActiveDataProvider([
            'query' => Category::find()

        ]);

        $posts = [];
        foreach ($dataProvider->getModels() as $post) {
            $postCategories = [];
            foreach ($post->categories as $category) {
                $postCategories[] = [
                    'name' => $category->name,
                    'slug' => $category->slug,

                ];
            }
            $posts[] = [
                'id' => $post->id,
                'name' => $post->name,
                'categories' => $postCategories,

                'textShort' => $post->textShort,
                'slug' => $post->slug,
                'publicDate' => date('y.m.d', $post->publicDate)
            ];
        }
        /*
                $result = [
                    'posts' => $dataProvider->getModels(),
                    'categories' => $CategoryProvider->getModels()
                ];*/
        return $posts;
    }


    public function actionCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $categoryProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);
        $category = $categoryProvider->getModels();
        return $category;
    }

    public function actionUser() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userProvider = new ActiveDataProvider([
            'query'=>User::find()
        ]);
        $user = $userProvider->getModels();
        return $user;
    }


}
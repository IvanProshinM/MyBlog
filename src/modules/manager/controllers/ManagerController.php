<?php

namespace app\modules\manager\controllers;

use app\modules\manager\models\PostProvider;
use app\modules\admin\search\CategorySearch;
use app\modules\manager\models\PostCreate;
use app\modules\manager\services\CreatePostService;
use yii\web\Controller;

class ManagerController extends Controller
{

    /**
     * @var CreatePostService
     */
    private $createPostService;

    public function __construct(
        $id,
        $module,
        CreatePostService $createPostService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createPostService = $createPostService;
    }


    public function actionManager()
    {
        $searchModel = new PostProvider();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('PostList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }

    public function actionManagerCreate()
    {

        $model = new PostCreate();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $post = $this->createPostService->createPost($model);
            if ($post == null) {
                $session->setFlash('error', 'Пост с таким именем уже сущетсвует');
                return $this->render('PostCreate', ['model' => $model]);
            } else {
                $post->save();
                /*var_dump($post->errors);*/
                $session->setFlash('success', 'пост успешно создан');
                return $this->render('PostCreate', ['model' => $model]);
            }
        } else {
            $session->setFlash('error', 'Ошибка валидации');
            return $this->render('PostCreate', ['model' => $model]);
        }

    }

}








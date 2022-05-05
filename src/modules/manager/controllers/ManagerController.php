<?php

namespace app\modules\manager\controllers;

use app\models\Post;
use app\modules\manager\models\PostChange;
use app\modules\manager\models\PostProvider;
use app\modules\admin\search\CategorySearch;
use app\modules\manager\models\PostCreate;
use app\modules\manager\services\CreatePostService;
use app\modules\manager\services\PostChangeService;
use yii\web\Controller;

class ManagerController extends Controller
{

    /**
     * @var CreatePostService
     */
    private $createPostService;

    /**
     * @var PostChangeService;
     */

    public $postChangeService;

    public function __construct(
        $id,
        $module,
        CreatePostService $createPostService,
        PostChangeService $postChangeService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createPostService = $createPostService;
        $this->postChangeService = $postChangeService;
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
        $this->render('PostCreate', ['model' => $model]);;
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
            $this->render('PostCreate', ['model' => $model]);
            return $this->render('PostCreate', ['model' => $model]);
        }

    }

    public function actionPostChange($id)
    {
        $post = Post::find()
            ->where(['id' => $id])
            ->one();
        $model = new PostChange();
        $session = \Yii::$app->session;
        $model->load($post->attributes, '');
        if ($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isPost) {
            $uniquePost = Post::find()
                ->where(['name' => $model->name])
                ->one();
            if ($uniquePost) {
                $session->setFlash('error', 'Пост с таким именем существует');
                return $this->render('PostChange', ['model' => $model]);
            } else {
                $post = $this->postChangeService->PostChange($model);
                $post->save();
                $session->setFlash('success', 'Пост успешно изменен');
                $this->redirect('/manager/manager/manager');
            }
        }
        return $this->render('PostChange', ['model' => $model]);
    }

}








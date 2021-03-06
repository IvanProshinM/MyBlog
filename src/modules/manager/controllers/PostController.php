<?php

namespace app\modules\manager\controllers;

use app\components\AccessRuleRedactor;
use app\models\Category;
use app\models\Post;
use app\modules\manager\models\PostChange;
use app\modules\manager\models\PostProvider;
use app\modules\manager\models\PostCreate;
use app\modules\manager\services\CreatePostService;
use app\modules\manager\services\PostChangeService;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRuleRedactor::class,
                ],
                'rules' => [
                    [
                        'allow' => true,
                    ]
                ]
            ],
        ];
    }


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


    public function actionIndex()
    {
        $searchModel = new PostProvider();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('PostList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }

    public function actionCreate()
    {

        $model = new PostCreate();
        $session = \Yii::$app->session;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $post = $this->createPostService->createPost($model);
            if ($post == null) {
                $session->setFlash('error', '???????? ?? ?????????? ???????????? ?????? ????????????????????');
                return $this->render('PostCreate', ['model' => $model]);
            } else {
                $post->save();
                $session->setFlash('success', '???????? ?????????????? ????????????');
                return $this->render('PostCreate', ['model' => $model]);
            }
        }
        return $this->render('PostCreate', ['model' => $model]);


    }

    public function actionUpdate($id)
    {
        $post = Post::find()
            ->where(['id' => $id])
            ->one();
        $model = new PostChange();
        $session = \Yii::$app->session;
        $post->publicDate = \Yii::$app->formatter->format($post->publicDate, 'date');
        $model->load($post->attributes, '');
        $model->categoriesList = $post->getCategoriesListId();
        if ($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isPost) {
            $post = $this->postChangeService->PostChange($model, $post);
            $post->save();
            $session->setFlash('success', '???????? ?????????????? ??????????????');
            $this->redirect('/manager/post');
        }
        return $this->render('PostChange', ['model' => $model]);
    }

    public function actionPost($slug)
    {
        $session = \Yii::$app->session;
        $searchQuery = Category::find()
            ->where(['slug' => $slug])
            ->one();
        if (!$searchQuery) {
            $session->setFlash('error', '???????????? ?? ?????????? ???????????????????? ???? ????????????????????!');
            return $this->redirect('/post/post/post');
        } else {
            $postQuery = $searchQuery->getPost();
            $dataProvider = new ActiveDataProvider([
                'query' => $postQuery,
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);
            return $this->render('PostSearch', [
                    'searchModel' => $postQuery,
                    'dataProvider' => $dataProvider,
                ]

            );
        }
    }

}








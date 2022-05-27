<?php

namespace app\controllers;

use app\models\Category;
use app\models\Post;
use app\modules\manager\models\PostProvider;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionView($slug)
    {
        $model = Post::find()
            ->where(['slug' => $slug])
            ->one();
        return $this->render('PostView', ['model' => $model]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionIndex()
    {
        $searchModel = new PostProvider();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }

    public function actionCategory($slug)
    {
        $session = \Yii::$app->session;
        $currentDate = time();
        $searchQuery = Category::find()
            ->where(['slug' => $slug])
            ->one();
        if (!$searchQuery) {
            $session->setFlash('error', 'Постов с такой категорией не сущетсвует!');
            return $this->redirect('/');
        } else {
            $postQuery = $searchQuery->getPost()->where(['<=', 'publicDate', $currentDate]);
            $dataProvider = new ActiveDataProvider([
                'query' => $postQuery,
                'pagination' => [
                    'pageSize' => 3,
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

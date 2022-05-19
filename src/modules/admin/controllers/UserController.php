<?php

namespace app\modules\admin\controllers;
;

use app\components\AccessRuleAdmin;
use app\models\Category;
use app\models\User;
use app\modules\admin\models\ChangeUser;
use app\modules\admin\models\CreateCategory;
use app\modules\admin\models\UpdateCategory;
use app\modules\admin\services\ChangeUserService;
use app\modules\admin\services\FindCategoryService;
use app\modules\admin\search\CategorySearch;
use app\services\UserCreateService;
use app\services\UserRegistrationNotification;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use app\modules\admin\search\UserSearch;


class UserController extends Controller
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


    /**
     * @var ChangeUserService;
     */
    private $changeUserService;

    public function __construct(
        $id,
        $module,
        ChangeUserService $changeUserService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->changeUserService = $changeUserService;

    }


    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('UserPage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }

    public function actionUpdate($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();
        $session = Yii::$app->session;
        $model = new ChangeUser();
        $attributes = $user->attributes;
        unset($attributes['password']);
        $model->load($attributes, '');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            /*            var_dump($model);*/
            $user = $this->changeUserService->change($model, $user);
            $user->save();
            $session->setFlash('success', 'Данные пользоваетля успешно изменены');
            $this->redirect('/admin/user');
        }
        return $this->render('UserChange', ['model' => $model]);
    }

}
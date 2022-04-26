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


    /**
     * @var FindCategoryService;
     */
    private $categoryService;

    /**
     * @var ChangeUserService;
     */
    private $changeUserService;

    public function __construct(
        $id,
        $module,
        FindCategoryService $categoryService,
        ChangeUserService $changeUserService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryService = $categoryService;
        $this->changeUserService = $changeUserService;

    }


    public function actionAdminPage()
    {
        return ($this->render('adminPage'));
    }

    public function actionCategoryPage()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('CategoryPage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }


    public function actionCategoryCreate()
    {
        $model = new CreateCategory();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $Category = $this->categoryService->findCategory($model);
            if ($Category) {
                $Category = new Category();
                $Category->name = $model->name;
                $Category->save();
                $session->setFlash('success', 'Категория успешно добавлена');
                return $this->redirect(['/admin/admin/admin-page']);
            } else {
                $session->setFlash('error', 'Категория с таким именем уже существует');
                return $this->render('CategoryCreate', ['model' => $model]);
            }
        }
        return $this->render('CategoryCreate', ['model' => $model]);
    }

    public function actionUpdateCategory($id)
    {
        $Category = Category::find()
            ->where(['id' => $id])
            ->one();
        $model = new UpdateCategory();
        $session = Yii::$app->session;
        $model->load($Category->attributes, '');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            $UniqueCategory = Category::find()
                ->where(['name' => $model->name])
                ->one();
            if ($model->name === $UniqueCategory->name) {
                $session->setFlash('error', 'Категория с таким именем уже существует');
                return $this->render('CategoryUpdate', ['model' => $model]);
            } else {

                $Category->name = $model->name;
                $Category->save();
                $session->setFlash('success', 'Категория успешно изменена');
                return $this->redirect('/admin/admin/admin-page');
            }
        }

        return $this->render('CategoryUpdate', ['model' => $model]);
    }

    public function actionUserPage()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('UserPage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }

    public function actionChangeUser($id)
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
            $this->redirect('/admin/admin/user-page');
        }
        return $this->render('UserChange', ['model' => $model]);
    }

}
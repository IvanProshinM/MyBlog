<?php

namespace app\modules\admin\controllers;
;

use app\components\AccessRuleAdmin;
use app\models\Category;
use app\modules\admin\models\CreateCategory;
use app\modules\admin\models\UpdateCategory;
use app\modules\admin\services\FindCategoryService;
use app\modules\admin\search\CategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;


class CategoryController extends Controller
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


    public function __construct(
        $id,
        $module,
        FindCategoryService $categoryService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryService = $categoryService;

    }


    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('CategoryPage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));
    }


    public function actionCreate()
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
                return $this->redirect(['/admin/category']);
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
                return $this->redirect('/admin/category');
            }
        }

        return $this->render('CategoryUpdate', ['model' => $model]);
    }


}
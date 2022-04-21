<?php

namespace app\modules\admin\controllers;
;

use app\models\Category;
use app\modules\admin\models\CreateCategory;
use app\modules\admin\services\FindCategoryService;
use app\modules\admin\search\CategorySearch;
use app\services\UserRegistrationNotification;
use yii\web\Controller;
use Yii;

class AdminController extends Controller
{

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


    public function actionAdminPage()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('adminPage', [
            'searchModel' => $searchModel,
            'dataProvider' => $searchModel,
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
                return $this->render('CategoryCreate', ['model' => $model]);
            } else {
                $session->setFlash('error', 'Категория с таким именем уже существует');
                return $this->render('CategoryCreate', ['model' => $model]);
            }
        }
        return $this->render('CategoryCreate', ['model' => $model]);
    }


}
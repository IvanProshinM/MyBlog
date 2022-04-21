<?php

namespace app\modules\admin\services;

use app\models\Category;
use app\modules\admin\models\CreateCategory;

class FindCategoryService
{
    public function findCategory(CreateCategory $model)
    {
        $category = Category::find()
            ->where(['name' => $model->name])
            ->one();
        if ($category) {
            return false;
        } else {
            return true;
        }
    }
}
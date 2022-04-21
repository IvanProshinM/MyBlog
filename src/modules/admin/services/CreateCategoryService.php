<?php

namespace app\modules\admin\services;

use app\models\Category;
use app\models\CreateCategory;
use app\models\User;
use Yii;
use yii\base\Component;

class UserCreateService
{
    public function __construct()
    {
    }


    public function create(CreateCategory $model): Category
    {

        $User = new Category();

        $User->name = $model->name;

        return $User;
    }

}
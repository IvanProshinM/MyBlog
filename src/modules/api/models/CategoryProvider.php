<?php

namespace app\modules\api\models;

use app\models\Category;
use app\models\Post;
use yii\data\ActiveDataProvider;

class CategoryProvider extends Category
{

    public function search()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
    }


}


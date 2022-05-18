<?php

namespace app\modules\manager\models;

use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class PostProvider extends Post

{

    public function search($params)
    {
        $currentDate = time();
        $query = Post::find()
            ->where(['<=', 'publicDate', $currentDate]);
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
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}



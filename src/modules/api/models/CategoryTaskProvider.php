<?php

namespace app\modules\api\models;

use app\models\Task;
use yii\data\ActiveDataProvider;

class CategoryTaskProvider extends Task
{
    public function search($params)
    {
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $this->load($params, '');


        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->andFilterWhere(['order_id' => $this->order_id])->offset($params['offset'])->limit($params['limit'])
        ;

        return $dataProvider;
    }
}

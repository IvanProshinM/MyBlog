<?php

namespace app\modules\api\models;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderProvider extends Order
{
    public function search($params)
    {
        $query = Order::find();
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>false
        ]);
        $this->load($params, '');
/*        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['order_id'=>$this->order_id]);*/
        return $dataProvider;
    }
}
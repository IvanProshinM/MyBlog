<?php

namespace app\modules\api\services;

use app\models\Order;

class AcceptOrderService
{
    public function AcceptOrder($model, $user)
    {
        $order = Order::find()->where(['id' => $model->order_id])->one();
        if (!$order) {
            return null;
        }
        $order->status_id = Order::STATUS_TREATMENT;
        $order->doctor_id = $user->id;
        $order->save();
        return $order;
    }
}
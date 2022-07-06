<?php

namespace app\modules\api\services;


use app\models\Order;

class CreateOrderService
{

    public function CreateOrder($model, $user) : Order
    {
        $order = new Order();
        $order->temperature = (float) $model->temperature;
        $order->symptoms = $model->symptoms;
        $order->patient_id = $user->id;
        $order->save();

        return $order;
    }




}
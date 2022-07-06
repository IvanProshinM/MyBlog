<?php

namespace app\modules\api\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;

class OrderController extends Controller
{

    public $offset;
    public $limit;


    public function actionAll()
    {
        $order = [
            "order_id" => "100500",
            "first_name" => "Василий",
            "last_name" => "Пупкин",
            "middle_name" => "Петрович",
            "temperature" => "36.6",
            "symptoms" => "Болит голова, живот, нога, глаза",
            "status" => "new, treatment, discharged",
            "created_at" => "100500",
            "age" => "25",
            "latitude" => -45.62390335574153,
            "longitude" => -3.9551761173743847
        ];
        VarDumper::dump($order, 5, true);
    }


    public function actionNew($offset, $limit)
    {
        $order = [
            "order_id" => "100500",
            "first_name" => "Василий",
            "last_name" => "Пупкин",
            "middle_name" => "Петрович",
            "temperature" => "36.6",
            "symptoms" => "Болит голова, живот, нога, глаза",
            "status" => "new, treatment, discharged",
            "created_at" => "100500",
            "age" => "25",
            "latitude" => -45.62390335574153,
            "longitude" => -3.9551761173743847
        ];

        echo 'new';
    }

    public function actionCurrent($offset, $limit)
    {
        echo 'current';
    }

    public function actionDischarged($offset, $limit)
    {
        echo 'discharged';
    }

    public function actionCreate()
    {
        $create = [
            "temperature" => "37.6",
            "symptoms" => "Болит голова, живот, нога, глаза"
        ];
        echo $create["temperature"];
        echo $create["symptoms"];

    }

    public function actionAccept()
    {
        echo 'order_id:100500';
    }

    public function actionHomeCoordinates()
    {
        echo '"order_id": "100500",
           "latitude": 59.97192,
           "longitude": 30.324516';
    }

}
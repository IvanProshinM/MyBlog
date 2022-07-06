<?php

namespace app\modules\api\controllers;


use app\modules\api\models\CreateOrderModel;
use app\modules\api\services\CreateOrderService;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\VarDumper;
use yii\rest\Controller;

class OrderController extends Controller
{

    public $offset;
    public $limit;

    /**
     * @var CreateOrderService
     */
    private $createOrderService;


    public function __construct($id, $module,
                                CreateOrderService $createOrderService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createOrderService = $createOrderService;
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['update'];
        return $behaviors;
    }

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

        $model = new CreateOrderModel();
        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);
        if (!$model->validate()) {
            return null;
        }
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return null;
        }

        $order = $this->createOrderService->CreateOrder($model, $user);

        return [
            "temperature" => $order->temperature,
            "symptoms" => $order->symptoms
        ];
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
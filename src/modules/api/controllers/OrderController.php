<?php

namespace app\modules\api\controllers;


use app\models\Order;
use app\models\Task;
use app\models\User;
use app\modules\api\models\AcceptModel;
use app\modules\api\models\CreateOrderModel;
use app\modules\api\models\HomeCoordinatesModel;
use app\modules\api\models\OrderProvider;
use app\modules\api\models\TaskProvider;
use app\modules\api\services\AcceptOrderService;
use app\modules\api\services\CreateOrderService;
use yii\db\Exception;
use yii\db\Expression;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\VarDumper;
use yii\rest\Controller;
use Yii;

class OrderController extends Controller
{

    public $offset;
    public $limit;

    /**
     * @var CreateOrderService
     */
    /**
     * @var AcceptOrderService
     */
    private $createOrderService;
    private $acceptOrderService;


    public function __construct($id, $module,
                                CreateOrderService $createOrderService,
                                AcceptOrderService $acceptOrderService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createOrderService = $createOrderService;
        $this->acceptOrderService = $acceptOrderService;
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
        $params = Yii::$app->request->queryParams;

        $model = new OrderProvider();
        $dataProvider = $model->search($params);
        /** @var Order[] $orderModels $ */
        $orderModels = $dataProvider->getModels();
        $result = [
            'new' => [

            ],
            'current' => [

            ],
            'discharged' => [

            ]
        ];
        foreach ($orderModels as $item) {
            if ($item->status_id === Order::STATUS_NEW) {
                /** @var User $user $ */
                $user = User::find()->where(['id' => $item->patient_id])->one();
                $homeCoordinate = $item->getCoordinate($item->home_coordinate);
                $result['new'][] = [
                    "order_id" => $item->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "middle_name" => $user->middle_name,
                    "temperature" => $item->temperature,
                    "symptoms" => $item->symptoms,
                    "status" => $item->status_id,
                    "created_at" => $item->created_at,
                    "age" => $user->getAge(),
                    "latitude" => $homeCoordinate['latitude'],
                    "longitude" => $homeCoordinate['longitude']
                ];
            } else if ($item->status_id === Order::STATUS_TREATMENT) {
                $result['current'][] = [
                    "order_id" => $item->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "middle_name" => $user->middle_name,
                    "temperature" => $item->temperature,
                    "symptoms" => $item->symptoms,
                    "status" => $user->status_id,
                    "created_at" => $item->created_at,
                    "age" => $user->getAge(),
                    "latitude" => $homeCoordinate['latitude'],
                    "longitude" => $homeCoordinate['longitude']
                ];
            } else if ($item->status_id === Order::STATUS_DISCHARGED) {
                $result['discharged'][] = ["order_id" => $item->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "middle_name" => $user->middle_name,
                    "temperature" => $item->temperature,
                    "symptoms" => $item->symptoms,
                    "status" => $user->status_id,
                    "created_at" => $item->created_at,
                    "age" => $user->getAge(),
                    "latitude" => $homeCoordinate['latitude'],
                    "longitude" => $homeCoordinate['longitude']
                    ];
            }
        }


        return $result;
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
        $model = new AcceptModel();
        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);
        if (!$model->validate()) {
            return null;
        }
        $user = \Yii::$app->user->identity;
        if (!$user) {
            throw new Exception('Пользователь не авторизован');
        }
        if ($user->role_id !== 2) {
            throw new Exception('Пользователь не является доктором');

        }
        $order = $this->acceptOrderService->AcceptOrder($model, $user);
        if (!$order) {
            throw new Exception('Доктор с  таким id отстутсвтует');
        }
        return [
            "order_id" => $order->id
        ];

    }

    public function actionHomeCoordinates()
    {
        $model = new HomeCoordinatesModel();

        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);

        if (!$model->validate()) {
            throw new \Exception('Валидация, хуле');
        }
        $user = \Yii::$app->user->identity;
        if (!$user) {
            throw new Exception('Пользователь не авторизован');
        }
        if ($user->role_id !== 2) {
            throw new Exception('Пользователь не является доктором');

        }
        $order = Order::find()->where(['id' => $model->order_id])->one();
        if (!$order) {
            throw new Exception('Заявка не найдена');
        }
        $params = [
            ':latitude' => $model->latitude,
            ':longitude' => $model->longitude,
            ':order_id' => $order->id
        ];

        $sql = new Expression("UPDATE `order` SET `home_coordinate`=POINT(:latitude, :longitude) WHERE `id` = :order_id");

        Yii::$app->db->createCommand($sql, $params)->execute();
        return [

            "order_id" => "5",
            "point" => [
                "latitude" => -45.62390335574153,
                "longitude" => -3.9551761173743847
            ]
        ];
    }

}
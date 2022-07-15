<?php

namespace app\modules\api\controllers;

use app\models\Order;
use app\models\Task;
use app\modules\api\models\ActiveTaskModel;
use app\modules\api\models\CategoryTaskProvider;
use app\modules\api\models\FindTaskModel;
use app\modules\api\services\MarkDoneService;
use app\modules\api\models\ShowTasksModel;
use app\modules\api\models\TaskCreateModel;
use app\modules\api\models\TaskProvider;
use app\modules\api\services\CreateTaskService;
use app\modules\api\services\MarkRemovedService;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\rest\Controller;

class TaskController extends Controller
{

    /**
     * @var CreateTaskService
     */
    private $createTaskService;

    /**
     * @var MarkDoneService
     */

    private $markDoneService;

    /**
     * @var MarkRemovedService
     */

    private $markRemovedService;

    public function __construct($id,
        $module,
                                CreateTaskService $createTaskService,
                                MarkDoneService $markDoneService,
                                MarkRemovedService $markRemovedService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->createTaskService = $createTaskService;
        $this->markDoneService = $markDoneService;
        $this->markRemovedService = $markRemovedService;
    }


    public function actionAll()
    {
        $params = \Yii::$app->request->queryParams;
        $searchModel = new TaskProvider();
        $dataProvider = $searchModel->search($params);
        /** @var Task[] $models */
        $models = $dataProvider->getModels();
        $finalArray = [
            'active' => [

            ],
            'done' => [

            ],
            'removed' => [

            ]
        ];
        foreach ($models as $item) {
            if ($item->done_at != null) {
                $finalArray['done'][] = $item;
                /*array_push($finalArray['active'][], $item);*/
            } elseif ($item->removed_at != null) {
                $finalArray['removed'][] = $item;
                /*array_push($finalArray['done'][], $item);*/
            } else {
                $finalArray['active'][] = $item;

                /*array_push($finalArray['removed'][], $item);*/

            }

        }

        return $finalArray;

    }

    public function actionActive()
    {
        $searchModel = new CategoryTaskProvider();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);
        /** @var Task[] $models */
        $models = $dataProvider->getModels();
        $finalArray = [];
        foreach ($models as $item) {
            if (($item->done_at === null) && ($item->removed_at === null)) {
                $finalArray[] = $item;
            }
        }
        return $finalArray;
    }

    public function actionDone()
    {
        $searchModel = new CategoryTaskProvider();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);
        /** @var Task[] $models */
        $models = $dataProvider->getModels();
        $finalArray = [];
        foreach ($models as $item) {
            if (($item->done_at != null) && ($item->removed_at === null)) {
                $finalArray[] = $item;
            }
        }
        return $finalArray;

    }

    public function actionRemoved()
    {
        $searchModel = new CategoryTaskProvider();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);
        /** @var Task[] $models */
        $models = $dataProvider->getModels();
        $finalArray = [];
        foreach ($models as $item) {
            if (($item->done_at != null) && ($item->removed_at != null)) {
                $finalArray[] = $item;
            }
        }
        return $finalArray;

    }

    public function actionCreate()
    {
        $model = new TaskCreateModel();
        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);
        $user = \Yii::$app->user->identity;
        $order = Order::find()->where(['id' => $model->order_id])->one();
        if (!$order) {
            throw new Exception('Жалоба с таким id не найдена');
        }
        if (!$user) {
            throw new Exception('Пользователь не авторизован');
        }
        if ($user->role_id !== 2) {
            throw new Exception('Пользователь не является доктором');

        }
        $task = $this->createTaskService->CreateTask($model, $user);

        if (!$task) {
            throw new Exception('Ошибка при сохранении в бд');
        }
        return [
            "id" => "100500",
            "order_id" => "100500",
            "title" => "Доктор Мом",
            "planned_at" => "2021-05-25",
            "done_at" => "2021-05-25",
            "removed_at" => "2021-05-25"
        ];
    }

    public function actionMarkRemove()
    {
        $model = new FindTaskModel();
        $user = \Yii::$app->user->identity;
        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);
        if (!$model->validate()) {
            return null;
        }
        if ($user->role_id != 2) {
            throw new Exception('Пользователь не является доктором');
        }
        $task = $this->markRemovedService->remove($model);
        if (!$task) {
            throw new \Exception('Задача с таким id не найдена или задача уже была удалена');
        }
        return [
            "order_id"=>$task->order_id
        ];
    }

    public function actionMarkDone()
    {
        $model = new FindTaskModel();
        $user = \Yii::$app->user->identity;
        $data = \Yii::$app->request->getBodyParams();
        $model->load($data);

        if (!$model->validate()) {
            return null;
        }
        if ($user->role_id != 2) {
            throw new Exception('Пользователь не является доктором');
        }
        $task = $this->markDoneService->done($model);
        if (!$task) {
            throw new \Exception('Задача с таким id не найдена или задача была выполнена');
        }

        return [
            "order_id" => $task->order_id
        ];
    }
}


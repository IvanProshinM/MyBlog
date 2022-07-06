<?php

namespace app\modules\api\controllers;

use yii\web\Controller;

class TaskController extends Controller
{
    public function actionAll($order_id)
    {
        echo ' "active": [
    {
      "id": "100500",
      "order_id": "100500",
      "title": "Доктор Мом",
      "planned_at": "2021-05-25",
      "done_at": "2021-05-25",
      "removed_at": "2021-05-25"
    }
  ],
  "done": [
    {
      "id": "100500",
      "order_id": "100500",
      "title": "Доктор Мом",
      "planned_at": "2021-05-25",
      "done_at": "2021-05-25",
      "removed_at": "2021-05-25"
    }
  ],
  "removed": [
    {
      "id": "100500",
      "order_id": "100500",
      "title": "Доктор Мом",
      "planned_at": "2021-05-25",
      "done_at": "2021-05-25",
      "removed_at": "2021-05-25"
    }
  ]';
    }

    public function actionActive($offset, $limit, $order_id)
    {
        echo '"order_id": "100500",
  "title": "Доктор Мом",
  "planned_at": "2021-05-25",
  "done_at": "2021-05-25",
  "removed_at": "2021-05-25"';
    }

    public function actionDone($offset, $limit, $order_id)
    {
        echo '"order_id": "100500",
  "title": "Доктор Мом",
  "planned_at": "2021-05-25",
  "done_at": "2021-05-25",
  "removed_at": "2021-05-25"';

    }

    public function actionRemoved($offset, $limit, $order_id)
    {
        echo '"order_id": "100500",
  "title": "Доктор Мом",
  "planned_at": "2021-05-25",
  "done_at": "2021-05-25",
  "removed_at": "2021-05-25"';

    }

    public function actionCreate()
    {
        echo '"order_id": "100500",
  "title": "Доктор Мом",
  "planned_at": "2021-05-25",
  "done_at": "2021-05-25",
  "removed_at": "2021-05-25"';

    }

    public function actionMarkRemove()
    {
        echo '"task_id": "100500"';
    }

    public function actionMarkDone()
    {
        echo '"task_id": "100500"';
    }
}


<?php

namespace app\modules\api\services;

use app\models\Task;

class MarkDoneService
{
    public function done($model)
    {
        $task = Task::find()
            ->where(['order_id' => $model->order_id])
            ->andWhere(['done_at' => null])->one();
        if (!$task) {
            return null;
        }
        $task->done_at = time();
        $task->save();
        return $task;
    }
}
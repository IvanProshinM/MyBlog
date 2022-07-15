<?php

namespace app\modules\api\services;

use app\models\Task;

class MarkRemovedService
{
    public function remove($model)
    {
        $task = Task::find()
            ->where(['order_id' => $model->order_id])
            ->andWhere(['removed_at' => null])->one();
        if (!$task) {
            return  null;
        }
        $task->removed_at = time();
        $task->save();
        return $task;
    }


}
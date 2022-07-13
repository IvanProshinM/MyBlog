<?php

namespace app\modules\api\services;

use app\models\Task;
use app\models\User;

class CreateTaskService
{
    public function CreateTask($model, $user)
    {
        $patient = User::find()->where(['id'=>9])->one();
        for ($i = 1; $i = $model->quantity; $model->quantity--) {
            $task = new Task();
            $task->order_id = $model->order_id;
            $task->doctor_id = $user->id;
            $task->patient_id = $patient->id;
            $task->title =  $model->title . ' ' . $i . ' ' . 'раз/раза';
            $task->planned_at = $model->date_to;
            $task->save();
        }
        return true;
    }
}
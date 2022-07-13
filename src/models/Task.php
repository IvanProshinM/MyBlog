<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id;
 * @property string $title;
 * @property int $order_id;
 * @property int $patient_id;
 * @property int $doctor_id;
 * @property int $status_id;
 * @property int $created_at;
 * @property int $updated_at;
 * @property int $planned_at;
 * @property int $done_at;
 * @property int $removed_at;
 */
class Task extends ActiveRecord
{


    public static function tableName()
    {
        return "task";
    }

    public function rules()
    {
        return [
            [['id', 'order_id', 'patient_id', 'doctor_id', 'status_id', 'created_at', 'updated_at', 'done_at', 'removed_at'], 'integer'],
            [['title',], 'string'],
            ['planned_at', 'date', 'format' => 'Y-m-d']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];

    }


}
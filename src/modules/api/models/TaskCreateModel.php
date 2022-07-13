<?php

namespace app\modules\api\models;


use yii\base\Model;

class TaskCreateModel extends Model
{
    public $order_id;
    public $date_to;
    public $title;
    public $quantity;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['order_id', 'date_to', 'title', 'quantity'], 'required'],
            [['title'], 'string'],
            [['order_id', 'quantity'], 'integer'],
            ['date_to', 'date', 'format' => 'Y-m-d']
        ];
    }

}
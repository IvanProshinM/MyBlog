<?php

namespace app\modules\api\models;


use yii\base\Model;

class CreateOrderModel extends Model
{

    public $temperature;
    public $symptoms;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['symptoms','temperature'], 'string'],
            [['temperature','symptoms'], 'required'],
        ];
    }

}
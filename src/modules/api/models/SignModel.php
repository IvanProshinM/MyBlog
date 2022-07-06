<?php

namespace app\modules\api\models;


use yii\base\Model;

class SignModel extends Model
{

    public $phone;


    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['phone'], 'string'],
            [['phone'], 'required'],
            ['phone', 'match', 'pattern' => '/^(8)[(](\d{3})[)](\d{3})[-](\d{2})[-](\d{2})/', 'message' => 'Телефона, должно быть в формате 8(XXX)XXX-XX-XX']
        ];
    }

}
<?php

namespace app\modules\api\models;

use yii\base\Model;

class ConfirmModel extends Model
{
    public $phone;
    public $sms_code_confirm;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $birthday;


    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['phone', 'sms_code_confirm'], 'required'],
            [['phone', 'sms_code_confirm', 'first_name', 'middle_name', 'last_name', 'gender'], 'string'],
            [['birthday'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function save()
    {

    }


}
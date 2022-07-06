<?php

namespace app\modules\api\models;

use yii\base\Model;

class FireBaseToken extends Model
{

    public $firebase_token;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['firebase_token'],'string'],
            [['firebase_token'],'required'],
        ];
    }

}
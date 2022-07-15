<?php

namespace app\modules\api\models;

use yii\base\Model;

class FindTaskModel extends Model
{

    public $order_id;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id'], 'integer']
        ];
    }

}
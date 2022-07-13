<?php

namespace app\modules\api\models;

use yii\base\Model;

class ActiveTaskModel extends Model
{
    public $offset;
    public $limit;
    public $order_id;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['offset','limit','order_id'], 'required'].
            [['offset','limit','order_id'], 'integer']
        ];
    }

}
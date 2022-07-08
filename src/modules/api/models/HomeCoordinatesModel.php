<?php

namespace app\modules\api\models;

use yii\base\Model;

class HomeCoordinatesModel extends Model
{
    public $order_id;
    public $latitude;
    public $longitude;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['order_id', 'latitude', 'longitude'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['order_id'], 'integer'],
        ];
    }


}
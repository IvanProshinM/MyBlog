<?php

namespace app\modules\api\models;

use yii\base\Model;

class CoordinateModel extends Model
{

    public $latitude;
    public $longitude;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'required'],
            ['latitude', 'number'],
            ['longitude', 'number']
        ];
    }
}
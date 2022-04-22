<?php

namespace app\modules\admin\models;

use yii\base\Model;

class UpdateCategory extends \yii\base\Model
{

    public $name;

    public function rules()
    {
        return [
            [['name'], 'required' ],
            [['name'], 'string','min' =>6 , 'max'=> 15]
        ];
    }

}
<?php

namespace app\modules\admin\models;

use yii\base\Model;

class CreateCategory extends Model
{

    public $name;


    public function rules() {
        return [
            [['name'], 'required' ],
            [['name'], 'string','min' =>6 , 'max'=> 15]
        ];
    }

}

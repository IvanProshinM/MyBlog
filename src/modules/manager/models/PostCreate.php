<?php

namespace app\modules\manager\models;


use yii\base\Model;

class PostCreate extends Model
{
    public $name;
    public $categoriesList;
    public $textShort;
    public $textFull;

    public function rules()
    {
        return [
            [['name', 'textFull', 'textShort'], 'required'],
            [['name'], 'string', 'min' => 4, 'max' => 16],
            [['name', 'textFull', 'textShort'], 'string'],
            [['categoriesList'], 'safe']
        ];
    }


}
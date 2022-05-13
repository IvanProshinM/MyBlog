<?php

namespace app\modules\manager\models;


use yii\base\Model;

class PostCreate extends Model
{
    public $name;
    public $categoriesList;
    public $textShort;
    public $textFull;
    public $publicDate;

    public function rules()
    {
        return [
            [['name', 'textFull', 'textShort'], 'required'],
            [['name'], 'string', 'min' => 4, 'max' => 16],
            [['name', 'textFull', 'textShort'], 'string'],
            [['publicDate'], 'date', 'format' => 'dd.MM.yyyy', 'timestampAttribute' => 'publicDate'],
            [['categoriesList'], 'safe']
        ];
    }


}
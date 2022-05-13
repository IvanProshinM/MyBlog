<?php

namespace app\modules\manager\models;


use yii\base\Model;

class PostChange extends Model
{
    public $name;
    public $category;
    public $textShort;
    public $textFull;
    public $publicDate;
    public $categoriesList;

    public function rules()
    {
        return [
            [['name', 'textFull', 'textShort'], 'required'],
            [['name'], 'string', 'min' => 4, 'max' => 16],
            [['name', 'textFull', 'textShort', 'category'], 'string'],
            [['publicDate'], 'date', 'format' => 'dd.MM.yyyy', 'timestampAttribute' => 'publicDate'],
            [['categoriesList'], 'safe']
        ];
    }


}
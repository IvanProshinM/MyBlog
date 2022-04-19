<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;

class Category extends ActiveRecord
{


    public int $id;
    public string $name;
    public $slug;
    /**
     * unix_time;
     */
    public int $createdAt;
    /**
     * unix_time;
     */
    public int $updatedAt;


    public function rules()
    {
        return [
            [['name'], 'required'],
            ['createAt', 'date', 'timestampAttribute' => 'createdAt'],
            ['updatedAt', 'date', 'timestampAttribute' => 'updatedAt']

        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
            ],
        ];

    }
}

<?php

namespace app\models;

use app\modules\manager\query\PostQuery;
use yii\base\Model;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int id;
 * @property string|null name;
 * @property int status;
 * @property string publicDate;
 * @property string|null textShort;
 * @property string|null textFull;
 * @property string|null category;
 * @property boolean commentOff;
 * @property int createdAt;
 * @property int updatedAt;
 */
class Post extends ActiveRecord
{


    public const STATUS_NOT_PUBLIC = 0;
    public const STATUS_PUBLIC = 1;

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['name', 'textShort', 'textFull', 'category'], 'string'],
            [['id', 'status'], 'integer'],
            [['commentOff'], 'boolean']
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
     /*       [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
            ],*/
        ];

    }



    public static function find()
    {
        return new PostQuery(static::class);
    }

}
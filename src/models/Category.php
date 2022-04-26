<?php

namespace app\models;

use app\query\CategoryQuery;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * @property int $id;
 * @property string|null $name;
 * @property string|null $slug;
 * @property int $createdAt;
 * @property int $updatedAt;
 */
class Category extends ActiveRecord
{

    /**
     * @var mixed|null
     */
    private $activateHash;

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['slug'], 'string'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
            ],
        ];

    }
    public static function find()
    {
        return new CategoryQuery(static::class);
    }
}

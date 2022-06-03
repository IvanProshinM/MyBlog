<?php

namespace app\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

class Comments extends \yii\db\ActiveRecord
{
    /**
     * @property int $id;
     * @property string|null $author;
     * @property string|null $content;
     * @property string|null $postId;
     * @property int $created_at;
     * @property int|null $updated_at;
     */

    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['author', 'content', 'postId'], 'string'],
            [['id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];

    }
}
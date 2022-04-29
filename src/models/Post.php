<?php

namespace app\models;

use app\modules\manager\query\PostQuery;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * @property int id;
 * @property string|null name;
 * @property int status;
 * @property int publicDate;
 * @property string|null textShort;
 * @property string|null textFull;
 * @property string|null category;
 * @property boolean commentOff;
 * @property int createdAt;
 * @property int updatedAt;
 */
class Post extends ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {

    }

    public static function find()
    {
        return new PostQuery(static::class);
    }

}
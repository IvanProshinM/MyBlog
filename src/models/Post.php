<?php

namespace app\models;

use app\modules\manager\query\PostQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int id;
 * @property string|null name;
 * @property int status;
 * @property string publicDate;
 * @property string|null textShort;
 * @property string|null textFull;
 * @property boolean commentOff;
 * @property int createdAt;
 * @property int updatedAt;
 * @property Category[] categories;
 * @property int[] categoriesListId;
 * @property int redactor;
 */
class Post extends ActiveRecord
{

    public $categoriesListId;

    public const STATUS_NOT_PUBLIC = 0;
    public const STATUS_PUBLIC = 1;

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['name', 'textShort', 'textFull'], 'string'],
            [['id', 'status','redactor'], 'integer'],
            [['commentOff'], 'boolean'],
            ['categoriesListId', 'safe']
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

    public function getPostCategories()
    {
        return $this->hasMany(PostCategory::class, ['post_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('postCategories');
    }

    public function getCategoriesListId()
    {
        if ($this->categoriesListId === null) {
            $this->categoriesListId = ArrayHelper::map($this->categories, 'id', 'id');
        }
        return $this->categoriesListId;
    }

    public function setCategoriesListId($value)
    {
        $this->categoriesListId = $value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->refreshCategories();
        parent::afterSave($insert, $changedAttributes);
    }

    protected function refreshCategories()
    {
        $categories = $this->categoriesListId;
        PostCategory::deleteAll(['post_id' => $this->id]);
        if (!is_array($categories)) {
            return;
        }
        \Yii::warning('categories list');
        \Yii::warning($this->categoriesListId);
        foreach ($categories as $id) {
            $category = Category::find()->andWhere(['id' => $id])->one();

            if ($category === null) {
                continue;
            }
            $postCategory = new PostCategory();
            $postCategory->category_id = $id;
            $postCategory->post_id = $this->id;
            $postCategory->save();
            \Yii::warning($postCategory->errors);
        }
    }


}
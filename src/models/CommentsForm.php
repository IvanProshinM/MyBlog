<?php

namespace app\models;

class CommentsForm extends \yii\base\Model
{

    public $content;

    public function rules()
    {
        return [
            [['content'], 'string'],
            ['content', 'filter', 'filter' => function ($value) {
            return \yii\helpers\HtmlPurifier::process($value);
            }
            ]
        ];

    }

}

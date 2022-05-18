<?php

namespace app\modules\manager\services;

use app\models\Post;
use app\modules\manager\models\PostChange;

class PostChangeService
{
    public function PostChange(PostChange $model, Post $post)
    {
        $post->name = $model->name;
        $post->textShort = $model->textShort;
        $post->textFull = $model->textFull;
        $post->publicDate = \Yii::$app->formatter->format($model->publicDate, 'timestamp' );
        \Yii::warning($model->categoriesList);

        $post->categoriesListId = $model->categoriesList;
        return $post;
    }
}
<?php

namespace app\modules\manager\services;

use app\models\Post;
use app\modules\manager\models\PostChange;

class PostChangeService
{
    public function PostChange(PostChange $model)
    {
        $post = new Post();
        $post->name = $model->name;
        $post->category = $model->category;
        $post->textShort = $model->textShort;
        $post->textFull = $model->textFull;
        return $post;
    }
}
<?php

namespace app\modules\manager\services;

use app\models\Post;
use app\modules\manager\controllers\PostController;
use app\modules\manager\models\PostCreate;

class CreatePostService
{
    public function createPost(PostCreate $model)
    {
        $session = \Yii::$app->session;

        $post = Post::find()
            ->where(['name' => $model->name])
            ->one();
        if ($post) {
            return null;
        } else {
            $newPost = new Post();
            $newPost->name = $model->name;
            $newPost->textShort = $model->textShort;
            $newPost->textFull = $model->textFull;
            $newPost->status = Post::STATUS_NOT_PUBLIC;
            $newPost->commentOff = false;
            $newPost->publicDate = $model->publicDate;
            $newPost->categoriesListId = $model->categoriesList;
            return $newPost;
        }
    }

}
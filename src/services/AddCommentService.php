<?php

namespace app\services;


use app\models\Comments;
use app\models\CommentsForm;


class AddCommentService
{
    public function __construct()
    {
    }

    public function add(CommentsForm $commentsForm, $author, $postId):Comments
    {
        $comments = new Comments();
        $comments->content = $commentsForm->content;
        $comments->author = $author;
        $comments->postId = $postId;
        $comments->created_at = time();
        $comments->updated_at = null;
        return $comments;
    }
}



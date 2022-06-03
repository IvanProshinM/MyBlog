<?php

namespace app\controllers;


use app\models\Comments;
use app\models\CommentsForm;
use app\models\User;
use app\services\AddCommentService;
use app\services\UserCreateService;
use Yii;
use app\models\Post;


class CommentsController extends \yii\web\Controller
{

    /**
     * @var AddCommentService;
     * @var app\models\Post $model ;
     */

    private $addCommentService;

    public function __construct($id,
        $module,
                                AddCommentService $addCommentService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->addCommentService = $addCommentService;
    }


    public function actionAdd($id)
    {
        $model = new CommentsForm();
        $session = \Yii::$app->session;
        $post = Post::find()
            ->where(['id'=>$id])
            ->one();
        if (Yii::$app->user->identity === null) {
            $author = 'Guest';
        } else {
            $author = Yii::$app->user->identity->getNickname();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $comments = $this->addCommentService->add($model, $author, $id);
            $comments->save();
            $session->setFlash('success', 'Комментарий успешно добавлен ');
        }

        return $this->redirect(['/view/'.$post->slug]);
    }


}


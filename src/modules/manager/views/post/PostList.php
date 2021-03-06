<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $Category app\models\Post; */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->registerCssFile("@web/css/postList.css");

$this->title = 'Post List';
?>

<div class="post-list">

    <div class="post-list_content">
        <h1><?= Html::encode($this->title) ?></h1>


        <?php $form = ActiveForm::begin(); ?>


        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model) {
                return $this->render('PostItem', ['model' => $model]);
            },
            'layout' => "{items}\n{pager}",
        ]) ?>
        <br>
        <br>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="post-list_side-bar">
        <p>Categories:</p>
        <?php
        $categoryName = \app\models\Category::find()->all();
        foreach ($categoryName as $value): ?>
            <?= Html::a($value->name, ['/manager/post', 'slug'=>$value->slug ], ['target' => '_blank']) ?>
            <br>
        <?php endforeach ?>

    </div>
</div>

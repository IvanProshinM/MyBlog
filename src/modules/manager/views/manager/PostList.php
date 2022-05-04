<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $Category app\models\Post; */
/* @var $dataProvider yii\data\ActiveDataProvider; */


$this->title = 'Post List';
?>
<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model) {
        return $this->render('PostItem', ['model' => $model]);
    },
]) ?>
<br>
<br>

<?php ActiveForm::end(); ?>

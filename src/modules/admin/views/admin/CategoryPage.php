<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $Category app\models\Category; */
/* @var $dataProvider yii\data\ActiveDataProvider; */


$this->title = 'Admin Kingdom';
?>
<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model) {
        return $this->render('CategoryItem', ['model' => $model]);
    },
]) ?>

<?= Html::a('Add category', ['admin/category-create'], ['target' => '_blank']); ?>
<br>
<br>


<?php ActiveForm::end(); ?>

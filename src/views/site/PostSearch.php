<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $Category app\models\Post; */
/* @var $dataProvider yii\data\ActiveDataProvider; */

?>
<?php $form = ActiveForm::begin(); ?>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model) {
        return $this->render('PostItem', ['model' => $model]);
    },
    'layout' => "{items}",
]) ?>
<br>
<br>
<?php ActiveForm::end(); ?>



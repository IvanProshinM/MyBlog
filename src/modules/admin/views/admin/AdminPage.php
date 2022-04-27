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


<?= Html::a('Category Page', ['admin/category-page']); ?>
    <br>
    <br>
<?= Html::a('Users Page', ['admin/user-page']); ?>


<?php ActiveForm::end(); ?>
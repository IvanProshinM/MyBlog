<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\Recover */



$this->title = 'Восстановление пароля';
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <h2><?= 'Введите свой email' ?></h2>
<?= $form->field($model, 'email') ?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Сбросить пароль', ['class' => 'btn btn-primary']) ?>
    </div>


<?php ActiveForm::end(); ?>
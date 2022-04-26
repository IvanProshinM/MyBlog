<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\admin\models\ChangeUser */


$this->title = 'Change User';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'nickname') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<?php echo $form->field($model, 'role')->dropDownList([
    '0' => 'Guest',
    '1' => 'Redactor',
    '2' => 'Admin'

]); ?>


<?php echo $form->field($model, 'gender')->dropDownList([
    '0' => 'Мужской',
    '1' => 'Женский',

]);
?>

<?php echo $form->field($model, 'status')->dropDownList([
    '0' => 'Заблокировать',
    '1' => 'Установить не подвержденный статус',
    '2' => 'Установить подтвержденный статус'

]); ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Change  ', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo Yii::$app->session->getFlash('alert'); ?>

<?php ActiveForm::end(); ?>
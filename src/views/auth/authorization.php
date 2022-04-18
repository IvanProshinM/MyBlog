<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\Registration */



$this->title = 'Вход';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo Yii::$app->session->getFlash('alert'); ?>

<?= Html::a('Забыли пароль?', ['auth/recover'], ['target'=>'_blank']) ?>

<?php ActiveForm::end(); ?>
<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\manager\models\PostCreate; */


$this->title = 'Post Creation';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'category') ?>
<?= $form->field($model, 'textShort')->textarea(['rows' => '3']) ?>
<? /*= $form->field($model, 'textFull')->textarea(['rows' => '6']) */ ?>

<?=
$form->field($model, 'textFull')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 200,
        'plugins' => [
            'clips',
            'fullscreen',
        ],
        'clips' => [
            ['Lorem ipsum...', 'Lorem...'],
            ['red', '<span class="label-red">red</span>'],
            ['green', '<span class="label-green">green</span>'],
            ['blue', '<span class="label-blue">blue</span>'],
        ],
    ],
]);
?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
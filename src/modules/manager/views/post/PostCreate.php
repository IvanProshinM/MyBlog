<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\manager\models\PostCreate; */


$this->title = 'Post Creation';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>

<?php
$categoryList = \app\models\Category::find()->asArray()->all();
/*$result = [];
foreach ($categoryList as $category) {
    $result[$category['id']] = $category['name'];

}*/

$result = \yii\helpers\ArrayHelper::map($categoryList, 'id', 'name');

/*\yii\helpers\VarDumper::dump($result, 10, true);*/

?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'categoriesList')->checkboxList($result) ?>
<?= $form->field($model, 'textShort')->textarea(['rows' => '3']) ?>


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
<?php


echo $form->field($model, 'publicDate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter public date ...'],
    'pluginOptions' => [
        'autoclose' => true
    ],

]);



/*echo DatePicker::widget([
    'name' => 'check_issue_date',
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);*/
?>
    <div class="form-group">
        <br>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
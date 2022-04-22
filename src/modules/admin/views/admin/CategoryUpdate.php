<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model app\modules\admin\models\CreateCategory;
 */
?>


<?php $this->title = 'Category Update';
?>
<h1><?= Html::encode($this->title) ?></h1>


<?php $form = \yii\widgets\ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>

<div>
    <?= Html::submitButton('Обновить') ?>

</div>

<?php $form = \yii\widgets\ActiveForm::end(); ?>


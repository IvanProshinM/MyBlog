<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var app\models\Category $model ;
 */
$id = $model->id;
?>


<ul>
    <li>
        <?= $model->name ?>
    </li>
</ul>
<span>
   <?= Html::a('update category', ['update-category', 'id'=>$id]) ?>
</span>
<br>
<br>
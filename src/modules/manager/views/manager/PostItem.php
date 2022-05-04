<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var app\models\Post $model ;
 */
$id = $model->id;
?>


<ul>
    <li>
        <?= $model->name ?>
    </li>

    <li>
        <?= $model->category ?>
    </li>

    <li>
        <?= $model->textShort ?>
    </li>

    <li>
        <?= $model->textFull ?>
    </li>
</ul>
<br>
<br>
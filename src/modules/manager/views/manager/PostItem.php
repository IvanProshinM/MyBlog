<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var app\models\Post $model ;
 */
$id = $model->id;

$this->registerCssFile("@web/css/postItem.css");
?>

<div class="post-item">
    <!--<ul class="post">
    <li>
       Имя поста:
    </li>

    <li>
        Категория поста:
    </li>

    <li class="text">
        Коротко о главном:
    </li>

    <li class="text">
        Длинно о не главном:
    </li>
</ul>
<ul class="post">
    <li>
        <? /*= $model->name */ ?>
    </li>

    <li>
        <? /*= $model->category */ ?>
    </li>

    <li class="text">
        <? /*= $model->textShort */ ?>
    </li>

    <li class="text">
        <? /*= $model->textFull */ ?>
    </li>
</ul>-->
</div>


<table>
    <tr>
        <th>Post name:</th>
    </tr>
    <tr>
        <td>
            <?= $model->name ?>
        </td>
    </tr>
    <tr>
        <th>Category</th>
    </tr>
    <tr>
        <td>
            <?= $model->category ?>
        </td>
    </tr>
    <tr>
        <th>Short review</th>
    </tr>
    <tr>
        <td>
            <?= $model->textShort ?>
        </td>
    </tr>
    <tr>
        <th>Long review</th>
    </tr>
    <tr>
        <td>
            <?= $model->textFull ?>
        </td>
    </tr>
</table>


<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()) {
    echo Html::a('change post', ['post-change', 'id' => $id]);
} ?>


<hr class="dividing-line">
<br>
<br>
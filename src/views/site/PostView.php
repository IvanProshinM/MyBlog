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

</div>


<table>
    <tr>
        <td class="post-item_name">
            <?= $model->name ?>
        </td>
    </tr>
    <tr>
        <th>Категории</th>
    </tr>
    <tr>
        <td><?php
            $category = $model->categories;
            $result = [];
            foreach ($category as $key => $value)
                $result[] = $value->name;
            echo implode(', ', $result);
            /*
            $category = \yii\helpers\ArrayHelper::getColumn($category, 'name');
            echo implode(', ', $category);
        \yii\helpers\VarDumper::dump($category,3,true);*/
            ?></td>
    </tr>
    <tr>
        <th>Не коротко о главном</th>
    </tr>
    <tr>
        <td>
            <?= $model->textFull  ?>
        </td>
    </tr>
</table>

<br>
<br>
<p>Опубликован:</p>
<?= $model->publicDate = date('d.m.y') ?>


<hr class="dividing-line">
<br>
<br>
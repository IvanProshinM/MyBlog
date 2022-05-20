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
        <td>
            <?php
            $options = ['class' => 'post-item_name'];

            echo Html::a($model->name, ['site/view', 'slug' => $model->slug], $options) ?>
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
        <th>Коротко о главном</th>
    </tr>
    <tr>
        <td>
            <?= $model->textShort ?>
        </td>
    </tr>
    <!--    <tr>
        <th>Long review</th>
    </tr>
    <tr>
        <td>
            <? /*= $model->textFull */ ?>
        </td>
    </tr>-->
</table>


<?= Html::a('Подробнее',['site/view', 'slug' => $model->slug],['class'=>'btn btn-primary']) ?>
<br>
<br>
<p>Опубликован:</p>
<?= date('d.m.y', $model->publicDate) ?>

<hr class="dividing-line">
<br>
<br>
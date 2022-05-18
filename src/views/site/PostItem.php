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


<?php /*if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()) {
    echo Html::a('change post', ['post-change', 'id' => $id]);
} */?>


<hr class="dividing-line">
<br>
<br>
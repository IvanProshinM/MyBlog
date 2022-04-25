<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var app\models\User $model ;
 */
$id = $model->id;
/*$username = $model->username;
$nickname = $model->nickname;
$email = $model->email;*/


?>


<?php
$this->registerCssFile("@web/css/userItem.css");


?>

<div class="users-list">
    <div>
        <ul class="users-list_item">
            <li>
                Имя пользователя:
            </li>

            <li>
                Ник пользователя:
            </li>

            <li>
                Электронная почта пользователя:
            </li>

            <li>
                Пол (Уокер) пользователя:
            </li>
        </ul>
    </div>
    <div>
        <ul class="users-list_value">
            <li>
                <?= $model->username ?>
            </li>

            <li>
                <?= $model->nickname ?>
            </li>

            <li>
                <?= $model->email ?>
            </li>

            <li>
                <?= $model->gender ?>
            </li>
        </ul>
    </div>
</div>
<span>
   <?= Html::a('update user', ['change-user', 'id' => $id], ['target' => '_blank']) ?>
</span>
<br>
<br>
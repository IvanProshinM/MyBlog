<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/confirm', 'activateHash' => $user->activateHash]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to verify your email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink, ['target'=>'_blank'] ) ?></p>
</div>
